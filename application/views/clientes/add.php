        <?php $this->load->view('layout/sidebar'); ?>

            <!-- Main Content -->
            <div id="content">

        <?php $this->load->view('layout/navbar'); ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    
                    <!-- breadcrumb -->
                    <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url('clientes'); ?>">Clientes</a></li>
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
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="pessoa_fisica" name="cliente_tipo" class="custom-control-input" value="1" <?php echo set_checkbox('cliente_tipo', '1'); ?> >
                                        <label class="custom-control-label" for="pessoa_fisica"><i class="fas fa-user fa-1x"></i>&nbspDados Pessoais</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="pessoa_juridica" name="cliente_tipo" class="custom-control-input" value="2" <?php echo set_checkbox('cliente_tipo', '2'); ?> checked="">
                                        <label class="custom-control-label" for="pessoa_juridica"><i class="fas fa-building"></i>&nbspDados da Empresa</label>
                                    </div>
                                </legend>       

                                <div class="form-grupo row">
                                    <div class="col-md-3">
                                       <div class="pessoa_fisica">
                                       <label>CPF</label> 
                                        <input type="text" class="form-control cpf" name="cliente_cpf" placeholder="Digite seu CPF" value="<?php echo set_value('cliente_cpf'); ?>" > 
                                        <?php echo form_error('cliente_cpf', '<small class="form-text text-danger"><i class="fas fa-exclamation-triangle"></i>&nbsp', '</small>'); ?>                                        
                                       </div>

                                       <div class="pessoa_juridica">
                                       <label>CNPJ</label>
                                        <input type="text" class="form-control cnpj" id="cnpj" name="cliente_cnpj" placeholder="Digite o CNPJ" value="<?php echo set_value('cliente_cnpj'); ?>" > 
                                        <?php echo form_error('cliente_cnpj', '<small class="form-text text-danger"><i class="fas fa-exclamation-triangle"></i>&nbsp', '</small>'); ?>                                        
                                       </div>
                                    </div>    

                                    <div class="col-md-3">
                                       <div class="pessoa_fisica">
                                       <label>RG</label> 
                                        <input type="text" class="form-control rg" name="cliente_rg" placeholder="Digite seu RG" value="<?php echo set_value('cliente_rg'); ?>" > 
                                        <?php echo form_error('cliente_rg', '<small class="form-text text-danger"><i class="fas fa-exclamation-triangle"></i>&nbsp', '</small>'); ?>                                        
                                       </div>

                                       <div class="pessoa_juridica">
                                       <label>IE</label>
                                        <input type="text" class="form-control" name="cliente_ie" placeholder="Digite o IE" value="<?php echo set_value('cliente_ie'); ?>" > 
                                        <?php echo form_error('cliente_ie', '<small class="form-text text-danger"><i class="fas fa-exclamation-triangle"></i>&nbsp', '</small>'); ?>                                        
                                       </div>                                    
                                    </div> 
                                    <div class="col-md-6">
                                        <label>Email</label>
                                        <input type="email" class="form-control" id="email" name="cliente_email" placeholder="Email" value="<?php echo set_value('cliente_email'); ?>" > 
                                        <?php echo form_error('cliente_email', '<small class="form-text text-danger"><i class="fas fa-exclamation-triangle"></i>&nbsp', '</small>'); ?>
                                    </div>
        
                                </div>                                                     
                                                           
                                <div class="form-group row">

                                    <div class="col-md-5">
                                       <div class="pessoa_fisica">
                                       <label>Nome</label>
                                        <input type="text" class="form-control" name="cliente_nome" placeholder="Digite seu Nome" value="<?php echo set_value('cliente_nome'); ?>" > 
                                        <?php echo form_error('cliente_nome', '<small class="form-text text-danger"><i class="fas fa-exclamation-triangle"></i>&nbsp', '</small>'); ?>
                                       </div>
                                       <div class="pessoa_juridica">
                                       <label>Razão Social</label>
                                        <input type="text" class="form-control" id="razao" name="cliente_rsocial" placeholder="Digite a Razão Social" value="<?php echo set_value('cliente_rsocial'); ?>" > 
                                        <?php echo form_error('cliente_rsocial', '<small class="form-text text-danger"><i class="fas fa-exclamation-triangle"></i>&nbsp', '</small>'); ?>
                                       </div>   
                                                                          
                                    </div>

                                    <div class="col-md-4">
                                       <div class="pessoa_fisica">
                                       <label>Sobrenome</label>
                                        <input type="text" class="form-control" name="cliente_sobrenome" placeholder="Digite seu Sobrenome" value="<?php echo set_value('cliente_sobrenome'); ?>" > 
                                        <?php echo form_error('cliente_sobrenome', '<small class="form-text text-danger"><i class="fas fa-exclamation-triangle"></i>&nbsp', '</small>'); ?>
                                       </div>
                                       <div class="pessoa_juridica">
                                       <label>Nome Fantasia</label>
                                        <input type="text" class="form-control" id="fantasia" name="cliente_nfantasia" placeholder="Digite o Nome Fantasia" value="<?php echo set_value('cliente_nfantasia'); ?>" > 
                                        <?php echo form_error('cliente_nfantasia', '<small class="form-text text-danger"><i class="fas fa-exclamation-triangle"></i>&nbsp', '</small>'); ?>
                                       </div> 
                                                                       
                                    </div>

                                    <div class="col-md-3">
                                       <div class="pessoa_fisica">
                                       <label>Data Nascimento</label>
                                        <input type="date" class="form-control form-control-user-date" name="cliente_data_nascimento"  value="<?php echo set_value('cliente_data_nascimento'); ?>" > 
                                        <?php echo form_error('cliente_data_nascimento', '<small class="form-text text-danger"><i class="fas fa-exclamation-triangle"></i>&nbsp', '</small>'); ?>
                                       </div>

                                       <div class="pessoa_juridica">
                                       <label>Data Fundação </label>
                                        <input type="text" class="form-control form-control-user-date" id="abertura" name="cliente_data_fundacao"  value="<?php echo set_value('cliente_data_fudacao'); ?>" > 
                                        <?php echo form_error('cliente_data_fundacao', '<small class="form-text text-danger"><i class="fas fa-exclamation-triangle"></i>&nbsp', '</small>'); ?>
                                       </div>                                    
                                    </div>                     

                                </div>      

                               
                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <label>Telefone</label>
                                        <input type="text" class="form-control tel" id="telefone" name="cliente_telefone" placeholder="Telefone"  value="<?php echo set_value('cliente_telefone'); ?>" > 
                                        <?php echo form_error('cliente_telefone', '<small class="form-text text-danger"><i class="fas fa-exclamation-triangle"></i>&nbsp', '</small>'); ?>
                                    </div>
        
                                    <div class="col-md-3">
                                        <label>Celular</label>
                                        <input type="text" class="form-control cel" name="cliente_celular" placeholder="Celular"  value="<?php echo set_value('cliente_celular'); ?>" > 
                                        <?php echo form_error('cliente_celular', '<small class="form-text text-danger"><i class="fas fa-exclamation-triangle"></i>&nbsp', '</small>'); ?>
                                    </div>                                                          
        
                            </div>                                                        
                            </fieldset>
                            
                            <fieldset class="mt-2 mb-2 border p-2">
                                
                                <legend class="form-control"><i class="fas fa-map-marked-alt"></i>&nbsp Endereço</legend>
                                                                                               
                            <div class="form-group row">

                            <div class="col-md-2">
                                    <label>CEP</label>
                                    <input type="text" class="form-control cep" id="cep" name="cliente_cep" placeholder="CEP" value="<?php echo set_value('cliente_cep'); ?>" > 
                                    <?php echo form_error('cliente_cep', '<small class="form-text text-danger"><i class="fas fa-exclamation-triangle"></i>&nbsp', '</small>'); ?>
                                </div>   

                                <div class="col-md-6">
                                    <label>Endereço</label>
                                    <input type="text" class="form-control" id="rua" name="cliente_endereco" placeholder="Endereço" value="<?php echo set_value('cliente_endereco'); ?>" > 
                                    <?php echo form_error('cliente_endereco', '<small class="form-text text-danger"><i class="fas fa-exclamation-triangle"></i>&nbsp', '</small>'); ?>
                                </div>

                                <div class="col-md-4">
                                    <label>Bairro</label>
                                    <input type="text" class="form-control" id="bairro" name="cliente_bairro" placeholder="Bairro" value="<?php echo set_value('cliente_bairro'); ?>" > 
                                    <?php echo form_error('cliente_bairro', '<small class="form-text text-danger"><i class="fas fa-exclamation-triangle"></i>&nbsp', '</small>'); ?>
                                </div>                                                                  
                                                                                                        
                            </div>       

                            <div class="form-group row">

                                <div class="col-md-2">
                                    <label>Número</label>
                                    <input type="text" class="form-control" id="numero"  name="cliente_numero_endereco" placeholder="Número" value="<?php echo set_value('cliente_numero_endereco'); ?>" > 
                                    <?php echo form_error('cliente_numero_endereco', '<small class="form-text text-danger"><i class="fas fa-exclamation-triangle"></i>&nbsp', '</small>'); ?>
                                </div>  

                                <div class="col-md-3">
                                    <label>Cidade</label>
                                    <input type="text" class="form-control" id="cidade" name="cliente_cidade" placeholder="Cidade" value="<?php echo set_value('cliente_cidade'); ?>" > 
                                    <?php echo form_error('cliente_cidade', '<small class="form-text text-danger"><i class="fas fa-exclamation-triangle"></i>&nbsp', '</small>'); ?>
                                </div>   

                                <div class="col-md-2">
                                    <label>Estado</label>
                                    <input type="text" class="form-control"  id="uf" name="cliente_estado" placeholder="UF" value="<?php echo set_value('cliente_estado'); ?>" > 
                                    <?php echo form_error('cliente_estado', '<small class="form-text text-danger"><i class="fas fa-exclamation-triangle"></i>&nbsp', '</small>'); ?>
                                </div>  
                                <div class="col-md-5">
                                    <label>Complemento</label>
                                    <input type="text" class="form-control"  name="cliente_complemento" placeholder="Complemento" value="<?php echo set_value('cliente_complemento'); ?>" > 
                                    <?php echo form_error('cliente_complemento', '<small class="form-text text-danger"><i class="fas fa-exclamation-triangle"></i>&nbsp', '</small>'); ?>
                                </div>                                   
        
                            </div>       
                                                                                             
                            </fieldset>

                            <fieldset class="mt-2 mb-2 border p-2">
                                
                                <legend class="form-control"><i class="fas fa-tools"></i>&nbsp Configurações</legend>
                                                                                               
                                <div class="form-group row">                            
                                <div class="col-md-2">
                                    <label>Status</label>
                                    <select class="form-control" name="cliente_ativo">
                                        <option value="0">Inativo</option>
                                        <option value="1" selected >Ativo</option>
                                    </select>
                                </div>                                                        
                                <div class="col-md-10">
                                       <label>Observações</label>
                                        <textarea class="form-control" name="cliente_obs"><?php echo set_value('cliente_obs'); ?></textarea> 
                                        <?php echo form_error('cliente_obs', '<small class="form-text text-danger"><i class="fas fa-exclamation-triangle"></i>&nbsp', '</small>'); ?>                                    
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

       