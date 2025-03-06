
<?php 
      require_once "./controller/PerfilController.php";
          $inst= new PerfilController();  
          $titulo = "Client"; 
 ?>
 <style type="text/css">
   .timeline.timeline-simple.mt-xlg.mb-md {
    max-height: 456px;
    overflow-y: auto;
}
 </style>
<header class="page-header">
            <h2>PERFIL </h2>
            <div class="right-wrapper pull-right">
              <ol class="breadcrumbs">
                <li>
                  <a href="<?php echo SERVERURL ?>home">
                    <i class="fa fa-home"></i>
                  </a>
                </li>
                <li><span>Inicio</span></li>
                <li><span>Perfil</span></li>
              </ol>
          
              <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
            </div>
          </header>
            <div class="row">
    
            <div class="col-md-12 col-lg-12">

              <div class="tabs">
                <ul class="nav nav-tabs tabs-primary">
                  <li class="active">
                    <a href="#overview" data-toggle="tab">Resumen</a>
                  </li>
                  <li>
                    <a href="#edit" data-toggle="tab">Mis Datos Personal</a>
                  </li>
                </ul>
                <div class="tab-content">
                  <div id="overview" class="tab-pane active">
                    <h4 class="mb-md">Mis actividades</h4>
           
                    <div class="timeline timeline-simple mt-xlg mb-md">
                      <div class="tm-body">
                        <div class="tm-title">
                          <h3 class="h5 text-uppercase"> <?php  echo strftime("%B %Y");    ?></h3>
                        </div>
                        <ol class="tm-items">
                      
                                         <?php echo $inst->paintActividad(); ?>

                        </ol>
                      </div>
                    </div>
                  </div>
                  <div id="edit" class="tab-pane">

  <div id="tabsForm" class="tabs tabs-primary">
                <ul class="submenu nav nav-tabs">
                  <li class="active">
                    <a href="#popular11" data-toggle="tab"><i class="fa  fa-book"></i> Mis Datos</a>
                  </li>
                  <li >
                    <a href="#recent11" data-toggle="tab"><i class="fa  fa-shield fa-star"></i> Seguridad</a>
                  </li>
                </ul>
                <div class="tab-content">
                  <div id="popular11" class="tab-pane active">
                   <form  class="formAjax"  action="<?php echo SERVERURL; ?>ajax/profileAjax.php" method="POST" data-form= "save" data-ajax="profileAjax" data-urlhttp="<?php echo SERVERURL; ?>" autocomplete="off">
                    <?php echo $inst->paintForm("save"); ?>
                      <div class="panel-footer">
                        <div class="row">
                          <div class="col-md-9 col-md-offset-3">
                            <button type="submit" class="btn btn-primary">Actualizar</button>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                  <div id="recent11" class="tab-pane">
          <form  id="formAjax2"  action="<?php echo SERVERURL; ?>ajax/profileAjax.php" method="POST" data-form= "update" data-ajax="profileAjax" data-urlhttp="<?php echo SERVERURL; ?>" autocomplete="off">

             <h4 class="mb-xlg">Actualizar Contraseña</h4>
                      <fieldset class="mb-xl">
                        <div class="form-group">
                          <label class="col-md-3 control-label" for="profileOldPassword">Contraseña Actual  <span class="required">*</span></label>
                          <div class="col-md-4">
                                                  <input type="hidden"  name="update" >

                            <input type="password" class="form-control"  name="passwordActual" id="profileOldPassword" placeholder="password" onkeypress="return checkpassword(this,event);" maxlength="30" required="">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-3 control-label" for="profileNewPassword">Nueva Contraseña</label>
                          <div class="col-md-4">
                            <input type="password" class="form-control" name="password" placeholder="password" id="NewPassword"  onkeypress="return checkpassword(this,event);" maxlength="30" >
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-3 control-label" for="profileNewPasswordRepeat">Repetir Nueva Contraseña</label>
                          <div class="col-md-4">
                            <input type="password" name="passwordRep" class="form-control" id="NewPasswordRepeat" placeholder="password" onkeypress="return checkpassword(this,event);" maxlength="30" >
                          </div>
                        </div>
                      </fieldset> 
                 
                      <div class="panel-footer">
                        <div class="row">
                          <div class="col-md-9 col-md-offset-3">
                            <button type="submit" class="btn btn-primary">Actualizar</button>
                          </div>
                        </div>
                      </div>

                    </form>
                  </div>
                </div>
              </div>

                  </div>
                </div>
              </div>
            </div>

          </div>