<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Edukasi extends CI_Controller {
  public function index() {
    $this->load->model('Article_model');
    $articles = $this->Article_model->latest(12);
    $data = ['title'=>'Edukasi','active'=>'edukasi','articles'=>$articles];
    $this->load->view('layout/header',$data);
    $this->load->view('edukasi/index',$data);
    $this->load->view('layout/footer');
  }
}
