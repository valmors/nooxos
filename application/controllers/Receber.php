<?php

defined('BASEPATH') or exit('Ação não permitida');

class receber extends CI_Controller
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
            'titulo' => 'Contas a Receber',
            'styles' => [
                'vendor/datatables/dataTables.bootstrap4.min.css',
            ],

            'scripts' => [
                'vendor/datatables/jquery.dataTables.min.js',
                'vendor/datatables/dataTables.bootstrap4.min.js',
                'vendor/datatables/app.js',
            ],
            'contas_receber' => $this->financeiro_model->get_all_receber(),
        ];
        //echo '<pre>';
        //print_r($data['contas_receber']);
        //exit();
        
        $this->load->view('layout/header', $data);
        $this->load->view('receber/index');
        $this->load->view('layout/footer');
    }
    
   public function edit($conta_receber_id = NULL) {
       
      if(!$conta_receber_id || !$this->core_model->get_by_id('contas_receber',['conta_receber_id'=>$conta_receber_id])){
         $this->session->set_flashdata('error', 'Conta não Encontrada!'); 
         redirect('rerceber');
       } else {
            //Form Validation
            $this->form_validation->set_rules('conta_receber_cliente_id','Cliente','trim|required');
            $this->form_validation->set_rules('conta_receber_data_vencto','Data de vencimento','trim|required');
            $this->form_validation->set_rules('conta_receber_valor','Valor Conta','trim|required');
            $this->form_validation->set_rules('conta_receber_obs','Observações','trim|max_length[255]');

            if($this->form_validation->run()){
               //exit('validado');
                $data = elements(
                        array(
                          'conta_receber_cliente_id',
                          'conta_receber_data_vencto',  
                          'conta_receber_valor',  
                          'conta_receber_status',
                          'conta_receber_obs',
 
                        ), $this->input->post()
                );
                $conta_receber_status = $this->input->post('conta_receber_status');
                if($conta_receber_status == 1){
                    
                    $data['conta_receber_data_pagamento'] = date('Y-m-d H:i:s');
                    
                }
                $data = html_escape($data);        
                
                $this->core_model->update('contas_receber',$data, array('conta_receber_id'=>$conta_receber_id));
                
                redirect('receber'); 
                    
                
            }else {
           
            $data = [
                'titulo' => 'Editar Conta a Receber',
                'styles' => [
                    'vendor/select2/select2.min.css',
                ],

                'scripts' => [
                    'vendor/select2/select2.min.js',
                    'vendor/select2/app.js',
                    'vendor/mask/jquery.mask.min.js',
                    'vendor/mask/app.js',                
                ],
                'conta_receber' => $this->core_model->get_by_id('contas_receber',['conta_receber_id'=>$conta_receber_id]),
                'clientes' => $this->core_model->get_all('clientes',['cliente_ativo'=>1]),
            ];
            //echo '<pre>';
            //print_r($data['contas_receber']);
            //exit();

            $this->load->view('layout/header', $data);
            $this->load->view('receber/edit');
            $this->load->view('layout/footer');                 
            }
                     
       }
       
   }
   
   public function add() {
       
            //Form Validation
            $this->form_validation->set_rules('conta_receber_cliente_id','Cliente','trim|required');
            $this->form_validation->set_rules('conta_receber_data_vencto','Data de vencimento','trim|required');
            $this->form_validation->set_rules('conta_receber_valor','Valor Conta','trim|required');
            $this->form_validation->set_rules('conta_receber_status','Situação','trim|required');
            $this->form_validation->set_rules('conta_receber_obs','Observações','trim|max_length[255]');

            if($this->form_validation->run()){
               //exit('validado');
                $data = elements(
                        array(
                          'conta_receber_cliente_id',
                          'conta_receber_data_vencto',  
                          'conta_receber_valor',  
                          'conta_receber_status',
                          'conta_receber_obs',
 
                        ), $this->input->post()
                );
                $conta_receber_status = $this->input->post('conta_receber_status');
                if($conta_receber_status == 1){
                    
                    $data['conta_receber_data_pagamento'] = date('Y-m-d H:i:s');
                    
                }
                $data = html_escape($data);        
                
                $this->core_model->insert('contas_receber',$data);
                
                redirect('receber'); 
                    
                
            }else {
           
            $data = [
                'titulo' => 'Cadastrando Conta a Receber',
                'styles' => [
                    'vendor/select2/select2.min.css',
                ],

                'scripts' => [
                    'vendor/select2/select2.min.js',
                    'vendor/select2/app.js',
                    'vendor/mask/jquery.mask.min.js',
                    'vendor/mask/app.js',                
                ],
                 'clientes' => $this->core_model->get_all('clientes'),
            ];
            //echo '<pre>';
            //print_r($data['contas_receber']);
            //exit();

            $this->load->view('layout/header', $data);
            $this->load->view('receber/add');
            $this->load->view('layout/footer');                 
            }
       
   }   
   
    //FUNÇÃO PARA DELETAR
    public function del($conta_receber_id = null)
    {
        if (!$conta_receber_id || !$this->core_model->get_by_id('contas_receber', ['conta_receber_id' => $conta_receber_id])) {
            $this->session->set_flashdata('error', 'Conta não encontrada ');
            redirect('rerceber');
        } 
         if ($this->core_model->get_by_id('contas_receber', ['conta_receber_id' => $conta_receber_id, 'conta_receber_status'=> 0])) {
            $this->session->set_flashdata('info', 'Esta conta não pode ser excluida, pois não foi paga!!');
            redirect('rerceber');
        } 
         $this->core_model->delete('contas_receber', ['conta_receber_id' => $conta_receber_id]);
         //$this->session->set_flashdata('sucesso', 'Conta Apagada!!');
         redirect('rerceber');
        
    }     

}