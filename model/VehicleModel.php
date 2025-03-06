<?php 

if ($peticionAjax) {
	require_once "../model/mainModel.php";
}else{
	require_once "./model/mainModel.php";
}

class VehicleModel extends mainModel
{

protected function saveVehicleModel($data){

	$sql=mainModel::conect()->prepare("INSERT INTO tvehicle(brand,nserie) VALUES (:brand, :nserie)");
	$sql->bindParam(":brand",$data["brand"]);
	$sql->bindParam(":nserie",$data["nserie"]);
	$sql->execute();
return true;
}
	
}