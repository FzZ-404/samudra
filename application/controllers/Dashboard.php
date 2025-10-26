<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
  public function __construct(){
    parent::__construct();
    if(!$this->session->userdata('user')) redirect('auth/login');
  }
  public function index(){
    $data=['title'=>'Dashboard','active'=>'dashboard'];
    $this->load->view('layout/header',$data);
    $this->load->view('dashboard/index');
    $this->load->view('layout/footer');
  }
}
