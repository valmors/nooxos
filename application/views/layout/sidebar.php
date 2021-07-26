        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo base_url('home'); ?>">
  
                <div class="sidebar-brand-text mx-3">
                    <img src="<?php echo base_url('public/img/Logo_Noox_Brasil.png'); ?>" alt="Noox Brasil Ordem de Serviço " class="w-100">
                            
                </div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url('home'); ?>">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Módulos Ordem de Serviço
            </div>

            <!-- Colaps Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#ordem"
                    aria-expanded="false" aria-controls="Ordem">
                    <i class="fas fa-archive"></i>
                    <span>Ordem de Serviço</span>
                </a>
                        
                <div id="ordem" class="collapse" aria-labelledby="ordem" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Escolha uma Opção:</h6>
                        <a title="ordem serviço" class="collapse-item" href="<?php echo base_url('os'); ?>"> <i class="fas fa-shopping-basket"></i>&nbsp;&nbsp;Ordem de Serviço</a>
                       
                        
                    </div>
                </div>
            </li> 
            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Módulos Cadastros
            </div>

            <!-- Nav Item - Pages Collapse Menu 
            <li class="nav-item">
                <a titulo="Gerencia Clientes" class="nav-link" href="< ?php echo base_url('clientes'); ?>"> <i class="fas fa-user-tie"></i> <span>Clientes</span></a>
            </li>
             -->
            <!-- Colaps Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Cadastros"
                    aria-expanded="false" aria-controls="Cadastros">
                    <i class="fas fa-database"></i>
                    <span>Cadastros</span>
                </a>
                        
                <div id="Cadastros" class="collapse" aria-labelledby="Cadastros" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Escolha uma Opção:</h6>
                        <a title="Clientes" class="collapse-item" href="<?php echo base_url('clientes'); ?>"> <i class="fas fa-user-tie"></i>&nbsp;&nbsp;Clientes</a>
                        <a title="Servicos" class="collapse-item" href="<?php echo base_url('servicos'); ?>"> <i class="fas fa-money-check"></i></i>&nbsp;&nbsp;Serviços</a>
<a title="Vendedores" class="collapse-item" href="<?php echo base_url('vendedores'); ?>"> <i class="fas fa-money-check"></i>&nbsp;&nbsp;Vendedores</a>
                        <a title="Fornecedores" class="collapse-item" href="<?php echo base_url('fornecedores'); ?>"> <i class="fas fa-user-tag"></i>&nbsp;&nbsp;Fornecedores</a>

                        
                    </div>
                </div>
            </li> 

            <!-- Divider -->
            <hr class="sidebar-divider">
            <!-- Heading -->
            <div class="sidebar-heading">
                Módulos Estoque
            </div>            
            <!-- Colaps Menu Estoque-->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Estoque"
                    aria-expanded="false" aria-controls="Estoque">
                    <i class="fas fa-cube"></i>
                    <span>Estoque</span>
                </a>
                        
                <div id="Estoque" class="collapse" aria-labelledby="Cadastros" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Escolha uma Opção:</h6>
                        <a title="Marcas" class="collapse-item" href="<?php echo base_url('marcas'); ?>"> <i class="fas fa-dumpster"></i>&nbsp;&nbsp;Marcas</a>                        
                        <a title="Produtos" class="collapse-item" href="<?php echo base_url('Produtos'); ?>"> <i class="fas fa-hdd"></i>&nbsp;&nbsp;Produtos</a>   
                        <a title="Categorias" class="collapse-item" href="<?php echo base_url('categorias'); ?>"><i class="fas fa-list"></i>&nbsp;&nbsp;Categorias</a>                                             
                        
                    </div>
                </div>
            </li> 

            <!-- Divider -->
            <hr class="sidebar-divider">
            <!-- Heading -->
            <div class="sidebar-heading">
                Módulos Financeiro
            </div>            
            <!-- Colaps Menu Financeiro-->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Financeiro"
                    aria-expanded="false" aria-controls="Financeiro">
                    <i class="fas fa-dollar-sign"></i>
                    <span>Financeiro</span>
                </a>
                        
                <div id="Financeiro" class="collapse" aria-labelledby="Financeiro" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Escolha uma Opção:</h6>
                        <a title="Contas a Pagar" class="collapse-item" href="<?php echo base_url('pagar'); ?>"> <i class="fas fa-money-bill-alt"></i>&nbsp;&nbsp;Contas a Pagar</a>                        
                        <a title="Contas a Receber" class="collapse-item" href="<?php echo base_url('receber'); ?>"> <i class="fas fa-hand-holding-usd"></i>&nbsp;&nbsp;Contas a Receber</a>   
                        <a title="Formas de Pagamentos" class="collapse-item" href="<?php echo base_url('modulo'); ?>"> <i class="fas fa-file-invoice-dollar"></i>&nbsp;&nbsp;Formas de Pagamento</a>   
                      
                        
                    </div>
                </div>
            </li>            
            <!-- Heading -->
            <div class="sidebar-heading">
                Configurações
            </div>

             <!-- Colaps Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Configuracao"
                    aria-expanded="true" aria-controls="Configuracao">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Configurações</span>
                </a>
                <div id="Configuracao" class="collapse" aria-labelledby="Configuracao" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Escolha uma Opção:</h6>
                        <a class="collapse-item" href="<?php echo base_url('sistema'); ?>"> <i class="fas fa-cog"></i> Sistema</a>
                        <a class="collapse-item" href="<?php echo base_url('usuarios'); ?>"> <i class="fas fa-users"></i> Usuários</a>
                    </div>
                </div>
            </li> 
            <!-- Nav Item - Pages Collapse Menu
            <li class="nav-item active">
                <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true"
                    aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Pages</span>
                </a>
                <div id="collapsePages" class="collapse show" aria-labelledby="headingPages"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Login Screens:</h6>
                        <a class="collapse-item" href="login.html">Login</a>
                        <a class="collapse-item" href="register.html">Register</a>
                        <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
                        <div class="collapse-divider"></div>
                        <h6 class="collapse-header">Other Pages:</h6>
                        <a class="collapse-item" href="404.html">404 Page</a>
                        <a class="collapse-item active" href="blank.html">Blank Page</a>
                    </div>
                </div>
            </li> -->

            <!-- Nav Item - Charts
            <li class="nav-item">
                <a class="nav-link" href="charts.html">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Charts</span></a>
            </li> -->

            <!-- Nav Item - Tables
            <li class="nav-item">
                <a title="Dados do Sistema" class="nav-link" href="< ?php echo base_url('sistema'); ?>">
                    <i class="fas fa-cog"></i>
                    <span>Sistema</span></a>
            </li>            
            <li title="Gerencia Usuários" class="nav-item">
                <a class="nav-link" href="< ? php echo base_url('usuarios'); ?>">
                    <i class="fas fa-users"></i>
                    <span>Usuários</span></a>
            </li> -->

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

                <!-- Content Wrapper -->
                <div id="content-wrapper" class="d-flex flex-column">