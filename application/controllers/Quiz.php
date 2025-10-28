<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Quiz extends CI_Controller {
  public function __construct(){
    parent::__construct();
    $this->load->model('Quiz_model');
    $this->load->database();
    $this->load->library('session');
    $this->load->helper(['url','text']);
  }

  // Daftar kuis dengan pencarian sederhana
  public function index(){
    $q = trim($this->input->get('q', true) ?? '');
    $this->db->from('quizzes')->where('published', 1);
    if($q !== ''){
      $this->db->group_start()
               ->like('title', $q)
               ->or_like('description', $q)
               ->group_end();
    }
    $this->db->order_by('id','DESC');
    $quizzes = $this->db->get()->result();

    // hitung jumlah soal per kuis
    foreach($quizzes as $k => $z){
      $quizzes[$k]->questions_count = $this->db
        ->where('quiz_id', $z->id)
        ->count_all_results('quiz_questions');
    }

    $data = [
      'title'   => 'Kuis',
      'quizzes' => $quizzes,
      'keyword' => $q,
      'hero'    => false
    ];
    $this->load->view('layout/header', $data);
    $this->load->view('quiz/index',  $data);
    $this->load->view('layout/footer');
  }

  public function start($id){
    $quiz = $this->Quiz_model->find($id);
    if(!$quiz || (int)$quiz->published !== 1) show_404();

    $questions = $this->Quiz_model->get_questions($id); // grouped: id, question, choices[]
    if(empty($questions)) {
      $data = ['title'=>'Kuis','message'=>'Kuis belum memiliki pertanyaan.'];
      $this->load->view('layout/header',$data);
      $this->load->view('quiz/empty',$data);
      $this->load->view('layout/footer');
      return;
    }

    $data = [
      'title'     => $quiz->title,
      'quiz'      => $quiz,
      'questions' => $questions
    ];
    $this->load->view('layout/header', $data);
    $this->load->view('quiz/start',   $data);
    $this->load->view('layout/footer');
  }

  public function submit($id){
    $quiz = $this->Quiz_model->find($id);
    if(!$quiz) show_404();

    $questions = $this->Quiz_model->get_questions($id);
    $user_id   = $this->session->userdata('user')['id'] ?? 0;
    $attempt_id = $this->Quiz_model->start_attempt($id, $user_id);

    $score = 0; $total = count($questions);
    foreach($questions as $q){
      $picked = $this->input->post('q'.$q['id']); // berisi choice_id
      $correct_choice_id = null;
      foreach($q['choices'] as $c){
        if((int)$c['is_correct'] === 1){
          $correct_choice_id = $c['id'];
          break;
        }
      }
      $is_correct = ($picked && $picked == $correct_choice_id) ? 1 : 0;
      if($is_correct) $score++;
      $this->Quiz_model->save_answer($attempt_id, $q['id'], $picked ?: null, $is_correct);
    }
    $percent = $total ? round(($score/$total)*100) : 0;
    $this->Quiz_model->finish_attempt($attempt_id, $percent);

    $data = [
      'title'   => 'Hasil Kuis',
      'quiz'    => $quiz,
      'score'   => $score,
      'total'   => $total,
      'percent' => $percent
    ];
    $this->load->view('layout/header', $data);
    $this->load->view('quiz/result',  $data);
    $this->load->view('layout/footer');
  }
}
