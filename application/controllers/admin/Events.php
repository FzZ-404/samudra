<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Events extends Admin_Controller {
  public function __construct(){
    parent::__construct();
    $this->load->model('Event_model');
  }

  public function index(){
    $q = $this->input->get('q', true);
    $data = [
      'title' => 'Event',
      'q'     => $q,
      'rows'  => $this->Event_model->get_all($q)
    ];
    $this->render('admin/events/index', $data);
  }

  public function create(){
    $data = ['title' => 'Tambah Event'];
    $this->render('admin/events/form', $data);
  }

  public function store(){
    $this->form_validation->set_rules('title','Judul','required|min_length[3]');
    $this->form_validation->set_rules('start_at','Tanggal Mulai','required');
    $this->form_validation->set_rules('end_at','Tanggal Selesai','required');
    if(!$this->form_validation->run()){
      return $this->create();
    }

    $data = [
      'title'       => $this->input->post('title',true),
      'description' => $this->input->post('description'),
      'place'       => $this->input->post('place',true),
      'start_at'    => $this->input->post('start_at'),
      'end_at'      => $this->input->post('end_at'),
      'banner_url'  => $this->input->post('banner_url',true),
      'published'   => (int)$this->input->post('published'),
      'created_by'  => current_user()['id'],
      'created_at'  => date('Y-m-d H:i:s'),
    ];
    $this->Event_model->create($data);
    $this->session->set_flashdata('success','Event berhasil dibuat.');
    redirect('admin/events');
  }

  public function edit($id){
    $row = $this->Event_model->find($id);
    if(!$row) show_404();
    $data = ['title'=>'Edit Event','row'=>$row];
    $this->render('admin/events/form',$data);
  }

  public function update($id){
    $row = $this->Event_model->find($id);
    if(!$row) show_404();
    $this->form_validation->set_rules('title','Judul','required|min_length[3]');
    if(!$this->form_validation->run()){
      return $this->edit($id);
    }
    $data = [
      'title'       => $this->input->post('title',true),
      'description' => $this->input->post('description'),
      'place'       => $this->input->post('place',true),
      'start_at'    => $this->input->post('start_at'),
      'end_at'      => $this->input->post('end_at'),
      'banner_url'  => $this->input->post('banner_url',true),
      'published'   => (int)$this->input->post('published'),
    ];
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
