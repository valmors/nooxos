<?php

defined('BASEPATH') or exit('Ação não permitida');

class Produtos extends CI_Controller
{
    public function __contruct()
    {
        parent::__contruct();
        if (!$this->ion_auth->logged_in()) {
            $this->session->set_flashdata('info', 'Sua sessão expirou!');
            redirect('login');
        }
        
       // $this->load->model('produtos_model');
    }

    public function index()
    {
        if (!$this->ion_auth->is_admin()) {
            $this->session->set_flashdata('error', 'Você precisa ser administrador para acessar esta página!');
            redirect('Home');
        }
        $data = [
            'titulo' => 'Produtos Cadastrados',
            'styles' => [
                'vendor/datatables/dataTables.bootstrap4.min.css',
            ],

            'scripts' => [
                'vendor/datatables/jquery.dataTables.min.js',
                'vendor/datatables/dataTables.bootstrap4.min.js',
                'vendor/datatables/app.js',
            ],
            'produtos' => $this->produtos_model->get_all(),
        ];
       // echo "<pre>";
       // print_r($data['produtos']);
       // exit();
        
        
        $this->load->view('layout/header', $data);
        $this->load->view('produtos/index');
        $this->load->view('layout/footer');
    }
    
    public function edit($produto_id = NULL){
        
        if(!$produto_id || !$this->core_model->get_by_id('produtos', array('produto_id'=>$produto_id))){      
            $this->session->set_flashdata('error','Produto não encontrado');
            redirect('produtos');
        } else{
            $this->form_validation->set_rules('produto_foto','Foto','trim');
            $this->form_validation->set_rules('produto_codigo','Código de Barras','trim|required|callback_check_codbarra');
            $this->form_validation->set_rules('produto_unidade','Unidade','trim|required');
            $this->form_validation->set_rules('produto_descricao','Produto','trim|required|min_length[5]|max_length[145]|callback_check_nomep');
            $this->form_validation->set_rules('produto_preco_custo','Preço de Custo','trim|required|max_length[45]');
            $this->form_validation->set_rules('produto_preco_venda','Preço de Venda','trim|required|max_length[45]|callback_check_produto_precov');
            $this->form_validation->set_rules('produto_estoque_minimo','Qtde Minima','trim|required|greater_than_equal_to[0]');
            $this->form_validation->set_rules('produto_qtde_estoque','Qtde Estoque','trim|required');
            $this->form_validation->set_rules('produto_obs','Observações','trim|max_length[500]');
            
            if($this->form_validation->run()){
                
                $data = elements(
                        array(
                          'produto_codigo',
                          'produto_categoria_id',
                          'produto_marca_id',
                          'produto_fornecedor_id',
                          'produto_descricao',  
                          'produto_unidade',  
                          'produto_preco_custo',
                          'produto_preco_venda',
                          'produto_estoque_minimo',
                          'produto_qtde_estoque',
                          'produto_ativo',
                          'produto_obs',
 
                        ), $this->input->post()
                );
         
                $data = html_escape($data);        
                $this->core_model->update('produtos',$data, array('produto_id'=>$produto_id));
                redirect('produtos');                     
               
                
            }else{
                
                //Erro de validação
                
                $data = [
                    'titulo' => 'Atualizar Produtos',
                    'scripts' => [
                        'vendor/datatables/jquery.dataTables.min.js',
                        'vendor/datatables/dataTables.bootstrap4.min.js',
                        'vendor/datatables/app.js',
                        'vendor/mask/jquery.mask.min.js',
                        'vendor/mask/app.js',
                    ],
                     'produtos' => $this->core_model->get_by_id('produtos',array('produto_id'=> $produto_id)),
                     'marcas' => $this->core_model->get_all('marcas',array('marca_ativa'=>1)),
                     'categorias' => $this->core_model->get_all('categorias',array('categoria_ativa'=>1)),                    
                     'fornecedores' => $this->core_model->get_all('fornecedores',array('fornecedor_ativo'=>1)),
                ];

                //echo "<pre>";
                //print_r($data['produtos']);
                //exit();

                $this->load->view('layout/header', $data);
                $this->load->view('produtos/edit');
                $this->load->view('layout/footer');                  

            }
            
                      
        }
    }
    public function add(){
            
            $this->form_validation->set_rules('produto_codigo','Código de Barras','trim|required|is_unique[produtos.produto_codigo]');
            $this->form_validation->set_rules('produto_unidade','Unidade','trim|required');
            $this->form_validation->set_rules('produto_descricao','Produto','trim|required|min_length[5]|max_length[145]|is_unique[produtos.produto_descricao]');
            $this->form_validation->set_rules('produto_preco_custo','Preço de Custo','trim|required|max_length[45]');
            $this->form_validation->set_rules('produto_preco_venda','Preço de Venda','trim|required|max_length[45]|callback_check_produto_precov');
            $this->form_validation->set_rules('produto_estoque_minimo','Qtde Minima','trim|required|greater_than_equal_to[0]');
            $this->form_validation->set_rules('produto_qtde_estoque','Qtde Estoque','trim|required');
            $this->form_validation->set_rules('produto_obs','Observações','trim|max_length[500]');
            
            if($this->form_validation->run()){
                
                
                $data = elements(
                        array(
                          'produto_codigo',
                          'produto_categoria_id',
                          'produto_marca_id',
                          'produto_fornecedor_id',
                          'produto_descricao', 
                          'produto_unidade',  
                          'produto_preco_custo',
                          'produto_preco_venda',
                          'produto_estoque_minimo',
                          'produto_qtde_estoque',
                          'produto_ativo',
                          'produto_obs',
 
                        ), $this->input->post()
                );
                $produto_codigo  = $this->input->post('produto_codigo');
                $produto_foto    = $_FILES['produto_foto'];
                $foto = array(
                        'upload_path'   => './public/img/produtos/',
                         'allowed_types' => 'jpg',
                         'file_name'     => $produto_codigo.'.jpg',
                         'max_size'      => 500,
                         'max_width'    => 2048,
                         'max_height'    => 2048,
                    
                     );                
                 $this->load->library('upload');
                 $this->upload->initialize($foto);
                 if ($this->upload->do_upload('produto_foto')){
                    $data = html_escape($data);        
                    $this->core_model->insert('produtos',$data);
                    redirect('produtos');                     
                 }else{
                //erro de validação da foto   
                //$this->upload->display_errors();
                $this->session->set_flashdata("error","Erro de Validação da Foto");
                $data = [
                    'titulo' => 'Cadastrar Produtos',
                   
                    'scripts' => [
                        'vendor/datatables/jquery.dataTables.min.js',
                        'vendor/datatables/dataTables.bootstrap4.min.js',
                        'vendor/datatables/app.js',
                        'vendor/mask/jquery.mask.min.js',
                        'vendor/mask/app.js',
                    ],
                     'produto_codigo'=>$this->core_model->generate_unique_code('produtos','numeric',8,'produto_codigo'),
                     'marcas' => $this->core_model->get_all('marcas',array('marca_ativa'=>1)),
                     'categorias' => $this->core_model->get_all('categorias',array('categoria_ativa'=>1)),                    
                     'fornecedores' => $this->core_model->get_all('fornecedores',array('fornecedor_ativo'=>1)),
                ];                
                    $this->load->view('layout/header', $data);
                    $this->load->view('produtos/add');
                    $this->load->view('layout/footer');   
                 }
                
            }else{
                
                //Erro de validação
                
                $data = [
                    'titulo' => 'Cadastrar Produtos',
                   
                    'scripts' => [
                        'vendor/datatables/jquery.dataTables.min.js',
                        'vendor/datatables/dataTables.bootstrap4.min.js',
                        'vendor/datatables/app.js',
                        'vendor/mask/jquery.mask.min.js',
                        'vendor/mask/app.js',
                    ],
                     'produto_codigo'=>$this->core_model->generate_unique_code('produtos','numeric',8,'produto_codigo'),
                     'marcas' => $this->core_model->get_all('marcas',array('marca_ativa'=>1)),
                     'categorias' => $this->core_model->get_all('categorias',array('categoria_ativa'=>1)),                    
                     'fornecedores' => $this->core_model->get_all('fornecedores',array('fornecedor_ativo'=>1)),
                ];

                //echo "<pre>";
                //print_r($data['produtos']);
                //exit();

                $this->load->view('layout/header', $data);
                $this->load->view('produtos/add');
                $this->load->view('layout/footer');                  

            }
    }
    //verifica se já existe um produto com o mesmo nome
    public function check_nomep($produto_descricao) 
    {
        $produto_id = $this->input->post('produto_id');

        if ($this->core_model->get_by_id('produtos', ['produto_descricao' => $produto_descricao, 'produto_id !=' => $produto_id])) {
            $this->form_validation->set_message('check_nomep', 'Esta Produto Já esta cadastrado!');

            return false;
        } else {
            return true;
        }
    }
    //Verifica se o preço de custo é maior que o preço de venda!
    public function check_produto_precov($produto_preco_venda) {
        
        $produto_preco_custo = $this->input->post('produto_preco_custo');
        $produto_preco_custo = str_replace('.','', $produto_preco_custo );
        $produto_preco_venda = str_replace('.','', $produto_preco_venda );
        $produto_preco_custo = str_replace(',','', $produto_preco_custo );
        $produto_preco_venda = str_replace(',','', $produto_preco_venda );        
        
        if( $produto_preco_custo >  $produto_preco_venda){
            $this->form_validation->set_message('check_produto_precov', 'O Preço de Venda deve ser igual ou maio que o Preço de Custo!');
                
        return false;
        } else {
            return true;
        }
    }
    //verifica se já existe um código igual no banco.
    public function check_codbarra($produto_codigo) 
    {
        $produto_id = $this->input->post('produto_id');

        if ($this->core_model->get_by_id('produtos', ['produto_codigo' => $produto_codigo, 'produto_id !=' => $produto_id])) {
            $this->form_validation->set_message('check_codbarra', 'Este código d Produto Já Existe!');

            return false;
        } else {
            return true;
        }
    }    
    //FUNÇÃO PARA DELETAR
    public function del($produto_id = null)
    {
        if (!$produto_id || !$this->core_model->get_by_id('produtos', ['produto_id' => $produto_id])) {
            $this->session->set_flashdata('error', 'Produto não Encontrado');
            redirect('produtos');
        } else {
            $this->core_model->delete('produtos', ['produto_id' => $produto_id]);
            unlink("public/img/produtos/".$produto_codigo.".jpg");
            redirect('produtos');
        }
    }
}    