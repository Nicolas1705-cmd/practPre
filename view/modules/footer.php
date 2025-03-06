<!--MODIFICADO -->     
 <?php if($rutaact[0]!="home" && $rutaact[0]!="login" &&  $rutaact[0]!="roles" &&  $rutaact[0]!="perfil" &&  $rutaact[0]!="secured" &&  $rutaact[0]!="search" && $rutaact[0]!="actividad"  && $rutaact[0]!="shipmenttraking" && $rutaact[0]!="servicetracking" && $rutaact[0]!="registerbd" && $rutaact[0]!="charguecontrol" && $rutaact[0]!="indicadores"){ ?>
<div id="modalEditForm"   class="modal-block modal-header-color modal-block-primary mfp-hide" >
     <div class="col-md-12 p-none">
      <form   id="formAjax2"    action="<?php echo SERVERURL; ?>ajax/<?php  echo $ajaxGlobal ?>.php" method="POST" data-form="update" data-ajax="<?php  echo $ajaxGlobal ?>" data-urlhttp="<?php echo SERVERURL; ?>" <?php echo $multipart ?>  autocomplete="off" >
        <?php  echo $inst->paintForm("update"); ?>
        </form>
      </div>
  </div>
<?php } ?>

<!--MODIFICADO -->     

   <?php if($rutaact[0]=="secured" ){ ?>

   <div id="modalConfirmCopy" class="modal-block modal-header-color modal-block-primary mfp-hide">
                    <section class="panel">
                      <header class="panel-heading">
                        <h2 class="panel-title">¿ Confirmación de Operación ?</h2>
                      </header>
                      <div class="panel-body">
                        <div class="modal-wrapper">
                          <div class="modal-icon">
                            <i class="fa fa-question-circle"></i>
                          </div>
                          <div class="modal-text">
                            <h4>Mensaje</h4>
                            <p>¿ Estas seguro de realizar la siguiente operacion ?</p>
                                 <div class="loadGuardado"></div>
                                   <div class="RespuestaAjax"></div>

                         </div>
                        </div>
                      </div>
                      <footer class="panel-footer">
                        <div class="row">
                          <div class="col-md-12 text-right">
                            <button class="btn btn-primary modal-confirm modalCopyconfirm">Confirmar</button>
                            <button class="btn btn-default modalform-confirmRolesdismiss">Cancelar</button>
                          </div>
                        </div>
                      </footer>
                    </section>
                  </div>            
<?php } ?>
   <?php if($rutaact[0]=="roles" ){ ?>
<div id="modalEditForm" class="modal-block modal-header-color modal-block-primary mfp-hide">
                        <div class="col-md-12 p-none idFormRoles">
                          
                    </div>
                  </div>
   <div id="modalConfirmRoles" class="modal-block modal-header-color modal-block-primary mfp-hide">
                    <section class="panel">
                      <header class="panel-heading">
                        <h2 class="panel-title">¿ Confirmación de Operación ?</h2>
                      </header>
                      <div class="panel-body">
                        <div class="modal-wrapper">
                          <div class="modal-icon">
                            <i class="fa fa-question-circle"></i>
                          </div>
                          <div class="modal-text">
                            <h4>Mensaje</h4>
                            <p>¿ Estas seguro de realizar la siguiente operacion ?</p>
                                 <div class="loadGuardado"></div>
                                   <div class="RespuestaAjax"></div>
                                <input type="hidden"  id="idCargo" >
             

                         </div>
                        </div>
                      </div>
                      <footer class="panel-footer">
                        <div class="row">
                          <div class="col-md-12 text-right">
                            <button class="btn btn-primary modal-confirm modalform-Rolesconfirm">Confirmar</button>
                            <button class="btn btn-default modalform-confirmRolesdismiss">Cancelar</button>
                          </div>
                        </div>
                      </footer>
                    </section>
                  </div>            




<?php } ?>


   <div id="modalHeaderColorPrimary" class="modal-block modal-header-color modal-block-primary mfp-hide">
                    <section class="panel">
                      <header class="panel-heading">
                        <h2 class="panel-title">¿ Confirmación de Operación ?</h2>
                      </header>
                      <div class="panel-body">
                        <div class="modal-wrapper">
                          <div class="modal-icon">
                            <i class="fa fa-question-circle"></i>
                          </div>
                          <div class="modal-text">
                            <h4>Mensaje</h4>
                            <p>¿ Estas seguro de realizar la siguiente operacion ?</p>
                                 <div class="loadGuardado"></div>
                                   <div class="RespuestaAjax"></div>
                      <input type="hidden"  id="selectform" >
             

                         </div>
                        </div>
                      </div>
                      <footer class="panel-footer">
                        <div class="row">
                          <div class="col-md-12 text-right">
                            <button class="btn btn-primary modal-confirm modalform-confirm">Confirmar</button>
                            <button class="btn btn-default modalform-dismiss">Cancelar</button>
                          </div>
                        </div>
                      </footer>
                    </section>
                  </div>            

           
            <div id="modalfoto" class="modal-block modal-block-xs mfp-hide">
                    <section class="panel">
                      <header class="panel-heading">
                        <h2 class="panel-title">Galeria</h2>
                      </header>
                      <div class="panel-body">
                        <div class="modal-wrapper">
                         <div class="text-center">
                           <img id="infogallery" src="<?php echo SERVERURL ?>view/assets/images/nuevo.png"  width="800px">
                         </div>

                        </div>
                      </div>
                      <footer class="panel-footer">
                        <div class="row">
                          <div class="col-md-12 text-center">
                           <button class="btn btn-default modal-dismiss">Cerrar
                           </button>
                          </div>
                        </div>
                      </footer>
                    </section>
                  </div>
                <div id="modalIcon" class="modal-block modal-block-primary mfp-hide">
                    <section class="panel">
                      <header class="panel-heading">
                        <h2 class="panel-title">Estas Seguro?</h2>
                      </header>
                      <div class="panel-body">
                        <div class="modal-wrapper">
                          <div class="modal-icon">
                            <i class="fa fa-question-circle"></i>
                          </div>
                          <div class="modal-text">
                      <p class="msgActivateDeleted"></p>
                          <div class="loadGuardado"></div>
                                   <div class="RespuestaAjax"></div>
                                      <input type="hidden"  id="ajaxElemento" >
                                      <input type="hidden"  id="urlElemento" >
                               <input type="hidden"  id="typElemento" >

                               <input type="hidden"  id="idElemento" >
                      <input type="hidden"  id="statuElemento" >
                          </div>
                        </div>
                      </div>
                      <footer class="panel-footer">
                        <div class="row">
                          <div class="col-md-12 text-right">
                            <button class="btn btn-primary modal-confirm activatedesactivar-modal">Confirmar</button>
                            <button class="btn btn-default modal-dismiss">Cancelar</button>
                          </div>
                        </div>
                      </footer>
                    </section>
                  </div>

 <div id="modalOperacionTarifa" class="modal-block modal-header-color modal-block-primary mfp-hide">
                    <section class="panel">
                      <header class="panel-heading">
                        <h2 class="panel-title">¿ Confirmación de Operación ?</h2>
                      </header>
                      <div class="panel-body">
                        <div class="modal-wrapper">
                          <div class="modal-icon">
                            <i class="fa fa-question-circle"></i>
                          </div>
                          <div class="modal-text">
                            <h4>Mensaje</h4>
                            <p>¿ Estas seguro de realizar la siguiente operacion ?</p>
                                 <div class="loadGuardado"></div>
                                   <div class="RespuestaAjax"></div>
                      <input type="hidden"  id="selectformTarifa" >
             
                      <input type="hidden"  id="urlopTarifa" >

                      <input type="hidden"  id="urlopAjax" >
                         </div>
                        </div>
                      </div>
                      <footer class="panel-footer">
                        <div class="row">
                          <div class="col-md-12 text-right">
                            <button class="btn btn-primary modal-confirm modalformOpTarifa-confirm">Confirmar</button>
                            <button class="btn btn-default modalform-dismiss">Cancelar</button>
                          </div>
                        </div>
                      </footer>
                    </section>
                  </div> 


<!--

                    <div id="modalCorreos" class="modal-block modal-block-info">
                    <section class="panel">
                      <header class="panel-heading">
                        <h2 class="panel-title">Gmail</h2>
                      </header>
                      <div class="panel-body">
                        <div class="modal-wrapper">
                          
                          <div class="modal-text">
                           
                            <h4 class="txtAsunto"></h4>
                            <p class="txtMensaje"></p>

                         </div>
                        </div>
                      </div>
                      <footer class="panel-footer">
                        <div class="row">
                          <div class="col-md-12 text-right">
                            <button class="btn btn-primary modal-confirm modalCopyconfirm">Confirmar</button>
                            <button class="btn btn-default modalform-confirmRolesdismiss">Cancelar</button>
                          </div>
                        </div>
                      </footer>
                    </section>
                  </div>  -->
     <?php if($rutaact[0]=="solicitud" ){ ?>
          
<div id="modalcontact" class="modal fade"  data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-center" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="resetmodalFt();"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Agregar Contacto</h4>
      </div>
         <form   id="formAjaxContacto"    action="<?php echo SERVERURL; ?>ajax/<?php  echo $ajaxGlobal ?>.php" method="POST" data-form="update" data-ajax="<?php  echo $ajaxGlobal ?>" data-urlhttp="<?php echo SERVERURL; ?>" <?php echo $multipart ?>  autocomplete="off"   >
      <div class="modal-body">
   <h5 class="text-center txt-cl"></h5>
   <input type="hidden" id="savecontact" name="savecontact">
   <input type="hidden" id="clientcontactoadd" name="idClient">
      <input type="hidden" id="clientcontactoname" name="nameClient">
   <input type="hidden" id="clientcontactoaddtypS" name="typeService">

<div class="row">
                        <div class="col-sm-6 mb-xs"> 
                                       <div class="form-group">
                      <label class="control-label">Nombre de Contacto</label>
                      <input type="text" name="namecontact" maxlength="70" class="form-control namecontact"   onkeypress="return checkText(this,event);" required >
                      </div>
                                 </div> 

 <div class="col-sm-6 mb-xs"> 
                                       <div class="form-group">
                      <label class="control-label">DNI</label>
                      <input type="number" name="dnicontact" class="form-control dnicontact" min="1" max="99999999" data-maxlength="8" oninput="this.value=this.value.slice(0,this.dataset.maxlength)" required >
                      </div>
                                 </div>  
                                   <div class="col-sm-6 mb-xs"> 
                                       <div class="form-group">
                      <label class="control-label">Area</label>
                      <input type="text" name="areacontact" maxlength="45" class="form-control areacontact" onkeypress="return checkTotal(this,event);" required >
                      </div>
                                 </div>



                                <div class="col-sm-6 mb-xs"> 
                                       <div class="form-group">
                      <label class="control-label">Celular</label>
                      <input type="number" name="phonecontact" max="999999999999999" data-maxlength="15" class="form-control phonecontact" oninput="this.value=this.value.slice(0,this.dataset.maxlength)" required  >
                      </div>
                                 </div>  
                                   <div class="col-sm-6 mb-xs"> 
                                       <div class="form-group">
                      <label class="control-label">Email</label>
                <input type="email" name="emailcontact" maxlength="60" class="form-control emailcontact" required >
                      </div>
                                 </div>                     
</div>



      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" id="btnCMC" data-dismiss="modal" onclick="resetmodalFt();">Close</button>
        <button type="submit" class="btn btn-primary" id="btnCMSave">Guardar</button>
      </div>
    </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<?php } ?>





    <!-- Vendor -->
    <script src="<?php echo SERVERURL; ?>view/assets/vendor/jquery/jquery.js"></script>
    <script src="<?php echo SERVERURL; ?>view/assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
    <script src="<?php echo SERVERURL; ?>view/assets/vendor/bootstrap/js/bootstrap.js"></script>
    <script src="<?php echo SERVERURL; ?>view/assets/vendor/nanoscroller/nanoscroller.js"></script>
    <script src="<?php echo SERVERURL; ?>view/assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js?vw3"></script>

    <script src="<?php echo SERVERURL; ?>view/assets/vendor/magnific-popup/magnific-popup.js"></script>
    <script src="<?php echo SERVERURL; ?>view/assets/vendor/jquery-placeholder/jquery.placeholder.js"></script>
    <!--  validacion Files -->
   <script src="<?php echo SERVERURL; ?>view/assets/vendor/jquery-validation/jquery.validate.js"></script>
    <!--  notificacion Files -->
   <script src="<?php echo SERVERURL; ?>view/assets/vendor/pnotify/pnotify.custom.js"></script>
    <!-- Specific Page Vendor -->
    <script src="<?php echo SERVERURL; ?>view/assets/vendor/select2-3.5.3/select2.js"></script>
    <!--MODIFICADO -->     
   <script src="<?php echo SERVERURL; ?>view/js/bootstrap-select.min.js"></script>
    <script src="<?php echo SERVERURL; ?>view/assets/vendor/Autocomplete-Bootstrap-Select/dist/js/ajax-bootstrap-select.js"></script>
    <!--FIN -->     
    <script src="<?php echo SERVERURL; ?>view/assets/vendor/jquery-datatables/media/js/jquery.dataTables.js"></script>
    <script src="<?php echo SERVERURL; ?>view/assets/vendor/jquery-datatables/extras/TableTools/js/dataTables.tableTools.min.js"></script>
    <script src="<?php echo SERVERURL; ?>view/assets/vendor/jquery-datatables-bs3/assets/js/datatables.js"></script>

      <script src="<?php echo SERVERURL; ?>view/assets/vendor/owl-carousel/owl.carousel.js"></script>

    <!-- Theme Base, Components and Settings -->
    <script src="<?php echo SERVERURL; ?>view/assets/javascripts/theme.js"></script>
    <!-- Theme Custom -->
    <script src="<?php echo SERVERURL; ?>view/assets/javascripts/theme.custom.js"></script>
<!-- switch -->
        <script src="<?php echo SERVERURL; ?>view/assets/vendor/bootstrap-timepicker/js/bootstrap-timepicker.js?vw3"></script>

  <script src="<?php echo SERVERURL; ?>view/assets/vendor/ios7-switch/ios7-switch.js"></script>

<?php if($rutaact[0]=="brand" || $rutaact[0]=="product" || $rutaact[0]=="client"  || $rutaact[0]=="manifiesto"){ ?>
         <!-- lighbox -->
<script src="<?php echo SERVERURL; ?>view/assets/javascripts/ui-elements/examples.lightbox.js"></script>
    <!-- file upload -->
  <script src="<?php echo SERVERURL; ?>view/assets/vendor/bootstrap-fileupload/bootstrap-fileupload.min.js"></script>
    <?php  }?>
    <script src="<?php echo SERVERURL; ?>view/assets/vendor/jquery-autosize/jquery.autosize.js"></script>
    <script src="<?php echo SERVERURL; ?>view/assets/javascripts/theme.init.js"></script>
    <script src="<?php echo SERVERURL; ?>view/assets/javascripts/tables/examples.datatables.row.with.details.js"> </script>
  <script src="<?php echo SERVERURL; ?>view/assets/javascripts/tables/examples.datatables.tabletools.js"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.0.943/pdf.min.js"> </script>
              <script src="<?php echo SERVERURL; ?>view/js/jquery.achex.js"></script>
          <script src="<?php echo SERVERURL; ?>view/js/ws.js?v1.9"></script>
        <script src="<?php echo SERVERURL; ?>view/js/moment.min.js"></script>
                <script src="<?php echo SERVERURL; ?>view/js/moment-with-locales.min.js?v2"></script>
        <script src="<?php echo SERVERURL; ?>view/js/bootstrap-datetimepicker.min.js"></script>
        
       <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>
          <script src="<?php echo SERVERURL; ?>view/js/main.js?WCMCHV159"></script>
 
 
<?php if($rutaact[0]=="sae"){  ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-contextmenu/2.9.2/jquery.contextMenu.min.js" integrity="sha512-kvg/Lknti7OoAw0GqMBP8B+7cGHvp4M9O9V6nAYG91FZVDMW3Xkkq5qrdMhrXiawahqU7IZ5CNsY/wWy1PpGTQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

         <script type="text/javascript">

    $(function() {

      /**$(document).bind("contextmenu",function(e){
        return false;
    });**/


        $.contextMenu({
            selector: '.context-menu-one', 
            callback: function(key, options) {
            var variableClase =options.$trigger[0]["attributes"][0].value;
            var arrayClase = variableClase.split(" ");
            
            var idElemento0 =  arrayClase[2];
            var idElemento1= idElemento0.split("-");
            var idElemento = idElemento1[1];

            console.log(idElemento);
                var m =  key;
               // window.console && console.log(m) || alert(m); 
                if(m=="edit"){
                  $("#btnEditar"+idElemento).click();
                }
                if(m=="delete"){
                  $("#btnEliminar"+idElemento).click();
                 
                }
                  if(m=="add"){
                  $("#btnDocumento"+idElemento).click();
                }
            },
            items: {
              "add": {name: "Abrir", icon: "add"},
                "edit": {name: "Editar", icon: "edit"},
                "delete": {name: "Eliminar", icon: "delete"},
                "sep1": "---------",
                "quit": {name: "Salir", icon: function(){
                    return 'context-menu-icon context-menu-icon-quit';
                }}
            }
        });

        $('.context-menu-one').on('click', function(e){
            console.log('clicked', this);
        })    
    });

          function irAtras(){
var cadenaGlobal="";           
var sae= $(".idRuta").text();
var array = sae.split('/');

if(array.length == 2){
 $(".urlSae").val(array[0]+"/");
}else{
  var restaArray = array.length-2;
 // alert(restaArray);
  jQuery.each(array, function(index, item) {
  
if(restaArray>index){

    if(index==(array.length-1)){
cadenaGlobal+= item;
    }else{

      cadenaGlobal+= item+"/";
    }
    }else{

    }
});
  $(".idRuta").text(cadenaGlobal);
 $(".urlSae").val(cadenaGlobal);
}


          }
          function irAdelante(){

          }
function onchangePapelera(){
 $(".idRuta").text("PAPELERA");
  $('#myonoffswitch').prop('checked', false);

}
function homeList(){
  $(".urlSae").val("Mis Archivos/");
  $(".idRuta").text("Mis Archivos/");
  $('#myonoffswitch').prop('checked', true);
}
          function setUrl(op){
            if(op==1){
              $("#formCarpetas").addClass("formAjax");
               $("#formArchivos").removeClass("formAjax");
            }else{
                $("#formCarpetas").removeClass("formAjax");
               $("#formArchivos").addClass("formAjax");
            }

             var sae= $(".idRuta").text();
$(".urlSae").val(sae);
          }
       
         </script>
<?php } ?>
   <?php if($rutaact[0]=="personal" ){ ?>
          <script src="<?php echo SERVERURL; ?>view/js/qrcode.js"></script>
<script type="text/javascript">
var qrcodesave = new QRCode(document.getElementById("qrcodesave"), {
  width : 100,
  height : 100
});
var qrcodeupdate =null;
function makeCodesave () {    
  var elText = document.getElementById("textsave");
  if (!elText.value) {
    elText.focus();
    return;
  }
  qrcodesave.makeCode(elText.value);
}

function makeCodeupdate () {    
  var elText = document.getElementById("textupdate");
  if (!elText.value) {
    elText.focus();
    return;
  }  
  qrcodeupdate.makeCode(elText.value);
}

$("#textsave").
  on("blur", function () {
    makeCodesave();
  }).
  on("keydown", function (e) {
    if (e.keyCode == 13) {
      makeCodesave();
    }
  });

  $("#textupdate").
  on("blur", function () {
    makeCodeupdate();
  }).
  on("keydown", function (e) {
    if (e.keyCode == 13) {
      makeCodeupdate();
    }
  });

  function onGeneratesave(){
     makeCodesave();
  }
  function onGenerateupdate(){
     makeCodeupdate();
  }
</script>


          <?php } if($rutaact[0]=="perfil"){ ?>
<script type="text/javascript" src="<?php echo SERVERURL; ?>view/js/responiveperfil.js"></script>
        <?php } ?>


        <?php if($rutaact[0]=="home" ){ ?>
<script src="<?php echo SERVERURL; ?>view/assets/vendor/jquery-appear/jquery.appear.js"></script>
<script src="<?php echo SERVERURL; ?>view/assets/vendor/jquery-easypiechart/jquery.easypiechart.js"></script>
<script src="<?php echo SERVERURL; ?>view/assets/vendor/flot/jquery.flot.js"></script>
    <script src="<?php echo SERVERURL; ?>view/assets/vendor/flot-tooltip/jquery.flot.tooltip.js"></script>
    <script src="<?php echo SERVERURL; ?>view/assets/vendor/flot/jquery.flot.pie.js"></script>
    <script src="<?php echo SERVERURL; ?>view/assets/vendor/flot/jquery.flot.categories.js"></script>
    <script src="<?php echo SERVERURL; ?>view/assets/vendor/flot/jquery.flot.resize.js"></script>
<script >
  (function() {  
    var plot = $.plot('#flotBars', [flotBarsData], {
      colors: ['#8CC9E8'],
      series: {
        bars: {
          show: true,
          barWidth: 0.8,
          align: 'center'
        }
      },
      xaxis: {
        mode: 'categories',
        tickLength: 0
      },
      grid: {
        hoverable: true,
        clickable: true,
        borderColor: 'rgba(0,0,0,0.1)',
        borderWidth: 1,
        labelMargin: 15,
        backgroundColor: 'transparent'
      },
      tooltip: true,
      tooltipOpts: {
        content: '%y',
        shifts: {
          x: -10,
          y: 20
        },
        defaultTheme: false
      }
    });
  })();
</script>
<?php } if($rutaact[0]=="actividad" ){ ?>
<script type="text/javascript">
  $("#añoct").datepicker({
    format: "yyyy",
    viewMode: "years", 
    minViewMode: "years"
});
</script>
<?php }  if($rutaact[0]=="placas" ){?>
  <script type="text/javascript">
  $("#yearfsave").datepicker({
    format: "yyyy",
    viewMode: "years", 
    minViewMode: "years"
});
  $("#yearfupdate").datepicker({
    format: "yyyy",
    viewMode: "years", 
    minViewMode: "years"
});
</script>
<?php } ?>