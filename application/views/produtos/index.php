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
                            <a title="Cadastrar novo Produto" href="<?php echo base_url('produtos/add'); ?>" class="btn btn-success btn-sm float-right"><i class="fas fa-plus-circle"></i>&nbspNovo</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>#ID</th>
                                            <th>Código</th>
                                            
                                            <th>Produto</th>
                                            <th>Marca</th>
                                            <th>Categoria</th>
                                            <th>Qtde Minima</th>
                                            <th>Qtde Estoque</th>
                                            <th>Ativo</th>
                                            <th class="text-center nosort">Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($produtos as $produto): ?>

                                        <tr>
                                            <td><?php echo $produto->produto_id; ?></td>
                                            <td><?php echo $produto->produto_codigo; ?></td>
                                            <td><?php echo $produto->produto_descricao;                                               
                                                if (file_exists("public/img/produtos/".$produto->produto_codigo.".jpg")){

                                                   echo " <a title='Foto' href='javascript(void)' data-toggle='modal' data-target='#foto-".$produto->produto_id."' ><i class='far fa-image'></i></a>";
                                                } 
                                            ?> 
                                            </td>
                                            <td><?php echo $produto->produto_marca; ?></td>
                                            <td><?php echo $produto->produto_categoria; ?></td>
                                            <td title="Qtde Mínimo" class="text-center"><?php echo '<span class="badge badge-success">'.$produto->produto_estoque_minimo.'</span>'; ?></td>
                                            <td title="Qtde Estoque" class="text-center"><?php echo ($produto->produto_estoque_minimo == $produto->produto_qtde_estoque ? '<span class="badge badge-warning text-gray-900">'.$produto->produto_qtde_estoque.'</span> <strong>Pedir +</strong>' : '<span class="badge badge-info">'.$produto->produto_qtde_estoque.'</span>');  ?></td>
                                            <td><?php echo ($produto->produto_ativo == 1) ? '<span class="badge badge-info">Ativo</span>' : '<span class="badge badge-warning">Inativo</span>'; ?></td>
                                            <td class="text-center">
                                                <a title="Editar" href="<?php echo base_url('produtos/edit/'.$produto->produto_id); ?>" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
                                                <a title="Excluir" href="javascript(void)" data-toggle="modal" data-target="#produto-<?php echo $produto->produto_id; ?>" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                                            </td>
                                        </tr>
                                        <!-- FOTO Modal-->
                                        <div class="modal fade" id="foto-<?php echo $produto->produto_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    
                                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    
                                                    <div class="modal-body">
                                                    <img  width="450" height="350" src="public/img/produtos/<?php echo $produto->produto_codigo; ?>.jpg" class="rounded" alt="<?php echo $produto->produto_descricao; ?>">
                                                    </div>
                            
                                                </div>
                                            </div>
                                        </div>                                         
                                        <!-- DELETAR Modal-->
                                        <div class="modal fade" id="produto-<?php echo $produto->produto_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                                                        <a class="btn btn-danger btn-sm" href="<?php echo base_url('produtos/del/'.$produto->produto_id); ?>">Sim</a>
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

       