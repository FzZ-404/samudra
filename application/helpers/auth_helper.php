<?php defined('BASEPATH') OR exit('No direct script access allowed');

function current_user(){
  $CI =& get_instance();
  return $CI->session->userdata('user') ?: null;
}

function is_logged_in(){
  return current_user() !== null;
}

function is_admin(){
  $u = current_user();
  return $u && isset($u['role_id']) && (int)$u['role_id'] === 1;
}
