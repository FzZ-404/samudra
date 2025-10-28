<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
  public function __construct(){
    parent::__construct();
    $this->load->database();
    // model opsional; kalau tidak ada tetap aman
    $this->load->model('Article_model', 'Article_model', true);
    $this->load->model('Event_model',   'Event_model',   true);
    $this->load->model('Quiz_model',    'Quiz_model',    true);
  }

  public function index(){
    // hitung cepat pakai DB (aman walau model belum ada metodenya)
    $total_articles = $this->db->count_all_results('articles');
    $total_events   = $this->db->count_all_results('events');
    $total_quizzes  = $this->db->count_all_results('quizzes');

    // ambil beberapa item terbaru (kalau model punya method gunakan; jika tidak fallback DB)
    $articles = method_exists($this->Article_model,'latest')
      ? $this->Article_model->latest(4)
      : $this->db->order_by('id','DESC')->limit(4)->get('articles')->result();

    $events = method_exists($this->Event_model,'upcoming')
      ? $this->Event_model->upcoming()
      : $this->db->order_by('start_at','ASC')->limit(4)->get('events')->result();

    $quizzes = method_exists($this->Quiz_model,'published')
      ? $this->Quiz_model->published()
      : $this->db->where('published',1)->order_by('id','DESC')->limit(4)->get('quizzes')->result();

    $data = [
      'title'           => 'Dashboard',
      'total_articles'  => $total_articles,
      'total_events'    => $total_events,
      'total_quizzes'   => $total_quizzes,
      'articles'        => $articles,
      'events'          => $events,
      'quizzes'         => $quizzes,
      'hero'            => false, // jangan pakai hero bawaan header
    ];
    $this->load->view('layout/header', $data);
    $this->load->view('dashboard/index', $data);
    $this->load->view('layout/footer');
  }
}
