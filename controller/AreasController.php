<?php 
if ($peticionAjax) {
  require_once "../model/AreasModel.php";
}else{
  require_once "./model/AreasModel.php";
}



class AreasController extends AreasModel{

public function formupdate(){

    $idAreasE = mainModel::limpiar_cadena($_GET['idAreas']);
      $idAreas = mainModel::decryption($idAreasE);
    $consulta = mainModel::execute_query("SELECT * FROM tareas WHERE idAreas = $idAreas");
    $req = $consulta->fetch(PDO::FETCH_ASSOC);
    $cuerpo=' <script> 
$(".idAreas").val("'.$idAreasE.'");
$(".name").val("'.$req['name'].'");
</script>
';
return $cuerpo;
}

    public function updateAreasController(){
        
    $idAreas= mainModel::limpiar_cadena($_POST['idAreas']);
    //aqui esta bien encriptado
    $idAreas= mainModel::decryption($idAreas);
    $name= mainModel::limpiar_cadena($_POST['name']);

    //$idtypeCommunication= mainModel::limpiar_cadena($_POST['idtypeCommunication']);

    //echo $title;

//REVISARRRRRRR
    /**$consultaidPersonal=mainModel::execute_query("SELECT * FROM tcommunication WHERE idPersonal=$idPersonal");
    if ($consultaidPersonal->rowCount()>=1) {
       $msg=["alert"=>"duplicidad","campo"=>$idPersonal];
    }else{**/

//y aqui lo preparo para ser enviado al modelo , primero hago la siguiente prueba
    $data=[
        "idAreas"=>$idAreas,
        "name"=>$name,
        
    ];
    //var_dump($data);
    //var_dump($data);

   if (AreasModel::updateAreasModel($data)) {
        
        $msg=["alert"=>"save"];

    }else{
        $msg=["alert"=>"error"];

    }
//}
    return mainModel::mensajeRespuesta($msg);
}


    //ESTA FUNCION ES LA DE LISTAR EN LA VISTA DE TODOS LOS MATERIALES
  public function listAreasController($request,$status){
      
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
    0=>'idAreas',
    1=>'name',

);  
$index=0;
if ($request['order'][0]['column']!=5) {
$index=$request['order'][0]['column'];
}
if ($request['order'][0]['column']==5) {
$index=0;
}

//AQUI VA LA CONSULTA SELECT A LA BASE DE DATOS
$sql ="SELECT SQL_CALC_FOUND_ROWS * FROM tareas WHERE status=$status";
$query= $cnn->query($sql);
 $totalData = $cnn->query("SELECT FOUND_ROWS()");
 $totalData = (int) $totalData->fetchColumn();

 //ESTO SIRVE PARA BUSCAR EN MI TABLA VISIBLE
if(!empty($request['search']['value'])){
    $sql.=" AND name Like '".$request['search']['value']."%' ";
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
    $encryp=mainModel::encryption($row['idAreas']);
    $row['idAreas']=$encryp;

//AQUI DEBEN IR EN ORDEN LOS ATRIBUTOS A MOSTRAR EN LA VISTA
    $subdata[]=$contador;
    //$sub[]=$row['ndataame'];//NO EXISTE ESTO EN LA BASE DE DATOS "ndataame"
    $subdata[]=$row['name']; 

    $operacionescrud="";
     
        $operacionescrud.=" <a onclick='rellEditV2(`".$encryp."`,`".'areasAjax'."`,`".SERVERURL."`,`idAreas`)' class='btn btn-primary btn-xs  mr-xs'  data-toggle='modal' data-target='#modalesForm' ><i class='fa-regular fa-pen-to-square'></i> </a>";

  $operacionescrud.="<button type='submit' onclick='modalOnActivaDeleteDataTable(`".'areasAjax'."`,`".$encryp."`,".$status.",`".SERVERURL."`)' class='btn btn-".$btn." btn-xs '> <i class='fa fa-".$icon."'></i></button> ";
      
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
      if(mainModel::activateDeleteSimple("tareas",$idElemento,$status,"idAreas")){
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
$titulo="Registro de Àreas";
$subtitulo='    <p class="panel-subtitle">
                  Por favor , llene  todos los campos y de click en guardar
                  </p>';
}
if ($saveUpdate=="update") {
$titulo="Editor de Àreas";
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
                      <input type="hidden" class="idAreas"  name="idAreas" >
                           <label class="control-label">NOMBRES <span class="required">*</span> </label>
                        <input type="text" name="name" class="form-control name" maxlength="40"   required  >
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

public function saveAreasController(){
    //Aqui recibo los name de los inputs (cajas de texto)
    $name= mainModel::limpiar_cadena($_POST['name']);
   
  //$emails= mainModel::limpiar_cadena($_POST['emails']);
  //$idPersonal= mainModel::limpiar_cadena($_POST['idPersonal']);
  //$idtypeCommunication= mainModel::limpiar_cadena($_POST['idtypeCommunication']);

    //echo $title;

//REVISARRRRRRR
    /**$consultaidPersonal=mainModel::execute_query("SELECT * FROM tcommunication WHERE idPersonal=$idPersonal");
    if ($consultaidPersonal->rowCount()>=1) {
       $msg=["alert"=>"duplicidad","campo"=>$idPersonal];
    }else{**/

    $data=[
        "name"=>$name

      //"emails"=>$emails,
      //"idPersonal"=>$idPersonal,
      //"idtypeCommunication"=>$idtypeCommunication
    ];
    //var_dump($data);

   if (AreasModel::saveAreasModel($data)) {
        
        $msg=["alert"=>"save"];

    }else{
        $msg=["alert"=>"error"];

    }
//}
    return mainModel::mensajeRespuesta($msg);
}

}
 