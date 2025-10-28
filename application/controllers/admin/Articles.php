<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Articles extends Admin_Controller {
  public function __construct(){
    parent::__construct();
    $this->load->model('Article_model');
  }

  /** Fungsi bantu: konversi file upload jadi BLOB */
  private function handle_upload_blob(){
    if(!empty($_FILES['cover']['name'])){
      $fileTmp = $_FILES['cover']['tmp_name'];
      $mime = mime_content_type($fileTmp);
      $data = file_get_contents($fileTmp);
      return ['blob'=>$data, 'mime'=>$mime];
    }
    return null;
  }

  /** Halaman daftar artikel (dengan pencarian) */
  public function index(){
    $q = $this->input->get('q', true);
    $rows = $this->Article_model->search($q);
    $data = [
      'title' => 'Manajemen Artikel',
      'q'     => $q ?? '',
      'rows'  => $rows
    ];
    $this->render('admin/articles/index', $data);
  }

  /** Form tambah */
  public function create(){
    $data=['title'=>'Tambah Artikel'];
    $this->render('admin/articles/form',$data);
  }

  /** Simpan artikel baru */
  public function store(){
    $this->form_validation->set_rules('title','Judul','required|min_length[3]');
    $this->form_validation->set_rules('content','Konten','required|min_length[10]');
    if(!$this->form_validation->run()) return $this->create();

    $cover = $this->handle_upload_blob();

    $data = [
      'title'        => $this->input->post('title',true),
      'slug'         => url_title($this->input->post('title',true),'dash',true),
      'excerpt'      => $this->input->post('excerpt',true),
      'content'      => $this->input->post('content'),
      'published'    => (int)$this->input->post('published'),
      'published_at' => $this->input->post('published') ? date('Y-m-d H:i:s') : null,
      'created_by'   => $this->session->userdata('user')['id'],
      'created_at'   => date('Y-m-d H:i:s'),
    ];

    if($cover){
      $data['cover_blob'] = $cover['blob'];
      $data['cover_mime'] = $cover['mime'];
    }

    $this->Article_model->create($data);
    $this->session->set_flashdata('success','Artikel berhasil ditambahkan.');
    redirect('admin/articles');
  }

  /** Form edit */
  public function edit($id){
    $row = $this->Article_model->find($id);
    if(!$row) show_404();
    $data = ['title'=>'Edit Artikel','row'=>$row];
    $this->render('admin/articles/form',$data);
  }

  /** Update artikel */
  public function update($id){
    $row = $this->Article_model->find($id);
    if(!$row) show_404();

    $cover = $this->handle_upload_blob();

    $data = [
      'title'        => $this->input->post('title',true),
      'slug'         => url_title($this->input->post('title',true),'dash',true),
      'excerpt'      => $this->input->post('excerpt',true),
      'content'      => $this->input->post('content'),
      'published'    => (int)$this->input->post('published'),
      'published_at' => $this->input->post('published')
                            ? ($row->published_at ?: date('Y-m-d H:i:s')) : null,
      'updated_at'   => date('Y-m-d H:i:s'),
    ];

    if($cover){
      $data['cover_blob'] = $cover['blob'];
      $data['cover_mime'] = $cover['mime'];
    }

    $this->Article_model->update($id,$data);
    $this->session->set_flashdata('success','Artikel berhasil diperbarui.');
    redirect('admin/articles');
  }

  /** Hapus artikel */
  public function delete($id){
    $this->Article_model->delete($id);
    $this->session->set_flashdata('success','Artikel dihapus.');
    redirect('admin/articles');
  }
}
