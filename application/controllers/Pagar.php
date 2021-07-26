<?php

defined('BASEPATH') or exit('Ação não permitida');

class Pagar extends CI_Controller
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
            'titulo' => 'Contas a Pagar',
            'styles' => [
                'vendor/datatables/dataTables.bootstrap4.min.css',
            ],

            'scripts' => [
                'vendor/datatables/jquery.dataTables.min.js',
                'vendor/datatables/dataTables.bootstrap4.min.js',
                'vendor/datatables/app.js',
            ],
            'contas_pagar' => $this->financeiro_model->get_all_pagar(),
        ];
        //echo '<pre>';
        //print_r($data['contas_pagar']);
        //exit();
        
        $this->load->view('layout/header', $data);
        $this->load->view('pagar/index');
        $this->load->view('layout/footer');
    }
    
   public function edit($conta_pagar_id = NULL) {
       
      if(!$conta_pagar_id || !$this->core_model->get_by_id('contas_pagar',['conta_pagar_id'=>$conta_pagar_id])){
         $this->session->set_flashdata('error', 'Conta não Encontrada!'); 
         redirect('pagar');
       } else {
            //Form Validation
            $this->form_validation->set_rules('conta_pagar_fornecedor_id','Fornecedor','trim|required');
            $this->form_validation->set_rules('conta_pagar_data_vencimento','Data de vencimento','trim|required');
            $this->form_validation->set_rules('conta_pagar_valor','Valor Conta','trim|required');
            $this->form_validation->set_rules('conta_pagar_obs','Observações','trim|max_length[255]');

            if($this->form_validation->run()){
               //exit('validado');
                $data = elements(
                        array(
                          'conta_pagar_fornecedor_id',
                          'conta_pagar_data_vencimento',  
                          'conta_pagar_valor',  
                          'conta_pagar_status',
                          'conta_pagar_obs',
 
                        ), $this->input->post()
                );
                $conta_pagar_status = $this->input->post('conta_pagar_status');
                if($conta_pagar_status == 1){
                    
                    $data['conta_pagar_data_pagamento'] = date('Y-m-d H:i:s');
                    
                }
                $data = html_escape($data);        
                
                $this->core_model->update('contas_pagar',$data, array('conta_pagar_id'=>$conta_pagar_id));
                
                redirect('pagar'); 
                    
                
            }else {
           
            $data = [
                'titulo' => 'Editar Conta a Pagar',
                'styles' => [
                    'vendor/select2/select2.min.css',
                ],

                'scripts' => [
                    'vendor/select2/select2.min.js',
                    'vendor/select2/app.js',
                    'vendor/mask/jquery.mask.min.js',
                    'vendor/mask/app.js',                
                ],
                'conta_pagar' => $this->core_model->get_by_id('contas_pagar',['conta_pagar_id'=>$conta_pagar_id]),
                'fornecedores' => $this->core_model->get_all('fornecedores'),
            ];
            //echo '<pre>';
            //print_r($data['contas_pagar']);
            //exit();

            $this->load->view('layout/header', $data);
            $this->load->view('pagar/edit');
            $this->load->view('layout/footer');                 
            }
                     
       }
       
   }
   
   public function add() {
       
            //Form Validation
            $this->form_validation->set_rules('conta_pagar_fornecedor_id','Fornecedor','trim|required');
            $this->form_validation->set_rules('conta_pagar_data_vencimento','Data de vencimento','trim|required');
            $this->form_validation->set_rules('conta_pagar_valor','Valor Conta','trim|required');
            $this->form_validation->set_rules('conta_pagar_status','Situação','trim|required');
            $this->form_validation->set_rules('conta_pagar_obs','Observações','trim|max_length[255]');

            if($this->form_validation->run()){
               //exit('validado');
                $data = elements(
                        array(
                          'conta_pagar_fornecedor_id',
                          'conta_pagar_data_vencimento',  
                          'conta_pagar_valor',  
                          'conta_pagar_status',
                          'conta_pagar_obs',
 
                        ), $this->input->post()
                );
                $conta_pagar_status = $this->input->post('conta_pagar_status');
                if($conta_pagar_status == 1){
                    
                    $data['conta_pagar_data_pagamento'] = date('Y-m-d H:i:s');
                    
                }
                $data = html_escape($data);        
                
                $this->core_model->insert('contas_pagar',$data);
                
                redirect('pagar'); 
                    
                
            }else {
           
            $data = [
                'titulo' => 'Cadastrando Conta a Pagar',
                'styles' => [
                    'vendor/select2/select2.min.css',
                ],

                'scripts' => [
                    'vendor/select2/select2.min.js',
                    'vendor/select2/app.js',
                    'vendor/mask/jquery.mask.min.js',
                    'vendor/mask/app.js',                
                ],
                 'fornecedores' => $this->core_model->get_all('fornecedores'),
            ];
            //echo '<pre>';
            //print_r($data['contas_pagar']);
            //exit();

            $this->load->view('layout/header', $data);
            $this->load->view('pagar/add');
            $this->load->view('layout/footer');                 
            }
       
   }   
   
    //FUNÇÃO PARA DELETAR
    public function del($conta_pagar_id = null)
    {
        if (!$conta_pagar_id || !$this->core_model->get_by_id('contas_pagar', ['conta_pagar_id' => $conta_pagar_id])) {
            $this->session->set_flashdata('error', 'Conta não encontrada');
            redirect('pagar');
        } 
         if ($this->core_model->get_by_id('contas_pagar', ['conta_pagar_id' => $conta_pagar_id, 'conta_pagar_status'=> 0])) {
            $this->session->set_flashdata('info', 'Esta conta não pode ser excluida, pois não foi paga!!');
            redirect('pagar');
        } 
         $this->core_model->delete('contas_pagar', ['conta_pagar_id' => $conta_pagar_id]);
         //$this->session->set_flashdata('sucesso', 'Conta Apagada!!');
         redirect('pagar');
        
    }     

}