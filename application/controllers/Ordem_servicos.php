<?php

defined('BASEPATH') or exit('Ação não permitida');

class Ordem_servicos extends CI_Controller
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
            'titulo' => 'Oderm de Serviços Cadastradas',
            'styles' => [
                'vendor/datatables/dataTables.bootstrap4.min.css',
            ],

            'scripts' => [
                'vendor/datatables/jquery.dataTables.min.js',
                'vendor/datatables/dataTables.bootstrap4.min.js',
                'vendor/datatables/app.js',
            ],
            'ordens_servicos'=>$this->ordem_servicos_model->get_all(),
        ];
       // echo '<pre>';
       // print_r($data['ordens_servicos']);
       // exit();
        
        $this->load->view('layout/header', $data);
        $this->load->view('Ordem_servicos/index');
        $this->load->view('layout/footer');
    }
    
    public function edit($ordem_servico_id = NULL){

        if (!$ordem_servico_id || !$this->core_model->get_by_id('ordens_servicos',array('ordem_servico_id' => $ordem_servico_id))){
            $this->session->set_flashdata('error', 'Ordem de Serviço não encontrada');
            redirect('os');
        }else{
            
            //form_validatiom
            $this->form_validation->set_rules('ordem_servico_cliente_id','','required');
            $this->form_validation->set_rules('ordem_servico_forma_pagamento_id','','required');
            $this->form_validation->set_rules('ordem_servico_equipamento','Equipamento','trim|required');
            $this->form_validation->set_rules('ordem_servico_marca_equipamento','Marca','trim|required|min_length[2]|max_length[80]');
            $this->form_validation->set_rules('ordem_servico_modelo_equipamento','Modelo','trim|required|min_length[2]|max_length[80]');
            $this->form_validation->set_rules('ordem_servico_acessorios','Acessorios','trim|required|max_length[300]');
            $this->form_validation->set_rules('ordem_servico_defeito','Defeito','trim|required|max_length[700]');
            
           if($this->form_validation->run()){
               
               
               
           } else {
              //erro de validação
                $data = [
                         'titulo' => 'Atualizar Oderm de Serviços',
                         'styles' => [
                             'vendor/select2/select2.min.css',
                             'vendor/autocomplete/jquery-ui.css',
                             'vendor/autocomplete/estilo.css',
                         ],

                         'scripts' => [
                             'vendor/autocomplete/jquery-migrate.js',
                             'vendor/calcx/jquery-calx-sample-2.2.8.min.js',
                             'vendor/calcx/os.js',
                             'vendor/select2/select2.min.js',
                             'vendor/select2/app.js',
                             'vendor/sweetalert2/sweetalert2.js',
                             'vendor/autocomplete/jquery-ui.js',
                         ],

                         'clientes' => $this->core_model->get_all('clientes',array('cliente_ativo'=>1)),
                         'formas_pagamentos' => $this->core_model->get_all('formas_pagamentos',array('forma_pagamento_ativa'=>1)),
                         'os_tem_servicos' => $this->ordem_servicos_model->get_all_servicos_by_ordem($ordem_servico_id),

                         //$ordem_servico = 'ordem_servico'=>$this->ordem_servicos_model->get_by_id($ordem_servico_id),
                 ];
                 $ordem_servico = $data['ordem_servico'] = $this->ordem_servicos_model->get_by_id($ordem_servico_id);
                     //echo '<pre>';
                     //print_r($data['ordem_servico']);
                     //exit();

                 $this->load->view('layout/header', $data);
                 $this->load->view('Ordem_servicos/edit');
                 $this->load->view('layout/footer');              
               
           }
                       

        }
        
        
        
    }
    
}