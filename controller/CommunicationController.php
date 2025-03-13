<?php 
if ($peticionAjax) {
  require_once "../model/CommunicationModel.php";
}else{
  require_once "./model/CommunicationModel.php";
}



class CommunicationController extends CommunicationModel{

public function formupdate(){

    $idCommunication =mainModel::limpiar_cadena($_GET['idCommunication']);
    $idCommunication= mainModel::decryption($idCommunication);
  

    $consulta = mainModel::execute_query("SELECT * FROM tcommunication WHERE idCommunication = $idCommunication");
    $req = $consulta->fetch(PDO::FETCH_ASSOC);
    $cuerpo=' <script> 
$(".title").val("'.$req['title'].'");
$(".subtitle").val("'.$req['subtitle'].'");
$(".imagen").val("'.$req['imagen'].'");
$(".emails").val("'.$req['emails'].'");
$(".idPersonal").val("'.$req['idPersonal'].'");
$(".idtypeCommunication").val("'.$req['idtypecommunication'].'");


</script>
';
return $cuerpo;
}


    public function updateCommunicationController(){

    $idCommunication= mainModel::limpiar_cadena($_POST['idCommunication']);
    $idCommunication= mainModel::decryption($idCommunication);
    $title= mainModel::limpiar_cadena($_POST['title']);
    $subtitle= mainModel::limpiar_cadena($_POST['subtitle']);
    $imagen= mainModel::limpiar_cadena($_POST['imagen']);
    $emails= mainModel::limpiar_cadena($_POST['emails']);
    $idPersonal= mainModel::limpiar_cadena($_POST['idPersonal']);
    $idtypeCommunication= mainModel::limpiar_cadena($_POST['idtypeCommunication']);
    //echo $title;

//REVISARRRRRRR
    /**$consultaidPersonal=mainModel::execute_query("SELECT * FROM tcommunication WHERE idPersonal=$idPersonal");
    if ($consultaidPersonal->rowCount()>=1) {
       $msg=["alert"=>"duplicidad","campo"=>$idPersonal];
    }else{**/

    $data=[
        "idCommunication"=>$idCommunication,
        "title"=>$title,
        "subtitle"=>$subtitle,
        "imagen"=>$imagen,
        "emails"=>$emails,
        "idPersonal"=>$idPersonal
    ];
    //var_dump($data);

   if (CommunicationModel::updateCommunicationModel($data)) {
        
        $msg=["alert"=>"save"];

    }else{
        $msg=["alert"=>"error"];

    }
//}
    return mainModel::mensajeRespuesta($msg);
}


    //ESTA FUNCION ES LA DE LISTAR EN LA VISTA DE TODOS LOS MATERIALES
  public function listCommunicationController($request,$status){
      
//ESTA FUNCION ME PERMITE CONECTARME A LA BASE DE DATOS A TRAVEZ DEL ARCHIVO MAINMODEL CON LA FUNCION CONNECT
      $cnn = mainModel::conect();
   $btn="";
      $icon="";
      if($status==1){
        $btn="danger";
        $icon="trash fa-lg";
      }else{      
        $btn="success";
        $icon="check  fa-lg";
      }

//AQUI ALMACENO LOS ATRIBUTOS DE MI TABLA DE MI BASE DE DATOS QUE QUIERO QUE SE MUESTREN EN LA VISTA
$col =array(
    0=>'idCommunication',
    1=>'title',
    2=>'subtitle',
    3=>'imagen',
    4=>'emails',
    5=>'idPersonal',
    6=>'dateRegister'
);  
$index=0;
if ($request['order'][0]['column']!=5) {
$index=$request['order'][0]['column'];
}
if ($request['order'][0]['column']==5) {
$index=0;
}

//AQUI VA LA CONSULTA SELECT A LA BASE DE DATOS
$sql ="SELECT SQL_CALC_FOUND_ROWS * FROM tcommunication WHERE status=$status";
$query= $cnn->query($sql);
 $totalData = $cnn->query("SELECT FOUND_ROWS()");
 $totalData = (int) $totalData->fetchColumn();

 //ESTO SIRVE PARA BUSCAR EN MI TABLA VISIBLE
if(!empty($request['search']['value'])){
    $sql.=" AND title Like '".$request['search']['value']."%' ";
}
$query= $cnn->query($sql);
      $totalData = $cnn->query("SELECT FOUND_ROWS()");
            $totalData = (int) $totalData->fetchColumn();
if(isset ($request['order'])){
$sql.=" ORDER BY   ".$col[$index]."   ".$request['order'][0]['dir']."   LIMIT ".
    $request['start']."  ,".$request['length']."  ";
}

//AQUI EJECUTA LA CONSULTA A LA BASE DE DATOS
$query= $cnn->query($sql);
$totalFilter=$totalData;
$data=array();
$contador=0;

//AQUI ME ESTA RECORRIENDO LOS DATOS OBTENIDOS EN LA CONSULTA SELEC A LA BASE DE DATOS
while($row = $query->fetch(PDO::FETCH_ASSOC)){
    
    //var_dump($row);
    $subdata=array();
    $contador = $contador+1;
    $encryp=mainModel::encryption($row['idCommunication']);
    $row['idCommunication']=$encryp;

//AQUI DEBEN IR EN ORDEN LOS ATRIBUTOS A MOSTRAR EN LA VISTA
    $subdata[]=$contador;
    //$sub[]=$row['ndataame'];//NO EXISTE ESTO EN LA BASE DE DATOS "ndataame"
    $subdata[]=$row['title']; 
    $subdata[]=$row['subtitle'];
    $subdata[]=$row['imagen'];
    $subdata[]=$row['emails'];
    $subdata[]=$row['idPersonal'];
    $subdata[]=$row['dateRegister']; 
    $operacionescrud="";
     
        $operacionescrud.=" <a onclick='rellEditV2(`".$encryp."`,`".'communicationAjax'."`,`".SERVERURL."`,`idCommunication`)' class='btn btn-primary btn-xs  mr-xs'  data-toggle='modal' data-target='#modalesForm' ><i class='fa-regular fa-pen-to-square'></i> </a>";

  $operacionescrud.="<button type='submit' onclick='modalOnActivaDeleteDataTable(`".'communicationAjax'."`,`".$encryp."`,".$status.",`".SERVERURL."`)' class='btn btn-".$btn." btn-xs '> <i class='fa fa-".$icon."'></i></button> ";
      
    $subdata[]=$operacionescrud;     
    $data[]=$subdata;
}
$json_data=array(
    "draw" => isset ( $request['draw'] ) ?  intval( $request['draw'] ) : 0, 
   "recordsTotal"      =>  intval($totalData),
   "recordsFiltered"   =>  intval($totalFilter),
   "data"              =>  $data
);
return json_encode($json_data);
   }
//AQUI TERMINA LA FUNCION LISTADO

//ESTA FUNCION SE ENCARGA DE HABILITAR Y DESHABILITAR REGISTROS
    public function activaDeleteBrandController($idElemento ,$status){
      $idElemento = mainModel::limpiar_cadena($idElemento);
      $idElemento=mainModel::decryption($idElemento);
 if($idElemento!=false){
 
      $status=mainModel::limpiar_cadena($status);

//AQUI PONDREMOS EL PRIMER PARAMETRO SERA EL NOMBRE EXACTO DE TU TABLA EN LA BASE DE DATOS Y EL ULTIMO PARAMETRO SERA EL ID DE LA MISMA TABLA
      if(mainModel::activateDeleteSimple("tcommunication",$idElemento,$status,"idCommunication")){
        if($status==1){
        $msg=["alert"=>"delete"]; 
      }else{
        $msg=["alert"=>"activate"];
      }
        }else{
          $msg=["alert"=>"error"];
        } 
           }else{
                      $msg=["alert"=>"error"];

           }
      return mainModel::mensajeRespuesta($msg);
    }

//FINAL DE LA FUNCION DE HABILITAR Y DESHABILITAR REGISTROS
 
public function fomUpdate(){
    
}

   public function paintForm($saveUpdate){
$titulo="";
$subtitulo="";
if ($saveUpdate=="save") {
$titulo="Registro de Communication";
$subtitulo='    <p class="panel-subtitle">
                  Por favor , llene  todos los campos y de click en guardar
                  </p>';
}
if ($saveUpdate=="update") {
$titulo="Editor de Communication";
$subtitulo='';
}
$html='
<section class="panel">
                <header class="panel-heading">
                  <h2 class="panel-title">'.$titulo.'</h2>';
$html.=$subtitulo;  
               $html.='</header>
                <div class="panel-body ">
                <div class="caja'.$saveUpdate.'"> 

                </div>
                  <div class="row mb-xs">

                    <div class="col-sm-3 mb-xs">
                      <div class="form-group">
                      <input type="hidden"  name="'.$saveUpdate.'" >
                      <input type="hidden" class="idCommunication"  name="idCommunication" >
                           <label class="control-label">TITULO <span class="required">*</span> </label>
                        <input type="text" name="idCommunication" class="form-control name"    required title="Este campo es obligatorio" >
                      </div>
                    </div>


 <div class="col-sm-3 mb-xs">
                      <div class="form-group">
                      <input type="hidden"  name="'.$saveUpdate.'" >
                      <input type="hidden" class="subtitle"  name="subtitle" >
                           <label class="control-label">SUBTITULO <span class="required">*</span> </label>
                        <input type="text" name="subtitle" class="form-control name"    required title="Este campo es obligatorio" >
                      </div>
                    </div>


<div class="col-sm-3 mb-xs">
                      <div class="form-group">
                           <label class="control-label">Tipo de Comunicación<span class="required">*</span> </label>
                        <select class="form-control mb-md idtypeCommunication" name="idtypeCommunication" required="">
                            '.mainModel::getList("SELECT * FROM ttypecommunication","idtypeCommunication").'
                     
                          </select>
                      </div>
                    </div>

  <div class="col-sm-3 mb-xs">
                      <div class="form-group">
                      <input type="hidden"  name="'.$saveUpdate.'" >
                      <input type="hidden" class="imagen"  name="imagen" >
                           <label class="control-label">IMAGEN <span class="required">*</span> </label>
                        <input type="text" name="imagen" class="form-control name"    required title="Este campo es obligatorio" >
                      </div>
                    </div>


  <div class="col-sm-3 mb-xs">
                      <div class="form-group">
                      <input type="hidden"  name="'.$saveUpdate.'" >
                      <input type="hidden" class="emails"  name="emails" >
                           <label class="control-label">EMAILS <span class="required">*</span> </label>
                        <input type="text" name="emails" class="form-control name"    required title="Este campo es obligatorio" >
                      </div>
                    </div>


    <div class="col-sm-3 mb-xs">
                      <div class="form-group">
                      <input type="hidden"  name="'.$saveUpdate.'" >
                      <input type="hidden" class="idPersonal"  name="idPersonal" >
                           <label class="control-label">ID PERSONAL <span class="required">*</span> </label>
                        <input type="text" name="idPersonal" class="form-control name"    required title="Este campo es obligatorio" >
                      </div>
                    </div>
              

 </div> <div class="loadGuardadof"> </div>  ';
                $html.='<footer class="panel-footer panf'.$saveUpdate.'">
                   <div class="row">
                      <div class="col-sm-9 col-sm-offset-3">
             <button type="submit"  class="mb-xs mt-xs mr-xs modal-basic btn btn-primary"  >Guardar</button> ';
                    if ($saveUpdate=="save") {
        $html.=' <a  class="btn btn-default" onclick="resetForm()">Limpiar</a>';      
                    }
                  else {
    $html.=' <button class="btn btn-default modalform-dismiss">Cerrar</button>';
}
                    $html.=' </div>
                    </div>
                </footer>
              </section>';                        
 return $html;
}

public function saveCommunicationController(){
    $title= mainModel::limpiar_cadena($_POST['title']);
    $subtitle= mainModel::limpiar_cadena($_POST['subtitle']);
    $imagen= mainModel::limpiar_cadena($_POST['imagen']);
    $emails= mainModel::limpiar_cadena($_POST['emails']);
    $idPersonal= mainModel::limpiar_cadena($_POST['idPersonal']);
    $idtypeCommunication= mainModel::limpiar_cadena($_POST['idtypeCommunication']);
    //echo $title;

//REVISARRRRRRR
    /**$consultaidPersonal=mainModel::execute_query("SELECT * FROM tcommunication WHERE idPersonal=$idPersonal");
    if ($consultaidPersonal->rowCount()>=1) {
       $msg=["alert"=>"duplicidad","campo"=>$idPersonal];
    }else{**/

    $data=[
        "title"=>$title,
        "subtitle"=>$subtitle,
        "imagen"=>$imagen,
        "emails"=>$emails,
        "idPersonal"=>$idPersonal,
        "idtypeCommunication"=>$idtypeCommunication
    ];
    //var_dump($data);

   if (CommunicationModel::saveCommunicationModel($data)) {
        
        $msg=["alert"=>"save"];

    }else{
        $msg=["alert"=>"error"];

    }
//}
    return mainModel::mensajeRespuesta($msg);
}

}
 