<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Quiz extends CI_Controller {
  public function index() {
    $this->load->model('Quiz_model');
    $quizzes = $this->Quiz_model->published();
    $data = ['title'=>'Quiz','active'=>'quiz','quizzes'=>$quizzes];
    $this->load->view('layout/header',$data);
    $this->load->view('quiz/index',$data);
    $this->load->view('layout/footer');
  }
}
