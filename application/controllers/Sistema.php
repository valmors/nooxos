<?php

defined('BASEPATH') or exit('Ação não permitida');

class Sistema extends CI_Controller
{
    public function __contruct()
    {
        if (!$this->ion_auth->logged_in()) {
            $this->session->set_flashdata('info', 'Sua sessão expirou!');
            redirect('login');
        }
    }

    public function index()
    {
        if (!$this->ion_auth->is_admin()) {
            $this->session->set_flashdata('error', 'Você precisa ser administrador para acessar esta página!');
            redirect('Home');
        }
        $data = [
            'titulo' => 'Editar Informações do sistema',
            'scripts' => [
                'vendor/mask/jquery.mask.min.js',
                'vendor/mask/app.js',
                'vendor/ViaCep/viacep.js',
            ],
            'sistema' => $this->core_model->get_by_id('sistema', ['sistema_id' => 1]),
        ];

        $this->form_validation->set_rules('sistema_razao_social', 'Razão Social', 'required|min_length[10]|max_length[145]');
        $this->form_validation->set_rules('sistema_nome_fantasia', 'Nome Fantasia', 'required|min_length[10]|max_length[145]');
        $this->form_validation->set_rules('sistema_cnpj', 'CNPJ', 'required|exact_length[18]');
        $this->form_validation->set_rules('sistema_ie', 'IE', 'max_length[25]');
        $this->form_validation->set_rules('telefone_fixo', 'Tel. Fixo', 'max_length[25]');
        $this->form_validation->set_rules('telefone_movel', 'Tel. Cel', 'max_length[25]');
        $this->form_validation->set_rules('sistema_email', 'Email', 'required|valid_email|max_length[100]');
        $this->form_validation->set_rules('sistema_site_url', 'Site', 'valid_url|max_length[100]');
        $this->form_validation->set_rules('sistema_cep', 'CEP', 'required|exact_length[9]');
        $this->form_validation->set_rules('sistema_endereco', 'Endereço', 'required|max_length[145]');
        $this->form_validation->set_rules('sistema_bairro', 'Bairro', 'required|max_length[100]');
        $this->form_validation->set_rules('sistema_numero', 'Numero', 'max_length[25]');
        $this->form_validation->set_rules('sistema_cidade', 'Cidade', 'required|max_length[45]');
        $this->form_validation->set_rules('sistema_estado', 'Estado', 'required|exact_length[2]');
        $this->form_validation->set_rules('sistema_txt_ordem_servico', 'Texto da Ordem', 'max_length[500]');

        if ($this->form_validation->run()) {
            $data = elements(
                [
                    'sistema_razao_social',
                    'sistema_nome_fantasia',
                    'sistema_cnpj',
                    'sistema_ie',
                    'sistema_telefone_fixo',
                    'sistema_telefone_movel',
                    'sistema_email',
                    'sistema_site_url',
                    'sistema_cep',
                    'sistema_endereco',
                    'sistema_bairro',
                    'sistema_numero',
                    'sistema_cidade',
                    'sistema_estado',
                    'sistema_txt_ordem_servico',
                ], $this->input->post()
            );

            $data = html_escape($data);
            $this->core_model->update('sistema', $data, ['sistema_id' => 1]);

            redirect('sistema');
        } else {
            $this->load->view('layout/header', $data);
            $this->load->view('sistema/index');
            $this->load->view('layout/footer');
        }

        /*echo '<pre>';
        print_r($data['sistema']);
        exit();
        [sistema_id] => 1
        [sistema_razao_social] => NOOX Ordem de Serviço
        [sistema_nome_fantasia] => NOOX Ordem de Serviço
        [sistema_cnpj] => 58.681.759/0001-67
        [sistema_ie] =>
        [sistema_telefone_fixo] =>
        [sistema_telefone_movel] =>
        [sistema_email] => contato@nooxbrasil.com.br
        [sistema_site_url] => nooxbrasil.com.br
        [sistema_cep] => 18143660
        [sistema_endereco] => Rua Dirceu Pereira de Andrade
        [sistema_numero] => 513
        [sistema_cidade] => São Roque
        [sistema_estado] => SP
        [sistema_txt_ordem_servico] =>
        [sistema_data_alteracao] => 2021-04-18 10:14:03
        */
    }
}
