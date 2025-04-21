/**CAMBIOS NOVILLO**/

function actualizarModelos(){

    var ajax = $("#ajax").val();
      var url = $("#url").val();
    var idMarcaVehiculo = $(".idVehicleBrand").val(); 
    
     $.get(url + "ajax/" + ajax + ".php", { evento: "ok",idMarcaVehiculo: idMarcaVehiculo}, function (respuesta) {
        $(".idVehicleModel").html(respuesta);
     });
}

$(document).ready(function() {
    var tipoEnvioSelect = $(".tipoEnvio");
    var idEmailSelect = $(".idEmail");

    function toggleEmailField() {
        if (tipoEnvioSelect.val() == 1) {
            idEmailSelect.prop("disabled", true);
        } else if (tipoEnvioSelect.val() == 2) { 
            idEmailSelect.prop("disabled", false);
        } else {
            idEmailSelect.prop("disabled", false);
        }
    }

    toggleEmailField();

    tipoEnvioSelect.on("change", function() {
        toggleEmailField();
    });
});




function actualizarProvincias() {
    var ajax = $("#ajax").val();
    var url = $("#url").val();
    var idDepa = $(".idDepa").val();

    $.get(url + "ajax/" + ajax + ".php", { evento: "ok", idDepa: idDepa }, function (respuesta) {
        $(".idProv").html(respuesta);
        $(".idDist").html("<option value=''>Select District</option>");
    });
}

function actualizarDistritos() {
    var ajax = $("#ajax").val();
    var url = $("#url").val();
    var idProv = $(".idProv").val();

    $.get(url + "ajax/" + ajax + ".php", { evento: "ok", idProv: idProv }, function (respuesta) {
        $(".idDist").html(respuesta);
    });
}

/**FIND E CAMBIOS NOVILLO**/

function addDetalleCargaExcel(datos,saveupdate){
    //console.log(datos);

    //PENDIENTE aaandres
var url=$("#url").val();
var ajax=$("#ajax").val();



/**alert(datos.departamento);
alert(datos.provincia);
alert(datos.distrito);**/
var tmercaderia=datos.tmercaderia;
var destinatario=datos.destinatario;
var provrigen=datos.origenProvincia;
var origen=datos.origenDistrito;
 var departorigen = datos.origenDepartamento;


var destino=datos.distrito;
var provdestino=datos.provincia;
var NGRR=datos.gremision;
var NFACT=datos.factura;
var NBV=datos.bv;
var NOE=datos.ordenEnvio;
var nCajas=datos.caja;
var nSobres=datos.sobre;
var pesoKg=datos.pesokg;
var PV=datos.pesoV;
var oc=datos.oc;
var dispositivo=datos.dispositivo;
var plazoEntrega=datos.plazoEntrega;



var  validercs=false;
if (nCajas!=""||nSobres!="") {
  validercs=true;
}
if (nCajas=="") {
  nCajas=0;
}
if (nSobres=="") {
  nSobres=0;
}

if (tmercaderia!="" && destinatario!="" && origen!="" && destino!="" && provrigen!="" && provdestino!="") {
  if (saveupdate=="save" || saveupdate=="update") {
  $(".detallecarga"+saveupdate).append('<tr id="trcargasave'+indexObjSolicitud+'"  ><td> #<span class="txttk'+indexObjSolicitud+'"></span> \
    <input type="hidden"  name="operation'+saveupdate+'" value="save">           \
     <input type="hidden"  name="idDetalleCarga'+saveupdate+'" value="0"> \
     <input type="hidden"  name="statuscarga'+saveupdate+'" value="1">\
        <input type="hidden"  name="token'+saveupdate+'" class="tkcaga'+indexObjSolicitud+'"> </td>\
    <td> <select name="idTypeMercaderia'+saveupdate+'"  class="inputtable idTypeMercaderia'+indexObjSolicitud+'"> </select>  \
    </td> <select name="idTypeMercaderia'+saveupdate+'"  class="inputtable idTypeMercaderia'+indexObjSolicitud+'"> </select> \
    <td><input type="text"  name="destinatario'+saveupdate+'" value="'+destinatario+'"  maxlength="50" class="inputtable"    onkeypress="return checkTotal(this,event);" required> \
    </td> \
 <td>  <select   class="inputtable provorigen-'+indexObjSolicitud+'" onchange="getDistritoTable(`'+"origen"+'`,'+indexObjSolicitud+')"> </select> </td>\
 <td>  <select  name="distritoorigen'+saveupdate+'" class="inputtable distorigen-'+indexObjSolicitud+'" required > </select>   </td> \
 <td>  <select   class="inputtable provdestino-'+indexObjSolicitud+'" onchange="getDistritoTable(`'+"destino"+'`,'+indexObjSolicitud+')"> </select> </td>\
  <td> <select  name="distritodestino'+saveupdate+'" class="inputtable distdestino-'+indexObjSolicitud+'" required> </select>  </td>\
  <td>  <input type="text" name="NGRR'+saveupdate+'" class="inputtable" maxlength="30"  value="'+NGRR+'"> \
       </td>\
       <td>  <input type="text" name="NFACT'+saveupdate+'" class="inputtable" maxlength="30"  value="'+NFACT+'" > \
       </td>\
     <td>  <input type="text" name="NBV'+saveupdate+'" class="inputtable"  value="'+NBV+'" maxlength="30" ></td>\
     <td> <input type="text" name="NOE'+saveupdate+'" class="inputtable" value="'+NOE+'" maxlength="30" ></td>      \
     <td> <input type="number" name="nCajas'+saveupdate+'" class="inputtable" min="0" max="9999999999"  value="'+nCajas+'"  data-maxlength="10" oninput="this.value=this.value.slice(0,this.dataset.maxlength)" ></td>   \
    <td> <input type="number" name="nSobres'+saveupdate+'" class="inputtable"  value="'+nSobres+'" min="0"   max="9999999999" data-maxlength="10" oninput="this.value=this.value.slice(0,this.dataset.maxlength)" >  \
</td>   <td>   <input type="number" name="pesoKg'+saveupdate+'" class="inputtable" step="any" value="'+pesoKg+'" min="1"  max="9999999999" data-maxlength="10" oninput="this.value=this.value.slice(0,this.dataset.maxlength)" ></td>\
<td>     <input type="number"  step="any" name="PV'+saveupdate+'" class="inputtable" value="'+PV+'"  max="9999999999" data-maxlength="10" oninput="this.value=this.value.slice(0,this.dataset.maxlength)" ></td> \
<td>     <input type="number"  step="any" name="oc'+saveupdate+'" class="inputtable" value="'+oc+'"  max="9999999999" data-maxlength="10" oninput="this.value=this.value.slice(0,this.dataset.maxlength)" ></td> \
<td>     <input type="text"   name="dispositivo'+saveupdate+'" class="inputtable" value="'+dispositivo+'"  >\
<td>     <input type="text"   name="plazoEntrega'+saveupdate+'" class="inputtable" value="'+plazoEntrega+'"  >\
</td>  \   <td><button type="button"  class="btn btn-danger  btn-sm " onclick="onDeleteCargaT1(`'+saveupdate+'`,'+indexObjSolicitud+')"><i class="fa  fa-trash fa-lg colorwhite"></i></button></td></tr>');
     var bandera=indexObjSolicitud;
    $.get(url+"ajax/"+ajax+".php", {tkdetalle:"yes",cmerc:tmercaderia,iddeporg:15,idprovorg:provrigen,iddepdest:15,idprovdest:provdestino,iddistrorg:origen,iddistrdest:destino}, function(respuesta){ 
var listadovf= JSON.parse(respuesta);

var tok=listadovf.token;
 $(".txttk"+bandera).text(tok);
  $(".tkcaga"+bandera).val(tok)
 var element=".idTypeMercaderia"+bandera; 

  $(element).html(listadovf.mercaderia);

  $(".provorigen-"+bandera).html(listadovf.provorig);
  $(".provdestino-"+bandera).html(listadovf.provdest);          
  $(".distorigen-"+bandera).html(listadovf.distorigen);
  $(".distdestino-"+bandera).html(listadovf.distdestino);
     });

  ccargaSolicitud++;
indexObjSolicitud++;
  }
//$(".tipodemercaderia").val("");
$(".NGRR").val("");
$(".NFACT").val("");
$(".NBV").val("");
$(".NOE").val("");
$(".nCajas").val("");
$(".nSobres").val("");
$(".pesoKg").val("");
$(".PV").val("");
$(".destinatario").val("");
$(".dispositivo").val("");
$(".plazoEntrega").val("");

}
else{
  new PNotify({
      title: 'Algo Salio Mal',
      text: 'Para añadir Complete los campos requeridos e intente nuevamente',
      type: 'error'
    });
}

}

 function importarExcel(idDepartamento,idProvincia,idDistrito,idSolicitudService,idClient){
    

    var url=$("#url").val();
var ajax=$("#ajax").val();

    var fileInput = document.getElementById('input-excel');
        var file = fileInput.files[0];
        if (file) {
            var reader = new FileReader();

            reader.onload = function(e) {
                var data = new Uint8Array(e.target.result);
                var workbook = XLSX.read(data, { type: 'array' });

                var firstSheetName = workbook.SheetNames[0];
                var worksheet = workbook.Sheets[firstSheetName];
                var jsonData = XLSX.utils.sheet_to_json(worksheet);
                //var paresArray = Object.entries(jsonData);

                var datos = [];

                var arrayTemporal=[
                    {"idTypeMercaderia":1,"name":"Medicamentos Refrigerados"},
                    {"idTypeMercaderia":2,"name":"Medicamentos no Refrigerados"},
                    {"idTypeMercaderia":3,"name":"Material Medico"},
                    {"idTypeMercaderia":4,"name":"Productos Sanitarios"},
                    {"idTypeMercaderia":5,"name":"Equipo Medico"},
                    {"idTypeMercaderia":6,"name":"Sobre con Documentos"},
                    {"idTypeMercaderia":7,"name":"Equipo Electronico"},
                    {"idTypeMercaderia":8,"name":"Otros"},

                    ];

               function obtenerIdPorNombre(nombreBuscado) {
                var resultado = $.grep(arrayTemporal, function(elemento) {
                    return elemento.name === nombreBuscado;
                });

                if (resultado.length > 0) {
                    return resultado[0].idTypeMercaderia;
                } else {
                    return null; // Devuelve null si no se encuentra
                }
            }

          
         var arrayClientes = [];
              $.get(url+"ajax/"+ajax+".php", {idClient22:idClient}, function(respuesta){ 
            var datosR= JSON.parse(respuesta);
                  
datosR.forEach((item) => {
  
    arrayClientes.push( item );  // Agregar los que cumplan la condición
  
});

function convertirFecha(excelDatee){
    // Número de fecha en formato Excel
var excelDate = excelDatee;

// Calcular la fecha basada en el 1 de enero de 1900
var dateOffset = new Date(1899, 11, 30); // Excel toma el 30 de diciembre de 1899 como base
var daysInMillis = excelDate * 24 * 60 * 60 * 1000; // Convertir días a milisegundos

// Sumar los milisegundos a la fecha base
var finalDate = new Date(dateOffset.getTime() + daysInMillis);

// Mostrar la fecha en un formato legible
return finalDate.toLocaleDateString(); // 9/9/2024
}



       jsonData.forEach(function(fila, index) {

 //console.log(fila.Destinatario);

var destinatarioBuscado = fila.Destinatario;
var cliente = arrayClientes.find(cliente => cliente.DESTINATARIO === destinatarioBuscado);


  datos.push({
                    item: fila.Item,
                    tmercaderia: obtenerIdPorNombre(fila["Tipo de Mercadería"]),
                    origenDepartamento: idDepartamento,
                    origenProvincia: idProvincia,
                    origenDistrito: idDistrito,
                    destinatario: fila.Destinatario,
                    departamento: cliente.IDDEPARTAMENTO,
                    provincia: cliente.IDPROVINCIA,
                    distrito: cliente.IDDISTRITO,
                    gremision: fila["Guia Remision"],
                    factura: fila.Factura,
                    bv: fila.BV,
                    caja: fila.Caja,
                    pesokg: fila.Pesokg,
                    pesoV: fila["Peso V."],
                    oc: fila.OC,
                    dispositivo: fila.Dispositivo,
                    plazoEntrega: convertirFecha(fila["Plazo de entrega"]),
                    sobre: fila.Sobre,
                    ordenEnvio:convertirFecha(fila["Orden de Envio"])
                });


      
    });


              

          $.each(datos, function(index, value) {
    
      addDetalleCargaExcel(datos[index],"save");
});




            });
           

           

               


              //    console.log(objetoVacio);

          

             

              
            };

            reader.readAsArrayBuffer(file);
        } else {
            alert("Por favor, selecciona un archivo Excel.");
        }
 }

function onAbrirArchivo(id,url,nombre){
    alert("esta abriendo el archivo "+nombre);
}
/**function resertUrl(){
    $(".idRuta").text("Mis Archivos/");
}**/

 
     function onAbrir(id,url,name){
          var statu = 1;
if($("#myonoffswitch").is(":checked")) {
     statu = 1;
}else{
    statu = 0;
}
        $(".idRuta").append(name+"/");
       var urlglobal=$("#url").val();
var ajax=$("#ajax").val();
    var view=$("#view").val();
  var busqueda={};
    busqueda.datatable="yes";
     busqueda.status=statu;
      busqueda.idCarpeta=id;
       busqueda.urlCarpeta=url;
       busqueda.nameCarpeta=name;

          tabladata2=$('#datatable-default').DataTable({
             "processing": true,
                "serverSide":true,
                 "destroy":true,
            "autoWidth": false,
        fixedColumns: true,
                  initComplete: function() {
                     $('.dataTables_filter input').unbind();
                     $('.dataTables_filter input').bind('keyup', function(e){
                         var code = e.keyCode || e.which;
                         if (code == 13) { 
                             tabladata2.search(this.value).draw();
                         }
                     });
                 },

                  "order": [[ 0, "desc" ]],
                "ajax":{
             url:urlglobal+"ajax/"+ajax+".php",
                    type:"post",
                    'data': busqueda
                }

            });
         $('.dataTables_filter input').addClass('form-control');
         $(".dataTables_filter input").attr("placeholder","Search");

     }      

function leerGmail(asunto,mensaje){
  /*   $.magnificPopup.open({
               items: {
                   src: '#modalCorreos'
               },
               type: 'inline',
                preloader: true,
                modal: true
           });
  $(".txtAsunto").text(asunto);
  $(".txtMensaje").text(mensaje);
*/
}



  selected = true;
function selectAll(all){
  //alert(all);
    if (selected) {
      $('#'+all+' input[type=checkbox]').prop("checked", true);
      //$('#BtnSeleccionar').val('Deseleccionar');
    } else {
      $('#'+all+' input[type=checkbox]').prop("checked", false);
     // $('#BtnSeleccionar').val('Seleccionar');
    }
    selected = !selected;
}


function selectAll2(all){
  //alert(all);
    if (selected) {
         $('.'+all+'').each(function(){
                $('.'+all+'').prop('checked', true);
            })
      //$('#'+all+' input[type=checkbox]').prop("checked", true);
      //$('#BtnSeleccionar').val('Deseleccionar');
    } else {
   $('.'+all+'').each(function(){
                $('.'+all+'').prop('checked', false);
            })


    //  $('#'+all+' input[type=checkbox]').prop("checked", false);
     // $('#BtnSeleccionar').val('Seleccionar');
    }
    selected = !selected;
}



  $('[data-plugin-selectpicker]').each(function() {
      if( /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent) ) {
  $(this).selectpicker();

}else{
      $(this).selectpicker();
}
      });

//variables Solictiud
var ccargaSolicitud=0;
var indexObjSolicitud=0;
var removeAdjuntosSegui=[];
//funcion maestra ver foto
function tableRoles(url,idCargo) {
    var tableDataAdj = { tableDataAdj: [] };
    $(".detalleRoles tr").each(function() {
        var obj = {};
        //obj.idModulo = $(":input[name=idModulo]", this).val();
         obj.add = $(":input[name=add]", this).is(":checked")+"-"+$(":input[name=idOperacionadd]", this).val();
         obj.update = $(":input[name=update]", this).is(":checked")+"-"+$(":input[name=idOperacionupdate]", this).val();;
         obj.delete = $(":input[name=delete]", this).is(":checked")+"-"+$(":input[name=idOperaciondelete]", this).val();;
         obj.generate = $(":input[name=generate]", this).is(":checked")+"-"+$(":input[name=idOperaciongenerate]", this).val();;
        obj.ver = $(":input[name=ver]", this).is(":checked")+"-"+$(":input[name=idOperacionver]", this).val();;
        tableDataAdj.tableDataAdj.push(obj);
      
    });

var stringTabla = JSON.stringify(tableDataAdj);
var btnModal=$(".modalform-Rolesconfirm");

btnModal.prop('disabled', true);
btnModal.text("Cargando...");
     $.get(url+"ajax/rolesAjax.php", {idCargo:idCargo,tabla:stringTabla}, function(respuesta){
              btnModal.prop('disabled', false);
              btnModal.text("Confirmar");
              $(".RespuestaAjax").html(respuesta);
              $.magnificPopup.close();
            });

}
function modalconfirmRoles(){
$("#idCargo").val(encry);
   $.magnificPopup.open({
               items: {
                   src: '#modalConfirmRoles'
               },
               type: 'inline',
                preloader: true,
                modal: true
           });

}
//funciones de generateRespaldo
function generateRespaldo(url) {

var btnModal=$(".modalCopyconfirm");

btnModal.prop('disabled', true);
btnModal.text("Cargando...");
     $.get(url+"ajax/backupAjax.php", {process:"yes"}, function(respuesta){
              btnModal.prop('disabled', false);
              btnModal.text("Confirmar");
             $(".RespuestaAjax").html(respuesta);
              $.magnificPopup.close();
            });

}
function removerfichero(url,fichero){
       $.get(url+"ajax/backupAjax.php", {destroy:"yes", fichadj:fichero}, function(respuesta){
           
            });
}

/////////

function vermodalCopy(){
   $.magnificPopup.open({
               items: {
                   src: '#modalConfirmCopy'
               },
               type: 'inline',
                preloader: true,
                modal: true
           });
}

var typemd="";
function verfoto(image,id,carpeta,modal,url){
  $('#'+id)[0].src =url+"assets/"+carpeta+"/"+image;
 $.magnificPopup.open({
               items: {
                   src: '#'+modal
               },
               type: 'inline',
                preloader: true,
                modal: true
          });
   $("#"+modal).addClass("modal-block-full");
}
//funcion agrergada 21/01
function ventanaSecundaria (URL){ 
   window.open(URL,"ventana1","width=550,height=600,scrollbars=NO") 
} 
function ventanaReport(URL){ 
 var mywindow =window.open(URL, "socialPopupWindow",
                "location=no,width=1200,height=600,scrollbars=yes,top=100,left=700,resizable = no");
   // mywindow.focus(); // necessary for IE >= 10
    mywindow.print();
 }

 function ventanaReport2(URL){ 
 var mywindow =window.open(URL, "socialPopupWindow",
                "location=no,width=1200,height=600,scrollbars=yes,top=100,left=700,resizable = no");
   // mywindow.focus(); // necessary for IE >= 10
    
 } 
//fin
function ventanaexcelsingle (URL){ 
   window.open(URL,'_blank'); 
} 


function cargaImg(input,saveUpdate){
    var view=$("#view").val();
    if(saveUpdate=="save"){ 
 if(input.files.length>0){
   $('.cargaIB1').val('1'); 
   if (view=="brand" ) {
   $('#img')[0].src = (window.URL ? URL : webkitURL).createObjectURL(input.files[0]);
   $('#galerrybox').attr("href", (window.URL ? URL : webkitURL).createObjectURL(input.files[0]));
 }
      } else{  
   
 if (view=="brand" ) {
$('.cargaIB1').val('0');  var urlglobal=$("#url").val();
       $('#galerrybox').attr("href",urlglobal+"view/assets/images/nuevo.png");
 $('#img')[0].src =urlglobal+"view/assets/images/nuevo.png";

 }


       }
}else{

  if(input.files.length>0){
 if (view=="brand" ) {

 $('#img2')[0].src = (window.URL ? URL : webkitURL).createObjectURL(input.files[0]);
}   
   $('.cargaIB2').val('1');  }  else{  $('.cargaIB2').val('0');
   var urlglobal2=$("#url").val();
 if (view=="brand" ) {

 $('#img2')[0].src =urlglobal2+"view/assets/images/nuevo.png";

}
 }
}
   
}
   function hidenCese(){
              
 var idTypePersonal= $(".idTypePersonal").val();
 if(idTypePersonal==1){
   $(".idHidenCese").hide();
   $(".fechaCese").val("");
 }else{
   $(".idHidenCese").show();
 }
}
 function rellEditPersonal(data,idDepa,idProv,idDistrito,lisprov,listdistr){
         var view=$("#view").val();
         if(view=="personal"){
$("#modalEditForm").addClass("modal-block-full");

         }
         var estadoC="";
         $.each(data, function( i, item ) {
          
           if(i=="estadoCivil"){
estadoC=item;
           }
        $("."+i).val(item);
                  $(".cargaIB1").val("0");
        var urlglobal=$("#url").val();
        if(i=="image"){
    // reel edit
       if (item!="imgdefauld.jpg") {
 $('#img2')[0].src =urlglobal+"assets/brand/"+item;
          }
          else{
 $('#img2')[0].src =urlglobal+"view/assets/images/nuevo.png";
          }
     
        }

         if (i=="idRol") {
          $('.idRol').select2('val',item);
         }
         if (i=="dni") {
          makeCodeupdate();
         }
         // makeCode();
        $('select[name='+i+']').val(item);

       });
    $(".idDistrito").html("");        $(".idProvincia").html("");
        $('select[name="idDepartamento"]').val(idDepa);
    $(".idDistrito").html(listdistr);        $(".idProvincia").html(lisprov);
   $('select[name="idProvincia"]').val(idProv);
  $('select[name="idDistrito"]').val(idDistrito);

           $.magnificPopup.open({
               items: {
                   src: '#modalEditForm'
               },
               type: 'inline',
                preloader: true,
                modal: true
           });

hidenCese();
inputbrevete('update');

if(estadoC==1){
  $("#optionsRadios2update").attr("checked",true);
   $("#optionsRadios1update").attr("checked",false);
}else{
  $("#optionsRadios1update").attr("checked",true);
  $("#optionsRadios2update").attr("checked",false);
}

$(".mfp-bg").addClass("capa1");
$(".mfp-wrap").addClass('capa2');
 

}

function inputbrevete(saveupdate){
  var cargo=$("#idCargo"+saveupdate).val();
  if (cargo==9) {
    $(".caja-brevete"+saveupdate).css('display', 'block-inline');
    $('#txtbrevete'+saveupdate).attr('required', 'required');
  }
  else{
        $(".caja-brevete"+saveupdate).css('display','none');
          $('#txtbrevete'+saveupdate).removeAttr('required');
  }
  console.log(cargo);
}


function rellEditRoles(url,idCargo,$names){
$("#modalEditForm").addClass("modal-block-lg");
        $.get(url+"ajax/rolesAjax.php", {idCargo:idCargo,paintForm:"paintForm",names:$names}, function(respuesta){
              $(".idFormRoles").html(respuesta);
            });
           $.magnificPopup.open({
               items: { src: '#modalEditForm' },
               type: 'inline',
                preloader: true,
                modal: true
           });
   $(".mfp-bg").addClass("capa1");
$(".mfp-wrap").addClass('capa2');        
}

  function rellEdit(data){

         var view=$("#view").val();
if(view=="personal" ||  view=="provider" ||  view=="client" ||  view=="product" ||  view=="placas"){
 $("#modalEditForm").addClass("modal-block-full");
}
          $.magnificPopup.open({
               items: {
                   src: '#modalEditForm'
               },
               type: 'inline',
                preloader: true,
                modal: true
           });

         $.each(data, function( i, item ) {
        $("."+i).val(item);
                  $(".cargaIB1").val("0");
        var urlglobal=$("#url").val();
        if(i=="image"){
    // reel edit
       if (item!="imgdefauld.jpg") {
 $('#img2')[0].src =urlglobal+"assets/brand/"+item;
          }
          else{
 $('#img2')[0].src =urlglobal+"view/assets/images/nuevo.png";
          }
     
        }

 if (i=="yearf") {
          $('#añofupdate').datepicker('setDate', item);
        }



         if(i=="documento"){
            if (item!="imgdefauld.jpg") {
             $(".viewPdf").html('<button type="button" class="mb-xs mt-xs mr-xs modal-basic btn btn-primary" onclick="ventanaSecundaria(`'+urlglobal+'assets/product/'+item+'`)">ver archivo</button>');
          }else{
            $(".viewPdf").html('<div class="alert alert-danger">\n\
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>\n\
                   <span>Este registro no cuenta con  Documento</span>\n\
                  </div>' );
          }
         }

         if (i=="idRol") {
          $('.idRol').select2('val',item);
         }
        $('select[name='+i+']').val(item);
 if(view=="product" && i=="idClient"){
    $('#selectupdate').val(item).trigger('change');
         }
       });
 if(view!="product"){

         $('#selectupdate').select2();
         $("#selectupdate").select2({ dropdownParent: "#modalEditForm" });
        $('select').select2({
            width: '100%'
        });
     }
if (view!="comunicacion") {
   $(".mfp-bg").addClass("capa1");
$(".mfp-wrap").addClass('capa2');
}
        
}

 

 function cargaImgLogo(input,saveUpdate){
    if(saveUpdate=="save"){
      if(input.files.length>0){
   $('#imgLogo1')[0].src = (window.URL ? URL : webkitURL).createObjectURL(input.files[0]);
   $('.cargaIB1').val('1');   } else{  $('.cargaIB1').val('0');}

}else{
        if(input.files.length>0){
 $('#imgLogo2')[0].src = (window.URL ? URL : webkitURL).createObjectURL(input.files[0]);
   $('.cargaIB2').val('1'); }  else{  $('.cargaIB2').val('0');}
}
}
//funcion modificada
function resetForm(){
 var urlglobal=$("#url").val();
   var view=$("#view").val();
   typemd="";
   if (view!="roles") {
  $('.formAjax')[0].reset();
  $('#formAjax2')[0].reset();
    $('.cargaIB1').val('0');     
    $('.cargaIB2').val('0');
if (view=="product") {
    $('#selectsave').val(0).trigger('change');
    $('#selectupdate').val(0).trigger('change');
}
if(view=="brand"){
 $('#img')[0].src =urlglobal+"view/assets/images/nuevo.png";
 $('#img2')[0].src =urlglobal+"view/assets/images/nuevo.png";
}
if(view=="provider" || view=="personal"){
 $(".cajaupdate").html("");
   $(".idProvincia").html("");
   $(".idDistrito").html("");
}

if (view=="client") {
  cdocumentS=0;cdocumentU=0;
 arrayadj=[];
 indexobject=0; ccontactS=0; indexobject2=0;
 elementdelete="";
 dRemove=[];
 $(".cajaupdate").html("");
 $(".detalleclientjsondelete").val("");
 $(".jsonDetalleClient").val("");
 $(".adjuntosDocupdate").html("");
$(".adjuntosDocsave").html("");
$(".contactsclientsave").html("");
$(".contactsclientupdate").html("");
}
 
 if (view=="manifiesto") {
   cdocumentS=0;cdocumentU=0;
 arrayadj=[];
 indexobject=0;
 elementdelete="";
 dRemove=[];
 $(".statusfase").val(0);
 $(".btnformMF").text("guardar");
 $(".adjuntosDocupdate").html("");
$(".adjuntosDocsave").html("");
$(".detallejsondelete").val("");
$(".jsonDetalleAdj").val("");
$(".jsonDetalleCarga").val("");
$(".validerCargasave").val("not");
$(".validerCargaupdate").val("not");
$(".detallemanifiestsave").html("");
 $(".chofsave").val("").trigger('change');
    $(".operadorsave").val("").trigger('change');
  $(".idCarriersave").val("").trigger('change');
    $(".idProvidersave").val("").trigger('change');
        $(".idplacasave").val("").trigger('change');
  $('#destinosave').val("").trigger('change');
    $('#origensave').val("").trigger('change');
$(".princiupdate").html("");
resetmodalidaMf();
}

if(view=="remision"){
    $('.productsavebusq').selectpicker('destroy');
    $('.productsavebusq').html("");
      $('.productsavebusq').selectpicker();
      $('.transportistasave').val("").trigger('change');
  $('.idplacasave').val("").trigger('change');
 $('.transportistaupdate').val("").trigger('change');
  $('.idplacaupdate').val("").trigger('change');
$(".detallecargasave").html("");
$(".detallecargaupdate").html("");
$(".validerbus").val(0);
$(".validercarga").val(0);
  $(".jsonDetalleCarga").val("");
  $('.idClientsave').val("").trigger('change');
  $('.idClientupdate').val("").trigger('change');
}

if(view=="remisiontransp"){
  $('.choferupdate').val("").trigger('change');
  $('.idplacaupdate').val("").trigger('change');
      $('.destinatario').selectpicker('destroy');
   $('.destinatario').html("");
   $('.destinatario').selectpicker();
$(".detallecargasave").html("");
 onsearchcarga(urlglobal,"remisiontranspAjax");
$(".detallecargaupdate").html("");
}

if (view=="remesa") {
  $(".detalleremesasave").html("");
  $(".princiupdate").html("");
  $(".jsonDetalleCarga").val("");
  $(".jsonDeleteCarga").val("");
  cproviderS=0;
indexObjSolicitud=0;
removeCarga=[];
rellSaveRemesa();



}


if(view=="provider"){
  cproviderS=0;
indexobject3=0;
getpasstypeprv("save");
getpasstypeprv("update");
$(".jsonDetalleProvider").val("");
$(".contactsprovidersave").html("");
$(".contactsproviderupdate").html("");
}
 ///modificaciones
if(view=="solicitud"){
 $(".idSolicitudService").val("");
  $(".idFaseTypeService").val("");
  $(".idFaseNext").val("");
  $(".status").val("");  
  $(".mockup-principal").show();
 $(".solicitudupdate").html("");
  $('#x').val(0).trigger('change');
  $(".idContactoClientesave").html("");
 $('#typeComunicacionsave').val(null).trigger('change');
    $('#idClientsave').val("").trigger('change');
$(".mockup-principalsave").html("");
$(".mockup-principalupdate").html("");
$(".mockup-principalupdateRecup").html("");
  $(".jsonDetalleCarga").val("");
  $(".jsonDeleteCarga").val("");
$(".btn-auxope").css("display","none");
$(".btn-i").css("display","none");
  cproviderS=0;
indexObjSolicitud=0;
removeCarga=[];
}

if (view=="dispatchorder") {
ResetFormSaveordenDespacho();
indexObjSolicitud=0;
 removeCarga=[];
$(".cajaupdate").html('');
$(".cajaprinci-saveform").html('');
}

if (view=="servicetracking") {
  $(".caja-saveform").html('');
  $(".caja-updateform").html('');
  removeAdjuntosSegui=[];
}
  
if(view=="indicadores"){
 $(".caja-updateform").html('');
}

   }
  
   }



 function onReloadList(ajax,pagina,tipo,url){
    var txtBusqueda = $(".inputBuscar").val();
    var statu = 1;
if($("#myonoffswitch").is(":checked")) {
     statu = 1;
}else{
    statu = 0;
}
    $(".paginado").css("display","none");
        $(".loading").html('<i class="fa fa-spinner fa-spin fa-2x fa-fw"></i>');
             $.get(url+"ajax/"+ajax+".php", {pag: pagina, reg:2,pri:tipo,cod:txtBusqueda,status:statu}, function(respuesta){
               $(".bd1").html(respuesta);
            })
        }


 function onReloadList5(ajax,pagina,tipo,url){
    var txtBusqueda = $(".inputBuscar").val();
  var statu = $(".statusorders").val();
    var fechaBusqueda = $("#dateorder").val();
    $(".paginado").css("display","none");
        $(".loading").html('<i class="fa fa-spinner fa-spin fa-2x fa-fw"></i>');
             $.get(url+"ajax/"+ajax+".php", {pag: pagina,fechadate: fechaBusqueda ,reg: 5,pri:tipo,cod:txtBusqueda,status:statu}, function(respuesta){
               $(".bd1").html(respuesta);
            })
        }        

  ///compienza VALIDACION VISTA

'use strict';

$(function() {

  $(".formAjax").validate({
  highlight: function( label ) {
      $(label).closest('.form-group').removeClass('has-success').addClass('has-error');
    },
    success: function( label ) {
      $(label).closest('.form-group').removeClass('has-error');
      label.remove();
    },
    errorPlacement: function( error, element ) {
      var placement = element.closest('.form-group');
      if (!placement.get(0)) {
        placement = element;
      }
      if (error.text() !== '') {
        placement.after(error);
      }

    },
    submitHandler: function(form) {
     //validacion inputs file
        var form2=$(".formAjax");
        var tipo=form2.attr('data-form');
        var ajax =form2.attr('data-ajax');
if(ajax=="manifiestoAjax"){
      

var verifDet=$(".validerCargasave").val();
if (verifDet=="yes") {
   vermodalForm(tipo); 
}
else{
    new PNotify({
      title: 'Algo Salio Mal',
      text: 'Sellecione otro origen o destino que contegan cargas',
      type: 'error'
    });
}

}
if(ajax=="dispatchorderAjax"){
var validercarga=$(".indexcargasave").val();
if (validercarga>0) {
     vermodalForm(tipo); 
} 
else{
    new PNotify({
      title: 'Algo Salio Mal',
      text: 'Falta Agregar cargas a la orden de despacho',
      type: 'error'
     });
}

}
if(ajax=="brandAjax"){  

        if(tipo=="save"){
             if($(".cargaIB1").val()=="1"){
               $(".mfp-bg").removeClass("capa1");
$(".mfp-wrap").removeClass('capa2');
       vermodalForm(tipo);
  }
        }
  }


if(ajax=="tarifaDetailAjax"){  
        if(tipo=="save"){
          var encry=$("#encrytarifa").val();
$(".idTarifa").val(encry);
               $(".mfp-bg").removeClass("capa1");
$(".mfp-wrap").removeClass('capa2');
       vermodalForm(tipo);
        }
  }
if (ajax=="remesaAjax") { 
        var statusf=$(".idFaseRemesa").val();
    if (statusf=="" || statusf==0 ||statusf==1 ) {
        if (ccargaSolicitud>=1) {
   vermodalForm(tipo); 
}
          
    }
}
if(ajax=="remisionAjax"){
    var valremision= $(".validercarga").val();
     if(valremision==1){
       vermodalForm(tipo);    
     }   
}


if(ajax!="brandAjax" && ajax!="manifiestoAjax" && ajax!="tarifaDetailAjax" && ajax!="remesaAjax" && ajax!="remisionAjax" && ajax!="dispatchorderAjax"){
 $(".mfp-bg").removeClass("capa1");
$(".mfp-wrap").removeClass('capa2');
  vermodalForm(tipo);
}
    }

  });
        //validacione modificacion

  $("#formAjax2").validate({
  highlight: function( label ) {
      $(label).closest('.form-group').removeClass('has-success').addClass('has-error');
    },
    success: function( label ) {
      $(label).closest('.form-group').removeClass('has-error');
      label.remove();
    },
    errorPlacement: function( error, element ) {
      var placement = element.closest('.form-group');
      if (!placement.get(0)) {
        placement = element;
      }
      if (error.text() !== '') {
        placement.after(error);
      }

    },
    submitHandler: function(form) {
        var form2=$("#formAjax2");
        var tipo=form2.attr('data-form');
        var ajax =form2.attr('data-ajax');
 $(".mfp-bg").removeClass("capa1");
$(".mfp-wrap").removeClass('capa2');
        //modificaciones
    if (ajax=="solicitudAjax") {
      var idFaseTypeService=$(".idFaseTypeService").val();
      var status=$(".statusfase").val();
if (status==0) {
   if(idFaseTypeService==3 || idFaseTypeService==8 || idFaseTypeService==12  || idFaseTypeService==15 || idFaseTypeService==19 || idFaseTypeService==22){    
  vermodalForm(tipo);
}
if (idFaseTypeService==4 || idFaseTypeService==9   || idFaseTypeService==16 ) {
  vermodalForm(tipo);
}
if (idFaseTypeService==5 || idFaseTypeService==10)    {
  if (ccargaSolicitud>=1) {
       var saveupdate=$(".jsontipo").val();
  var arrayCarga=tableDetalleCarga(saveupdate);
  $(".jsonDetalleCarga").val(arrayCarga);
  vermodalForm(tipo);
      }
}
if (idFaseTypeService==13 || idFaseTypeService==20 || idFaseTypeService==23) {
  if (ccargaSolicitud>=1) {
       var saveupdate=$(".jsontipo").val();
  var arrayCarga=tableDetalleCarga(saveupdate);
  $(".jsonDetalleCarga").val(arrayCarga);
  vermodalForm(tipo);

      }
 
}
if (idFaseTypeService==17) {
  if (ccargaSolicitud>=1) {
       var saveupdate=$(".jsontipo").val();
  var arrayCarga=tableDetalleCarga(saveupdate);
  $(".jsonDetalleCarga").val(arrayCarga);
  vermodalForm(tipo);
      }
}

if(idFaseTypeService==6 ){ 
 var saveupdate=$(".jsontipo").val();
  var arrayCarga=tableDetalleRadio(saveupdate);
  $(".jsonDetalleCarga").val(arrayCarga);
  vermodalForm(tipo);
}

if(idFaseTypeService==11|| idFaseTypeService==18|| idFaseTypeService==21 ||idFaseTypeService==14  || idFaseTypeService==24 || idFaseTypeService==7 || idFaseTypeService==25){ 
      vermodalForm(tipo);
}

}
if (status==1) {
 if(idFaseTypeService==3 || idFaseTypeService==8   || idFaseTypeService==15 ){    
  vermodalForm(tipo);

}
if (idFaseTypeService==21 && status==1) {
    vermodalForm(tipo);

}


if (idFaseTypeService==4 || idFaseTypeService==9)    {
if (ccargaSolicitud>=1) {
       var saveupdate=$(".jsontipo").val();
  var arrayCarga=tableDetalleCarga(saveupdate);
  $(".jsonDetalleCarga").val(arrayCarga);
  vermodalForm(tipo);

      }

}
if (idFaseTypeService==12 || idFaseTypeService==19 || idFaseTypeService==22) {
 if (ccargaSolicitud>=1) {
       var saveupdate=$(".jsontipo").val();
  var arrayCarga=tableDetalleCarga(saveupdate);
  $(".jsonDetalleCarga").val(arrayCarga);
  vermodalForm(tipo);

      }
}

if (idFaseTypeService==16) {
if (ccargaSolicitud>=1) {
       var saveupdate=$(".jsontipo").val();
  var arrayCarga=tableDetalleCarga(saveupdate);
  $(".jsonDetalleCarga").val(arrayCarga);
  vermodalForm(tipo);

      }

}
if(idFaseTypeService==5 ){ 
    var saveupdate=$(".jsontipo").val();
  var arrayCarga=tableDetalleRadio(saveupdate);
  $(".jsonDetalleCarga").val(arrayCarga);
  vermodalForm(tipo);
}

if(idFaseTypeService==10  || idFaseTypeService==17|| idFaseTypeService==20 ||idFaseTypeService==13  || idFaseTypeService==23 || idFaseTypeService==6 ){ 
      vermodalForm(tipo);

}


if ($('.idFaseNext').val()=="Limit") {
  var arrayCarga=tableDetalleRadio("update");
  $(".detallejs").val(arrayCarga);
  vermodalForm(tipo);
}



}

    }


 if(ajax=="manifiestoAjax"){
var passwordN=$(".validerCargaupdate").val();
if (passwordN=="yes") {
  var faseadj=$(".statusfase").val();
  if (faseadj!=4 && faseadj!=5) {
       vermodalForm(tipo); 

  }
  if (faseadj==4|| faseadj==5) {
    var isfase=$(".isfase").val();
    var isactual=$(".isactualfase").val();

if (faseadj==4 && isfase==1 && isactual==1|| faseadj==5&& isfase==0 && isactual==1) {
   if (cdocumentS>=1) {
             vermodalForm(tipo); 
    }
        if (cdocumentS==0) {
           $(".mfp-bg").addClass("capa1");
$(".mfp-wrap").addClass('capa2'); 
          new PNotify({
      title: 'Datos Incompletos',
      text: 'Por favor agregar Adjuntos',
      type: 'error'
    });
}
}
else{
         vermodalForm(tipo); 
}
  }
}
else{
    new PNotify({
      title: 'Algo Salio Mal',
      text: 'Sellecione otro origen o destino que contegan cargas',
      type: 'error'
    });
}

} 
if (ajax=="dispatchorderAjax") {
var statusf=$(".idfasedispatchorder").val();
if (statusf==1) {
var indexcarga=$(".indexcargaupdate").val();
if (indexcarga>0) {         vermodalForm(tipo); }
else{
    new PNotify({
      title: 'Algo Salio Mal',
      text: 'Falta Agegar el destalle',
      type: 'error'
    });
}
}else{
   vermodalForm(tipo);
}

}

if (ajax=="remesaAjax") { 
        var statusf=$(".idFaseRemesa").val();
    if (statusf=="" || statusf==0 ||statusf==1 ) {
        if (ccargaSolicitud>=1) {
   vermodalForm(tipo); 
}
   }
if (statusf!="" && statusf!=0 &&statusf!=1 ) {
      vermodalForm(tipo);    
}
}
if(ajax=="liquidacionesAjax"){
   var validatercargas= $(".validatorcargas").val();
if(validatercargas==1){
   vermodalForm(tipo); 
}
else{
    new PNotify({
      title: 'Algo Salio Mal',
      text: 'La Liquidacion no contiene cargas',
      type: 'error'
    });
}

}


if(ajax=="profileAjax"){
var passwordN=$("#NewPassword").val();
var passwordR=$("#NewPasswordRepeat").val();
if (passwordN==passwordR) {
   vermodalForm(tipo); 
}
else{
    new PNotify({
      title: 'Algo Salio Mal',
      text: 'La Contraseña Nueva No Coinciden',
      type: 'error'
    });
}

}
if(ajax!="profileAjax" && ajax!="solicitudAjax" && ajax!="manifiestoAjax"  && ajax!="remesaAjax" && ajax!="liquidacionesAjax" &&  ajax!="dispatchorderAjax"){
  vermodalForm(tipo);

}
    }

  });

 $(".formAjax3").validate({
  highlight: function( label ) {
      $(label).closest('.form-group').removeClass('has-success').addClass('has-error');
    },
    success: function( label ) {
      $(label).closest('.form-group').removeClass('has-error');
      label.remove();
    },
    errorPlacement: function( error, element ) {
      var placement = element.closest('.form-group');
      if (!placement.get(0)) {
        placement = element;
      }
      if (error.text() !== '') {
        placement.after(error);
      }

    },
    submitHandler: function(form) {
        var form2=$(".formAjax3");
        var tipo=form2.attr('data-form');
        var ajax =form2.attr('data-ajax');

 $(".mfp-bg").removeClass("capa1");
$(".mfp-wrap").removeClass('capa2');
        //modificaciones
if (ajax=="charguecontrolAjax") {
    vermodalFormLiqui(tipo);
}
    if (ajax=="solicitudAjax") {
      var idFaseTypeService=$(".idFaseTypeService").val();
      var status=$(".statusfase").val();
if (status==0) {
   if(idFaseTypeService==3 || idFaseTypeService==8 || idFaseTypeService==12  || idFaseTypeService==15 || idFaseTypeService==19 || idFaseTypeService==22){    
  vermodalForm(tipo);
}
if (idFaseTypeService==4 || idFaseTypeService==9   || idFaseTypeService==16 ) {
  vermodalForm(tipo);
}
if (idFaseTypeService==5 || idFaseTypeService==10)    {
  if (ccargaSolicitud>=1) {
       var saveupdate=$(".jsontipo").val();
  var arrayCarga=tableDetalleCarga(saveupdate);
  $(".jsonDetalleCarga").val(arrayCarga);
  vermodalForm(tipo);
      }
}
if (idFaseTypeService==13 || idFaseTypeService==20 || idFaseTypeService==23) {
  if (ccargaSolicitud>=1) {
       var saveupdate=$(".jsontipo").val();
  var arrayCarga=tableDetalleCarga(saveupdate);
  $(".jsonDetalleCarga").val(arrayCarga);
  vermodalForm(tipo);
      }
 
}
if (idFaseTypeService==17) {
  if (ccargaSolicitud>=1) {
       var saveupdate=$(".jsontipo").val();
  var arrayCarga=tableDetalleCarga(saveupdate);
  $(".jsonDetalleCarga").val(arrayCarga);
  vermodalForm(tipo);
      }
}

if(idFaseTypeService==6 ){ 
 var saveupdate=$(".jsontipo").val();
  var arrayCarga=tableDetalleRadio(saveupdate);
  $(".jsonDetalleCarga").val(arrayCarga);
  vermodalForm(tipo);
}

if(idFaseTypeService==11|| idFaseTypeService==18|| idFaseTypeService==21 ||idFaseTypeService==14  || idFaseTypeService==24 || idFaseTypeService==7){ 
      vermodalForm(tipo);
}

}
if (status==1) {
 if(idFaseTypeService==3 || idFaseTypeService==8   || idFaseTypeService==15 ){    
  vermodalForm(tipo);

}

if (idFaseTypeService==4 || idFaseTypeService==9)    {
if (ccargaSolicitud>=1) {
       var saveupdate=$(".jsontipo").val();
  var arrayCarga=tableDetalleCarga(saveupdate);
  $(".jsonDetalleCarga").val(arrayCarga);
  vermodalForm(tipo);

      }

}
if (idFaseTypeService==12 || idFaseTypeService==19 || idFaseTypeService==22) {
 if (ccargaSolicitud>=1) {
       var saveupdate=$(".jsontipo").val();
  var arrayCarga=tableDetalleCarga(saveupdate);
  $(".jsonDetalleCarga").val(arrayCarga);
  vermodalForm(tipo);
      }
}

if (idFaseTypeService==16) {
if (ccargaSolicitud>=1) {
       var saveupdate=$(".jsontipo").val();
  var arrayCarga=tableDetalleCarga(saveupdate);
  $(".jsonDetalleCarga").val(arrayCarga);
  vermodalForm(tipo);
      }

}
if(idFaseTypeService==5 ){ 
    var saveupdate=$(".jsontipo").val();
  var arrayCarga=tableDetalleRadio(saveupdate);
  $(".jsonDetalleCarga").val(arrayCarga);
  vermodalForm(tipo);;
}

if(idFaseTypeService==10  || idFaseTypeService==17|| idFaseTypeService==20 ||idFaseTypeService==13  || idFaseTypeService==23 || idFaseTypeService==6){ 
      vermodalForm(tipo);
}


}

    }


 if(ajax=="manifiestoAjax"){
var passwordN=$(".validerCargaupdate").val();
if (passwordN=="yes") {
   vermodalForm(tipo); 
}
else{
    new PNotify({
      title: 'Algo Salio Mal',
      text: 'Sellecione otro origen o destino que contegan cargas',
      type: 'error'
    });
}

}   
if(ajax=="profileAjax"){
var passwordN=$("#NewPassword").val();
var passwordR=$("#NewPasswordRepeat").val();
if (passwordN==passwordR) {
   vermodalForm(tipo); 
}
else{
    new PNotify({
      title: 'Algo Salio Mal',
      text: 'La Contraseña Nueva No Coinciden',
      type: 'error'
    });
}

}
if(ajax!="profileAjax" && ajax!="solicitudAjax" && ajax!="charguecontrolAjax"){
  vermodalForm(tipo);
}

    }

  });



function vermodalForm(tipo){
  $("#selectform").val(tipo);
   $.magnificPopup.open({
               items: {
                   src: '#modalHeaderColorPrimary'
               },
               type: 'inline',
                preloader: true,
                modal: true
           });
}
    /*
  Modal Dismiss
  */
   $(document).on('click', '.modalform-confirmRolesdismiss', function (e) {
    e.preventDefault();
    $.magnificPopup.close();
 });

  $(document).on('click', '.modalform-Rolesconfirm', function (e) {
    e.preventDefault();
    var cargo=$("#idCargo").val();
 var urlglobal=$("#url").val();
tableRoles(urlglobal,cargo);    
    });

/// modalCopyconfirm
  $(document).on('click', '.modalCopyconfirm', function (e) {
    e.preventDefault();
 var urlglobal=$("#url").val();
generateRespaldo(urlglobal); //funcion nueva
    });

  $(document).on('click', '.modal-dismiss', function (e) {
    e.preventDefault();
    $.magnificPopup.close();
  });
  $(document).on('click', '.modalform-dismiss', function (e) {
    e.preventDefault();
    $.magnificPopup.close();
        var tipo=$("#selectform").val();
if (tipo=="update") {
      resetForm();
}
 });

 $(document).on('click', '.modalform-confirm', function (e) {
    e.preventDefault();
    var tipo=$("#selectform").val();
DatosFormulario(e,tipo);
      
    });
$(document).on('click', '.activatedesactivar-modal', function (e) {
    e.preventDefault();
     var ajax =$("#ajaxElemento").val();
if (ajax!="tarifaDetailAjax") {
 onActivaDeleteDataTable();   
}
if (ajax=="tarifaDetailAjax") {
onActivaDeleteDataTableaTarifa();
}
    });

  function onActivaDeleteDataTable(){
    var idElemento=$("#idElemento").val();
  var statu=$("#statuElemento").val();
 var ajax =$("#ajaxElemento").val();
  var url=$("#urlElemento").val();

$(".loadGuardado").html('<i class="zmdi zmdi-spinner  zmdi-hc-spin"></i>');
    $.get(url+"ajax/"+ajax+".php", {id:idElemento,btnActivaEliminar:"btnActivaEliminar",status:statu}, function(respuesta){
                $.magnificPopup.close();
    $("#idElemento").val("");
  $("#statuElemento").val("");
$("#ajaxElemento").val("");
  $("#urlElemento").val("");
               $(".RespuestaAjax").html(respuesta);
               $(".loadGuardado").html('');
   tabladata.ajax.reload(null, false);
      });


  }

    function onActivaDeleteDataTableaTarifa(){
    var idElemento=$("#idElemento").val();
  var statu=$("#statuElemento").val();
 var ajax =$("#ajaxElemento").val();
  var url=$("#urlElemento").val();
  var type=$("#typElemento").val();
$(".loadGuardado").html('<i class="fa fa-spinner fa-spin"></i>');
$.get(url+"ajax/"+ajax+".php", {id:idElemento,typetarifa:type,btnActivaEliminar:"btnActivaEliminar",status:statu}, function(respuesta){
                $.magnificPopup.close();
    $("#idElemento").val("");
  $("#statuElemento").val("");
$("#ajaxElemento").val("");
  $("#urlElemento").val("");
  $("#typElemento").val("");
               $(".RespuestaAjax").html(respuesta);
               $(".loadGuardado").html('');
if (type==1) {
  tabladata.ajax.reload(null, false);
}
if (type==2) {
  tabladata2.ajax.reload(null, false);
}
            });


  }

  function DatosFormulario(e,tipo){
    e.preventDefault();
        var keepAliveTimeout = 1000 * 10;
var element="";


if (tipo=="save") {element=".formAjax";}
if (tipo=="update") {element="#formAjax2";}
if (tipo=="updateSolicitud") { element=".formAjax3";   }
        var form=$(element);
        var tipo=form.attr('data-form');
        var ajax = form.attr('data-ajax');
        var accion=form.attr('action');
        var metodo=form.attr('method');
        var urlhttp = form.attr('data-urlhttp');
        var respuesta=$('.RespuestaAjax');
        var msjError="<script>new PNotify({\n\
      title: 'Regular Notice',\n\
      text: 'Check me out! I\'m a notice.',\n\
      type: 'error'\n\
    }); </script>";
          if (ajax=="clientAjax") { 
       var array1=tableAdjuntos(tipo);
      $(".jsonDetalleAdj").val(array1);
            var array2=tableClient(tipo);
      $(".jsonDetalleClient").val(array2);
    }
  if (ajax=="manifiestoAjax") { 
        var statusf=$(".statusfase").val();
    if (statusf==0 || statusf==1 || statusf==2) {
           var array2=tableDetalleMaanifest(tipo);
      $(".jsonDetalleCarga").val(array2);
    }
    if (statusf==4 || statusf==5)  {  //ahora en Registro de Dcumento de despacho    
 var array1=tableManifestAdjuntos(tipo);
 $(".jsonDetalleAdj").val(array1);  
}

}
if (ajax=="remesaAjax") { 
        var statusf=$(".idFaseRemesa").val();
    if (statusf==0 ||statusf==1 || statusf==2) {
      var array2=tableDetalleRemesa(tipo);
      $(".jsonDetalleCarga").val(array2);
    }
if (statusf==4 || statusf==5) {
  var array2 =tableDetalleOBSRemesa(tipo);
  $(".jsonDetalleCarga").val(array2);
}

}

if(ajax=="liquidacionesAjax"){
    var array2=tableDetalleLiquidacion(tipo);
      $(".jsonDetalleCarga").val(array2);
}

if (ajax=="remisionAjax") {
  var arrremision=tableDetalleRemision(tipo);
  $(".jsonDetalleCarga").val(arrremision);
}

if (ajax=="remisiontranspAjax") {
 var arrremisiontransp=tableDetalleRemisiontransp(tipo);
  $(".jsonDetalleCarga").val(arrremisiontransp);

}

    
    if (ajax=="providerAjax") {
     var arraprov=tableProvider(tipo);
    $(".jsonDetalleProvider").val(arraprov);
    }
    //nuevo
var btnModal=$(".modalform-confirm");

btnModal.prop('disabled', true);
btnModal.text("Cargando...");
    var form2=$(element)[0];
    var formdata = new FormData(form2);
       var pag=$('.pageact').val();
    var textoAlerta;
          if (ajax=="clientAjax") {
var cantempArradj=0;
     for (var i = 0; i < arrayadj.length; i++) {
     cantempArradj=i;
     formdata.append('input'+i,arrayadj[i]);     
     }
     cantempArradj=cantempArradj+1;
     formdata.append('cantAdj',cantempArradj);     
     formdata.append('indexDoc',cdocumentS);     
     formdata.append('indexcontact',ccontactS);     
}

if (ajax=="manifiestoAjax") {
   var statusf=$(".statusfase").val();
    if (statusf==4 || statusf==5)  {     
var cantempArradj=0;
     for (var i = 0; i < arrayadj.length; i++) {
     cantempArradj=i;
     formdata.append('input'+i,arrayadj[i]);     
     }
    cantempArradj=cantempArradj+1;
     formdata.append('cantAdj',cantempArradj);     
     formdata.append('indexDoc',cdocumentS);  
    }
   
}
if (ajax=="providerAjax") {
    formdata.append('indexCprov',cproviderS); }
    
        if(tipo==="save"){
             if($(".cargaIB1").val()=="1"){
        var files = $('.imgClass1')[0].files[0];
        formdata.append('file',files);     
        }
      textoAlerta="Los datos que enviaras quedaran almacenados en el sistema";
        }else if(tipo==="delete"){
      textoAlerta="Los datos serán eliminados completamente del sistema";
        }else if(tipo==="update"){
                   if($(".cargaIB2").val()=="1"){
        var files = $('.imgClass2')[0].files[0];
        formdata.append('file',files);     
        }
      textoAlerta="Los datos del sistema serán actualizados";
        }else{
            textoAlerta="Quieres realizar la operación solicitada";
        }  
$.ajax({
                type: metodo,
                url: accion,
                data: formdata ? formdata : form.serialize(),
                cache: false,
                contentType: false,
                processData: false,
                xhr: function(){
                    $(".loadGuardado").html('<i class="fa fa-spinner fa-spin fa-2x fa-fw"></i>');
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress", function(evt) {
                      if (evt.lengthComputable) {
                        var percentComplete = evt.loaded / evt.total;
                        percentComplete = parseInt(percentComplete * 100);
                        if(percentComplete<100){
    respuesta.html('<p class="text-center">Procesado... ('+percentComplete+'%)</p><div class="progress progress-striped active"><div class="progress-bar progress-bar-info" style="width: '+percentComplete+'%;"></div></div>');
                        }else{
                   respuesta.html('<p class="text-center"></p>');
                        }
                      }
                    }, false);
                    return xhr;
                },
                success: function (data) {
             btnModal.prop('disabled', false);
              btnModal.text("Confirmar");
                    $(".loadGuardado").html("");
                    respuesta.html(data);
                    $.magnificPopup.close();     
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
     if (XMLHttpRequest.readyState == 4) {
                    respuesta.html(msjError);
            // HTTP error (can be checked by XMLHttpRequest.status and XMLHttpRequest.statusText)
        }
        else if (XMLHttpRequest.readyState == 0) {
          var mserrointernet="  <script>$('.mfp-bg').css('z-index', '900');   \n\
        new PNotify({\n\
      title: 'Algo Salio Mal',\n\
      text: 'Conexion de internet fallida.Por favor intente nuevamente',\n\
      type: 'error'\n\
    });\n\
        </script>";
        $("body").append(mserrointernet);     
            // Network error (i.e. connection refused, access denied due to CORS, etc.)
        }
        else {
       respuesta.html(msjError);
            // something weird is happening
        }
                }
            });

  }



});

    /**INICIO AJAX**/

    /**fin del ajax**/
        /**FIN MODAL**/    
       
 $(document).ready(function() {


 if (view!="category"&&view!="home"&&view!="perfil" &&view!="search" 
  && view !="servicetracking" && view!="registerbd" && view!="indicadores" ) {
 listarDatable();
 }



if (view=="servicetracking") {
  if($('#isnivel').val()==2) {
    listarDatable();
  }
}

if (view=="registerbd") {
  if($('#isnivel').val()==2) {
    listarDatable();
  }
}
if (view=="charguecontrol") {
    if ($("#isnivel").val()==2 || $("#isnivel").val()==3) {
//  if ($("#isnivel").val()==2 ) {
  //  listarDatable();
  }
}

if (view=="indicadores") {
  if($('#isnivel').val()==2) {
    listarDatable();
  }
}



 });





var listarDatable=function (){

var urlglobal=$("#url").val();
var ajax=$("#ajax").val();
    var view=$("#view").val();
var urlSae="";
     var busqueda={};
if (view!="servicetracking" && view!="registerbd" && view!="indicadores") {
   var statu = 1;
if($("#myonoffswitch").is(":checked")) {
     statu = 1;
}else{
    statu = 0;
}
       busqueda.status=statu ;
}
  busqueda.datatable="yes";
if(view=="sae"){
var sae= $(".idRuta").text();
urlSae = sae;
busqueda.urlSae=urlSae; 
}
 
 if (view=="personal") {
    var typepers=$(".idTypePersonalFiltro").val();
   var fechab1=$("#fechab1").val();
          var fechab2=$("#fechab2").val();
      busqueda.tipopers=typepers; 
      busqueda.fecha1=fechab1;    
      busqueda.fecha2=fechab2;    
 }
if (view =="provider") {
  var fechab1=$("#fechab1").val();
          var fechab2=$("#fechab2").val();
      busqueda.fecha1=fechab1;    
      busqueda.fecha2=fechab2;  
}
if (view =="client") {
  var fechab1=$("#fechab1").val();
          var fechab2=$("#fechab2").val();
      busqueda.fecha1=fechab1;    
      busqueda.fecha2=fechab2;  
}
if (view =="manifiesto" || view =="remesa") {
  var fechab1=$("#fechab1").val();
          var fechab2=$("#fechab2").val();
      busqueda.fecha1=fechab1;    
      busqueda.fecha2=fechab2;  
}

if (view =="product"|| view=="remision" || view=="remisiontransp" || view=="shipmenttraking") {
  var fechab1=$("#fechab1").val();
          var fechab2=$("#fechab2").val();
            var client =$('select[name="labbusq"]').val();
      busqueda.fecha1=fechab1;    
      busqueda.fecha2=fechab2;  
      busqueda.lab=client;
}

if (view =="entradasalidas") {
  var fechab1=$("#fechab1").val();
          var fechab2=$("#fechab2").val();
            var client =$('select[name="labbusq"]').val();
      busqueda.fecha1=fechab1;    
      busqueda.fecha2=fechab2;  
      busqueda.lab=client;
}

if (view=="tarifadetail") {
  var ta=1;
  var encrytf=$("#encrytarifa").val();
  busqueda.tarifabus=encrytf;
  busqueda.typebus=ta;
}
if (view=="solicitud") {
  var busqprioridad=$(".busqprioridad").val();
            var client =$('select[name="labbusq"]').val();
      busqueda.busqprioridad=busqprioridad;    
      busqueda.lab=client;
}

if (view=="remesa") {
  var isnevel=$("#isnivel").val();
  busqueda.isnivel=isnevel;


}

if (view=="servicetracking") {
var isservice=$("#isnivel").val();
busqueda.isservice=isservice;
 busqueda.status=1 ;
  var fechab1=$("#fechasbd1").val();
  var fechab2=$("#fechasbd2").val();
busqueda.fecha1=fechab1;
busqueda.fecha2=fechab2;
  var destino =$('select[name="provbusq"]').val();
busqueda.idprov=destino;
}

if (view=="registerbd") {
var isservice=$("#isnivel").val();
busqueda.isservice=isservice;
       busqueda.status=1 ;
    var fechab1=$("#fechasbd1").val();
          var fechab2=$("#fechasbd2").val();
busqueda.fecha1=fechab1;
busqueda.fecha2=fechab2;

var typeserv=$("select#servbusq").val();
var destinity=$("select#destinobusq").val();
busqueda.idTypeService=typeserv;
busqueda.destino=destinity;
}


if (view =="dispatchorder") {
  var fechab1=$("#fechab1").val();
          var fechab2=$("#fechab2").val();
        //    var client =$('select[name="labbusq"]').val();
      busqueda.fecha1=fechab1;    
      busqueda.fecha2=fechab2;  
     // busqueda.lab=client;
}
if (view=="charguecontrol") {
  busqueda.isnivellist=$('#isnivel').val();
    if($('#isnivel').val()==1) {
var typeserv=$("select#servbusq1").val();
busqueda.idTypeService=typeserv;
}
if($('#isnivel').val()==2 || $('#isnivel').val()==3) {
 var fechab1=$("#fechasbd1").val();
 var fechab2=$("#fechasbd2").val();
      busqueda.fecha1=fechab1;    
      busqueda.fecha2=fechab2;  
}

}
if (view=="indicadores") {

  busqueda.isnivellist=$('#isnivel').val();
    if($('#isnivel').val()==1) {
var typeserv=$("select#servbusq1").val();
busqueda.idTypeService=typeserv;
}
if($('#isnivel').val()==2 || $('#isnivel').val()==3) {
        busqueda.status=1;
  var prov =$('select[name="provbusq"]').val();
 var fechab1=$("#fechasbd1").val();
 var fechab2=$("#fechasbd2").val();
      busqueda.fecha1=fechab1;    
      busqueda.fecha2=fechab2;  
      busqueda.idprov=prov;
}

if($('#isnivel').val()==4){
var fechab1=$("#fechasbd1").val();
 var fechab2=$("#fechasbd2").val();
      busqueda.fecha1=fechab1;    
      busqueda.fecha2=fechab2;  
      
}

}
 var num=10;
 if(view=="sae"){
num=50;
 }

      tabladata=$('#datatable-default').DataTable({
       
             "processing": true,
                "serverSide":true,
                 "destroy":true,
            "autoWidth": false,
            "pageLength": num,
        fixedColumns: true,
                  initComplete: function() {
                     $('.dataTables_filter input').unbind();
                     $('.dataTables_filter input').bind('keyup', function(e){
                         var code = e.keyCode || e.which;
                         if (code == 13) { 
                             tabladata.search(this.value).draw();
                         }
                     });
                 },
               

                  "order": [[ 0, "desc" ]],
                "ajax":{
             url:urlglobal+"ajax/"+ajax+".php",
                    type:"post",
                    'data': busqueda
                },
                       "createdRow": function(row, data, dataIndex) {
                       
    if (view == "solicitud") {

      var stylo=data[0];
      stylo=stylo.split("+");
    $(row).css("background",stylo[1]);
    }

  }
     });

         $('.dataTables_filter input').addClass('form-control');
         $(".dataTables_filter input").attr("placeholder","Search");

  }

var listarDatable2=function (){

var urlglobal=$("#url").val();
var ajax=$("#ajax").val();
    var view=$("#view").val();
     var busqueda={};

    var statu = 1;
if($("#myonoffswitch2").is(":checked")) {
     statu = 1;
}else{
    statu = 0;
}
    busqueda.datatable="yes";
     busqueda.status=statu ;



if (view=="tarifadetail") {
  var ta=2;
  var encrytf=$("#encrytarifa").val();
  busqueda.tarifabus=encrytf;
  busqueda.typebus=ta;
}



         tabladata2=$('#datatable-default2').DataTable({
             "processing": true,
                "serverSide":true,
                 "destroy":true,
            "autoWidth": false,
        fixedColumns: true,
                  initComplete: function() {
                     $('.dataTables_filter input').unbind();
                     $('.dataTables_filter input').bind('keyup', function(e){
                         var code = e.keyCode || e.which;
                         if (code == 13) { 
                             tabladata2.search(this.value).draw();
                         }
                     });
                 },

                  "order": [[ 0, "desc" ]],
                "ajax":{
             url:urlglobal+"ajax/"+ajax+".php",
                    type:"post",
                    'data': busqueda
                }

            });
         $('.dataTables_filter input').addClass('form-control');
         $(".dataTables_filter input").attr("placeholder","Search");

  }

var listarDatablehistory=function (){
var urlglobal=$("#url").val();
var ajax=$("#ajax").val();
    var view=$("#view").val();
     var busqueda={};

    var statu = 1;
if($("#myonoffswitch").is(":checked")) {
     statu = 1;
}else{
    statu = 0;
}
    busqueda.datatablehistory="yes";
     busqueda.status=statu ;


         tabladatahistory=$('#datatable-default2').DataTable({
             "processing": true,
                "serverSide":true,
                 "destroy":true,
            "autoWidth": false,
        fixedColumns: true,
                  initComplete: function() {
                     $('.dataTables_filter input').unbind();
                     $('.dataTables_filter input').bind('keyup', function(e){
                         var code = e.keyCode || e.which;
                         if (code == 13) { 
                             tabladatahistory.search(this.value).draw();
                         }
                     });
                 },

                  "order": [[ 0, "desc" ]],
                "ajax":{
             url:urlglobal+"ajax/"+ajax+".php",
                    type:"post",
                    'data': busqueda
                }

            });
         $('.dataTables_filter input').addClass('form-control');
         $(".dataTables_filter input").attr("placeholder","Search");

  }







function getProvincia(ajax,url){
  $(".idDistrito").html("");
var idDepartamento=$(".idDepartamento").val();
  //idDepartamento
   $.get(url+"ajax/"+ajax+".php", {idDepartamento:idDepartamento,changeDepartamento:"changeDepartamento"}, function(respuesta){
               $(".idProvincia").html(respuesta);
                              
     });
}

function getDistrito(ajax,url){
var idProvincia=$(".idProvincia").val();
  //idDepartamento
   $.get(url+"ajax/"+ajax+".php", {idProvincia:idProvincia,changeProvincia:"changeProvincia"}, function(respuesta){
               $(".idDistrito").html(respuesta);
                              
     });
}


//var dato =$(".dataTables_filter input").val(); console.log(dato);

function modalOnActivaDeleteDataTable(ajax,idElemento,statuElemento,url){

  $("#idElemento").val(idElemento);
  $("#statuElemento").val(statuElemento);
  $("#ajaxElemento").val(ajax);
  $("#urlElemento").val(url);
if (statuElemento==1) {
$(".msgActivateDeleted").text("Los datos serán inhabilitados del sistema");
}
else{
$(".msgActivateDeleted").text("Los datos serán habilitados del sistema");
}
   $.magnificPopup.open({
               items: {src: '#modalIcon'},
               type: 'inline',
                preloader: true,
                modal: true
           });
}


function checkTotal(input,e) {
    tecla = (document.all) ? e.keyCode : e.which;

 //Tecla de retroceso para borrar, siempre la permite
    if (tecla == 8) {
        return true;
    }
    // Patron de entrada, en este caso solo acepta numeros y letras
      if ($(input).val().length>0) {  patron = /^([A-Za-záéíóúÁÉÍÓÚñÑ0-9-,\s])/;
    }
else{     patron = /^[A-Za-záéíóúÁÉÍÓÚñÑ0-9]/;}
    tecla_final = String.fromCharCode(tecla); 
    return patron.test(tecla_final);
}
///nuevo validator placa
function checkPlaca(input,e) {
    tecla = (document.all) ? e.keyCode : e.which;

 //Tecla de retroceso para borrar, siempre la permite
    if (tecla == 8) {
        return true;
    }
    // Patron de entrada, en este caso solo acepta numeros y letras
      if ($(input).val().length>0) {  patron = /^([A-Za-záéíóúÁÉÍÓÚñÑ0-9-\s])/;
    }
else{     patron = /^[A-Za-záéíóúÁÉÍÓÚñÑ0-9-]/;}
    tecla_final = String.fromCharCode(tecla); 
    return patron.test(tecla_final);
}
///nuevo validator serie&number
///nuevo validator serie&number
function checkSerie(input,e) {
    tecla = (document.all) ? e.keyCode : e.which;

 //Tecla de retroceso para borrar, siempre la permite
    if (tecla == 8) {
        return true;
    }
    // Patron de entrada, en este caso solo acepta numeros y letras
      if ($(input).val().length>0) {  patron = /^([0-9-])/;
    }
else{     patron = /^[0-9-]/;}
    tecla_final = String.fromCharCode(tecla); 
    return patron.test(tecla_final);
}

function checkpassword(input,e) {
    tecla = (document.all) ? e.keyCode : e.which;
 //Tecla de retroceso para borrar, siempre la permite
    if (tecla == 8) {
        return true;
    }
       patron = /^[A-Za-záéíóúÁÉÍÓÚñÑ0-9]/;

    tecla_final = String.fromCharCode(tecla); 
    return patron.test(tecla_final);
}

function checkText(input,e) {
    tecla = (document.all) ? e.keyCode : e.which;
    //Tecla de retroceso para borrar, siempre la permite
    if (tecla == 8) {
        return true;
    }
    // Patron de entrada, en este caso solo acepta numeros y letras
        // Patron de entrada, en este caso solo acepta numeros y letras
      if ($(input).val().length>0) {  patron = /^([A-Za-záéíóúÁÉÍÓÚñÑ\s])/;
    }
else{     patron = /^[A-Za-záéíóúÁÉÍÓÚñÑ]/;}
    tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final);
}

function validaNumericos(event) {
    if(event.charCode >= 48 && event.charCode <= 57){
      return true;
     }
     return false;        
}
function modalconfirmRoles(encry){
$("#idCargo").val(encry);
   $.magnificPopup.open({
               items: {
                   src: '#modalConfirmRoles'
               },
               type: 'inline',
                preloader: true,
                modal: true
           });
}

///client
/// variables client
var cdocumentS=0,cdocumentU=0;
var arrayadj=[];
var arrobject={};
var indexobject=0;
var indexobject2=0;
var elementdelete="";
var ccontactS=0; 
var cproviderS=0;
var indexobject3=0;
///funciones adjuntos
function addAdjuntos(saveUpdate){
      var saveupdate=saveUpdate.trim();
  var verific=$('.imgClass1').val();
  var tituloadj=$('.document').val();
  var expiradj=$('.expirate').val();
var validerarch=true;
  if (verific!="" && tituloadj!="" && expiradj!="") {
var dateParts = expiradj.split("/");
var fecha= dateParts[2]+"-"+dateParts[0]+"-"+dateParts[1];

 var filesadj = $('.imgClass1')[0].files[0];
              for (var i = 0; i < arrayadj.length; i++) {
             var nombrearchivo=filesadj.name;
            if (arrayadj[i].name==nombrearchivo) {    validerarch=false;     }  }                
              arrayadj[cdocumentU]=$('.imgClass1')[0].files[0];
            var typedileadj=filesadj.type;
           var fichadj=filesadj.name;
          if (validerarch) {
                    if (saveupdate=="save") {
  $(".adjuntosDoc"+saveupdate).append('<tr id="tradjsave'+indexobject+'"  ><td>#<input type="hidden"  name="operation'+saveupdate+'" value="save"><input type="hidden"  name="idadj'+saveupdate+'" value="0"></td><td><input type="text" class="form-control" name="tile'+saveupdate+'" value="'+tituloadj+'" maxlength="80"   onkeypress="return checkTotal(this,event)" required></td> <td><input type="date" class="form-control" name="expira'+saveupdate+'" value="'+fecha+'" required></td>  <td> '+fichadj+' </td> <td><button type="button" href="#!" class="btn btn-danger  btn-sm " onclick="onDeleteAdj(`'+saveupdate+'`,'+indexobject+',`'+fichadj+'`)"><i class="fa  fa-trash-o fa-lg colorwhite"></i></button></td></tr>');
  cdocumentS++;
  indexobject++;
  cdocumentU=cdocumentU+1;
  }
if (saveupdate=="update") {
    $(".adjuntosDoc"+saveupdate).append('<tr id="tradjupdate'+indexobject+'"  ><td>#<input type="hidden"  name="operation'+saveupdate+'" value="save"><input type="hidden"  name="idadj'+saveupdate+'" value="0"></td><td><input type="text" class="form-control" name="tile'+saveupdate+'" value="'+tituloadj+'" maxlength="80"   onkeypress="return checkTotal(this,event)" required></td> <td><input type="date"  class="form-control" name="expira'+saveupdate+'" value="'+fecha+'" required></td>  <td> '+fichadj+' </td> <td><button type="button" href="#!" class="btn btn-danger  btn-sm " onclick="onDeleteAdj(`'+saveupdate+'`,'+indexobject+',`'+fichadj+'`)"><i class="fa  fa-trash-o fa-lg colorwhite"></i></button></td></tr>');
  cdocumentS++;
    indexobject++;
      cdocumentU=cdocumentU+1;
}

   $('.imgClass1').val("");
$('.document').val("");
 $('.expirate').val("");
          }
  } 
else{
  new PNotify({
      title: 'Algo Salio Mal',
      text: 'El archivo ya existe en el sistema, por favor registre con otro archivo',
      type: 'error'
    });
}
  
}
function addContactos(saveUpdate){
       var saveupdate=saveUpdate.trim();
      var nombre=$('.namecontact').val();
      var phone=$('.phonecontact').val();
      var email=$('.emailcontact').val();
        var dni=$('.dnicontact').val();
      var area=$('.areacontact').val();

if (nombre!="" && phone!="" && email!=""  && dni!="" && area!="" ) {
        if (saveupdate=="save") {
  $(".contactsclient"+saveupdate).append('<tr id="trcontactsave'+indexobject2+'"  ><td>#<input type="hidden"  name="operation'+saveupdate+'" value="save"><input type="hidden"  name="idcontacts'+saveupdate+'" value="0"><input type="hidden"  name="statuscontacts'+saveupdate+'" value="1"></td><td><input type="text" class="form-control" name="namecontact'+saveupdate+'" value="'+nombre+'"  maxlength="80" onkeypress="return checkText(this,event);" required ></td> \n\
\n\   <td><input type="number" class="form-control" name="dnicontact'+saveupdate+'" value="'+dni+'" max="99999999" min="1" data-maxlength="8" oninput="this.value=this.value.slice(0,this.dataset.maxlength)" required></td>  <td><input type="text" class="form-control" name="areacontact'+saveupdate+'" value="'+area+'" maxlength="45" onkeypress="return checkTotal(this,event);" required ></td> \n\
     <td><input type="number" class="form-control" name="phonecontact'+saveupdate+'" value="'+phone+'" max="999999999999999"  data-maxlength="15" oninput="this.value=this.value.slice(0,this.dataset.maxlength)" required></td>  <td><input type="email" class="form-control" name="emailcontact'+saveupdate+'" value="'+email+'" maxlength="60" required></td> <td><button type="button" href="#!" class="btn btn-danger  btn-sm " onclick="onDeleteContact(`'+saveupdate+'`,'+indexobject2+')"><i class="fa  fa-trash-o fa-lg colorwhite"></i></button></td></tr>');
  ccontactS++;
indexobject2++;
  }
if (saveupdate=="update") {
  if($("#myonoffswitchEditable").is(":checked")) {
}
else{
  $('#myonoffswitchEditable').prop('checked', true);
$(".ios-switch").removeClass('off');
$(".ios-switch").addClass('on');
$('.trinactivo').hide();
$('.tractivo').show();
}
  $(".contactsclient"+saveupdate).append('<tr class="tractivo" id="trcontactupdate'+indexobject2+'"  ><td>#<input type="hidden"  name="operation'+saveupdate+'" value="save"><input type="hidden"  name="idcontacts'+saveupdate+'" value="0"><input type="hidden" id="statuscontacts'+indexobject2+'"  name="statuscontacts'+saveupdate+'" value="1"></td><td><input type="text" class="form-control" name="namecontact'+saveupdate+'" value="'+nombre+'"  maxlength="70" onkeypress="return checkText(this,event);" required></td> \n\
        \n\
   <td><input type="number" class="form-control" name="dnicontact'+saveupdate+'" value="'+dni+'" max="99999999" min="1" data-maxlength="8" oninput="this.value=this.value.slice(0,this.dataset.maxlength)" required></td>  <td><input type="text" class="form-control" name="areacontact'+saveupdate+'" value="'+area+'" maxlength="45" onkeypress="return checkTotal(this,event);" required ></td> \n\
    <td><input type="number" class="form-control" name="phonecontact'+saveupdate+'" value="'+phone+'"  min="1" max="999999999999999"  data-maxlength="15" oninput="this.value=this.value.slice(0,this.dataset.maxlength)" required></td>  <td><input type="email" class="form-control" name="emailcontact'+saveupdate+'" value="'+email+'" maxlength="60"  required></td> <td><button   type="button" id="button'+indexobject2+'" class="btn btn-danger  btn-sm " onclick="onDeleteContact(`'+saveupdate+'`,'+indexobject2+')"><i id="icon'+indexobject2+'" class="fa  fa-trash-o fa-lg colorwhite"></i></button></td></tr>');
  ccontactS++;
indexobject2++;
}
   $('.namecontact').val("");
    $('.phonecontact').val("");
   $('.emailcontact').val(""); 
   $('.dnicontact').val("");
   $('.areacontact').val(""); 
}            
}

function addContactosProvider(saveupdate){      
      var nombre=$('.namecontact').val();
      var dni=$('.dnicontact').val();
      var area=$('.areacontact').val();
        var phone=$('.phonecontact').val();
      var email=$('.emailcontact').val();
      if (nombre!="" && dni!="" && area!="" && phone!="" && email!="") {
    if (saveupdate=="save") {
  $(".contactsprovider"+saveupdate).append('<tr id="trcontactprovsave'+indexobject3+'"  ><td>#<input type="hidden"  name="operation'+saveupdate+'" value="save"><input type="hidden"  name="idContactoprovider'+saveupdate+'" value="0"><input type="hidden"  name="statuscontactsprov'+saveupdate+'" value="1"></td><td><input type="text" class="form-control" name="namecontact'+saveupdate+'" value="'+nombre+'" maxlength="80"  onkeypress="return checkText(this,event);" required></td>\n\
                \n\
   <td><input type="number" class="form-control" name="dnicontactprov'+saveupdate+'" value="'+dni+'" max="99999999" min="1" data-maxlength="8" oninput="this.value=this.value.slice(0,this.dataset.maxlength)" required></td>  <td><input type="text" class="form-control" name="areacontactprov'+saveupdate+'" value="'+area+'" maxlength="45" onkeypress="return checkTotal(this,event);" required ></td> \n\
  <td><input type="number" class="form-control" name="phonecontact'+saveupdate+'" value="'+phone+'"  min="1" max="999999999999999"  data-maxlength="15" oninput="this.value=this.value.slice(0,this.dataset.maxlength)" required></td>  <td><input type="email" class="form-control" name="emailcontact'+saveupdate+'" value="'+email+'" maxlength="60"  required></td>\n\
    <td><button type="button" href="#!" class="btn btn-danger  btn-sm " onclick="onDeleteContactProv(`'+saveupdate+'`,'+indexobject3+')"><i class="fa  fa-trash-o fa-lg colorwhite"></i></button></td></tr>');
  cproviderS++;
indexobject3++;
  }
if (saveupdate=="update") {
  if($("#myonoffswitchEditable").is(":checked")) {
}
else{
  $('#myonoffswitchEditable').prop('checked', true);
$(".ios-switch").removeClass('off'); $(".ios-switch").addClass('on');
$('.trinactivo').hide(); $('.tractivo').show();
}
$(".contactsprovider"+saveupdate).append('<tr class="tractivo" id="trcontactprovupdate'+indexobject3+'"  ><td>#<input type="hidden"  name="operation'+saveupdate+'" value="save"><input type="hidden"  name="idContactoprovider'+saveupdate+'" value="0"><input type="hidden" id="statuscontactsprov'+indexobject3+'"  name="statuscontactsprov'+saveupdate+'" value="1"></td><td><input type="text" class="form-control" name="namecontact'+saveupdate+'" maxlength="80" value="'+nombre+'" onkeypress="return checkText(this,event);" required ></td> <td><input type="number" class="form-control" name="dnicontactprov'+saveupdate+'" value="'+dni+'" max="99999999" min="1" data-maxlength="8" oninput="this.value=this.value.slice(0,this.dataset.maxlength)" required></td>  <td><input type="text" class="form-control" name="areacontactprov'+saveupdate+'" maxlength="45" value="'+area+'" onkeypress="return checkTotal(this,event);" required ></td> \n\
  <td><input type="number" class="form-control" name="phonecontact'+saveupdate+'" value="'+phone+'"  min="1" max="999999999999999"  data-maxlength="15" oninput="this.value=this.value.slice(0,this.dataset.maxlength)" required></td>  <td><input type="email" class="form-control" name="emailcontact'+saveupdate+'" value="'+email+'" maxlength="60"  required></td>\n\
  <td><button type="button" id="button'+indexobject3+'" class="btn btn-danger  btn-sm " onclick="onDeleteContactProv(`'+saveupdate+'`,'+indexobject3+')"><i id="icon'+indexobject3+'" class="fa  fa-trash-o fa-lg colorwhite"></i></button></td></tr>');
cproviderS++;
indexobject3++;
}
    $('.namecontact').val("");
$('.dnicontact').val("");
   $('.areacontact').val(""); 
  $('.phonecontact').val("");
   $('.emailcontact').val(""); 


      }
}

 function onDeleteContact(saveUpdate,index){
    var saveupdate=saveUpdate.trim();
    if (saveupdate=="save") {
          $("#trcontactsave"+index).remove();
  ccontactS=ccontactS-1;
}
      if (saveupdate=="update") {
    $("#trcontactupdate"+index).remove();
  ccontactS=ccontactS-1;
     }  
    }

 function onDeleteContactProv(saveUpdate,index){
    var saveupdate=saveUpdate.trim();
    if (saveupdate=="save") {
          $("#trcontactprovsave"+index).remove();
  cproviderS=cproviderS-1;
}
      if (saveupdate=="update") {
    $("#trcontactprovupdate"+index).remove();
  cproviderS=cproviderS-1;
     }  
    }

function verContactClient(){
    var statu = 1;

if($("#myonoffswitchEditable").is(":checked")) {
$('.trinactivo').hide();
$('.tractivo').show();
}else{
//      $('#myonoffswitchEditable').prev('.ios-switch').trigger('click');

$('.trinactivo').show();
$('.tractivo').hide();
}

}
   function onDeleteContact2(index){
    var st=0;
    var operacion=$("#statuscontacts"+index).val();
        $("#trcontactupdate"+index).hide();
   if (operacion==0) {
    st=1;
     $("#trcontactupdate"+index).removeClass('trinactivo');
        $("#trcontactupdate"+index).addClass('tractivo');
$("#statuscontacts"+index).val(st);
$("#icon"+index).removeClass('fa-check'); $("#icon"+index).addClass('fa-trash-o');
$("#button"+index).removeClass('btn-success'); $("#button"+index).addClass('btn-danger');}
if(operacion==1){
       $("#trcontactupdate"+index).removeClass('tractivo');
        $("#trcontactupdate"+index).addClass('trinactivo');
$("#statuscontacts"+index).val(st);
$("#icon"+index).removeClass('fa-trash-o'); $("#icon"+index).addClass('fa-check');
$("#button"+index).removeClass('btn-danger'); $("#button"+index).addClass('btn-success');}
 }

  function onDeleteContactProv2(index){
    var st=0;
    var operacion=$("#statuscontactsprov"+index).val();
        $("#trcontactprovupdate"+index).hide();
   if (operacion==0) {
    st=1;
     $("#trcontactprovupdate"+index).removeClass('trinactivo');
        $("#trcontactprovupdate"+index).addClass('tractivo');
$("#statuscontactsprov"+index).val(st);
$("#icon"+index).removeClass('fa-check'); $("#icon"+index).addClass('fa-trash-o');
$("#button"+index).removeClass('btn-success'); $("#button"+index).addClass('btn-danger');}
if(operacion==1){
       $("#trcontactprovupdate"+index).removeClass('tractivo');
        $("#trcontactprovupdate"+index).addClass('trinactivo');
$("#statuscontactsprov"+index).val(st);
$("#icon"+index).removeClass('fa-trash-o'); $("#icon"+index).addClass('fa-check');
$("#button"+index).removeClass('btn-danger'); $("#button"+index).addClass('btn-success');}
 }

function removeItemFromArr ( arr,item ) {
    for (var i = 0; i < arrayadj.length; i++) {
        if(arrayadj[i].name==item){ arrayadj.splice( i, 1 );  }     
     }
  }
  
   function onDeleteAdj(saveUpdate,index,item){
    var saveupdate=saveUpdate.trim();
    if (saveupdate=="save") {
          $("#tradjsave"+index).remove();
removeItemFromArr(arrayadj,item);
  cdocumentS=cdocumentS-1;
  cdocumentU=cdocumentU-1;
}
      if (saveupdate=="update") {
    $("#tradjupdate"+index).remove();
    removeItemFromArr(arrayadj,item);
      cdocumentS=cdocumentS-1;
        cdocumentU=cdocumentU-1;
     }  

    }

var dRemove=[];
   function onDeleteAdj2(index){
var encry=$("#idadjupdate"+index).val();
   var urlpost = $("#documentupdate"+index).val();
     dRemove.push({
     name: urlpost,
    idremove:encry,
     operacion: "delete"
  });
  var convert=JSON.stringify(dRemove);
$('.detallejsondelete').val(convert); 
     $("#tradjupdate"+index).remove();
  cdocumentS=cdocumentS-1;
   }
   function tableAdjuntos(saveupdate) {
    var tableDataAdj = { tableDataAdj: [] };
    $(".adjuntosDoc"+saveupdate+" tr").each(function() {
        var obj = {};
         obj.operacion = $(":input[name=operation"+saveupdate+"]", this).val();
         obj.indexadj = parseInt($(":input[name=idadj"+saveupdate+"]", this).val());
        obj.titulo = $(":input[name=tile"+saveupdate+"]", this).val();
       obj.expiracion = $(":input[name=expira"+saveupdate+"]", this).val();
        tableDataAdj.tableDataAdj.push(obj);
    });
    
    return JSON.stringify(tableDataAdj);
}
   function tableClient(saveupdate) {
    var tableDataClient = { tableDataClient: [] };
    $(".contactsclient"+saveupdate+" tr").each(function() {
        var obj = {};
         obj.operacion = $(":input[name=operation"+saveupdate+"]", this).val();
         obj.idContactoCliente = parseInt($(":input[name=idcontacts"+saveupdate+"]", this).val());
        obj.name = $(":input[name=namecontact"+saveupdate+"]", this).val();
       obj.phone = $(":input[name=phonecontact"+saveupdate+"]", this).val();
       obj.email = $(":input[name=emailcontact"+saveupdate+"]", this).val();
         obj.dni = $(":input[name=dnicontact"+saveupdate+"]", this).val();
       obj.area = $(":input[name=areacontact"+saveupdate+"]", this).val();
       obj.status = parseInt($(":input[name=statuscontacts"+saveupdate+"]", this).val());
        tableDataClient.tableDataClient.push(obj);
    });
    
    return JSON.stringify(tableDataClient);
}

 function tableProvider(saveupdate) {
    var tableDataProvider = { tableDataProvider: [] };
    $(".contactsprovider"+saveupdate+" tr").each(function() {
        var obj = {};
         obj.operacion = $(":input[name=operation"+saveupdate+"]", this).val();
         obj.idContactoprovider =parseInt($(":input[name=idContactoprovider"+saveupdate+"]", this).val());
        obj.name = $(":input[name=namecontact"+saveupdate+"]", this).val();
       obj.dni = $(":input[name=dnicontactprov"+saveupdate+"]", this).val();
       obj.area = $(":input[name=areacontactprov"+saveupdate+"]", this).val();
        obj.phone = $(":input[name=phonecontact"+saveupdate+"]", this).val();
       obj.email = $(":input[name=emailcontact"+saveupdate+"]", this).val(); 
       obj.status = parseInt($(":input[name=statuscontactsprov"+saveupdate+"]", this).val());
        tableDataProvider.tableDataProvider.push(obj);
    });
    
    return JSON.stringify(tableDataProvider);
}

   function rellEditClient(data,detalle,contador,detallecontact,contContactos,idDepa,idProv,idDistrito,lisprov,listdistr){
      $("#modalEditForm").addClass("modal-block-full");
    $.magnificPopup.open({
      items: { src: '#modalEditForm'},
      type: 'inline',
      preloader: true,
      modal: true
    });
                var urlglobal=$("#url").val();

      $(".mfp-bg").addClass("capa1");
$(".mfp-wrap").addClass('capa2');
    $.each(data, function( i, item ) {
      $("."+i).val(item);
      $(".cargaIB1").val("0");
    
         if(i=="archivo"){
            if (item!=null && item!="" && item!="Error") {
             $(".viewEXCEL").html('<button type="button" class="mb-xs mt-xs mr-xs modal-basic btn btn-primary" onclick="ventanaSecundaria(`'+urlglobal+'assets/excel/'+item+'`)">ver archivo</button>');
          }else{
            $(".viewEXCEL").html('<div class="alert alert-danger">\n\
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>\n\
                   <span>Este registro no cuenta con  Documento EXCEL</span>\n\
                  </div>' );
          }
         }
    $('select[name='+i+']').val(item);
  }); 
     $(".idDistrito").html("");        $(".idProvincia").html("");
        $('select[name="idDepartamento"]').val(idDepa);
    $(".idDistrito").html(listdistr);        $(".idProvincia").html(lisprov);
   $('select[name="idProvincia"]').val(idProv);
  $('select[name="idDistrito"]').val(idDistrito);
if($("#myonoffswitchEditable").is(":checked")) {
$(".ios-switch").removeClass('off');
$(".ios-switch").addClass('on');}
else{
  $('#myonoffswitchEditable').prop('checked', true);
}
$(".adjuntosDocupdate").html(detalle);
$(".contactsclientupdate").html(detallecontact);
cdocumentS=contador;
indexobject=contador;
  ccontactS=contContactos;
indexobject2=contContactos;
}

function rellEditProvider(data,idDepa,idProv,idDistrito,lisprov,listdistr,detalle,contador){
         var view=$("#view").val();
         if(view=="personal" ||  view=="provider" ||  view=="client"){
            $("#modalEditForm").addClass("modal-block-full");
         }
          
          $.magnificPopup.open({
               items: {   src: '#modalEditForm'   },
               type: 'inline',
                preloader: true,
                modal: true
           });

          $(".mfp-bg").addClass("capa1");
$(".mfp-wrap").addClass('capa2');
         $.each(data, function( i, item ) {
        $("."+i).val(item);
       });
    $(".idDistrito").html("");        $(".idProvincia").html("");
        $('select[name="idDepartamento"]').val(idDepa);
    $(".idDistrito").html(listdistr);        $(".idProvincia").html(lisprov);
   $('select[name="idProvincia"]').val(idProv);
  $('select[name="idDistrito"]').val(idDistrito);
  if($("#myonoffswitchEditable").is(":checked")) {
$(".ios-switch").removeClass('off');
$(".ios-switch").addClass('on');}
else{
  $('#myonoffswitchEditable').prop('checked', true);
}
cproviderS=contador;
indexobject3=contador;
$(".contactsproviderupdate").html(detalle);
getpasstypeprv("update");

}


function rellEditProvider2(data,ajax,url){
       
var respuesta=$(".scriptloaderupdate");
$(".scriptjsajaxupdate").html('');
$(".cbdyupdate").css('display','none');
          $.magnificPopup.open({
               items: {   src: '#modalEditForm'   },
               type: 'inline',
                preloader: true,
                modal: true
           });

          $("#modalEditForm").addClass("modal-block-full");
          $(".mfp-bg").addClass("capa1");
          $(".mfp-wrap").addClass('capa2');
 $.ajax({
                 type:"GET",
                   url:url+"/ajax/"+ajax+".php",
                  data: "&paintscript=yes&idProvider="+data.idProvider,           
                  xhr: function(){
                    $(".scriptloaderupdate").html('<i class="fa fa-spinner fa-spin fa-2x fa-fw"></i>');
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress", function(evt) {
                      if (evt.lengthComputable) {
                        var percentComplete = evt.loaded / evt.total;
                        percentComplete = parseInt(percentComplete * 100);
                        if(percentComplete<100){
                            respuesta.html('<p class="text-center">Procesado... ('+percentComplete+'%)</p><div class="progress progress-striped active"><div class="progress-bar progress-bar-info" style="width: '+percentComplete+'%;"></div></div>');
                        }else{
                            respuesta.html('<p class="text-center"></p>');
                        }
                      }
                    }, false);
                    return xhr;
                },
                success: function(data) {
                  respuesta.html('');
                 $(".cbdyupdate").css('display','block');
          $(".scriptjsajaxupdate").html(data);
              },
              error: function(xhr) { // if error occure   
   new PNotify({
      title: 'Algo Salio Mal',
      text: 'Intente Nuevamente',
      type: 'error'
    });
                },
              }); 




}



function ventanaSecundaria2(index){
  var urlglobal=$("#url").val(); var archivo=$("#documentupdate"+index).val();
var URL=urlglobal+"assets/client/"+archivo;
   window.open(URL,"ventana1","width=550,height=600,scrollbars=NO") 
}
//SOLICITUD
///TIPO DOCUMENTO
///funcione solicitud modificadas

function getDocumentoSave(idTypeService,ajax,url){

 var d=0; var f=1; var ef=0; status=0;

 
   $.get(url+"ajax/"+ajax+".php", {idTypeService:idTypeService,changeDocument:"save",encryD:d,faseindex:f,encryf:ef,status:status}, function(respuesta){    
      

        $(".mockup-principalsave").html(respuesta);   
   $('[data-plugin-timepicker]').each(function() {
        var $this = $( this ),  opts = {};
        var pluginOptions = $this.data('plugin-options');
        if (pluginOptions)
          opts = pluginOptions;
        $this.themePluginTimePicker(opts);
      });

  $('[data-plugin-datepicker]').each(function() {
        var $this = $( this ),
          opts = {};

        var pluginOptions = $this.data('plugin-options');
        if (pluginOptions)
          opts = pluginOptions;

        $this.themePluginDatePicker(opts);
      });


     });
   
}

function getDataClient(ajax,url,tipo){
var idClient=$('select[name=idClient]').val();
 var c=$(".idSolicitudService").val();

  $(".lugararea").val("Seleccione un Areá");
  if (tipo!="") {
 $.get(url+"ajax/"+ajax+".php", {idClient:idClient,changeClient:tipo,encryC:c}, function(respuesta){      
        $(".idContactoCliente"+tipo).html(respuesta); });
     $.get(url+"ajax/"+ajax+".php", {idClient:idClient,changeArea:tipo,encryC:c}, function(respuesta){      
        $(".area"+tipo).html(respuesta); 
     if (tipo=="update") {elegirareaupdate();}    
  $(".lugarRecojo").val("");
    $(".dataRecojo").val("");
      });

  }else{
  $(".lugarRecojo").val("");
    $(".dataRecojo").val("");
     $(".idContactoCliente"+tipo).html("");
 $(".area"+tipo).html(""); 
  }
  
}
function getDataClient2(ajax,url,tipo,idClient){
 var c=$(".idSolicitudService").val();
 var idClient=$('select[name=idClient]').val();
  $(".lugararea").val("Seleccione un Areá");
  if (tipo!="") {
 $.get(url+"ajax/"+ajax+".php", {idClient:idClient,changeClient:tipo,encryC:c}, function(respuesta){      
        $(".idContactoCliente"+tipo).html(respuesta); });
     $.get(url+"ajax/"+ajax+".php", {idClient:idClient,changeArea:tipo,encryC:c}, function(respuesta){      
        $(".area"+tipo).html(respuesta); 
     if (tipo=="update") {elegirareaupdate();}    
      });
  }
  
}

function getDataClient3(ajax,url,tipo,idClient){
 var c=$(".idSolicitudService").val();
 var idClient=$('select[name=idClient]').val();
$(".stringarea").val("");  $(".contact").val("");$(".lugarRecojo").val("");

  $(".lugararea").val("Seleccione un Areá");
  if (tipo!="") {
 $.get(url+"ajax/"+ajax+".php", {idClient:idClient,changeClient:tipo,encryC:c}, function(respuesta){      
        $(".listcontact").html(respuesta); });
     $.get(url+"ajax/"+ajax+".php", {idClient:idClient,changeArea:tipo,encryC:c}, function(respuesta){      
        $(".listarea").html(respuesta); 

      });

  }
  
}

function getDataClient4(ajax,url,tipo,idClient){
 var c=$(".idSolicitudService").val();
 var idClient=$('select[name=idClient]').val();
$(".stringarea").val("");  $(".contact").val("");$(".lugarRecojo").val("");$(".remitente").val("");

  $(".lugararea").val("Seleccione un Areá");
  if (tipo!="") {
 $.get(url+"ajax/"+ajax+".php", {idClient:idClient,changeClient:tipo,encryC:c}, function(respuesta){      
        $(".listcontact").html(respuesta); });
     $.get(url+"ajax/"+ajax+".php", {idClient:idClient,changeArea:tipo,encryC:c}, function(respuesta){      
        $(".listarea").html(respuesta); 

      });

 $.get(url+"ajax/"+ajax+".php", {idClient:idClient,changeRemitente:tipo,encryC:c}, function(respuesta){      
        $(".listremitente").html(respuesta); 

      });


  }
  
}

function getDataClient5(ajax,url,tipo,idClient){
 var c=$(".idSolicitudService").val();
 var idClient=$('select[name=idClient]').val();
$(".stringarea").val("");  $(".contact").val("");$(".lugarRecojo").val("");  $(".remitente").val("");$(".destinatario").val("");


  $(".lugararea").val("Seleccione un Areá");
  if (tipo!="") {
 $.get(url+"ajax/"+ajax+".php", {idClient:idClient,changeClient:tipo,encryC:c}, function(respuesta){      
        $(".listcontact").html(respuesta); });
     $.get(url+"ajax/"+ajax+".php", {idClient:idClient,changeArea:tipo,encryC:c}, function(respuesta){      
        $(".listarea").html(respuesta); 
      });

 $.get(url+"ajax/"+ajax+".php", {idClient:idClient,changeRemitente:tipo,encryC:c}, function(respuesta){      
        $(".listremitente").html(respuesta); 
      });
 $.get(url+"ajax/"+ajax+".php", {idClient:idClient,changeDestinatario:tipo,encryC:c}, function(respuesta){      
        $(".listdestinatario").html(respuesta); 
      });

  }
  
}


  
  

function elegirareaT2(el){ // recibimos por parametro el elemento select
 // var direccion = $('option:selected','#dataareasave').attr('data-adrres');
// var options = document.getElementById('dataareasave').getElementsByTagName('option');
var val=$(el).val();
   var direccion = $('#datalist-area').find('option[value="'+val+'"]').data('adrres');
   
 $(".lugarRecojo").val(direccion);
}


  function rellEditSolicitud(data){

var url=$("#url").val();
var ajax=$("#ajax").val();
console.clear();
     var ms=$(".mockup-principalupdate");
var idTypeService=0;
var idFaseTypeService=0;
var status=0;
var c=0, idClient=0,idSolicitudService=0,textS='',textF='';
         $.each(data, function( i, item ) {
        $("."+i).val(item);
                  $(".cargaIB1").val("0");
        $('select[name='+i+']').val(item);
     // console.log("variables "+i + "-->"+item);
         if (i=="idFaseTypeService") {idFaseTypeService=item; }
   if (i=="idTypeService") {idTypeService=item; typemd=item;}
   if (i=="statusfase") {status=item;}
   if (i=="idClient") {idClient=item; }
  if (i=="idContactoCliente") {c=item;}
  if (i=="idSolicitudService") {idSolicitudService=item;}
  if (i=="servicio") {textS=item;}
  if (i=="fase") {textF=item;}
       });
        $(".tituloFase").text(textS+" ( "+textF+" )");
 //   $.get(url+"ajax/"+ajax+".php", {encryCl:idClient,paintClient:"save"}, function(respuesta){    
   //     $(".auto-complete-Client").html(respuesta);  
//     });
 
   
 $("#modalEditForm").addClass("modal-block-full");       
          $.magnificPopup.open({
               items: {  src: '#modalEditForm' },
               type: 'inline',
                preloader: true,
                modal: true
           });

if (status==0) {
  $(".txt-S").text('Confirmar');

   if(idFaseTypeService==3 || idFaseTypeService==8 || idFaseTypeService==12  || idFaseTypeService==15 || idFaseTypeService==19 || idFaseTypeService==22){    


var f=1;
   $.get(url+"ajax/"+ajax+".php", {idTypeService:idTypeService,changeDocument:"update",encryD:idSolicitudService,faseindex:f,encryf:idFaseTypeService,status:status},function(respuesta){          
$(".mockup-principalupdate").html(respuesta);
    $('[data-plugin-timepicker]').each(function() {
        var $this = $( this ),  opts = {};
        var pluginOptions = $this.data('plugin-options');
        if (pluginOptions)
          opts = pluginOptions;
        $this.themePluginTimePicker(opts);
      });
  $('[data-plugin-datepicker]').each(function() {
        var $this = $( this ),
          opts = {};

        var pluginOptions = $this.data('plugin-options');
        if (pluginOptions)
          opts = pluginOptions;

        $this.themePluginDatePicker(opts);
      });



     });

}
if (idFaseTypeService==4 || idFaseTypeService==9   || idFaseTypeService==16 ) {
var f=2;
   $.get(url+"ajax/"+ajax+".php", {idTypeService:idTypeService,changeDocument:"update",encryD:idSolicitudService,faseindex:f,encryf:idFaseTypeService,status:status}, function(respuesta){          
ms.html(respuesta);
  $('[data-plugin-selectTwo]').each(function() {
        var $this = $( this ),
          opts = {};

        var pluginOptions = $this.data('plugin-options');
        if (pluginOptions)
          opts = pluginOptions;

        $this.themePluginSelect2(opts);
      });

 $('[data-plugin-timepicker]').each(function() {
        var $this = $( this ),  opts = {};
        var pluginOptions = $this.data('plugin-options');
        if (pluginOptions)
          opts = pluginOptions;
        $this.themePluginTimePicker(opts);
      });
  $('[data-plugin-datepicker]').each(function() {
        var $this = $( this ),
          opts = {};

        var pluginOptions = $this.data('plugin-options');
        if (pluginOptions)
          opts = pluginOptions;

        $this.themePluginDatePicker(opts);
      });


     });
}
if (idFaseTypeService==5 || idFaseTypeService==10)    {
var f=3;
   $.get(url+"ajax/"+ajax+".php", {idTypeService:idTypeService,changeDocument:"update",encryD:idSolicitudService,faseindex:f,encryf:idFaseTypeService,status:status}, function(respuesta){          
ms.html(respuesta);
  $('[data-plugin-timepicker]').each(function() {
        var $this = $( this ),  opts = {};
        var pluginOptions = $this.data('plugin-options');
        if (pluginOptions)
          opts = pluginOptions;
        $this.themePluginTimePicker(opts);
      });
    $('[data-plugin-datepicker]').each(function() {
        var $this = $( this ),
          opts = {};

        var pluginOptions = $this.data('plugin-options');
        if (pluginOptions)
          opts = pluginOptions;

        $this.themePluginDatePicker(opts);
      });

 $('[data-plugin-selectTwo]').each(function() {
        var $this = $( this ),
          opts = {};

        var pluginOptions = $this.data('plugin-options');
        if (pluginOptions)
          opts = pluginOptions;
        $this.themePluginSelect2(opts);
      });


 ccargaSolicitud=parseInt($(".jsonindex").val());
 indexObjSolicitud=parseInt($(".jsonindex").val());
     });


}
if (idFaseTypeService==13 || idFaseTypeService==20 || idFaseTypeService==23) {
 var f=3;
   $.get(url+"ajax/"+ajax+".php", {idTypeService:idTypeService,changeDocument:"update",encryD:idSolicitudService,faseindex:f,encryf:idFaseTypeService,status:status}, function(respuesta){          
ms.html(respuesta);
  $('[data-plugin-timepicker]').each(function() {
        var $this = $( this ),  opts = {};
        var pluginOptions = $this.data('plugin-options');
        if (pluginOptions)
          opts = pluginOptions;
        $this.themePluginTimePicker(opts);
      });

  $('[data-plugin-datepicker]').each(function() {
        var $this = $( this ),
          opts = {};

        var pluginOptions = $this.data('plugin-options');
        if (pluginOptions)
          opts = pluginOptions;

        $this.themePluginDatePicker(opts);
      });

   $('[data-plugin-selectTwo]').each(function() {
        var $this = $( this ),
          opts = {};

        var pluginOptions = $this.data('plugin-options');
        if (pluginOptions)
          opts = pluginOptions;

        $this.themePluginSelect2(opts);
      });

 ccargaSolicitud=parseInt($(".jsonindex").val());
 indexObjSolicitud=parseInt($(".jsonindex").val());
     });

}
if (idFaseTypeService==17) {
 var f=3;
   $.get(url+"ajax/"+ajax+".php", {idTypeService:idTypeService,changeDocument:"update",encryD:idSolicitudService,faseindex:f,encryf:idFaseTypeService,status:status}, function(respuesta){          
ms.html(respuesta);
  $('[data-plugin-timepicker]').each(function() {
        var $this = $( this ),  opts = {};
        var pluginOptions = $this.data('plugin-options');
        if (pluginOptions)
          opts = pluginOptions;
        $this.themePluginTimePicker(opts);
      });

  $('[data-plugin-datepicker]').each(function() {
        var $this = $( this ),
          opts = {};

        var pluginOptions = $this.data('plugin-options');
        if (pluginOptions)
          opts = pluginOptions;

        $this.themePluginDatePicker(opts);
      });
 $('[data-plugin-selectTwo]').each(function() {
        var $this = $( this ),
          opts = {};

        var pluginOptions = $this.data('plugin-options');
        if (pluginOptions)
          opts = pluginOptions;

        $this.themePluginSelect2(opts);
      });


 ccargaSolicitud=parseInt($(".jsonindex").val());
 indexObjSolicitud=parseInt($(".jsonindex").val());

     });


}

if(idFaseTypeService==6 ){ 

var f=4;
   $.get(url+"ajax/"+ajax+".php", {idTypeService:idTypeService,changeDocument:"update",encryD:idSolicitudService,faseindex:f,encryf:idFaseTypeService,status:status}, function(respuesta){          
ms.html(respuesta);
 $('[data-plugin-timepicker]').each(function() {
        var $this = $( this ),  opts = {};
        var pluginOptions = $this.data('plugin-options');
        if (pluginOptions)
          opts = pluginOptions;
        $this.themePluginTimePicker(opts);
      });
  $('[data-plugin-datepicker]').each(function() {
        var $this = $( this ),
          opts = {};

        var pluginOptions = $this.data('plugin-options');
        if (pluginOptions)
          opts = pluginOptions;

        $this.themePluginDatePicker(opts);
      });

   $('[data-plugin-selectTwo]').each(function() {
        var $this = $( this ),
          opts = {};

        var pluginOptions = $this.data('plugin-options');
        if (pluginOptions)
          opts = pluginOptions;

        $this.themePluginSelect2(opts);
      });

     });
}
if(idFaseTypeService==11 || idFaseTypeService==18|| idFaseTypeService==21  || idFaseTypeService==14  || idFaseTypeService==24){ 

     if (idFaseTypeService==18  || idFaseTypeService==21 || idFaseTypeService==11) {
       $("#modalEditForm").removeClass("modal-block-full");       
     }

var f=4;
   $.get(url+"ajax/"+ajax+".php", {idTypeService:idTypeService,changeDocument:"update",encryD:idSolicitudService,faseindex:f,encryf:idFaseTypeService,status:status}, function(respuesta){          
ms.html(respuesta);
  $('[data-plugin-timepicker]').each(function() {
        var $this = $( this ),  opts = {};
        var pluginOptions = $this.data('plugin-options');
        if (pluginOptions)
          opts = pluginOptions;
        $this.themePluginTimePicker(opts);
      });

  $('[data-plugin-datepicker]').each(function() {
        var $this = $( this ),
          opts = {};

        var pluginOptions = $this.data('plugin-options');
        if (pluginOptions)
          opts = pluginOptions;

        $this.themePluginDatePicker(opts);
      });


     });
}
if(idFaseTypeService==7 || idFaseTypeService==25){ 
var f=5;
   $.get(url+"ajax/"+ajax+".php", {idTypeService:idTypeService,changeDocument:"update",encryD:idSolicitudService,faseindex:f,encryf:idFaseTypeService,status:status}, function(respuesta){          
ms.html(respuesta);
  $('[data-plugin-timepicker]').each(function() {
        var $this = $( this ),  opts = {};
        var pluginOptions = $this.data('plugin-options');
        if (pluginOptions)
          opts = pluginOptions;
        $this.themePluginTimePicker(opts);
      });

  $('[data-plugin-datepicker]').each(function() {
        var $this = $( this ),
          opts = {};
        var pluginOptions = $this.data('plugin-options');
        if (pluginOptions)
          opts = pluginOptions;
        $this.themePluginDatePicker(opts);
      });


     });
}


}
if (status==1) {
  $(".txt-S").text('Guardar');
 if(idFaseTypeService==3 || idFaseTypeService==8   || idFaseTypeService==15 ){    
var f=1;
   $.get(url+"ajax/"+ajax+".php", {idTypeService:idTypeService,changeDocument:"save",encryD:idSolicitudService,faseindex:f,encryf:idFaseTypeService,status:status}, function(respuesta){          
ms.html(respuesta);
 $('[data-plugin-timepicker]').each(function() {
        var $this = $( this ),  opts = {};
        var pluginOptions = $this.data('plugin-options');
        if (pluginOptions)
          opts = pluginOptions;
        $this.themePluginTimePicker(opts);
      });
  $('[data-plugin-datepicker]').each(function() {
        var $this = $( this ),
          opts = {};

        var pluginOptions = $this.data('plugin-options');
        if (pluginOptions)
          opts = pluginOptions;

        $this.themePluginDatePicker(opts);
      });

  $('[data-plugin-selectTwo]').each(function() {
        var $this = $( this ),
          opts = {};

        var pluginOptions = $this.data('plugin-options');
        if (pluginOptions)
          opts = pluginOptions;

        $this.themePluginSelect2(opts);
      });
     });
}

if (idFaseTypeService==4 || idFaseTypeService==9)    {
var f=3;
   $.get(url+"ajax/"+ajax+".php", {idTypeService:idTypeService,changeDocument:"save",encryD:idSolicitudService,faseindex:f,encryf:idFaseTypeService,status:status}, function(respuesta){          
ms.html(respuesta);
 $('[data-plugin-timepicker]').each(function() {
        var $this = $( this ),  opts = {};
        var pluginOptions = $this.data('plugin-options');
        if (pluginOptions)
          opts = pluginOptions;
        $this.themePluginTimePicker(opts);
      });
  $('[data-plugin-datepicker]').each(function() {
        var $this = $( this ),
          opts = {};

        var pluginOptions = $this.data('plugin-options');
        if (pluginOptions)
          opts = pluginOptions;

        $this.themePluginDatePicker(opts);
      });

 $('[data-plugin-selectTwo]').each(function() {
        var $this = $( this ),
          opts = {};

        var pluginOptions = $this.data('plugin-options');
        if (pluginOptions)
          opts = pluginOptions;

        $this.themePluginSelect2(opts);
      });

     });


}
if (idFaseTypeService==12 || idFaseTypeService==19 || idFaseTypeService==22) {
 var f=3;
   $.get(url+"ajax/"+ajax+".php", {idTypeService:idTypeService,changeDocument:"save",encryD:idSolicitudService,faseindex:f,encryf:idFaseTypeService,status:status}, function(respuesta){          
ms.html(respuesta);
  $('[data-plugin-timepicker]').each(function() {
        var $this = $( this ),  opts = {};
        var pluginOptions = $this.data('plugin-options');
        if (pluginOptions)
          opts = pluginOptions;
        $this.themePluginTimePicker(opts);
      });

  $('[data-plugin-datepicker]').each(function() {
        var $this = $( this ),
          opts = {};

        var pluginOptions = $this.data('plugin-options');
        if (pluginOptions)
          opts = pluginOptions;

        $this.themePluginDatePicker(opts);
      });

 $('[data-plugin-selectTwo]').each(function() {
        var $this = $( this ),
          opts = {};

        var pluginOptions = $this.data('plugin-options');
        if (pluginOptions)
          opts = pluginOptions;

        $this.themePluginSelect2(opts);
      });

     });

ms.show();
}

if (idFaseTypeService==16) {
 var f=3;
   $.get(url+"ajax/"+ajax+".php", {idTypeService:idTypeService,changeDocument:"save",encryD:idSolicitudService,faseindex:f,encryf:idFaseTypeService,status:status}, function(respuesta){          
ms.html(respuesta);
  $('[data-plugin-timepicker]').each(function() {
        var $this = $( this ),  opts = {};
        var pluginOptions = $this.data('plugin-options');
        if (pluginOptions)
          opts = pluginOptions;
        $this.themePluginTimePicker(opts);
      });

  $('[data-plugin-datepicker]').each(function() {
        var $this = $( this ),
          opts = {};

        var pluginOptions = $this.data('plugin-options');
        if (pluginOptions)
          opts = pluginOptions;

        $this.themePluginDatePicker(opts);
      });

   $('[data-plugin-selectTwo]').each(function() {
        var $this = $( this ),
          opts = {};

        var pluginOptions = $this.data('plugin-options');
        if (pluginOptions)
          opts = pluginOptions;

        $this.themePluginSelect2(opts);
      });


     });

ms.show(); 

}
if(idFaseTypeService==5 ){ 

var f=4;
   $.get(url+"ajax/"+ajax+".php", {idTypeService:idTypeService,changeDocument:"save",encryD:idSolicitudService,faseindex:f,encryf:idFaseTypeService,status:status}, function(respuesta){          
ms.html(respuesta);
   $('[data-plugin-selectTwo]').each(function() {
        var $this = $( this ),
          opts = {};

        var pluginOptions = $this.data('plugin-options');
        if (pluginOptions)
          opts = pluginOptions;

        $this.themePluginSelect2(opts);
      });

    $('[data-plugin-timepicker]').each(function() {
        var $this = $( this ),  opts = {};
        var pluginOptions = $this.data('plugin-options');
        if (pluginOptions)
          opts = pluginOptions;
        $this.themePluginTimePicker(opts);
      });
  $('[data-plugin-datepicker]').each(function() {
        var $this = $( this ),
          opts = {};

        var pluginOptions = $this.data('plugin-options');
        if (pluginOptions)
          opts = pluginOptions;

        $this.themePluginDatePicker(opts);
      });



     });
}
if(idFaseTypeService==10 || idFaseTypeService==17 || idFaseTypeService==20  || idFaseTypeService==13 || idFaseTypeService==23){ 
      // if (idFaseTypeService==17 || idFaseTypeService==20 || idFaseTypeService==10) {
     //  $("#modalEditForm").removeClass("modal-block-full");       
    // }

var f=4;
   $.get(url+"ajax/"+ajax+".php", {idTypeService:idTypeService,changeDocument:"save",encryD:idSolicitudService,faseindex:f,encryf:idFaseTypeService,status:status}, function(respuesta){          
ms.html(respuesta);
  $('[data-plugin-timepicker]').each(function() {
        var $this = $( this ),  opts = {};
        var pluginOptions = $this.data('plugin-options');
        if (pluginOptions)
          opts = pluginOptions;
        $this.themePluginTimePicker(opts);
      });

  $('[data-plugin-datepicker]').each(function() {
        var $this = $( this ),
          opts = {};

        var pluginOptions = $this.data('plugin-options');
        if (pluginOptions)
          opts = pluginOptions;

        $this.themePluginDatePicker(opts);
      });


     });

}
if(idFaseTypeService==6 || idFaseTypeService==21){ 
var f=5;
   $.get(url+"ajax/"+ajax+".php", {idTypeService:idTypeService,changeDocument:"save",encryD:idSolicitudService,faseindex:f,encryf:idFaseTypeService,status:status}, function(respuesta){          
ms.html(respuesta);
  $('[data-plugin-timepicker]').each(function() {
        var $this = $( this ),  opts = {};
        var pluginOptions = $this.data('plugin-options');
        if (pluginOptions)
          opts = pluginOptions;
        $this.themePluginTimePicker(opts);
      });

  $('[data-plugin-datepicker]').each(function() {
        var $this = $( this ),
          opts = {};

        var pluginOptions = $this.data('plugin-options');
        if (pluginOptions)
          opts = pluginOptions;

        $this.themePluginDatePicker(opts);
      });



     });
}



}
 $(".mfp-bg").addClass("capa1");
$(".mfp-wrap").addClass('capa2');        
}


function addDetalleCargaT1(saveupdate){
var url=$("#url").val();
var ajax=$("#ajax").val();
var tmercaderia=$(".tipodemercaderia").val();
var destinatario=$(".destinatario").val();
var departorigen=$('select[name="departamentoorigen"]').val();
var provrigen=$('select[name="provinciaorigen"]').val();
var origen=$('select[name="distritoorigen"]').val();
var destino=$('select[name="distritodestino"]').val();
var departdestino=$('select[name="departamentodestino"]').val();
var provdestino=$('select[name="provinciadestino"]').val();
var NGRR=$(".NGRR").val();
var NFACT=$(".NFACT").val();
var NBV=$(".NBV").val();
var NOE=$(".NOE").val();
var nCajas=$(".nCajas").val();
var nSobres=$(".nSobres").val();
var pesoKg=$(".pesoKg").val();
var PV=$(".PV").val();
var validercs=false;
if (nCajas!=""||nSobres!="") {
  validercs=true;
}
if (nCajas=="") {
  nCajas=0;
}
if (nSobres=="") {
  nSobres=0;
}

if (tmercaderia!="" && destinatario!="" && departorigen!=""&& provrigen!="" && origen!="" && destino!="" &&departdestino!=""&&provdestino!="" ) {
  if (saveupdate=="save" || saveupdate=="update") {
  $(".detallecarga"+saveupdate).append('<tr id="trcargasave'+indexObjSolicitud+'"  ><td> # <span class="txttk'+indexObjSolicitud+'"></span>  \
    <input type="hidden"  name="operation'+saveupdate+'" value="save">           \
     <input type="hidden"  name="idDetalleCarga'+saveupdate+'" value="0"> \
     <input type="hidden"  name="statuscarga'+saveupdate+'" value="1">\
   <input type="hidden"  name="token'+saveupdate+'" class="tkcaga'+indexObjSolicitud+'"> </td>\
    <td> <select name="idTypeMercaderia'+saveupdate+'"  class="inputtable idTypeMercaderia'+indexObjSolicitud+'"> </select>  \
    </td> <select name="idTypeMercaderia'+saveupdate+'"  class="inputtable idTypeMercaderia'+indexObjSolicitud+'"> </select> \
    <td><input type="text"  name="destinatario'+saveupdate+'" value="'+destinatario+'"  maxlength="100" class="inputtable"    onkeypress="return checkTotal(this,event);" required> \
    </td> \
      <td> <select   class="inputtable depaorigen-'+indexObjSolicitud+'" onchange="getProvinciaTable(`'+"origen"+'`,'+indexObjSolicitud+')"> </select> </td> \
 <td>  <select   class="inputtable provorigen-'+indexObjSolicitud+'" onchange="getDistritoTable(`'+"origen"+'`,'+indexObjSolicitud+')"> </select> </td>\
 <td>  <select  name="distritoorigen'+saveupdate+'" class="inputtable distorigen-'+indexObjSolicitud+'" required > </select>   </td> \
    <td> <select   class="inputtable depadestino-'+indexObjSolicitud+'" onchange="getProvinciaTable(`'+"destino"+'`,'+indexObjSolicitud+')"> </select> </td> \
 <td>  <select   class="inputtable provdestino-'+indexObjSolicitud+'" onchange="getDistritoTable(`'+"destino"+'`,'+indexObjSolicitud+')"> </select> </td>\
  <td> <select  name="distritodestino'+saveupdate+'" class="inputtable distdestino-'+indexObjSolicitud+'" required > </select>  </td>\
   <td>  <input type="text"  name="NGRR'+saveupdate+'" class="inputtable" maxlength="30"  value="'+NGRR+'"   > \
       </td>\
       <td>  <input type="text" name="NFACT'+saveupdate+'" class="inputtable" maxlength="30"  value="'+NFACT+'" > \
       </td>\
     <td>  <input type="text" name="NBV'+saveupdate+'" class="inputtable"  value="'+NBV+'"  maxlength="30" ></td>\
     <td> <input type="text" name="NOE'+saveupdate+'" class="inputtable" value="'+NOE+'"    maxlength="30" ></td>      \
     <td> <input type="number" name="nCajas'+saveupdate+'" class="inputtable" min="0" max="9999999999"  value="'+nCajas+'"  data-maxlength="10" oninput="this.value=this.value.slice(0,this.dataset.maxlength)" ></td>   \
    <td> <input type="number" name="nSobres'+saveupdate+'" class="inputtable" min="0" value="'+nSobres+'"   max="9999999999" data-maxlength="10" oninput="this.value=this.value.slice(0,this.dataset.maxlength)" >  \
</td>   <td>   <input type="number" step="any" name="pesoKg'+saveupdate+'" class="inputtable" min="0.1" value="'+pesoKg+'"  max="9999999999" data-maxlength="10" oninput="this.value=this.value.slice(0,this.dataset.maxlength)" ></td>\
<td>     <input type="number"  step="any" name="PV'+saveupdate+'" class="inputtable" value="'+PV+'"  max="9999999999" data-maxlength="10" oninput="this.value=this.value.slice(0,this.dataset.maxlength)" >\
</td>  \   <td><button type="button"  class="btn btn-danger  btn-sm " onclick="onDeleteCargaT1(`'+saveupdate+'`,'+indexObjSolicitud+')"><i class="fa  fa-trash-o fa-lg colorwhite"></i></button></td></tr>');
     var bandera=indexObjSolicitud;
    
  $.get(url+"ajax/"+ajax+".php", {tkdetalle:"yes",cmerc:tmercaderia,iddeporg:departorigen,idprovorg:provrigen,iddepdest:departdestino,idprovdest:provdestino,iddistrorg:origen,iddistrdest:destino}, function(respuesta){ 
var listadovf= JSON.parse(respuesta);
var tok=listadovf.token;
 $(".txttk"+bandera).text(tok); 
 $(".tkcaga"+bandera).val(tok)
 var element=".idTypeMercaderia"+bandera;
   $(element).html(listadovf.mercaderia);
    $(".depaorigen-"+bandera).html(listadovf.depa);
   $(".depadestino-"+bandera).html(listadovf.depa);
     $(".depaorigen-"+bandera).val(departorigen);
     $(".depadestino-"+bandera).val(departdestino);
      $(".provorigen-"+bandera).html(listadovf.provorig);
       $(".provdestino-"+bandera).html(listadovf.provdest);
        $(".distorigen-"+bandera).html(listadovf.distorigen);
         $(".distdestino-"+bandera).html(listadovf.distdestino);
     });
  ccargaSolicitud++;
indexObjSolicitud++;
  }


//$(".tipodemercaderia").val("");        
$(".NGRR").val("");
$(".NFACT").val("");
$(".NBV").val("");
$(".NOE").val("");
$(".nCajas").val("");
$(".nSobres").val("");
$(".pesoKg").val("");
$(".PV").val("");
$(".destinatario").val("");

}
else{
  new PNotify({
      title: 'Algo Salio Mal',
      text: 'Para añadir Complete los campos requeridos e intente nuevamente',
      type: 'error'
    });
}

}

function addDetalleCargaNT2(saveupdate){
var url=$("#url").val();
var ajax=$("#ajax").val();
var tmercaderia=$(".tipodemercaderia").val();
var destinatario=$(".destinatario").val();
var provrigen=$('select[name="provinciaorigen"]').val();
var origen=$('select[name="distritoorigen"]').val();
var destino=$('select[name="distritodestino"]').val();
var provdestino=$('select[name="provinciadestino"]').val();
var NGRR=$(".NGRR").val();
var NFACT=$(".NFACT").val();
var NBV=$(".NBV").val();
var NOE=$(".NOE").val();
var nCajas=$(".nCajas").val();
var nSobres=$(".nSobres").val();
var pesoKg=$(".pesoKg").val();
var PV=$(".PV").val();

var oc=$(".oc").val();
var plazoEntrega=$(".plazoEntrega").val();

console.log(oc);
console.log(plazoEntrega);

var  validercs=false;
if (nCajas!=""||nSobres!="") {
  validercs=true;
}
if (nCajas=="") {
  nCajas=0;
}
if (nSobres=="") {
  nSobres=0;
}

if (tmercaderia!="" && destinatario!="" && origen!="" && destino!="" && provrigen!="" && provdestino!="") {
  if (saveupdate=="save" || saveupdate=="update") {
  $(".detallecarga"+saveupdate).append('<tr id="trcargasave'+indexObjSolicitud+'"  ><td> #<span class="txttk'+indexObjSolicitud+'"></span> \
    <input type="hidden"  name="operation'+saveupdate+'" value="save">           \
     <input type="hidden"  name="idDetalleCarga'+saveupdate+'" value="0"> \
     <input type="hidden"  name="statuscarga'+saveupdate+'" value="1">\
        <input type="hidden"  name="token'+saveupdate+'" class="tkcaga'+indexObjSolicitud+'"> </td>\
    <td> <select name="idTypeMercaderia'+saveupdate+'"  class="inputtable idTypeMercaderia'+indexObjSolicitud+'"> </select>  \
    </td> <select name="idTypeMercaderia'+saveupdate+'"  class="inputtable idTypeMercaderia'+indexObjSolicitud+'"> </select> \
    <td><input type="text"  name="destinatario'+saveupdate+'" value="'+destinatario+'"  maxlength="50" class="inputtable"    onkeypress="return checkTotal(this,event);" required> \
    </td> \
 <td>  <select   class="inputtable provorigen-'+indexObjSolicitud+'" onchange="getDistritoTable(`'+"origen"+'`,'+indexObjSolicitud+')"> </select> </td>\
 <td>  <select  name="distritoorigen'+saveupdate+'" class="inputtable distorigen-'+indexObjSolicitud+'" required > </select>   </td> \
 <td>  <select   class="inputtable provdestino-'+indexObjSolicitud+'" onchange="getDistritoTable(`'+"destino"+'`,'+indexObjSolicitud+')"> </select> </td>\
  <td> <select  name="distritodestino'+saveupdate+'" class="inputtable distdestino-'+indexObjSolicitud+'" required> </select>  </td>\
  <td>  <input type="text" name="NGRR'+saveupdate+'" class="inputtable" maxlength="30"  value="'+NGRR+'"> \
       </td>\
       <td>  <input type="text" name="NFACT'+saveupdate+'" class="inputtable" maxlength="30"  value="'+NFACT+'" > \
       </td>\
     <td>  <input type="text" name="NBV'+saveupdate+'" class="inputtable"  value="'+NBV+'" maxlength="30" ></td>\
     <td> <input type="text" name="NOE'+saveupdate+'" class="inputtable" value="'+NOE+'" maxlength="30" ></td>      \
     <td> <input type="number" name="nCajas'+saveupdate+'" class="inputtable" min="0" max="9999999999"  value="'+nCajas+'"  data-maxlength="10" oninput="this.value=this.value.slice(0,this.dataset.maxlength)" ></td>   \
    <td> <input type="number" name="nSobres'+saveupdate+'" class="inputtable"  value="'+nSobres+'" min="0"   max="9999999999" data-maxlength="10" oninput="this.value=this.value.slice(0,this.dataset.maxlength)" >  \
</td>   <td>   <input type="number" name="pesoKg'+saveupdate+'" class="inputtable" step="any" value="'+pesoKg+'" min="1"  max="9999999999" data-maxlength="10" oninput="this.value=this.value.slice(0,this.dataset.maxlength)" ></td>\
<td>     <input type="number"  step="any" name="PV'+saveupdate+'" class="inputtable" value="'+PV+'"  max="9999999999" data-maxlength="10" oninput="this.value=this.value.slice(0,this.dataset.maxlength)" ></td> \
<td>     <input type="number"  step="any" name="oc'+saveupdate+'" class="inputtable" value="'+oc+'"  max="9999999999" data-maxlength="10" oninput="this.value=this.value.slice(0,this.dataset.maxlength)" ></td> \
<td>     <input type="date"   name="plazoEntrega'+saveupdate+'" value="'+plazoEntrega+'"  >\
</td>  \   <td><button type="button"  class="btn btn-danger  btn-sm " onclick="onDeleteCargaT1(`'+saveupdate+'`,'+indexObjSolicitud+')"><i class="fa  fa-trash fa-lg colorwhite"></i></button></td></tr>');
     var bandera=indexObjSolicitud;
    $.get(url+"ajax/"+ajax+".php", {tkdetalle:"yes",cmerc:tmercaderia,iddeporg:15,idprovorg:provrigen,iddepdest:15,idprovdest:provdestino,iddistrorg:origen,iddistrdest:destino}, function(respuesta){ 
var listadovf= JSON.parse(respuesta);
var tok=listadovf.token;
 $(".txttk"+bandera).text(tok);
  $(".tkcaga"+bandera).val(tok)
 var element=".idTypeMercaderia"+bandera; 
  $(element).html(listadovf.mercaderia);
  $(".provorigen-"+bandera).html(listadovf.provorig);
  $(".provdestino-"+bandera).html(listadovf.provdest);          
  $(".distorigen-"+bandera).html(listadovf.distorigen);
  $(".distdestino-"+bandera).html(listadovf.distdestino);
     });

  ccargaSolicitud++;
indexObjSolicitud++;
  }
//$(".tipodemercaderia").val("");
$(".NGRR").val("");
$(".NFACT").val("");
$(".NBV").val("");
$(".NOE").val("");
$(".nCajas").val("");
$(".nSobres").val("");
$(".pesoKg").val("");
$(".PV").val("");
$(".destinatario").val("");

}
else{
  new PNotify({
      title: 'Algo Salio Mal',
      text: 'Para añadir Complete los campos requeridos e intente nuevamente',
      type: 'error'
    });
}

}


 function onDeleteCargaT1(saveUpdate,index){
    var saveupdate=saveUpdate.trim();
    if (saveupdate=="save") {
          $("#trcargasave"+index).remove();
  ccargaSolicitud=ccargaSolicitud-1;
}
      if (saveupdate=="update") {
    $("#trcargaupdate"+index).remove();
  ccargaSolicitud=ccargaSolicitud-1;
     }  
    }

  function tableDetalleCarga(saveupdate) {
    var tableDataCarga = { tableDataCarga: [] };
    $(".detallecarga"+saveupdate+" tr").each(function() {
        var obj = {};
         obj.operacion = $(":input[name=operation"+saveupdate+"]", this).val();
         obj.idDetalleCarga =parseInt($(":input[name=idDetalleCarga"+saveupdate+"]", this).val());
                obj.token = $(":input[name=token"+saveupdate+"]", this).val();
        obj.tmercaderia = parseInt($(":input[name=idTypeMercaderia"+saveupdate+"]", this).val());
       obj.destinatario = $(":input[name=destinatario"+saveupdate+"]", this).val();
           obj.origen = parseInt($(":input[name=distritoorigen"+saveupdate+"]", this).val());
       obj.destino = parseInt($(":input[name=distritodestino"+saveupdate+"]", this).val());
       obj.NGRR = $(":input[name=NGRR"+saveupdate+"]", this).val();
       obj.NFACT=$(":input[name=NFACT"+saveupdate+"]", this).val();
       obj.NBV = $(":input[name=NBV"+saveupdate+"]", this).val();
       obj.NOE = $(":input[name=NOE"+saveupdate+"]", this).val();
       obj.nCajas = parseInt($(":input[name=nCajas"+saveupdate+"]", this).val());
       obj.nSobres = $(":input[name=nSobres"+saveupdate+"]", this).val();
       obj.pesoKg =parseFloat($(":input[name=pesoKg"+saveupdate+"]", this).val());
       obj.PV=parseFloat($(":input[name=PV"+saveupdate+"]", this).val());
        tableDataCarga.tableDataCarga.push(obj);
    });
    return JSON.stringify(tableDataCarga);
  }

var removeCarga=[];
   function onDeleteCargaT2(index){
var encry=$("#encry"+index).val();
     removeCarga.push({
    idremove:encry,
     operacion: "delete"
  });
  var convert=JSON.stringify(removeCarga);
$('.jsonDeleteCarga').val(convert); 
     $("#trcargaupdate"+index).remove();
  ccargaSolicitud=ccargaSolicitud-1;
   }

function addDetalleCargaT2(saveupdate){
var url=$("#url").val();
var ajax=$("#ajax").val();
var tmercaderia=$(".tipodemercaderia").val();
var departorigen=$('select[name="departamentoorigen"]').val();
var provrigen=$('select[name="provinciaorigen"]').val();
var origen=$('select[name="distritoorigen"]').val();
var destino=$('select[name="distritodestino"]').val();
var departdestino=$('select[name="departamentodestino"]').val();
var provdestino=$('select[name="provinciadestino"]').val();
var NGRR=$(".NGRR").val();
var NFACT=$(".NFACT").val();
var NBV=$(".NBV").val();
var NOE=$(".NOE").val();
var nCajas=$(".nCajas").val();
var nSobres=$(".nSobres").val();
var pesoKg=$(".pesoKg").val();
var PV=$(".PV").val();

  var secFAC=1;
var  validercs=false;
if (nCajas!=""||nSobres!="") {
  validercs=true;
}
if (nCajas=="") {
  nCajas=0;
}
if (nSobres=="") {
  nSobres=0;
}

if (tmercaderia!="" && departorigen!=""&& provrigen!="" && origen!="" && destino!="" &&departdestino!=""&&provdestino!="") {
  if (saveupdate=="save" || saveupdate=="update") {
  $(".detallecarga"+saveupdate).append('<tr id="trcargasave'+indexObjSolicitud+'"  ><td> #<span class="txttk'+indexObjSolicitud+'"></span>\
    <input type="hidden"  name="operation'+saveupdate+'" value="save">           \
     <input type="hidden"  name="idDetalleCarga'+saveupdate+'" value="0"> \
     <input type="hidden"  name="statuscarga'+saveupdate+'" value="1">\
     <input type="hidden"  name="destinatario'+saveupdate+'" > \
       <input type="hidden"  name="token'+saveupdate+'" class="tkcaga'+indexObjSolicitud+'"> </td>\
    <td>  <select name="idTypeMercaderia'+saveupdate+'"  class="inputtable idTypeMercaderia'+indexObjSolicitud+'" required> </select>  \
    </td>  \
        <td> <select   class="inputtable depaorigen-'+indexObjSolicitud+'" onchange="getProvinciaTable(`'+"origen"+'`,'+indexObjSolicitud+')"> </select> </td> \
 <td>  <select   class="inputtable provorigen-'+indexObjSolicitud+'" onchange="getDistritoTable(`'+"origen"+'`,'+indexObjSolicitud+')"> </select> </td>\
 <td>  <select  name="distritoorigen'+saveupdate+'" class="inputtable distorigen-'+indexObjSolicitud+'" required > </select>   </td> \
    <td> <select   class="inputtable depadestino-'+indexObjSolicitud+'" onchange="getProvinciaTable(`'+"destino"+'`,'+indexObjSolicitud+')"> </select> </td> \
 <td>  <select   class="inputtable provdestino-'+indexObjSolicitud+'" onchange="getDistritoTable(`'+"destino"+'`,'+indexObjSolicitud+')"> </select> </td>\
  <td> <select  name="distritodestino'+saveupdate+'" class="inputtable distdestino-'+indexObjSolicitud+'" required> </select>  </td>\
    <td>  <input type="text" name="NGRR'+saveupdate+'" class="inputtable" maxlength="30"  value="'+NGRR+'"   > \
       </td>\
           <td>  <input type="text" name="NFACT'+saveupdate+'" class="inputtable" maxlength="30"  value="'+NFACT+'" > \
       </td>\
     <td>  <input type="text" name="NBV'+saveupdate+'" class="inputtable"  value="'+NBV+'" maxlength="30" ></td>\
     <td> <input type="text" name="NOE'+saveupdate+'" class="inputtable" value="'+NOE+'" maxlength="30" ></td>      \
     <td> <input type="number" name="nCajas'+saveupdate+'" class="inputtable" min="0" max="9999999999"  value="'+nCajas+'"  data-maxlength="10" oninput="this.value=this.value.slice(0,this.dataset.maxlength)" ></td>   \
    <td> <input type="number" name="nSobres'+saveupdate+'" class="inputtable"  value="'+nSobres+'"  min="0"  max="9999999999" data-maxlength="10" oninput="this.value=this.value.slice(0,this.dataset.maxlength)" >  \
</td>   <td>   <input type="number" name="pesoKg'+saveupdate+'" class="inputtable" step="any" min="1"  value="'+pesoKg+'"  max="9999999999" data-maxlength="10" oninput="this.value=this.value.slice(0,this.dataset.maxlength)" ></td>\
<td>   <input type="number" step="any" name="PV'+saveupdate+'" class="inputtable" value="'+PV+'"  max="9999999999" data-maxlength="10" oninput="this.value=this.value.slice(0,this.dataset.maxlength)" >\
</td>  \   <td><button type="button"  class="btn btn-danger  btn-sm " onclick="onDeleteCargaT1(`'+saveupdate+'`,'+indexObjSolicitud+')"><i class="fa  fa-trash-o fa-lg colorwhite"></i></button></td></tr>');
     var bandera=indexObjSolicitud;
     $.get(url+"ajax/"+ajax+".php", {tkdetalle:"yes",cmerc:tmercaderia,iddeporg:departorigen,idprovorg:provrigen,iddepdest:departdestino,idprovdest:provdestino,iddistrorg:origen,iddistrdest:destino}, function(respuesta){ 
var listadovf= JSON.parse(respuesta);
var tok=listadovf.token;
 $(".txttk"+bandera).text(tok); $(".tkcaga"+bandera).val(tok)
 var element=".idTypeMercaderia"+bandera;  $(element).html(listadovf.mercaderia);
    $(".depaorigen-"+bandera).html(listadovf.depa);
   $(".depadestino-"+bandera).html(listadovf.depa);
     $(".depaorigen-"+bandera).val(departorigen);
     $(".depadestino-"+bandera).val(departdestino);
 $(".provorigen-"+bandera).html(listadovf.provorig);
       $(".provdestino-"+bandera).html(listadovf.provdest);
  $(".distorigen-"+bandera).html(listadovf.distorigen);
               $(".distdestino-"+bandera).html(listadovf.distdestino);

     });



  ccargaSolicitud++;
indexObjSolicitud++;
  }
//$(".tipodemercaderia").val("");       
$(".NGRR").val("");
$(".NFACT").val("");
$(".NBV").val("");
$(".NOE").val("");
$(".nCajas").val("");
$(".nSobres").val("");
$(".pesoKg").val("");
$(".PV").val("");
}
else{
  new PNotify({
      title: 'Algo Salio Mal',
      text: 'Para añadir Complete los campos requeridos e intente nuevamente',
      type: 'error'
    });
}


}
 function tableDetalleRadio(saveupdate) {
    var tableDataCarga = { tableDataCarga: [] };
    var index=0;
    $(".detallecarga"+saveupdate+" tr").each(function() {
        var obj = {};
         obj.idDetalleCarga =parseInt($(":input[name=idDetalleCarga"+saveupdate+"]", this).val());
        obj.ta =parseInt($(":input[name=ta"+saveupdate+index+"]:checked", this).val());

        tableDataCarga.tableDataCarga.push(obj);
        index++;
         obj.operacion = $(":input[name=operation"+saveupdate+"]", this).val();
    });
    
    return JSON.stringify(tableDataCarga);
}

function openSolicitud(encry,text){

var url=$("#url").val();
var ajax=$("#ajax").val();
$(".idTypeService").val(encry);
 typemd=encry;


getDocumentoSave(encry,ajax,url);
$(".tituloSave").text("Solicitud ("+text+")");
       $("#modalSolicitud").addClass("modal-block-full");       
          $.magnificPopup.open({
               items: {  src: '#modalSolicitud' },
               type: 'inline',
                preloader: true,
                modal: true
           });

   $(".mfp-bg").addClass("capa1");
$(".mfp-wrap").addClass('capa2');  
}

function elegirarea(el){ // recibimos por parametro el elemento select
  var direccion = $('option:selected', el).attr('data-adrres');
  $(".lugarRecojo").val(direccion);
    $(".dataRecojo").val(direccion);

}
function elegirareaupdate(){ // recibimos por parametro el elemento select
  var direccion =$('option:selected', '.areaupdate').attr('data-adrres');
  $(".lugarRecojo").val(direccion);
      $(".dataRecojo").val(direccion);

}

function elegirprov(el,tipo){
var url=$("#url").val();
var ajax="personalAjax";
 getProvinciaSolicitud(ajax,url,tipo);
}
function elegirdistri(el,tipo){
var url=$("#url").val();
var ajax="personalAjax";
 getDistritoSolicitud(ajax,url,tipo);
}

function getProvinciaSolicitud(ajax,url,tipo){
  $(".idDistrito").html("");
var idDepartamento=$('select[name="departamento'+tipo+'"]').val();
      
          $("#provincia"+tipo).select2("destroy");
      $("#provincia"+tipo).html("");
    $("#distrito"+tipo).select2("destroy");
      $("#distrito"+tipo).html("");
          $("#distrito"+tipo).select2({   width: '100%'  });

   $.get(url+"ajax/"+ajax+".php", {idDepartamento:idDepartamento,changeDepartamento:"changeDepartamento"}, function(respuesta){
               $("#provincia"+tipo).html(respuesta);
    $("#provincia"+tipo).select2({   width: '100%'  });
           
if(tipo=="destino"){
var val=$(".destinatario").val();

      var provincia = $("#datalist-destinatario").find('option[value="'+val+'"]').data('provincia');
provincia=provincia.trim();
  $("#provinciadestino option:contains("+provincia+")").attr('selected', true).trigger('change.select2');
}
     });
}

function getDistritoSolicitud(ajax,url,tipo){
var idProvincia=$('select[name="provincia'+tipo+'"]').val();
    $("#distrito"+tipo).select2("destroy");
      $("#distrito"+tipo).html("");
  //idDepartamento
   $.get(url+"ajax/"+ajax+".php", {idProvincia:idProvincia,changeProvincia:"changeProvincia"}, function(respuesta){
         $("#distrito"+tipo).html(respuesta);
    $("#distrito"+tipo).select2({   width: '100%'  });
if(tipo=="destino"){
var val=$(".destinatario").val();
 var distrito = $("#datalist-destinatario").find('option[value="'+val+'"]').data('distrito');
 distrito=distrito.trim();
$("#distritodestino option:contains("+distrito+")").attr('selected', true).trigger('change.select2');
}
      });
}
function getProvinciaTable(tipo,index){
var idDepartamento=$(".depa"+tipo+"-"+index).val();
var url=$("#url").val();
var ajax="solicitudAjax";
$(".dist"+tipo+"-"+index).html("");
  //idDepartamento
   $.get(url+"ajax/"+ajax+".php", {Depart:idDepartamento,Provincia:"",tableProv:"save"}, function(respuesta){
        $(".prov"+tipo+"-"+index).html(respuesta);            
     });
}

function getDistritoTable(tipo,index){
var idProvincia=$(".prov"+tipo+"-"+index).val();
var url=$("#url").val();
var ajax="solicitudAjax";
  //idDepartamento
   $.get(url+"ajax/"+ajax+".php", {Provincia:idProvincia,Distrito:"",tableDistri:"save"}, function(respuesta){
       $(".dist"+tipo+"-"+index).html(respuesta);                
     });
}

function elegirprovdest(el,tipo){
var url=$("#url").val();
var ajax="personalAjax";
 getProvinciaDest(ajax,url,tipo);
}
function getProvinciaDest(ajax,url,tipo){
  $("#provincia"+tipo).html("");
var idDepartamento=$('select[name="departamento'+tipo+'"]').val();
    

          $("#provincia"+tipo).select2("destroy");
      $("#provincia"+tipo).html("");
    $("#distrito"+tipo).select2("destroy");
      $("#distrito"+tipo).html("");
          $("#distrito"+tipo).select2({   width: '100%'  });

   $.get(url+"ajax/"+ajax+".php", {idDepartamento:idDepartamento,changeDepartamento:"changeDepartamento"}, function(respuesta){
               $("#provincia"+tipo).html(respuesta);
    $("#provincia"+tipo).select2({   width: '100%'  });
           
     });
}



function elegirdistridest(el,tipo){
var url=$("#url").val();
var ajax="personalAjax";
 getDistritoDest(ajax,url,tipo);
}
function getDistritoDest(ajax,url,tipo){
var idProvincia=$('select[name="provincia'+tipo+'"]').val();
    $("#distrito"+tipo).select2("destroy");
      $("#distrito"+tipo).html("");
   $.get(url+"ajax/"+ajax+".php", {idProvincia:idProvincia,changeProvincia:"changeProvincia"}, function(respuesta){
         $("#distrito"+tipo).html(respuesta);
    $("#distrito"+tipo).select2({width: '100%'});
      });
}

function verNotify(encry){
  var url=$("#url").val();
var ajax="navAjax";
var idElemento=encry;
var statu=1;
    $.get(url+"ajax/"+ajax+".php", {id:idElemento,btnActivaEliminar:"btnActivaEliminar",status:statu}, function(respuesta){
   $(".rNotify").html(respuesta);
            });
}

  var urlglobal2=$("#url").val();
  var optionsjdo = {
        ajax          : {
            url     : urlglobal2+"/ajax/busquedaAjax.php",
            type    : "GET",
            dataType: "json",
            data    : {
                q: "{{{q}}}",
                busq:"jdo"
            }
        },
       locale        : {
            emptyTitle: "Seleccione Jefe de Operaciones"
        },
       minLength:5,
cache:"true",
        log : 0,
        preprocessData: function (data) {
            var i, l = data.length, array = [];
            if (l) {
                for (i = 0; i < l; i++) {
                    array.push($.extend(true, data[i], {
                        text : data[i].text,
                        value: data[i].value
                    }));
                }
            }
            return array;
        }
    };
      var optionsclient = {
        ajax          : {
            url     : urlglobal2+"/ajax/busquedaAjax.php",
            type    : "GET",
            dataType: "json",
            data    : {
                q: "{{{q}}}",
                busq:"client"
            }
        },
       locale        : {
            emptyTitle: "Seleccione un Cliente"
        },
       minLength:3,
cache:"true",
        log : 0,
        preprocessData: function (data) {
            var i, l = data.length, array = [];
            if (l) {
                for (i = 0; i < l; i++) {
                    array.push($.extend(true, data[i], {
                        text : data[i].text,
                        value: data[i].value
                    }));
                }
            }
            return array;
        }
    };
    var optionsptlp = {
        ajax          : {
            url     : urlglobal2+"/ajax/busquedaAjax.php",
            type    : "GET",
            dataType: "json",
            data    : {
                q: "{{{q}}}",
                busq:"ptlp"
            }
        },
       locale        : {
            emptyTitle: "Seleccione un PTLP"
        },
       minLength:5,
cache:"true",
        log : 0,
        preprocessData: function (data) {
            var i, l = data.length, array = [];
            if (l) {
                for (i = 0; i < l; i++) {
                    array.push($.extend(true, data[i], {
                        text : data[i].text,
                        value: data[i].value
                    }));
                }
            }
            return array;
        }
    };
      var optionsptlp2 = {
        ajax          : {
            url     : urlglobal2+"/ajax/busquedaAjax.php",
            type    : "GET",
            dataType: "json",
            data    : {
                q: "{{{q}}}",
                busq:"ptlp2"
            }
        },
       locale        : {
            emptyTitle: "Seleccione un PTLP2"
        },
       minLength:5,
cache:"true",
        log : 0,
        preprocessData: function (data) {
            var i, l = data.length, array = [];
            if (l) {
                for (i = 0; i < l; i++) {
                    array.push($.extend(true, data[i], {
                        text : data[i].text,
                        value: data[i].value
                    }));
                }
            }
            return array;
        }
    };

      var optionschofer= {
        ajax          : {
            url     : urlglobal2+"/ajax/busquedaAjax.php",
            type    : "GET",
            dataType: "json",
            data    : {
                q: "{{{q}}}",
                busq:"chofer"
            }
        },
       locale        : {
            emptyTitle: "Seleccione un Chofer"
        },
       minLength:3,
cache:"true",
        log : 0,
        preprocessData: function (data) {
            var i, l = data.length, array = [];
            if (l) {
                for (i = 0; i < l; i++) {
                    array.push($.extend(true, data[i], {
                        text : data[i].text,
                        value: data[i].value
                    }));
                }
            }
            return array;
        }
    };

        var optionsoperador= {
        ajax          : {
            url     : urlglobal2+"/ajax/busquedaAjax.php",
            type    : "GET",
            dataType: "json",
            data    : {
                q: "{{{q}}}",
                busq:"operador"
            }
        },
       locale        : {
            emptyTitle: "Seleccione un Operador"
        },
       minLength:5,
cache:"true",
        log : 0,
        preprocessData: function (data) {
            var i, l = data.length, array = [];
            if (l) {
                for (i = 0; i < l; i++) {
                    array.push($.extend(true, data[i], {
                        text : data[i].text,
                        value: data[i].value
                    }));
                }
            }
            return array;
        }
    };
     var optionsplaca= {
        ajax          : {
            url     : urlglobal2+"/ajax/busquedaAjax.php",
            type    : "GET",
            dataType: "json",
            data    : {
                q: "{{{q}}}",
                busq:"placa"
            }
        },
       locale        : {
            emptyTitle: "Seleccione una Placa"
        },
       minLength:3,
cache:"true",
        log : 0,
        preprocessData: function (data) {
            var i, l = data.length, array = [];
            if (l) {
                for (i = 0; i < l; i++) {
                    array.push($.extend(true, data[i], {
                        text : data[i].text,
                        value: data[i].value
                    }));
                }
            }
            return array;
        }
    };


    var optionscda= {
        ajax          : {
            url     : urlglobal2+"/ajax/busquedaAjax.php",
            type    : "GET",
            dataType: "json",
            data    : {
                q: "{{{q}}}",
                busq:"cda"
            }
        },
       locale        : {
            emptyTitle: "Seleccione un Coordinador de Almacen"
        },
       minLength:3,
cache:"true",
        log : 0,
        preprocessData: function (data) {
            var i, l = data.length, array = [];
            if (l) {
                for (i = 0; i < l; i++) {
                    array.push($.extend(true, data[i], {
                        text : data[i].text,
                        value: data[i].value
                    }));
                }
            }
            return array;
        }
    };

     var optionsproveedor= {
        ajax          : {
            url     : urlglobal2+"/ajax/busquedaAjax.php",
            type    : "GET",
            dataType: "json",
            data    : {
                q: "{{{q}}}",
                busq:"proveedor"
            }
        },
       locale        : {
            emptyTitle: "Seleccione un Proveedor"
        },
       minLength:3,
cache:"true",
        log : 0,
        preprocessData: function (data) {
            var i, l = data.length, array = [];
            if (l) {
                for (i = 0; i < l; i++) {
                    array.push($.extend(true, data[i], {
                        text : data[i].text,
                        value: data[i].value
                    }));
                }
            }
            return array;
        }
    };



     var view=$("#view").val();

 if (view=="solicitud") {
  $("#labbusq").selectpicker();
      $(".idcIni").selectpicker().filter(".with-ajaxclient").ajaxSelectPicker(optionsclient);
 $(".idcIni").on('keydown', function ( event ) {
    if (event.keyCode === 13) {
        // Do not submit form on pressing enter
        return false;
    }
});
 }
 if (view=="remision") {
$(".choferupdate").selectpicker();

$(".chofersave").selectpicker();
$(".idplacasave").selectpicker();
$(".idplacaupdate").selectpicker();
$(".idClientupdate").selectpicker();

$(".idClientsave").selectpicker();
$("#labbusq").selectpicker();


    $(".productsavebusq").selectpicker();
$(".destinatario").selectpicker();


}

if (view=="remisiontransp") {
   $(".choferupdate").selectpicker();
$("#labbusq").selectpicker();
   $(".idplacaupdate").selectpicker();
   $(".destinatario").selectpicker();
}
 
 
if (view=="manifiesto") {
  $(".chofsave").selectpicker();
    $(".operadorsave").selectpicker();
  $(".idCarriersave").selectpicker();
    $(".idProvidersave").selectpicker();
        $(".idplacasave").selectpicker();
        $(".cdasave").selectpicker();
if( /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent) ) {
   $(".chofsave").selectpicker();
    $(".chofupdate").selectpicker();
    $(".operadorsave").selectpicker();
      $(".operadorsupdate").selectpicker();
  $(".idCarriersave").selectpicker();
    $(".idCarrierupdate").selectpicker();
    $(".idProvidersave").selectpicker();
    $(".idProviderupdate").selectpicker();
 $(".idplacasave").selectpicker();
    $(".idplacaupdate").selectpicker();
 $(".ptlpsave").selectpicker();
    $(".ptlpupdate").selectpicker();
}


}



 if (view=="product") {
      $("#labbusq").selectpicker().filter(".with-ajaxclient").ajaxSelectPicker(optionsclient);
 $("#labbusq").on('keydown', function ( event ) {
    if (event.keyCode === 13) {
        // Do not submit form on pressing enter
        return false;
    }
});

 $("#selectsave").selectpicker().filter(".with-ajaxclient").ajaxSelectPicker(optionsclient);
 $("#selectsave").on('keydown', function ( event ) {
    if (event.keyCode === 13) {
        // Do not submit form on pressing enter
        return false;
    }
});
 $("#selectupdate").selectpicker().filter(".with-ajaxclient").ajaxSelectPicker(optionsclient);
 $("#selectupdate").on('keydown', function ( event ) {
    if (event.keyCode === 13) {
        // Do not submit form on pressing enter
        return false;
    }
});
 }

///////////////// buscador
 function onReloadListBuscador(ajax,pagina,tipo,url){
    var txtBusqueda = $(".inputBuscar").val();


    $(".paginado").css("display","none");
        $(".loading").html('<i class="fa fa-spinner fa-spin fa-2x fa-fw"></i>');
             $.get(url+"ajax/"+ajax+".php", {pag: pagina,reg: 10,pri:tipo,cod:txtBusqueda}, function(respuesta){
               $(".bd1").html(respuesta);
            })
        }        

  //manifiesto
 function rellEditManifiesto(data){
var url=$("#url").val();
var ajax=$("#ajax").val();
console.clear();
     var ms=$(".princiupdate");
 $(".mfp-bg").addClass("capa1");
$(".mfp-wrap").addClass('capa2');  
$(".validerCargaupdate").val("yes");
  $("#modalEditForm").addClass("modal-block-full");
//cdocumentS=indezadj;
//indexobject=indezadj;
//$(".adjuntosDocupdate").html(adjuntos)
var fase=0;
var encrymf="";
$.each(data, function( i, item ) {
        $("."+i).val(item);
        if (i=="idManifiesto") {
          encrymf=item;
        }
        if (i=="idFaseNext") {
          fase=item;
        }
       });  
   $.get(url+"ajax/"+ajax+".php", {changeDocument:"save",encryMF:encrymf,encryf:fase}, function(respuesta){          
ms.html(respuesta);
  $('[data-plugin-timepicker]').each(function() {
        var $this = $( this ),  opts = {};
        var pluginOptions = $this.data('plugin-options');
        if (pluginOptions)
          opts = pluginOptions;
        $this.themePluginTimePicker(opts);
      });

  $('[data-plugin-datepicker]').each(function() {
        var $this = $( this ),
          opts = {};
        var pluginOptions = $this.data('plugin-options');
        if (pluginOptions)
          opts = pluginOptions;
        $this.themePluginDatePicker(opts);
      });
     });

  $.magnificPopup.open({
               items: {   src: '#modalEditForm'   },
               type: 'inline',
                preloader: true,
                modal: true
           });
}


function addAdjuntosManifest(saveUpdate){
      var saveupdate=saveUpdate.trim();
  var verific=$('.imgClass1').val();
  var tituloadj=$('.document').val();
  var numerodoc=$('.numeroDoc').val();
var validerarch=true;
  if (verific!="" && tituloadj!=""&& numerodoc!="") {
 var filesadj = $('.imgClass1')[0].files[0];
              for (var i = 0; i < arrayadj.length; i++) {
             var nombrearchivo=filesadj.name;
            if (arrayadj[i].name==nombrearchivo) {    validerarch=false;     }  }                
              arrayadj[cdocumentU]=$('.imgClass1')[0].files[0];
            var typedileadj=filesadj.type;
           var fichadj=filesadj.name;
          if (validerarch) {
                    if (saveupdate=="save") {
  $(".adjuntosDoc"+saveupdate).append('<tr id="tradjsave'+indexobject+'"  ><td>#<input type="hidden"  name="operation'+saveupdate+'" value="save"><input type="hidden"  name="idadj'+saveupdate+'" value="0"></td><td><input type="text" class="form-control" name="tile'+saveupdate+'" value="'+tituloadj+'" maxlength="80"   onkeypress="return checkTotal(this,event)" required></td> <td> <input type="number" name="numerodoc'+saveupdate+'" class="inputtable" min="1" max="9999999999"  value="'+numerodoc+'"  data-maxlength="10" oninput="this.value=this.value.slice(0,this.dataset.maxlength)" required ></td>   <td> '+fichadj+' </td> <td><button type="button" href="#!" class="btn btn-danger  btn-sm " onclick="onDeleteAdj(`'+saveupdate+'`,'+indexobject+',`'+fichadj+'`)"><i class="fa  fa-trash-o fa-lg colorwhite"></i></button></td></tr>');
  cdocumentS++;
  indexobject++;
  cdocumentU=cdocumentU+1;
  }
if (saveupdate=="update") {
    $(".adjuntosDoc"+saveupdate).append('<tr id="tradjupdate'+indexobject+'"  ><td>#<input type="hidden"  name="operation'+saveupdate+'" value="save"><input type="hidden"  name="idadj'+saveupdate+'" value="0"></td><td><input type="text" class="form-control" name="tile'+saveupdate+'" value="'+tituloadj+'" maxlength="80"   onkeypress="return checkTotal(this,event)" required></td> <td> <input type="number" name="numerodoc'+saveupdate+'" class="inputtable" min="1" max="9999999999"  value="'+numerodoc+'"  data-maxlength="10" oninput="this.value=this.value.slice(0,this.dataset.maxlength)" required ></td>  <td> '+fichadj+' </td> <td><button type="button" href="#!" class="btn btn-danger  btn-sm " onclick="onDeleteAdj(`'+saveupdate+'`,'+indexobject+',`'+fichadj+'`)"><i class="fa  fa-trash-o fa-lg colorwhite"></i></button></td></tr>');
  cdocumentS++;
    indexobject++;
      cdocumentU=cdocumentU+1;
}

   $('.imgClass1').val("");
$('.document').val("");
$('.numeroDoc').val("");
          }
  } 
else{
  new PNotify({
      title: 'Algo Salio Mal',
      text: 'El archivo ya existe en el sistema, por favor registre con otro archivo',
      type: 'error'
    });
}
  
}

 function tableManifestAdjuntos(saveupdate) {
    var tableDataAdj = { tableDataAdj: [] };
    $(".adjuntosDoc"+saveupdate+" tr").each(function() {
        var obj = {};
         obj.operacion = $(":input[name=operation"+saveupdate+"]", this).val();
         obj.indexadj = parseInt($(":input[name=idadj"+saveupdate+"]", this).val());
        obj.titulo = $(":input[name=tile"+saveupdate+"]", this).val();
        obj.numero = $(":input[name=numerodoc"+saveupdate+"]", this).val();
        tableDataAdj.tableDataAdj.push(obj);
    });
    return JSON.stringify(tableDataAdj);
}

 function tableDetalleMaanifest(saveupdate) {
    var tableDataCarga = { tableDataCarga: [] };
    $(".detallemanifiest"+saveupdate+" tr").each(function() {
        var obj = {};
         obj.operacion = $(":input[name=operation]", this).val();
    obj.idDetalleCarga =parseInt($(":input[name=idDetalleCargaupdate]", this).val());
       obj.remitente = $(":input[name=remitenteupdate]", this).val();
      obj.isTipo = parseInt($(":input[name=isTipoupdate]", this).val());
      obj.serieC  = $(":input[name=serieCupdate]", this).val();
      obj.numeroC  = $(":input[name=numeroCupdate]", this).val();
       obj.destinatario = $(":input[name=destinatarioupdate]", this).val();
      obj.nPiezas  = $(":input[name=nPiezasupdate]", this).val();
              obj.SD = parseInt($(":input[name=SDupdate]", this).val());
        tableDataCarga.tableDataCarga.push(obj);
    });    
    return JSON.stringify(tableDataCarga);
}

function getDetallemanifest(tipo){
var url=$("#url").val();
var ajax="manifiestoAjax";
var idorigen=$("#origen"+tipo).val();
var iddestino=$("#destino"+tipo).val();
var ta=0;
var modalidad=$(".ismodalidad"+tipo).val();
if ($("input[name='ta']:radio").is(':checked')) {
   ta= $('input:radio[name=ta]:checked').val();
}

if (idorigen!="" && iddestino!="") {
var depa=$("#destino"+tipo).find('option:selected').attr('data-depa');
   $.get(url+"ajax/"+ajax+".php", {origen:idorigen,destino:iddestino,via:ta,ismodalidad:modalidad,iddepa:depa,operacion:tipo,
    changueDetalleManifest:"yes"}, function(respuesta){
       var dataObj =  JSON.parse(respuesta);
     $(".detallemanifiest"+tipo).html(dataObj.dat1);                            
     $(".validerCarga"+tipo).val(dataObj.data2);
       $(".inputscargos"+tipo).html(dataObj.inputs);
$('.idProvidersave  option').each(function() {
   var valpro=$(this).val();
    if ($(this).attr('data-distrito')==iddestino){
  $(".idProvidersave").val(valpro).trigger('change');
    }
});
     });
}

else{
  $(".detallemanifiest"+tipo).html("");
          $(".validerCarga"+tipo).val("not");
                 $(".inputscargos"+tipo).html("");

} 


}
//registro act
 function listarActividad(ajax,url){
           var mes= $('#mes').val();
 var fechab1=$("#fechab1").val();
          var fechab2=$("#fechab2").val();

          var año=$("#añoact").val();
var texto="";

if (fechab1!="") {
  texto=fechab1;
}
if (fechab2!="") {
  texto=fechab2;
}
if (fechab1!="" && fechab2!="") {
  texto=fechab1+" - "+fechab2;
}
if (mes!=0) {
       var select_text = $("#mes option:selected").text();
           var anio = (new Date).getFullYear();

texto=select_text+" "+anio;
}
if (año!="") {

  texto=año;
}



        $(".loading").html(' <li><i class="fa fa-spinner fa-spin fa-2x fa-fw"></i></li>');
  $.get(url+"ajax/"+ajax+".php", {act:"yes",mesAct:mes,añoAct:año,fecha1:fechab1,fecha2:fechab2}, function(respuesta){
              $(".txtpers").text(texto);
               $(".bd1").html(respuesta);
            })
        }
//solicitud actualizacion

  function rellEditSolicitudEdit (data,idfase,statuserv,idtype,txtS,textF){
var url=$("#url").val();
var ajax=$("#ajax").val();
console.clear();
  
         var ms=$(".mockup-principalupdateRecup");
var idTypeService=idtype;
 var typemd=idTypeService;
var idFaseTypeService=idfase;
var status=statuserv;
var c=0, idClient=0,idSolicitudService=0;
         $.each(data, function( i, item ) {
        $("."+i).val(item);
                  $(".cargaIB1").val("0");
        $('select[name='+i+']').val(item);
     // console.log("variables "+i + "-->"+item);
        
   if (i=="idClient") {idClient=item; }
  if (i=="idContactoCliente") {c=item;}
  if (i=="idSolicitudService") {idSolicitudService=item;}
       });
$(".idFaseTypeService").val(idFaseTypeService);
$(".statusfase").val(status);
        $(".tituloFase").text(txtS+" ( "+textF+" )");
    //$.get(url+"ajax/"+ajax+".php", {encryCl:idClient,paintClient:"save"}, function(respuesta){    
     //   $(".auto-complete-Clientupdate").html(respuesta);  

     //});
 
 //encaso de mantenimiento  console.log("idfase "+idFaseTypeService +" -- idTypeService "+idTypeService +"-- status "+status); 
 $("#ModalEjemplo").addClass("modal-block-full");       
          $.magnificPopup.open({
               items: {  src: '#ModalEjemplo' },
               type: 'inline',
                preloader: true,
                modal: true
           });


if (status==0) {
  $(".txt-S").text('Confirmar');
   if(idFaseTypeService==3 || idFaseTypeService==8 || idFaseTypeService==12  || idFaseTypeService==15 || idFaseTypeService==19 || idFaseTypeService==22){    
var f=1;
   $.get(url+"ajax/"+ajax+".php", {idTypeService:idTypeService,changeDocument:"update",encryD:idSolicitudService,faseindex:f,encryf:idFaseTypeService,status:status},function(respuesta){          
        ms.html(respuesta); 
        $('[data-plugin-timepicker]').each(function() {
        var $this = $( this ),  opts = {};
        var pluginOptions = $this.data('plugin-options');
        if (pluginOptions)
          opts = pluginOptions;
        $this.themePluginTimePicker(opts);
      });

  $('[data-plugin-datepicker]').each(function() {
        var $this = $( this ),
          opts = {};
        var pluginOptions = $this.data('plugin-options');
        if (pluginOptions)
          opts = pluginOptions;
        $this.themePluginDatePicker(opts);
      });
          $('[data-plugin-selectTwo]').each(function() {
        var $this = $( this ),
          opts = {};
        var pluginOptions = $this.data('plugin-options');
        if (pluginOptions)
          opts = pluginOptions;
        $this.themePluginSelect2(opts);
      });    
     });

}
if (idFaseTypeService==4 || idFaseTypeService==9   || idFaseTypeService==16 ) {
var f=2;
   $.get(url+"ajax/"+ajax+".php", {idTypeService:idTypeService,changeDocument:"update",encryD:idSolicitudService,faseindex:f,encryf:idFaseTypeService,status:status}, function(respuesta){          
ms.html(respuesta);
$('[data-plugin-timepicker]').each(function() {
        var $this = $( this ),  opts = {};
        var pluginOptions = $this.data('plugin-options');
        if (pluginOptions)
          opts = pluginOptions;
        $this.themePluginTimePicker(opts);
      });

  $('[data-plugin-datepicker]').each(function() {
        var $this = $( this ),
          opts = {};
        var pluginOptions = $this.data('plugin-options');
        if (pluginOptions)
          opts = pluginOptions;
        $this.themePluginDatePicker(opts);
      });
  $('[data-plugin-selectTwo]').each(function() {
        var $this = $( this ),
          opts = {};
        var pluginOptions = $this.data('plugin-options');
        if (pluginOptions)
          opts = pluginOptions;
        $this.themePluginSelect2(opts);
      });
     });
}
if (idFaseTypeService==5 || idFaseTypeService==10)    {
var f=3;
   $.get(url+"ajax/"+ajax+".php", {idTypeService:idTypeService,changeDocument:"update",encryD:idSolicitudService,faseindex:f,encryf:idFaseTypeService,status:status}, function(respuesta){          
ms.html(respuesta);
  $('[data-plugin-timepicker]').each(function() {
        var $this = $( this ),  opts = {};
        var pluginOptions = $this.data('plugin-options');
        if (pluginOptions)
          opts = pluginOptions;
        $this.themePluginTimePicker(opts);
      });
 $('[data-plugin-selectTwo]').each(function() {
        var $this = $( this ),
          opts = {};
        var pluginOptions = $this.data('plugin-options');
        if (pluginOptions)
          opts = pluginOptions;
        $this.themePluginSelect2(opts);
      });

 ccargaSolicitud=parseInt($(".jsonindex").val());
 indexObjSolicitud=parseInt($(".jsonindex").val());
     });


}
if (idFaseTypeService==13 || idFaseTypeService==20 || idFaseTypeService==23) {
 var f=3;
   $.get(url+"ajax/"+ajax+".php", {idTypeService:idTypeService,changeDocument:"update",encryD:idSolicitudService,faseindex:f,encryf:idFaseTypeService,status:status}, function(respuesta){          
ms.html(respuesta);
  $('[data-plugin-timepicker]').each(function() {
        var $this = $( this ),  opts = {};
        var pluginOptions = $this.data('plugin-options');
        if (pluginOptions)
          opts = pluginOptions;
        $this.themePluginTimePicker(opts);
      });

  $('[data-plugin-datepicker]').each(function() {
        var $this = $( this ),
          opts = {};

        var pluginOptions = $this.data('plugin-options');
        if (pluginOptions)
          opts = pluginOptions;

        $this.themePluginDatePicker(opts);
      });

   $('[data-plugin-selectTwo]').each(function() {
        var $this = $( this ),
          opts = {};

        var pluginOptions = $this.data('plugin-options');
        if (pluginOptions)
          opts = pluginOptions;

        $this.themePluginSelect2(opts);
      });

 ccargaSolicitud=parseInt($(".jsonindex").val());
 indexObjSolicitud=parseInt($(".jsonindex").val());
     });

}
if (idFaseTypeService==17) {
 var f=3;
   $.get(url+"ajax/"+ajax+".php", {idTypeService:idTypeService,changeDocument:"update",encryD:idSolicitudService,faseindex:f,encryf:idFaseTypeService,status:status}, function(respuesta){          
ms.html(respuesta);
  $('[data-plugin-timepicker]').each(function() {
        var $this = $( this ),  opts = {};
        var pluginOptions = $this.data('plugin-options');
        if (pluginOptions)
          opts = pluginOptions;
        $this.themePluginTimePicker(opts);
      });

  $('[data-plugin-datepicker]').each(function() {
        var $this = $( this ),
          opts = {};
        var pluginOptions = $this.data('plugin-options');
        if (pluginOptions)
          opts = pluginOptions;
        $this.themePluginDatePicker(opts);
      });
 $('[data-plugin-selectTwo]').each(function() {
        var $this = $( this ),
          opts = {};
        var pluginOptions = $this.data('plugin-options');
        if (pluginOptions)
          opts = pluginOptions;
        $this.themePluginSelect2(opts);
      });
 ccargaSolicitud=parseInt($(".jsonindex").val());
 indexObjSolicitud=parseInt($(".jsonindex").val());

     });


}

if(idFaseTypeService==6 ){ 

var f=4;
   $.get(url+"ajax/"+ajax+".php", {idTypeService:idTypeService,changeDocument:"update",encryD:idSolicitudService,faseindex:f,encryf:idFaseTypeService,status:status}, function(respuesta){          
ms.html(respuesta);
   $('[data-plugin-selectTwo]').each(function() {
        var $this = $( this ),
          opts = {};

        var pluginOptions = $this.data('plugin-options');
        if (pluginOptions)
          opts = pluginOptions;

        $this.themePluginSelect2(opts);
      });

$('[data-plugin-timepicker]').each(function() {
        var $this = $( this ),  opts = {};
        var pluginOptions = $this.data('plugin-options');
        if (pluginOptions)
          opts = pluginOptions;
        $this.themePluginTimePicker(opts);
      });

  $('[data-plugin-datepicker]').each(function() {
        var $this = $( this ),
          opts = {};

        var pluginOptions = $this.data('plugin-options');
        if (pluginOptions)
          opts = pluginOptions;

        $this.themePluginDatePicker(opts);
      });


     });
}
if(idFaseTypeService==11 || idFaseTypeService==18|| idFaseTypeService==21  || idFaseTypeService==14  || idFaseTypeService==24){ 
       

var f=4;
   $.get(url+"ajax/"+ajax+".php", {idTypeService:idTypeService,changeDocument:"update",encryD:idSolicitudService,faseindex:f,encryf:idFaseTypeService,status:status}, function(respuesta){          
ms.html(respuesta);
  $('[data-plugin-timepicker]').each(function() {
        var $this = $( this ),  opts = {};
        var pluginOptions = $this.data('plugin-options');
        if (pluginOptions)
          opts = pluginOptions;
        $this.themePluginTimePicker(opts);
      });

  $('[data-plugin-datepicker]').each(function() {
        var $this = $( this ),
          opts = {};

        var pluginOptions = $this.data('plugin-options');
        if (pluginOptions)
          opts = pluginOptions;

        $this.themePluginDatePicker(opts);
      });


     });
}
if(idFaseTypeService==7){ 
var f=5;
   $.get(url+"ajax/"+ajax+".php", {idTypeService:idTypeService,changeDocument:"update",encryD:idSolicitudService,faseindex:f,encryf:idFaseTypeService,status:status}, function(respuesta){          
ms.html(respuesta);
  $('[data-plugin-timepicker]').each(function() {
        var $this = $( this ),  opts = {};
        var pluginOptions = $this.data('plugin-options');
        if (pluginOptions)
          opts = pluginOptions;
        $this.themePluginTimePicker(opts);
      });

  $('[data-plugin-datepicker]').each(function() {
        var $this = $( this ),
          opts = {};

        var pluginOptions = $this.data('plugin-options');
        if (pluginOptions)
          opts = pluginOptions;

        $this.themePluginDatePicker(opts);
      });


     });
}


}
if (status==1) {
  $(".txt-S").text('Guardar');
 if(idFaseTypeService==3 || idFaseTypeService==8   || idFaseTypeService==15 ){    
var f=1;
   $.get(url+"ajax/"+ajax+".php", {idTypeService:idTypeService,changeDocument:"save",encryD:idSolicitudService,faseindex:f,encryf:idFaseTypeService,status:status}, function(respuesta){          
ms.html(respuesta);
  $('[data-plugin-selectTwo]').each(function() {
        var $this = $( this ),
          opts = {};

        var pluginOptions = $this.data('plugin-options');
        if (pluginOptions)
          opts = pluginOptions;

        $this.themePluginSelect2(opts);
      });
     });

$('[data-plugin-timepicker]').each(function() {
        var $this = $( this ),  opts = {};
        var pluginOptions = $this.data('plugin-options');
        if (pluginOptions)
          opts = pluginOptions;
        $this.themePluginTimePicker(opts);
      });

  $('[data-plugin-datepicker]').each(function() {
        var $this = $( this ),
          opts = {};

        var pluginOptions = $this.data('plugin-options');
        if (pluginOptions)
          opts = pluginOptions;
        $this.themePluginDatePicker(opts);
      });

}

if (idFaseTypeService==4 || idFaseTypeService==9)    {
var f=3;
   $.get(url+"ajax/"+ajax+".php", {idTypeService:idTypeService,changeDocument:"save",encryD:idSolicitudService,faseindex:f,encryf:idFaseTypeService,status:status}, function(respuesta){          
ms.html(respuesta);
  $('[data-plugin-timepicker]').each(function() {
        var $this = $( this ),  opts = {};
        var pluginOptions = $this.data('plugin-options');
        if (pluginOptions)
          opts = pluginOptions;
        $this.themePluginTimePicker(opts);
      });
 $('[data-plugin-selectTwo]').each(function() {
        var $this = $( this ),
          opts = {};

        var pluginOptions = $this.data('plugin-options');
        if (pluginOptions)
          opts = pluginOptions;

        $this.themePluginSelect2(opts);
      });

     });


}
if (idFaseTypeService==12 || idFaseTypeService==19 || idFaseTypeService==22) {
 var f=3;
   $.get(url+"ajax/"+ajax+".php", {idTypeService:idTypeService,changeDocument:"save",encryD:idSolicitudService,faseindex:f,encryf:idFaseTypeService,status:status}, function(respuesta){          
ms.html(respuesta);
  $('[data-plugin-timepicker]').each(function() {
        var $this = $( this ),  opts = {};
        var pluginOptions = $this.data('plugin-options');
        if (pluginOptions)
          opts = pluginOptions;
        $this.themePluginTimePicker(opts);
      });

  $('[data-plugin-datepicker]').each(function() {
        var $this = $( this ),
          opts = {};

        var pluginOptions = $this.data('plugin-options');
        if (pluginOptions)
          opts = pluginOptions;

        $this.themePluginDatePicker(opts);
      });

 $('[data-plugin-selectTwo]').each(function() {
        var $this = $( this ),
          opts = {};
        var pluginOptions = $this.data('plugin-options');
        if (pluginOptions)
          opts = pluginOptions;
        $this.themePluginSelect2(opts);
      });

     });

}

if (idFaseTypeService==16) {
 var f=3;
   $.get(url+"ajax/"+ajax+".php", {idTypeService:idTypeService,changeDocument:"save",encryD:idSolicitudService,faseindex:f,encryf:idFaseTypeService,status:status}, function(respuesta){          
ms.html(respuesta);
  $('[data-plugin-timepicker]').each(function() {
        var $this = $( this ),  opts = {};
        var pluginOptions = $this.data('plugin-options');
        if (pluginOptions)
          opts = pluginOptions;
        $this.themePluginTimePicker(opts);
      });

  $('[data-plugin-datepicker]').each(function() {
        var $this = $( this ),
          opts = {};
        var pluginOptions = $this.data('plugin-options');
        if (pluginOptions)
          opts = pluginOptions;
        $this.themePluginDatePicker(opts);
      });

   $('[data-plugin-selectTwo]').each(function() {
        var $this = $( this ),
          opts = {};
        var pluginOptions = $this.data('plugin-options');
        if (pluginOptions)
          opts = pluginOptions;
        $this.themePluginSelect2(opts);
      });


     });


}
if(idFaseTypeService==5 ){ 

var f=4;
   $.get(url+"ajax/"+ajax+".php", {idTypeService:idTypeService,changeDocument:"save",encryD:idSolicitudService,faseindex:f,encryf:idFaseTypeService,status:status}, function(respuesta){          
ms.html(respuesta);
   $('[data-plugin-selectTwo]').each(function() {
        var $this = $( this ),
          opts = {};
        var pluginOptions = $this.data('plugin-options');
        if (pluginOptions)
          opts = pluginOptions;

        $this.themePluginSelect2(opts);
      });
   $('[data-plugin-timepicker]').each(function() {
        var $this = $( this ),  opts = {};
        var pluginOptions = $this.data('plugin-options');
        if (pluginOptions)
          opts = pluginOptions;
        $this.themePluginTimePicker(opts);
      });

  $('[data-plugin-datepicker]').each(function() {
        var $this = $( this ),
          opts = {};
        var pluginOptions = $this.data('plugin-options');
        if (pluginOptions)
          opts = pluginOptions;
        $this.themePluginDatePicker(opts);
      });


     });
}
if(idFaseTypeService==10 || idFaseTypeService==17 || idFaseTypeService==20  || idFaseTypeService==13 || idFaseTypeService==23){ 
      
var f=4;
   $.get(url+"ajax/"+ajax+".php", {idTypeService:idTypeService,changeDocument:"save",encryD:idSolicitudService,faseindex:f,encryf:idFaseTypeService,status:status}, function(respuesta){          
ms.html(respuesta);
  $('[data-plugin-timepicker]').each(function() {
        var $this = $( this ),  opts = {};
        var pluginOptions = $this.data('plugin-options');
        if (pluginOptions)
          opts = pluginOptions;
        $this.themePluginTimePicker(opts);
      });

  $('[data-plugin-datepicker]').each(function() {
        var $this = $( this ),
          opts = {};
        var pluginOptions = $this.data('plugin-options');
        if (pluginOptions)
          opts = pluginOptions;
        $this.themePluginDatePicker(opts);
      });


     });
}
if(idFaseTypeService==6){ 
var f=5;
   $.get(url+"ajax/"+ajax+".php", {idTypeService:idTypeService,changeDocument:"save",encryD:idSolicitudService,faseindex:f,encryf:idFaseTypeService,status:status}, function(respuesta){          
ms.html(respuesta);
  $('[data-plugin-timepicker]').each(function() {
        var $this = $( this ),  opts = {};
        var pluginOptions = $this.data('plugin-options');
        if (pluginOptions)
          opts = pluginOptions;
        $this.themePluginTimePicker(opts);
      });

  $('[data-plugin-datepicker]').each(function() {
        var $this = $( this ),
          opts = {};
        var pluginOptions = $this.data('plugin-options');
        if (pluginOptions)
          opts = pluginOptions;
        $this.themePluginDatePicker(opts);
      });

     });
}



}
 $(".mfp-bg").addClass("capa1"); $("#ModalEjemplo").addClass("modal-block-full");       

$(".mfp-wrap").addClass('capa2');        
}

 //manifiesto
 function recupEditManifiesto(data){
var url=$("#url").val();
var ajax=$("#ajax").val();
console.clear();
     var ms=$(".princiupdate");
 $(".mfp-bg").addClass("capa1");
$(".mfp-wrap").addClass('capa2');  
$(".validerCargaupdate").val("yes");
  $("#modalEditForm").addClass("modal-block-full");
//cdocumentS=indezadj;
//indexobject=indezadj;
//$(".adjuntosDocupdate").html(adjuntos)
var fase=0;
var encrymf="";
$.each(data, function( i, item ) {
        $("."+i).val(item);
        if (i=="idManifiesto") {
          encrymf=item;
        }
        if (i=="statusfase") {
          fase=item;
        }
       });  
   $.get(url+"ajax/"+ajax+".php", {changeDocument:"update",encryMF:encrymf,encryf:fase}, function(respuesta){          
ms.html(respuesta);
    $('[data-plugin-timepicker]').each(function() {
        var $this = $( this ),  opts = {};
        var pluginOptions = $this.data('plugin-options');
        if (pluginOptions)
          opts = pluginOptions;
        $this.themePluginTimePicker(opts);
      });

  $('[data-plugin-datepicker]').each(function() {
        var $this = $( this ),
          opts = {};
        var pluginOptions = $this.data('plugin-options');
        if (pluginOptions)
          opts = pluginOptions;
        $this.themePluginDatePicker(opts);
      });
     });
  $.magnificPopup.open({
               items: {   src: '#modalEditForm'   },
               type: 'inline',
                preloader: true,
                modal: true
           });
}

function rellEditDTarifa(data,lisprov,listdistr,type){
 $(".mfp-bg").addClass("capa1");
$(".mfp-wrap").addClass('capa2');  
$(".typeTarifagrn").val(type);
       $.magnificPopup.open({
               items: {   src: '#modalEditForm'   },
               type: 'inline',
                preloader: true,
                modal: true
           });
  //$("#modalEditForm").addClass("modal-block-full");
var idDist=0,idProv=0,idDepa=0; 
$.each(data, function( i, item ) {
if (i=="idTarifaTerrestre") {
  $(".idTarifagrn").val(item);
}
if (i=="idTarifaAerea") {
  $(".idTarifagrn").val(item);
}

if (i=="idTarifa") {
  $(".idTarifa").val(item);
}
if (i=="tbaseterrestre") {
  $(".tbase").val(item);
}

if (i=="tbaseaerea") {
  $(".tbase").val(item);
}

if (i=="ttxkilo") {
  $(".tkg").val(item);
}
if (i=="taxkilo") {
  $(".tkg").val(item);
}

if (i=="ttmediatonelada") {
  $(".tmt").val(item);
}
if (i=="tamediatonelada") {
  $(".tmt").val(item);
}

if (i=="tt1t") {
  $(".t1t").val(item);
}
if (i=="ta1t") {
  $(".t1t").val(item);
}

if (i=="tt2t") {
  $(".t2t").val(item);
}
if (i=="ta2t") {
  $(".t2t").val(item);
}

if (i=="tt3t") {
  $(".t3t").val(item);
}
if (i=="ta3t") {
  $(".t3t").val(item);
}

if (i=="tt4t") {
  $(".t4t").val(item);
}

if (i=="ta4t") {
  $(".t4t").val(item);
}

if (i=="idDepa") {
  idDepa=item;
}
       // $("."+i).val(item);
if (i=="idDist") {
  idDist=item;
}
if (i=="idProv") {
  idProv=item;
}
       });  

$(".idDistrito").html("");  
      $(".idProvincia").html("");
       $('select[name="idDepartamento"]').val(idDepa);
    $(".idDistrito").html(listdistr);   
    $(".idProvincia").html(lisprov);
   $('select[name="idProvincia"]').val(idProv);
  $('select[name="idDistrito"]').val(idDist);
}

function modalOnActivaDeleteDataTableTarifa(ajax,idElemento,typeElemento,statuElemento,url){
  $("#idElemento").val(idElemento);
  $("#statuElemento").val(statuElemento);
  $("#ajaxElemento").val(ajax);
  $("#urlElemento").val(url);
  $("#typElemento").val(typeElemento);

if (statuElemento==1) {
$(".msgActivateDeleted").text("Los datos serán inhabilitados del sistema");
}
else{
$(".msgActivateDeleted").text("Los datos serán habilitados del sistema");

}

   $.magnificPopup.open({
               items: {src: '#modalIcon'},
               type: 'inline',
                preloader: true,
                modal: true
           });
}

function modalOperacionTarifa(ajax,url){
  $("#urlopTarifa").val(url);
  $("#urlopAjax").val(ajax);
   $.magnificPopup.open({
               items: {src: '#modalOperacionTarifa'},
               type: 'inline',
                preloader: true,
                modal: true
           });
}


  $(document).on('click', '.modalformOpTarifa-confirm', function (e) {
    e.preventDefault();
    var ajax=$("#urlopAjax").val();
 var urlglobal=$("#urlopTarifa").val();
updatetarifageneral(urlglobal,ajax);
    });

  function updatetarifageneral(url,ajax) {
var btnModal=$(".modalformOpTarifa-confirm");
btnModal.prop('disabled', true);
btnModal.text("Cargando...");

var tt1t=$(".tfgtt1a5").val();  var tt2t=$(".tfgtt6a10").val(); var tt3t=$(".tfgtt1a10").val(); var igv=$(".tfgigv").val();
var tta1=$(".tfgta1a5").val(); var tta2=$(".tfgta6a10").val(); var tta3=$(".tfgta1a10").val();    
 var ttencry=$("#encrytarifa").val();   
 $.get(url+"ajax/"+ajax+".php", {opeTarifa:"yes",tt1a5:tt1t,tt6a10:tt2t,tt1a10:tt3t,igv:igv,ta1a5:tta1,ta6a10:tta2,ta1a10:tta3,idTarifa:ttencry},
  function(respuesta){
              btnModal.prop('disabled', false);
              btnModal.text("Confirmar");
              $(".RespuestaAjax").html(respuesta);
              $.magnificPopup.close();
            });
}

 function ReportPersonal(ajax,url){

   var statu = 1;
if($("#myonoffswitch").is(":checked")) {
     statu = 1;
}else{
    statu = 0;
}
   var fechab1=$("#fechab1").val();
   var fechab2=$("#fechab2").val();
  window.open (url+"ajax/"+ajax+".php?status="+statu+"&&fecha1="+fechab1+"&&fecha2="+fechab2, '_blank');
  }

function ReportProduct(ajax,url){
   var statu = 1;
if($("#myonoffswitch").is(":checked")) {
     statu = 1;
}else{
    statu = 0;
}
   var client =$('select[name="labbusq"]').val();  
   var fechab1=$("#fechab1").val();
   var fechab2=$("#fechab2").val(); 
   window.open (url+"ajax/"+ajax+".php?status="+statu+"&&fecha1="+fechab1+"&&fecha2="+fechab2+"&&lab="+client, '_blank');
  }



function rellEditRemesa(data){
var url=$("#url").val();
var ajax=$("#ajax").val();
console.clear();
     var ms=$(".princiupdate");
 $(".mfp-bg").addClass("capa1");
$(".mfp-wrap").addClass('capa2');  
       $.magnificPopup.open({
               items: {   src: '#modalEditForm'   },
               type: 'inline',
                preloader: true,
                modal: true
           });
  $("#modalEditForm").addClass("modal-block-full");
//cdocumentS=indezadj;
//indexobject=indezadj;
//$(".adjuntosDocupdate").html(adjuntos)
var fase=0;
var encrymf="";
$.each(data, function( i, item ) {
       
        $("."+i).val(item);

        if (i=="idRemesa") {
          encrymf=item;
        }
  
        if (i=="idFaseRemesa") {
          fase=item;
        }
       });  
   $.get(url+"ajax/"+ajax+".php", {changeDocument:"save",encryMF:encrymf,encryf:fase}, function(respuesta){          
ms.html(respuesta);
  $('[data-plugin-timepicker]').each(function() {
        var $this = $( this ),  opts = {};
        var pluginOptions = $this.data('plugin-options');
        if (pluginOptions)
          opts = pluginOptions;
        $this.themePluginTimePicker(opts);
      });

  $('[data-plugin-datepicker]').each(function() {
        var $this = $( this ),
          opts = {};

        var pluginOptions = $this.data('plugin-options');
        if (pluginOptions)
          opts = pluginOptions;

        $this.themePluginDatePicker(opts);
      });



     });

}


function addDetalleRemesa(saveupdate){
var url=$("#url").val();
var ajax="remesaAjax";

var departorigen=parseInt($('select[name="departamentoorigen'+saveupdate+'"]').val());
var provrigen=parseInt($('select[name="provinciaorigen'+saveupdate+'"]').val());
var origen=parseInt($('select[name="distritoorigen'+saveupdate+'"]').val());

var departdestino=parseInt($('select[name="departamentodestino'+saveupdate+'"]').val());
var provdestino=parseInt($('select[name="provinciadestino'+saveupdate+'"]').val());
var destino=parseInt($('select[name="distritodestino'+saveupdate+'"]').val());

var pti=$('select[name="pti'+saveupdate+'"]').val();
var snDocumento=parseInt($('select[name="snDocumento'+saveupdate+'"]').val());
var nCajas=$(".nCajas"+saveupdate).val();
var nSobres=$(".nSobres"+saveupdate).val();
var flete=$(".flete"+saveupdate).val();
var detalleenvio=$(".detalleenvio"+saveupdate).val();
var typed=parseInt($('select[name="tipodoc'+saveupdate+'"]').val());
var nDocumento=$(".nDocumento"+saveupdate).val();

if (departdestino!="" && destino!="" && departorigen!=""&& provrigen!="" && origen!="" && provdestino!="" &&pti!="" 
   && snDocumento!="" && nDocumento!=""  && flete!="" && detalleenvio!="" ) 
{
  if (saveupdate=="save" || saveupdate=="update") {

  $.get(url+"ajax/"+ajax+".php", {tkdetalle2:"yes",type:saveupdate,iddeporg:departorigen,
  idprovorg:provrigen,iddistrorg:origen,iddepdest:departdestino,provdest:provdestino
  ,iddistrdest:destino,pti:pti,nDocumento:nDocumento,nSobres:nSobres,monto:flete,nCajas:nCajas,
detalleenvio:detalleenvio,indexObjSolicitud:indexObjSolicitud,tipodoc:typed,snDocumento:snDocumento}, function(respuesta){
  $(".detalleremesa"+saveupdate).append(respuesta);
      $('[data-plugin-selectpicker]').each(function() {
      if( /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent) ) {
  $(this).selectpicker();
}else{
      $(this).selectpicker();
}
      });


$(".nCajas"+saveupdate).val("");
$(".nSobres"+saveupdate).val("");
$(".flete"+saveupdate).val("");
$(".detalleenvio"+saveupdate).val("");
$(".nDocumento"+saveupdate).val("");
     });

  ccargaSolicitud++;
indexObjSolicitud++;
 getnumberserie(ajax,url,saveupdate);

  }

}
else{
  new PNotify({
      title: 'Algo Salio Mal',
      text: 'Para añadir Complete los campos requeridos e intente nuevamente',
      type: 'error'
    });
}

}


function tableDetalleRemesa(saveupdate) {
    var tableDataCarga = { tableDataCarga: [] };
    $(".detalleremesa"+saveupdate+" tr").each(function() {
        var obj = {};
      obj.operacion = $(":input[name=operation]", this).val();
      obj.iddetalleremesa =parseInt($(":input[name=iddetalleremesa"+saveupdate+"]", this).val());
      obj.origen  = parseInt($(":input[name=distritoorigen"+saveupdate+"]", this).val());
      obj.destino  = parseInt($(":input[name=distritodestino"+saveupdate+"]", this).val());
      obj.pti=parseInt($(":input[name=pti"+saveupdate+"]", this).val());
       obj.tipodoc = parseInt($(":input[name=tipodoc"+saveupdate+"]", this).val()); 
     obj.nCajas = parseInt($(":input[name=nCajas"+saveupdate+"]", this).val());
       obj.nSobres = parseInt($(":input[name=nSobres"+saveupdate+"]", this).val());
       obj.flete = parseFloat($(":input[name=flete"+saveupdate+"]", this).val());
       obj.detalleenvio = $(":input[name=detalleenvio"+saveupdate+"]", this).val();

      obj.ndocument=$(":input[name=ndocument"+saveupdate+"]", this).val(); 
        tableDataCarga.tableDataCarga.push(obj);
    });
    
    return JSON.stringify(tableDataCarga);
}

function tableDetalleOBSRemesa(saveupdate) {
     var tableDataCarga = { tableDataCarga: [] };
   $(".detalleremesa"+saveupdate+" tr").each(function() {
        var obj = {};
      obj.operacion = $(":input[name=operation]", this).val();
      obj.iddetalleremesa =parseInt($(":input[name=iddetalleremesa"+saveupdate+"]", this).val());
       obj.detalleenvio = $(":input[name=detalleenvio"+saveupdate+"]", this).val();
        tableDataCarga.tableDataCarga.push(obj);
    });
    
    return JSON.stringify(tableDataCarga);
}

function rellEditLiquidacion(data){
   $(".caja-principal").css("display","block");
   $(".btndetalle").css("display","none");
   $(".btnsgte").css("display","inline");
   $(".caja-secupdate").html("");
   $(".idEncriptado").val(data.idClient);
$(".validatorcargas").val(0);
   $(".txtClient").text("Cliente : "+data.nameClient);
       $.magnificPopup.open({
               items: {   src: '#modalEditForm'   },
               type: 'inline',
                preloader: true,
                modal: true
           })

 $(".mfp-bg").addClass("capa1");
$(".mfp-wrap").addClass('capa2');  
//$(".typeTarifagrn").val(type);
   $("#modalEditForm").removeClass("modal-block-full");

   }

 function rellEditLiquidacionDetail(ajax,url){
   $("#modalEditForm").addClass("modal-block-full");
var id=$(".idEncriptado").val();
var mes=$(".mes").val();
var ta=0;
if ($("input[name='ta']:radio").is(':checked')) {
   ta= $('input:radio[name=ta]:checked').val();
}

   $(".caja-sec").html("");
      $(".validatorcargas").val(0);
if(mes==0){
    new PNotify({
      title: 'Algo Salio Mal',
      text: 'Sellecione un mes',
      type: 'error'
    });
}

if(mes!=0){
$(".caja-principal").css("display","none");
$(".btndetalle").css("display","inline");
   $(".btnsgte").css("display","none");
    $.get(url+"ajax/liquidacionesAjax.php", {accion:"getListLiquidacion",encryMF:id,selectmes:mes,selectisvia:ta}, function(respuesta){ 
if(respuesta!=""){
    $(".caja-secupdate").html(respuesta);
$(".validatorcargas").val(1);
}  else{
   $(".validatorcargas").val(0);
}   
    });
  }
   }

function tableDetalleLiquidacion(saveupdate) {
    var tableDataCarga = { tableDataCarga: [] };
    $(".detalleliquidacionupdate tr").each(function() {
        var obj = {};
         obj.operacion = $(":input[name=operation]", this).val();
         obj.operacionsub = $(":input[name=operationsub]", this).val();
    obj.idDetalleCarga =parseInt($(":input[name=idDetalleCargaupdate]", this).val());
       obj.fecharecp = $(":input[name=fecharecpupdate]", this).val();
      obj.horarecp = $(":input[name=horarecpupdate]", this).val();
      obj.bussinesunit  = $(":input[name=bussinesunitupdate]", this).val();
      obj.fechaEntrega  = $(":input[name=fechaEntregaupdate]", this).val();
       obj.horaEntrega = $(":input[name=horaEntregaupdate]", this).val();
      obj.npiezas  = $(":input[name=npiezasupdate]", this).val();
      obj.pesoKg = parseFloat($(":input[name=pesoKgupdate]", this).val());
      obj.PV = parseFloat($(":input[name=PVupdate]", this).val());
      obj.ptotal = $(":input[name=ptotalupdate]", this).val();
      obj.pbase = $(":input[name=pbaseupdate]", this).val();
      obj.tbase = $(":input[name=tbaseupdate]", this).val();
      obj.pexceso = $(":input[name=pexcesoupdate]", this).val();
      obj.texceso = $(":input[name=texcesoupdate]", this).val();
      obj.tarifatotal = $(":input[name=tarifatotalupdate]", this).val();
      obj.observaciones = $(":input[name=observacionesupdate]", this).val();
          obj.origen=parseInt($(":input[name=origenupdate]", this).val());
    obj.destino=parseInt($(":input[name=destinoupdate]", this).val());
      obj.remitente = $(":input[name=remitenteupdate]", this).val();
      obj.tipodocument = $(":input[name=tipodocumentupdate]", this).val();
      obj.ordenenvio = $(":input[name=ordenenvioupdate]", this).val();
      obj.NFACT = $(":input[name=NFACTupdate]", this).val();
      obj.NBOLETA = $(":input[name=NBOLETAupdate]", this).val();
      obj.NGRR = $(":input[name=NGRRupdate]", this).val();
      obj.GREMTR = $(":input[name=GREMTRupdate]", this).val();
      obj.consignado = $(":input[name=consignadoupdate]", this).val();
      obj.entregado = $(":input[name=entregadoupdate]", this).val();
      obj.descripcion = $(":input[name=descripcionupdate]", this).val();
    tableDataCarga.tableDataCarga.push(obj);
    });
    
    return JSON.stringify(tableDataCarga);
}

function getbrevete(saveupdate){
var el=".chofer"+saveupdate;
  var brevete = $('option:selected', el).attr('data-brevete');
    $(".brevete").val(brevete);
}
 
var indexRemison=0;
var indexobject=0;

function buscarRuc(ajax,url,saveupdate){
var ruc=$('select[name=idClient]').val();
if (saveupdate=="save") {
    $('.productsavebusq').selectpicker('destroy');
      $('.destinatario').selectpicker('destroy');
if (ruc!="") {
var el=".idClient"+saveupdate;
  var txtruc = $('option:selected', el).attr('data-ruc');
    $(".ruc"+saveupdate).val(txtruc);
  var domicilio = $('option:selected', el).attr('data-domicilio');
    $(".domicilio").val(domicilio);
var datadest=$('option:selected', el).attr('data-destinatario');
var tmpd='<option  value="">-Seleccionar-</option> ';
if (datadest!=""&& datadest!=null) {
var dataObj =  JSON.parse(datadest);
          $.each(dataObj, function( i, item ) {
  tmpd+='<option data-ruc="'+item.RUC+'"  value="'+item.DESTINATARIO+'">'+item.DESTINATARIO+'</option> ';
         });
} 
$('.destinatario').html(tmpd);
 $('.destinatario').selectpicker();
 indexRemison=0;
indexobject=0;
$(".detallecarga"+saveupdate).html("");

 $.get(url+"ajax/"+ajax+".php", {productbus:ruc}, function(respuesta){
      $(".validerbus").val(1);
      $('.productsavebusq').html(respuesta);
      $('.productsavebusq').selectpicker();
     });
} else{
 indexRemison=0;
indexobject=0;
$(".detallecarga"+saveupdate).html("");
    $(".validerbus").val(0);
var tmpr='<option  value="">-Seleccionar-</option> ';
  $('.productsavebusq').html(tmpr);
      $('.productsavebusq').selectpicker();
$('.destinatario').html(tmpr);
 $('.destinatario').selectpicker();

}
}
}

function getplaca(saveupdate){
  var el=".idplaca"+saveupdate;
  var marcavh = $('option:selected', el).attr('data-marcavh');
  $(".marcaveh").val(marcavh);
}
function getrucdest(){
  var el=".destinatario";
  var ruc = $('option:selected', el).attr('data-ruc');
  $(".rucdesti").val(ruc);
}

function addProductRemision(ajax,url,saveupdate){
 var validator=$(".validerbus").val();
         var codigoproduct=$('select[name=productsavebusq]').val();
 var el='select[name=productsavebusq]';
    var cantidad=parseInt($(".ncantidadbusq").val());
    var code = $('option:selected', el).attr('data-code');
    var unidadmedida = $('option:selected', el).attr('data-um');
    var lote = $('option:selected', el).attr('data-lote');
    var descripcion = $('option:selected', el).attr('data-descrip');
    var vencimiento = $('option:selected', el).attr('data-fechavenc');
     var cantidamax = $('option:selected', el).attr('data-cantidad');
  
var parameter=true;
if (validator!=0 && codigoproduct!="" &&cantidad>=1) {
if (indexRemison>=1) {
 
for (i = 0; i <=indexobject; i++) {
  var busq=$("#idProduct"+i).val();
  var busqct=parseInt($("#cantidadsave-"+i).val());

if (busq==codigoproduct) {
var ctt=busqct+cantidad;
if (cantidamax>=ctt) {
  parameter=false;
  $("#cantidadsave-"+i).val(ctt);
}
else{
    parameter=false;

 new PNotify({
      title: 'Algo Salio Mal',
      text: 'El Producto no Tiene la Cantidad Solicitada',
      type: 'error'
    });

}


}

}
if (parameter==true) {
subaddremision(indexRemison,code,codigoproduct,cantidad,cantidamax,unidadmedida,lote,descripcion,vencimiento);
}

}
if (indexRemison==0) {
   
subaddremision(indexRemison,code,codigoproduct,cantidad,cantidamax,unidadmedida,lote,descripcion,vencimiento);
}


}
if(validator==0){
  new PNotify({
      title: 'Algo Salio Mal',
      text: 'Por favor rellene el campo Codigo Cliente ',
      type: 'error'
    });
}

if(codigoproduct==""){
  new PNotify({
      title: 'Algo Salio Mal',
      text: 'Por favor Intente con otro producto',
      type: 'error'
    });
}
if(cantidad<1){
  new PNotify({
      title: 'Algo Salio Mal',
      text: 'Por favor rellene una cantidad Solicitada',
      type: 'error'
    });
}
}



function subaddremision(index,code,codigo,cantidad,max,unidadmedida,lote,descripcion,vencimiento){
  $(".detallecargasave").append('<tr id="trcargasave'+index+'"  ><td> #'+(index+1)+'\
    <input type="hidden"  name="operation" value="save">           \
      <input type="hidden" id="encry'+index+'"  name="idDetalleGuiasave" >  \
    <input type="hidden" id="idProduct'+index+'" value="'+codigo+'"  name="idProductsave" > \
        </td> \
        <td>'+code+'</td> \
    <td>\
    <input type="number" id="cantidadsave-'+index+'" name="nCantidadsave" class="inputtable cantidadsave-'+index+'" min="1"  max="'+max+'" value="'+cantidad+'"   onkeyup=imposeMinMax(this) required>\
    </td>       \
     <td>   <input type="number" step="any" name="pesosave" class="inputtable"  max="9999999999" data-maxlength="10" oninput="this.value=this.value.slice(0,this.dataset.maxlength)" ></td>\
</td>    <td>   <input type="number" step="any" name="preciosave" class="inputtable" min="0" value="0"  max="9999999999" data-maxlength="10" oninput="this.value=this.value.slice(0,this.dataset.maxlength)" ></td>\
</td>           \
   <td>     \
   <input type="hidden" id="unidadMedidasave-'+index+'"  name="unidadMedidasave" value="'+unidadmedida+'" required> \
    <span class="txtumsave-'+index+'">'+unidadmedida+'</span>  </td>  \
    <td>\
 <input type="hidden" id="lotesave-'+index+'"  name="lotesave" value="'+lote+'" required> \
    <span class="txtlotesave-'+index+'">'+lote+'</span>\
    </td> \
    <td> \
 <input type="hidden" id="descriptionsave-'+index+'"  name="descriptionsave"  value="'+descripcion+'"  > \
<p class="txtdesciptionsave-'+index+'">'+descripcion+'</p>\
    </td>   <td> <input type="hidden" id="vencimientosave-'+index+'" value="'+vencimiento+'"  name="vencimientosave" >  \
    <span class="txtvencimientosave-'+index+'">'+vencimiento+'</span>  \
    </td> \
    <td><button type="button"  class="btn btn-danger  btn-sm " onclick="onDeleteCargaRemT1(`save`,'+index+')"><i class="fa  fa-trash-o fa-lg colorwhite"></i></button></td></tr>');
   indexRemison++;indexobject++;  $(".validercarga").val(1);
}




 function onDeleteCargaRemT1(saveUpdate,index){
    var saveupdate=saveUpdate.trim();
    if (saveupdate=="save") {
          $("#trcargasave"+index).remove();
  indexRemison=indexRemison-1;
}
      if (saveupdate=="update") {
    $("#trcargaupdate"+index).remove();
  indexRemison=indexRemison-1;
     }  
    }

function imposeMinMax(el){
  if(el.value != ""){
    if(parseInt(el.value) < parseInt(el.min)){
      el.value = el.min;
    }
    if(parseInt(el.value) > parseInt(el.max)){
      el.value = el.max;
    }
  }
}


   
   function getDataMutltiproduct(){
    var el='select[name=productsavebusq]';
        var codigoproduct=$('select[name=productsavebusq]').val();
   var cantidamax = $('option:selected',el).attr('data-cantidad');
$(".ncantidadbusq").attr('max', cantidamax);
   } 

function tableDetalleRemision(saveupdate) {
    var tableDataCarga = { tableDataCarga: [] };
    $(".detallecarga"+saveupdate+" tr").each(function() {
        var obj = {};
         obj.operacion = $(":input[name=operation]", this).val();
    obj.idProduct =parseInt($(":input[name=idProduct"+saveupdate+"]", this).val());
       obj.cantidad = parseInt($(":input[name=nCantidad"+saveupdate+"]", this).val());
      obj.unidadMedida = $(":input[name=unidadMedida"+saveupdate+"]", this).val();
      obj.lote  = $(":input[name=lote"+saveupdate+"]", this).val();
      obj.description  = $(":input[name=description"+saveupdate+"]", this).val();
      obj.vencimiento  = $(":input[name=vencimiento"+saveupdate+"]", this).val();
         obj.weight  = parseFloat($(":input[name=peso"+saveupdate+"]", this).val());
      obj.price  =parseFloat( $(":input[name=precio"+saveupdate+"]", this).val());
        tableDataCarga.tableDataCarga.push(obj);
    });
    
    return JSON.stringify(tableDataCarga);
}

function rellEditRemision(data,detalle){
    $("#modalEditForm").addClass("modal-block-full");
         $(".validercarga").val(1);
         $(".validerbus").val(1);
          $.magnificPopup.open({
               items: {   src: '#modalEditForm' },
               type: 'inline',
                preloader: true,
                modal: true
           });
          $(".mfp-bg").addClass("capa1");
$(".mfp-wrap").addClass('capa2');
         $.each(data, function( i, item ) {
       if (i!="mtraslado" && i!="idplaca" && i!="transportista" && i!="idClient" && i!="fechainitraslado") {
        $("."+i).val(item);
      }
if (i=="fechainitraslado") {
    $( ".fechainitraslado" ).datepicker("setDate",item);
}
 
   if (i=="idClient") {
  $('.idClientupdate').val(item).trigger('change');
      $('.idClientupdate option:not(:selected)').prop('disabled', true);
}
       if (i=="mtraslado") {
        if (item==1) {$(".mtrasl-1").prop('checked', 'cheked');}
        if (item==2) {$(".mtrasl-2").prop('checked', 'cheked');}
        if (item==3) {$(".mtrasl-3").prop('checked', 'cheked');}
        if (item==4) {$(".mtrasl-4").prop('checked', 'cheked');}
        if (item==5) {$(".mtrasl-5").prop('checked', 'cheked');}
        if (item==6) {$(".mtrasl-6").prop('checked', 'cheked');}
        if (item==7) {$(".mtrasl-7").prop('checked', 'cheked');}
        if (item==8) {$(".mtrasl-8").prop('checked', 'cheked');}
        if (item==9) {$(".mtrasl-9").prop('checked', 'cheked');}
}


       });


$(".detallecargaupdate").html(detalle);

}
function onsearchcarga(url,ajax){
        $('#cargasearch').selectpicker('destroy');
var tipoS=$(".typeservicio").val();
if (tipoS!=0) {
 $.get(url+"ajax/"+ajax+".php", {searchserv:'yes',typeS:tipoS}, function(respuesta){
     $(".table-carga").DataTable().destroy();
     $('.detallesave').html(respuesta);
       $(".table-carga").DataTable({"order": [[ 0, "desc" ]]});
            });

}else{
$(".table-carga").DataTable().destroy();
     $('.detallesave').html("");
       $(".table-carga").DataTable();

}
  
}


function onaddRemision(datajs,url,ajax){
 var respuesta=$('.ajaxcripsave');
 $(".panelfscriptsave").css('display','none');
 $.ajax({
                 type:"GET",
                   url:url+"/ajax/"+ajax+".php",
                  data: "&formsave=yes&&idDetalleCarga="+datajs.idDetalleCarga+"&&type="+datajs.type,           
                  xhr: function(){
                    $(".ajaxcripsave").html('<i class="fa fa-spinner fa-spin fa-2x fa-fw"></i>');
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress", function(evt) {
                      if (evt.lengthComputable) {
                        var percentComplete = evt.loaded / evt.total;
                        percentComplete = parseInt(percentComplete * 100);
                        if(percentComplete<100){
          respuesta.html('<p class="text-center">Procesado... ('+percentComplete+'%)</p><div class="progress progress-striped active"><div class="progress-bar progress-bar-info" style="width: '+percentComplete+'%;"></div></div>');
                        }else{
          respuesta.html('<p class="text-center"></p>');
                        }
                      }
                    }, false);
                    return xhr;
                },
                success: function(data) {
                  respuesta.html("");
                    $(".respscripsave").html("");
                  $(".panelfscriptsave").css('display','block');
                  $(".respscripsave").html(data);
      $.magnificPopup.open({
                   items: { src: '#modalSaveForm' },
                   type: 'inline',
                    preloader: true,
                    modal: true
                  });
  $(".mfp-bg").addClass("capa1");
$(".mfp-wrap").addClass('capa2');
             },
              error: function(xhr) { 
    new PNotify({
      title: 'Algo Salio Mal',
      text: 'Intente Nuevamente',
      type: 'error'
    });
                },
              });  
}



function rellEditRemisiontrans(data,url,ajax){
            $("#modalEditForm").addClass("modal-block-full");
         $(".validercarga").val(1);
         $(".modal-basic").text("Actualizar");
                       $(".validerbus").val(1);

          $.magnificPopup.open({
               items: {   src: '#modalEditForm'   },
               type: 'inline',
                preloader: true,
                modal: true
           });

          $(".mfp-bg").addClass("capa1");
$(".mfp-wrap").addClass('capa2');
$(".idGuiatransp").val(data);
 var respuesta=$('.ajaxcripupdate');
 $(".panfupdate").css('display','none');
 $.ajax({       type:"GET",
                   url:url+"/ajax/"+ajax+".php",
                  data: "paintscriptupdate=yes&&idGuiatransp="+data,            
                  xhr: function(){
                    $(".ajaxcripupdate").html('<i class="fa fa-spinner fa-spin fa-2x fa-fw"></i>');
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress", function(evt) {
                      if (evt.lengthComputable) {
                        var percentComplete = evt.loaded / evt.total;
                        percentComplete = parseInt(percentComplete * 100);
                        if(percentComplete<100){
  respuesta.html('<p class="text-center">Procesado... ('+percentComplete+'%)</p><div class="progress progress-striped active"><div class="progress-bar progress-bar-info" style="width: '+percentComplete+'%;"></div></div>');
                        }else{
    respuesta.html('<p class="text-center"></p>');
                        }
                      }
                    }, false);
                    return xhr;
                },
                success: function(data) {
                  respuesta.html("");
                    $(".loadGuardadof").html("");
                  $(".panfupdate").css('display','block');
                 $(".princiupdate").html(data);                           
              },
              error: function(xhr) {
   new PNotify({
      title: 'Algo Salio Mal',
      text: 'Intente Nuevamente',
      type: 'error'
    });
                },
              });     





}

function tableDetalleRemisiontransp(saveupdate) {
    var tableDataCarga = { tableDataCarga: [] };
    $(".detallecarga"+saveupdate+" tr").each(function() {
        var obj = {};
         obj.operacion = $(":input[name=operation]", this).val();
    obj.idDetalleGuia =parseInt($(":input[name=idDetalleGuia"+saveupdate+"]", this).val());
         obj.weight  = parseFloat($(":input[name=peso"+saveupdate+"]", this).val());
      obj.price  = parseFloat($(":input[name=costo"+saveupdate+"]", this).val());
        tableDataCarga.tableDataCarga.push(obj);
    });
    
    return JSON.stringify(tableDataCarga);
}
function ReportGrupRT(ajax,url){
  var fechab1=$("#fechab1").val();
          var fechab2=$("#fechab2").val();
            var client =$('select[name="labbusq"]').val();
             var statu = 1;
if($("#myonoffswitch").is(":checked")) {
     statu = 1;
}else{
    statu = 0;
}
  window.open (url+"ajax/"+ajax+".php?status="+statu+"&&fecha1="+fechab1+"&&fecha2="+fechab2+"&&lab="+client+"&&report=yes", "socialPopupWindow",
                "location=no,width=1200,height=1000,scrollbars=yes,top=100,left=700,resizable =yes");
}

function ReportGrupRT2(ajax,url){
  var fechab1=$("#fechab1").val();
          var fechab2=$("#fechab2").val();
            var client =$('select[name="labbusq"]').val();
             var statu = 1;
if($("#myonoffswitch").is(":checked")) {
     statu = 1;
}else{
    statu = 0;
}
  window.open (url+"ajax/"+ajax+".php?status="+statu+"&&fecha1="+fechab1+"&&fecha2="+fechab2+"&&lab="+client+"&&report=yes", "_blank",
                "location=no,width=1200,height=1000,scrollbars=yes,top=100,left=700,resizable =yes");
}



function ubigeodestinatario(el){
var val=$(el).val();
   var departamento = $("#datalist-destinatario").find('option[value="'+val+'"]').data('departamento');
    departamento=departamento.trim();
  $("#departamentodestino option:contains("+departamento+")").attr('selected', true);
  $('#departamentodestino').trigger('change.select2');
}

function setNvu(nvu){
  var pr= parseInt(nvu);
  $(".priority").val(pr);
  var txtobs=$(".observaciones").val();
   $(".btn-u").removeClass('btn-success');
        $(".btn-u").removeClass('btn-warning');
        $(".btn-u").removeClass('btn-danger');
  if (nvu==1) {
  $(".btn-u").addClass('btn-success');

if (txtobs!="") {
  var txtsp=txtobs.split("Nivel de Prioridad");
var ty=txtsp[0];
if (ty!="") {

txtobs=ty+"*Nivel de Prioridad Normal";
  $(".observaciones").val(txtobs);
}else{
  $(".observaciones").val("*Nivel de Prioridad Normal");
}

}
else{
  $(".observaciones").val("*Nivel de Prioridad Normal");
}
  }
   if (nvu==2) {
      $(".btn-u").addClass('btn-warning');

    if (txtobs!="") {
        var txtsp=txtobs.split("Nivel de Prioridad");
var ty=txtsp[0];
if (ty!="") {
txtobs=ty+"*Nivel de Prioridad Urgente";
  $(".observaciones").val(txtobs);

}else{
  $(".observaciones").val("*Nivel de Prioridad Urgente");
}


}
else{
  $(".observaciones").val("Nivel de Prioridad Urgente");
}
  }
   if (nvu==3) {
          $(".btn-u").addClass('btn-danger');

        if (txtobs!="") {
                  var txtsp=txtobs.split("Nivel de Prioridad");
var ty=txtsp[0];
if (ty!="") {
txtobs=ty+"*Nivel de Prioridad Muy Urgente";
  $(".observaciones").val(txtobs);

}
else{
  $(".observaciones").val("*Nivel de Prioridad Muy Urgente");
}


}
else{
  $(".observaciones").val("*Nivel de Prioridad Muy Urgente");
}
  }
}
function insertarnot(emailsend){

   $.achex.send(
              {

                to:'elvis',
                someMessage:emailsend 
              }
            );

}

function mensajedat(data){
var url=$("#url").val();

  var emailuser=$("#Emailuser").val();
if (emailuser==data) {
  $.get(url+"ajax/navAjax.php", {listnot:"yes"}, function(respuesta){ 
$(".notify-list").html(respuesta);
   
    });

}
}

function elegiraddresremit(el,saveupdate){ 
var val=$(el).val();
var cl=$('select[name="idClient"] option:selected').text();
cl=cl.trim();
if (cl!=val) {
     var direccion = $('#datalist-remitente').find('option[value="'+val+'"]').data('address');
 $(".lugarRecojo").val(direccion);
}
else{
  var valdef=$(".area"+saveupdate).val();
   var direcciondf = $('#datalist-area').find('option[value="'+valdef+'"]').data('adrres');
    $(".lugarRecojo").val(direcciondf);
}

}
function elegiraddresdestt2(el){ 

var val=$(el).val();
   var direccion = $('#datalist-destinatario').find('option[value="'+val+'"]').data('address');
 $(".lugarRecojo").val(direccion);

}
function elegiraddresdesttsev2(el){ 

var val=$(el).val();
   var direccion = $('#datalist-destinatario').find('option[value="'+val+'"]').data('address');
 $(".deliveryaddress").val(direccion);

}



function elegirphonet2(el){ // recibimos por parametro el elemento select
 
var val=$(el).val();
   var phone = $('#datalist-contacto').find('option[value="'+val+'"]').data('phone');
 $(".phonecontact").val(phone);

}

function elegirphone(el){ // recibimos por parametro el elemento select
  var phone = $('option:selected', el).attr('data-phone');
  $(".phonecontact").val(phone);

}

function rellcllrgadaauxope(data){
 var url=$("#url").val();
var ajax=$("#ajax").val();
var ms=$(".mockup-principalupdate");
var idTypeService=0;
var idFaseTypeService=0;
var status=0;
$(".btn-auxope").css("display","inline-block");
var c=0, idClient=0,idSolicitudService=0,textS='',textF='';
         $.each(data, function( i, item ) {
        $("."+i).val(item);
                  $(".cargaIB1").val("0");
        $('select[name='+i+']').val(item);
   //  console.log("variables "+i + "-->"+item);
         if (i=="idFaseTypeService") {idFaseTypeService=item; }
   if (i=="idTypeService") {idTypeService=item;}
   if (i=="statusfase") {status=item;}
   if (i=="idClient") {idClient=item; }
  if (i=="idContactoCliente") {c=item;}
  if (i=="idSolicitudService") {idSolicitudService=item;}
  if (i=="servicio") {textS=item;}
  if (i=="fase") {textF=item;}
       });
        $(".tituloFase").text("Actualizacion de Medio de Transporte");
          $(".txt-S").text('Confirmar');

   $.get(url+"ajax/"+ajax+".php", {confirmauxope:"yes",encryD:idSolicitudService},function(respuesta){          
ms.html(respuesta);
        $("#modalEditForm").addClass("modal-block-full");       
          $.magnificPopup.open({
               items: {  src: '#modalEditForm' },
               type: 'inline',
                preloader: true,
                modal: true
           });
     });
}

function getpasstypeprv(saveupdate){
  var typo=$("#idTypeProvider"+saveupdate).val();
  if (typo==5) {$("#password"+saveupdate).attr('required', 'required');
    $(".input-pass"+saveupdate).css('display', 'block-inline');

}else{
$("#password"+saveupdate).removeAttr('required');
    $(".input-pass"+saveupdate).css('display', 'none');

}
}


function elegirareaT9(el){ // recibimos por parametro el elemento select
 // var direccion = $('option:selected','#dataareasave').attr('data-adrres');
// var options = document.getElementById('dataareasave').getElementsByTagName('option');

var val=$(el).val();
   var direccion = $('#datalist-area').find('option[value="'+val+'"]').data('adrres');
 
 $(".lugarRecojo").val(direccion);
 $(".deliveryaddress").val(direccion);
}

function elegiraddresremit9(el,saveupdate){ 
var val=$(el).val();
var cl=$('select[name="idClient"] option:selected').text();
cl=cl.trim();
if (cl!=val) {
     var direccion = $('#datalist-remitente').find('option[value="'+val+'"]').data('address');
 $(".lugarRecojo").val(direccion);
 $(".deliveryaddress").val(direccion);

}
else{
  var valdef=$(".area"+saveupdate).val();
   var direcciondf = $('#datalist-area').find('option[value="'+valdef+'"]').data('adrres');
    $(".lugarRecojo").val(direcciondf);
     $(".deliveryaddress").val(direccion);
}

}

function getInfoS(url,tipo) {
var encry='';
  if (tipo=="1") {
 encry=$("#idSolicitudService1").val();
  }
    if (tipo=="2") {
 encry=$("#idSolicitudService2").val();
  }
var urlf=url+encry;
ventanaReport(urlf);

}

function getDataClient5f(ajax,url,tipo,idClient){
 var c=$(".idSolicitudService").val();
 var idClient=$('select[name=idClient]').val();
$(".stringarea").val("");  $(".contact").val("");$(".lugarRecojo").val(""); 
 $(".remitente").val("");$(".destinatario").val("");


  $(".lugararea").val("Seleccione un Areá");
  if (tipo!="" && idClient!="") {
 $.get(url+"ajax/"+ajax+".php", {idClient:idClient,changeInfocl1:tipo,encryC:c}, function(respuesta){      
    var dataObj=JSON.parse(respuesta);
        $(".listcontact").html(dataObj.htmlcontact); 
        $(".listarea").html(dataObj.area); 
        $(".listdestinatario").html(dataObj.htmldest); 
      });
    

  }else{
        $(".listarea").html(""); 
 $(".listcontact").html("");
        $(".listdestinatario").html(""); 


  }
  
}


function getDataClientfserv2(ajax,url,tipo,idClient){
 var c=$(".idSolicitudService").val();
 var idClient=$('select[name=idClient]').val();
$(".stringarea").val("");  $(".contact").val("");$(".lugarRecojo").val("");  $(".remitente").val("");$(".destinatario").val("");


  $(".lugararea").val("Seleccione un Areá");
  if (tipo!="" && idClient!="") {
 $.get(url+"ajax/"+ajax+".php", {idClient:idClient,changeInfocl2:tipo,encryC:c}, function(respuesta){      
    var dataObj=JSON.parse(respuesta);
        $(".listcontact").html(dataObj.htmlcontact); 
        $(".listarea").html(dataObj.area); 
        $(".listdestinatario").html(dataObj.htmldest); 
      $(".lugarRecojo").val(dataObj.direcl);
      });
    

  }else{
        $(".listarea").html(""); 
 $(".listcontact").html("");
        $(".listdestinatario").html(""); 
  }
  
}


function chfase(el){
if (el!=2) {
  $(".selectjdo").css('display', 'inline-block');
    $(".selectcda").css('display', 'none');
$(".jdo").attr("required", true);
$(".cda").removeAttr('required');

}
else{
    $(".selectjdo").css('display', 'none');
    $(".selectcda").css('display', 'inline-block');
    $(".cda").attr("required", true);
$(".jdo").removeAttr('required');
}

}

function addcontacto(){
//   e.preventDefault(); // evita el reinicio
   var namecl=$("#clientcontactoname").val();
 var textoAlerta="Seguro que desea agregar el contacto al cliente "+namecl;
 var msgsucces="Registro Exitoso";
 var form=$("#formAjaxContacto");

        var tipo=form.attr('data-form');
        var ajax = form.attr('data-ajax');
        var accion=form.attr('action');
       var formdata=$('#formAjaxContacto').serialize();

     $.ajax({
                 type:"POST",
                   url:accion,
                  data: formdata ,            
                beforeSend: function() {
                $("#btnCMC").attr("disabled",true);
                  $("#btnCMSave").attr("disabled",true);
                  $("#btnCMSave").text('CARGANDO');
              },
                success: function(data) {
                 $("#btnCMC").attr("disabled",false);
                  $("#btnCMSave").attr("disabled",false);
                  $("#btnCMSave").text('Guardar');
                    $("body").append(data);
              },
              error: function(XMLHttpRequest, textStatus, errorThrown) { 
   if (XMLHttpRequest.readyState == 4) {
                    respuesta.html(msjError);
        }
        else if (XMLHttpRequest.readyState == 0) {
          var mserrointernet="  <script>$('.mfp-bg').css('z-index', '900');   \n\
        new PNotify({\n\
      title: 'Algo Salio Mal',\n\
      text: 'Conexion de internet fallida..Intente Nuevamente',\n\
      type: 'error'\n\
    });\n\
        </script>";
        $("body").append(mserrointernet);
        }
        else {  respuesta.html("  <script> \n\
        new PNotify({\n\
      title: 'Algo Salio Mal',\n\
      text: 'Intente Nuevamente',\n\
      type: 'error'\n\
    });\n\
        </script>"); 
        }
                $("#btnCMC").attr("disabled",false);
                  $("#btnCMSave").attr("disabled",false);
                  $("#btnCMSave").text('Guardar');
                },
              });
}

 $("#formAjaxContacto").validate({
  highlight: function( label ) {
      $(label).closest('.form-group').removeClass('has-success').addClass('has-error');
    },
    success: function( label ) {
      $(label).closest('.form-group').removeClass('has-error');
      label.remove();
    },
    errorPlacement: function( error, element ) {
      var placement = element.closest('.form-group');
      if (!placement.get(0)) {
        placement = element;
      }
      if (error.text() !== '') {
        placement.after(error);
      }

    },
    submitHandler: function(form) {
        var form2=$("#formAjaxContacto");
        var tipo=form2.attr('data-form');
        var ajax =form2.attr('data-ajax');

 $(".mfp-bg").removeClass("capa1");
$(".mfp-wrap").removeClass('capa2');
        //modificaciones
addcontacto();

    }

  });


function viewmodalFt(tipo){
var cliente=$('#idClient'+tipo).val();
if (cliente!="") {
    $("#formAjaxContacto")[0].reset();

  $("#clientcontactoaddtypS").val(typemd);
  var txtcl =$('#idClient'+tipo+' option:selected').text();
  $(".txt-cl").text(txtcl);
  $("#savecontact").val(tipo);
  $("#clientcontactoname").val(txtcl);
$("#clientcontactoadd").val(cliente);
 $(".mfp-wrap").hide();
$(".mfp-bg").hide();

$('#modalcontact').modal('show');

}else{
 new PNotify({
      title: 'Mensaje',
      text: 'Por favor Seleccione un Cliente e intente Nuevamente',
      type: 'error'
    });

}
     
}

function resetmodalFt(){
  $("#formAjaxContacto")[0].reset();
  $(".overlay").css('display', 'none');
  $(".txt-cl").text('');

  $('#modalcontact').modal('hide');
$(".mfp-wrap").show();
$(".mfp-bg").show();
}

function isrecpetioncarga(el){
   if( $(el).is(':checked') ) {
        // Hacer algo si el checkbox ha sido seleccionado
$(".timeofcargoreception").val("");
$(".timeofcargoreception").removeAttr('required');
    $(".timeofcargoreception").attr("readonly", true);

$(".cargoreceptiondate").val("");
$(".cargoreceptiondate").removeAttr('required');
    $(".cargoreceptiondate").attr("readonly", true);
    } else {
var dt = new Date();
    var h =  dt.getHours(), m = dt.getMinutes();
    var _time = (h > 12) ? (h-12 + ':' + m +' PM') : (h + ':' + m +' AM');
      $(".timeofcargoreception").val(_time);
      $(".timeofcargoreception").removeAttr('readonly');
    $(".timeofcargoreception").attr("required", true);
    $(".cargoreceptiondate").val("");
    $(".cargoreceptiondate").removeAttr('readonly');
    $(".cargoreceptiondate").attr("required", true);

    }
} 

  function rellEditV2(dataid,ajax,url,campo){

 $("."+campo).val(dataid);
 var respuesta=$('.RespuestaAjaxf');
 $(".panfupdate").css('display','none');
 $.ajax({
                 type:"GET",
                   url:url+"/ajax/"+ajax+".php",
                  data: "&formupdate=yes&&"+campo+"="+dataid ,            
                  xhr: function(){
                    $(".loadGuardadof").html('<i class="fa fa-spinner fa-spin fa-2x fa-fw"></i>');
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress", function(evt) {
                      if (evt.lengthComputable) {
                        var percentComplete = evt.loaded / evt.total;
                        percentComplete = parseInt(percentComplete * 100);
                        if(percentComplete<100){
                            respuesta.html('<p class="text-center">Procesado... ('+percentComplete+'%)</p><div class="progress progress-striped active"><div class="progress-bar progress-bar-info" style="width: '+percentComplete+'%;"></div></div>');
                        }else{
                            respuesta.html('<p class="text-center"></p>');
                        }
                      }
                    }, false);
                    return xhr;
                },
                success: function(data) {
                    //console.log(data);
                  respuesta.html("");
                    $(".loadGuardadof").html("");
                  $(".panfupdate").css('display','block');

                 $(".cajaupdate").html(data);                             
         if (ajax=="personalAjax") {
            makeCodeupdate();
hidenCese();
inputbrevete("update");
         }


              },
              error: function(xhr) { // if error occured
                
   new PNotify({
      title: 'Algo Salio Mal',
      text: 'Intente Nuevamente',
      type: 'error'
    });

                },
              });     

               var view=$("#view").val();
               if(view != "sae"){
$("#modalEditForm").addClass("modal-block-full");
               }
          $.magnificPopup.open({
               items: {
                   src: '#modalEditForm'
               },
               type: 'inline',
                preloader: true,
                modal: true

           });

       $(".mfp-bg").addClass("capa1");
$(".mfp-wrap").addClass('capa2');

   
}

function getDetaillistmanifest(saveupdate,url){
var ajax="manifiestoAjax";
var ta=0;

if ($("input[name='ta']:radio").is(':checked')) {
   ta= $('input:radio[name=ta]:checked').val();
}
   $.get(url+"ajax/"+ajax+".php", {listubmf:'yes',ta:ta}, function(respuesta){
       var dataObj =  JSON.parse(respuesta);
$("#origen"+saveupdate).html(dataObj.htmlorigen);
    $("#destino"+saveupdate).html(dataObj.htmldest);

  $(".detallemanifiest"+saveupdate).html("");
          $(".validerCarga"+saveupdate).val("not");
     });

}

var listarDatablebusq=function (){

var urlglobal=$("#url").val();
var ajax=$("#ajax").val();
    var view=$("#view").val();
     var busqueda={};
    busqueda.datatable2="yes"; 
    if (view!="shipmenttraking") {
  var fechab1=$("#fechasb1").val();
          var fechab2=$("#fechasb2").val();
            var client =$('select[name="labsbusq2"]').val();
      busqueda.fecha1=fechab1;    
      busqueda.fecha2=fechab2;  
      busqueda.lab=client;     
    }
 
    if (view=="shipmenttraking") {

      
  var fechab1=$("#fechasb1").val();
          var fechab2=$("#fechasb2").val();
            var distr =$('select[name="distrbusq2"]').val();
      busqueda.fecha1=fechab1;    
      busqueda.fecha2=fechab2;  
      busqueda.distrito=distr;


}


         tabladatabusqsegui=$('#datatable-default2').DataTable({
             "processing": true,
                "serverSide":true,
                 "destroy":true,
            "autoWidth": false,
        fixedColumns: true,
                  initComplete: function() {
                     $('.dataTables_filter input').unbind();
                     $('.dataTables_filter input').bind('keyup', function(e){
                         var code = e.keyCode || e.which;
                         if (code == 13) { 
                             tabladatabusqsegui.search(this.value).draw();
                         }
                     });
                 },

                  "order": [[ 0, "desc" ]],

                "ajax":{
             url:urlglobal+"ajax/"+ajax+".php",
                    type:"post",
                    'data': busqueda
                },
                       "createdRow": function(row, data, dataIndex) {
    if (view == "solicitud") {
      var stylo=data[0];
              stylo=stylo.split("+");
   // console.log(stylo);
    $(row).css("background", stylo[1]);
     // $(row).addClass("warning");
    }
  }

            });
         $('.dataTables_filter input').addClass('form-control');
         $(".dataTables_filter input").attr("placeholder","Search");

  }

function rellEditVf3(datajs,ajax,url,campo){
  var cr=datajs.caja;
 var respc=datajs.respuesta;
 var respuesta=$('.'+respc);
 $("."+cr).css('display','none');
 $.ajax({
                 type:"GET",
                   url:url+"/ajax/"+ajax+".php",
                  data: "&formupdate=&&"+campo+"="+datajs.idBd+"&&fase="+datajs.fase+"&&type="+datajs.type,           
                  xhr: function(){
                    $("."+respc).html('<i class="fa fa-spinner fa-spin fa-2x fa-fw"></i>');
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress", function(evt) {
                      if (evt.lengthComputable) {
                        var percentComplete = evt.loaded / evt.total;
                        percentComplete = parseInt(percentComplete * 100);
                        if(percentComplete<100){
                            respuesta.html('<p class="text-center">Procesado... ('+percentComplete+'%)</p><div class="progress progress-striped active"><div class="progress-bar progress-bar-info" style="width: '+percentComplete+'%;"></div></div>');
                        }else{
                            respuesta.html('<p class="text-center"></p>');
                        }
                      }
                    }, false);
                    return xhr;
                },
                success: function(data) {
               

                  respuesta.html("");
                    $("."+cr).html("");
                  $("."+cr).css('display','block');
     
if (datajs.type=="save") {
  $(".caja-saveform").html(data);
  $.magnificPopup.open({
               items: {
                   src: '#modalSaveForm'
               },
               type: 'inline',
                preloader: true,
                modal: true

           });

       $(".mfp-bg").addClass("capa1");
$(".mfp-wrap").addClass('capa2');

}
 
if (datajs.type=="update") {
  $(".caja-updateform").html(data);
  $.magnificPopup.open({
               items: {
                   src: '#modalEditForm'
               },
               type: 'inline',
                preloader: true,
                modal: true

           });

       $(".mfp-bg").addClass("capa1");
$(".mfp-wrap").addClass('capa2');

}
          /*       $("."+cr).html(data);                             
           
alert("Entroooo");*/
              },
              error: function(xhr) { // if error occured
                
   new PNotify({
      title: 'Algo Salio Mal',
      text: 'Intente Nuevamente',
      type: 'error'
    });

                },
              });   
   
}


function getDetaillistmanifest(saveupdate,url){
var ajax="manifiestoAjax";
var ta=0;
if ($("input[name='ta']:radio").is(':checked')) {
   ta= $('input:radio[name=ta]:checked').val();
}
$.get(url+"ajax/"+ajax+".php", {listubmf:'yes',ta:ta}, function(respuesta){
  var dataObj =  JSON.parse(respuesta);
  $("#origen"+saveupdate).html(dataObj.htmlorigen);
  $("#destino"+saveupdate).html(dataObj.htmldest);
  $(".detallemanifiest"+saveupdate).html("");
  $(".validerCarga"+saveupdate).val("not");
   });

}

 function changuepesosobre(input){
  // console.log(input.value);
  $(".pesoKg").val(1);
   }
function getModalidadMf(tipo){
var url=$("#url").val();
var ajax="manifiestoAjax";
var idorigen=$("#origen"+tipo).val();
var iddestino=$("#destino"+tipo).val();
var modalidad=$(".ismodalidad"+tipo).val();

if (idorigen!="" && iddestino!="") {
//var depa=$("#destino"+tipo).find('option:selected').attr('data-depa');
   $.get(url+"ajax/"+ajax+".php", {ismodalidad:modalidad,destino:iddestino,operacion:tipo,
    isresetmodalidaMf:"yes"}, function(respuesta){
       $(".inputscargos"+tipo).html(respuesta);
     });
}
else{
   $(".inputscargos"+tipo).html("");
}
     
}  


function resetmodalidaMf(){
var url=$("#url").val();
var ajax="manifiestoAjax";
var modalida=1;
var depa='not';

$.get(url+"ajax/"+ajax+".php", {ismodalidad:modalida,iddepa:depa,isresetmodalidaMf:"yes"}, function(respuesta){
       $(".inputscargossave").html(respuesta);
});

}




function cargaImgRemesa(input,saveUpdate){
    var view=$("#view").val();
    if(saveUpdate=="save"){    
      if(input.files.length>0){
  $('.cargaIB').val('1'); 
      }
   else{  
  $('.cargaIB').val('0');  
       }
}else{
if(input.files.length>0){
$('.cargaIB').val('1');  } 
 else{ 
 $('.cargaIB').val('0');
 }
}
   
}



function elegirprovremesa(input,tipof,type,ajax,url){
var idDepartamento=$(input).val();
if (idDepartamento!="" && idDepartamento!=null) {
$.get(url+"ajax/"+ajax+".php", {idDepartamento:idDepartamento,changeDepartamento:"changeDepartamento"}, function(respuesta){
    $('select#provincia'+tipof).html(respuesta);
  $('select#provincia'+tipof).selectpicker('refresh');
     });
}
else{
    $('select#provincia'+tipof).html('');
  $('select#provincia'+tipof).selectpicker('refresh');
}
  $('select#distrito'+tipof).html('');
  $('select#distrito'+tipof).selectpicker('refresh');
}

function elegirdistriremesa(input,tipof,type,ajax,url){
var idProvincia=$(input).val();
  if (idProvincia!="" && idProvincia!=null) {
    $.get(url+"ajax/"+ajax+".php", {idProvincia:idProvincia,changeProvincia:"changeProvincia"}, function(respuesta){
    $('select#distrito'+tipof).html(respuesta);
  $('select#distrito'+tipof).selectpicker('refresh');
     });
  }else{
  $('select#distrito'+tipof).html('');
  $('select#distrito'+tipof).selectpicker('refresh');
}


}


function ubigeoptiremesa(input,tipo,url,ajax) {
  var sel=$(input);
   var val = $('option:selected', sel).attr("data-idDist");
if (val!=""&& val!=null) {
   var prov = $('option:selected', sel).attr("data-idProv");
   var depa = $('option:selected', sel).attr("data-idDepa");
   $.get(url+"ajax/"+ajax+".php", {iddeporg:depa,idprovorg:prov,iddistrorg:val,ubigeopti:"yes"}, function(respuesta){
var listado= JSON.parse(respuesta);
    $("select#departamentoorigen"+tipo).html(listado.depart);
  $('select#departamentoorigen'+tipo).selectpicker('refresh');
    $("select#provinciaorigen"+tipo).html(listado.provincia);
  $('select#provinciaorigen'+tipo).selectpicker('refresh');
    $("select#distritoorigen"+tipo).html(listado.distrito);
      $('select#distritoorigen'+tipo).selectpicker('refresh');
     });

   }
}


function rellGroupRemesa(url,ajax){
  var ms=$(".princiupdate");

       $.magnificPopup.open({
               items: { src:'#modalEditForm' },
               type: 'inline',
                preloader: true,
                modal: true
           });
  $("#modalEditForm").addClass("modal-block-full");
    $(".mfp-bg").addClass("capa1");
       $(".mfp-wrap").addClass('capa2');
  $.get(url+"ajax/"+ajax+".php", {FaseGroup:"save"}, function(respuesta){          
ms.html(respuesta);
  $('[data-plugin-timepicker]').each(function() {
        var $this = $( this ),  opts = {};
        var pluginOptions = $this.data('plugin-options');
        if (pluginOptions)
          opts = pluginOptions;
        $this.themePluginTimePicker(opts);
      });
  $('[data-plugin-datepicker]').each(function() {
        var $this = $( this ),
          opts = {};
        var pluginOptions = $this.data('plugin-options');
        if (pluginOptions)
          opts = pluginOptions;
        $this.themePluginDatePicker(opts);
      });

     });
}




function redEditGroupRemesa(dataid,fase,saveupdate,ajax,url,campo){
 $("."+campo).val(dataid);
 var respuesta=$('.RespuestaAjaxf');
 $(".panfupdate").css('display','none');
 $.ajax({       type:"GET",
                   url:url+"/ajax/"+ajax+".php",
                  data: "&mockupgroupremesa="+saveupdate+"&&"+campo+"="+dataid+"&&idFaseRemesa="+fase,            
                  xhr: function(){
                    $(".loadGuardadof").html('<i class="fa fa-spinner fa-spin fa-2x fa-fw"></i>');
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress", function(evt) {
                      if (evt.lengthComputable) {
                        var percentComplete = evt.loaded / evt.total;
                        percentComplete = parseInt(percentComplete * 100);
                        if(percentComplete<100){
  respuesta.html('<p class="text-center">Procesado... ('+percentComplete+'%)</p><div class="progress progress-striped active"><div class="progress-bar progress-bar-info" style="width: '+percentComplete+'%;"></div></div>');
                        }else{
    respuesta.html('<p class="text-center"></p>');
                        }
                      }
                    }, false);
                    return xhr;
                },
                success: function(data) {
                  respuesta.html("");
                    $(".loadGuardadof").html("");
                  $(".panfupdate").css('display','block');
                 $(".princiupdate").html(data);                           
              },
              error: function(xhr) {
   new PNotify({
      title: 'Algo Salio Mal',
      text: 'Intente Nuevamente',
      type: 'error'
    });
                },
              });     

               var view=$("#view").val();
                  $("#modalEditForm").addClass("modal-block-full");
          $.magnificPopup.open({
               items: {
                   src: '#modalEditForm'
               },
               type: 'inline',
                preloader: true,
                modal: true
           });

       $(".mfp-bg").addClass("capa1");
       $(".mfp-wrap").addClass('capa2');
}



 function recupEditRemesa(dataid,fase){
var url=$("#url").val();
var ajax=$("#ajax").val();
console.clear();
     var ms=$(".princiupdate");
 $(".idRemesa").val(dataid);

$(".validerCargaupdate").val("yes");

       $.magnificPopup.open({
               items: { src: '#modalEditForm'},
               type: 'inline',
                preloader: true,
                modal: true
           });
  $("#modalEditForm").addClass("modal-block-full");
 $(".mfp-bg").addClass("capa1");
$(".mfp-wrap").addClass('capa2');  
        $(".idFaseRemesa").val(fase);

   $.get(url+"ajax/"+ajax+".php", {changeDocument:"update",encryMF:dataid,encryf:fase}, function(respuesta){          
ms.html(respuesta);
if (fase==1) {
   ccargaSolicitud=parseInt($(".jsonindex").val());
 indexObjSolicitud=parseInt($(".jsonindex").val());
       $('[data-plugin-selectTwo]').each(function() {
        var $this = $( this ),
          opts = {};

        var pluginOptions = $this.data('plugin-options');
        if (pluginOptions)
          opts = pluginOptions;

        $this.themePluginSelect2(opts);
      });

}
  $('[data-plugin-timepicker]').each(function() {
        var $this = $( this ),  opts = {};
        var pluginOptions = $this.data('plugin-options');
        if (pluginOptions)
          opts = pluginOptions;
        $this.themePluginTimePicker(opts);
      });

  $('[data-plugin-datepicker]').each(function() {
        var $this = $( this ),
          opts = {};

        var pluginOptions = $this.data('plugin-options');
        if (pluginOptions)
          opts = pluginOptions;

        $this.themePluginDatePicker(opts);
      });

     });
}



function changuestatusremesagroup(input,index) {
 if ($(input).is(':checked') ) {
  $(".verifi"+index).val(1);
    } else {
  $(".verifi"+index).val(0);

    }

}

function listclientchanguecontrol(){
  var url=$("#url").val();
var ajax="charguecontrolAjax";
  var ms=$(".select.idTypeService");
var idTypeServiceencry=$("select.idTypeService").val();
 $.get(url+"ajax/"+ajax+".php", {listclientecontrol:"save",idTypeService:idTypeServiceencry},
  function(respuesta){ ms.html(respuesta).selectpicker('refresh');});
}


function rellGroupRemesaAJ(){
  var ms=$(".princiupdate");
  var url=$("#url").val();
var ajax="remesaAjax";
 $(".mfp-bg").addClass("capa1");
$(".mfp-wrap").addClass('capa2');  
       $.magnificPopup.open({
               items: { src:'#modalEditForm' },
               type: 'inline',
                preloader: true,
                modal: true
           });
  $("#modalEditForm").addClass("modal-block-full");
  $.get(url+"ajax/"+ajax+".php", {FaseGroup:"save"}, function(respuesta){          
ms.html(respuesta);
  $('[data-plugin-timepicker]').each(function() {
        var $this = $( this ),  opts = {};
        var pluginOptions = $this.data('plugin-options');
        if (pluginOptions)
          opts = pluginOptions;
        $this.themePluginTimePicker(opts);
      });
  $('[data-plugin-datepicker]').each(function() {
        var $this = $( this ),
          opts = {};
        var pluginOptions = $this.data('plugin-options');
        if (pluginOptions)
          opts = pluginOptions;
        $this.themePluginDatePicker(opts);
      });

     });
}

function rellSaveRemesa(){

  var ms=$(".princiusave");
  var url=$("#url").val();
var ajax="remesaAjax";
  $.get(url+"ajax/"+ajax+".php", {mockupsavef1:"save"}, function(respuesta){          
ms.html(respuesta);
  $('[data-plugin-timepicker]').each(function() {
        var $this = $( this ),  opts = {};
        var pluginOptions = $this.data('plugin-options');
        if (pluginOptions)
          opts = pluginOptions;
        $this.themePluginTimePicker(opts);
      });
  $('[data-plugin-datepicker]').each(function() {
        var $this = $( this ),
          opts = {};
        var pluginOptions = $this.data('plugin-options');
        if (pluginOptions)
          opts = pluginOptions;
        $this.themePluginDatePicker(opts);
      });
       $('[data-plugin-selectTwo]').each(function() {
        var $this = $( this ),
          opts = {};

        var pluginOptions = $this.data('plugin-options');
        if (pluginOptions)
          opts = pluginOptions;

        $this.themePluginSelect2(opts);
      });
  $('[data-plugin-selectpicker]').each(function() {
      if( /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent) ) {
  $(this).selectpicker();
}else{
      $(this).selectpicker();
}
      });
//aquiii programo

  $("#defaultCheck1").change(function(){
    

    if ($(this).is(':checked')) {
        $(".lblNo").text("SI");
    }else{
         $(".lblNo").text("NO");
    }
  })


     });




}

function changuesecurityseal(element) {
if($(element).val()!='' ) {
            $(".securityseal").val("");
$('#noaplicaveh').prop('checked', true);
}else{
  $(".securityseal").val("WCE-OP-");
  $('#noaplicaveh').prop('checked', false);
}
}

function cargaImgstraking(input){
     if(input.files.length>0){
  $(".isimage").val(1);
      }
      else{
          var urlglobal=$("#url").val();
var link=urlglobal+"view/assets/adjuntosseguimiento/imgdefauld.jpg";
   $(".isimage").val(0);
      }
      }

  function resetmSeguimientoTrack(){
  $(".caja-saveform").html("");
  $(".caja-updateform").html("");
  tabladata2.ajax.reload(null, false);
removeAdjuntosSegui=[];

  }    

 function resetControlcargo(){
  $(".caja-saveform").html("");
  $(".caja-updateform").html("");
  tabladata.ajax.reload(null, false);
  }    

var listarDatablebustraking=function (){
var urlglobal=$("#url").val();
var ajax=$("#ajax").val();
    var view=$("#view").val();
     var busqueda={};
    busqueda.datatable="yes"; 
    if (view=="servicetracking") {
 var isservice=$("#isnivel").val();
busqueda.isservice=isservice;
       busqueda.status=1 ;
    var fechab1=$("select#servbusq1").val();
busqueda.idTypeService=fechab1;
    }

    if (view=="registerbd") {
 var isservice=$("#isnivel").val();
busqueda.isservice=isservice;
       busqueda.status=1;
       var encrydestino=$("select#destinobusq").val();
busqueda.destino=encrydestino;
       var idserv=$("select#servbusq1").val();
busqueda.idTypeService=idserv;
}

         tabladata2=$('#datatable-default2').DataTable({
             "processing": true,
                "serverSide":true,
                 "destroy":true,
            "autoWidth": false,
        fixedColumns: true,
                  initComplete: function() {
                     $('.dataTables_filter input').unbind();
                     $('.dataTables_filter input').bind('keyup', function(e){
                         var code = e.keyCode || e.which;
                         if (code == 13) { 
                             tabladata2.search(this.value).draw();
                         }
                     });
                 },

                  "order": [[ 0, "desc" ]],

                "ajax":{
             url:urlglobal+"ajax/"+ajax+".php",
                    type:"post",
                    'data': busqueda
                },
                       "createdRow": function(row, data, dataIndex) {
    if (view == "solicitud") {
      var stylo=data[0];
     stylo=stylo.split("+");
    $(row).css("background", stylo[1]);
    }
  }
            });
         $('.dataTables_filter input').addClass('form-control');
         $(".dataTables_filter input").attr("placeholder","Search");

  }

  $(document).on('click', '.modalformSEGUIFR-dismiss', function (e) {
    e.preventDefault();
    $.magnificPopup.close();
     resetmSeguimientoTrack();
 });

$(document).on('click', '.modalformCC-dismiss', function (e) {
    e.preventDefault();
    $.magnificPopup.close();
     resetControlcargo();
 });


function ResetFormSaveordenDespacho(){
  var ms=$(".cajaprinci-saveform");
  var url=$("#url").val();
var ajax="dispatchorderAjax";
ms.html('');
  $.get(url+"ajax/"+ajax+".php", {mockupsave:"save"}, function(respuesta){          
ms.html(respuesta);
  $('[data-plugin-timepicker]').each(function() {
        var $this = $( this ),  opts = {};
        var pluginOptions = $this.data('plugin-options');
        if (pluginOptions)
          opts = pluginOptions;
        $this.themePluginTimePicker(opts);
      });
  $('[data-plugin-datepicker]').each(function() {
        var $this = $( this ),
          opts = {};
        var pluginOptions = $this.data('plugin-options');
        if (pluginOptions)
          opts = pluginOptions;
        $this.themePluginDatePicker(opts);
      });
       $('[data-plugin-selectTwo]').each(function() {
        var $this = $( this ),
          opts = {};
        var pluginOptions = $this.data('plugin-options');
        if (pluginOptions)
          opts = pluginOptions;

        $this.themePluginSelect2(opts);
      });
  $('[data-plugin-selectpicker]').each(function() {
      if( /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent) ) {
  $(this).selectpicker();
}else{
      $(this).selectpicker();
}
      });

     });
}



function busqdispachorderV2(input,ajax,url){
var idClient=$(input).val();
if (idClient!="" && idClient!=null) {
$.get(url+"ajax/"+ajax+".php", {idClient:idClient,busqdetalle:"yes"}, function(respuesta){
   $('.scriptsave').html(respuesta);
     });
}
else{
    $('select.idContactoClientesave').html('');
  $('select.idContactoClientesave').selectpicker('refresh');
$('.detallecargasave').html('');
$('.scriptsave').html('');
$('.indexcarga').val('');
}

}



function redEditdispachorder(dataid,fase,saveupdate,ajax,url,campo){
 $("."+campo).val(dataid);
 var respuesta=$('.RespuestaAjaxf');
 $(".panfupdate").css('display','none');
 $.ajax({       type:"GET",
                   url:url+"/ajax/"+ajax+".php",
                  data: "&mockupdispachtorder="+saveupdate+"&&"+campo+"="+dataid+"&&idfasedispatchorder="+fase,            
                  xhr: function(){
                    $(".loadGuardadof").html('<i class="fa fa-spinner fa-spin fa-2x fa-fw"></i>');
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress", function(evt) {
                      if (evt.lengthComputable) {
                        var percentComplete = evt.loaded / evt.total;
                        percentComplete = parseInt(percentComplete * 100);
                        if(percentComplete<100){
  respuesta.html('<p class="text-center">Procesado... ('+percentComplete+'%)</p><div class="progress progress-striped active"><div class="progress-bar progress-bar-info" style="width: '+percentComplete+'%;"></div></div>');
                        }else{
    respuesta.html('<p class="text-center"></p>');
                        }
                      }
                    }, false);
                    return xhr;
                },
                success: function(data) {
                  respuesta.html("");
                    $(".loadGuardadof").html("");
                  $(".panfupdate").css('display','block');
                 $(".cajaupdate").html(data);                           
              },
              error: function(xhr) {
   new PNotify({
      title: 'Algo Salio Mal',
      text: 'Intente Nuevamente',
      type: 'error'
    });
                },
              });     

               var view=$("#view").val();
                  $("#modalEditForm").addClass("modal-block-full");
          $.magnificPopup.open({
               items: {
                   src: '#modalEditForm'
               },
               type: 'inline',
                preloader: true,
                modal: true
           });

       $(".mfp-bg").addClass("capa1");
       $(".mfp-wrap").addClass('capa2');
}


var indexfils=1;
function addinputfiles(){
indexfils++;
var template='<div class="subcfile'+indexfils+'"> <input type="file" id="image'+indexfils+'" class="btn btn-primary" name="image[]" accept="image/*" required style="width:50%; display:inline-block;" > <a href="javascript:void(0);" onclick="javascript:removefileinput('+indexfils+')" class="btn btn-danger btn-sm" title="Eliminar"><i class="fa-solid fa-trash"> </i></a>  </div> ';
$(".caja-files").append(template);
}

function removefileinput(indice){
$(".subcfile"+indice).remove();
}
   function onDeleteAdjSeguimiento(index){
     removeAdjuntosSegui.push({
    idremove:index,
     operacion: "delete"
  });
  var convert=JSON.stringify(removeAdjuntosSegui);
    $('.jsonDeleteCarga').val(convert); 
     $(".itemadj"+index).remove();
   }


function busqgalleryseguimiientoV2(encry,ajax,url){
   $('.galleryimages').html('');
$.get(url+"ajax/"+ajax+".php", {encryfoto:encry,busqgallery:"yes"}, function(respuesta){
   $('.galleryimages').html(respuesta);
   $.magnificPopup.open({
               items: {
                   src: '#modalGaleriaSeguimiento'
               },
               type: 'inline',
                preloader: true,
                modal: true
           });
     });
}



function busqobsseguimiientoV2(encry,ajax,url){
   $('.scriptobs').html('');
$.get(url+"ajax/"+ajax+".php", {encrydata:encry,busqobsseguiv2:"yes"}, function(respuesta){
   $('.scriptobs').html(respuesta);
   $.magnificPopup.open({
               items: {
                   src: '#modalObsevacionSeguimiento'
               },
               type: 'inline',
                preloader: true,
                modal: true
           });
     });
}



function resetmSeguimientoReg() {
$(".caja-saveform").html("");
updatelistdestregister();
}
  $(document).on('click', '.modalformRegistr-dismiss', function (e) {
    e.preventDefault();
    $.magnificPopup.close();
     resetmSeguimientoRegupdate();
 });


function resetmSeguimientoRegupdate() {
$(".caja-updateform").html("");
}

function updatelistdestregister() {
var urlglobal=$("#url").val();
var ajax=$("#ajax").val();
$.get(urlglobal+"ajax/"+ajax+".php", {updatelistdest:"yes"}, function(respuesta){
$("select#destinobusq").html(respuesta).selectpicker('refresh');
            });
}

function changuedisplayobsreprogaming(element) {
  var valuestatus=$(element).val();
 
  if (valuestatus==1) {
    $('.cajareprograming').css('display', 'none');
  }
    if (valuestatus==2) {
    $('.cajareprograming').css('display','inline-block');
}
}
function listdestinoregister(url,ajax) {
var typeserv=$("select#servbusq1").val();
if (typeserv!='' && typeserv!=null) {
  $("select#destinobusq").html('');
  $('select#destinobusq').selectpicker('refresh');

$.get(url+"ajax/"+ajax+".php", {updatelistdesreg:"yes",encryserv:typeserv}, function(respuesta){
$("select#destinobusq").html(respuesta);
  $('select#destinobusq').selectpicker('refresh');
  });
}
else{
$.get(url+"ajax/"+ajax+".php", {resetlistdesreg:"yes"}, function(respuesta){
$("select#destinobusq").html(respuesta);
  $('select#destinobusq').selectpicker('refresh');
  });
}
}


function listdestinoregisterbd(url,ajax) {
var typeserv=$("select#servbusq").val();
if (typeserv!='' && typeserv!=null) {
  $("select#destinobusq").html('');
  $('select#destinobusq').selectpicker('refresh');

$.get(url+"ajax/"+ajax+".php", {updatelistdesregbd:"yes",encryserv:typeserv}, function(respuesta){
$("select#destinobusq").html(respuesta);
  $('select#destinobusq').selectpicker('refresh');
  });
}
else{
$.get(url+"ajax/"+ajax+".php", {resetlistdesregbd:"yes"}, function(respuesta){
$("select#destinobusq").html(respuesta);
  $('select#destinobusq').selectpicker('refresh');
  });
}
}

function detailliquidacioncontrol(url,ajax){
$(".cargaliquidacion").html('');
var idxclient=$("select.idClientsave").val();
if (idxclient!='' && idxclient!=null) {
$.get(url+"ajax/"+ajax+".php", {busqliquidacioncontrol:"yes",idClient:idxclient}, function(respuesta){
    $(".cargaliquidacion").html(respuesta);
  });
}
}

function rellEditLiquicargos(ajax,url,saveUpdate){
 var respuesta=$('.RespuestaAjaxcuLiquidacion');
 $(".caja-saveformLiquidacion").css('display','none');
 $.ajax({
                 type:"GET",
                   url:url+"/ajax/"+ajax+".php",
                  data: "&formupdate=yes&fase=2&type="+saveUpdate,           
                  xhr: function(){
                    $(".RespuestaAjaxcuLiquidacion").html('<i class="fa fa-spinner fa-spin fa-2x fa-fw"></i>');
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress", function(evt) {
                      if (evt.lengthComputable) {
                        var percentComplete = evt.loaded / evt.total;
                        percentComplete = parseInt(percentComplete * 100);
                        if(percentComplete<100){
                            respuesta.html('<p class="text-center">Procesado... ('+percentComplete+'%)</p><div class="progress progress-striped active"><div class="progress-bar progress-bar-info" style="width: '+percentComplete+'%;"></div></div>');
                        }else{
                            respuesta.html('<p class="text-center"></p>');
                        }
                      }
                    }, false);
                    return xhr;
                },
                success: function(data) {
                  respuesta.html("");
                    $(".caja-saveformLiquidacion").html("");
                    $(".caja-saveformLiquidacion").html(data);
                  $(".caja-saveformLiquidacion").css('display','block');
              },
              error: function(xhr) { // if error occured
                
   new PNotify({
      title: 'Algo Salio Mal',
      text: 'Intente Nuevamente',
      type: 'error'
    });

                },
              });   
   
}


 $(document).on('click', '.modalform-confirmlq', function (e) {
    e.preventDefault();
    var tipo=$("#selectformlq").val();
DatosFormularioliqui(e,tipo);
      
    });

function vermodalFormLiqui(tipo){
  $("#selectformlq").val(tipo);
   $.magnificPopup.open({
               items: {
                   src: '#modalOperacionLiquidacion'
               },
               type: 'inline',
                preloader: true,
                modal: true
           });
}

$(document).on('click', '.modalform-dismisslq', function (e) {
    e.preventDefault();
    $.magnificPopup.close();
 });

  function DatosFormularioliqui(e,tipo){
    e.preventDefault();
var element="";
if (tipo=="save") {element=".formAjax3";}
if (tipo=="update") {element=".formAjax3";}
        var form=$(element);

        var tipo=form.attr('data-form');
        var ajax = form.attr('data-ajax');
        var accion=form.attr('action');
        var metodo=form.attr('method');
        var urlhttp = form.attr('data-urlhttp');
        var respuesta=$('.RespuestaAjax');

        var msjError="<script>new PNotify({\n\
      title: 'Regular Notice',\n\
      text: 'Check me out! I\'m a notice.',\n\
      type: 'error'\n\
    }); </script>";
        
    //nuevo
var btnModal=$(".modalform-confirmlq");
btnModal.prop('disabled', true);
btnModal.text("Cargando...");

    var form2=$(element)[0];
    var formdata = new FormData(form2);
    var textoAlerta;
        if(tipo=="save"){
             if($(".cargaIB1").val()=="1"){
        var files = $('.imgClass1')[0].files[0];
        formdata.append('file',files);     
        }
            textoAlerta="Los datos que enviaras quedaran almacenados en el sistema";
        }else if(tipo==="delete"){
            textoAlerta="Los datos serán eliminados completamente del sistema";
        }else if(tipo==="update"){
                   if($(".cargaIB2").val()=="1"){
        var files = $('.imgClass2')[0].files[0];
        formdata.append('file',files);     
        }
            textoAlerta="Los datos del sistema serán actualizados";
        }else{
            textoAlerta="Quieres realizar la operación solicitada";
        }  
$.ajax({
                type: metodo,
                url: accion,
                data: formdata ? formdata : form.serialize(),
                cache: false,
                contentType: false,
                processData: false,
                xhr: function(){
                    $(".loadGuardado").html('<i class="fa fa-spinner fa-spin fa-2x fa-fw"></i>');
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress", function(evt) {
                      if (evt.lengthComputable) {
                        var percentComplete = evt.loaded / evt.total;
                        percentComplete = parseInt(percentComplete * 100);
                        if(percentComplete<100){
    respuesta.html('<p class="text-center">Procesado... ('+percentComplete+'%)</p><div class="progress progress-striped active"><div class="progress-bar progress-bar-info" style="width: '+percentComplete+'%;"></div></div>');
                        }else{
                            respuesta.html('<p class="text-center"></p>');
                        }
                      }
                    }, false);
                    return xhr;
                },
                success: function (data) {
   btnModal.prop('disabled', false);
              btnModal.text("Confirmar");
                    $(".loadGuardado").html("");
                    respuesta.html(data);
                    $.magnificPopup.close();
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                      if (XMLHttpRequest.readyState == 4) {
                    respuesta.html(msjError);
        }
        else if (XMLHttpRequest.readyState == 0) {
          var mserrointernet="  <script>$('.mfp-bg').css('z-index', '900');   \n\
        new PNotify({\n\
      title: 'Algo Salio Mal',\n\
      text: 'Conexion de internet fallida.. ',\n\
      type: 'error'\n\
    });\n\
        </script>";
        $("body").append(mserrointernet);
        }
        else {
         respuesta.html(msjError);
        }
                }
            });
  }

function adddetaildispachtorder(saveupdate){
var html = '<tr>  <td><input type="hidden" value="0" name="idDetaildispatch[]">   <input type="hidden" name="operation[]" value="save">  <input  type="number" name="ncarta[]" class="inputtable"     max="9999999999" data-maxlength="10" min="0" oninput="this.value=this.value.slice(0,this.dataset.maxlength)" > </td> <td><div class="col-sm-12"> <div class="form-group"> <textarea maxlength="350" rows="2" class="inputtable detalleenvio"  name="observationsdistpacht[]"  > </textarea> </div> </div>  </td> <td><div class="form-group"><label for="avatar">Documento</label><input type="file" class="btn btn-primary" name="image[]"  ></div> </td>  <td> <button onclick="deleteRow(this)" class="btnEliminardetaill btn btn-danger">Eliminar</button></td></tr>';
$('.detallecarga'+saveupdate).append(html);
  ccargaSolicitud=ccargaSolicitud+1;
$(".indexcarga"+saveupdate).val(ccargaSolicitud);
}

function deleteRow(btn) {
  var row = btn.parentNode.parentNode;
  row.parentNode.removeChild(row);
    ccargaSolicitud=ccargaSolicitud-1;
}
 function onDeleteCargaDispachT2(index,btn){
  var encry=$("#encry"+index).val();
     removeCarga.push({
    idremove:encry,
     operacion: "delete"
  });
  var convert=JSON.stringify(removeCarga);
  $('.jsonDeleteCarga').val(convert); 
  var row = btn.parentNode.parentNode;
  row.parentNode.removeChild(row);
  ccargaSolicitud=ccargaSolicitud-1;
$(".indexcarga"+saveupdate).val(ccargaSolicitud);
   }

   function ongroupCarga(ajax,url){
       var array = [];
    var valider= false;
var ijs=0;
var indiceini=0; var indicedestino=0;
               if (typeof tabladata != 'undefined') { 
tabladata.destroy();

$("input.idDetalleCargabdx[type=checkbox]:checked").each(function(){
var r=$(this).val();
if(ijs==0){
indiceini= $(".bxorigen"+r).val();
indicedestino=$(".bxdestino"+r).val();
valider=true;
}
if(ijs>=1 && indiceini==$(".bxorigen"+r).val()){
valider=true;
}

if(ijs>=1 && indiceini!=$(".bxorigen"+r).val()){
valider=false;
}
  array.push({idDetalleCarga:$(this).val()});
     ijs++;
});
listarDatable();

}
    
if(ijs>=1 && valider==true){

      var  arraytmp= JSON.stringify(array);
 var respuesta=$('.loadGuardadocu');
 $.ajax({    type:"GET",
                   url:url+"/ajax/"+ajax+".php",
    data: "&formupdate=yes&fase=1&type=save&jstemp="+arraytmp+"&depaorigen="+indiceini+"&depadestino="+indicedestino,           
                  xhr: function(){
                    $(".loadGuardadocu").html('<i class="fa fa-spinner fa-spin fa-2x fa-fw"></i>');
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress", function(evt) {
                      if (evt.lengthComputable) {
                        var percentComplete = evt.loaded / evt.total;
                        percentComplete = parseInt(percentComplete * 100);
                        if(percentComplete<100){
                            respuesta.html('<p class="text-center">Procesado... ('+percentComplete+'%)</p><div class="progress progress-striped active"><div class="progress-bar progress-bar-info" style="width: '+percentComplete+'%;"></div></div>');
                        }else{
                            respuesta.html('<p class="text-center"></p>');
                        }
                      }
                    }, false);
                    return xhr;
                },
                success: function(data) {
                  respuesta.html("");
                    $(".caja-saveform").html("");
$(".caja-saveform").html(data);
 $.magnificPopup.open({
               items: {src:'#modalSaveForm'},
               type: 'inline',
               preloader: true,
               modal: true
           });
              },
              error: function(xhr) { // if error occured         
   new PNotify({
      title: 'Algo Salio Mal',
      text: 'Intente Nuevamente',
      type: 'error'
    });
                },
              });   
   
}else{
listarDatable();

if(ijs>=1&&valider==false){
  new PNotify({
     title: 'Info',
      text: 'Los origen deben se igual',
      type: 'error'
    });
}
if(ijs==0){
 new PNotify({
     title: 'Info',
      text: 'Seleccione una carga',
      type: 'error'
    });
}

  
}
   }

   $(document).on('click', '.modalformGCarga-dismiss', function (e) {
    e.preventDefault();
    $.magnificPopup.close();
listarDatable();
 });



var listarDatableGroupLiquicargacontrol=function (){
var urlglobal=$("#url").val();
var ajax=$("#ajax").val();
    var view=$("#view").val();
     var busqueda={};
    var statu = 1;
    busqueda.datatableglc="yes";
     busqueda.status=statu;
  var fechab1=$("#fechasbd1").val();
  var fechab2=$("#fechasbd2").val();
      busqueda.fecha1=fechab1;    
      busqueda.fecha2=fechab2; 
         tabladataglc=$('#datatable-defaultrc').DataTable({
            "processing": true,
            "serverSide":true,
            "destroy":true,
            "autoWidth":false,
            "fixedColumns": true,
                  initComplete: function() {
                     $('.dataTables_filter input').unbind();
                     $('.dataTables_filter input').bind('keyup', function(e){
                         var code = e.keyCode || e.which;
                         if (code == 13) { 
                             tabladataglc.search(this.value).draw();
                         }
                     });
                 },
                  "order": [[ 0, "desc" ]],
                "ajax":{
             url:urlglobal+"ajax/"+ajax+".php",
                    type:"post",
                    'data': busqueda
                }

            });
         $('.dataTables_filter input').addClass('form-control');
         $(".dataTables_filter input").attr("placeholder","Search");
  }



function rellEditcc2(datajs,ajax,url,campo){
  var cr=datajs.caja;
 var respc=datajs.respuesta;
 var respuesta=$('.'+respc);
 $("."+cr).css('display','none');
 $.ajax({
                 type:"GET",
                   url:url+"/ajax/"+ajax+".php",
                  data: "&formupdate=&&"+campo+"="+datajs.idClient+"&&fase="+datajs.fase+"&&type="+datajs.type,           
                  xhr: function(){
                    $("."+respc).html('<i class="fa fa-spinner fa-spin fa-2x fa-fw"></i>');
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress", function(evt) {
                      if (evt.lengthComputable) {
                        var percentComplete = evt.loaded / evt.total;
                        percentComplete = parseInt(percentComplete * 100);
                        if(percentComplete<100){
                            respuesta.html('<p class="text-center">Procesado... ('+percentComplete+'%)</p><div class="progress progress-striped active"><div class="progress-bar progress-bar-info" style="width: '+percentComplete+'%;"></div></div>');
                        }else{
                            respuesta.html('<p class="text-center"></p>');
                        }
                      }
                    }, false);
                    return xhr;
                },
                success: function(data) {
                  respuesta.html("");
                    $("."+cr).html("");
                  $("."+cr).css('display','block');
if (datajs.type=="save") {
  $(".caja-saveform").html(data);
  $.magnificPopup.open({
               items: {
                   src: '#modalSaveForm'
               },
               type: 'inline',
                preloader: true,
                modal: true
           });
  $(".mfp-bg").addClass("capa1");
$(".mfp-wrap").addClass('capa2');
}
 
if (datajs.type=="update") {
  $(".caja-updateform").html(data);
  $.magnificPopup.open({
               items: {
                   src: '#modalEditForm'
               },
               type: 'inline',
                preloader: true,
                modal: true
           });
       $(".mfp-bg").addClass("capa1");
$(".mfp-wrap").addClass('capa2');
}
      
              },
              error: function(xhr) { // if error occured         
   new PNotify({
      title: 'Algo Salio Mal',
      text: 'Intente Nuevamente',
      type: 'error'
    });
                },
              });   
}


function getnumberserie(ajax,url,saveupdate) {
var idserietr=$('select[name="snDocumento'+saveupdate+'"]').val();
if(idserietr!="" && idserietr!=null){
 $.get(url+"ajax/"+ajax+".php", {infonumber:"yes",indexObjSolicitud:indexObjSolicitud,idserietr:idserietr}, function(respuesta){
$(".nDocumento"+saveupdate).val(respuesta);
  });
}
 else{
   $(".nDocumento"+saveupdate).val('');
 }
}



function elegirprovdestmultiremesa(el,tipo,saveupdate){
var url=$("#url").val();
var ajax="remesaAjax";
console.log("--"+saveupdate);
 getDataMutiemesa(ajax,url,tipo,saveupdate);
}
function getDataMutiemesa(ajax,url,tipo,saveupdate){
  $("#provincia"+tipo).html("");
var idDepartamento=$('select[name="departamento'+tipo+'"]').val();
  
      $("#provincia"+tipo).select2("destroy");
      $("#provincia"+tipo).html("");
      $("#distrito"+tipo).select2("destroy");
      $("#distrito"+tipo).html("");
      $("#distrito"+tipo).select2({width: '100%'});
      

   $.get(url+"ajax/"+ajax+".php", {idDepartamento:idDepartamento,changeDepartamento:"changeDepartamento"},
    function(respuesta){
    var  data=JSON.parse(respuesta);
    $("#provincia"+tipo).html(data.provincia);
    $("#provincia"+tipo).select2({width:'100%'});       
  
     });
}



function getReportRemesa(url,nivel) {
var encryuuser=$("#encryuuser").val();
var roluserency=$("#roluserency").val(); 
var fecha1=$("#fechab1").val();
var fecha2=$("#fechab2").val();
  var statu = 1;
if($("#myonoffswitch").is(":checked")) {
     statu = 1;
}else{
    statu = 0;
}

url+="?fecha1="+fecha1+"&fecha2="+fecha2+"&personal="+encryuuser+"&cargo="+roluserency+"&nivel="+nivel+"&status="+statu;
ventanaexcelsingle(url);
}


function redEditGalleryRemesa(dataid,ajax,url){
 var respuesta=$('.RESPGALLERY');
 $(".panfupdate").css('display','none');
 $.ajax({       type:"GET",
                   url:url+"/ajax/"+ajax+".php",
                  data: "gallery=yes&idgroupremesa="+dataid,            
                  xhr: function(){
                    $(".loadGuardadof").html('<i class="fa fa-spinner fa-spin fa-2x fa-fw"></i>');
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress", function(evt) {
                      if (evt.lengthComputable) {
                        var percentComplete = evt.loaded / evt.total;
                        percentComplete = parseInt(percentComplete * 100);
                        if(percentComplete<100){
  respuesta.html('<p class="text-center">Procesado... ('+percentComplete+'%)</p><div class="progress progress-striped active"><div class="progress-bar progress-bar-info" style="width: '+percentComplete+'%;"></div></div>');
                        }else{
    respuesta.html('<p class="text-center"></p>');
                        }
                      }
                    }, false);
                    return xhr;
                },
                success: function(data) {
                  respuesta.html("");
                    $(".RESPGALLERY").html("");
                 $(".RESPGALLERY").html(data);   
                                         
              },
              error: function(xhr) {
   new PNotify({
      title: 'Algo Salio Mal',
      text: 'Intente Nuevamente',
      type: 'error'
    });
                },
              });     

               var view=$("#view").val();
          $.magnificPopup.open({
               items: {
                   src: '#modalfotoggl'
               },
               type: 'inline',
                preloader: true,
                modal: true
           });

       $(".mfp-bg").addClass("capa1");
       $(".mfp-wrap").addClass('capa2');
}

