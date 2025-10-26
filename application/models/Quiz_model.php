<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Quiz_model extends CI_Model {
  public function published(){
    return $this->db->order_by('id','DESC')->get_where('quizzes',['published'=>1])->result();
  }
}
