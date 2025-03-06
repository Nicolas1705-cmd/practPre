
<style>
  .bdprincipal {
 width: 100%;
    padding: 0 7%;
    display: table;
    margin: 0;
    max-width: none;
    background-color: #373B44;
    height: 100vh;
 }
 .content-body{
  padding: 0px !important;
 }
</style>
<?php  require_once "./controller/HomeController.php"; $inst= new HomeController(); ?>   

          <header class="page-header">
            <h2>Dashboard</h2>
          
            <div class="right-wrapper pull-right">
              <ol class="breadcrumbs">
                <li>
                  <a href="<?php echo SERVERURL ?>">
                    <i class="fa fa-home"></i>
                  </a>
                </li>
                <li><span>Home</span></li>
               
              </ol>
          
              <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
            </div>
          </header>
          <!-- start: page -->
     
           
       
          <!-- end: page -->
