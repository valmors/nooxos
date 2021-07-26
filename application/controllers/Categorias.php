<?php

defined('BASEPATH') or exit('Ação não permitida');

class Categorias extends CI_Controller
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
            'titulo' => 'Categorias',
            'styles' => [
                'vendor/datatables/dataTables.bootstrap4.min.css',
            ],

            'scripts' => [
                'vendor/datatables/jquery.dataTables.min.js',
                'vendor/datatables/dataTables.bootstrap4.min.js',
                'vendor/datatables/app.js',
            ],
            'categorias' => $this->core_model->get_all('categorias'),
        ];
        
        
        $this->load->view('layout/header', $data);
        $this->load->view('categorias/index');
        $this->load->view('layout/footer');
    }
    
    public function edit($categoria_id = NULL)
    {
        if (!$categoria_id || !$this->core_model->get_by_id('categorias', array('categoria_id' => $categoria_id))) {
            $this->session->set_flashdata('error', 'Marca não encontrado');
            redirect('categorias');
        } else {
           
            $this->form_validation->set_rules('categoria_nome', 'Marca', 'trim|required|min_length[2]|max_length[145]|callback_check_nome');             

            if ($this->form_validation->run()) {
            
                $categoria_ativa = $this->input->post('categoria_ativa');
                if($this->db->table_exists('produtos')){
                    if($categoria_ativa == 0 && $this->core_model->get_by_id('produtos',array('produto_categoria_id'=>$categoria_id,'produto_ativo'=>1))){
                     $this->session->set_flashdata('info', 'Esta categoria não pode ser desativa por que existe um produto relacionado!');
                    redirect('categorias');   
                    }
                }
                

                $data = elements(
                        
                    [   'categoria_nome',
                        'categoria_ativa',
                        'categoria_id',
                    ], $this->input->post()
                );     

                $data = html_escape($data);

                $this->core_model->update('categorias', $data, ['categoria_id' => $categoria_id]);

                redirect('categorias');

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
                    'categorias' => $this->core_model->get_by_id('categorias', ['categoria_id' => $categoria_id]),
                ];

                $this->load->view('layout/header', $data);
                $this->load->view('categorias/edit');
                $this->load->view('layout/footer');
            }
            
        }
    }
    
     public function add()
    {                
            $this->form_validation->set_rules('categoria_nome', 'Marca', 'trim|required|min_length[2]|max_length[145]|is_unique[categorias.categoria_nome]');


            if ($this->form_validation->run()) {
                
               // exit('validado');

                $data = elements(
                        
                    [   'categoria_nome',
                        'categoria_ativa',
                        'categoria_id',
                    ], $this->input->post()
                );     

                $data = html_escape($data);

                $this->core_model->insert('categorias', $data);

                redirect('categorias');

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
                $this->load->view('categorias/add');
                $this->load->view('layout/footer');
            }
            
        
    }
      
 
    public function del($categoria_id = null)
    {
        if (!$categoria_id || !$this->core_model->get_by_id('categorias', ['categoria_id' => $categoria_id])) {
            $this->session->set_flashdata('error', 'Marca não Encontrado');
            redirect('categorias');
        } else {
            $this->core_model->delete('categorias', ['categoria_id' => $categoria_id]);
            redirect('categorias');
        }
    }
    //NOme Compoleto
    public function check_nome($categoria_nome) 
    {
        $categoria_id = $this->input->post('categoria_id');

        if ($this->core_model->get_by_id('categorias', ['categoria_nome' => $categoria_nome, 'categoria_id !=' => $categoria_id])) {
            $this->form_validation->set_message('check_nome', 'Esta Serviço Já Existe!');

            return false;
        } else {
            return true;
        }
    }
   
     

}