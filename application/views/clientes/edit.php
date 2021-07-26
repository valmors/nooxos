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
                            <form method="POST" name="form_edit">
                            <p><i class="fas fa-clock"></i>&nbsp<?php echo formata_data_banco_com_hora($cliente->cliente_data_alteracao); ?>&nbsp<strong>Ultima Atualização</strong></p>
                            <fieldset class="mt-0 border p-2">
                               
                                <legend class="form-control">
                                    <?php if ($cliente->cliente_tipo == 1):?>
                                    <i class="fas fa-user fa-1x"></i>&nbspDados Pessoais
                                    <?php else:?>
                                    <i class="fas fa-building"></i>&nbspDados da Empresa   
                                    <?php endif; ?>                                
                                </legend>
                            
                                <div class="form-group row">
                                   <div class="col-md-4">
                                    <?php if ($cliente->cliente_tipo == 1):?>
                                        <label>Sobrenome</label>
                                        <input type="text" class="form-control" name="cliente_sobrenome" placeholder="Digite seu Sobrenome" value="<?php echo $cliente->cliente_sobrenome; ?>" > 
                                        <?php echo form_error('cliente_sobrenome', '<small class="form-text text-danger"><i class="fas fa-exclamation-triangle"></i>&nbsp', '</small>'); ?>
                                        <?php else:?>
                                        <label>Razão Social</label>
                                        <input type="text" class="form-control" id="razao" name="cliente_rsocial" placeholder="Digite a Razão Social" value="<?php echo $cliente->cliente_sobrenome; ?>" > 
                                        <?php echo form_error('cliente_rsocial', '<small class="form-text text-danger"><i class="fas fa-exclamation-triangle"></i>&nbsp', '</small>'); ?>

                                        <?php endif; ?>    
                                    </div>
                                    <div class="col-md-5">
                                        <?php if ($cliente->cliente_tipo == 1):?>
                                        <label>Nome</label>
                                        <input type="text" class="form-control" name="cliente_nome" placeholder="Digite seu Nome" value="<?php echo $cliente->cliente_nome; ?>" > 
                                        <?php echo form_error('cliente_nome', '<small class="form-text text-danger"><i class="fas fa-exclamation-triangle"></i>&nbsp', '</small>'); ?>
                                        <?php else:?>
                                        <label>Nome Fantasia</label>
                                        <input type="text" class="form-control" id="nfantasia" name="cliente_nfantasia" placeholder="Digite o Nome Fantasia" value="<?php echo $cliente->cliente_nome; ?>" > 
                                        <?php echo form_error('cliente_nfantasia', '<small class="form-text text-danger"><i class="fas fa-exclamation-triangle"></i>&nbsp', '</small>'); ?>
                                        <?php endif; ?>                                           
                                    </div>


                                    <div class="col-md-3">
                                    <?php if ($cliente->cliente_tipo == 1):?>
                                        <label>Data Nascimento</label>
                                        <input type="date" class="form-control form-control-user-date" name="cliente_data_nascimento"  value="<?php echo $cliente->cliente_data_nascimento; ?>" > 
                                        <?php echo form_error('cliente_data_nascimento', '<small class="form-text text-danger"><i class="fas fa-exclamation-triangle"></i>&nbsp', '</small>'); ?>
                                        <?php else:?>
                                        <label>Data Fundação</label>
                                        <?php $data = str_replace("/", "-", $cliente->cliente_data_nascimento); ?>
                                        <input type="date" class="form-control form-control-user-date" id="abertura" name="cliente_data_fundacao"  value="<?php echo $data; ?>" > 
                                        <?php echo form_error('cliente_data_fundacao', '<small class="form-text text-danger"><i class="fas fa-exclamation-triangle"></i>&nbsp', '</small>'); ?>

                                        <?php endif; ?>                                            
                                    </div>                     

                                </div>      

                                <div class="form-grupo row">
                                    <div class="col-md-3">
                                        <?php if ($cliente->cliente_tipo == 1):?>
                                        <label>CPF</label> 
                                        <input type="text" class="form-control cpf" name="cliente_cpf" placeholder="Digite seu CPF" value="<?php echo $cliente->cliente_cpf_cnpj; ?>" > 
                                        <?php echo form_error('cliente_cpf', '<small class="form-text text-danger"><i class="fas fa-exclamation-triangle"></i>&nbsp', '</small>'); ?>                                        
                                        <?php else:?>
                                        <label>CNPJ</label>
                                        <input type="text" class="form-control cnpj" id="cnpj" name="cliente_cnpj" placeholder="Digite o CNPJ" value="<?php echo $cliente->cliente_cpf_cnpj; ?>" > 
                                        <?php echo form_error('cliente_cnpj', '<small class="form-text text-danger"><i class="fas fa-exclamation-triangle"></i>&nbsp', '</small>'); ?>                                        
                                        <?php endif; ?>
                                    </div>    

                                    <div class="col-md-3">
                                    <?php if ($cliente->cliente_tipo == 1) : ?>
                                        <label>RG</label> 
                                        <input type="text" class="form-control rg" name="cliente_rg" placeholder="Digite seu RG" value="<?php echo $cliente->cliente_rg_ie; ?>" > 
                                        <?php echo form_error('cliente_rg', '<small class="form-text text-danger"><i class="fas fa-exclamation-triangle"></i>&nbsp', '</small>'); ?>                                        
                                        <?php else:?>
                                        <label>IE</label>
                                        <input type="text" class="form-control" name="cliente_ie" placeholder="Digite o IE" value="<?php echo $cliente->cliente_rg_ie; ?>" > 
                                        <?php echo form_error('cliente_ie', '<small class="form-text text-danger"><i class="fas fa-exclamation-triangle"></i>&nbsp', '</small>'); ?>                                        
                                        <?php endif; ?>

                                    </div> 
                                    <div class="col-md-6">
                                        <label>Email</label>
                                        <input type="email" class="form-control" id="email" name="cliente_email" placeholder="Email" value="<?php echo $cliente->cliente_email; ?>" > 
                                        <?php echo form_error('cliente_email', '<small class="form-text text-danger"><i class="fas fa-exclamation-triangle"></i>&nbsp', '</small>'); ?>
                                    </div>
        
                                </div>  
                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <label>Telefone</label>
                                        <input type="text" class="form-control tel" id="telefone" name="cliente_telefone" placeholder="Telefone"  value="<?php echo $cliente->cliente_telefone; ?>" > 
                                        <?php echo form_error('cliente_telefone', '<small class="form-text text-danger"><i class="fas fa-exclamation-triangle"></i>&nbsp', '</small>'); ?>
                                    </div>
        
                                    <div class="col-md-3">
                                        <label>Celular</label>
                                        <input type="text" class="form-control cel" name="cliente_celular" placeholder="Celular"  value="<?php echo $cliente->cliente_celular; ?>" > 
                                        <?php echo form_error('cliente_celular', '<small class="form-text text-danger"><i class="fas fa-exclamation-triangle"></i>&nbsp', '</small>'); ?>
                                    </div>                                                          
        
                            </div>                                                        
                            </fieldset>
                            
                            <fieldset class="mt-2 mb-2 border p-2">
                                
                                <legend class="form-control"><i class="fas fa-map-marked-alt"></i>&nbsp Endereço</legend>
                                                                                               
                            <div class="form-group row">

                            <div class="col-md-2">
                                    <label>CEP</label>
                                    <input type="text" class="form-control cep" id="cep" name="cliente_cep" placeholder="CEP" value="<?php echo $cliente->cliente_cep; ?>" > 
                                    <?php echo form_error('cliente_cep', '<small class="form-text text-danger"><i class="fas fa-exclamation-triangle"></i>&nbsp', '</small>'); ?>
                                </div>   

                                <div class="col-md-6">
                                    <label>Endereço</label>
                                    <input type="text" class="form-control" id="rua" name="cliente_endereco" placeholder="Endereço" value="<?php echo $cliente->cliente_endereco; ?>" > 
                                    <?php echo form_error('cliente_endereco', '<small class="form-text text-danger"><i class="fas fa-exclamation-triangle"></i>&nbsp', '</small>'); ?>
                                </div>

                                <div class="col-md-4">
                                    <label>Bairro</label>
                                    <input type="text" class="form-control" id="bairro" name="cliente_bairro" placeholder="Bairro" value="<?php echo $cliente->cliente_bairro; ?>" > 
                                    <?php echo form_error('cliente_bairro', '<small class="form-text text-danger"><i class="fas fa-exclamation-triangle"></i>&nbsp', '</small>'); ?>
                                </div>                                                                  
                                                                                                        
                            </div>       

                            <div class="form-group row">

                                <div class="col-md-2">
                                    <label>Número</label>
                                    <input type="text" class="form-control" id="numero"  name="cliente_numero_endereco" placeholder="Número" value="<?php echo $cliente->cliente_numero_endereco; ?>" > 
                                    <?php echo form_error('cliente_numero_endereco', '<small class="form-text text-danger"><i class="fas fa-exclamation-triangle"></i>&nbsp', '</small>'); ?>
                                </div>  

                                <div class="col-md-3">
                                    <label>Cidade</label>
                                    <input type="text" class="form-control" id="cidade" name="cliente_cidade" placeholder="Cidade" value="<?php echo $cliente->cliente_cidade; ?>" > 
                                    <?php echo form_error('cliente_cidade', '<small class="form-text text-danger"><i class="fas fa-exclamation-triangle"></i>&nbsp', '</small>'); ?>
                                </div>   

                                <div class="col-md-2">
                                    <label>Estado</label>
                                    <input type="text" class="form-control"  id="uf" name="cliente_estado" placeholder="UF" value="<?php echo $cliente->cliente_estado; ?>" > 
                                    <?php echo form_error('cliente_estado', '<small class="form-text text-danger"><i class="fas fa-exclamation-triangle"></i>&nbsp', '</small>'); ?>
                                </div>  
                                <div class="col-md-5">
                                    <label>Complemento</label>
                                    <input type="text" class="form-control"  name="cliente_complemento" placeholder="Complemento" value="<?php echo $cliente->cliente_complemento; ?>" > 
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
                                        <option value="0" <?php echo ($cliente->cliente_ativo == 0) ? 'selected' : ''; ?>>Inativo</option>
                                        <option value="1" <?php echo ($cliente->cliente_ativo == 1) ? 'selected' : ''; ?>>Ativo</option>
                                    </select>
                                </div>                                                        
                                <div class="col-md-10">
                                       <label>Observações</label>
                                        <textarea class="form-control" name="cliente_obs"><?php echo $cliente->cliente_obs; ?></textarea> 
                                        <?php echo form_error('cliente_obs', '<small class="form-text text-danger"><i class="fas fa-exclamation-triangle"></i>&nbsp', '</small>'); ?>                                    
                                </div>                                
                                    
                            </div>                                                                                                                     
                            </fieldset>

                            <input type="hidden" name="cliente_tipo" value="<?php echo $cliente->cliente_tipo; ?>" >
                            <input type="hidden" name="cliente_id" value="<?php echo $cliente->cliente_id; ?>" >       
                            <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save"></i>&nbspSalvar</button>

                            <a title="Voltar" href="<?php echo base_url($this->router->fetch_class()); ?>" class="btn btn-success btn-sm"><i class="fas fa-undo-alt"></i>&nbspVoltar</a>
                            </form>      

                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

       