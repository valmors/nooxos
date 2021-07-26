<?php
defined('BASEPATH') or exit('Ação não permitida');

class Formas_pagamentos extends CI_Controller
{
    public function __contruct()
    {
        parent::__contruct();
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
            'titulo' => 'Formas de Pagamentos Cadastradas',
            'styles' => [
                'vendor/datatables/dataTables.bootstrap4.min.css',
            ],

            'scripts' => [
                'vendor/datatables/jquery.dataTables.min.js',
                'vendor/datatables/dataTables.bootstrap4.min.js',
                'vendor/datatables/app.js',
            ],
            'formas_pagamentos' => $this->core_model->get_all('formas_pagamentos'),
        ];
        //echo '<pre>';
        //print_r($data['formas_pagamentos']);
        //exit();
        
        $this->load->view('layout/header', $data);
        $this->load->view('formas_pagamentos/index');
        $this->load->view('layout/footer');
    }
    //adicionando uma forma de pagamento
    public function add($forma_pagamento_id = NULL)
    {

        
        $this->form_validation->set_rules('forma_pagamento_nome','Nome da Forma de Pagamento','trim|required|min_length[5]|max_length[45]|is_unique[formas_pagamentos.forma_pagamento_nome]');
        //$this->form_validation->set_rules('');
        if($this->form_validation->run()){
            
        
            $data = elements(
                    [   
                        'forma_pagamento_nome',
                        'forma_pagamento_ativa',
                        'forma_pagamento_aceita_parc',
                        
                    ], $this->input->post()
            );
            $data = html_escape($data);
            
            $this->core_model->insert('formas_pagamentos', $data);
            redirect('modulo');
            
        }else {
            //erro de validação
        $data = [
            'titulo' => 'Cadastrar formas de Pagamentos',
            
        ];
        //echo '<pre>';
        //print_r($data['formas_pagamentos']);
        //exit();
        
        $this->load->view('layout/header', $data);
        $this->load->view('formas_pagamentos/add');
        $this->load->view('layout/footer');             
        }
    }    
    //editando a forma de pagamento
    public function edit($forma_pagamento_id = NULL)
    {
        if(!$forma_pagamento_id || !$this->core_model->get_by_id('formas_pagamentos',['forma_pagamento_id'=>$forma_pagamento_id])){
            $this->session->set_flashdata('error','Forma de pagamento não encontrado');
            redirect('modulo');            
        }else{
        
        $this->form_validation->set_rules('forma_pagamento_nome','Nome da Forma de Pagamento','trim|required|min_length[5]|max_length[45]|callback_check_pagamento_nome');
        //$this->form_validation->set_rules('');
        if($this->form_validation->run()){
            
            $forma_pagamento_ativo = $this->input->post('form_pagamento_ativa');
            //para vendas
            if($this->db->table_exists('vendas')){
                if($forma_pagamento_ativo == 0 && $this->core_model('vendas',['vendas_forma_pagamento_id'=> $forma_pagamento_id, 'venda_status'=>0])){
                    $this->session->set_flashdata('info','Forma de pagamento não pode ser desativada, esta sendo utilizada em vendas!');
                    redirect('modulo');
                }
            }
            //para vendas
            if($this->db->table_exists('ordem_serviços')){
                if($forma_pagamento_ativo == 0 && $this->core_model('ordem_serviços',['ordem_serviço_forma_pagamento_id'=> $forma_pagamento_id, 'ordem_servico_status' => 0])){
                    $this->session->set_flashdata('info','Forma de pagamento não pode ser desativada, esta sendo utilizada em Ordem de Serviço!');
                    redirect('modulo');
                }                
            }
            $data = elements(
                    [   
                        'forma_pagamento_nome',
                        'forma_pagamento_ativa',
                        'forma_pagamento_aceita_parc',
                        
                    ], $this->input->post()
            );
            $data = html_escape($data);
            
            $this->core_model->update('formas_pagamentos', $data,['forma_pagamento_id'=>$forma_pagamento_id]);
            redirect('modulo');
            
        }else {
            //erro de validação
        $data = [
            'titulo' => 'Editar formas de Pagamentos',
            'forma_pagamento'=>$this->core_model->get_by_id('formas_pagamentos',['forma_pagamento_id'=>$forma_pagamento_id]),
            
        ];
        //echo '<pre>';
        //print_r($data['formas_pagamentos']);
        //exit();
        
        $this->load->view('layout/header', $data);
        $this->load->view('formas_pagamentos/edit');
        $this->load->view('layout/footer');             
        }
           
        }
    }
    //verifica o nome do pagamento para que não seja igual
    public function check_pagamento_nome($forma_pagamento_nome) 
    {
        $forma_pagamento_id = $this->input->post('forma_pagamento_id');

        if ($this->core_model->get_by_id('formas_pagamentos', ['forma_pagamento_nome' => $forma_pagamento_nome, 'forma_pagamento_id !=' => $forma_pagamento_id])) {
            $this->form_validation->set_message('check_pagamento_nome', 'Esta Forma de pagamento já existe Já Existe!');

            return false;
        } else {
            return true;
        }
    }
    //FUNÇÃO PARA DELETAR
    public function del($forma_pagamento_id = null)
    {
        if (!$forma_pagamento_id || !$this->core_model->get_by_id('formas_pagamentos', ['forma_pagamento_id' => $forma_pagamento_id])) {
            $this->session->set_flashdata('error', 'Conta não encontrada');
            redirect('modulo');
        } 
         if ($this->core_model->get_by_id('formas_pagamentos', ['forma_pagamento_id' => $forma_pagamento_id, 'forma_pagamento_ativa'=> 1])) {
            $this->session->set_flashdata('info', 'Esta Forma de pagamento não pode ser excluida, pois esta ativa!!');
            redirect('modulo');
        } 
         $this->core_model->delete('formas_pagamentos', ['forma_pagamento_id' => $forma_pagamento_id]);
         //$this->session->set_flashdata('sucesso', 'Conta Apagada!!');
         redirect('modulo');
        
    } 
}