<?php 

if ($peticionAjax) {
	require_once "../core/configApp.php";
}else{
	require_once "./core/configApp.php";
}
class mainModel 
{

		protected function activateDeleteSimple($table,$idElemento,$status,$nameId){
			$txtStatus='';
			if($status==1){
				$newStatus=0;
							$txtStatus="dar de Baja";

			}else{
				$newStatus=1;
			  $txtStatus="dar de Alta";

			}
			$sql  =self::conect()->prepare("UPDATE $table set status = $newStatus where $nameId= :nameId");
			$sql->bindParam(":nameId",$idElemento);

			$sql->execute();
			            $txtactividad="a realizado en la tabla ".$table." la accion de ".$txtStatus." del ID*: ".$idElemento;
		if ($table!="tnotify") {
  $idPersonal=mainModel::decryption($_SESSION['Encryuser']);
      $dataactividad=[
        "idPersonal"=>$idPersonal,
        "actividad"=>$txtactividad
      ]; 
     

			}
              
			return $sql;
			
		}	

		protected function conect(){
		$enlace = new PDO(SGDB,USER,PASSWORD);
	$enlace->exec("SET TIME_ZONE = '".date('P')."';");
		return $enlace;
	}

	protected function nombredb(){
		$nombre = DB;
		return $nombre;
	}

	protected function nombreS(){
		$nombreSERVER = SERVER;
		return $nombreSERVER;
	}
	protected function getList($query,$idName){
		$request=self::conect()->query($query);
		$request = $request->fetchAll(PDO::FETCH_ASSOC);
		$html="";
		$html.="<option value=''>-Seleccionar-</option>";
		foreach ($request as $index=>$row) {
			$html.='<option value="'.$row[$idName].'"> '.$row['name'].'</option>';
		}

		return $html;
	}

//AQUI YA NO TOCAR NADAAAAAAAAAAAAAAAAAAAAAAAAAA
	protected function rolesModulo($idPersonal,$modulo){
		$idCargo = 1;
		$request=self::conect()->query("SELECT * FROM trol_operacion as t1 INNER JOIN toperacion as t2 on t1.idOperacion = t2.idOperacion INNER JOIN tmodulo as t3 on t2.idModulo = t3.idModulo where t3.name = $modulo AND t1.idCargo = $idCargo");
		$request = $request->fetchAll(PDO::FETCH_ASSOC);

	}
	
	//fin andres

	protected function getListObigeo($query,$idName,$name){
		$request=self::conect()->query($query);
		$request = $request->fetchAll(PDO::FETCH_ASSOC);
		$html="";
		$html.='<option value="">-Seleccionar-</option>';
		foreach ($request as $index=>$row) {
			$html.='<option value="'.$row[$idName].'"> '.$row[$name].'</option>';
		}

		return $html;
	}
	protected function getListPersonalizado($query,$idName,$campo){
		$request=self::conect()->query($query);
		$request = $request->fetchAll(PDO::FETCH_ASSOC);
		$html="";
		foreach ($request as $index=>$row) {
			$html.='<option value="'.$row[$idName].'"> '.$row[$campo].'</option>';
		}
		return $html;
	}
	protected function listPersonal($tipo){
		$request=self::conect()->query("SELECT t1.idPersonal , t1.names, t2.name from tpersonal as t1 INNER JOIN tcargo as t2 on t1.idCargo = t2.idCargo where t2.name='$tipo'");
		$request = $request->fetchAll(PDO::FETCH_ASSOC);
		$html="";
		foreach ($request as $index=>$row) {
			$html.='<option value="'.$row["idPersonal"].'"> '.$row["names"].'</option>';
		}
		return $html;
	}

	protected function listClient($tipo){
    	$request=self::conect()->query("SELECT t1.idClient , t1.name from tclient as t1  WHERE t1.status = 1");
		$request = $request->fetchAll(PDO::FETCH_ASSOC);
		$html="";
		$html.='<option  value="0">-Todos-</option>';
		foreach ($request as $index=>$row) {
			$html.='<option title="'.$row["name"].'" value="'.$row["idClient"].'"> '.$row["name"].'</option>';
		}
		return $html;
	}

	protected function execute_query($query){
		$request=self::conect()->prepare($query);
		$request->execute();
		return $request;
	} 

	protected function listCargos(){
    $data = mainModel::getList("SELECT * FROM tcargo WHERE (idCargo!=12 and idCargo!=14) ","idCargo");
      return $data;
    }

protected function listDepartamento(){
      $data = mainModel::getListObigeo("SELECT * FROM tdepartamento  ","idDepa","departamento");
      return $data;
    }
    protected function listProvincia($idDepartamento){
      $data = mainModel::getListObigeo("SELECT * FROM tprovincia where idDepa = $idDepartamento ","idProv","provincia");
      return $data;
    }
    protected function listDistrito($idProvincia){
      $data = mainModel::getListObigeo("SELECT * FROM tdistrito where idProv = $idProvincia ","idDist","distrito");
      return $data;
    }
	///perfil
	protected function getListPers2($query,$idName,$name,$id,$tipo){
		$request=self::conect()->query($query);
		$request = $request->fetchAll(PDO::FETCH_ASSOC);
		$html="";
		  $selectedSave="";
           if ($tipo=="save") {
		  $selectedSave="selected";

}
		$html.='<option '.$selectedSave.' value="">-Seleccionar-</option>';
		foreach ($request as $index=>$row) {
		  $selected="";
           if ($tipo=="update") {
		  if ($row[$idName]==$id) {
		  	  $selected="selected";
		  	    }           }
	$html.='<option '.$selected.' title="'.$row[$name].'"  value="'.$row[$idName].'"> '.$row[$name].'</option>';
		}
		return $html;
	}
	//nuevooption format autocomplete
	protected function getListPersString($query,$idName,$name,$id,$tipo){
		$request=self::conect()->query($query);
		$request = $request->fetchAll(PDO::FETCH_ASSOC);
		$html="";
		  $selectedSave="";
           if ($tipo=="save") {
		  $selectedSave="selected";
		}
		$html.='<option '.$selectedSave.' value="">-Seleccionar-</option>';
		foreach ($request as $index=>$row) {
		  $selected="";
           if ($tipo=="update") {
		  if ($row[$name]==$id) {
		  	  $selected="selected";
		  	    }           }
			$html.='<option '.$selected.'  value="'.$row[$name].'"> '.$row[$name].'</option>';
		}

		return $html;
	}
protected function getListPersStringJSON($query,$idName,$name,$id,$tipo){
		$request=self::conect()->query($query);
		$request = $request->fetch(PDO::FETCH_ASSOC);
		$html="";
		  $selectedSave="";
           if ($tipo=="save") {
		  $selectedSave="selected";

}
	


		foreach (json_decode($request[$idName]) as $index=>$row) {
		  $selected="";
           if ($tipo=="update") {
		  if ($row->$name==$id) {
		  	  $selected="selected";
		  	    }           }


			$html.='<option '.$selected.'  data-departamento="'.$row->DEPARTAMENTO.'" data-provincia="'.$row->PROVINCIA.'" data-distrito="'.$row->DISTRITO.'"  data-address="'.$row->DIRECCION.'  ('.$row->DEPARTAMENTO.'-'.$row->PROVINCIA.'-'.$row->DISTRITO.') "  value="'.$row->$name.'"> '.$row->$name.' ('.$row->DEPARTAMENTO.'-'.$row->PROVINCIA.'-'.$row->DISTRITO.')   </option>';
		}

		return $html;
	}
function Quitar_Espacios($Frase)
 {
    return preg_replace("/\s+/", " ", trim($Frase));
 }
protected function getListUBIGEOJSONINVP($query,$idName,$name,$id,$tipo){
		$request=self::conect()->query($query);
		$request = $request->fetch(PDO::FETCH_ASSOC);
		$html="";
		  $selectedSave="";
           if ($tipo=="save") {
		  $selectedSave="selected";

}

          $data=['idDepa'=>0,'idProv'=>0,'idDist'=>0];

	
foreach (json_decode($request[$idName]) as $index=>$row) {
		  $selected="";
           if ($tipo=="update") {
		  if ($row->DESTINATARIO==$id) {
		  	$distrjson=$row->DISTRITO; $distrjson=mainModel::Quitar_Espacios($distrjson);
		  	$provjson=$row->PROVINCIA; $provjson=mainModel::Quitar_Espacios($provjson);
		  	$depajson=$row->DEPARTAMENTO; $depajson=mainModel::Quitar_Espacios($depajson);
 $consultaDepart=mainModel::execute_query("SELECT * FROM tdepartamento WHERE departamento='$depajson' ");
 $dataDepart = $consultaDepart->fetch(PDO::FETCH_ASSOC);
 if($consultaDepart->rowCount()>=1){
          $idDepa=$dataDepart['idDepa']; 
             $data['idDepa']=$idDepa;
      }


 $consultaDistri=mainModel::execute_query("SELECT * FROM tdistrito WHERE distrito='$distrjson' ");
 $dataDistri = $consultaDistri->fetch(PDO::FETCH_ASSOC);
 if($consultaDistri->rowCount()>=1){
          $idDist=$dataDistri['idDist'];
          $data["idDist"]=$idDist;
      }
	 $consultaProv=mainModel::execute_query("SELECT * FROM tprovincia WHERE provincia='$provjson' ");
 $dataProv = $consultaProv->fetch(PDO::FETCH_ASSOC);
 if($consultaProv->rowCount()>=1){
          $idProv=$dataProv['idProv'];
          $data["idProv"]=$idProv;
      }

	  	    }           }

		}

		return $data;
	}


	//json destinataios LIMA
protected function getListPersStringJSONUBL($query,$idName,$name,$id,$tipo){
		$request=self::conect()->query($query);
		$request = $request->fetch(PDO::FETCH_ASSOC);
		$html="";
		  $selectedSave="";
           if ($tipo=="save") {
		  $selectedSave="selected";
			}
		foreach (json_decode($request[$idName]) as $index=>$row) {
		  $selected="";
           if ($tipo=="update") {
		  if ($row->$name==$id) {
		  	  $selected="selected";
		  	    }           }
            $ubigeo=$row->DEPARTAMENTO;
            $ubigeo=trim($ubigeo);
          if ($ubigeo=="LIMA") {
$html.='<option '.$selected.'  data-departamento="'.$row->DEPARTAMENTO.'" data-provincia="'.$row->PROVINCIA.'" data-distrito="'.$row->DISTRITO.'"  data-address="'.$row->DIRECCION.'  ('.$row->DEPARTAMENTO.'-'.$row->PROVINCIA.'-'.$row->DISTRITO.') "  value="'.$row->$name.'"> '.$row->$name.' ('.$row->DEPARTAMENTO.'-'.$row->PROVINCIA.'-'.$row->DISTRITO.')   </option>'; }
			
		}

		return $html;
	}

	protected function getListAuto($query,$idName,$name,$id,$tipo){
		//if($id!= null || $id!= "" ){
		$request=self::conect()->query($query);
		$request = $request->fetchAll(PDO::FETCH_ASSOC);
		$html="";
		  $selectedSave="";
           if ($tipo=="save") {
		  $selectedSave="selected";
		 }
		foreach ($request as $index=>$row) {
		  $selected="";
           if ($tipo=="update") {

		  if ($row[$idName]==$id) {
		  	  $selected="selected";
		  	    } 

		  	              }

			$html.='<option '.$selected.' title="'.$row[$name].'"  value="'.$row[$idName].'"> '.$row[$name].'</option>';
		}
		/**}else{
			$html.='<option  title="NULL"  value=""> SIN SELECCIONAR </option>';
		}**/

		return $html;

	}
	
		protected function getListObigeoTarifa($query,$idName,$name){
		$request=self::conect()->query($query);
		$request = $request->fetchAll(PDO::FETCH_ASSOC);
		$html="";
		$html.='<option value="">-Seleccionar-</option>';
		foreach ($request as $index=>$row) {
			$html.='<option value="'.$row[$idName].'"> '.$row[$name].' - Zona '.$row['zona'].'  </option>';
		}

		return $html;
	}

	protected function getListAutotext($query,$idName,$name,$id,$tipo){
		$request=self::conect()->query($query);
		$request = $request->fetchAll(PDO::FETCH_ASSOC);
		$html="";
				$html.='<option data-subtext="seleccion" value="">-Seleccionar-</option>';

		  $selectedSave="";
           if ($tipo=="save") {
		  $selectedSave="selected";
		  }
		foreach ($request as $index=>$row) {
		  $selected="";
           if ($tipo=="update") {
		  if ($row[$idName]==$id) {
		  	  $selected="selected";
		  	    }           }


			$html.='<option '.$selected.' data-subtext="'.$row[$name].'"  value="'.$row[$idName].'"> '.$row[$name].'</option>';
		}

		return $html;
	}
protected function getListAutotextatrDist($query,$idName,$name,$id,$tipo){
		$request=self::conect()->query($query);
		$request = $request->fetchAll(PDO::FETCH_ASSOC);
		$html="";
				$html.='<option data-subtext="seleccion" value="">-Seleccionar-</option>';

		  $selectedSave="";
           if ($tipo=="save") {
		  $selectedSave="selected";
			}
		foreach ($request as $index=>$row) {
		  $selected="";
           if ($tipo=="update") {
		  if ($row[$idName]==$id) {
		  	  $selected="selected";
		  	    }           }

			$html.='<option  data-distrito="'.$row['idDistrito'].'" '.$selected.' data-subtext="'.$row[$name].'"  value="'.$row[$idName].'"> '.$row[$name].'</option>';
		}

		return $html;
	}

//
	protected function getListAutotextmultiple($query,$idName,$name,$id,$tipo){
		$request=self::conect()->query($query);
		$request = $request->fetchAll(PDO::FETCH_ASSOC);
		$html="";

		  $selectedSave="";
           if ($tipo=="save") {
		  $selectedSave="selected";
		}
		
		foreach ($request as $index=>$row) {
		  $selected="";
           if ($tipo=="update") {
		  if ($row[$idName]==$id) {
		  	  $selected="selected";
		  	    }           }

 $html.='<option '.$selected.' data-subtext="'.$row[$name].'"  value="'.$row[$idName].'"> '.$row[$name].'</option>';
		}

		return $html;
	}

	protected function getListAutotextooperador($query,$idName,$name,$json,$tipo){
		$request=self::conect()->query($query);
		$request = $request->fetchAll(PDO::FETCH_ASSOC);
		$html="";

		  $selectedSave="";
           if ($tipo=="save") {
		  $selectedSave="selected";
		}
		foreach ($request as $index=>$row) {
		  $selected="";
           if ($tipo=="update") {
		  foreach ($json as $indexope=>$rowoperador) {
  if ($row[$idName]==$rowoperador['nameoperator']) {
		  	  $selected="selected";
		  	    }
           }
		  	      }
$html.='<option '.$selected.' data-subtext="'.$row[$name].'"  value="'.$row[$idName].'"> '.$row[$name].'</option>';
		}

		return $html;
	}

protected function getListAutotextooperadorRemesa($query,$idName,$name,$json,$tipo){
		$request=self::conect()->query($query);
		$request = $request->fetchAll(PDO::FETCH_ASSOC);
		$html="";

		  $selectedSave="";
      if ($tipo=="save") {
		  $selectedSave="selected";
      }
		foreach ($request as $index=>$row) {
		  $selected="";
           if ($tipo=="update") {
		  foreach ($json as $indexope=>$rowoperador) {
      if ($row[$idName]==$rowoperador['operemesa']) {
		  	  $selected="selected";
		  	    }
       }
		  	      }
 $html.='<option '.$selected.' data-subtext="'.$row[$name].'"  value="'.$row[$idName].'"> '.$row[$name].'</option>';
		}
		return $html;
	}
	
//	

protected function getListAutotextoremision($query,$idName,$name,$json,$tipo){
		$request=self::conect()->query($query);
		$request = $request->fetchAll(PDO::FETCH_ASSOC);
		$html="";

		  $selectedSave="";
    if ($tipo=="save") {
		$selectedSave="selected";
    }
		foreach ($request as $index=>$row) {
		  $selected="";
           if ($tipo=="update") {
		  foreach ($json as $indexope=>$rowoperador) {
  if ($row[$idName]==$rowoperador['operador']) {
		  	  $selected="selected";
		  	    }
		}
	 }
$html.='<option '.$selected.' data-subtext="'.$row[$name].'"  value="'.$row[$idName].'"> '.$row[$name].'</option>';
		}
return $html;
	}

protected function getListObigeo2($query,$idName,$name,$idObigeo){
		$request=self::conect()->query($query);
		$request = $request->fetchAll(PDO::FETCH_ASSOC);
		$html="";
		$html.='<option value="">-Seleccionar-</option>';
		foreach ($request as $index=>$row) {
		  $selected="";
		  if ($row[$idName]==$idObigeo) {
		  $selected="selected";
		  }	    
		$html.='<option '.$selected.' value="'.$row[$idName].'"> '.$row[$name].'</option>';
		}
		return $html;

	}

	protected function getListObMF($query,$idName,$name,$idObigeo,$depa,$prov){
		$request=self::conect()->query($query);
		$request = $request->fetchAll(PDO::FETCH_ASSOC);
		$html="";
		  $selectedv="";

		$html.='<option value="">-Seleccionar-</option>';
		foreach ($request as $index=>$row) {
		  $selected="";
		  if ($row[$idName]==$idObigeo ) {
		  	  $selected="selected";
		  	    }	    
	$html.='<option   '.$selected.' value="'.$row[$idName].'"> '.$row[$depa].' - '.$row[$prov].' - '.$row[$name].' </option>';
		}

		return $html;
	}
		protected function getListObMFUPD($query,$idName,$name,$idObigeo,$depa,$prov){
		$request=self::conect()->query($query);
		$request = $request->fetchAll(PDO::FETCH_ASSOC);
		$html="";
		  $selectedv="";

		foreach ($request as $index=>$row) {
		  $selected="";
		  if ($row[$idName]==$idObigeo ) {
		  	  $selected="selected";
		  	    }	    
	$html.='<option   '.$selected.' value="'.$row[$idName].'"> '.$row[$depa].' - '.$row[$prov].' - '.$row[$name].' </option>';
		}

		return $html;
	}

//nuevos
protected function getListAutotextAttr($query,$idName,$name,$id,$tipo){
		$request=self::conect()->query($query);
		$request = $request->fetchAll(PDO::FETCH_ASSOC);
		$html="";
				$html.='<option  value="">-Seleccionar-</option>';

		  $selectedSave="";
     if ($tipo=="save") {
		 $selectedSave="selected";
     }
		foreach ($request as $index=>$row) {
		  $selected="";
    if ($tipo=="update") {
		  if ($row[$idName]==$id) {
		  	  $selected="selected";
		  	    }       
		  }

$html.="<option ".$selected." data-destinatario='".$row['jsondestinatario']."'   data-domicilio='".$row['addressFiscal']."'   data-ruc='".$row['ruc']."'   data-subtext='".$row['ruc']."'  value='".$row[$idName]."'> ".$row[$name]."</option>";
		}

		return $html;
	}

protected function getListAutotextPlaca($query,$idName,$name,$id,$tipo){
		$request=self::conect()->query($query);
		$request = $request->fetchAll(PDO::FETCH_ASSOC);
		$html="";
				$html.='<option data-subtext="seleccion" value="">-Seleccionar-</option>';

		  $selectedSave="";
     if ($tipo=="save") {
		  $selectedSave="selected";
     }
		foreach ($request as $index=>$row) {
		  $selected="";
           if ($tipo=="update") {
		  if ($row[$idName]==$id) {
		  	  $selected="selected";
		  	    }      
	       }
$html.='<option '.$selected.' data-marcavh="'.$row['marcavh'].'"    data-subtext="'.$row[$name].'"  value="'.$row[$idName].'"> '.$row[$name].'</option>';
		}
		return $html;
	}

	protected function getListAutotextBrevete($query,$idName,$name,$id,$tipo){
		$request=self::conect()->query($query);
		$request = $request->fetchAll(PDO::FETCH_ASSOC);
		$html="";
		$html.='<option data-subtext="seleccion" value="">-Seleccionar-</option>';
		  $selectedSave="";
     if ($tipo=="save") {
		  $selectedSave="selected";
     }
		foreach ($request as $index=>$row) {
		  $selected="";
      if ($tipo=="update") {
		  if ($row[$idName]==$id) {
		     $selected="selected";
		  	 }    
		  }

$html.='<option '.$selected.' data-brevete="'.$row['brevete'].'"    data-subtext="'.$row[$name].'"  value="'.$row[$idName].'"> '.$row[$name].'</option>';
	
		}
		return $html;
	}
protected function getListDataMultiProduct($query,$idName,$name,$id,$tipo){
		$request=self::conect()->query($query);
		$request = $request->fetchAll(PDO::FETCH_ASSOC);
		$html="";
		$html.='<option  value="">-Seleccionar-</option>';
	  $selectedSave="";
      if ($tipo=="save") {
		  $selectedSave="selected";
      }
		foreach ($request as $index=>$row) {
		  $selected="";
           if ($tipo=="update") {
		  if ($row[$idName]==$id) {
		  	  $selected="selected";
		  	    }           }

$html.='<option '.$selected.' data-code="'.$row[$name].'"   data-cantidad="'.$row['cantidad'].'"    data-um="'.$row['unidadMedida'].'" data-lote="'.$row['lote'].'"  data-descrip="'.$row['description'].'" data-fechavenc="'.$row['vencimiento'].'"  data-subtext="'.$row['name'].'"  value="'.$row[$idName].'"> '.$row[$name].'</option>';
		}

		return $html;
	}
	
protected function getListAutotext2($query,$idName,$name,$id,$tipo){
		$request=self::conect()->query($query);
		$request = $request->fetchAll(PDO::FETCH_ASSOC);
		$html="";
				$html.="<option data-subtext='seleccion' value=''>-Seleccionar-</option>";

		  $selectedSave="";
           if ($tipo=="save") {
		  $selectedSave="selected";

}

		foreach ($request as $index=>$row) {
		  $selected="";
           if ($tipo=="update") {
		  if ($row[$idName]==$id) {
		  	  $selected="selected";
		  	    }           }

			$html.="<option ".$selected." data-subtext='".$row[$name]."'  value='".$row[$idName]."'> ".$row[$name]."</option>";
		}

		return $html;
	}

protected function getListAutotextPTIREMESA($query,$idName,$name,$id,$tipo){
		$request=self::conect()->query($query);
		$request = $request->fetchAll(PDO::FETCH_ASSOC);
		$html="";
				$html.="<option data-subtext='seleccion' value=''>-Seleccionar-</option>";

		  $selectedSave="";
           if ($tipo=="save") {
		  $selectedSave="selected";
		}
		foreach ($request as $index=>$row) {
		  $selected="";
           if ($tipo=="update") {
		  if ($row[$idName]==$id) {
		  	  $selected="selected";
		  	    }           }

			$html.="<option ".$selected."  data-idDist='".$row['idDist']."'  data-idProv='".$row['idProv']."'   data-idDepa='".$row['idDepa']."'    data-subtext='".$row[$name]."'  value='".$row[$idName]."'> ".$row[$name]."</option>";
		}

		return $html;
	}


    protected function listDepartamento2($iDepartamento){
      $data = mainModel::getListObigeo2("SELECT * FROM tdepartamento  ","idDepa","departamento",$iDepartamento);
      return $data;
    }

    protected function listProvincia2($idDepartamento,$idProvincia){
      $data = mainModel::getListObigeo2("SELECT * FROM tprovincia where idDepa = $idDepartamento ","idProv","provincia",$idProvincia);
      return $data;
    }

    protected function listDistrito2($idProvincia,$idDistrito){
    $data = mainModel::getListObigeo2("SELECT * FROM tdistrito where idProv = $idProvincia ","idDist","distrito",$idDistrito);
      return $data;
    }



	public static function encryption($string){
			$output=FALSE;
			$key=hash('sha256', SECRET_KEY);
			$iv=substr(hash('sha256', SECRET_IV), 0, 16);
			$output=openssl_encrypt($string, METHOD, $key, 0, $iv);
			$output=base64_encode($output);
			return $output;
		}
		public static function decryption($string){
			$key=hash('sha256', SECRET_KEY);
			$iv=substr(hash('sha256', SECRET_IV), 0, 16);
			$output=openssl_decrypt(base64_decode($string), METHOD, $key, 0, $iv);
			return $output;
		}
		protected function generar_codigo_aleatorio($letra,$lenght,$num){

			for($i=1;$i<=$lenght;$i++){
				$numero = rand(0,9);
				$letra.=$numero;
			}
			return $letra.$num;
		}
	protected function remove_sp_chr($str)
{
    $result = str_replace(array("`", "'", ":"), '', $str);
    return $result;
}
	protected function remove_splaca($str)
{
    $result = str_replace(array("'", "`"), '', $str);
    return $result;
}


		protected function limpiar_cadena($string){
			$string =trim($string);
			$string = stripcslashes($string);
			$string = str_ireplace("<script>", "", $string);
			$string = str_ireplace("</script>", "", $string);
			$string = str_ireplace("<script src", "", $string);
			$string = str_ireplace("<script type=", "", $string);
			$string = str_ireplace("SELECT * FROM", "", $string);
			$string = str_ireplace("DELETE FROM", "", $string);
			$string = str_ireplace("INSERT INTO", "", $string);
      $string = str_ireplace("DROP TABLE", "", $string);
			$string = str_ireplace("DROP DATABASE", "", $string);
      $string = str_ireplace("TRUNCATE TABLE", "", $string);
      $string = str_ireplace("SHOW TABLES", "", $string);
			$string = str_ireplace("SHOW DATABASES", "", $string);
			$string = str_ireplace("<?php", "", $string);
			$string = str_ireplace("?>", "", $string);
			$string = str_ireplace("--", "", $string);
			$string = str_ireplace(">", "", $string);
			$string = str_ireplace("<", "", $string);
			$string = str_ireplace("[", "", $string);
			$string = str_ireplace("]", "", $string);
		  $string = str_ireplace("^", "", $string);
			$string = str_ireplace("==", "", $string);
			$string = str_ireplace(";", "", $string);
			$string = str_ireplace("::", "", $string);
			return $string;
		}
		public static function execute_queryreport($query){
		$request=self::conectREPORT()->prepare($query);
		$request->execute();
		return $request;
	} 
public static function conectREPORT(){
		$enlace = new PDO(SGDB,USER,PASSWORD);
		return $enlace;
	}

	
		protected function mensajeRespuesta($data){
        $response_data = []; // Este será el array que contendrá la información para el JSON

        // La propiedad 'alert' es siempre obligatoria para saber qué tipo de mensaje es
        $response_data['alert'] = $data['alert'];

        // Agrega otras propiedades al array dependiendo del tipo de alerta
        if ($data['alert'] == "save") {
            $response_data['title'] = 'Operacion Exitosa';
            $response_data['text'] = 'Datos guardados correctamente.';
            $response_data['type'] = 'success';
            $response_data['actions'] = ['resetForm']; // Indicar acciones a ejecutar en JS
            // Aquí puedes añadir la lógica de WhatsApp para guardar, como habíamos discutido
            if (isset($data['send_whatsapp']) && $data['send_whatsapp'] === true) {
                $response_data['send_whatsapp'] = true;
                $response_data['whatsapp_number'] = $data['whatsapp_number'];
            }

        } else if ($data['alert'] == "saveremitransp") {
            $response_data['title'] = 'Operacion Exitosa';
            $response_data['text'] = 'Datos guardados correctamente.';
            $response_data['type'] = 'success';
            $response_data['report_url'] = $data['report'];
            $response_data['actions'] = ['resetForm', 'ventanaReport'];

        } else if ($data['alert'] == "savenotifi") {
            $response_data['title'] = 'Operacion Exitosa';
            $response_data['text'] = 'Datos guardados correctamente.';
            $response_data['type'] = 'success';
            $response_data['email'] = $data['email'];
            $response_data['actions'] = ['resetForm', 'insertarnot'];

        } else if ($data['alert'] == "savenotifipersonalizado") {
            $response_data['title'] = 'Operacion Exitosa';
            $response_data['text'] = 'Datos guardados correctamente.';
            $response_data['type'] = 'success';
            $response_data['email'] = $data['email'];
            $response_data['actions'] = ['resetForm', 'insertarnot'];

        } else if ($data['alert'] == "savenotifipersonalizadocharguef2") {
            $response_data['title'] = 'Operacion Exitosa';
            $response_data['text'] = 'Datos guardados correctamente.';
            $response_data['type'] = 'success';
            $response_data['email'] = $data['email'];
            $response_data['report_url'] = $data['report'];
            $response_data['actions'] = ['resetForm', 'insertarnot', 'ventanaReport', 'tabladata_reload'];

        } else if ($data['alert'] == "savenotifipersonalizadochargue") {
            $response_data['title'] = 'Operacion Exitosa';
            $response_data['text'] = 'Datos guardados correctamente.';
            $response_data['type'] = 'success';
            $response_data['email'] = $data['email'];
            $response_data['actions'] = ['resetForm', 'insertarnot', 'tabladata_reload'];

        } else if ($data['alert'] == "savenotifipersonalizadodispacht") {
            $response_data['title'] = 'Operacion Exitosa';
            $response_data['text'] = 'Datos guardados correctamente.';
            $response_data['type'] = 'success';
            $response_data['email'] = $data['email'];
            $response_data['actions'] = ['resetForm', 'insertarnot', 'tabladata_reload'];

        } else if ($data['alert'] == "savenotifipersonalizadof5") {
            $response_data['title'] = 'Operacion Exitosa';
            $response_data['text'] = 'Datos guardados correctamente.';
            $response_data['type'] = 'success';
            $response_data['email'] = $data['email'];
            $response_data['report_url'] = $data['report'];
            $response_data['actions'] = ['resetForm', 'insertarnot', 'tabladata_reload', 'ventanaReport'];

        } else if ($data['alert'] == "savenotifipersonalizadof5Remesa") {
            $response_data['title'] = 'Operacion Exitosa';
            $response_data['text'] = 'Datos guardados correctamente.';
            $response_data['type'] = 'success';
            $response_data['email'] = $data['email'];
            $response_data['report_url'] = $data['report'];
            $response_data['redirect_url'] = SERVERURL . "remesa?nivel=2";
            $response_data['actions'] = ['resetForm', 'insertarnot', 'tabladata_reload', 'ventanaReport', 'redirect'];

        } else if ($data['alert'] == "savecontact") {
            $response_data['title'] = 'Operacion Exitosa';
            $response_data['text'] = 'Datos guardados correctamente.';
            $response_data['type'] = 'success';
            $response_data['opcion'] = $data['opcion']; // Contiene código JS a ejecutar
            $response_data['actions'] = ['custom_opcion', 'resetmodalFt'];

        } else if ($data['alert'] == "updatereport") {
            $response_data['title'] = 'Operacion Exitosa';
            $response_data['text'] = 'Datos guardados correctamente.';
            $response_data['type'] = 'success';
            $response_data['report_url'] = $data['report'];
            $response_data['actions'] = ['resetForm', 'ventanaReport', 'tabladata_reload'];

        } else if ($data['alert'] == "saveproduct") {
            $response_data['title'] = 'Operacion Exitosa';
            $response_data['text'] = 'Datos guardados correctamente.';
            $response_data['type'] = 'success';
            $response_data['actions'] = ['resetForm', 'resetForm2', 'resetFormAjax']; // Asumiendo .formAjax[0].reset() se convierte en resetFormAjax

        } else if ($data['alert'] == "savemanifest") {
            $response_data['title'] = 'Operacion Exitosa';
            $response_data['text'] = 'Datos guardados correctamente.';
            $response_data['type'] = 'success';
            $response_data['actions'] = ['reload_window'];

        } else if ($data['alert'] == "updatenotifi") {
            $response_data['title'] = 'Operacion Exitosa';
            $response_data['text'] = 'Los datos se actualizaron con exito.';
            $response_data['type'] = 'success';
            $response_data['email'] = $data['email'];
            $response_data['actions'] = ['tabladata_reload', 'resetForm', 'insertarnot'];

        } else if ($data['alert'] == "update") {
            $response_data['title'] = 'Operacion Exitosa';
            $response_data['text'] = 'Los datos se actualizaron con exito.';
            $response_data['type'] = 'success';
            $response_data['actions'] = ['tabladata_reload', 'resetForm'];

        } else if ($data['alert'] == "updateremesareport") {
            $response_data['title'] = 'Operacion Exitosa';
            $response_data['text'] = 'Datos guardados correctamente.';
            $response_data['type'] = 'success';
            $response_data['report_url'] = $data['report'];
            $response_data['actions'] = ['resetForm', 'ventanaReport', 'tabladata_reload'];

        } else if ($data['alert'] == "updatemf") {
            $response_data['title'] = 'Operacion Exitosa';
            $response_data['text'] = 'Los datos se actualizaron con exito.';
            $response_data['type'] = 'success';
            $response_data['actions'] = ['tabladata_reload', 'resetForm'];

        } else if ($data['alert'] == "sendnotifi") {
            $response_data['title'] = 'Operacion Exitosa';
            $response_data['text'] = 'Los datos se actualizaron con exito.';
            $response_data['type'] = 'success';
            $response_data['email'] = $data['email'];
            $response_data['actions'] = ['tabladata_reload', 'insertarnot', 'resetForm'];

        } else if ($data['alert'] == "sendnotifiemesamulti") {
            $response_data['title'] = 'Operacion Exitosa';
            $response_data['text'] = 'Los datos se actualizaron con exito.';
            $response_data['type'] = 'success';
            $response_data['email'] = $data['email'];
            $response_data['email2'] = $data['email2'];
            $response_data['actions'] = ['tabladata_reload', 'insertarnot', 'insertarnot_email2', 'resetForm'];

        } else if ($data['alert'] == "sendnotifiMult") {
            $response_data['title'] = 'Operacion Exitosa';
            $response_data['text'] = 'Los datos se actualizaron con exito.';
            $response_data['type'] = 'success';
            $response_data['email'] = $data['email'];
            $response_data['email2'] = $data['email2'];
            $response_data['actions'] = ['tabladata_reload', 'insertarnot', 'insertarnot_email2', 'resetForm'];

        } else if ($data['alert'] == "updateTfg") {
            $response_data['title'] = 'Operacion Exitosa';
            $response_data['text'] = 'Los datos se actualizaron con exito.';
            $response_data['type'] = 'success';
            $response_data['actions'] = ['reload_window_delay'];

        } else if ($data['alert'] == "saveseguiModulo") {
            $response_data['title'] = 'Operacion Exitosa';
            $response_data['text'] = 'Los datos se actualizaron con exito.';
            $response_data['type'] = 'success';
            $response_data['actions'] = ['resetmSeguimientoTrack'];

        } else if ($data['alert'] == "saveseguiModulo2") {
            $response_data['title'] = 'Operacion Exitosa';
            $response_data['text'] = 'Los datos se actualizaron con exito.';
            $response_data['type'] = 'success';
            $response_data['redirect_url'] = SERVERURL . "servicetracking?nivel=2";
            $response_data['actions'] = ['resetmSeguimientoTrack', 'redirect'];

        } else if ($data['alert'] == "saveindicador") {
            $response_data['title'] = 'Operacion Exitosa';
            $response_data['text'] = 'Los datos se registraron con exito.';
            $response_data['type'] = 'success';
            $response_data['redirect_url'] = SERVERURL . "indicadores?nivel=2";
            $response_data['actions'] = ['redirect'];

        } else if ($data['alert'] == "saveControlcargo") {
            $response_data['title'] = 'Operacion Exitosa';
            $response_data['text'] = 'Los datos se actualizaron con exito.';
            $response_data['type'] = 'success';
            $response_data['actions'] = ['resetControlcargo'];

        } else if ($data['alert'] == "saveLiquidacionCargo") {
            $response_data['title'] = 'Operacion Exitosa';
            $response_data['text'] = 'Los datos se guadaron con exito.';
            $response_data['type'] = 'success';
            $response_data['actions'] = ['listarDatableGroupLiquicargacontrol'];

        } else if ($data['alert'] == "saveControlcargo2") {
            $response_data['title'] = 'Operacion Exitosa';
            $response_data['text'] = 'Los datos se actualizaron con exito.';
            $response_data['type'] = 'success';
            $response_data['redirect_url'] = SERVERURL . "charguecontrol?nivel=2";
            $response_data['actions'] = ['resetControlcargo', 'redirect'];

        } else if ($data['alert'] == "saveseguiModulo3") {
            $response_data['title'] = 'Operacion Exitosa';
            $response_data['text'] = 'Los datos se guardaon con exito.';
            $response_data['type'] = 'success';
            $response_data['actions'] = ['resetmSeguimientoReg', 'tabladata2_reload'];

        } else if ($data['alert'] == "updateseguiModulo3") {
            $response_data['title'] = 'Operacion Exitosa';
            $response_data['text'] = 'Los datos se actualizaron con exito.';
            $response_data['type'] = 'success';
            $response_data['actions'] = ['resetmSeguimientoRegupdate', 'tabladata_reload'];

        } else if ($data['alert'] == "updateAereo") {
            $response_data['title'] = 'Operacion Exitosa';
            $response_data['text'] = 'Los datos se actualizaron con exito.';
            $response_data['type'] = 'success';
            $response_data['actions'] = ['tabladata2_reload', 'resetForm'];

        } else if ($data['alert'] == "updatepersonalizado") {
            $response_data['title'] = 'Operacion Exitosa';
            $response_data['text'] = $data['campo']; // El mensaje viene en 'campo'
            $response_data['type'] = 'success';
            if (isset($data['operacion']) && $data['operacion'] == "Password") {
                $response_data['actions'] = ['resetForm'];
            }

        } else if ($data['alert'] == "delete") {
            $response_data['title'] = 'Operacion Exitosa';
            $response_data['text'] = 'Los datos se eliminaron de manera exitosa';
            $response_data['type'] = 'success';

        } else if ($data['alert'] == "duplicidad") {
            $response_data['title'] = '¡ Algo Salio Mal !';
            $response_data['text'] = 'El ' . $data['campo'] . ' ya existe en el sistema, por favor registre con otro dato';
            $response_data['type'] = 'warning'; // Cambiado a warning, success es para operaciones exitosas

        } else if ($data['alert'] == "duplicidadpers") {
            $response_data['title'] = '¡ Algo Salio Mal !';
            $response_data['text'] = 'El ' . $data['campo'] . ' ya existe en el sistema, por favor registre con otro email ';
            $response_data['type'] = 'error'; // Error o warning, dependiendo de la severidad
            $response_data['actions'] = ['enableGuardarButton']; // Acción para re-habilitar el botón
            $response_data['button_text'] = 'Guardar'; // Texto para el botón

        } else if ($data['alert'] == "error") {
            $response_data['title'] = 'Algo Salio Mal';
            $response_data['text'] = 'Ocurrio un Error en el sistema , vuelva a intentarlo.';
            $response_data['type'] = 'error';

        } else if ($data['alert'] == "errorpersonalizadofull") {
            $response_data['title'] = 'Algo Salio Mal';
            $response_data['text'] = $data['message'];
            $response_data['type'] = 'error';

        } else if ($data['alert'] == "errorpersonalizado") {
            $response_data['title'] = 'POR FAVOR MODIFIQUE LOS CAMPOS PARA REALIZAR LA OPERACION';
            $response_data['text'] = 'USTED NO HA MODIFICADO NADA';
            $response_data['type'] = 'error';

        } else if ($data['alert'] == "error4") {
            $response_data['title'] = 'Algo Salio Mal';
            $response_data['text'] = 'Ocurrio un Error en el sistema , vuelva a intentarlo.';
            $response_data['type'] = 'error';
            $response_data['actions'] = ['enableGuardarPassButton']; // Acción para re-habilitar botón
            $response_data['button_text'] = 'Guardar'; // Texto para el botón

        } else if ($data['alert'] == "contraseñaError") {
            $response_data['title'] = 'Algo Salio Mal';
            $response_data['text'] = 'Contraseña Actual Invalida , vuelva a intentarlo.';
            $response_data['type'] = 'error';

        } else if ($data['alert'] == "activate") {
            $response_data['title'] = 'Operacion Exitosa';
            $response_data['text'] = 'El elemento se ha activado correctamente en el Sistema';
            $response_data['type'] = 'success';

        } else if ($data['alert'] == "saveFoto") {
            $response_data['title'] = 'Operacion Exitosa';
            $response_data['text'] = 'Datos guardados correctamente.';
            $response_data['type'] = 'success';
            $response_data['image_src'] = SERVERURL . 'view/assets/images/nuevo.png';
            $response_data['actions'] = ['resetForm', 'resetFormAjax', 'updateImageSrc']; // Acciones para JS

        } else if ($data['alert'] == "updateFoto") {
            $response_data['title'] = 'Operacion Exitosa';
            $response_data['text'] = 'Los datos se actualizaron con exito.';
            $response_data['type'] = 'success';
            $response_data['actions'] = ['resetForm', 'tabladata_reload'];
        }

        // Finalmente, devuelve el array como JSON
        header('Content-Type: application/json'); // Asegura que el navegador sepa que es JSON
        return json_encode($response_data);
    }

protected function saveRegistroactivity($data){

    $sql= mainModel::conect()->prepare("INSERT INTO tregistroactivity( idPersonal , actividad) VALUES (:idPersonal , :actividad)");
				$sql->bindParam(":idPersonal",$data['idPersonal']);
				$sql->bindParam(":actividad",$data['actividad']);	
				$sql->execute();
$count = $sql->rowCount(); 

if($count =='0'){ 
    return "0"; 
} 
else{ 
    return "success";
}
	
	}
		protected function saveRegistroactivityProvider($data){

    $sql= mainModel::conect()->prepare("INSERT INTO tregistroactivity( idProvider,actividad) VALUES (:idProvider, :actividad)");
				$sql->bindParam(":idProvider",$data['idProvider']);
				$sql->bindParam(":actividad",$data['actividad']);	
				$sql->execute();
$count = $sql->rowCount(); 

if($count =='0'){ 
    return "0"; 
} 
else{ 
    return "success";
}
	
	}
///
  protected function saveNotifyPersonalizado($idpersonal,$typemessage){
  	    $sql= mainModel::conect()->prepare("INSERT INTO tnotify(idPersonal,typemessage) VALUES (:idPersonal,:typemessage)");
				$sql->bindParam(":idPersonal",$idpersonal);
				$sql->bindParam(":typemessage",$typemessage);

				$sql->execute();
$count = $sql->rowCount(); 
if($count =='0'){ 
    return "error"; 
} 
else{ 
    return "success";
}

  }

    protected function saveMultiNotifyPersonalizado($json,$typemessage){
  	 $count='0';

  	foreach ($json as $key => $value) {
  		$idpersonal=$value['idPersonal'];
  $sql= mainModel::conect()->prepare("INSERT INTO tnotify(idPersonal,typemessage) VALUES (:idPersonal,:typemessage)");
				$sql->bindParam(":idPersonal",$idpersonal);
				$sql->bindParam(":typemessage",$typemessage);

				$sql->execute();
$count = $sql->rowCount(); 
  	   }   
  	  
if($count =='0'){ 
    return "error"; 
} 
else{ 
    return "success";
}

  }
	
public function deleteImgController($carpeta,$name){
		$urlimg = $name;
		unlink("../assets/".$carpeta."/".$name);
		return "1";
	}
	public function uploadFile($cargaI,$carpeta,$name){
		$imgPrincipal ="imgdefauld.jpg";
			if($cargaI != 0){
				$ruta_carpeta = "../assets/".$carpeta."/";
				$nombre_archivo = $name.date("dHis") .".". pathinfo($_FILES["image"]["name"],PATHINFO_EXTENSION);
				$ruta_guardar_archivo = $ruta_carpeta . $nombre_archivo;
				if(move_uploaded_file($_FILES["image"]["tmp_name"],$ruta_guardar_archivo)){
						$imgPrincipal= $nombre_archivo;
				}
			}
				return $imgPrincipal;
	}
	public function uploadFileEXCEL($cargaI,$carpeta,$name,$nameI){
		$imgPrincipal ="Error";
			if($cargaI != 0){
				$ruta_carpeta = "../assets/".$carpeta."/";
				$nombre_archivo = $name.date("dHis") .".". pathinfo($_FILES[$nameI]["name"],PATHINFO_EXTENSION);
				$ruta_guardar_archivo = $ruta_carpeta . $nombre_archivo;
				if(move_uploaded_file($_FILES[$nameI]["tmp_name"],$ruta_guardar_archivo)){
						$imgPrincipal= $nombre_archivo;
				}
			}
				return $imgPrincipal;
	}
	
		public function uploadFilePrincipal($cargaI,$carpeta,$name){

		$imgPrincipal ="imgdefauld.jpg";

			if($cargaI != 0){

				if($name=="documentos"){
			$ruta_carpeta = "../assets/".$carpeta."/";
			
			$nombreconstante= date("dHis")."-".$_FILES["file"]["name"];
//echo("----".$_FILES["file"]["tmp_name"]);
			//$nombreconstante= pathinfo($_FILES["file"]["name"],PATHINFO_EXTENSION);
				//$nombre_archivo = $name.date("dHis") .".". pathinfo($_FILES["file"]["name"],PATHINFO_EXTENSION);
				$ruta_guardar_archivo = $ruta_carpeta . $nombreconstante;
				if(move_uploaded_file($_FILES["file"]["tmp_name"],$ruta_guardar_archivo)){
						$imgPrincipal= $nombreconstante."|".pathinfo($_FILES["file"]["name"],PATHINFO_EXTENSION);
				}

		}else{
			echo "23";
			$ruta_carpeta = "../assets/".$carpeta."/";
				$nombre_archivo = $name.date("dHis") .".". pathinfo($_FILES["file"]["name"],PATHINFO_EXTENSION);
				$ruta_guardar_archivo = $ruta_carpeta . $nombre_archivo;
				if(move_uploaded_file($_FILES["file"]["tmp_name"],$ruta_guardar_archivo)){
						$imgPrincipal= $nombre_archivo;
				}
		}
				
			}
				return $imgPrincipal;
	}
//funcion mastra Dinamic Post FILES
   public function uploadDinamicFiles($name,$ruta,$concat){

if (empty($_FILES['input0'])) {
   $paths[] = "imgdefauld.jpg"; 
         return $paths;
}

$paths= array();

  for($i=0; $i <$concat; $i++){
$ficheros = $_FILES['input'.$i];
  $ruta_carpeta = "../assets/".$ruta."/";
        $nombre_archivo = $name.$i.date("dHis") .".". pathinfo($_FILES["input".$i]["name"],PATHINFO_EXTENSION);
        $ruta_guardar_archivo = $ruta_carpeta . $nombre_archivo;
        if(move_uploaded_file($_FILES["input".$i]["tmp_name"],$ruta_guardar_archivo)){
            $paths[]= $nombre_archivo;
        }else {
    $paths[] ="imgdefauld.jpg";
    }
}
      return $paths;
   }

public function textElipsis($some_string)
{
	if(strlen($some_string) > 19){
	$some_string = substr($some_string,0,19)."...";
	}
return $some_string;
}

 public function uploadDinamicFilesSeguimiento($name,$ruta){
//if ($_FILES['image']['name'][0] == null) {
 //  $paths[] = "imgdefauld.jpg"; 
  // return $paths;
//}


$paths= array();
    $countfiles = count($_FILES['image']['name']);

    for($i=0;$i<$countfiles;$i++){
if ($_FILES['image']['name'][$i] != null) {


$ficheros =$_FILES['image'];
  $ruta_carpeta = "../assets/".$ruta."/";
        $nombre_archivo = $name.$i.date("dHis") .".". pathinfo($_FILES['image']['name'][$i],PATHINFO_EXTENSION);
        $ruta_guardar_archivo = $ruta_carpeta . $nombre_archivo;
        if(move_uploaded_file($_FILES["image"]["tmp_name"][$i],$ruta_guardar_archivo)){
            $paths[]= $nombre_archivo;
        }else {
    $paths[] ="imgdefauld.jpg";
    }
}

}
      return $paths;
   }

public  function paginate($page, $tpages, $adjacents,$lista,$ajax,$type) {
	$prevlabel = "&lsaquo; Anterior";
	$nextlabel = "Siguiente &rsaquo;";
	$out="";
	 $out.='<nav class="text-center paginado">
        <ul class="pagination pagination-sm">';
	// previous label

	if($page==1) {
		$out.= '<li class="page-item disabled "><a  class="page-link" href="javascript:void(0)"><<</a></li>';
	} else if($page==2) {
		$out.= '<li class="page-item active "><a  class="page-link" onclick="'.$lista.'( `'.$ajax.'`,'.(1).',`'.$type.'`,`'.SERVERURL.'`);"><<</a></li>';
	}else {
		$out.= '<li class="page-item active "><a  class="page-link" onclick="'.$lista.'( `'.$ajax.'`,'.($page-1).',`'.$type.'`,`'.SERVERURL.'`);"><<</a></li>';

	}
	
	// first label
	if($page>($adjacents+1)) {
		$out.= '<li class="page-item" ><a  class="page-link" onclick="'.$lista.'( `'.$ajax.'`,'.(1).',`'.$type.'`,`'.SERVERURL.'`);" >'.(1).'</a></li>';
	}
	// interval
	if($page>($adjacents+2)) {

		$out.= '<li class="page-item" ><a  class="page-link" onclick="'.$lista.'( `'.$ajax.'`,'.($page-($adjacents+1)).',`'.$type.'`,`'.SERVERURL.'`);" >'."...".'</a></li>';
	}

	// pages

	$pmin = ($page>$adjacents) ? ($page-$adjacents) : 1;
	$pmax = ($page<($tpages-$adjacents)) ? ($page+$adjacents) : $tpages;
	for($i=$pmin; $i<=$pmax; $i++) {
		if($i==$page) {
			$out.= '<li class="page-item active"><a class="page-link" onclick="'.$lista.'( `'.$ajax.'`,'.$i.',`'.$type.'`,`'.SERVERURL.'`);" >'.$i.'</a></li>';
		}else if($i==1) {
			$out.='<li class="page-item" ><a  class="page-link" onclick="'.$lista.'( `'.$ajax.'`,'.$i.',`'.$type.'`,`'.SERVERURL.'`);" >'.$i.'</a></li>'; 
		}else {
			$out.='<li class="page-item" ><a  class="page-link" onclick="onReloadList( `'.$ajax.'`,'.$i.',`'.$type.'`,`'.SERVERURL.'`);" >'.$i.'</a></li>';  
		}
	}

	// interval

	if($page<($tpages-$adjacents-1)) {
		$out.='<li class="page-item" ><a  class="page-link" onclick="'.$lista.'( `'.$ajax.'`,'.($tpages-1).',`'.$type.'`,`'.SERVERURL.'`);" >'."...".'</a></li>';
	}

	// last

	if($page<($tpages-$adjacents)) {
		$out.= 	'<li class="page-item" ><a  class="page-link" onclick="'.$lista.'( `'.$ajax.'`,'.($tpages).',`'.$type.'`,`'.SERVERURL.'`);" > '.$tpages.'</a></li>';  
	}

	// next

	if($page<$tpages) {
		$out.= '<li class="page-item "><a  class="page-link" onclick="'.$lista.'( `'.$ajax.'`,'.($page+1).',`'.$type.'`,`'.SERVERURL.'`);"> >>  </a></li>';

	}else {
		$out.='<li class="page-item disabled"><a  class="page-link">>></a></li>'; 
	}

	$out .= '</ul></nav><div class="loading text-center"></div>';

	
	return $out;
}


public  function paginate2($page, $tpages, $adjacents,$lista,$ajax,$type) {
	$prevlabel = "&lsaquo; Anterior";
	$nextlabel = "Siguiente &rsaquo;";
	$out="";
	 $out.='
        <ul class="pagination paginado">';
	// previous label

	if($page==1) {
		$out.= '<li  class="prev disabled"><a   href="javascript:void(0)"> <i class="fa fa-chevron-left"></i>		  </a></li>';
	} else if($page==2) {
		$out.= '<li class="active "><a  onclick="'.$lista.'( `'.$ajax.'`,'.(1).',`'.$type.'`,`'.SERVERURL.'`);">
 <i class="fa fa-chevron-left"></i>	</a></li>';
	}else {
		$out.= '<li class="active"><a  onclick="'.$lista.'( `'.$ajax.'`,'.($page-1).',`'.$type.'`,`'.SERVERURL.'`);">  <i class="fa fa-chevron-left"></i>
		</a></li>';

	}
	
	// first label
	if($page>($adjacents+1)) {
		$out.= '<li  ><a  onclick="'.$lista.'( `'.$ajax.'`,'.(1).',`'.$type.'`,`'.SERVERURL.'`);" >'.(1).'</a></li>';
	}
	// interval
	if($page>($adjacents+2)) {

		$out.= '<li  ><a   onclick="'.$lista.'( `'.$ajax.'`,'.($page-($adjacents+1)).',`'.$type.'`,`'.SERVERURL.'`);" >'."...".'</a></li>';
	}

	// pages

	$pmin = ($page>$adjacents) ? ($page-$adjacents) : 1;
	$pmax = ($page<($tpages-$adjacents)) ? ($page+$adjacents) : $tpages;
	for($i=$pmin; $i<=$pmax; $i++) {
		if($i==$page) {
			$out.= '<li class="active"><a onclick="'.$lista.'( `'.$ajax.'`,'.$i.',`'.$type.'`,`'.SERVERURL.'`);" >'.$i.'</a></li>';
		}else if($i==1) {
			$out.='<li ><a onclick="'.$lista.'( `'.$ajax.'`,'.$i.',`'.$type.'`,`'.SERVERURL.'`);" >'.$i.'</a></li>'; 
		}else {
	  $out.='<li ><a onclick="onReloadList( `'.$ajax.'`,'.$i.',`'.$type.'`,`'.SERVERURL.'`);" >'.$i.'</a></li>';  
		}
	}

	// interval

	if($page<($tpages-$adjacents-1)) {
		$out.='<li  ><a  onclick="'.$lista.'( `'.$ajax.'`,'.($tpages-1).',`'.$type.'`,`'.SERVERURL.'`);" >'."...".'</a></li>';
	}

	// last

	if($page<($tpages-$adjacents)) {
		$out.= 	'<li ><a onclick="'.$lista.'( `'.$ajax.'`,'.($tpages).',`'.$type.'`,`'.SERVERURL.'`);" > '.$tpages.'</a></li>';  
	}

	// next

	if($page<$tpages) {
		$out.= '<li><a   onclick="'.$lista.'( `'.$ajax.'`,'.($page+1).',`'.$type.'`,`'.SERVERURL.'`);"> 											<i class="fa fa-chevron-right"></i> </a></li>';

	}else {
		$out.='<li class="next"><a ><i class="fa fa-chevron-right"></i></a></li>'; 
	}

	$out .= '</ul><div class="loading text-center"></div>';

	
	return $out;
}

protected function getObjeto($query){
		$request=self::conect()->query($query);
		$request = $request->fetch(PDO::FETCH_ASSOC);

		return $request;
		
	}

	protected function getJson($query){
		$request=self::conect()->query($query);
		$request = $request->fetchAll(PDO::FETCH_ASSOC);

		return $request;
		
	}

	protected function getListPers2StringPrueba($query,$idName,$name,$id,$tipo){
		$request=self::conect()->query($query);
		$request = $request->fetchAll(PDO::FETCH_ASSOC);

		$html="";
		  $selectedSave="";
           if ($tipo=="save") {
		  $selectedSave="selected";

}
		$html.='<option '.$selectedSave.' value="">-Seleccionar-</option>';
		foreach ($request as $index=>$row) {
		  $selected="";
           if ($tipo=="update") {
           	 
           	  $com1 = preg_replace('/\s+/', '', $id);
           	  $com2 = preg_replace('/\s+/', '', $row[$name]);
		  if ($com1  == $com2) {
		  	  $selected="selected";
		  	 
		  	    }           }


			$html.='<option '.$selected.'  data-phone="'.$row['phone'].'"   value="'.$row[$name].'"> '.$row[$name].'</option>';
		}

		return $html;
	}

protected function getListPers2String($query,$idName,$name,$id,$tipo){
		$request=self::conect()->query($query);
		$request = $request->fetchAll(PDO::FETCH_ASSOC);
		$html="";
		  $selectedSave="";
           if ($tipo=="save") {
		  $selectedSave="selected";

}
		$html.='<option '.$selectedSave.' value="">-Seleccionar-</option>';
		foreach ($request as $index=>$row) {
		  $selected="";
           if ($tipo=="update") {
           	 $com1 = preg_replace('/\s+/', '', $id);
           	  $com2 = preg_replace('/\s+/', '', $row[$name]);
		  if ($com1  == $com2) {
		  	  $selected="selected";
		  	    }           }


			$html.='<option '.$selected.'  data-phone="'.$row['phone'].'"   value="'.$row[$name].'"> '.$row[$name].'</option>';
		}

		return $html;
	}



    protected function saveNotifyProviderPersonalizado($idProvider,$typemessage){

  	    $sql= mainModel::conect()->prepare("INSERT INTO tnotify(idProvider,typemessage ) VALUES (:idProvider,:typemessage)");
				$sql->bindParam(":idProvider",$idProvider);
				$sql->bindParam(":typemessage",$typemessage);
				$sql->execute();
$count = $sql->rowCount(); 
if($count =='0'){ 
    return "error"; 
} 
else{ 
    return "success";
}

  } 

	protected function getListObMFFV($query,$idName,$name,$idObigeo,$depa,$prov){
		$request=self::conect()->query($query);
		$request = $request->fetchAll(PDO::FETCH_ASSOC);
		$html="";
		  $selectedv="";

		$html.='<option value="">-Seleccionar-</option>';
		foreach ($request as $index=>$row) {
		  $selected="";
		  if ($row[$idName]==$idObigeo ) {
		  	  $selected="selected";
		  	    }	    
	$html.='<option data-depa="'.$row['idDepa'].'"   '.$selected.' value="'.$row[$idName].'"> '.$row[$depa].' - '.$row[$prov].' - '.$row[$name].' </option>';
		}

		return $html;
	}
	
protected function getListObMFProv($query,$idName,$name,$idObigeo,$depa){
		$request=self::conect()->query($query);
		$request = $request->fetchAll(PDO::FETCH_ASSOC);
		$html="";
		  $selectedv="";

		$html.='<option value="">-Seleccionar-</option>';
		foreach ($request as $index=>$row) {
		  $selected="";
		  if ($row[$idName]==$idObigeo ) {
		  	  $selected="selected";
		  	    }	    
	$html.='<option   '.$selected.' value="'.$row[$idName].'"> '.$row[$depa].' - '.$row[$name].' </option>';
		}

		return $html;
	}
	
protected function getListAutotextochofer($query,$idName,$name,$json,$tipo){
		$request=self::conect()->query($query);
		$request = $request->fetchAll(PDO::FETCH_ASSOC);
		$html="";

		  $selectedSave="";
           if ($tipo=="save") {
		  $selectedSave="selected";

}
		foreach ($request as $index=>$row) {
		  $selected="";
           if ($tipo=="update") {
		  foreach ($json as $indexope=>$rowoperador) {
  if ($row[$idName]==$rowoperador['chofer']) {
		  	  $selected="selected";
		  	    }
}
		  	      }
			$html.='<option '.$selected.' data-subtext="'.$row[$name].'"  value="'.$row[$idName].'"> '.$row[$name].'</option>';
		}

		return $html;
	}

	protected function getListAutotextconsignubg($query,$idName,$name,$id,$tipo){
		$request=self::conect()->query($query);
		$request = $request->fetchAll(PDO::FETCH_ASSOC);
		$html="";
		$html.='<option data-subtext="seleccion" value="">-Seleccionar-</option>';
		  $selectedSave="";
           if ($tipo=="save") {
		  $selectedSave="selected";
		}
		foreach ($request as $index=>$row) {
		  $selected="";
		  if ($tipo=="save") {
		   if ($row['idDistrito']==$id) {
		  	  $selected="selected";
		  	    }  
		  } if($tipo=="update"){
		  	 if ($row['idProvider']==$id) {
		  	  $selected="selected";
		  	    } 
		  }

	$html.='<option '.$selected.' data-subtext="'.$row[$name].'"  value="'.$row[$idName].'"> '.$row[$name].' ('.$row['departamento'].' - '.$row['provincia'].' - '.$row['distrito'].') </option>';
		}

		return $html;
	}
	


}