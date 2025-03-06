     <?php 
          require_once "./controller/PlacasController.php";
          $inst= new PlacasController();  
          $titulo = "Placas"; 
$ajaxGlobal="placaAjax";   
     $typeElemento="data-type='lista'";

         ?>


<input type="hidden" id="ajax" value="<?php  echo $ajaxGlobal ?>" >

          <header class="page-header">
            <h2>Placa de Vehiculo</h2>
          
            <div class="right-wrapper pull-right">
              <ol class="breadcrumbs">
                <li>
                  <a href="<?php echo SERVERURL ?>home">
                    <i class="fa fa-home"></i>
                  </a>
                </li>
                <li><span>Inicio</span></li>
                <li><span>Placa de Vehiculo </span></li>
              </ol>
          
              <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
            </div>
          </header>

          <!-- start: page -->
            <section class="panel">
              <header class="panel-heading">
                <div class="panel-actions">
                  <a href="#" class="fa fa-caret-down"></a>
                  <a href="#" class="fa fa-times"></a>
                </div>
                 <div style="display: inline-block;">
                  <h2 class="panel-title">LISTADO</h2> 
                </div>
               <div  class="ml-xs" style="display: inline;">
             <div  class="switch switch-sm switch-primary">
           <input id="myonoffswitch" type="checkbox" name="switch" data-plugin-ios-switch checked="checked"   onchange="listarDatable()"  />
               </div>     
             </header>
              <div class="panel-body pr-none">
  <div class="tabs ">
                <ul class="nav nav-tabs ">
                  <li class="active">
                    <a href="#popular" onclick="listarDatable()" data-toggle="tab"><i class="fa fa-star"></i> Lista</a>
                  </li>
                                   

                  <li>
                    <a href="#recent"  onclick="resetForm()" data-toggle="tab">Nuevo Registro</a>
                  </li>
                                  

                </ul>
                <div class="tab-content ">
                  <div id="popular" class="tab-pane active ">
                 
                <table class="table table-bordered table-striped mb-none" id="datatable-default">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Placa</th>
                      <th>Codigo</th>
                      <th>Marca</th>
                      <th>Modelo</th>

                      <th class="hidden-phone">Accion</th>
                    </tr>
                  </thead>
                  <tbody>
                
                  </tbody>
                </table>
                  </div>
                                   

                  <div id="recent" class="tab-pane  ">
                             <div class="col-md-12">
             <form class="formAjax" action="<?php echo SERVERURL; ?>ajax/placaAjax.php" method="POST" data-form="save" data-ajax="placaAjax" data-urlhttp="<?php echo SERVERURL; ?>" <?php echo $multipart ?>  autocomplete="off" >

                 <?php echo $inst->paintForm("save"); ?>
                             <div class="RespuestaAjax"></div>

               </form>
                    </div>


                  </div>
                               

                </div>
              </div>

              </div>
            </section>
                
           
       
          <!-- end: page -->
