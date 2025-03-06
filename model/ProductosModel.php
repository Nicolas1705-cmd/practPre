<?php 

if ($peticionAjax) {
	require_once "../model/mainModel.php";
}else{
	require_once "./model/mainModel.php";
}

class ProductosModel extends mainModel
{

protected function saveProductosModel($data){
	
	$sql=mainModel::conect()->prepare("INSERT INTO tproduct(name,stock,nserie) VALUES (:name, :stock, :nserie)");
	$sql->bindParam(":name",$data["name"]);
	$sql->bindParam(":stock",$data["stock"]);
	$sql->bindParam(":nserie",$data["nserie"]);
	$sql->execute();
return true;
}
	
}