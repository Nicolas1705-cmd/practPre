<?php 
if ($peticionAjax) {
  require_once "../model/DriverModel.php";
}else{
  require_once "./model/DriverModel.php";
}



class DriverController extends DriverModel{

public function formupdate(){

    $idDriverE = mainModel::limpiar_cadena($_GET['idDriver']);
      $idDriver = mainModel::decryption($idDriverE);
    $consulta = mainModel::execute_query("SELECT * FROM tdriver WHERE idDriver = $idDriver");
    $req = $consulta->fetch(PDO::FETCH_ASSOC);
    $cuerpo=' <script> 
$(".idDriver").val("'.$idDriverE.'");
$(".name").val("'.$req['name'].'");
$(".lastName").val("'.$req['lastName'].'");
$(".dateOfBirth").val("'.$req['dateOfBirth'].'");
$(".address").val("'.$req['address'].'");
$(".phone").val("'.$req['phone'].'");
$(".email").val("'.$req['email'].'");
$(".licenseNumber").val("'.$req['licenseNumber'].'");
$(".licenseExpirationDate").val("'.$req['licenseExpirationDate'].'");
$(".bloodType").val("'.$req['bloodType'].'");
$(".socialSecurityNumber").val("'.$req['socialSecurityNumber'].'");
</script>
';
return $cuerpo;
}


    public function updateDriverController(){
        
    $idDriver= mainModel::limpiar_cadena($_POST['idDriver']);
    //aqui esta bien encriptado
    $idDriver= mainModel::decryption($idDriver);
    $name= mainModel::limpiar_cadena($_POST['name']);
    $lastName= mainModel::limpiar_cadena($_POST['lastName']);
    $dateOfBirth= mainModel::limpiar_cadena($_POST['dateOfBirth']);
    $address= mainModel::limpiar_cadena($_POST['address']);
    $phone= mainModel::limpiar_cadena($_POST['phone']);
    $email= mainModel::limpiar_cadena($_POST['email']);
    $licenseNumber= mainModel::limpiar_cadena($_POST['licenseNumber']);
    $licenseExpirationDate= mainModel::limpiar_cadena($_POST['licenseExpirationDate']);
    $bloodType= mainModel::limpiar_cadena($_POST['bloodType']);
    $socialSecurityNumber= mainModel::limpiar_cadena($_POST['socialSecurityNumber']);

    //$idtypeCommunication= mainModel::limpiar_cadena($_POST['idtypeCommunication']);

    //echo $title;

//REVISARRRRRRR
    /**$consultaidPersonal=mainModel::execute_query("SELECT * FROM tcommunication WHERE idPersonal=$idPersonal");
    if ($consultaidPersonal->rowCount()>=1) {
       $msg=["alert"=>"duplicidad","campo"=>$idPersonal];
    }else{**/

//y aqui lo preparo para ser enviado al modelo , primero hago la siguiente prueba
    $data=[
        "idDriver"=>$idDriver,
        "name"=>$name,
        "lastName"=>$lastName,
        "dateOfBirth"=>$dateOfBirth,
        "address"=>$address,
        "phone"=>$phone,
        "email"=>$email,
        "licenseNumber"=>$licenseNumber,
        "licenseExpirationDate"=>$licenseExpirationDate,
        "bloodType"=>$bloodType,
        "socialSecurityNumber"=>$socialSecurityNumber
        
    ];
    //var_dump($data);
    //var_dump($data);

   if (DriverModel::updateDriverModel($data)) {
        
        $msg=["alert"=>"save"];

    }else{
        $msg=["alert"=>"error"];

    }
//}
    return mainModel::mensajeRespuesta($msg);
}


    //ESTA FUNCION ES LA DE LISTAR EN LA VISTA DE TODOS LOS MATERIALES
  public function listDriverController($request,$status){
      
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
    0=>'idDriver',
    1=>'name',
    2=>'lastName',
    2=>'dateOfBirth',
    2=>'address',
    2=>'phone',
    2=>'email',
    2=>'licenseNumber',
    2=>'licenseExpirationDate',
    2=>'bloodType',
    3=>'socialSecurityNumber'


);  
$index=0;
if ($request['order'][0]['column']!=5) {
$index=$request['order'][0]['column'];
}
if ($request['order'][0]['column']==5) {
$index=0;
}

//AQUI VA LA CONSULTA SELECT A LA BASE DE DATOS
$sql ="SELECT SQL_CALC_FOUND_ROWS * FROM tdriver WHERE status=$status";
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
    $encryp=mainModel::encryption($row['idDriver']);
    $row['idDriver']=$encryp;

//AQUI DEBEN IR EN ORDEN LOS ATRIBUTOS A MOSTRAR EN LA VISTA
    $subdata[]=$contador;
    //$sub[]=$row['ndataame'];//NO EXISTE ESTO EN LA BASE DE DATOS "ndataame"
    $subdata[]=$row['name']; 
    $subdata[]=$row['lastName'];
    $subdata[]=$row['dateOfBirth'];
    $subdata[]=$row['address'];
    $subdata[]=$row['phone'];
    $subdata[]=$row['email'];
    $subdata[]=$row['licenseNumber'];
    $subdata[]=$row['licenseExpirationDate'];
    $subdata[]=$row['bloodType'];
    $subdata[]=$row['socialSecurityNumber'];

    $operacionescrud="";
     
        $operacionescrud.=" <a onclick='rellEditV2(`".$encryp."`,`".'driverAjax'."`,`".SERVERURL."`,`idDriver`)' class='btn btn-primary btn-xs  mr-xs'  data-toggle='modal' data-target='#modalesForm' ><i class='fa-regular fa-pen-to-square'></i> </a>";

  $operacionescrud.="<button type='submit' onclick='modalOnActivaDeleteDataTable(`".'driverAjax'."`,`".$encryp."`,".$status.",`".SERVERURL."`)' class='btn btn-".$btn." btn-xs '> <i class='fa fa-".$icon."'></i></button> ";
      
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
      if(mainModel::activateDeleteSimple("tdriver",$idElemento,$status,"idDriver")){
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
$titulo="Registro de Driver";
$subtitulo='    <p class="panel-subtitle">
                  Por favor , llene  todos los campos y de click en guardar
                  </p>';
}
if ($saveUpdate=="update") {
$titulo="Editor de Driver";
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
                      <input type="hidden" class="idDriver"  name="idDriver" >
                           <label class="control-label">NOMBRES <span class="required">*</span> </label>
                        <input type="text" name="name" class="form-control name" maxlength="100"   required  >
                      </div>
                    </div>



  <div class="col-sm-3 mb-xs">
                      <div class="form-group">
                     
                           <label class="control-label">APELLIDOS <span class="required">*</span> </label>
                        <input type="text" name="lastName" class="form-control lastName"  maxlength="100"  required title="Este campo es obligatorio" >
                      </div>
                    </div>

   <div class="col-sm-3 mb-xs">
                      <div class="form-group">
                     
                           <label class="control-label">FECHA DE NACIMIENTO <span class="required">*</span> </label>
                        <input type="text" name="dateOfBirth" class="form-control dateOfBirth"    required title="Este campo es obligatorio" >
                      </div>
                    </div>
                    
    <div class="col-sm-3 mb-xs">
                      <div class="form-group">
                     
                           <label class="control-label">DIRECCIÓN <span class="required">*</span> </label>
                        <input type="text" name="address" class="form-control address"  maxlength="255"  required title="Este campo es obligatorio" >
                      </div>
                    </div>
                    
    <div class="col-sm-3 mb-xs">
                      <div class="form-group">
                     
                           <label class="control-label">TELÉFONO <span class="required">*</span> </label>
                        <input type="text" name="phone" class="form-control phone"  maxlength="20"  required title="Este campo es obligatorio" >
                      </div>
                    </div>
                    
    <div class="col-sm-3 mb-xs">
                      <div class="form-group">
                     
                           <label class="control-label">CORREO ELECTRÓNICO <span class="required">*</span> </label>
                        <input type="email" name="email" class="form-control email" maxlength="100"   required title="Este campo es obligatorio" >
                      </div>
                    </div>                                                                 
    <div class="col-sm-3 mb-xs">
                      <div class="form-group">
                     
                           <label class="control-label">NÚMERO DE LICENCIA <span class="required">*</span> </label>
                        <input type="text" name="licenseNumber" class="form-control licenseNumber"  maxlength="30"  required title="Este campo es obligatorio" >
                      </div>
                    </div>
                    
    <div class="col-sm-3 mb-xs">
                      <div class="form-group">
                     
                           <label class="control-label">FECHA DE VENCIMIENTO DE LA LICENCIA <span class="required">*</span> </label>
                        <input type="text" name="licenseExpirationDate" class="form-control licenseExpirationDate"    required title="Este campo es obligatorio" >
                      </div>
                    </div>    
                    
    <div class="col-sm-3 mb-xs">
                      <div class="form-group">
                     
                           <label class="control-label">TIPO DE SANGRE <span class="required">*</span> </label>
                        <input type="text" name="bloodType" class="form-control bloodType"  maxlength="5"  required title="Este campo es obligatorio" >
                      </div>
                    </div>                                            


   <div class="col-sm-3 mb-xs">
                      <div class="form-group">
                      
                           <label class="control-label">NÚMERO DE SEGURO SOCIAL <span class="required">*</span> </label>
                        <input type="text" name="socialSecurityNumber" class="form-control socialSecurityNumber"  maxlength="30"  required title="Este campo es obligatorio" >
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

public function saveDriverController(){
    //Aqui recibo los name de los inputs (cajas de texto)
    $name= mainModel::limpiar_cadena($_POST['name']);
    $lastName= mainModel::limpiar_cadena($_POST['lastName']);
    $dateOfBirth= mainModel::limpiar_cadena($_POST['dateOfBirth']);
    $address= mainModel::limpiar_cadena($_POST['address']);
    $phone= mainModel::limpiar_cadena($_POST['phone']);
    $email= mainModel::limpiar_cadena($_POST['email']);
    $licenseNumber= mainModel::limpiar_cadena($_POST['licenseNumber']);
    $licenseExpirationDate= mainModel::limpiar_cadena($_POST['licenseExpirationDate']);
    $bloodType= mainModel::limpiar_cadena($_POST['bloodType']);
    $socialSecurityNumber= mainModel::limpiar_cadena($_POST['socialSecurityNumber']);
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
        "name"=>$name,
        "lastName"=>$lastName,
        "dateOfBirth"=>$dateOfBirth,
        "address"=>$address,
        "phone"=>$phone,
        "email"=>$email,
        "licenseNumber"=>$licenseNumber,
        "licenseExpirationDate"=>$licenseExpirationDate,
        "bloodType"=>$bloodType,
        "socialSecurityNumber"=>$socialSecurityNumber
      //"emails"=>$emails,
      //"idPersonal"=>$idPersonal,
      //"idtypeCommunication"=>$idtypeCommunication
    ];
    //var_dump($data);

   if (DriverModel::saveDriverModel($data)) {
        
        $msg=["alert"=>"save"];

    }else{
        $msg=["alert"=>"error"];

    }
//}
    return mainModel::mensajeRespuesta($msg);
}

}
 