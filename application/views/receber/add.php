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
                            <form method="POST" name="form_add">
                            
                            <fieldset class="mt-0 border p-2">                               
                                <legend class="form-control">
                                    <i class="fas fa-money-bill-alt"></i>&nbspDados da Conta 
                                </legend>
                                
                                <div class="form-group row">
                                                                           
                                    <div class="col-md-6">
                                        <label>Clientes</label>
                                        <select class="form-control" name="conta_receber_cliente_id">
                                            <option value="" selected>Selecione o Cliente</option>
                                            <?php foreach ($clientes as $cliente):?>
                                            <option value="<?php echo $cliente->cliente_id; ?>"><?php echo $cliente->cliente_nome;  ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <?php echo form_error('conta_receber_cliente_id', '<small class="form-text text-danger"><i class="fas fa-exclamation-triangle"></i>&nbsp', '</small>'); ?>
                                    </div>
                                    <div class="col-md-2">
                                      <label>Data de vencimento</label>
                                        <input type="date" class="form-control" name="conta_receber_data_vencto"  value="" >                                     
                                        <?php echo form_error('conta_receber_data_vencto', '<small class="form-text text-danger"><i class="fas fa-exclamation-triangle"></i>&nbsp', '</small>'); ?>                                        
                                    </div>                                      
                                 
                                    <div class="col-md-2">
                                      <label>Valor Conta</label>
                                      <div class="input-group">  
                                        <span class="input-group-text">R$</span>
                                        <input type="text" class="form-control money" name="conta_receber_valor" placeholder="Digite o valor" value="<?php echo set_value('conta_receber_valor'); ?>" >                                     
                                        <?php echo form_error('conta_receber_valor', '<small class="form-text text-danger"><i class="fas fa-exclamation-triangle"></i>&nbsp', '</small>'); ?>                                        
                                      </div>  
                                    </div>
                                    <div class="col-md-2">
                                        <label>Situação</label>
                                        <select class="form-control" name="conta_receber_status">
                                            <option value="" selected>Situaçaõ</option>
                                            <option value="1">Paga</option>
                                            <option value="0">Pendente</option>
                                            
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
                                        <label>Observações</label>
                                        <textarea class="form-control" name="conta_receber_obs"><?php echo set_value('conta_receber_obs'); ?></textarea>
                                        <?php echo form_error('conta_receber_obs', '<small class="form-text text-danger"><i class="fas fa-exclamation-triangle"></i>&nbsp', '</small>'); ?>                                       
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

       