<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Event_model extends CI_Model {

  /** Admin: daftar semua event (dengan pencarian opsional) */
  public function search($q = null){
    if($q){
      $this->db->group_start()
               ->like('title',$q)
               ->or_like('description',$q)
               ->or_like('place',$q)
               ->group_end();
    }
    return $this->db->order_by('start_at','DESC')->get('events')->result();
  }

  /** Admin: semua event */
  public function get_all(){
    return $this->db->order_by('start_at','DESC')->get('events')->result();
  }

  /** Publik: event publish */
  public function published(){
    return $this->db->where('published',1)
                    ->order_by('start_at','ASC')
                    ->get('events')->result();
  }

  /** Publik: event yang akan datang (start >= now, publish=1) */
  public function upcoming(){
    return $this->db->where('published',1)
                    ->where('start_at >=', date('Y-m-d H:i:s'))
                    ->order_by('start_at','ASC')
                    ->get('events')->result();
  }

  /** Ambil satu event */
  public function find($id){
    return $this->db->get_where('events',['id'=>$id])->row();
  }

  /** CRUD */
  public function create($data){ return $this->db->insert('events',$data); }
  public function update($id,$data){ return $this->db->update('events',$data,['id'=>$id]); }
  public function delete($id){ return $this->db->delete('events',['id'=>$id]); }
}
