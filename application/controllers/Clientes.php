<?php

defined('BASEPATH') or exit('Ação não permitida');

class Clientes extends CI_Controller
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
            'titulo' => 'Gerenciar Clientes',
            'styles' => [
                'vendor/datatables/dataTables.bootstrap4.min.css',
            ],

            'scripts' => [
                'vendor/datatables/jquery.dataTables.min.js',
                'vendor/datatables/dataTables.bootstrap4.min.js',
                'vendor/datatables/app.js',
            ],
            'clientes' => $this->core_model->get_all('clientes'),
        ];
        $this->load->view('layout/header', $data);
        $this->load->view('clientes/index');
        $this->load->view('layout/footer');
    }

    public function add()
    {
        $cliente_tipo = $this->input->post('cliente_tipo');

        if ($cliente_tipo == 1) { //CLIENTE PESSOA FISICA
            $this->form_validation->set_rules('cliente_nome', 'Nome', 'trim|min_length[4]|max_length[150]');
            $this->form_validation->set_rules('cliente_sobrenome', 'Sobrenome', 'trim|required|min_length[4]|max_length[150]');
            $this->form_validation->set_rules('cliente_data_nascimento', 'Nascimento', 'required');
            $this->form_validation->set_rules('cliente_cpf', 'CPF', 'trim|required|exact_length[14]|is_unique[clientes.cliente_cpf_cnpj]|callback_valida_cpf');
            $this->form_validation->set_rules('cliente_rg', 'RG', 'trim|required|max_length[20]|is_unique[clientes.cliente_rg_ie]|callback_check_rg');
        } else {                //CLIENTE PESSOA JURIDICA
            $this->form_validation->set_rules('cliente_nfantasia', 'Nome Fantasia', 'trim|required|min_length[4]|max_length[45]');
            $this->form_validation->set_rules('cliente_rsocial', 'Razão Social', 'trim|required|min_length[4]|max_length[150]');
            $this->form_validation->set_rules('cliente_data_fundacao', 'Fundação', 'trim|min_length[10]');
            $this->form_validation->set_rules('cliente_cnpj', 'CNPJ', 'trim|exact_length[18]|is_unique[clientes.cliente_cpf_cnpj]|callback_valida_cnpj');
            $this->form_validation->set_rules('cliente_ie', 'IE', 'trim|max_length[20]|is_unique[clientes.cliente_rg_ie]');
        }

        $this->form_validation->set_rules('cliente_email', 'E-mail', 'trim|required|valid_email|max_length[50]|is_unique[clientes.cliente_email]');

        if (!empty($this->input->post('cliente_telefone'))) {
            $this->form_validation->set_rules('cliente_telefone', 'Tel. Fixo', 'trim|max_length[13]|is_unique[clientes.cliente_telefone]');
        }
        if (!empty($this->input->post('cliente_celular'))) {
            $this->form_validation->set_rules('cliente_celular', 'Tel. Celular', 'trim|max_length[15]|is_unique[clientes.cliente_celular]');
        }

        $this->form_validation->set_rules('cliente_cep', 'CEP', 'trim|required|exact_length[10]');
        $this->form_validation->set_rules('cliente_endereco', 'Endereço', 'trim|required|max_length[155]');
        $this->form_validation->set_rules('cliente_numero_endereco', 'Numero', 'trim|max_length[20]');
        $this->form_validation->set_rules('cliente_bairro', 'Bairro', 'trim|required|max_length[45]');
        $this->form_validation->set_rules('cliente_complemento', 'Complemento', 'trim|max_length[145]');
        $this->form_validation->set_rules('cliente_cidade', 'Cidade', 'trim|required|max_length[50]');
        $this->form_validation->set_rules('cliente_estado', 'Estado', 'trim|required|max_length[2]');
        $this->form_validation->set_rules('cliente_obs', 'obs', 'max_length[500]');

        if ($this->form_validation->run()) {
            /*echo '<pre>';
            print_r($this->input->post());*/

            $data = elements(
                    [
                        'cliente_email',
                        'cliente_telefone',
                        'cliente_celular',
                        'cliente_cep',
                        'cliente_endereco',
                        'cliente_bairro',
                        'cliente_numero_endereco',
                        'cliente_cidade',
                        'cliente_estado',
                        'cliente_complemento',
                        'cliente_ativo',
                        'cliente_obs',
                        'cliente_tipo',
                    ], $this->input->post()
                );
            if ($cliente_tipo == 1) { //CLIENTE PESSOA FISICA
                $data['cliente_nome'] = $this->input->post('cliente_nome');
                $data['cliente_sobrenome'] = $this->input->post('cliente_sobrenome');
                $data['cliente_data_nascimento'] = $this->input->post('cliente_data_nascimento');
                $data['cliente_cpf_cnpj'] = $this->input->post('cliente_cpf');
                $data['cliente_rg_ie'] = $this->input->post('cliente_rg');
            } else { //CLIENTE PESSOA FISICA
                $data['cliente_nome'] = $this->input->post('cliente_nfantasia');
                $data['cliente_sobrenome'] = $this->input->post('cliente_rsocial');
                $data['cliente_data_nascimento'] = $this->input->post('cliente_data_fundacao');
                $data['cliente_cpf_cnpj'] = $this->input->post('cliente_cnpj');
                $data['cliente_rg_ie'] = $this->input->post('cliente_ie');
            }
            $data['cliente_estado'] = strtoupper($this->input->post('cliente_estado'));

            $data = html_escape($data);

            $this->core_model->insert('clientes', $data);

            redirect('clientes');
        } else {
            //erro de validção

            $data = [
                    'titulo' => 'Cadastro de Cliente',
                    'scripts' => [
                        'vendor/mask/jquery.mask.min.js',
                        'vendor/mask/app.js',
                        'vendor/ViaCep/viacep.js',
                        'js/cnpj.js',
                        'js/clientes.js',
                    ],
                ];

            $this->load->view('layout/header', $data);
            $this->load->view('clientes/add');
            $this->load->view('layout/footer');
        }
    }

    public function edit($cliente_id = null)
    {
        if (!$cliente_id || !$this->core_model->get_by_id('clientes', ['cliente_id' => $cliente_id])) {
            $this->session->set_flashdata('error', 'Cliente não encontrado');
            redirect('clientes');
        } else {
            $cliente_tipo = $this->input->post('cliente_tipo');

            if ($cliente_tipo == 1) { //CLIENTE PESSOA FISICA
                $this->form_validation->set_rules('cliente_nome', 'Nome', 'trim|min_length[4]|max_length[150]');
                $this->form_validation->set_rules('cliente_sobrenome', 'Sobrenome', 'trim|required|min_length[4]|max_length[150]');
                $this->form_validation->set_rules('cliente_data_nascimento', 'Nascimento', 'required');
                $this->form_validation->set_rules('cliente_cpf', 'CPF', 'trim|required|exact_length[14]|callback_valida_cpf');
                $this->form_validation->set_rules('cliente_rg', 'RG', 'trim|required|max_length[20]|callback_check_rg');
            } else {                //CLIENTE PESSOA JURIDICA
                $this->form_validation->set_rules('cliente_nfantasia', 'Nome Fantasia', 'trim|min_length[4]|max_length[45]');
                $this->form_validation->set_rules('cliente_rsocial', 'Razão Social', 'trim|required|min_length[4]|max_length[150]');
                $this->form_validation->set_rules('cliente_data_fundacao', 'Fundação', 'trim|min_length[10]');
                $this->form_validation->set_rules('cliente_cnpj', 'CNPJ', 'trim|exact_length[18]|callback_valida_cnpj');
                $this->form_validation->set_rules('cliente_ie', 'IE', 'trim|max_length[20]');
            }

            $this->form_validation->set_rules('cliente_email', 'E-mail', 'trim|required|valid_email|max_length[50]|callback_check_email');

            if (!empty($this->input->post('cliente_telefone'))) {
                $this->form_validation->set_rules('cliente_telefone', 'Tel. Fixo', 'trim|max_length[14]|callback_valida_telefone');
            }
            if (!empty($this->input->post('cliente_celular'))) {
                $this->form_validation->set_rules('cliente_celular', 'Tel. Celular', 'trim|max_length[15]|callback_valida_celular');
            }
            //$this->form_validation->set_rules('cliente_telefone', 'Tel. Fixo', 'trim|required|max_length[14]|callback_check_telefone');
            //$this->form_validation->set_rules('cliente_celular', 'Tel. Celular', 'trim|required|max_length[15]|callback_check_celular');
            $this->form_validation->set_rules('cliente_cep', 'CEP', 'trim|required|exact_length[10]');
            $this->form_validation->set_rules('cliente_endereco', 'Endereço', 'trim|required|max_length[155]');
            $this->form_validation->set_rules('cliente_numero_endereco', 'Numero', 'trim|max_length[20]');
            $this->form_validation->set_rules('cliente_bairro', 'Bairro', 'trim|required|max_length[45]');
            $this->form_validation->set_rules('cliente_complemento', 'Complemento', 'trim|max_length[145]');
            $this->form_validation->set_rules('cliente_cidade', 'Cidade', 'trim|required|max_length[50]');
            $this->form_validation->set_rules('cliente_estado', 'Estado', 'trim|required|max_length[2]');
            $this->form_validation->set_rules('cliente_obs', 'obs', 'max_length[500]');

            if ($this->form_validation->run()) {
                /*echo '<pre>';
                print_r($this->input->post());*/
                $cliente_ativo = $this->input->post('cliente_ativo');
                if($this->db->table_exists('contas_receber')){
                    if($cliente_ativo == 0 && $this->core_model->get_by_id('contas_receber',array('conta_receber_cliente_id'=>$cliente_id,'conta_receber_status'=>0))){
                     $this->session->set_flashdata('info', 'Este Cliente não pode ser desativo, existe uma conta a receber ativa!');
                    redirect('clientes');   
                    }
                } 
                

                $data = elements(
                    [
                        'cliente_email',
                        'cliente_telefone',
                        'cliente_celular',
                        'cliente_cep',
                        'cliente_endereco',
                        'cliente_bairro',
                        'cliente_numero_endereco',
                        'cliente_cidade',
                        'cliente_estado',
                        'cliente_complemento',
                        'cliente_ativo',
                        'cliente_obs',
                        'cliente_tipo',
                        'cliente_id',
                    ], $this->input->post()
                );
                if ($cliente_tipo == 1) { //CLIENTE PESSOA FISICA
                    $data['cliente_nome'] = $this->input->post('cliente_nome');
                    $data['cliente_sobrenome'] = $this->input->post('cliente_sobrenome');
                    $data['cliente_data_nascimento'] = $this->input->post('cliente_data_nascimento');
                    $data['cliente_cpf_cnpj'] = $this->input->post('cliente_cpf');
                    $data['cliente_rg_ie'] = $this->input->post('cliente_rg');
                } else { //CLIENTE PESSOA FISICA
                    $data['cliente_nome'] = $this->input->post('cliente_nfantasia');
                    $data['cliente_sobrenome'] = $this->input->post('cliente_rsocial');
                    $data['cliente_data_nascimento'] = $this->input->post('cliente_data_fundacao');
                    $data['cliente_cpf_cnpj'] = $this->input->post('cliente_cnpj');
                    $data['cliente_rg_ie'] = $this->input->post('cliente_ie');
                }
                $data['cliente_estado'] = strtoupper($this->input->post('cliente_estado'));

                $data = html_escape($data);

                $this->core_model->update('clientes', $data, ['cliente_id' => $cliente_id]);

                redirect('clientes');

            /* echo '<pre>';
             print_r($data);
             exit();*/
            } else {
                //erro de validção

                $data = [
                    'titulo' => 'Atualizar dados do Cliente',
                    'scripts' => [
                        'vendor/mask/jquery.mask.min.js',
                        'vendor/mask/app.js',
                        'vendor/ViaCep/viacep.js',
                        'js/cnpj.js',
                        'js/clientes.js',
                    ],
                    'cliente' => $this->core_model->get_by_id('clientes', ['cliente_id' => $cliente_id]),
                ];
                /*;
                echo '<pre>';
                print_r($data['cliente']);
                exit();
                */
                $this->load->view('layout/header', $data);
                $this->load->view('clientes/edit');
                $this->load->view('layout/footer');
            }
        }
    }

    public function del($cliente_id = null)
    {
        if (!$cliente_id || !$this->core_model->get_by_id('clientes', ['cliente_id' => $cliente_id])) {
            $this->session->set_flashdata('error', 'Cliente não Encontrado');
            redirect('clientes');
        } else {
            $this->core_model->delete('clientes', ['cliente_id' => $cliente_id]);
            redirect('clientes');
        }
    }

    public function check_rg($cliente_rg) //rg
    {
        $cliente_id = $this->input->post('cliente_id');

        if ($this->core_model->get_by_id('clientes', ['cliente_rg_ie' => $cliente_rg, 'cliente_id !=' => $cliente_id])) {
            $this->form_validation->set_message('check_rg', 'Este Documento de RH Já Existe');

            return false;
        } else {
            return true;
        }
    }

    //email callback_check_email
    public function check_email($cliente_email) //rg
    {
        $cliente_id = $this->input->post('cliente_id');

        if ($this->core_model->get_by_id('clientes', ['cliente_email' => $cliente_email, 'cliente_id !=' => $cliente_id])) {
            $this->form_validation->set_message('check_email', 'Este E-mail Já Existe');

            return false;
        } else {
            return true;
        }
    }

    //check_telefone fixo
    public function valida_telefone($cliente_telefone)
    {
        $cliente_id = $this->input->post('cliente_id');

        if ($this->core_model->get_by_id('clientes', ['cliente_telefone' => $cliente_telefone, 'cliente_id !=' => $cliente_id])) {
            $this->form_validation->set_message('cliente_telefone', 'Este Telefone Já Existe');

            return false;
        } else {
            return true;
        }
    }

    //check_telefone celular
    public function valida_celular($cliente_celular)
    {
        $cliente_id = $this->input->post('cliente_id');

        if ($this->core_model->get_by_id('clientes', ['cliente_celular' => $cliente_celular, 'cliente_id !=' => $cliente_id])) {
            $this->form_validation->set_message('cliente_celular', 'Este Telefone Já Existe');

            return false;
        } else {
            return true;
        }
    }

    public function valida_cnpj($cnpj)
    {
        // Verifica se um número foi informado
        if (empty($cnpj)) {
            $this->form_validation->set_message('valida_cnpj', 'Por favor digite um CNPJ válido');

            return false;
        }

        if ($this->input->post('cliente_id')) {
            $cliente_id = $this->input->post('cliente_id');

            if ($this->core_model->get_by_id('clientes', ['cliente_id !=' => $cliente_id, 'cliente_cpf_cnpj' => $cnpj])) {
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

    public function valida_cpf($cpf)
    {
        if ($this->input->post('cliente_id')) {
            $cliente_id = $this->input->post('cliente_id');

            if ($this->core_model->get_by_id('clientes', ['cliente_id !=' => $cliente_id, 'cliente_cpf_cnpj' => $cpf])) {
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
    }
}
