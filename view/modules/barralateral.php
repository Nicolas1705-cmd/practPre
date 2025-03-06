
<style type="text/css">
  .gold{
  color: gold;
  font-size:19px;
}

.select > a{
    background-color:#21262d;
    color: #FFFFFF !important;
}
.activored > a{
    color: red !important;
  }

</style>
       <!-- start: sidebar -->
        <aside id="sidebar-left" class="sidebar-left">
        
          <div class="sidebar-header">
            <div class="sidebar-title">
              MENU PRINCIPAL 
            </div>
            <div class="sidebar-toggle hidden-xs" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
              <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
            </div>
          </div>
        
          <div class="nano">
            <div class="nano-content">
              <nav id="menu" class="nav-main" role="navigation">
                <ul class="nav nav-main">

                  <!--    AQUI AGREGAREMOS LAS RUTAS DE MI BARRA LATERAL va el nombre del archivo vista sin el guion -view.php  -->
                  <li <?php if ($rutaact[0]=="material" ) { ?> class="select" <?php } ?> >
                    <a href="<?php echo SERVERURL ?>material">
                      <i class="fa fa-home" aria-hidden="true"></i>
                      <span>MATERIAL</span>
                    </a>
                  </li>

                  <li <?php if ($rutaact[0]=="communication" ) { ?> class="select" <?php } ?> >
                    <a href="<?php echo SERVERURL ?>communication">
                      <i class="fa fa-home" aria-hidden="true"></i>
                      <span>COMUNICACIÒN</span>
                    </a>
                  </li>

                  <li <?php if ($rutaact[0]=="banks" ) { ?> class="select" <?php } ?> >
                    <a href="<?php echo SERVERURL ?>banks">
                      <i class="fa fa-home" aria-hidden="true"></i>
                      <span>BANCO</span>
                    </a>
                  </li>

                  <li <?php if ($rutaact[0]=="driver" ) { ?> class="select" <?php } ?> >
                    <a href="<?php echo SERVERURL ?>driver">
                      <i class="fa fa-home" aria-hidden="true"></i>
                      <span>DRIVER</span>
                    </a>
                  </li>

                  <li <?php if ($rutaact[0]=="areas" ) { ?> class="select" <?php } ?> >
                    <a href="<?php echo SERVERURL ?>areas">
                      <i class="fa fa-home" aria-hidden="true"></i>
                      <span>ÀREAS</span>
                    </a>
                  </li>

                  <li <?php if ($rutaact[0]=="vehicle" ) { ?> class="select" <?php } ?> >
                    <a href="<?php echo SERVERURL ?>vehicle">
                      <i class="fa fa-home" aria-hidden="true"></i>
                      <span>VEHÍCULOS</span>
                    </a>
                  </li>

                  </li>
                  <li <?php if ($rutaact[0]=="productos" ) { ?> class="select" <?php } ?> >
                    <a href="<?php echo SERVERURL ?>productos">
                      <i class="fa fa-home" aria-hidden="true"></i>
                      <span>PRODUCTOS</span>
                    </a>
                  </li>
           

                </ul>
              </nav>
      
              <hr class="separator" />
          
            </div>
        
          </div>
        
        </aside>