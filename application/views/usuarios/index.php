        <?php $this->load->view('layout/sidebar'); ?>

            <!-- Main Content -->
            <div id="content">

        <?php $this->load->view('layout/navbar'); ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    
                    <!-- breadcrumb -->
                    <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a title="Home" href="<?php echo base_url('home'); ?>"><i class="fas fa-home"></i></a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo $titulo; ?></li>

                    </ol>
                    </nav>
                    <!-- LAYOUT DAS MENSAGENS -->
                    <?php $this->load->view('layout/mensagens'); ?>
                                       
                    
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <a title="Cadastrar novo Usuário" href="<?php echo base_url('usuarios/add'); ?>" class="btn btn-success btn-sm float-right"><i class="fas fa-plus-circle"></i>&nbspNovo</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>#ID</th>
                                            <th>Usuário</th>
                                            <th>Login/E-mail</th>
                                            <th>Perfil</th>
                                            <th>Ativo</th>
                                            <th class="text-right nosort">Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($usuarios as $user): ?>

                                        <tr>
                                            <td><?php echo $user->id; ?></td>
                                            <td><?php echo $user->username; ?></td>
                                            <td><?php echo $user->email; ?></td>
                                            <td>
                                            <?php
                                                //recupera da base de dados o perfil do grupo
                                                $user_groups = $this->ion_auth->get_users_groups($user->id)->row()->id;

                                                echo ($user_groups == 1) ? 'Administrador' : '';
                                                echo ($user_groups == 2) ? 'Usuário' : '';
                                                echo ($user_groups == 3) ? 'Técnico' : '';

                                            ?> 
                                            </td>
                                            <td><?php echo ($user->active == 1) ? '<span class="badge badge-info">Ativo</span>' : '<span class="badge badge-warning">Inativo</span>'; ?></td>
                                            <td class="text-right">
                                                <a title="Editar" href="<?php echo base_url('usuarios/edit/'.$user->id); ?>" class="btn btn-sm btn-primary"><i class="fas fa-user-edit"></i></a>
                                                <a title="Excluir" href="javascript(void)" data-toggle="modal" data-target="#user-<?php echo $user->id; ?>" class="btn btn-sm btn-danger"><i class="fas fa-user-times"></i></a>
                                                
                                            </td>
                                        </tr>
                                        <!-- Logout Modal-->
                                        <div class="modal fade" id="user-<?php echo $user->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Tem certeza que quer deletar?</h5>
                                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">Para execluir o usuário cliente em <strong>SIM!</strong>.</div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-primary btn-sm" type="button" data-dismiss="modal">Não</button>
                                                        <a class="btn btn-danger btn-sm" href="<?php echo base_url('usuarios/del/'.$user->id); ?>">Sim</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>                                    


                                    <?php endforeach; ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

       