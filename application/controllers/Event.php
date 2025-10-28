<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Event extends CI_Controller {
  public function index(){
    $this->load->model('Event_model');
    $data = [
      'title'  => 'Event Konservasi',
      'events' => $this->Event_model->upcoming() 
    ];
    $this->load->view('layout/header',$data);
    $this->load->view('event/index',$data);
    $this->load->view('layout/footer');
  }
}
