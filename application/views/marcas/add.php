        <?php $this->load->view('layout/sidebar'); ?>

            <!-- Main Content -->
            <div id="content">

        <?php $this->load->view('layout/navbar'); ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    
                    <!-- breadcrumb -->
                    <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url('marcas'); ?>">Marcas</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?php echo $titulo; ?></li>

                    </ol>
                    </nav>
                    
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                     <!-- Card Header barra cinza acima do formulário
                        <div class="card-header py-3">
                            
                        </div> -->
                        <div class="card-body">
                         <!-- FORMULÁRIO-->
                            <form method="POST" name="form_add">
                           
                            <fieldset class="mt-0 border p-2">
                               
                                <legend class="form-control">
                                    <i class="fas fa-dumpster"></i>&nbspMarcas
                                </legend>
                                <div class="form-group row">
                                    <div class="col-md-8">
                                        <label>Marca</label>
                                        <input type="text" class="form-control" name="marca_nome" placeholder="Digite a Marca" value="<?php echo set_value('marca_nome'); ?>" > 
                                        <?php echo form_error('marca_nome', '<small class="form-text text-danger"><i class="fas fa-exclamation-triangle"></i>&nbsp', '</small>'); ?> 
                                    </div>
 
                                    <div class="col-md-2">
                                        <label>Status</label>
                                        <select class="form-control" name="marca_ativa">
                                            <option value="0">Inativo</option>
                                            <option value="1" selected >Ativo</option>
                                        </select>
                                    </div>                                                    
                                </div>
                                   
                            </fieldset>
    
                            <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save"></i>&nbspSalvar</button>

                            <a title="Voltar" href="<?php echo base_url($this->router->fetch_class()); ?>" class="btn btn-success btn-sm"><i class="fas fa-undo-alt"></i>&nbspVoltar</a>
                            </form>      

                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

       