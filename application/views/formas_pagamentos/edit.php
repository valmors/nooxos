        <?php $this->load->view('layout/sidebar'); ?>

            <!-- Main Content -->
            <div id="content">

        <?php $this->load->view('layout/navbar'); ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    
                    <!-- breadcrumb -->
                    <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url('modulo'); ?>">Formas de Pagamento</a></li>
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
                            <p><i class="fas fa-clock"></i>&nbsp<?php echo formata_data_banco_com_hora($forma_pagamento->forma_pagamento_data_alteracao); ?>&nbsp<strong>Ultima Atualização</strong></p>
                            <fieldset class="mt-0 border p-2">
                               
                                <legend class="form-control">
                                    <i class="fas fa-file-invoice-dollar"></i>&nbspDados da forma de pagamento
                                </legend>
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label>Forma de Pagamento</label>
                                        <input type="text" class="form-control" name="forma_pagamento_nome" placeholder="Digite o Nome" value="<?php echo $forma_pagamento->forma_pagamento_nome; ?>" > 
                                        <?php echo form_error('forma_pagamento_nome', '<small class="form-text text-danger"><i class="fas fa-exclamation-triangle"></i>&nbsp', '</small>'); ?> 
                                    </div>
 
                                    <div class="col-md-3">
                                        <label>Forma Pagamento Ativa</label>
                                        <select class="form-control" name="forma_pagamento_ativa">
                                            <option value="0" <?php echo ($forma_pagamento->forma_pagamento_ativa == 0) ? 'selected' : ''; ?> >Inativo</option>
                                            <option value="1" <?php echo ($forma_pagamento->forma_pagamento_ativa == 1) ? 'selected' : ''; ?>>Ativo</option>
                                        </select>
                                    </div>  
                                    <div class="col-md-3">
                                        <label>Parcelamento</label>
                                        <select class="form-control" name="forma_pagamento_aceita_parc">
                                            <option value="1" <?php echo ($forma_pagamento->forma_pagamento_aceita_parc == 0) ? 'selected' : ''; ?> >Aceito</option>
                                            <option value="0" <?php echo ($forma_pagamento->forma_pagamento_aceita_parc == 1) ? 'selected' : ''; ?>>Não</option>
                                        </select>
                                    </div>                                       
                                </div>
                                
                                
                            </fieldset>
 
                           
                            <input type="hidden" name="forma_pagamento_id" value="<?php echo $forma_pagamento->forma_pagamento_id; ?>" >       
                            <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save"></i>&nbspSalvar</button>

                            <a title="Voltar" href="<?php echo base_url('modulo'); ?>" class="btn btn-success btn-sm"><i class="fas fa-undo-alt"></i>&nbspVoltar</a>
                            </form>      

                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

       