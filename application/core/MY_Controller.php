<?php defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

  public function __construct(){
    parent::__construct();

    // Load helper dan library penting
    $this->load->helper(['url', 'form']);
    $this->load->library('session');

    // === Wajib login ===
    if (!is_logged_in()){
      $this->session->set_flashdata('error','Silakan login sebagai admin.');
      redirect('login');
      exit;
    }

    // === Wajib role admin ===
    if (!is_admin()){
      show_error('Akses ditolak: hanya admin.', 403);
      exit;
    }

    // === Muat bahasa sesuai session ===
    $this->load_language();
  }

  private function load_language(){
    $this->load->library('session');
    $lang = $this->session->userdata('lang') ?? $this->config->item('language') ?? 'indonesian';
    $this->lang->load('app', $lang);
  }

  protected function render($view, $data = []){
    $this->load->view('admin/layout/header', $data);
    $this->load->view($view, $data);
    $this->load->view('admin/layout/footer');
  }
}
