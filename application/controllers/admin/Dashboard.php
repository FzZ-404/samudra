<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Admin_Controller {
  public function index(){
    $data = ['title' => 'Dashboard'];
    $this->render('admin/dashboard/index', $data);
  }
}
