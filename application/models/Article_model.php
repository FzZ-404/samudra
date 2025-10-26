<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Article_model extends CI_Model {
  public function latest($limit=12){
    return $this->db->order_by('published_at','DESC')->limit($limit)->get_where('articles',['published'=>1])->result();
  }
}
