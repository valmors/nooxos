        <?php $this->load->view('layout/sidebar'); ?>

            <!-- Main Content -->
            <div id="content">

        <?php $this->load->view('layout/navbar'); ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    
                    <!-- breadcrumb -->
                    <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a title="Home" href="<?php echo base_url('Home'); ?>"><i class="fas fa-home"></i></a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo $titulo; ?></li>

                    </ol>
                    </nav>
                    <!-- LAYOUT DAS MENSAGENS -->
                    <?php $this->load->view('layout/mensagens'); ?>
                                                        
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <a title="Cadastrar forma de pagamento" href="<?php echo base_url('modulo/add'); ?>" class="btn btn-success btn-sm float-right"><i class="fas fa-plus-circle"></i>&nbspNova</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>#ID</th>
                                            <th>Forma de Pagamento</th>
                                            <th>Parcelamento</th>
                                            <th>Ativa</th>
                                            <th class="text-right nosort">Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($formas_pagamentos as $forma): ?>

                                        <tr>
                                            <td><?php echo $forma->forma_pagamento_id; ?></td>
                                            <td><?php echo $forma->forma_pagamento_nome; ?></td>
                                            <td><?php echo ($forma->forma_pagamento_aceita_parc == 1) ? '<span class="badge badge-info">Aceita</span>' : '<span class="badge badge-danger">Não</span>'; ?></td>
                                            <td><?php echo ($forma->forma_pagamento_ativa == 1) ? '<span class="badge badge-info">Ativa</span>' : '<span class="badge badge-warning">Inativa</span>'; ?></td>
                                            <td class="text-right">
                                                <a title="Editar" href="<?php echo base_url('modulo/edit/'.$forma->forma_pagamento_id); ?>" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
                                                <a title="Excluir" href="javascript(void)" data-toggle="modal" data-target="#forma_pagamento-<?php echo $forma->forma_pagamento_id; ?>" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                                                
                                            </td>
                                        </tr>
                                        <!-- Logout Modal-->
                                        <div class="modal fade" id="forma_pagamento-<?php echo $forma->forma_pagamento_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Tem certeza que quer deletar?</h5>
                                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body"><strong>SIM!</strong> Para excluir a Categoria.</div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-primary btn-sm" type="button" data-dismiss="modal">Não</button>
                                                        <a class="btn btn-danger btn-sm" href="<?php echo base_url('formas_pagamentos/del/'.$forma->forma_pagamento_id); ?>">Sim</a>
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

       