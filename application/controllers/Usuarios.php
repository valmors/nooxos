<?php

defined('BASEPATH') or exit('Ação não permitida');

class Usuarios extends CI_Controller
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
            'titulo' => 'Usuários Cadastrados',
            'styles' => [
                'vendor/datatables/dataTables.bootstrap4.min.css',
            ],

            'scripts' => [
                'vendor/datatables/jquery.dataTables.min.js',
                'vendor/datatables/dataTables.bootstrap4.min.js',
                'vendor/datatables/app.js',
            ],
            'usuarios' => $this->ion_auth->users()->result(),
        ];
        $this->load->view('layout/header', $data);
        $this->load->view('usuarios/index');
        $this->load->view('layout/footer');
    }

    public function add()
    {
        $this->form_validation->set_rules('first_name', 'Nome', 'trim|required');
        $this->form_validation->set_rules('last_name', 'Sobrenome', 'trim|required');
        $this->form_validation->set_rules('email', 'E-mail', 'trim|required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('username', 'Usuário', 'trim|required|is_unique[users.username]');
        $this->form_validation->set_rules('password', 'Senha', 'required|min_length[5]|max_length[255]');
        $this->form_validation->set_rules('confirm_password', 'Confirme Sua Senha', 'matches[password]');

        if ($this->form_validation->run()) {
            $username = $this->security->xss_clean($this->input->post('username'));
            $password = $this->security->xss_clean($this->input->post('password'));
            $email = $this->security->xss_clean($this->input->post('email'));

            $additional_data = [
                        'first_name' => $this->input->post('first_name'),
                        'last_name' => $this->input->post('last_name'),
                        'username' => $this->input->post('username'),
                        'active' => $this->input->post('active'),
                        ];
            $group = [$this->input->post('perfil_usuario')]; // Sets user to admin.
            $additional_data = $this->security->xss_clean($additional_data);
            $group = $this->security->xss_clean($group);

            if ($this->ion_auth->register($username, $password, $email, $additional_data, $group)) {
                $this->session->set_flashdata('sucesso', 'Dados salvos com seucesso!');
            } else {
                $this->session->set_flashdata('error', 'ERRO não foi possível cadastrar o usuário!');
            }

            redirect('usuarios');
        } else {
            //erro validaçãop

            $data = [
                'titulo' => 'Cadastrar Usuário',
            ];

            $this->load->view('layout/header', $data);
            $this->load->view('usuarios/add');
            $this->load->view('layout/footer');
        }
    }

    public function edit($usuario_id = null)
    {
        if (!$usuario_id || !$this->ion_auth->user($usuario_id)->row()) {
            $this->session->set_flashdata('error', 'Usuário não encontrado');
            redirect('usuarios');
        } else {
            /*
            echo '<pre>';
            print_r($this->input->post());
            exit();

            [first_name] => Admin
            [last_name] => Administrador
            [email] => admin@admin.com
            [username] => administrator
            [active] => 1
            [perfil_usuario] => 1
            [confirm_password] =>
            [password] =>
            [usuario_id] => 1
            */

            $this->form_validation->set_rules('first_name', 'Nome', 'trim|required');
            $this->form_validation->set_rules('last_name', 'Sobrenome', 'trim|required');
            $this->form_validation->set_rules('email', 'E-mail', 'trim|required|valid_email|callback_email_check');
            $this->form_validation->set_rules('username', 'Usuário', 'trim|required|callback_username_check');
            $this->form_validation->set_rules('password', 'Senha', 'min_length[5]|max_length[255]');
            $this->form_validation->set_rules('confirm_password', 'Confirme Sua Senha', 'matches[password]');

            if ($this->form_validation->run()) {
                $data = elements(
                    [
                        'first_name',
                        'last_name',
                        'email',
                        'username',
                        'active',
                        'password',
                    ], $this->input->post()
                );
                $data = html_escape($data);
                /* verifica se o password foi alterado*/
                $password = $this->input->post('password');

                if (!$password) {
                    unset($data['password']);
                }

                if ($this->ion_auth->update($usuario_id, $data)) {
                    $perfil_usuario_db = $this->ion_auth->get_users_groups($usuario_id)->row();

                    $perfil_usuario_post = $this->input->post('perfil_usuario');
                    /* se o perfil for diferente atualiza na tabela */
                    if ($perfil_usuario_post != $perfil_usuario_db->id) {
                        $this->ion_auth->remove_from_group($perfil_usuario_db->id, $usuario_id);
                        $this->ion_auth->add_to_group($perfil_usuario_post, $usuario_id);
                    }

                    $this->session->set_flashdata('sucesso', 'Dados atualizados com seucesso!');
                } else {
                    $this->session->set_flashdata('error', 'ERRO ao atualizar!');
                }

                redirect('usuarios');

            //[perfil_usuario] => verificar
               // exit('Validado');
            } else {
                $data = [
                'titulo' => 'Editar Usuário',

                'usuario' => $this->ion_auth->user($usuario_id)->row(),
                'perfil_usuario' => $this->ion_auth->get_users_groups($usuario_id)->row(),
            ];

                $this->load->view('layout/header', $data);
                $this->load->view('usuarios/edit');
                $this->load->view('layout/footer');
            }
        }
    }

    public function del($usuario_id = null)
    {
        if (!$usuario_id || !$this->ion_auth->user($usuario_id)->row()) {
            $this->session->set_flashdata('error', 'Usuário não encontrato');
            redirect('usuarios');
        }

        if ($this->ion_auth->is_admin($usuario_id)) {
            $this->session->set_flashdata('error', 'Um Administrador não pode ser Deletado');
            redirect('usuarios');
        }
        if ($this->ion_auth->delete_user($usuario_id)) {
            $this->session->set_flashdata('sucesso', 'Usuário apagado com sucesso!');
            redirect('usuarios');
        } else {
            $this->session->set_flashdata('error', 'Erro, registro não pode ser apagado');
            redirect('usuarios');
        }
    }

    public function email_check($email)
    {
        $usuario_id = $this->input->post('usuario_id');

        if ($this->core_model->get_by_id('users', ['email' => $email, 'id !=' => $usuario_id])) {
            $this->form_validation->set_message('email_check', 'Este e-mail já existe na base');

            return false;
        } else {
            return true;
        }
    }

    public function username_check($username)
    {
        $usuario_id = $this->input->post('usuario_id');

        if ($this->core_model->get_by_id('users', ['username' => $username, 'id !=' => $usuario_id])) {
            $this->form_validation->set_message('username_check', 'Este Usuário já existe na base');

            return false;
        } else {
            return true;
        }
    }
}
