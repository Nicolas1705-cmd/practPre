<?php

if ($peticionAjax) {
	require_once "../model/mainModel.php";
}else{
	require_once "./model/mainModel.php";
}

class MaterialModel extends mainModel
{

protected function saveMaterialModel($data){

    // Asegúrate de que la columna 'numTelf' exista en tu tabla 'tmaterial' en la base de datos
    // con un tipo de dato adecuado (ej. VARCHAR)
	$sql=mainModel::conect()->prepare("INSERT INTO tmaterial(name,stock,nserie,numTelf) VALUES (:name, :stock, :nserie, :numTelf)");
	$sql->bindParam(":name",$data["name"]);
	$sql->bindParam(":stock",$data["stock"]);
	$sql->bindParam(":nserie",$data["nserie"]);
    $sql->bindParam(":numTelf",$data["numTelf"]);
	$sql->execute();
return true;
}

// NUEVA FUNCIÓN PARA ACTUALIZAR MATERIAL
protected function updateMaterialModel($data){
    // Desencriptar el idMaterial
    $id = mainModel::decryption($data['idMaterial']);

    // Verificar si la desencriptación fue exitosa
    if ($id === false) {
        return false; // O maneja el error de alguna otra manera
    }

    $sql=mainModel::conect()->prepare("UPDATE tmaterial SET
        name = :name,
        stock = :stock,
        nserie = :nserie,
        numTelf = :numTelf
        WHERE idMaterial = :idMaterial");

    $sql->bindParam(":name", $data["name"]);
    $sql->bindParam(":stock", $data["stock"]);
    $sql->bindParam(":nserie", $data["nserie"]);
    $sql->bindParam(":numTelf", $data["numTelf"]);
    $sql->bindParam(":idMaterial", $id); // Usamos el ID desencriptado

    if ($sql->execute()) {
        return true;
    } else {
        return false;
    }
}
// FIN DE LA NUEVA FUNCIÓN PARA ACTUALIZAR MATERIAL

}