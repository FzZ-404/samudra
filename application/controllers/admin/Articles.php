<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Articles extends Admin_Controller {

  public function __construct(){
    parent::__construct();
    $this->load->model('Article_model');
    $this->load->helper('text'); // untuk word_limiter di view (opsional)
  }

  public function index(){
    $q = $this->input->get('q', true);
    $data = [
      'title' => 'Artikel',
      'q'     => $q,
      'rows'  => $this->Article_model->get_all($q)
    ];
    $this->render('admin/articles/index', $data);
  }

  public function create(){
    $data = ['title' => 'Artikel Baru'];
    $this->render('admin/articles/form', $data);
  }

  public function store(){
    $this->form_validation->set_rules('title','Judul','required|min_length[3]');
    $this->form_validation->set_rules('content','Konten','required|min_length[10]');
    if(!$this->form_validation->run()){
      return $this->create(); // tampilkan form lagi
    }
    $slug = url_title($this->input->post('title', true), 'dash', true);

    $data = [
      'category_id' => null, // bisa diisi bila sudah ada kategori
      'title'       => $this->input->post('title', true),
      'slug'        => $slug,
      'excerpt'     => $this->input->post('excerpt', true),
      'content'     => $this->input->post('content'), // biarkan html
      'cover_url'   => $this->input->post('cover_url', true),
      'published'   => (int)$this->input->post('published'),
      'published_at'=> $this->input->post('published') ? date('Y-m-d H:i:s') : null,
      'created_by'  => current_user()['id'],
      'created_at'  => date('Y-m-d H:i:s'),
    ];
    $this->Article_model->create($data);
    $this->session->set_flashdata('success','Artikel dibuat.');
    redirect('admin/articles');
  }

  public function edit($id){
    $row = $this->Article_model->find($id);
    if(!$row) show_404();
    $data = ['title'=>'Edit Artikel', 'row'=>$row];
    $this->render('admin/articles/form', $data);
  }

  public function update($id){
    $row = $this->Article_model->find($id);
    if(!$row) show_404();
    $this->form_validation->set_rules('title','Judul','required|min_length[3]');
    $this->form_validation->set_rules('content','Konten','required|min_length[10]');
    if(!$this->form_validation->run()){
      return $this->edit($id);
    }
    $slug = url_title($this->input->post('title', true), 'dash', true);

    $data = [
      'title'       => $this->input->post('title', true),
      'slug'        => $slug,
      'excerpt'     => $this->input->post('excerpt', true),
      'content'     => $this->input->post('content'),
      'cover_url'   => $this->input->post('cover_url', true),
      'published'   => (int)$this->input->post('published'),
      'published_at'=> $this->input->post('published') ? ($row->published_at ?: date('Y-m-d H:i:s')) : null,
      'updated_at'  => date('Y-m-d H:i:s'),
    ];
    $this->Article_model->update($id,$data);
    $this->session->set_flashdata('success','Artikel diupdate.');
    redirect('admin/articles');
  }

  public function delete($id){
    $row = $this->Article_model->find($id);
    if(!$row) show_404();
    $this->Article_model->delete($id);
    $this->session->set_flashdata('success','Artikel dihapus.');
    redirect('admin/articles');
  }
}
