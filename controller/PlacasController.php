<?php 
if ($peticionAjax) {
  require_once "../model/PlacasModel.php";
}else{
  require_once "./model/PlacasModel.php";
}


class PlacasController extends PlacasModel{


    
  public function listPlacaController($request,$status){
      

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
$col =array(
      0 =>  'idplaca',
    1 =>  'name',
    2=>'codigo',
    3=>'marcavh',
    4=>'modelo'
);  
$index=0;
if ($request['order'][0]['column']!=5) {
$index=$request['order'][0]['column'];
}
if ($request['order'][0]['column']==5) {
$index=0;
}
$sql ="SELECT SQL_CALC_FOUND_ROWS * FROM tplaca WHERE status=$status";
$query= $cnn->query($sql);
 $totalData = $cnn->query("SELECT FOUND_ROWS()");
 $totalData = (int) $totalData->fetchColumn();
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
$query= $cnn->query($sql);
$totalFilter=$totalData;
$data=array();
$contador=0;
while($row = $query->fetch(PDO::FETCH_ASSOC)){
    
    //var_dump($row);
    $subdata=array();
                $contador = $contador+1;
       $encryp=mainModel::encryption($row['idplaca']);
     $row['idplaca']=$encryp;
    $subdata[]=$contador;
    $subdata[]=$row['name']; 
        $subdata[]=$row['codigo']; 
    $subdata[]=$row['marcavh']; 
    $subdata[]=$row['modelo']; 
  $operacionescrud="";
     
        $operacionescrud.=" <a onclick='rellEditProvider2(".json_encode($row).",`".'providerAjax'."`,`".SERVERURL."`)' class='btn btn-primary btn-xs  mr-xs'  data-toggle='modal' data-target='#modalesForm' ><i class='fa-regular fa-pen-to-square'></i> </a>";
  $operacionescrud.="<button type='submit' onclick='modalOnActivaDeleteDataTable(`".'placaAjax'."`,`".$encryp."`,".$status.",`".SERVERURL."`)' class='btn btn-".$btn." btn-xs '> <i class='fa fa-".$icon."'></i></button> ";
      
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

    public function activaDeleteBrandController($idElemento ,$status){
      $idElemento = mainModel::limpiar_cadena($idElemento);
      $idElemento=mainModel::decryption($idElemento);
 if($idElemento!=false){
 
      $status=mainModel::limpiar_cadena($status);
      if(mainModel::activateDeleteSimple("tplaca",$idElemento,$status,"idplaca")){
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
 
public function fomUpdate(){
       $idplaca=mainModel::limpiar_cadena($_GET['idplaca']);
      $idplaca =mainModel::decryption($idplaca);
  $consulta =mainModel::execute_query("SELECT * FROM tplaca WHERE idplaca=$idplaca");
  $req = $consulta->fetch(PDO::FETCH_ASSOC);

$cuerpo=' <script> 
$(".name").val("'.$req['name'].'");
$(".codigo").val("'.$req['codigo'].'");
$(".marcavh").val("'.$req['marcavh'].'");
$(".modelo").val("'.$req['modelo'].'");
$(".serie").val("'.$req['serie'].'");
$(".motor").val("'.$req['motor'].'");
$(".serie").val("'.$req['serie'].'");
$(".motor").val("'.$req['motor'].'");
$(".combustible").val("'.$req['combustible'].'");
$(".yearf").val("'.$req['yearf'].'");
$(".ne").val('.$req['ne'].');
$(".nr").val('.$req['nr'].');
$(".na").val('.$req['na'].');
$(".np").val('.$req['np'].');
$(".laa").val('.$req['laa'].');
$(".pbruto").val('.$req['pbruto'].');
$(".pneto").val('.$req['pneto'].');
$(".putil").val('.$req['putil'].');



</script>
';

return $cuerpo;
}


public function paintForm($saveUpdate){
$titulo="";
$subtitulo="";
if ($saveUpdate=="save") {
$titulo="Registro de Placas";
$subtitulo='    <p class="panel-subtitle">
                  Por favor , llene  todos los campos y de click en guardar
                  </p>';
}
if ($saveUpdate=="update") {
$titulo="Editor de Placas";
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
                      <input type="hidden" class="idplaca"  name="idplaca" >
                           <label class="control-label">Placa <span class="required">*</span> </label>
                        <input type="text" name="name" class="form-control name" 
                           maxlength="10"  onkeypress="return checkPlaca(this,event);"   required>
                      </div>
                    </div>
 <div class="col-sm-3 mb-xs">
                      <div class="form-group">
                           <label class="control-label">Codigo <span class="required">*</span> </label>
                        <input type="text" name="codigo" class="form-control codigo" 
                           maxlength="8"   required>
                      </div>
                    </div>

 <div class="col-sm-3 mb-xs">
                      <div class="form-group">
                           <label class="control-label">Marca <span class="required">*</span> </label>
                        <input type="text" name="marcavh" class="form-control marcavh" 
                           maxlength="20"   required>
                      </div>
                    </div>
 <div class="col-sm-3 mb-xs">
                      <div class="form-group">
                           <label class="control-label">Modelo <span class="required">*</span> </label>
                        <input type="text" name="modelo" class="form-control modelo" 
                           maxlength="20"   required>
                      </div>
                    </div>
                  </div>
 <div class="row mb-xs">

 <div class="col-sm-3 mb-xs">
                      <div class="form-group">
                           <label class="control-label">Serie <span class="required">*</span> </label>
                        <input type="text" name="serie" class="form-control serie" 
                           maxlength="25"   required>
                      </div>
                    </div>
 <div class="col-sm-3 mb-xs">
                      <div class="form-group">
                           <label class="control-label">Motor <span class="required">*</span> </label>
                        <input type="text" name="motor" class="form-control motor" 
                           maxlength="15"   required>
                      </div>
                    </div>
<div class="col-sm-3 mb-xs">
                      <div class="form-group">
                           <label class="control-label">Combustible <span class="required">*</span> </label>
                        <input type="text" name="combustible" class="form-control combustible" 
                           maxlength="15"   required>
                      </div>
                    </div>

<div class="col-sm-3 mb-xs">
                         <div class="form-group">
               <label class="control-label">Año  </label>
                        <div class="input-group">
                            <span class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </span>
                            <input type="text"  id="yearf'.$saveUpdate.'" name="yearf" placeholder="yyyy" class="form-control yearf"  >
                          </div>
                      </div>
                    </div>


  </div> <div class="row"> 
       <div class="col-sm-3 mb-xs"> 
          <div class="form-group">
                 <label class="control-label">N° E</label>
  <input type="number" name="ne" class="form-control ne" min="1" max="99999" data-maxlength="5" oninput="this.value=this.value.slice(0,this.dataset.maxlength)" >

                      </div>
          </div>

  <div class="col-sm-3 mb-xs"> 
          <div class="form-group">
                 <label class="control-label">N° R</label>
  <input type="number" name="nr" class="form-control nr" min="1" max="99999" data-maxlength="5" oninput="this.value=this.value.slice(0,this.dataset.maxlength)" >

                      </div>
          </div>

           <div class="col-sm-3 mb-xs"> 
          <div class="form-group">
                 <label class="control-label">N° A</label>
  <input type="number" name="na" class="form-control na" min="1" max="99999" data-maxlength="5" oninput="this.value=this.value.slice(0,this.dataset.maxlength)" >

                      </div>
          </div>

    <div class="col-sm-3 mb-xs"> 
          <div class="form-group">
                 <label class="control-label">N° P</label>
  <input type="number" name="np" class="form-control np" min="1" max="99999" data-maxlength="5" oninput="this.value=this.value.slice(0,this.dataset.maxlength)" >

                      </div>
          </div>


    

  </div>  

<div class="row">
<div class="col-sm-4 mb-xs">
                      <div class="form-group">
                           <label class="control-label">L*A*A <span class="required">*</span> </label>
                        <input type="text" name="laa" class="form-control laa" 
                           maxlength="30"   required>
                      </div>
                    </div>


      <div class="col-sm-4 mb-xs"> 
          <div class="form-group">
                 <label class="control-label">P. Neto KG<span class="required">*</span></label>
     <input type="number" step="any" name="pneto" class="form-control pneto" min="1" max="9999999999" data-maxlength="10" oninput="this.value=this.value.slice(0,this.dataset.maxlength)" >
                      </div>
          </div>


           <div class="col-sm-4 mb-xs"> 
          <div class="form-group">
                 <label class="control-label">P. Bruto KG<span class="required">*</span></label>
     <input type="number" step="any" name="pbruto" class="form-control pbruto" min="1" max="9999999999" data-maxlength="10" oninput="this.value=this.value.slice(0,this.dataset.maxlength)" >
                      </div>
          </div>

  <div class="col-sm-4 mb-xs"> 
          <div class="form-group">
                 <label class="control-label">P. Util KG<span class="required">*</span></label>
     <input type="number" step="any" name="putil" class="form-control putil" min="1" max="9999999999" data-maxlength="10" oninput="this.value=this.value.slice(0,this.dataset.maxlength)" >
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


    public function savePlacaController(){
      $name = mainModel::limpiar_cadena($_POST['name']);
      $codigo=mainModel::limpiar_cadena($_POST['codigo']);
$marcavh=mainModel::limpiar_cadena($_POST['marcavh']);
$modelo=mainModel::limpiar_cadena($_POST['modelo']);
$serie=mainModel::limpiar_cadena($_POST['serie']);
$motor=mainModel::limpiar_cadena($_POST['motor']);
$combustible=mainModel::limpiar_cadena($_POST['combustible']);
$yearf=mainModel::limpiar_cadena($_POST['yearf']);
$ne=mainModel::limpiar_cadena($_POST['ne']);
$nr=mainModel::limpiar_cadena($_POST['nr']);
$na=mainModel::limpiar_cadena($_POST['na']);
$np=mainModel::limpiar_cadena($_POST['np']);
$laa=mainModel::limpiar_cadena($_POST['laa']);
$pneto=mainModel::limpiar_cadena($_POST['pneto']);
$pbruto=mainModel::limpiar_cadena($_POST['pbruto']);
$putil=mainModel::limpiar_cadena($_POST['putil']);

      $consultaName = mainModel::execute_query("SELECT * FROM tplaca WHERE name='$name' ");
      if($consultaName->rowCount()>=1){
          $msg=["alert"=>"duplicidad","campo"=>$name];
      }
  $consultacodigo = mainModel::execute_query("SELECT * FROM tplaca WHERE codigo='$codigo' ");
      if($consultacodigo->rowCount()>=1){
          $msg=["alert"=>"duplicidad","campo"=>$codigo];
      }

      else{
      $data=[
        "name"=>$name,
        "codigo"=>$codigo,
        "marcavh"=>$marcavh,
        "modelo"=>$modelo,
        "serie"=>$serie,
        "motor"=>$motor,
        "combustible"=>$combustible,
        "yearf"=>$yearf,
        "ne"=>$ne,
        "nr"=>$nr,
        "na"=>$na,
        "np"=>$np,
        "laa"=>$laa,
        "pneto"=>$pneto,
        "pbruto"=>$pbruto,
        "putil"=>$putil
      ];

      if(PlacasModel::savePlacaModel($data)){
        $msg=["alert"=>"save"];
      }else{
        $msg=["alert"=>"error"];
      }
  }

      return mainModel::mensajeRespuesta($msg);
    }

    public function updatePlacaController(){
       $idplaca =mainModel::limpiar_cadena($_POST['idplaca']);
      $idplaca  =mainModel::decryption($idplaca);
      $name = mainModel::limpiar_cadena($_POST['name']);
     $codigo=mainModel::limpiar_cadena($_POST['codigo']);
$marcavh=mainModel::limpiar_cadena($_POST['marcavh']);
$modelo=mainModel::limpiar_cadena($_POST['modelo']);
$serie=mainModel::limpiar_cadena($_POST['serie']);
$motor=mainModel::limpiar_cadena($_POST['motor']);
$combustible=mainModel::limpiar_cadena($_POST['combustible']);
$yearf=mainModel::limpiar_cadena($_POST['yearf']);
$ne=mainModel::limpiar_cadena($_POST['ne']);
$nr=mainModel::limpiar_cadena($_POST['nr']);
$na=mainModel::limpiar_cadena($_POST['na']);
$np=mainModel::limpiar_cadena($_POST['np']);
$laa=mainModel::limpiar_cadena($_POST['laa']);
$pneto=mainModel::limpiar_cadena($_POST['pneto']);
$pbruto=mainModel::limpiar_cadena($_POST['pbruto']);
$putil=mainModel::limpiar_cadena($_POST['putil']);


      $consultaName = mainModel::execute_query("SELECT * FROM tplaca WHERE name='$name' and   idplaca  !='$idplaca '");
      if($consultaName->rowCount()>=1){
          $msg=["alert"=>"duplicidad","campo"=>$name];
      }
    $consultacodigo = mainModel::execute_query("SELECT * FROM tplaca WHERE codigo='$codigo' and   idplaca  !='$idplaca '");
      if($consultacodigo->rowCount()>=1){
          $msg=["alert"=>"duplicidad","campo"=>$codigo];
      }


      else{
      $data=[
        "idplaca"=>$idplaca ,
        "name"=>$name,
         "codigo"=>$codigo,
        "marcavh"=>$marcavh,
        "modelo"=>$modelo,
        "serie"=>$serie,
        "motor"=>$motor,
        "combustible"=>$combustible,
        "yearf"=>$yearf,
        "ne"=>$ne,
        "nr"=>$nr,
        "na"=>$na,
        "np"=>$np,
        "laa"=>$laa,
        "pneto"=>$pneto,
        "pbruto"=>$pbruto,
        "putil"=>$putil
      ];

      if(PlacasModel::updatePlacaModel($data)){
        $msg=["alert"=>"update"];
      }else{
        $msg=["alert"=>"error"];
      }
  }

      return mainModel::mensajeRespuesta($msg);
    }

}

 