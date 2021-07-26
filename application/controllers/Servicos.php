<?php

defined('BASEPATH') or exit('Ação não permitida');

class Servicos extends CI_Controller
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
            'titulo' => 'Serviços',
            'styles' => [
                'vendor/datatables/dataTables.bootstrap4.min.css',
            ],

            'scripts' => [
                'vendor/datatables/jquery.dataTables.min.js',
                'vendor/datatables/dataTables.bootstrap4.min.js',
                'vendor/datatables/app.js',
            ],
            'servicos' => $this->core_model->get_all('servicos'),
        ];
        
        
        $this->load->view('layout/header', $data);
        $this->load->view('servicos/index');
        $this->load->view('layout/footer');
    }
    
    public function edit($servico_id = NULL)
    {
        if (!$servico_id || !$this->core_model->get_by_id('servicos', array('servico_id' => $servico_id))) {
            $this->session->set_flashdata('error', 'Serviço não encontrado');
            redirect('servicos');
        } else {
           
            $this->form_validation->set_rules('servico_nome', 'Serviço', 'trim|required|min_length[10]|max_length[145]|callback_check_nome');
            $this->form_validation->set_rules('servico_preco', 'Preço', 'trim|required|max_length[15]');
            $this->form_validation->set_rules('servico_descricao', 'Descrição ', 'trim|required|min_length[10]|max_length[700]');  


            if ($this->form_validation->run()) {
                
                //exit('validado');

                $data = elements(
                        
                    [   'servico_nome',
                        'servico_preco',
                        'servico_descricao',
                        'servico_ativo',
                        'servico_id',
                    ], $this->input->post()
                );     

                $data = html_escape($data);

                $this->core_model->update('servicos', $data, ['servico_id' => $servico_id]);

                redirect('servicos');

            /* echo '<pre>';
             print_r($data);
             exit();*/
            } else {
                //erro de validção

                $data = [
                    'titulo' => 'Atualizar Serviços',
                    'scripts' => [
                        'vendor/mask/jquery.mask.min.js',
                        'vendor/mask/app.js',

                    ],
                    'servicos' => $this->core_model->get_by_id('servicos', ['servico_id' => $servico_id]),
                ];
                /*;
                echo '<pre>';
                print_r($data['fornecedor']);
                exit();
                */
                $this->load->view('layout/header', $data);
                $this->load->view('servicos/edit');
                $this->load->view('layout/footer');
            }
            
        }
    }
    
     public function add()
    {
                
            $this->form_validation->set_rules('servico_nome', 'Serviço', 'trim|required|min_length[10]|max_length[145]|is_unique[servicos.servico_nome]');
            $this->form_validation->set_rules('servico_preco', 'Preço', 'trim|required|max_length[15]');
            $this->form_validation->set_rules('servico_descricao', 'Descrição ', 'trim|required|min_length[10]|max_length[700]');  


            if ($this->form_validation->run()) {
                
               // exit('validado');

                $data = elements(
                        
                    [   'servico_nome',
                        'servico_preco',
                        'servico_descricao',
                        'servico_ativo',
                        'servico_id',
                    ], $this->input->post()
                );     

                $data = html_escape($data);

                $this->core_model->insert('servicos', $data);

                redirect('servicos');

            /* echo '<pre>';
             print_r($data);
             exit();*/
            } else {
                //erro de validção

                $data = [
                    'titulo' => 'Cadastrar Serviços',
                    'scripts' => [
                        'vendor/mask/jquery.mask.min.js',
                        'vendor/mask/app.js',

                    ],
                    
                ];
                /*;
                echo '<pre>';
                print_r($data['fornecedor']);
                exit();
                */
                $this->load->view('layout/header', $data);
                $this->load->view('servicos/add');
                $this->load->view('layout/footer');
            }
            
        
    }
      
 
    public function del($servico_id = null)
    {
        if (!$servico_id || !$this->core_model->get_by_id('servicos', ['servico_id' => $servico_id])) {
            $this->session->set_flashdata('error', 'Vendedor não Encontrado');
            redirect('servicos');
        } else {
            $this->core_model->delete('servicos', ['servico_id' => $servico_id]);
            redirect('servicos');
        }
    }
    //NOme Compoleto
    public function check_nome($servico_nome) 
    {
        $servico_id = $this->input->post('servico_id');

        if ($this->core_model->get_by_id('servicos', ['servico_nome' => $servico_nome, 'servico_id !=' => $servico_id])) {
            $this->form_validation->set_message('check_nome', 'Esta Serviço Já Existe!');

            return false;
        } else {
            return true;
        }
    }
   
     

}