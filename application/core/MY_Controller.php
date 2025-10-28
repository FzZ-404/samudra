<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Controller extends CI_Controller {
  public function __construct(){
    parent::__construct();
    // wajib login
    if (!is_logged_in()){
      $this->session->set_flashdata('error','Silakan login sebagai admin.');
      redirect('auth/login');
      exit;
    }
    // wajib role admin
    if (!is_admin()){
      show_error('Akses ditolak: hanya admin.', 403);
      exit;
    }
  }

  protected function render($view, $data = []){
    // layout admin
    $this->load->view('admin/layout/header', $data);
    $this->load->view($view, $data);
    $this->load->view('admin/layout/footer');
  }
}
