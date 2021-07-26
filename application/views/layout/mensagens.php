                     <!-- MENSSAGEN DE ERRO -->
                    <?php if ($message = $this->session->flashdata('error')):?>
                        <div class="row">
                            <div class="col-md-12">
                                
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong><i class="fas fa-exclamation-triangle"></i>&nbsp<?php echo $message; ?>. </strong> Contate o Administrador!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>                                
                            
                            </div>    
                        </div>
                    <?php endif; ?>

                     <!-- MENSSAGENS DE SUCESSO -->
                     <?php if ($message = $this->session->flashdata('sucesso')):?>
                        <div class="row">
                            <div class="col-md-12">
                                
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong><i class="far fa-smile-wink"></i>&nbsp<?php echo $message; ?>. </strong> Parabens!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>                                
                            
                            </div>    
                        </div>
                    <?php endif; ?>                    
                     <!-- MENSSAGENS DE INFO -->
                     <?php if ($message = $this->session->flashdata('info')):?>
                        <div class="row">
                            <div class="col-md-12">
                                
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong><i class="fas fa-info"></i>&nbsp<?php echo $message; ?>. </strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>                                
                            
                            </div>    
                        </div>
                    <?php endif; ?>   
 