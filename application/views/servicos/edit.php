        <?php $this->load->view('layout/sidebar'); ?>

            <!-- Main Content -->
            <div id="content">

        <?php $this->load->view('layout/navbar'); ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    
                    <!-- breadcrumb -->
                    <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url('servicos'); ?>">Serviços</a></li>
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
                            <form method="POST" name="form_edit">
                            <p><i class="fas fa-clock"></i>&nbsp<?php echo formata_data_banco_com_hora($servicos->servico_data_alteracao); ?>&nbsp<strong>Ultima Atualização</strong></p>
                            <fieldset class="mt-0 border p-2">
                               
                                <legend class="form-control">
                                    <i class="far fa-list-alt"></i>&nbspServiços
                                </legend>
                                <div class="form-group row">
                                    <div class="col-md-8">
                                        <label>Serviço</label>
                                        <input type="text" class="form-control" name="servico_nome" placeholder="Digite o Serviço" value="<?php echo $servicos->servico_nome; ?>" > 
                                        <?php echo form_error('servico_nome', '<small class="form-text text-danger"><i class="fas fa-exclamation-triangle"></i>&nbsp', '</small>'); ?> 
                                    </div>
                                    <div class="col-md-2">
                                        <label>Preço</label>
                                        <input type="text" class="form-control money" name="servico_preco" placeholder="Digite o valor" value="<?php echo $servicos->servico_preco; ?>" > 
                                        <?php echo form_error('servico_preco', '<small class="form-text text-danger"><i class="fas fa-exclamation-triangle"></i>&nbsp', '</small>'); ?>                                        
                                    </div>    
                                    <div class="col-md-2">
                                        <label>Status</label>
                                        <select class="form-control" name="servico_ativo">
                                            <option value="0" <?php echo ($servicos->servico_ativo == 0) ? 'selected' : ''; ?>>Inativo</option>
                                            <option value="1" <?php echo ($servicos->servico_ativo == 1) ? 'selected' : ''; ?>>Ativo</option>
                                        </select>
                                    </div>                                                    
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12">
                                           <label>Descrição do Serviço</label>
                                            <textarea class="form-control" name="servico_descricao"><?php echo $servicos->servico_descricao; ?></textarea> 
                                            <?php echo form_error('servico_descricao', '<small class="form-text text-danger"><i class="fas fa-exclamation-triangle"></i>&nbsp', '</small>'); ?>                                    
                                    </div>                             
                                </div>                       
                            </fieldset>
 
                           
                            <input type="hidden" name="servico_id" value="<?php echo $servicos->servico_id; ?>" >       
                            <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save"></i>&nbspSalvar</button>

                            <a title="Voltar" href="<?php echo base_url($this->router->fetch_class()); ?>" class="btn btn-success btn-sm"><i class="fas fa-undo-alt"></i>&nbspVoltar</a>
                            </form>      

                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

       