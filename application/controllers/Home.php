<?php

defined('BASEPATH') or exit('Ação não permitida');

class Home extends CI_Controller
{
    public function __contruct()
    {
        parent::__contruct();
    }

    public function index()
    {
        $data = [
            'titulo' => 'Pagina Incial',
          ];

        if (!$this->ion_auth->logged_in()) {
            $this->session->set_flashdata('info', 'Sua sessão expirou!');
            redirect('login');
        }
        $this->load->view('layout/header', $data);
        $this->load->view('home/index');
        $this->load->view('layout/footer');
    }
}
