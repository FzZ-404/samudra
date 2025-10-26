<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Event extends CI_Controller {
  public function index() {
    $this->load->model('Event_model');
    $events = $this->Event_model->upcoming(12);
    $data = ['title'=>'Event','active'=>'event','events'=>$events];
    $this->load->view('layout/header',$data);
    $this->load->view('event/index',$data);
    $this->load->view('layout/footer');
  }
}
