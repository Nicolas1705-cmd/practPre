<?php 

if ($peticionAjax) {
	require_once "../model/mainModel.php";
}else{
	require_once "./model/mainModel.php";
}

class BanksModel extends mainModel
{

protected function saveBanksModel($data){

	//var_dump($data);
	
	$sql=mainModel::conect()->prepare("INSERT INTO tbanco(nombre,abreviatura,codsunat) VALUES (:nombre, :abreviatura,:codsunat)");
	$sql->bindParam(":nombre",$data["nombre"]);
	$sql->bindParam(":abreviatura",$data["abreviatura"]);
	$sql->bindParam(":codsunat",$data["codsunat"]);

	$sql->execute();
return true;
}
	protected function updateBanksModel($data){
		//var_dump($data);
		$sql=mainModel::conect()->prepare("UPDATE tbanco SET nombre= :nombre, abreviatura=:abreviatura,codsunat=:codsunat WHERE idbanco= :idbanco ");
		$sql->bindParam(":idbanco",$data["idbanco"]);
	$sql->bindParam(":nombre",$data["nombre"]);
	$sql->bindParam(":abreviatura",$data["abreviatura"]);
	$sql->bindParam(":codsunat",$data["codsunat"]);

	$sql->execute();
	return "true";
	}

}