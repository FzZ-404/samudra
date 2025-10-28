<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Article_model extends CI_Model {

  public function latest($limit=12){
    return $this->db->order_by('published_at','DESC')
      ->limit($limit)->get_where('articles',['published'=>1])->result();
  }

  public function get_all($q = null){
    if($q){
      $this->db->group_start()
               ->like('title',$q)
               ->or_like('excerpt',$q)
               ->group_end();
    }
    return $this->db->order_by('id','DESC')->get('articles')->result();
  }

  public function find($id){
    return $this->db->get_where('articles',['id'=>$id])->row();
  }

  public function create($data){
    $this->db->insert('articles',$data);
    return $this->db->insert_id();
  }

  public function update($id,$data){
    return $this->db->update('articles',$data,['id'=>$id]);
  }

  public function delete($id){
    return $this->db->delete('articles',['id'=>$id]);
  }
}
