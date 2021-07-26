<?php

defined('BASEPATH') or exit('Ação não permitida');

class Vendedores extends CI_Controller
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
            'titulo' => 'Vendedores',
            'styles' => [
                'vendor/datatables/dataTables.bootstrap4.min.css',
            ],

            'scripts' => [
                'vendor/datatables/jquery.dataTables.min.js',
                'vendor/datatables/dataTables.bootstrap4.min.js',
                'vendor/datatables/app.js',
            ],
            'vendedores' => $this->core_model->get_all('vendedores'),
        ];
        
//         echo '<pre>';
//         print_r($data);
//         exit(); 
        
        
        $this->load->view('layout/header', $data);
        $this->load->view('vendedores/index');
        $this->load->view('layout/footer');
    }
    
    public function edit($vendedor_id = NULL)
    {
        if (!$vendedor_id || !$this->core_model->get_by_id('vendedores', array('vendedor_id' => $vendedor_id))) {
            $this->session->set_flashdata('error', 'Vendedor não encontrado');
            redirect('vendedores');
        } else {
           
            
            $this->form_validation->set_rules('vendedor_nome_completo', 'Nome Fantasia', 'trim|max_length[45]|callback_check_nome');
            $this->form_validation->set_rules('vendedor_cpf', 'CPF', 'trim|exact_length[14]|callback_valida_cpf');
            $this->form_validation->set_rules('vendedor_rg', 'RG', 'trim|exact_length[12]|callback_check_rg');  
            $this->form_validation->set_rules('vendedor_telefone', 'Tel. Fixo', 'trim|exact_length[13]|callback_valida_telefone');
            $this->form_validation->set_rules('vendedor_celular', 'Tel. Celular', 'trim|required|max_length[15]|callback_valida_celular');
            $this->form_validation->set_rules('vendedor_email', 'E-mail', 'trim|required|valid_email|max_length[50]|callback_check_email');           
            $this->form_validation->set_rules('vendedor_cep', 'CEP', 'trim|required|exact_length[10]');
            $this->form_validation->set_rules('vendedor_endereco', 'Endereço', 'trim|required|max_length[155]');
            $this->form_validation->set_rules('vendedor_numero_endereco', 'Numero', 'trim|max_length[20]');
            $this->form_validation->set_rules('vendedor_bairro', 'Bairro', 'trim|required|max_length[45]');
            $this->form_validation->set_rules('vendedor_complemento', 'Complemento', 'trim|max_length[145]');
            $this->form_validation->set_rules('vendedor_cidade', 'Cidade', 'trim|required|max_length[50]');
            $this->form_validation->set_rules('vendedor_estado', 'Estado', 'trim|required|max_length[2]');
            $this->form_validation->set_rules('vendedor_obs', 'obs', 'max_length[500]');

            if ($this->form_validation->run()) {
                
                //exit('validado');

                $data = elements(
                        
                    [   'vendedor_nome_completo',
                        'vendedor_cpf',
                        'vendedor_rg',
                        'vendedor_telefone',
                        'vendedor_celular',
                        'vendedor_email',
                        'vendedor_cep',
                        'vendedor_endereco',
                        'vendedor_numero_endereco',
                        'vendedor_complemento',
                        'vendedor_bairro',
                        'vendedor_cidade',
                        'vendedor_estado',
                        'vendedor_ativo',
                        'vendedor_obs',
                        'vendedor_id',
                    ], $this->input->post()
                );
              
                $data['vendedor_estado'] = strtoupper($this->input->post('vendedor_estado'));       

                $data = html_escape($data);

                $this->core_model->update('vendedores', $data, ['vendedor_id' => $vendedor_id]);

                redirect('vendedores');

            /* echo '<pre>';
             print_r($data);
             exit();*/
            } else {
                //erro de validção

                $data = [
                    'titulo' => 'Atualizar dados do Vendedor',
                    'scripts' => [
                        'vendor/mask/jquery.mask.min.js',
                        'vendor/mask/app.js',
                        'vendor/ViaCep/viacep.js',

                    ],
                    'vendedores' => $this->core_model->get_by_id('vendedores', ['vendedor_id' => $vendedor_id]),
                ];
                /*;
                echo '<pre>';
                print_r($data['fornecedor']);
                exit();
                */
                $this->load->view('layout/header', $data);
                $this->load->view('vendedores/edit');
                $this->load->view('layout/footer');
            }
            
        }
    }
    
    public function add()
    {
            $this->form_validation->set_rules('vendedor_nome_completo', 'Nome Fantasia', 'trim|max_length[45]|callback_check_nome');
            $this->form_validation->set_rules('vendedor_cpf', 'CPF', 'trim|exact_length[14]|is_unique[vendedores.vendedor_cpf]');
            $this->form_validation->set_rules('vendedor_rg', 'RG', 'trim|exact_length[12]|is_unique[vendedores.vendedor_rg]');  
            $this->form_validation->set_rules('vendedor_telefone', 'Tel. Fixo', 'trim|exact_length[13]|is_unique[vendedores.vendedor_telefone]');
            $this->form_validation->set_rules('vendedor_celular', 'Tel. Celular', 'trim|required|max_length[15]|is_unique[vendedores.vendedor_celular]');
            $this->form_validation->set_rules('vendedor_email', 'E-mail', 'trim|required|valid_email|max_length[50]|is_unique[vendedores.vendedor_email]');           
            $this->form_validation->set_rules('vendedor_cep', 'CEP', 'trim|required|exact_length[10]');
            $this->form_validation->set_rules('vendedor_endereco', 'Endereço', 'trim|required|max_length[155]');
            $this->form_validation->set_rules('vendedor_numero_endereco', 'Numero', 'trim|max_length[20]');
            $this->form_validation->set_rules('vendedor_bairro', 'Bairro', 'trim|required|max_length[45]');
            $this->form_validation->set_rules('vendedor_complemento', 'Complemento', 'trim|max_length[145]');
            $this->form_validation->set_rules('vendedor_cidade', 'Cidade', 'trim|required|max_length[50]');
            $this->form_validation->set_rules('vendedor_estado', 'Estado', 'trim|required|max_length[2]');
            $this->form_validation->set_rules('vendedor_obs', 'obs', 'max_length[500]');

            if ($this->form_validation->run()) {
                
               // exit('validado');

                $data = elements(
                    [
                        'vendedor_codigo',
                        'vendedor_nome_completo',
                        'vendedor_cpf',
                        'vendedor_rg',
                        'vendedor_telefone',
                        'vendedor_celular',
                        'vendedor_email',
                        'vendedor_cep',
                        'vendedor_endereco',
                        'vendedor_numero_endereco',
                        'vendedor_complemento',
                        'vendedor_bairro',
                        'vendedor_cidade',
                        'vendedor_estado',
                        'vendedor_ativo',
                        'vendedor_obs',
                        'vendedor_id',
                    ], $this->input->post()
                );
              
                $data['vendedor_estado'] = strtoupper($this->input->post('vendedor_estado'));       

                $data = html_escape($data);

                $this->core_model->insert('vendedores', $data);

                redirect('vendedores');

             echo '<pre>';
             print_r($data);
             exit();
                
            } else {
                //erro de validção

                $data = [
                    'titulo' => 'Cadastrar Vendedor',
                    'scripts' => [
                        'vendor/mask/jquery.mask.min.js',
                        'vendor/mask/app.js',
                        'vendor/ViaCep/viacep.js',

                    ],
                    
                    'vendedor_codigo' => $this->core_model->generate_unique_code('vendedores','numeric',8, 'vendedor_codigo'),
                   
                ];
                /*;
                echo '<pre>';
                print_r($data['fornecedor']);
                exit();
                */
                $this->load->view('layout/header', $data);
                $this->load->view('vendedores/add');
                $this->load->view('layout/footer');
            }
            
            
}
     
    public function del($vendedor_id = null)
    {
        if (!$vendedor_id || !$this->core_model->get_by_id('vendedores', ['vendedor_id' => $vendedor_id])) {
            $this->session->set_flashdata('error', 'Vendedor não Encontrado');
            redirect('vendedores');
        } else {
            $this->core_model->delete('vendedores', ['vendedor_id' => $vendedor_id]);
            redirect('vendedores');
        }
    }
    //NOme Compoleto
    public function check_nome($vendedor_nome_completo) 
    {
        $vendedor_id = $this->input->post('vendedor_id');

        if ($this->core_model->get_by_id('vendedores', ['vendedor_nome_completo' => $vendedor_nome_completo, 'vendedor_id !=' => $vendedor_id])) {
            $this->form_validation->set_message('check_nome', 'Esta Vendeodor Já Existe');

            return false;
        } else {
            return true;
        }
    }
    //NOme CPF
    public function valida_cpf($cpf)
    {
        if ($this->input->post('vendedor_id')) {
            $vendedor_id = $this->input->post('vendedor_id');

            if ($this->core_model->get_by_id('vendedores', ['vendedor_id !=' => $vendedor_id, 'vendedor_cpf' => $cpf])) {
                $this->form_validation->set_message('valida_cpf', 'Este CPF já existe');

                return false;
            }
        }

        $cpf = str_pad(preg_replace('/[^0-9]/', '', $cpf), 11, '0', STR_PAD_LEFT);
        // Verifica se nenhuma das sequências abaixo foi digitada, caso seja, retorna falso
        if (strlen($cpf) != 11 || $cpf == '00000000000' || $cpf == '11111111111' || $cpf == '22222222222' || $cpf == '33333333333' || $cpf == '44444444444' || $cpf == '55555555555' || $cpf == '66666666666' || $cpf == '77777777777' || $cpf == '88888888888' || $cpf == '99999999999') {
            $this->form_validation->set_message('valida_cpf', 'Por favor digite um CPF válido');

            return false;
        } else {
            // Calcula os números para verificar se o CPF é verdadeiro
            for ($t = 9; $t < 11; ++$t) {
                for ($d = 0, $c = 0; $c < $t; ++$c) {
                    $d += $cpf[$c] * (($t + 1) - $c);
                }
                $d = ((10 * $d) % 11) % 10;
                if ($cpf[$c] != $d) {
                    $this->form_validation->set_message('valida_cpf', 'Por favor digite um CPF válido');

                    return false;
                }
            }

            return true;
        }
    }//
    //RG Vendedor
    public function check_rg($vendedor_rg) //rg
    {
        $vendedor_id = $this->input->post('vendedor_id');

        if ($this->core_model->get_by_id('vendedores', ['vendedor_rg' => $vendedor_rg, 'vendedor_id !=' => $vendedor_id])) {
            $this->form_validation->set_message('check_rg', 'Este Documento de RH Já Existe');

            return false;
        } else {
            return true;
        }
    }
    //email callback_check_email
    public function check_email($vendedor_email) //rg
    {
        $vendedor_id = $this->input->post('vendedor_id');

        if ($this->core_model->get_by_id('vendedores', ['vendedor_email' => $vendedor_email, 'vendedor_id !=' => $vendedor_id])) {
            $this->form_validation->set_message('check_email', 'Este E-mail Já Existe');

            return false;
        } else {
            return true;
        }
    }
    //check_telefone fixo
    public function valida_telefone($vendedor_telefone)
    {
        $vendedor_id = $this->input->post('vendedor_id');

        if ($this->core_model->get_by_id('vendedores', ['vendedor_telefone' => $vendedor_telefone, 'vendedor_id !=' => $vendedor_id])) {
            $this->form_validation->set_message('vendedor_telefone', 'Este Telefone Já Existe');

            return false;
        } else {
            return true;
        }
    }

    //check_telefone celular
    public function valida_celular($vendedor_celular)
    {
        $vendedor_id = $this->input->post('vendedor_id');

        if ($this->core_model->get_by_id('vendedores', ['vendedor_celular' => $vendedor_celular, 'vendedor_id !=' => $vendedor_id])) {
            $this->form_validation->set_message('vendedor_celular', 'Este Telefone Já Existe');

            return false;
        } else {
            return true;
        }
    }

    

}