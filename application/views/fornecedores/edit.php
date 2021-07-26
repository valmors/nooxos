        <?php $this->load->view('layout/sidebar'); ?>

            <!-- Main Content -->
            <div id="content">

        <?php $this->load->view('layout/navbar'); ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    
                    <!-- breadcrumb -->
                    <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url('fornecedores'); ?>">Fornecedores</a></li>
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
                            <p><i class="fas fa-clock"></i>&nbsp<?php echo formata_data_banco_com_hora($fornecedor->fornecedor_data_alteracao); ?>&nbsp<strong>Ultima Atualização</strong></p>
                            <fieldset class="mt-0 border p-2">
                               
                                <legend class="form-control">
                                    <i class="fas fa-user-tag"></i>&nbspFornecedores
                                </legend>
                                
                                <div class="form-grupo row">
                                    <div class="col-md-3">
                                        <label>CNPJ</label>
                                        <input type="text" class="form-control cnpj" id="cnpj" name="fornecedor_cnpj" placeholder="Digite o CNPJ" value="<?php echo $fornecedor->fornecedor_cnpj; ?>" > 
                                        <?php echo form_error('fornecedor_cnpj', '<small class="form-text text-danger"><i class="fas fa-exclamation-triangle"></i>&nbsp', '</small>'); ?>                                        
                                    </div>    

                                    <div class="col-md-3">
                                        <label>IE</label>
                                        <input type="text" class="form-control" name="fornecedor_ie" placeholder="Digite o IE" value="<?php echo $fornecedor->fornecedor_ie; ?>" > 
                                        <?php echo form_error('fornecedor_ie', '<small class="form-text text-danger"><i class="fas fa-exclamation-triangle"></i>&nbsp', '</small>'); ?>                                        
                                    </div> 
                                    <div class="col-md-6">
                                        <label>Email</label>
                                        <input type="email" class="form-control" id="email" name="fornecedor_email" placeholder="Email" value="<?php echo $fornecedor->fornecedor_email; ?>" > 
                                        <?php echo form_error('fornecedor_email', '<small class="form-text text-danger"><i class="fas fa-exclamation-triangle"></i>&nbsp', '</small>'); ?>
                                    </div>
        
                                </div>                              
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <label>Razão Social</label>
                                        <input type="text" class="form-control" id="razao" name="fornecedor_razao" placeholder="Digite a Razão Social" value="<?php echo $fornecedor->fornecedor_razao; ?>" > 
                                        <?php echo form_error('fornecedor_razao', '<small class="form-text text-danger"><i class="fas fa-exclamation-triangle"></i>&nbsp', '</small>'); ?> 
                                    </div>
                                    
                                    <div class="col-md-5">
                                        <label>Nome Fantasia</label>
                                        <input type="text" class="form-control" id="nfantasia" name="fornecedor_nome_fantasia" placeholder="Digite o Nome Fantasia" value="<?php echo $fornecedor->fornecedor_nome_fantasia; ?>" > 
                                        <?php echo form_error('fornecedor_nome_fantasia', '<small class="form-text text-danger"><i class="fas fa-exclamation-triangle"></i>&nbsp', '</small>'); ?>
                                    </div>                  
                                    <div class="col-md-3">
                                        <label>Data Abertura</label>
                                        <input type="textdate" class="form-control" id="abertura" name="fornecedor_data_abertura" placeholder="Data de Abertura" value="<?php echo $fornecedor->fornecedor_data_abertura; ?>" > 
                                        <?php echo form_error('fornecedor_data_abertura', '<small class="form-text text-danger"><i class="fas fa-exclamation-triangle"></i>&nbsp', '</small>'); ?>
                                    </div>   
                                </div>      


                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <label>Telefone</label>
                                        <input type="text" class="form-control tel" id="telefone" name="fornecedor_telefone" placeholder="Telefone"  value="<?php echo $fornecedor->fornecedor_telefone; ?>" > 
                                        <?php echo form_error('fornecedor_telefone', '<small class="form-text text-danger"><i class="fas fa-exclamation-triangle"></i>&nbsp', '</small>'); ?>
                                    </div>
        
                                    <div class="col-md-3">
                                        <label>Celular</label>
                                        <input type="text" class="form-control cel" name="fornecedor_celular" placeholder="Celular"  value="<?php echo $fornecedor->fornecedor_celular; ?>" > 
                                        <?php echo form_error('fornecedor_celular', '<small class="form-text text-danger"><i class="fas fa-exclamation-triangle"></i>&nbsp', '</small>'); ?>
                                    </div>      
                                    <div class="col-md-6">
                                        <label>Nome do Contato da Empresa</label>
                                        <input type="text" class="form-control" name="fornecedor_contato" placeholder="Contato"  value="<?php echo $fornecedor->fornecedor_contato; ?>" > 
                                        <?php echo form_error('fornecedor_contato', '<small class="form-text text-danger"><i class="fas fa-exclamation-triangle"></i>&nbsp', '</small>'); ?>
                                    </div>                                     
                            </div>                                                        
                            </fieldset>
                            
                            <fieldset class="mt-2 mb-2 border p-2">
                                
                                <legend class="form-control"><i class="fas fa-map-marked-alt"></i>&nbsp Endereço</legend>
                                                                                               
                            <div class="form-group row">

                            <div class="col-md-2">
                                    <label>CEP</label>
                                    <input type="text" class="form-control cep" id="cep" name="fornecedor_cep" placeholder="CEP" value="<?php echo $fornecedor->fornecedor_cep; ?>" > 
                                    <?php echo form_error('fornecedor_cep', '<small class="form-text text-danger"><i class="fas fa-exclamation-triangle"></i>&nbsp', '</small>'); ?>
                                </div>   

                                <div class="col-md-6">
                                    <label>Endereço</label>
                                    <input type="text" class="form-control" id="rua" name="fornecedor_endereco" placeholder="Endereço" value="<?php echo $fornecedor->fornecedor_endereco; ?>" > 
                                    <?php echo form_error('fornecedor_endereco', '<small class="form-text text-danger"><i class="fas fa-exclamation-triangle"></i>&nbsp', '</small>'); ?>
                                </div>

                                <div class="col-md-4">
                                    <label>Bairro</label>
                                    <input type="text" class="form-control" id="bairro" name="fornecedor_bairro" placeholder="Bairro" value="<?php echo $fornecedor->fornecedor_bairro; ?>" > 
                                    <?php echo form_error('fornecedor_bairro', '<small class="form-text text-danger"><i class="fas fa-exclamation-triangle"></i>&nbsp', '</small>'); ?>
                                </div>                                                                  
                                                                                                        
                            </div>       

                            <div class="form-group row">

                                <div class="col-md-2">
                                    <label>Número</label>
                                    <input type="text" class="form-control" id="numero"  name="fornecedor_numero_endereco" placeholder="Número" value="<?php echo $fornecedor->fornecedor_numero_endereco; ?>" > 
                                    <?php echo form_error('fornecedor_numero_endereco', '<small class="form-text text-danger"><i class="fas fa-exclamation-triangle"></i>&nbsp', '</small>'); ?>
                                </div>  

                                <div class="col-md-3">
                                    <label>Cidade</label>
                                    <input type="text" class="form-control" id="cidade" name="fornecedor_cidade" placeholder="Cidade" value="<?php echo $fornecedor->fornecedor_cidade; ?>" > 
                                    <?php echo form_error('fornecedor_cidade', '<small class="form-text text-danger"><i class="fas fa-exclamation-triangle"></i>&nbsp', '</small>'); ?>
                                </div>   

                                <div class="col-md-2">
                                    <label>Estado</label>
                                    <input type="text" class="form-control"  id="uf" name="fornecedor_estado" placeholder="UF" value="<?php echo $fornecedor->fornecedor_estado; ?>" > 
                                    <?php echo form_error('fornecedor_estado', '<small class="form-text text-danger"><i class="fas fa-exclamation-triangle"></i>&nbsp', '</small>'); ?>
                                </div>  
                                <div class="col-md-5">
                                    <label>Complemento</label>
                                    <input type="text" class="form-control"  name="fornecedor_complemento" placeholder="Complemento" value="<?php echo $fornecedor->fornecedor_complemento; ?>" > 
                                    <?php echo form_error('fornecedor_complemento', '<small class="form-text text-danger"><i class="fas fa-exclamation-triangle"></i>&nbsp', '</small>'); ?>
                                </div>                                   
        
                            </div>       
                                                                                             
                            </fieldset>

                            <fieldset class="mt-2 mb-2 border p-2">
                                
                                <legend class="form-control"><i class="fas fa-tools"></i>&nbsp Configurações</legend>
                                                                                               
                                <div class="form-group row">                            
                                <div class="col-md-2">
                                    <label>Status</label>
                                    <select class="form-control" name="fornecedor_ativo">
                                        <option value="0" <?php echo ($fornecedor->fornecedor_ativo == 0) ? 'selected' : ''; ?>>Inativo</option>
                                        <option value="1" <?php echo ($fornecedor->fornecedor_ativo == 1) ? 'selected' : ''; ?>>Ativo</option>
                                    </select>
                                </div>                                                        
                                <div class="col-md-10">
                                       <label>Observações</label>
                                        <textarea class="form-control" name="fornecedor_obs"><?php echo $fornecedor->fornecedor_obs; ?></textarea> 
                                        <?php echo form_error('fornecedor_obs', '<small class="form-text text-danger"><i class="fas fa-exclamation-triangle"></i>&nbsp', '</small>'); ?>                                    
                                </div>                                
                                    
                            </div>                                                                                                                     
                            </fieldset>

                            <input type="hidden" name="fornecedor_id" value="<?php echo $fornecedor->fornecedor_id; ?>" >       
                            <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save"></i>&nbspSalvar</button>

                            <a title="Voltar" href="<?php echo base_url($this->router->fetch_class()); ?>" class="btn btn-success btn-sm"><i class="fas fa-undo-alt"></i>&nbspVoltar</a>
                            </form>      

                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

       