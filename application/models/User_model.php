<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {
  public function find_by_email($email){
    return $this->db->get_where('users',['email'=>$email])->row();
  }
  public function create_member($name,$email,$password_hash){
    return $this->db->insert('users',[
      'role_id'=>2,'name'=>$name,'email'=>$email,'password_hash'=>$password_hash
    ]);
  }
}
