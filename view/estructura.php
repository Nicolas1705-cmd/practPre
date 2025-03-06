<?php        session_start();?>
<!doctype html>
<html  lang="es" class="fixed">
  <head>

    <!-- Basic -->
    <meta charset="UTF-8">

    <title>Sistema WCE</title>
    <meta name="keywords" content="wce" />
    <meta name="description" content="Sistema wce ">
    <meta name="author" content="http://americansoftperu.pe/">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

    <!-- Web Fonts  -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">
    <link rel="shortcut icon" href="<?php echo SERVERURL; ?>view/assets/images/wce.png" />

    <!-- Vendor CSS -->
    <link rel="stylesheet" href="<?php echo SERVERURL; ?>view/assets/vendor/bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <!--<link rel="stylesheet" href="<?php echo SERVERURL; ?>view/assets/vendor/font-awesome/css/font-awesome.css" />-->
    <link rel="stylesheet" href="<?php echo SERVERURL; ?>view/assets/vendor/magnific-popup/magnific-popup.css" />
    <link rel="stylesheet" href="<?php echo SERVERURL; ?>view/assets/vendor/bootstrap-datepicker/css/datepicker3.css" />
    <link rel="stylesheet" href="<?php echo SERVERURL; ?>view/assets/vendor/bootstrap-timepicker/css/bootstrap-timepicker.css" />
    <!-- Specific Page Vendor CSS -->
    <link rel="stylesheet" href="<?php echo SERVERURL; ?>view/assets/vendor/owl-carousel/owl.carousel.css" />
    <link rel="stylesheet" href="<?php echo SERVERURL; ?>view/assets/vendor/owl-carousel/owl.theme.css" />

    <!-- Specific Page Vendor CSS -->
  <link rel="stylesheet" href="<?php echo SERVERURL; ?>view/assets/vendor/select2/select2.css" />
     <link rel="stylesheet" href="<?php echo SERVERURL; ?>view/css/bootstrap-select.min.css"/>
      <link rel="stylesheet" href="<?php echo SERVERURL; ?>view/assets/vendor/Autocomplete-Bootstrap-Select/dist/css/ajax-bootstrap-select.css" />


   <link rel="stylesheet" href="<?php echo SERVERURL; ?>view/assets/vendor/jquery-datatables-bs3/assets/css/datatables.css" />

    <!-- Specific Page Vendor CSS -->
    <link rel="stylesheet" href="<?php echo SERVERURL; ?>view/assets/vendor/bootstrap-fileupload/bootstrap-fileupload.min.css" />

    <!-- Theme CSS -->
    <link rel="stylesheet" href="<?php echo SERVERURL; ?>view/assets/stylesheets/theme.css?v8" />

    <!-- Skin CSS -->
    <link rel="stylesheet" href="<?php echo SERVERURL; ?>view/assets/stylesheets/skins/default.css?v3" />

    <!-- Theme Custom CSS -->
    <link rel="stylesheet" href="<?php echo SERVERURL; ?>view/assets/stylesheets/theme-custom.css">

 <link rel="stylesheet" href="<?php echo SERVERURL; ?>view/assets/vendor/pnotify/pnotify.custom.css" />

    <!-- Head Libs -->
    <script src="<?php echo SERVERURL; ?>view/assets/vendor/modernizr/modernizr.js"></script>
      <link rel="stylesheet" href="<?php echo SERVERURL; ?>view/css/bootstrap-datetimepicker.css" />

<style >
.select2-container.select2-container--default.select2-container--open  {
  z-index: 5000;
}

.capa1 {
   z-index: 100 !important;
}
.capa2 {
    z-index: 9999  !important;
}


.menuperf{
  width: 114px !important;height: 426px !important;
}

.bootstrap-timepicker-widget.dropdown-menu.open {
    z-index:  10001;
}

.clsDatePicker {
    z-index: 100000;
}
.datepicker.datepicker-dropdown.dropdown-menu.datepicker-orient-left.datepicker-orient-bottom {
    z-index: 20000!important;
}
.datepicker.datepicker-dropdown.dropdown-menu.datepicker-orient-left.datepicker-orient-top {
    z-index: 200000 !important;
}
.colorwhite{
  color: #ffff!important;
}
.inputtable {
  font-size: 16px;
  font-size: max(16px, 1em);
  font-family: inherit;
  padding: 0.25em 0.5em;
  background-color: #fff;
  border: 2px solid #E5E7E9;
  border-radius: 4px;
}
.btn-gray{

   color: #ffffff;
   background-color: #808080;
   border-color: #696969;

}  
.bootstrap-select .dropdown-menu {
    min-width: 100%;
    max-width: 100% !important;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
}
</style>

  </head>

  <!-- SideBar -->
  <?php

$peticionAjax=false;
  require_once "./controller/viewController.php";
  $vs = new viewController();
  $vrequest = $vs->get_view_controller();
          $rutaact=explode("/",$vrequest);
$rutalogin=$rutaact[0];
      if ($rutalogin!="login"  ) {
       $rutaact=explode("-",$rutaact[0]);
    }
    ?>
<body>


    <?php
    if($vrequest == "login" || $vrequest == "404"): 
      if($vrequest == "login"){

        require_once "./view/content/login-view.php";
      }else{
        require_once "./view/content/404-view.php";
      }
      
      else:
$peticionAjax=false;
require_once "./controller/HomeController.php";
    $instcontrol= new HomeController();

     if (!isset($_SESSION["Encryuser"])) {
  echo '<script> window.location.href="'.SERVERURL.'login/"</script>';


             }

$multipart="";
    ?>
  
    <section class="body">

  <!-- Content page-->
   <?php include 'view/modules/nav-super.php'; ?>
  
    <!-- NavBar -->
      <div class="inner-wrapper">

   <?php include 'view/modules/barralateral.php'; ?>
        <section role="main" class="content-body">
<input type="hidden" id="view" value="<?php  echo $rutaact[0] ?>" >
<input type="hidden" id="url" value="<?php  echo SERVERURL ?>" >
<input type="hidden" id="Emailuser" value="<?php  echo $_SESSION['Emailuser']?>">
<input type="hidden" id="encryuuser" value="<?php echo $_SESSION['Encryuser']?>">
<input type="hidden" id="roluserency" value="<?php echo  $_SESSION['Encrycargo']?>">
    <?php 
    require_once  $vrequest; ?>
   
        </section>
      </div>
 
      <aside id="sidebar-right" class="sidebar-right">
        <div class="nano">
          <div class="nano-content">
            <a href="#" class="mobile-close visible-xs">
              Collapse <i class="fa fa-chevron-right"></i>
            </a>
      
            <div class="sidebar-right-wrapper">
      
              <div class="sidebar-widget widget-calendar">
                <h6>Area de Trabajo</h6>
                <div id="pickerArea" data-date="<?php echo date("d/m/Y");?>"  data-plugin-datepicker data-plugin-skin="dark" ></div>

                <ul>
                  <li>
                    <time datetime="2021-02-24T00:00+00:00"><?php echo date("d/m/Y");?></time>
                    <span>Empresa Interna</span>
                  </li>
                </ul>
              </div>
      
              <div class="sidebar-widget widget-friends">
                <h6>Conectados</h6>
                <ul>
                  <li class="status-online">
                    <figure class="profile-picture">
                      <img src="<?php echo SERVERURL; ?>view/assets/images/!sample-user.jpg" alt="Joseph Doe" class="img-circle">
                    </figure>
                    <div class="profile-info">
                      <span class="name">Andres Calderon</span>
                      <span class="title">Procesando...</span>
                    </div>
                  </li>
                  <li class="status-online">
                    <figure class="profile-picture">
                      <img src="<?php echo SERVERURL; ?>view/assets/images/!sample-user.jpg" alt="Joseph Doe" class="img-circle">
                    </figure>
                    <div class="profile-info">
                      <span class="name">Andres Calderon</span>
                      <span class="title">Procesando...</span>
                    </div>
                  </li>
                  <li class="status-offline">
                    <figure class="profile-picture">
                      <img src="<?php echo SERVERURL; ?>view/assets/images/!sample-user.jpg" alt="Joseph Doe" class="img-circle">
                    </figure>
                    <div class="profile-info">
                      <span class="name">Andres Calderon</span>
                      <span class="title">Procesando...</span>
                    </div>
                  </li>
                  <li class="status-offline">
                    <figure class="profile-picture">
                      <img src="<?php echo SERVERURL; ?>view/assets/images/!sample-user.jpg" alt="Joseph Doe" class="img-circle">
                    </figure>
                    <div class="profile-info">
                      <span class="name">Andres Calderon</span>
                      <span class="title">Procesando...</span>
                    </div>
                  </li>
                </ul>
              </div>
      
            </div>
          </div>
        </div>
      </aside>
    </section>

<?php endif; ?> 
  <!-- Dialog help -->
  <!--====== Scripts  $("#dropdown").select2("val", "");
-->
  <?php include "view/modules/footer.php"; ?>
</body>
</html>
