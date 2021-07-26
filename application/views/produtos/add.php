        <?php $this->load->view('layout/sidebar'); ?>

            <!-- Main Content -->
            <div id="content">

        <?php $this->load->view('layout/navbar'); ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    
                    <!-- breadcrumb -->
                    <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url('produtos'); ?>">Produtos</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?php echo $titulo; ?></li>

                    </ol>
                    </nav>
                    <!-- LAYOUT DAS MENSAGENS -->
                    <?php $this->load->view('layout/mensagens'); ?>
                       
                                          
                    
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                     <!-- Card Header barra cinza acima do formulário
                        <div class="card-header py-3">
                            
                        </div> -->
                        <div class="card-body">
                         <!-- FORMULÁRIO-->
                            <form method="POST" name="form_add" enctype="multipart/form-data">
                            
                            <fieldset class="mt-0 border p-2">                               
                                <legend class="form-control">
                                    <i class="fas fa-hdd"></i>&nbspDados dos Produtos
                                </legend>
                                <div class="form-group row">
                                    <div class="col-md-8">
                                        <label>Foto do Produto</label>                                       
                                        <input type="file" required class="form-control" name="produto_foto" value="<?php echo set_value('produto_foto'); ?>"> 
                                        <?php echo form_error('produto_foto', '<small class="form-text text-danger"><i class="fas fa-exclamation-triangle"></i>&nbsp', '</small>'); ?> 
                                    </div>                                    
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-2">
                                        <label>Código de Barra</label>
                                        <input type="text" class="form-control" name="produto_codigo" value="<?php echo $produto_codigo; ?>" > 
                                        <?php echo form_error('produto_codigo', '<small class="form-text text-danger"><i class="fas fa-exclamation-triangle"></i>&nbsp', '</small>'); ?>                                    </div>                                    
                                    <div class="col-md-2">
                                        <label>Unidade</label>                                       
                                        <select class="form-control" name="produto_unidade" >                                          
                                            <option value="UN" selected> Unidade</option>
                                            <option value="MT"> Metro</option>
                                            <option value="KG"> Quilograma</option>
                                            <option value="PC"> Peça</option>
                                            <option value="PTE"> Pacote</option>
                                        </select>
                                        <?php echo form_error('produto_unidade', '<small class="form-text text-danger"><i class="fas fa-exclamation-triangle"></i>&nbsp', '</small>'); ?> 
                                    </div>

                                    <div class="col-md-8">
                                        <label>Produto Descrição</label>                                       
                                        <input type="text"  class="form-control" name="produto_descricao" placeholder="Digite o Produto" value="<?php echo set_value('produto_descricao'); ?>" > 
                                        <?php echo form_error('produto_descricao', '<small class="form-text text-danger"><i class="fas fa-exclamation-triangle"></i>&nbsp', '</small>'); ?> 
                                    </div>
                                               
                                </div>
                                <div class="form-group row">
                                       
                                    <div class="col-md-3">
                                        <label>Categoria</label>
                                        <select class="form-control" name="produto_categoria_id">
                                            <?php foreach ($categorias as $categoria):?>
                                            <option value="<?php echo $categoria->categoria_id; ?>"  <?php echo ($categoria->categoria_ativa == 0 ? 'disabled' : ''); ?>><?php echo ($categoria->categoria_ativa == 1 ? $categoria->categoria_nome.'' : $categoria->categoria_nome.'&nbsp>>INATIVO<<');  ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>  
                                    
                                    <div class="col-md-3">
                                        <label>Marca</label>
                                        <select class="form-control" name="produto_marca_id">
                                            <?php foreach ($marcas as $marca):?>
                                            <option value="<?php echo $marca->marca_id; ?>" <?php echo ($marca->marca_ativa == 0 ? 'disabled' : ''); ?> ><?php echo ($marca->marca_ativa == 1 ? $marca->marca_nome.'' : $marca->marca_nome.'&nbsp>>INATIVO<<');  ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>  
                                    
                                    <div class="col-md-6">
                                        <label>Fornecedor</label>
                                        <select class="form-control" name="produto_fornecedor_id">
                                            <?php foreach ($fornecedores as $fornecedor):?>
                                            <option value="<?php echo $fornecedor->fornecedor_id; ?>"  <?php echo ($fornecedor->fornecedor_ativo == 0 ? 'disabled' : ''); ?>><?php echo ($fornecedor->fornecedor_ativo == 1 ? $fornecedor->fornecedor_razao.'' : $fornecedor->fornecedor_razao.'&nbsp>>INATIVO<<');  ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>                                      
                                </div>   

                                  
                            </fieldset>
                            
                            <fieldset class="mt-0 border p-2">                               
                                <legend class="form-control">
                                    <i class="fas fa-funnel-dollar"></i>&nbspPrecificação e Estoque
                                </legend>
                                <div class="form-group row">

                                    <div class="col-md-2">
                                      <label>Preço Custo</label>
                                      <div class="input-group">  
                                        <span class="input-group-text">R$</span>
                                        <input type="text" class="form-control money" name="produto_preco_custo" placeholder="Digite o valor" value="<?php echo set_value('produto_preco_custo'); ?>" >                                     
                                        <?php echo form_error('produto_preco_custo', '<small class="form-text text-danger"><i class="fas fa-exclamation-triangle"></i>&nbsp', '</small>'); ?>                                        
                                      </div>  
                                    </div>  
                                    <div class="col-md-2">
                                      <label>Preço Venda</label>
                                      <div class="input-group">  
                                        <span class="input-group-text">R$</span>
                                        <input type="text" class="form-control money" name="produto_preco_venda" placeholder="Digite o valor" value="<?php echo set_value('produto_preco_venda'); ?>" >                                     
                                        <?php echo form_error('produto_preco_venda', '<small class="form-text text-danger"><i class="fas fa-exclamation-triangle"></i>&nbsp', '</small>'); ?>                                        
                                      </div>  
                                    </div>
                                    <div class="col-md-3">
                                      <label>Qtde Estoque Minimo</label>
                                      <div class="input-group">  
                                        <span class="input-group-text"><i class="fas fa-layer-group"></i></span>
                                        <input type="number" class="form-control" name="produto_estoque_minimo" placeholder="Qtd Mínima" value="<?php echo set_value('produto_estoque_minimo'); ?>" >                                     
                                        <?php echo form_error('produto_estoque_minimo', '<small class="form-text text-danger"><i class="fas fa-exclamation-triangle"></i>&nbsp', '</small>'); ?>                                        
                                      </div>  
                                    </div>
                                    <div class="col-md-3">
                                      <label>Qtde em Estoque</label>
                                      <div class="input-group">  
                                        <span class="input-group-text"><i class="fas fa-layer-group"></i></span>
                                        <input type="number" class="form-control" name="produto_qtde_estoque" placeholder="Qtd Estoque" value="<?php echo set_value('produto_qtde_estoque'); ?>" >                                     
                                        <?php echo form_error('produto_qtde_estoque', '<small class="form-text text-danger"><i class="fas fa-exclamation-triangle"></i>&nbsp', '</small>'); ?>                                        
                                      </div>  
                                    </div>                                    
                                    <div class="col-md-2">
                                        <label>Status Produto</label>
                                        <select class="form-control" name="produto_ativo">
                                            <option value="0" >Inativo</option>
                                            <option value="1" selected>Ativo</option>
                                        </select>
                                    </div>                                                      
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <label>Observações</label>
                                        <textarea class="form-control" name="produto_obs"><?php echo set_value('produto_obs'); ?></textarea>
                                        <?php echo form_error('produto_obs', '<small class="form-text text-danger"><i class="fas fa-exclamation-triangle"></i>&nbsp', '</small>'); ?>                                       
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

       