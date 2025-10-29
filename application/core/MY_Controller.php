<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Base controller umum
 */
class MY_Controller extends CI_Controller
{
    protected $lang_code = 'id'; // mapping untuk konten DB

    public function __construct()
    {
        parent::__construct();
        // util dasar
        $this->load->helper(['url','form']);
        $this->load->library('session');

        // muat bahasa UI (statis) + mapping lang_code konten
        $appLang = $this->session->userdata('lang') ?? $this->config->item('language') ?? 'indonesian';
        $this->lang->load('app', $appLang);
        $this->lang_code = ($appLang === 'english') ? 'en' : 'id';

        // share ke view jika mau dipakai
        $this->load->vars([
            '__app_lang' => $appLang,
            '__lang_code' => $this->lang_code
        ]);
    }

    /**
     * Render layout umum (user)
     */
    protected function render($view, $data = [])
    {
        $this->load->view('layout/header', $data);
        $this->load->view($view, $data);
        $this->load->view('layout/footer');
    }

    /**
     * Cek login dari session
     */
    protected function is_logged_in()
    {
        return (bool) $this->session->userdata('user');
    }

    /**
     * Cek admin berdasarkan session
     * - role_id == 1 atau role == 'admin'
     */
    protected function is_admin()
    {
        $u = $this->session->userdata('user');
        if (!$u) return false;
        if (isset($u['role_id']) && (int)$u['role_id'] === 1) return true;
        if (isset($u['role']) && $u['role'] === 'admin') return true;
        return false;
    }
}

/**
 * Base controller untuk area Admin
 */
class Admin_Controller extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        // wajib login
        if (!$this->is_logged_in()){
            $this->session->set_flashdata('error', 'Silakan login sebagai admin.');
            redirect('login');
            exit;
        }

        // wajib role admin
        if (!$this->is_admin()){
            show_error('Akses ditolak: hanya admin.', 403);
            exit;
        }
    }

    /**
     * Render layout admin
     */
    protected function render($view, $data = [])
    {
        $this->load->view('admin/layout/header', $data);
        $this->load->view($view, $data);
        $this->load->view('admin/layout/footer');
    }
}
