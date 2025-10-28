<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Edukasi extends CI_Controller {
  public function __construct(){
    parent::__construct();
    $this->load->database();
    $this->load->helper(['url','text']);
    // Jika punya Article_model, boleh load (opsional)
    if (file_exists(APPPATH.'models/Article_model.php')) {
      $this->load->model('Article_model');
    }
  }

  // Daftar artikel + pencarian
  public function index(){
    $q = trim($this->input->get('q', true) ?? '');

    // pakai model jika ada method latest(); else fallback db
    if (isset($this->Article_model) && method_exists($this->Article_model, 'latest')) {
      $articles = $this->Article_model->latest(12, $q); // pastikan methodmu support $q, jika tidak abaikan
    } else {
      $this->db->from('articles')->where('published', 1);
      if ($q !== '') {
        $this->db->group_start()
                 ->like('title', $q)
                 ->or_like('content', $q)
                 ->or_like('excerpt', $q)
                 ->group_end();
      }
      $this->db->order_by('id','DESC');
      $this->db->limit(12);
      $articles = $this->db->get()->result();
    }

    // artikel unggulan (ambil yang terbaru satu jika ada)
    $featured = !empty($articles) ? $articles[0] : null;

    $data = [
      'title'    => 'Edukasi',
      'hero'     => false,          // kita pakai hero khusus di view
      'keyword'  => $q,
      'featured' => $featured,
      'articles' => $articles
    ];
    $this->load->view('layout/header', $data);
    $this->load->view('edukasi/index', $data);
    $this->load->view('layout/footer');
  }

  // Detail artikel
  public function view($id){
    // pakai model kalau ada, fallback db
    if (isset($this->Article_model) && method_exists($this->Article_model, 'find')) {
      $article = $this->Article_model->find($id);
    } else {
      $article = $this->db->get_where('articles', ['id'=>$id, 'published'=>1])->row();
    }
    if (!$article) show_404();

    // ambil rekomendasi 3 artikel lain
    $this->db->from('articles')->where('published',1)->where('id !=', $id);
    $this->db->order_by('id','DESC')->limit(3);
    $related = $this->db->get()->result();

    $data = [
      'title'   => $article->title,
      'hero'    => false,
      'article' => $article,
      'related' => $related
    ];
    $this->load->view('layout/header', $data);
    $this->load->view('edukasi/view', $data);
    $this->load->view('layout/footer');
  }
}
