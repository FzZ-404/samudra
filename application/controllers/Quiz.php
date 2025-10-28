<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Quiz extends CI_Controller {
  public function __construct(){
    parent::__construct();
    $this->load->model('Quiz_model');
    $this->load->library('session');
  }

  public function index(){
    $data['title'] = 'Kuis Edukasi Laut';
    $data['quizzes'] = $this->Quiz_model->published();
    $this->load->view('layout/header',$data);
    $this->load->view('quiz/index',$data);
    $this->load->view('layout/footer');
  }

  public function start($id){
    $quiz = $this->Quiz_model->find($id);
    if(!$quiz) show_404();
    $questions = $this->Quiz_model->get_questions($id);
    $data = ['title'=>$quiz->title,'quiz'=>$quiz,'questions'=>$questions];
    $this->load->view('layout/header',$data);
    $this->load->view('quiz/start',$data);
    $this->load->view('layout/footer');
  }

  public function submit($id){
    $quiz = $this->Quiz_model->find($id);
    if(!$quiz) show_404();

    $questions = $this->Quiz_model->get_questions($id);
    $user_id = $this->session->userdata('user')['id'] ?? 0;
    $attempt_id = $this->Quiz_model->start_attempt($id,$user_id);

    $score = 0; $total = count($questions);
    foreach($questions as $q){
      $answer = $this->input->post('q'.$q['id']);
      $correct = 0;
      foreach($q['choices'] as $c){
        if($c['is_correct']) $correct_choice = $c['id'];
      }
      if($answer == $correct_choice){ $score++; $correct=1; }
      $this->Quiz_model->save_answer($attempt_id,$q['id'],$answer,$correct);
    }
    $percent = $total ? round(($score/$total)*100,2) : 0;
    $this->Quiz_model->finish_attempt($attempt_id,$percent);

    $data = ['title'=>'Hasil Kuis','quiz'=>$quiz,'score'=>$score,'total'=>$total,'percent'=>$percent];
    $this->load->view('layout/header',$data);
    $this->load->view('quiz/result',$data);
    $this->load->view('layout/footer');
  }
}
