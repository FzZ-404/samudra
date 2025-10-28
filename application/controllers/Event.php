<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Event extends CI_Controller {
  public function __construct(){
    parent::__construct();
    $this->load->database();
    $this->load->helper(['url','text']);
    if (file_exists(APPPATH.'models/Event_model.php')) {
      $this->load->model('Event_model');
    }
  }

  public function index(){
    $q = trim($this->input->get('q', true) ?? '');
    $today = date('Y-m-d');

    // ambil event terdekat (≥ hari ini)
    $this->db->from('events')->where('published', 1);
    $this->db->where('start_at >=', $today);
    if($q !== ''){
      $this->db->group_start()
               ->like('title', $q)
               ->or_like('place', $q)
               ->or_like('description', $q)
               ->group_end();
    }
    $this->db->order_by('start_at','ASC');
    $events = $this->db->get()->result();

    // fallback jika tidak ada event mendatang → tampilkan yang lewat
    if(empty($events)){
      $this->db->from('events')->where('published', 1);
      $this->db->order_by('start_at','DESC')->limit(6);
      $events = $this->db->get()->result();
    }

    $data = [
      'title'   => 'Event',
      'events'  => $events,
      'keyword' => $q,
      'hero'    => false
    ];
    $this->load->view('layout/header', $data);
    $this->load->view('event/index',  $data);
    $this->load->view('layout/footer');
  }

  public function view($id){
    $event = $this->db->get_where('events', ['id'=>$id, 'published'=>1])->row();
    if(!$event) show_404();

    // ambil event lain sebagai rekomendasi
    $this->db->from('events')->where('published',1)->where('id !=', $id);
    $this->db->order_by('start_at','ASC')->limit(3);
    $related = $this->db->get()->result();

    $data = [
      'title'   => $event->title,
      'hero'    => false,
      'event'   => $event,
      'related' => $related
    ];
    $this->load->view('layout/header', $data);
    $this->load->view('event/view',  $data);
    $this->load->view('layout/footer');
  }
}
