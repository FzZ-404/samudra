<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Event_model extends CI_Model {
  public function upcoming($limit=12){
    $now = date('Y-m-d H:i:s');
    return $this->db->where('published',1)->where('end_at >=',$now)->order_by('start_at','ASC')->limit($limit)->get('events')->result();
  }
}
