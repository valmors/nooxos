        <?php $this->load->view('layout/sidebar'); ?>

            <!-- Main Content -->
            <div id="content">

        <?php $this->load->view('layout/navbar'); ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    
                    <!-- breadcrumb -->
                    <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url('vendedores'); ?>">Vendedores</a></li>
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
                            <p><i class="fas fa-clock"></i>&nbsp<?php echo formata_data_banco_com_hora($vendedores->vendedor_data_alteracao); ?>&nbsp<strong>Ultima Atualização</strong></p>
                            <fieldset class="mt-0 border p-2">
                               
                                <legend class="form-control">
                                    <i class="fas fa-money-check"></i>&nbspVendedor - Matrícula&nbsp<strong><?php echo $vendedores->vendedor_codigo; ?></strong>
                                </legend>
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label>Nome Completo</label>
                                        <input type="text" class="form-control" name="vendedor_nome_completo" placeholder="Digite o Nome Completo" value="<?php echo $vendedores->vendedor_nome_completo; ?>" > 
                                        <?php echo form_error('vendedor_nome_completo', '<small class="form-text text-danger"><i class="fas fa-exclamation-triangle"></i>&nbsp', '</small>'); ?> 
                                    </div>
                                    <div class="col-md-3">
                                        <label>CPF</label>
                                        <input type="text" class="form-control cpf" name="vendedor_cpf" placeholder="Digite o CPF" value="<?php echo $vendedores->vendedor_cpf; ?>" > 
                                        <?php echo form_error('vendedor_cpf', '<small class="form-text text-danger"><i class="fas fa-exclamation-triangle"></i>&nbsp', '</small>'); ?>                                        
                                    </div>    

                                    <div class="col-md-3">
                                        <label>RG</label>
                                        <input type="text" class="form-control rg" name="vendedor_rg" placeholder="Digite o RG" value="<?php echo $vendedores->vendedor_rg; ?>" > 
                                        <?php echo form_error('vendedor_ie', '<small class="form-text text-danger"><i class="fas fa-exclamation-triangle"></i>&nbsp', '</small>'); ?>                                        
                                    </div>                                                     
                                </div>                                   
                                <div class="form-grupo row">
      
                                    <div class="col-md-6">
                                        <label>Email</label>
                                        <input type="email" class="form-control" name="vendedor_email" placeholder="Email" value="<?php echo $vendedores->vendedor_email; ?>" > 
                                        <?php echo form_error('vendedor_email', '<small class="form-text text-danger"><i class="fas fa-exclamation-triangle"></i>&nbsp', '</small>'); ?>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Telefone</label>
                                        <input type="text" class="form-control tel" id="telefone" name="vendedor_telefone" placeholder="Telefone"  value="<?php echo $vendedores->vendedor_telefone; ?>" > 
                                        <?php echo form_error('vendedor_telefone', '<small class="form-text text-danger"><i class="fas fa-exclamation-triangle"></i>&nbsp', '</small>'); ?>
                                    </div>
        
                                    <div class="col-md-3">
                                        <label>Celular</label>
                                        <input type="text" class="form-control cel" name="vendedor_celular" placeholder="Celular"  value="<?php echo $vendedores->vendedor_celular; ?>" > 
                                        <?php echo form_error('vendedor_celular', '<small class="form-text text-danger"><i class="fas fa-exclamation-triangle"></i>&nbsp', '</small>'); ?>
                                    </div>                                      
        
                                </div>                              
                                                     
                            </fieldset>
                            
                            <fieldset class="mt-2 mb-2 border p-2">
                                
                                <legend class="form-control"><i class="fas fa-map-marked-alt"></i>&nbsp Endereço</legend>
                                                                                               
                            <div class="form-group row">

                            <div class="col-md-2">
                                    <label>CEP</label>
                                    <input type="text" class="form-control cep" id="cep" name="vendedor_cep" placeholder="CEP" value="<?php echo $vendedores->vendedor_cep; ?>" > 
                                    <?php echo form_error('vendedor_cep', '<small class="form-text text-danger"><i class="fas fa-exclamation-triangle"></i>&nbsp', '</small>'); ?>
                                </div>   

                                <div class="col-md-6">
                                    <label>Endereço</label>
                                    <input type="text" class="form-control" id="rua" name="vendedor_endereco" placeholder="Endereço" value="<?php echo $vendedores->vendedor_endereco; ?>" > 
                                    <?php echo form_error('vendedor_endereco', '<small class="form-text text-danger"><i class="fas fa-exclamation-triangle"></i>&nbsp', '</small>'); ?>
                                </div>

                                <div class="col-md-4">
                                    <label>Bairro</label>
                                    <input type="text" class="form-control" id="bairro" name="vendedor_bairro" placeholder="Bairro" value="<?php echo $vendedores->vendedor_bairro; ?>" > 
                                    <?php echo form_error('vendedor_bairro', '<small class="form-text text-danger"><i class="fas fa-exclamation-triangle"></i>&nbsp', '</small>'); ?>
                                </div>                                                                  
                                                                                                        
                            </div>       

                            <div class="form-group row">

                                <div class="col-md-2">
                                    <label>Número</label>
                                    <input type="text" class="form-control" id="numero"  name="vendedor_numero_endereco" placeholder="Número" value="<?php echo $vendedores->vendedor_numero_endereco; ?>" > 
                                    <?php echo form_error('vendedor_numero_endereco', '<small class="form-text text-danger"><i class="fas fa-exclamation-triangle"></i>&nbsp', '</small>'); ?>
                                </div>  

                                <div class="col-md-3">
                                    <label>Cidade</label>
                                    <input type="text" class="form-control" id="cidade" name="vendedor_cidade" placeholder="Cidade" value="<?php echo $vendedores->vendedor_cidade; ?>" > 
                                    <?php echo form_error('vendedor_cidade', '<small class="form-text text-danger"><i class="fas fa-exclamation-triangle"></i>&nbsp', '</small>'); ?>
                                </div>   

                                <div class="col-md-2">
                                    <label>Estado</label>
                                    <input type="text" class="form-control"  id="uf" name="vendedor_estado" placeholder="UF" value="<?php echo $vendedores->vendedor_estado; ?>" > 
                                    <?php echo form_error('vendedor_estado', '<small class="form-text text-danger"><i class="fas fa-exclamation-triangle"></i>&nbsp', '</small>'); ?>
                                </div>  
                                <div class="col-md-5">
                                    <label>Complemento</label>
                                    <input type="text" class="form-control"  name="vendedor_complemento" placeholder="Complemento" value="<?php echo $vendedores->vendedor_complemento; ?>" > 
                                    <?php echo form_error('vendedor_complemento', '<small class="form-text text-danger"><i class="fas fa-exclamation-triangle"></i>&nbsp', '</small>'); ?>
                                </div>                                   
        
                            </div>       
                                                                                             
                            </fieldset>

                            <fieldset class="mt-2 mb-2 border p-2">
                                
                                <legend class="form-control"><i class="fas fa-tools"></i>&nbsp Configurações</legend>
                                                                                               
                                <div class="form-group row">                            
                                <div class="col-md-2">
                                    <label>Status</label>
                                    <select class="form-control" name="vendedor_ativo">
                                        <option value="0" <?php echo ($vendedores->vendedor_ativo == 0) ? 'selected' : ''; ?>>Inativo</option>
                                        <option value="1" <?php echo ($vendedores->vendedor_ativo == 1) ? 'selected' : ''; ?>>Ativo</option>
                                    </select>
                                </div>                                                        
                                <div class="col-md-10">
                                       <label>Observações</label>
                                        <textarea class="form-control" name="vendedor_obs"><?php echo $vendedores->vendedor_obs; ?></textarea> 
                                        <?php echo form_error('vendedor_obs', '<small class="form-text text-danger"><i class="fas fa-exclamation-triangle"></i>&nbsp', '</small>'); ?>                                    
                                </div>                                
                                    
                            </div>                                                                                                                     
                            </fieldset>
                            <input type="hidden" name="vendedor_codigo" value="<?php echo $vendedores->vendedor_codigo; ?>" > 
                            <input type="hidden" name="vendedor_id" value="<?php echo $vendedores->vendedor_id; ?>" >       
                            <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save"></i>&nbspSalvar</button>

                            <a title="Voltar" href="<?php echo base_url($this->router->fetch_class()); ?>" class="btn btn-success btn-sm"><i class="fas fa-undo-alt"></i>&nbspVoltar</a>
                            </form>      

                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

       