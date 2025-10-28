<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
  public function __construct(){
    parent::__construct();
    $this->load->model(['Article_model','Event_model','Quiz_model']);
  }

  public function index(){
    $data = [
      'title'    => 'Beranda',
      'articles' => method_exists($this->Article_model,'latest') ? $this->Article_model->latest(6) : [],
      'events'   => method_exists($this->Event_model,'upcoming') ? $this->Event_model->upcoming() : [],
      'quizzes'  => method_exists($this->Quiz_model,'published') ? $this->Quiz_model->published() : [],
    ];
    // gunakan hero bawaan header
    $data['hero'] = false; // kita pakai hero khusus di view Home
    $this->load->view('layout/header', $data);
    $this->load->view('home/index', $data);
    $this->load->view('layout/footer');
  }
}
