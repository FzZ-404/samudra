<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Quiz_model extends CI_Model {
  public function get_all(){ return $this->db->order_by('id','DESC')->get('quizzes')->result(); }
  public function find($id){ return $this->db->get_where('quizzes',['id'=>$id])->row(); }
  public function create($data){ return $this->db->insert('quizzes',$data); }
  public function update($id,$data){ return $this->db->update('quizzes',$data,['id'=>$id]); }
  public function delete($id){ return $this->db->delete('quizzes',['id'=>$id]); }
}
