<?php 

if ($peticionAjax) {
	require_once "../model/mainModel.php";
}else{
	require_once "./model/mainModel.php";
}

class MaterialModel extends mainModel
{

protected function saveMaterialModel($data){
	
	$sql=mainModel::conect()->prepare("INSERT INTO tmaterial(name,stock,nserie) VALUES (:name, :stock, :nserie)");
	$sql->bindParam(":name",$data["name"]);
	$sql->bindParam(":stock",$data["stock"]);
	$sql->bindParam(":nserie",$data["nserie"]);
	$sql->execute();
return true;
}
	
}