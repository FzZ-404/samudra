<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Language extends CI_Controller
{
    public function switch($lang = 'indonesian')
    {
        $available = ['indonesian', 'english'];

        if (!in_array($lang, $available)) {
            $lang = 'indonesian';
        }

        $this->session->set_userdata('lang', $lang);
        redirect($_SERVER['HTTP_REFERER'] ?? site_url());
    }
}
