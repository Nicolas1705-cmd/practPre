<!-- start: header -->
<?php     require_once "./controller/NavController.php";
          $instNav= new NavController(); 
 ?>

      <header class="header">
        <div class="logo-container">
          <a href="" class="logo">
            <img src="<?php echo SERVERURL; ?>view/assets/images/wce.png" height="35" alt="Porto Admin" />
          </a>
          <div class="visible-xs toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">
            <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
          </div>
        </div>
      
        <!-- start: search & user box -->
        <div class="header-right">
      
          <form action="<?php echo SERVERURL; ?>search" class="search nav-form">
            <div class="input-group input-search">
              <input type="text" class="form-control" name="q" id="q" placeholder="Search...">
              <span class="input-group-btn">
                <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form>
      
          <span class="separator"></span>
      
          <ul class="notifications">
            <li>
              <a href="#" class="dropdown-toggle notification-icon" data-toggle="dropdown">
                <i class="fa fa-tasks"></i>
                <span class="badge">3</span>
              </a>
      
              <div class="dropdown-menu notification-menu large">
                <div class="notification-title">
                  <span class="pull-right label label-default">3</span>
                  Tasks
                </div>
      
                <div class="content">
                  <ul>
                    <li>
                      <p class="clearfix mb-xs">
                        <span class="message pull-left">Reportes Generados</span>
                        <span class="message pull-right text-dark">60%</span>
                      </p>
                      <div class="progress progress-xs light">
                        <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div>
                      </div>
                    </li>
      
                    <li>
                      <p class="clearfix mb-xs">
                        <span class="message pull-left">Import</span>
                        <span class="message pull-right text-dark">98%</span>
                      </p>
                      <div class="progress progress-xs light">
                        <div class="progress-bar" role="progressbar" aria-valuenow="98" aria-valuemin="0" aria-valuemax="100" style="width: 98%;"></div>
                      </div>
                    </li>
      
                    <li>
                      <p class="clearfix mb-xs">
                        <span class="message pull-left">Subida de Archivos</span>
                        <span class="message pull-right text-dark">33%</span>
                      </p>
                      <div class="progress progress-xs light mb-xs">
                        <div class="progress-bar" role="progressbar" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100" style="width: 33%;"></div>
                      </div>
                    </li>
                  </ul>
                </div>
              </div>
            </li>
            <li>
              <a href="#" class="dropdown-toggle notification-icon" data-toggle="dropdown">
                <i class="fa fa-envelope"></i>
                <span class="badge"><?php //echo $instNav->getNumMensajes(); ?></span>
              </a>
      
              <div class="dropdown-menu notification-menu">
                <div class="notification-title">
                  <span class="pull-right label label-default"><?php //echo $instNav->getNumMensajes(); ?></span>
                  Correo
                </div>
      
                <div class="content">
                  <ul>
                   
                    <?php  //$instNav->obtenerAsuntosDelMails(); ?>
                 </ul>
                  <hr />
      
                  <div class="text-right">
                    <a href="#" class="view-more">Ver Todo</a>
                  </div>
                </div>
              </div>
            </li>
            <li class="notify-list">
             <?php  
          echo $instNav->listNotifyController();
              ?>
            </li>
          </ul>
      
          <span class="separator"></span>
      
          <div id="userbox" class="userbox">
            <a href="#" data-toggle="dropdown">
              <figure class="profile-picture">
                <img src="<?php echo SERVERURL; ?>view/assets/images/!logged-user.jpg" alt="Andres Calderon" class="img-circle" data-lock-picture="<?php echo SERVERURL; ?>view/assets/images/!logged-user.jpg" />
              </figure> <?php $textlock="";
               if (isset($_SESSION['Encryuser'])) {   $textlock=$_SESSION['Nameuser']; } ?>
              <div class="profile-info" data-lock-name="<?php echo  $textlock ?>" data-lock-email="andrescalderon@americansoftperu.pe">
                <span class="name"><?php if (isset($_SESSION['Encryuser'])) {
 echo $_SESSION['Nameuser']; 
} ?></span>
                <span class="role"><?php if (isset($_SESSION['Encryuser'])) {
 echo $_SESSION['Namecargo']; }?></span>
              </div>
      
              <i class="fa custom-caret"></i>
            </a>
      
            <div class="dropdown-menu">
              <ul class="list-unstyled">
                <li class="divider"></li>
                 <?php if (isset($_SESSION['Encryuser'])) {
                $idcargo=mainModel::decryption($_SESSION['Encrycargo']);
if ($idcargo!=12) {

?>
                <li>
                  <a  href="<?php echo SERVERURL ?>perfil"><i class="fa fa-user"></i> Mi Perfil</a>
                </li>
                <li>
                  <a  href="<?php echo SERVERURL ?>secured" ><i class="fa fa-lock"></i> Seguridad</a>
                </li>
              <?php }} ?>
                <li>
                  <a href="<?php echo SERVERURL ?>ajax/loginAjax.php?salir=off"><i class="fa fa-power-off"></i> Cerrar Sesion</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <!-- end: search & user box -->
      </header>
      <!-- end: header -->      

     