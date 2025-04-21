<?php 
if ($peticionAjax) {
  require_once "../model/ProductosModel.php";
}else{
  require_once "./model/ProductosModel.php";
}

class ProductosController extends ProductosModel{

    //ESTA FUNCION ES LA DE LISTAR EN LA VISTA DE TODOS LOS MATERIALES
  public function listProductosController($request,$status){
      
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
}


//AQUI ALMACENO LOS ATRIBUTOS DE MI TABLA DE MI BASE DE DATOS QUE QUIERO QUE SE MUESTREN EN LA VISTA
$col = array(
    0 => 'idProduct',
    1 => 'name',
    2 => 'description',
    3 => 'lote',
    4 => 'dateRegister'
);
$index=0;
if ($request['order'][0]['column']!=5) {
$index=$request['order'][0]['column'];
}
if ($request['order'][0]['column']==5) {
$index=0;
}

//AQUI VA LA CONSULTA SELECT A LA BASE DE DATOS
$sql ="SELECT SQL_CALC_FOUND_ROWS * FROM tproductos WHERE status=$status";
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
    $encryp=mainModel::encryption($row['idProduct']);
    $row['idProduct']=$encryp;

//AQUI DEBEN IR EN ORDEN LOS ATRIBUTOS A MOSTRAR EN LA VISTA
    $subdata[]=$contador;
    $subdata[]=$row['name']; 
    $subdata[]=$row['description'];
    $subdata[]=$row['lote']; 
    $subdata[]=$row['dateRegister']; 
    $operacionescrud="";
     
        $operacionescrud.=" <a onclick='rellEditProvider2(".json_encode($row).",`".'productosAjax'."`,`".SERVERURL."`)' class='btn btn-primary btn-xs  mr-xs'  data-toggle='modal' data-target='#modalesForm' ><i class='fa-regular fa-pen-to-square'></i> </a>";

  $operacionescrud.="<button type='submit' onclick='modalOnActivaDeleteDataTable(`".'productosAjax'."`,`".$encryp."`,".$status.",`".SERVERURL."`)' class='btn btn-".$btn." btn-xs '> <i class='fa fa-".$icon."'></i></button> ";
      
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
      if(mainModel::activateDeleteSimple("tproductos",$idElemento,$status,"idProduct")){
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
$titulo="Registro de Productos";
$subtitulo='    <p class="panel-subtitle">
                  Por favor , llene  todos los campos y de click en guardar
                  </p>';
}
if ($saveUpdate=="update") {
$titulo="Editor de Productos";
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
                      <input type="hidden" class="idProduct"  name="idProduct" >
                           <label class="control-label">Productos<span class="required">*</span> </label>
                        <input type="text" name="name" class="form-control name"    required>
                      </div>
                    </div>

 <div class="col-sm-3 mb-xs">
                      <div class="form-group">
                           <label class="control-label">Stock<span class="required">*</span> </label>
                        <input type="text" name="stock" class="form-control stock" 
                           maxlength="8"   required>
                      </div>
                    </div>

  <div class="col-sm-3 mb-xs">
                      <div class="form-group">
                           <label class="control-label">Nùmero de serie<span class="required">*</span> </label>
                        <input type="text" name="nserie" class="form-control nserie" 
                           maxlength="8"   required>
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

public function saveProductosController(){
    $name= mainModel::limpiar_cadena($_POST['name']);
    $stock= mainModel::limpiar_cadena($_POST['stock']);
    $nserie= mainModel::limpiar_cadena($_POST['nserie']);
    //echo $name;

    $consultaNserie=mainModel::execute_query("SELECT * FROM tproductos WHERE nserie=$nserie");
    if ($consultaNserie->rowCount()>=1) {
       $msg=["alert"=>"duplicidad","campo"=>$nserie];
    }else{

    $data=[
        "name"=>$name,
        "stock"=>$stock,
        "nserie"=>$nserie
    ];
    //var_dump($data);

   if (ProductosModel::saveProductosModel($data)) {
        
        $msg=["alert"=>"save"];

    }else{
        $msg=["alert"=>"error"];


    }}
    return mainModel::mensajeRespuesta($msg);
}

 