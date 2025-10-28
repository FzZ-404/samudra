<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Event_model extends CI_Model {
  public function get_all($q=null){
    if($q){
      $this->db->group_start()->like('title',$q)->or_like('description',$q)->group_end();
    }
    return $this->db->order_by('start_at','DESC')->get('events')->result();
  }
  public function find($id){ return $this->db->get_where('events',['id'=>$id])->row(); }
  public function create($data){ return $this->db->insert('events',$data); }
  public function update($id,$data){ return $this->db->update('events',$data,['id'=>$id]); }
  public function delete($id){ return $this->db->delete('events',['id'=>$id]); }
}
