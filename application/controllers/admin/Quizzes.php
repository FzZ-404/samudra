<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Quizzes extends Admin_Controller {
  public function __construct(){
    parent::__construct();
    $this->load->model('Quiz_model');
    $this->load->library(['form_validation','session']);
    $this->load->helper(['url','form']);
  }

  public function index(){
    $data = ['title'=>'Manajemen Quiz','rows'=>$this->Quiz_model->get_all()];
    $this->render('admin/quizzes/index',$data);
  }

  /* ===================== UX: 1 halaman buat kuis + banyak soal ===================== */
  public function create(){
    $data = ['title'=>'Buat Quiz Baru (Sekali Halaman)'];
    $this->render('admin/quizzes/create_full',$data);
  }

  public function store(){
    /* Validasi minimal: judul harus ada */
    $this->form_validation->set_rules('title','Judul','required|min_length[3]');
    if(!$this->form_validation->run()){
      $this->session->set_flashdata('error', validation_errors(' ', ' '));
      return redirect('admin/quizzes/create');
    }

    // Ambil data kuis
    $user_id = $this->session->userdata('user')['id'] ?? 1; // fallback id=1 biar FK aman
    $quiz = [
      'title'       => $this->input->post('title', true),
      'description' => $this->input->post('description'),
      'published'   => (int)$this->input->post('published'),
      'created_by'  => $user_id,
      'created_at'  => date('Y-m-d H:i:s')
    ];

    // Ambil array pertanyaan
    $qs = $this->input->post('questions'); // array: [ [text => '...', choices => [...], correct => idx], ... ]

    // Minimal harus ada 1 pertanyaan valid
    if(!is_array($qs) || count($qs) < 1){
      $this->session->set_flashdata('error','Minimal 1 pertanyaan harus diisi.');
      return redirect('admin/quizzes/create');
    }

    // Mulai transaksi agar konsisten
    $this->db->trans_begin();

    // 1) Simpan kuis
    $quiz_id = $this->Quiz_model->create($quiz);

    // 2) Simpan setiap pertanyaan + opsi
    foreach($qs as $q){
      $q_text   = isset($q['text']) ? trim((string)$q['text']) : '';
      $choices  = isset($q['choices']) && is_array($q['choices']) ? $q['choices'] : [];
      $correctI = isset($q['correct']) ? (string)$q['correct'] : null;

      // Bersihkan pilihan kosong
      $choices_clean = [];
      foreach($choices as $idx => $txt){
        $txt = trim((string)$txt);
        if($txt !== '') $choices_clean[$idx] = $txt;
      }

      if($q_text === '' || count($choices_clean) < 2 || $correctI === null || !array_key_exists($correctI, $choices_clean)){
        // Jika ada pertanyaan yang tidak valid, gagalkan transaksi
        $this->db->trans_rollback();
        $this->session->set_flashdata('error','Setiap pertanyaan wajib punya isi & minimal 2 opsi, serta 1 kunci jawaban.');
        return redirect('admin/quizzes/create');
      }

      $question_id = $this->Quiz_model->add_question($quiz_id, $q_text);
      foreach($choices as $idx => $txt){
        $txt = trim((string)$txt);
        if($txt === '') continue;
        $this->Quiz_model->add_choice($question_id, $txt, ((string)$idx === $correctI) ? 1 : 0);
      }
    }

    // Commit transaksi
    if ($this->db->trans_status() === FALSE) {
      $this->db->trans_rollback();
      $this->session->set_flashdata('error','Gagal menyimpan kuis. Coba lagi.');
      return redirect('admin/quizzes/create');
    } else {
      $this->db->trans_commit();
    }

    $this->session->set_flashdata('success','Quiz berhasil dibuat dengan pertanyaan-pertanyaannya!');
    return redirect('admin/quizzes');
  }

  /* ============== opsi lama tetap ada (edit, update, delete) ============== */
  public function edit($id){
    $row=$this->Quiz_model->find($id);
    if(!$row) show_404();
    $data=['title'=>'Edit Quiz','row'=>$row];
    $this->render('admin/quizzes/form',$data);
  }

  public function update($id){
    $row=$this->Quiz_model->find($id);
    if(!$row) show_404();
    $this->form_validation->set_rules('title','Judul','required|min_length[3]');
    if(!$this->form_validation->run()) return $this->edit($id);

    $data=[
      'title'=>$this->input->post('title',true),
      'description'=>$this->input->post('description'),
      'published'=>(int)$this->input->post('published'),
      'updated_at'=>date('Y-m-d H:i:s')
    ];
    $this->Quiz_model->update($id,$data);
    $this->session->set_flashdata('success','Quiz diperbarui.');
    redirect('admin/quizzes');
  }

  public function delete($id){
    $this->Quiz_model->delete($id);
    $this->session->set_flashdata('success','Quiz dihapus.');
    redirect('admin/quizzes');
  }
}
