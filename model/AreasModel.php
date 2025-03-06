<?php 

if ($peticionAjax) {
	require_once "../model/mainModel.php";
}else{
	require_once "./model/mainModel.php";
}

class AreasModel extends mainModel
{

protected function saveAreasModel($data){

	//var_dump($data);
	
	$sql = mainModel::conect()->prepare("INSERT INTO tareas(name) VALUES (:name)");

	$sql->bindParam(":name",$data["name"]);

	$sql->execute();
return true;
}
	protected function updateAreasModel($data){
		//var_dump($data);
		$sql=mainModel::conect()->prepare("UPDATE tareas SET name=:name WHERE idAreas= :idAreas ");
		$sql->bindParam(":idAreas",$data["idAreas"]);
	$sql->bindParam(":name",$data["name"]);


	$sql->execute();
	return "true";
	}

}