        <?php $this->load->view('layout/sidebar'); ?>

            <!-- Main Content -->
            <div id="content">

        <?php $this->load->view('layout/navbar'); ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    
                    <!-- breadcrumb -->
                    <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url('usuarios'); ?>">Usuários</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?php echo $titulo; ?></li>

                    </ol>
                    </nav>
                    
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <a title="Voltar" href="<?php echo base_url('usuarios'); ?>" class="btn btn-success btn-sm float-right"><i class="fas fa-undo-alt"></i>&nbspVoltar</a>
                        </div>
                        <div class="card-body">
                         <!-- FORMULÁRIO-->
                            <form method="POST" name="form_edit">
                            <div class="form-group row">

                                <div class="col-md-4">
                                    <label>Nome</label>
                                    <input type="text" class="form-control" name="first_name" placeholder="Nome" value="<?php echo $usuario->first_name; ?>" > 
                                    <?php echo form_error('first_name', '<small class="form-text text-danger"><i class="fas fa-exclamation-triangle"></i>&nbsp', '</small>'); ?>
                                </div>

                                <div class="col-md-4">
                                    <label>Sobrenome</label>
                                    <input type="text" class="form-control" name="last_name" placeholder="Sobrenome" value="<?php echo $usuario->last_name; ?>" > 
                                    <?php echo form_error('last_name', '<small class="form-text text-danger"><i class="fas fa-exclamation-triangle"></i>&nbsp', '</small>'); ?>
                                </div>


                                <div class="col-md-4">
                                    <label>Login&nbsp(E-mail)</label>
                                    <input type="email" class="form-control" name="email" placeholder="Seu Email/Login" value="<?php echo $usuario->email; ?>" > 
                                    <?php echo form_error('email', '<small class="form-text text-danger"><i class="fas fa-exclamation-triangle"></i>&nbsp', '</small>'); ?>
                                </div>    

                            </div>

                            <div class="form-group row">

                            <div class="col-md-4">
                                    <label>Usuário</label>
                                    <input type="text" class="form-control" name="username" placeholder="Seu Nome" value="<?php echo $usuario->username; ?>" > 
                                    <?php echo form_error('username', '<small class="form-text text-danger"><i class="fas fa-exclamation-triangle"></i>&nbsp', '</small>'); ?>
                                </div>    


                                <div class="col-md-4">
                                    <label>Status do Usuário</label>
                                    <select class="form-control" name="active">

                                        <option value="0" <?php echo ($usuario->active == 0) ? 'selected' : ''; ?>>Inativo</option>
                                        <option value="1" <?php echo ($usuario->active == 1) ? 'selected' : ''; ?>>Ativo</option>
                                    </select>
                                </div>

                                <div class="col-md-4">
                                <label>Perfil de acesso</label>
     
                                    <select class="custom-select" name="perfil_usuario" >
                
                                        <option value="1" <?php echo ($perfil_usuario->id == 1) ? 'selected' : ''; ?>>Administrador</option>
                                        <option value="2" <?php echo ($perfil_usuario->id == 2) ? 'selected' : ''; ?>>Usuário</option>
                                        <option value="3" <?php echo ($perfil_usuario->id == 3) ? 'selected' : ''; ?>>Técnico</option>
                                
                                    </select>
                                </div>

                            </div>      

                            <div class="form-group row">

                                <div class="col-md-6">
                                    <label>Senha</label>
                                    <input type="password" class="form-control" name="password" placeholder="Sua Senha">
                                    <?php echo form_error('password', '<small class="form-text text-danger"><i class="fas fa-exclamation-triangle"></i>&nbsp', '</small>'); ?>
                                </div>    
                                <div class="col-md-6">
                                <label>Confirmne sua Senha</label>
                                <input type="password" class="form-control" name="confirm_password" placeholder="Confirme Sua Senha">
                                    <?php echo form_error('confirm_password', '<small class="form-text text-danger"><i class="fas fa-exclamation-triangle"></i>&nbsp', '</small>'); ?>
                                </div>    
                            </div>                                                    
                            
                            <input type="hidden" name="usuario_id" value="<?php echo $usuario->id; ?>" >
       
                            <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save"></i>&nbspSalvar</button>
                            </form>      

                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

       