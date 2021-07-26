<?php

defined('BASEPATH') or exit('Ação não permitida');

class Marcas extends CI_Controller
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
            'titulo' => 'Marcas',
            'styles' => [
                'vendor/datatables/dataTables.bootstrap4.min.css',
            ],

            'scripts' => [
                'vendor/datatables/jquery.dataTables.min.js',
                'vendor/datatables/dataTables.bootstrap4.min.js',
                'vendor/datatables/app.js',
            ],
            'marcas' => $this->core_model->get_all('marcas'),
        ];
        
        
        $this->load->view('layout/header', $data);
        $this->load->view('marcas/index');
        $this->load->view('layout/footer');
    }
    
    public function edit($marca_id = NULL)
    {
        if (!$marca_id || !$this->core_model->get_by_id('marcas', array('marca_id' => $marca_id))) {
            $this->session->set_flashdata('error', 'Marca não encontrado');
            redirect('marcas');
        } else {
           
            $this->form_validation->set_rules('marca_nome', 'Marca', 'trim|required|min_length[2]|max_length[145]|callback_check_nome');             

            if ($this->form_validation->run()) {
                
                $marca_ativa = $this->input->post('marca_ativa');
                if($this->db->table_exists('produtos')){
                    
                    if($marca_ativa == 0 && $this->core_model->get_by_id('produtos',array('produto_marca_id'=>$marca_id,'produto_ativo'=>1))){
                     $this->session->set_flashdata('info', 'Esta Marca não pode ser desativa por que existe um produto relacionado!');
                    redirect('marcas');   
                    }
                }
                               
                
                $data = elements(
                        
                    [   'marca_nome',
                        'marca_ativa',
                        'marca_id',
                    ], $this->input->post()
                );     

                $data = html_escape($data);

                $this->core_model->update('marcas', $data, ['marca_id' => $marca_id]);

                redirect('marcas');

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
                    'marcas' => $this->core_model->get_by_id('marcas', ['marca_id' => $marca_id]),
                ];

                $this->load->view('layout/header', $data);
                $this->load->view('marcas/edit');
                $this->load->view('layout/footer');
            }
            
        }
    }
    
     public function add()
    {                
            $this->form_validation->set_rules('marca_nome', 'Marca', 'trim|required|min_length[2]|max_length[145]|is_unique[marcas.marca_nome]');


            if ($this->form_validation->run()) {
                
               // exit('validado');

                $data = elements(
                        
                    [   'marca_nome',
                        'marca_ativa',
                        'marca_id',
                    ], $this->input->post()
                );     

                $data = html_escape($data);

                $this->core_model->insert('marcas', $data);

                redirect('marcas');

            /* echo '<pre>';
             print_r($data);
             exit();*/
            } else {
                //erro de validção

                $data = [
                    'titulo' => 'Cadastrar nova Marca',
                    'scripts' => [
                        'vendor/mask/jquery.mask.min.js',
                        'vendor/mask/app.js',

                    ],
                    
                ];
 
                $this->load->view('layout/header', $data);
                $this->load->view('marcas/add');
                $this->load->view('layout/footer');
            }
            
        
    }
      
 
    public function del($marca_id = null)
    {
        if (!$marca_id || !$this->core_model->get_by_id('marcas', ['marca_id' => $marca_id])) {
            $this->session->set_flashdata('error', 'Marca não Encontrado');
            redirect('marcas');
        } else {
            $this->core_model->delete('marcas', ['marca_id' => $marca_id]);
            redirect('marcas');
        }
    }
    //NOme Compoleto
    public function check_nome($marca_nome) 
    {
        $marca_id = $this->input->post('marca_id');

        if ($this->core_model->get_by_id('marcas', ['marca_nome' => $marca_nome, 'marca_id !=' => $marca_id])) {
            $this->form_validation->set_message('check_nome', 'Esta Serviço Já Existe!');

            return false;
        } else {
            return true;
        }
    }
   
     

}