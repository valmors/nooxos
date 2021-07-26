<?php

defined('BASEPATH') or exit('Ação não permitida');

class Fornecedores extends CI_Controller
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
            'titulo' => 'Fornecedores',
            'styles' => [
                'vendor/datatables/dataTables.bootstrap4.min.css',
            ],

            'scripts' => [
                'vendor/datatables/jquery.dataTables.min.js',
                'vendor/datatables/dataTables.bootstrap4.min.js',
                'vendor/datatables/app.js',
            ],
            'fornecedores' => $this->core_model->get_all('fornecedores'),
        ];
        $this->load->view('layout/header', $data);
        $this->load->view('fornecedores/index');
        $this->load->view('layout/footer');
    }
    
    public function add(){
            
            $this->form_validation->set_rules('fornecedor_razao', 'Razão Social', 'trim|required|min_length[4]|max_length[200]|is_unique[fornecedores.fornecedor_razao]');
            $this->form_validation->set_rules('fornecedor_nome_fantasia', 'Nome Fantasia', 'trim|max_length[145]|is_unique[fornecedores.fornecedor_nome_fantasia]');
            $this->form_validation->set_rules('fornecedor_data_abertura', 'Fundação', 'trim|min_length[10]');
            $this->form_validation->set_rules('fornecedor_cnpj', 'CNPJ', 'trim|exact_length[18]|is_unique[fornecedores.fornecedor_cnpj]|callback_valida_cnpj');
            $this->form_validation->set_rules('fornecedor_ie', 'IE', 'trim|max_length[20]|is_unique[fornecedores.fornecedor_ie]');
            $this->form_validation->set_rules('fornecedor_email', 'E-mail', 'trim|required|valid_email|max_length[50]|is_unique[fornecedores.fornecedor_email]');
            $this->form_validation->set_rules('fornecedor_telefone', 'Tel. Fixo', 'trim|max_length[14]|is_unique[fornecedores.fornecedor_telefone]');
            $this->form_validation->set_rules('fornecedor_celular', 'Tel. Celular', 'trim|required|max_length[15]|is_unique[fornecedores.fornecedor_celular]');
            $this->form_validation->set_rules('fornecedor_contato', 'Contato', 'trim|max_length[150]');
            $this->form_validation->set_rules('fornecedor_cep', 'CEP', 'trim|required|exact_length[10]');
            $this->form_validation->set_rules('fornecedor_endereco', 'Endereço', 'trim|required|max_length[155]');
            $this->form_validation->set_rules('fornecedor_numero_endereco', 'Numero', 'trim|max_length[20]');
            $this->form_validation->set_rules('fornecedor_bairro', 'Bairro', 'trim|required|max_length[45]');
            $this->form_validation->set_rules('fornecedor_complemento', 'Complemento', 'trim|max_length[145]');
            $this->form_validation->set_rules('fornecedor_cidade', 'Cidade', 'trim|required|max_length[50]');
            $this->form_validation->set_rules('fornecedor_estado', 'Estado', 'trim|required|max_length[2]');
            $this->form_validation->set_rules('fornecedor_obs', 'obs', 'max_length[500]');

            if ($this->form_validation->run()) {


                $data = elements(
                    [   'fornecedor_razao',
                        'fornecedor_nome_fantasia',
                        'fornecedor_cnpj',
                        'fornecedor_ie',
                        'fornecedor_telefone',
                        'fornecedor_celular',
                        'fornecedor_email',
                        'fornecedor_cep',
                        'fornecedor_endereco',
                        'fornecedor_bairro',
                        'fornecedor_numero_endereco',
                        'fornecedor_cidade',
                        'fornecedor_estado',
                        'fornecedor_complemento',
                        'fornecedor_ativo',
                        'fornecedor_obs',
                        'fornecedor_contato',
                        'fornecedor_id',
                    ], $this->input->post()
                );
              
                $data['fornecedor_estado'] = strtoupper($this->input->post('fornecedor_estado'));       

                $data = html_escape($data);

                $this->core_model->insert('fornecedores', $data);

                redirect('fornecedores');

            /* echo '<pre>';
             print_r($data);
             exit();*/
          } else {
            //erro de validção

            $data = [
                    'titulo' => 'Cadastro de Fornecedores',
                    'scripts' => [
                        'vendor/mask/jquery.mask.min.js',
                        'vendor/mask/app.js',
                        'vendor/ViaCep/viacep.js',
                        'js/cnpj.js',
                    ],
                ];

            $this->load->view('layout/header', $data);
            $this->load->view('fornecedores/add');
            $this->load->view('layout/footer');
        }
    }
    
    public function edit($fornecedor_id = NULL)
    {
        if (!$fornecedor_id || !$this->core_model->get_by_id('fornecedores', array('fornecedor_id' => $fornecedor_id))) {
            $this->session->set_flashdata('error', 'Fornecedor não encontrado');
            redirect('fornecedores');
        } else {
           
            
            $this->form_validation->set_rules('fornecedor_razao', 'Razão Social', 'trim|required|min_length[4]|max_length[200]|callback_check_razao');
            $this->form_validation->set_rules('fornecedor_nome_fantasia', 'Nome Fantasia', 'trim|max_length[45]|callback_check_nfantasia');
            $this->form_validation->set_rules('fornecedor_data_abertura', 'Fundação', 'trim|min_length[10]');
            $this->form_validation->set_rules('fornecedor_cnpj', 'CNPJ', 'trim|exact_length[18]|callback_valida_cnpj');
            $this->form_validation->set_rules('fornecedor_ie', 'IE', 'trim|max_length[20]');
            $this->form_validation->set_rules('fornecedor_email', 'E-mail', 'trim|required|valid_email|max_length[50]|callback_check_email');
            $this->form_validation->set_rules('fornecedor_telefone', 'Tel. Fixo', 'trim|max_length[14]|callback_valida_telefone');
            $this->form_validation->set_rules('fornecedor_celular', 'Tel. Celular', 'trim|required|max_length[15]|callback_valida_celular');
            $this->form_validation->set_rules('fornecedor_contato', 'Contato', 'trim|max_length[150]');
            $this->form_validation->set_rules('fornecedor_cep', 'CEP', 'trim|required|exact_length[10]');
            $this->form_validation->set_rules('fornecedor_endereco', 'Endereço', 'trim|required|max_length[155]');
            $this->form_validation->set_rules('fornecedor_numero_endereco', 'Numero', 'trim|max_length[20]');
            $this->form_validation->set_rules('fornecedor_bairro', 'Bairro', 'trim|required|max_length[45]');
            $this->form_validation->set_rules('fornecedor_complemento', 'Complemento', 'trim|max_length[145]');
            $this->form_validation->set_rules('fornecedor_cidade', 'Cidade', 'trim|required|max_length[50]');
            $this->form_validation->set_rules('fornecedor_estado', 'Estado', 'trim|required|max_length[2]');
            $this->form_validation->set_rules('fornecedor_obs', 'obs', 'max_length[500]');

            if ($this->form_validation->run()) {
                /*echo '<pre>';
                print_r($this->input->post());*/
                
                $fornecedor_ativo = $this->input->post('fornecedor_ativo');
                if($this->db->table_exists('produtos')){
                    if($fornecedor_ativo == 0 && $this->core_model->get_by_id('produtos',array('produto_fornecedor_id'=>$fornecedor_id,'produto_ativo'=>1))){
                     $this->session->set_flashdata('info', 'Este Fornecedor não pode ser desativo, existe um produto relacionado!');
                    redirect('fornecedores');   
                    }
                }              
                

                $data = elements(
                    [   'fornecedor_razao',
                        'fornecedor_nome_fantasia',
                        'fornecedor_cnpj',
                        'fornecedor_ie',
                        'fornecedor_telefone',
                        'fornecedor_celular',
                        'fornecedor_email',
                        'fornecedor_cep',
                        'fornecedor_endereco',
                        'fornecedor_bairro',
                        'fornecedor_numero_endereco',
                        'fornecedor_cidade',
                        'fornecedor_estado',
                        'fornecedor_complemento',
                        'fornecedor_ativo',
                        'fornecedor_obs',
                        'fornecedor_contato',
                        'fornecedor_id',
                    ], $this->input->post()
                );
              
                $data['fornecedor_estado'] = strtoupper($this->input->post('fornecedor_estado'));       

                $data = html_escape($data);

                $this->core_model->update('fornecedores', $data, ['fornecedor_id' => $fornecedor_id]);

                redirect('fornecedores');

            /* echo '<pre>';
             print_r($data);
             exit();*/
            } else {
                //erro de validção

                $data = [
                    'titulo' => 'Atualizar dados do Fornecedor',
                    'scripts' => [
                        'vendor/mask/jquery.mask.min.js',
                        'vendor/mask/app.js',
                        'vendor/ViaCep/viacep.js',
                        'js/cnpj.js',

                    ],
                    'fornecedor' => $this->core_model->get_by_id('fornecedores', ['fornecedor_id' => $fornecedor_id]),
                ];
                /*;
                echo '<pre>';
                print_r($data['fornecedor']);
                exit();
                */
                $this->load->view('layout/header', $data);
                $this->load->view('fornecedores/edit');
                $this->load->view('layout/footer');
            }
            
        }
    }
    
    public function del($fornecedor_id = null)
    {
        if (!$fornecedor_id || !$this->core_model->get_by_id('fornecedores', ['fornecedor_id' => $fornecedor_id])) {
            $this->session->set_flashdata('error', 'Fornecedor não Encontrado');
            redirect('fornecedores');
        } else {
            $this->core_model->delete('fornecedores', ['fornecedor_id' => $fornecedor_id]);
            redirect('fornecedores');
        }
    }
    public function valida_cnpj($cnpj)
    {
        // Verifica se um número foi informado
        if (empty($cnpj)) {
            $this->form_validation->set_message('valida_cnpj', 'Por favor digite um CNPJ válido');

            return false;
        }

        if ($this->input->post('forneceodr_id')) {
            $cliente_id = $this->input->post('forneceodr_id');

            if ($this->core_model->get_by_id('fornecedores', ['fornecedore_id !=' => $fornecedor_id, 'cliente_cpf_cnpj' => $cnpj])) {
                $this->form_validation->set_message('valida_cnpj', 'Esse CNPJ já existe');

                return false;
            }
        }

        // Elimina possivel mascara
        $cnpj = preg_replace('/[^0-9]/', '', $cnpj);
        $cnpj = str_pad($cnpj, 14, '0', STR_PAD_LEFT);

        // Verifica se o numero de digitos informados é igual a 11
        if (strlen($cnpj) != 14) {
            $this->form_validation->set_message('valida_cnpj', 'Por favor digite um CNPJ válido');

            return false;
        }

        // Verifica se nenhuma das sequências invalidas abaixo
        // foi digitada. Caso afirmativo, retorna falso
        elseif ($cnpj == '00000000000000' ||
                $cnpj == '11111111111111' ||
                $cnpj == '22222222222222' ||
                $cnpj == '33333333333333' ||
                $cnpj == '44444444444444' ||
                $cnpj == '55555555555555' ||
                $cnpj == '66666666666666' ||
                $cnpj == '77777777777777' ||
                $cnpj == '88888888888888' ||
                $cnpj == '99999999999999') {
            $this->form_validation->set_message('valida_cnpj', 'Por favor digite um CNPJ válido');

            return false;

        // Calcula os digitos verificadores para verificar se o
            // CPF é válido
        } else {
            $j = 5;
            $k = 6;
            $soma1 = '';
            $soma2 = '';

            for ($i = 0; $i < 13; ++$i) {
                $j = $j == 1 ? 9 : $j;
                $k = $k == 1 ? 9 : $k;

                //$soma2 += ($cnpj{$i} * $k);

                //$soma2 = intval($soma2) + ($cnpj{$i} * $k); //Para PHP com versão < 7.4
                $soma2 = intval($soma2) + ($cnpj[$i] * $k); //Para PHP com versão > 7.4

                if ($i < 12) {
                    //$soma1 = intval($soma1) + ($cnpj{$i} * $j); //Para PHP com versão < 7.4
                    $soma1 = intval($soma1) + ($cnpj[$i] * $j); //Para PHP com versão > 7.4
                }

                --$k;
                --$j;
            }

            $digito1 = $soma1 % 11 < 2 ? 0 : 11 - $soma1 % 11;
            $digito2 = $soma2 % 11 < 2 ? 0 : 11 - $soma2 % 11;

            if (!($cnpj[12] == $digito1) and ($cnpj[13] == $digito2)) {
                $this->form_validation->set_message('valida_cnpj', 'Por favor digite um CNPJ válido');

                return false;
            } else {
                return true;
            }
        }
    }
    //email callback_check_email
    public function check_email($fornecedor_email) //rg
    {
        $fornecedor_id = $this->input->post('fornecedor_id');

        if ($this->core_model->get_by_id('fornecedores', ['fornecedor_email' => $fornecedor_email, 'fornecedor_id !=' => $fornecedor_id])) {
            $this->form_validation->set_message('check_email', 'Este E-mail Já Existe');

            return false;
        } else {
            return true;
        }
    }
    //check_telefone fixo
    public function valida_telefone($fornecedor_telefone)
    {
        $fornecedor_id = $this->input->post('fornecedor_id');

        if ($this->core_model->get_by_id('fornecedores', ['fornecedor_telefone' => $fornecedor_telefone, 'fornecedor_id !=' => $fornecedor_id])) {
            $this->form_validation->set_message('fornecedor_telefone', 'Este Telefone Já Existe');

            return false;
        } else {
            return true;
        }
    }

    //check_telefone celular
    public function valida_celular($fornecedor_celular)
    {
        $fornecedor_id = $this->input->post('fornecedor_id');

        if ($this->core_model->get_by_id('fornecedores', ['fornecedor_celular' => $fornecedor_celular, 'fornecedor_id !=' => $fornecedor_id])) {
            $this->form_validation->set_message('fornecedor_celular', 'Este Telefone Já Existe');

            return false;
        } else {
            return true;
        }
    }
    //Nome Razao
    public function check_razao($fornecedor_razao) 
    {
        $fornecedor_id = $this->input->post('fornecedor_id');

        if ($this->core_model->get_by_id('fornecedores', ['fornecedor_razao' => $fornecedor_razao, 'fornecedor_id !=' => $fornecedor_id])) {
            $this->form_validation->set_message('check_razao', 'Esta Nome Já Existe!');

            return false;
        } else {
            return true;
        }
    }
    //Nome Fantasia
    public function check_nfantasia($fornecedor_nome_fantasia) 
    {
        $fornecedor_id = $this->input->post('fornecedor_id');

        if ($this->core_model->get_by_id('fornecedores', ['fornecedor_nome_fantasia' => $fornecedor_nome_fantasia, 'fornecedor_id !=' => $fornecedor_id])) {
            $this->form_validation->set_message('check_razao', 'Esta Nome Fantasia Já Existe!');

            return false;
        } else {
            return true;
        }
    }    

}