<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Quizzes extends Admin_Controller {
  public function __construct(){
    parent::__construct();
    $this->load->model('Quiz_model');
  }

  public function index(){
    $data = [
      'title'=>'Quiz',
      'rows'=>$this->Quiz_model->get_all()
    ];
    $this->render('admin/quizzes/index',$data);
  }

  public function create(){
    $data=['title'=>'Tambah Quiz'];
    $this->render('admin/quizzes/form',$data);
  }

  public function store(){
    $this->form_validation->set_rules('title','Judul','required|min_length[3]');
    if(!$this->form_validation->run()) return $this->create();

    $data = [
      'title'=>$this->input->post('title',true),
      'description'=>$this->input->post('description',true),
      'time_limit_sec'=>$this->input->post('time_limit_sec',true) ?: 0,
      'published'=>(int)$this->input->post('published'),
      'created_by'=>current_user()['id'],
      'created_at'=>date('Y-m-d H:i:s')
    ];
    $this->Quiz_model->create($data);
    $this->session->set_flashdata('success','Quiz dibuat.');
    redirect('admin/quizzes');
  }

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
      'description'=>$this->input->post('description',true),
      'time_limit_sec'=>$this->input->post('time_limit_sec',true) ?: 0,
      'published'=>(int)$this->input->post('published'),
    ];
    $this->Quiz_model->update($id,$data);
    $this->session->set_flashdata('success','Quiz diupdate.');
    redirect('admin/quizzes');
  }

  public function delete($id){
    $this->Quiz_model->delete($id);
    $this->session->set_flashdata('success','Quiz dihapus.');
    redirect('admin/quizzes');
  }
}
