        <?php $this->load->view('layout/sidebar'); ?>

            <!-- Main Content -->
            <div id="content">

        <?php $this->load->view('layout/navbar'); ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    
                    <!-- breadcrumb -->
                    <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url('receber'); ?>">Contas a Receber</a></li>
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
                            <p><i class="fas fa-clock"></i>&nbsp<?php echo formata_data_banco_com_hora($conta_receber->conta_receber_data_alteracao); ?>&nbsp<strong>Ultima Atualização</strong></p>
                            <fieldset class="mt-0 border p-2">                               
                                <legend class="form-control">
                                    <i class="fas fa-money-bill-alt"></i>&nbspDados da Conta 
                                </legend>
                                
                                <div class="form-group row">
                                                                           
                                    <div class="col-md-6">
                                        <label>Clientes</label>
                                        <select class="form-control" name="conta_receber_cliente_id">
                                            <?php foreach ($clientes as $cliente):?>
                                            <option value="<?php echo $cliente->cliente_id; ?>" <?php echo ($cliente->cliente_id == $conta_receber->conta_receber_cliente_id ? 'selected': ''); ?> <?php echo ($cliente->cliente_ativo == 0 ? 'disabled' : ''); ?>><?php echo ($cliente->cliente_ativo == 1 ? $cliente->cliente_nome.'' : $cliente->cliente_nome.'&nbsp>>INATIVO<<');  ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <?php echo form_error('conta_receber_cliente_id', '<small class="form-text text-danger"><i class="fas fa-exclamation-triangle"></i>&nbsp', '</small>'); ?>
                                    </div>
                                    <div class="col-md-2">
                                      <label>Data de vencimento</label>
                                        <input type="date" class="form-control" name="conta_receber_data_vencto"  value="<?php echo $conta_receber->conta_receber_data_vencto; ?>" >                                     
                                        <?php echo form_error('conta_receber_data_vencto', '<small class="form-text text-danger"><i class="fas fa-exclamation-triangle"></i>&nbsp', '</small>'); ?>                                        
                                    </div>                                      
                                 
                                    <div class="col-md-2">
                                      <label>Valor Conta</label>
                                      <div class="input-group">  
                                        <span class="input-group-text">R$</span>
                                        <input type="text" class="form-control money" name="conta_receber_valor" placeholder="Digite o valor" value="<?php echo $conta_receber->conta_receber_valor; ?>" >                                     
                                        <?php echo form_error('conta_receber_valor', '<small class="form-text text-danger"><i class="fas fa-exclamation-triangle"></i>&nbsp', '</small>'); ?>                                        
                                      </div>  
                                    </div>
                                    <div class="col-md-2">
                                        <label>Situação</label>
                                        <select class="form-control" name="conta_receber_status">
                                            <option value="1" <?php echo ($conta_receber->conta_receber_status == 1 ? 'selected': ''); ?>>Paga</option>
                                            <option value="0" <?php echo ($conta_receber->conta_receber_status == 0 ? 'selected': ''); ?>>Pendente</option>
                                            
                                        </select>
                                        
                                    </div>
                                </div>                                      
                            </fieldset>
                            <fieldset class="mt-2 border p-2">                               
                                <legend class="form-control">
                                    <i class="fas fa-comment"></i>&nbspObservações
                                </legend>
                                
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <label>Observações da Conta</label>
                                        <textarea class="form-control" name="conta_receber_obs"><?php echo $conta_receber->conta_receber_obs; ?></textarea>
                                        <?php echo form_error('conta_receber_obs', '<small class="form-text text-danger"><i class="fas fa-exclamation-triangle"></i>&nbsp', '</small>'); ?>                                       
                                    </div>                                                                          
                                </div>
                            
                            </fieldset>                         
 
                           
                            <input type="hidden" name="conta_receber_id" value="<?php echo $conta_receber->conta_receber_id; ?>" >       
                           
                            <button type="submit" class="btn btn-primary btn-sm" <?php echo ($conta_receber->conta_receber_status == 1 ? 'disabled': ''); ?>><i class="fas fa-save"></i>&nbspSalvar</button>

                            <a title="Voltar" href="<?php echo base_url($this->router->fetch_class()); ?>" class="btn btn-success btn-sm"><i class="fas fa-undo-alt"></i>&nbspVoltar</a>
                            </form>      

                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

       