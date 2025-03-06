<?php 

if ($peticionAjax) {
	require_once "../model/mainModel.php";
}else{
	require_once "./model/mainModel.php";
}

class CommunicationModel extends mainModel
{

protected function saveCommunicationModel($data){

	//var_dump($data);
	
	$sql=mainModel::conect()->prepare("INSERT INTO tcommunication(title,subtitle,imagen,emails,idPersonal,idtypeCommunication) VALUES (:title, :subtitle,:imagen,:emails ,:idPersonal,:idtypeCommunication)");
	$sql->bindParam(":title",$data["title"]);
	$sql->bindParam(":subtitle",$data["subtitle"]);
	$sql->bindParam(":imagen",$data["imagen"]);
	$sql->bindParam(":emails",$data["emails"]);
	$sql->bindParam(":idPersonal",$data["idPersonal"]);
	$sql->bindParam(":idtypeCommunication",$data["idtypeCommunication"]);
	$sql->execute();
return true;
}
	protected function updateCommunicationModel($data){
		//var_dump($data);
		$sql=mainModel::conect()->prepare("UPDATE tcommunication SET title= :title, subtitle=:subtitle,imagen=:imagen,emails=:emails ,idPersonal=:idPersonal, idtypeCommunication=:idtypeCommunication WHERE idCommunication= :idCommunication ");
		$sql->bindParam(":idCommunication",$data["idCommunication"]);
	$sql->bindParam(":title",$data["title"]);
	$sql->bindParam(":subtitle",$data["subtitle"]);
	$sql->bindParam(":imagen",$data["imagen"]);
	$sql->bindParam(":emails",$data["emails"]);
	$sql->bindParam(":idPersonal",$data["idPersonal"]);
	$sql->bindParam(":idtypeCommunication",$data["idtypeCommunication"]);
	$sql->execute();
	return "true";
	}

}