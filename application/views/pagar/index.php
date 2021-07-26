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
                         <i class="fas fa-calendar-alt"></i>&nbspData Atual&nbsp  <?php echo date('Y-m-d H:i:s');?> <a title="Cadastrar nova Conta" href="<?php echo base_url('pagar/add'); ?>" class="btn btn-success btn-sm float-right"><i class="fas fa-plus-circle"></i>&nbspNova</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>#ID</th>
                                            <th>Fornecedor</th>
                                            <th>Valor Conta</th>
                                            <th>Data Vencimento</th>
                                            <th>Data Pagamento</th>
                                            <th>Situação</th>
                                            <th class="text-center nosort">Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($contas_pagar as $conta): ?>

                                        <tr>
                                            <td><?php echo $conta->conta_pagar_id; ?></td>
                                            <td><?php echo $conta->fornecedor; ?></td>
                                            <td>R$<?php echo $conta->conta_pagar_valor; ?></td>
                                            <td><?php echo formata_data_banco_sem_hora($conta->conta_pagar_data_vencimento); ?></td>
                                            <td><?php echo ($conta->conta_pagar_status == 1 ? formata_data_banco_com_hora($conta->conta_pagar_data_pagamento):'Aguardando Pagamento'); ?></td>
                                            
                                            <td>
                                               <?php 
                                                if($conta->conta_pagar_status == 1){
                                                    echo '<span class="badge badge-primary btn-sm">Paga</span>';
                                                } else if (strtotime($conta->conta_pagar_data_vencimento) > strtotime(date('Y-m-d'))) {
                                                    echo '<span class="badge badge-secondary btn-sm">A Pagar</span>';
                                                } else if (strtotime($conta->conta_pagar_data_vencimento) == strtotime(date('Y-m-d'))){
                                                    echo '<span class="badge badge-warning text-dark btn-sm">Vence Hoje</span>';
                                                } else {
                                                    echo '<span class="badge badge-danger btn-sm">Vencida</span>';
                                                }
                                                ?>
                                            </td>
                                            <td class="text-center">
                                                <a title="Editar" href="<?php echo base_url('pagar/edit/'.$conta->conta_pagar_id); ?>" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
                                                <a title="Excluir" href="javascript(void)" data-toggle="modal" data-target="#pagar-<?php echo $conta->conta_pagar_id; ?>" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                                                
                                            </td>
                                        </tr>
                                        
                                        <!-- DELETAR Modal-->
                                        <div class="modal fade" id="pagar-<?php echo $conta->conta_pagar_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Tem certeza que quer deletar?</h5>
                                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">Para execluir clique <strong>SIM!</strong></div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-primary btn-sm" type="button" data-dismiss="modal">Não</button>
                                                        <a class="btn btn-danger btn-sm" href="<?php echo base_url('pagar/del/'.$conta->conta_pagar_id); ?>">Sim</a>
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

       