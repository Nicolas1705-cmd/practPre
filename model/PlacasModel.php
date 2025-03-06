<?php 

if ($peticionAjax) {
	require_once "../model/mainModel.php";
}else{
	require_once "./model/mainModel.php";
}

class PlacasModel extends mainModel
{

	protected function savePlacaModel($data){
			$sql= mainModel::conect()->prepare("INSERT INTO tplaca(name,codigo,marcavh,modelo,serie,motor,combustible,yearf,ne,nr,na,np,laa,pneto,pbruto,putil) 
				VALUES (:name,:codigo,:marcavh,:modelo,:serie,:motor,:combustible,:yearf,:ne,:nr,:na,
				:np,:laa,:pneto,:pbruto,:putil)");


				$sql->bindParam(":name",$data['name']);
				$sql->bindParam(":codigo",$data['codigo']);
				$sql->bindParam(":marcavh",$data['marcavh']);
				$sql->bindParam(":modelo",$data['modelo']);
				$sql->bindParam(":serie",$data['serie']);
				$sql->bindParam(":motor",$data['motor']);
				$sql->bindParam(":combustible",$data['combustible']);
				$sql->bindParam(":yearf",$data['yearf']);
				$sql->bindParam(":ne",$data['ne']);
				$sql->bindParam(":nr",$data['nr']);
				$sql->bindParam(":na",$data['na']);
				$sql->bindParam(":np",$data['np']);
				$sql->bindParam(":laa",$data['laa']);
				$sql->bindParam(":pneto",$data['pneto']);
				$sql->bindParam(":pbruto",$data['pbruto']);
				$sql->bindParam(":putil",$data['putil']);
				$sql->execute();
		

  $idPersonal=mainModel::decryption($_SESSION['Encryuser']);
      $dataactividad=[
        "idPersonal"=>$idPersonal,
        "actividad"=>"A registrado una nueva Placa"
      ]; 
     

		return $sql;
	}
	protected function updatePlacaModel($data){
$sql= mainModel::conect()->prepare("UPDATE tplaca SET name = :name ,codigo=:codigo,marcavh=:marcavh,modelo=:modelo,serie=:serie,motor=:motor,combustible=:combustible,yearf=:yearf,ne=:ne,nr=:nr,na=:na,np=:np,laa=:laa,pneto=:pneto,pbruto=:pbruto,putil=:putil  WHERE 
	idplaca=:idplaca" );
				$sql->bindParam(":idplaca",$data['idplaca']);
				$sql->bindParam(":name",$data['name']);
				$sql->bindParam(":codigo",$data['codigo']);
				$sql->bindParam(":marcavh",$data['marcavh']);
				$sql->bindParam(":modelo",$data['modelo']);
				$sql->bindParam(":serie",$data['serie']);
				$sql->bindParam(":motor",$data['motor']);
				$sql->bindParam(":combustible",$data['combustible']);
				$sql->bindParam(":yearf",$data['yearf']);
				$sql->bindParam(":ne",$data['ne']);
				$sql->bindParam(":nr",$data['nr']);
				$sql->bindParam(":na",$data['na']);
				$sql->bindParam(":np",$data['np']);
				$sql->bindParam(":laa",$data['laa']);
				$sql->bindParam(":pneto",$data['pneto']);
				$sql->bindParam(":pbruto",$data['pbruto']);
				$sql->bindParam(":putil",$data['putil']);
		$sql->execute();
		   $idPersonal=mainModel::decryption($_SESSION['Encryuser']);
      $dataactividad=[
        "idPersonal"=>$idPersonal,
        "actividad"=>"A actualizado una Placa ID*: ".$data['idplaca']
      ]; 
    
		return $sql;
	}

}