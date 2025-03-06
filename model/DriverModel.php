<?php 

if ($peticionAjax) {
	require_once "../model/mainModel.php";
}else{
	require_once "./model/mainModel.php";
}

class DriverModel extends mainModel
{

protected function saveDriverModel($data){

	//var_dump($data);
	
	$sql = mainModel::conect()->prepare("INSERT INTO tdriver(name,lastName,dateOfBirth,address,phone,email,licenseNumber,licenseExpirationDate,bloodType,socialSecurityNumber) VALUES (:name, :lastName, :dateOfBirth, :address, :phone, :email, :licenseNumber, :licenseExpirationDate, :bloodType, :socialSecurityNumber)");

	$sql->bindParam(":name",$data["name"]);
	$sql->bindParam(":lastName",$data["lastName"]);
	$sql->bindParam(":dateOfBirth",$data["dateOfBirth"]);
	$sql->bindParam(":address",$data["address"]);
	$sql->bindParam(":phone",$data["phone"]);
	$sql->bindParam(":email",$data["email"]);
	$sql->bindParam(":licenseNumber",$data["licenseNumber"]);
	$sql->bindParam(":licenseExpirationDate",$data["licenseExpirationDate"]);
	$sql->bindParam(":bloodType",$data["bloodType"]);
	$sql->bindParam(":socialSecurityNumber",$data["socialSecurityNumber"]);

	$sql->execute();
return true;
}
	protected function updateDriverModel($data){
		//var_dump($data);
		$sql=mainModel::conect()->prepare("UPDATE tdriver SET name=:name,lastName=:lastName,dateOfBirth=:dateOfBirth,address=:address,phone=:phone,email=:email,licenseNumber=:licenseNumber,licenseExpirationDate=:licenseExpirationDate,bloodType=:bloodType,socialSecurityNumber=:socialSecurityNumber WHERE idDriver= :idDriver ");
		$sql->bindParam(":idDriver",$data["idDriver"]);
	$sql->bindParam(":name",$data["name"]);
	$sql->bindParam(":lastName",$data["lastName"]);
	$sql->bindParam(":dateOfBirth",$data["dateOfBirth"]);
	$sql->bindParam(":address",$data["address"]);
	$sql->bindParam(":phone",$data["phone"]);
	$sql->bindParam(":email",$data["email"]);
	$sql->bindParam(":licenseNumber",$data["licenseNumber"]);
	$sql->bindParam(":licenseExpirationDate",$data["licenseExpirationDate"]);
	$sql->bindParam(":bloodType",$data["bloodType"]);
	$sql->bindParam(":socialSecurityNumber",$data["socialSecurityNumber"]);

	$sql->execute();
	return "true";
	}

}