<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Events extends Admin_Controller {
  public function __construct(){
    parent::__construct();
    $this->load->model('Event_model');
  }

  /** Ubah upload jadi BLOB */
  private function handle_upload_blob(){
    if(!empty($_FILES['banner']['name'])){
      $tmp = $_FILES['banner']['tmp_name'];
      $mime = mime_content_type($tmp);
      $data = file_get_contents($tmp);
      return ['blob'=>$data, 'mime'=>$mime];
    }
    return null;
  }

  public function index(){
    $q = $this->input->get('q', true);
    $rows = $this->Event_model->search($q);
    $data = [
      'title' => 'Manajemen Event',
      'q'     => $q ?? '',
      'rows'  => $rows
    ];
    $this->render('admin/events/index', $data);
  }

  public function create(){
    $data = ['title'=>'Tambah Event'];
    $this->render('admin/events/form', $data);
  }

  public function store(){
    $this->form_validation->set_rules('title','Judul','required|min_length[3]');
    $this->form_validation->set_rules('start_at','Tanggal Mulai','required');
    $this->form_validation->set_rules('end_at','Tanggal Selesai','required');
    if(!$this->form_validation->run()) return $this->create();

    $banner = $this->handle_upload_blob();

    $data = [
      'title'       => $this->input->post('title',true),
      'description' => $this->input->post('description'),
      'place'       => $this->input->post('place',true),
      'start_at'    => $this->input->post('start_at'),
      'end_at'      => $this->input->post('end_at'),
      'published'   => (int)$this->input->post('published'),
      'created_by'  => $this->session->userdata('user')['id'] ?? null,
      'created_at'  => date('Y-m-d H:i:s'),
    ];

    if($banner){
      $data['cover_blob'] = $banner['blob'];
      $data['cover_mime'] = $banner['mime'];
    }

    $this->Event_model->create($data);
    $this->session->set_flashdata('success','Event berhasil ditambahkan.');
    redirect('admin/events');
  }

  public function edit($id){
    $row = $this->Event_model->find($id);
    if(!$row) show_404();
    $data = ['title'=>'Edit Event', 'row'=>$row];
    $this->render('admin/events/form',$data);
  }

  public function update($id){
    $row = $this->Event_model->find($id);
    if(!$row) show_404();

    $banner = $this->handle_upload_blob();

    $data = [
      'title'       => $this->input->post('title',true),
      'description' => $this->input->post('description'),
      'place'       => $this->input->post('place',true),
      'start_at'    => $this->input->post('start_at'),
      'end_at'      => $this->input->post('end_at'),
      'published'   => (int)$this->input->post('published'),
      'updated_at'  => date('Y-m-d H:i:s'),
    ];

    if($banner){
      $data['cover_blob'] = $banner['blob'];
      $data['cover_mime'] = $banner['mime'];
    }

    $this->Event_model->update($id,$data);
    $this->session->set_flashdata('success','Event diperbarui.');
    redirect('admin/events');
  }

  public function delete($id){
    $this->Event_model->delete($id);
    $this->session->set_flashdata('success','Event dihapus.');
    redirect('admin/events');
  }
}
