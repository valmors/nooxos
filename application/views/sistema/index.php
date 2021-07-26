<?php $this->load->view('layout/sidebar'); ?>

<!-- Main Content 1 -->
<div id="content">

<?php $this->load->view('layout/navbar'); ?>

    <!-- Begin Page Content 2 -->
    <div class="container-fluid">
        
        <!-- breadcrumb -->
        <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a title="Home" href="<?php echo base_url('home'); ?>"><i class="fas fa-home"></i></a></li>
        <li class="breadcrumb-item active" aria-current="page"><?php echo $titulo; ?></li>

        </ol>
        </nav>

        <!-- LAYOUT DAS MENSAGENS -->
        <?php $this->load->view('layout/mensagens'); ?>
                             
        
        <!-- card shadow  3 -->
        <div class="card shadow mb-4">
			 
			<!-- Card-body 4-->
            <div class="card-body">
             <!-- FORMULÁRIO-->
                <form method="POST" name="form_edit">
                <div class="form-group row">

                    <div class="col-md-3">
                        <label>Razão Social</label>
                        <input type="text" class="form-control" name="sistema_razao_social" placeholder="Razão Social" value="<?php echo $sistema->sistema_razao_social; ?>" > 
                        <?php echo form_error('sistema_razao_social', '<small class="form-text text-danger"><i class="fas fa-exclamation-triangle"></i>&nbsp', '</small>'); ?>
                    </div>

                    <div class="col-md-3">
                        <label>Nome Fantasia</label>
                        <input type="text" class="form-control" name="sistema_nome_fantasia" placeholder="Nome Fantasia" value="<?php echo $sistema->sistema_nome_fantasia; ?>" > 
                        <?php echo form_error('sistema_nome_fantasia', '<small class="form-text text-danger"><i class="fas fa-exclamation-triangle"></i>&nbsp', '</small>'); ?>
                    </div>


                    <div class="col-md-3">
                        <label>CNPJ</label>
                        <input type="text" class="form-control cnpj" name="sistema_cnpj" placeholder="CNPJ" value="<?php echo $sistema->sistema_cnpj; ?>" > 
                        <?php echo form_error('sistema_cnpj', '<small class="form-text text-danger"><i class="fas fa-exclamation-triangle"></i>&nbsp', '</small>'); ?>
                    </div>    

                    <div class="col-md-3">
                        <label>Inscrição Estadual</label>
                        <input type="text" class="form-control" name="sistema_ie" placeholder="Inscrição Social" value="<?php echo $sistema->sistema_ie; ?>" > 
                        <?php echo form_error('sistema_ie', '<small class="form-text text-danger"><i class="fas fa-exclamation-triangle"></i>&nbsp', '</small>'); ?>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3">
                        <label>Telefone Fixo</label>
                        <input type="text" class="form-control sp_celphones" name="sistema_telefone_fixo" placeholder="Telefone Fixo" value="<?php echo $sistema->sistema_telefone_fixo; ?>" > 
                        <?php echo form_error('sistema_telefone_fixo', '<small class="form-text text-danger"><i class="fas fa-exclamation-triangle"></i>&nbsp', '</small>'); ?>
                    </div>

                    <div class="col-md-3">
                        <label>Telefone Celular</label>
                        <input type="text" class="form-control sp_celphones" name="sistema_telefone_movel" placeholder="Telfone Celular" value="<?php echo $sistema->sistema_telefone_movel; ?>" > 
                        <?php echo form_error('sistema_telefone_movel', '<small class="form-text text-danger"><i class="fas fa-exclamation-triangle"></i>&nbsp', '</small>'); ?>
                    </div>    

                    <div class="col-md-3">
                        <label>URL do Site</label>
                        <input type="text" class="form-control" name="sistema_site_url" placeholder="URL do Site" value="<?php echo $sistema->sistema_site_url; ?>" > 
                        <?php echo form_error('sistema_site_url', '<small class="form-text text-danger"><i class="fas fa-exclamation-triangle"></i>&nbsp', '</small>'); ?>
                    </div>  

                    <div class="col-md-3">
                        <label>E-mail de contato</label>
                        <input type="text" class="form-control" name="sistema_email" placeholder="" value="<?php echo $sistema->sistema_email; ?>" > 
                        <?php echo form_error('sistema_email', '<small class="form-text text-danger"><i class="fas fa-exclamation-triangle"></i>&nbsp', '</small>'); ?>
                    </div>                      
                </div>
                <div class="form-group row">
                    <div class="col-md-2">
                        <label>CEP</label>
                        <input type="text" class="form-control cep" id="cep" name="sistema_cep" placeholder="CEP" value="<?php echo $sistema->sistema_cep; ?>" > 
                        <?php echo form_error('sistema_cep', '<small class="form-text text-danger"><i class="fas fa-exclamation-triangle"></i>&nbsp', '</small>'); ?>
                    </div>  

                    <div class="col-md-4">
                        <label>Endereço</label>
                        <input type="text" class="form-control" id="rua" name="sistema_endereco" placeholder="Endereço" value="<?php echo $sistema->sistema_endereco; ?>" > 
                        <?php echo form_error('sistema_endereco', '<small class="form-text text-danger"><i class="fas fa-exclamation-triangle"></i>&nbsp', '</small>'); ?>
                    </div>
                    <div class="col-md-2">
                        <label>Bairro</label>
                        <input type="text" class="form-control" id="bairro"  name="sistema_bairro" placeholder="Bairo" value="<?php echo $sistema->sistema_bairro; ?>" > 
                        <?php echo form_error('sistema_bairro', '<small class="form-text text-danger"><i class="fas fa-exclamation-triangle"></i>&nbsp', '</small>'); ?>
                    </div>  
                    <div class="col-md-1">
                        <label>Numero</label>
                        <input type="text" class="form-control"  name="sistema_numero" placeholder="Numero" value="<?php echo $sistema->sistema_numero; ?>" > 
                        <?php echo form_error('sistema_numero', '<small class="form-text text-danger"><i class="fas fa-exclamation-triangle"></i>&nbsp', '</small>'); ?>
                    </div>                        

                    <div class="col-md-2">
                        <label>Cidade</label>
                        <input type="text" class="form-control" id="cidade" name="sistema_cidade" placeholder="Cidade" value="<?php echo $sistema->sistema_cidade; ?>" > 
                        <?php echo form_error('sistema_cidade', '<small class="form-text text-danger"><i class="fas fa-exclamation-triangle"></i>&nbsp', '</small>'); ?>
                    </div>  

                    <div class="col-md-1">
                        <label>Estado</label>
                        <input type="text" class="form-control uf" id="estado" name="sistema_estado" placeholder="UF" value="<?php echo $sistema->sistema_estado; ?>" > 
                        <?php echo form_error('sistema_estado', '<small class="form-text text-danger"><i class="fas fa-exclamation-triangle"></i>&nbsp', '</small>'); ?>
                    </div>  

                </div>        
                <div class="form-group row">
                    <div class="col-md-12">
                        <label>Texto da Ordem de Serviço </label>
                        <textarea class="form-control" name="sistema_txt_ordem_servico" placeholder="Texto da Ordem de Serviço"><?php echo $sistema->sistema_txt_ordem_servico; ?></textarea>
                        <?php echo form_error('sistema_txt_ordem_servico', '<small class="form-text text-danger"><i class="fas fa-exclamation-triangle"></i>&nbsp', '</small>'); ?>
                    </div>

                </div>                         

                <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save"></i>&nbspSalvar</button>
                </form>      

            </div>
			<!-- Card-body 4-->
			
		</div>
		<!-- card shadow 3 -->
		
    </div>
    <!-- /.container-fluid 2 -->

</div>
<!-- End of Main Content 1 -->

