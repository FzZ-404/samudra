<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(['url','form']);
        $this->load->library('session');
        $this->load->database();
    }

    /* =========================
       VIEW PAGES
    ==========================*/
    public function login()
    {
        $data['title'] = 'Login';
        $this->load->view('layout/header', $data);
        $this->load->view('auth/login');
        $this->load->view('layout/footer');
    }

    public function register()
    {
        $data['title'] = 'Signup';
        $this->load->view('layout/header', $data);
        $this->load->view('auth/register');
        $this->load->view('layout/footer');
    }

    /* =========================
       ACTIONS
    ==========================*/
    public function do_register()
    {
        $name  = trim($this->input->post('name', true));
        $email = strtolower(trim($this->input->post('email', true)));
        $pass  = $this->input->post('password', true);

        if ($name==='' || $email==='' || $pass==='') {
            $this->session->set_flashdata('success', 'Lengkapi semua field.');
            return redirect('signup');
        }

        // Cek email sudah ada?
        $exists = $this->db->where('email', $email)->count_all_results('users') > 0;
        if ($exists) {
            $this->session->set_flashdata('success', 'Email sudah terdaftar. Silakan login.');
            return redirect('login');
        }

        // role_id: 2 = member (lihat tabel roles: 1=admin, 2=member)
        $data = [
            'role_id'       => 2,
            'name'          => $name,
            'email'         => $email,
            'password_hash' => password_hash($pass, PASSWORD_BCRYPT),
            'created_at'    => date('Y-m-d H:i:s'),
        ];
        $this->db->insert('users', $data);

        $this->session->set_flashdata('success', 'Akun berhasil dibuat! Silakan login.');
        return redirect('login');
    }

    public function do_login()
    {
        $email = strtolower(trim($this->input->post('email', true)));
        $pass  = $this->input->post('password', true);

        if ($email==='' || $pass==='') {
            $this->session->set_flashdata('error', 'Email dan password wajib diisi.');
            return redirect('login');
        }

        // Ambil user by email (menggunakan kolom password_hash & role_id)
        $user = $this->db->get_where('users', ['email' => $email], 1)->row();

        if ($user && !empty($user->password_hash) && password_verify($pass, $user->password_hash)) {

            // Map role_id -> string agar kompatibel dengan cek 'role' di tempat lain
            $role_map = [1 => 'admin', 2 => 'member'];
            $role_str = isset($role_map[$user->role_id]) ? $role_map[$user->role_id] : 'member';

            // Set session
            $this->session->set_userdata('user', [
                'id'        => (int)$user->id,
                'name'      => $user->name,
                'email'     => $user->email,
                'role_id'   => (int)$user->role_id,
                'role'      => $role_str, // supaya pengecekan lama yang pakai 'role' tetap jalan
            ]);

            // Arahkan sesuai role
            if ($user->role_id == 1) {
                return redirect('admin/dashboard');
            }
            return redirect('dashboard');
        }

        $this->session->set_flashdata('error', 'Email atau password salah.');
        return redirect('login');
    }

    public function logout()
    {
        $this->session->unset_userdata('user');
        return redirect('/');
    }
}
