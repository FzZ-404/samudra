<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
  public function login(){
    if($this->input->method()==='post'){
      $this->form_validation->set_rules('email','Email','required|valid_email');
      $this->form_validation->set_rules('password','Password','required|min_length[6]');
      if($this->form_validation->run()){
        $this->load->model('User_model');
        $user = $this->User_model->find_by_email($this->input->post('email',true));
        if($user && password_verify($this->input->post('password'), $user->password_hash)){
          $this->session->set_userdata('user', ['id'=>$user->id,'name'=>$user->name,'role_id'=>$user->role_id]);
          return redirect('dashboard');
        }
        $this->session->set_flashdata('error','Email atau password salah.');
      }
    }
    $data=['title'=>'Login'];
    $this->load->view('layout/header',$data);
    $this->load->view('auth/login');
    $this->load->view('layout/footer');
  }

  public function signup(){
    if($this->input->method()==='post'){
      $this->form_validation->set_rules('name','Nama','required|min_length[3]');
      $this->form_validation->set_rules('email','Email','required|valid_email|is_unique[users.email]');
      $this->form_validation->set_rules('password','Password','required|min_length[6]');
      if($this->form_validation->run()){
        $this->load->model('User_model');
        $this->User_model->create_member(
          $this->input->post('name',true),
          $this->input->post('email',true),
          password_hash($this->input->post('password'), PASSWORD_BCRYPT)
        );
        $this->session->set_flashdata('success','Akun dibuat. Silakan login.');
        return redirect('auth/login');
      }
    }
    $data=['title'=>'Signup'];
    $this->load->view('layout/header',$data);
    $this->load->view('auth/signup');
    $this->load->view('layout/footer');
  }

  public function logout(){
    $this->session->unset_userdata('user');
    redirect('');
  }
}
