<?php 

if ($peticionAjax) {
    require_once "../model/mainModel.php";
} else {
    require_once "./model/mainModel.php";
}

class EstablecimientoModel extends mainModel
{
    protected function saveEstablecimientoModel($data) {
        try {
            $sql = mainModel::conect()->prepare("INSERT INTO testablecimiento(name, address, idDepa, idProv, idDist) VALUES (:name, :address, :idDepa, :idProv, :idDist)");
            $sql->bindParam(":name", $data["name"]);
            $sql->bindParam(":address", $data["address"]);
            $sql->bindParam(":idDepa", $data["idDepa"]);
            $sql->bindParam(":idProv", $data["idProv"]);
            $sql->bindParam(":idDist", $data["idDist"]);

            return $sql->execute(); // Retorna true o false
        } catch (Exception $e) {
            // Manejo de errores (opcional)
            return false;
        }
    }

    protected function updateEstablecimientoModel($data) {
        try {
            $sql = mainModel::conect()->prepare("UPDATE testablecimiento SET name = :name, address = :address, idDepa = :idDepa, idProv = :idProv, idDist = :idDist WHERE idEstablecimiento = :idEstablecimiento");
            $sql->bindParam(":idEstablecimiento", $data["idEstablecimiento"]);
            $sql->bindParam(":name", $data["name"]);           
            $sql->bindParam(":address", $data["address"]);
            $sql->bindParam(":idDepa", $data["idDepa"]);
            $sql->bindParam(":idProv", $data["idProv"]);
            $sql->bindParam(":idDist", $data["idDist"]);

            return $sql->execute(); // Retorna true o false
        } catch (Exception $e) {
            // Manejo de errores (opcional)
            return false;
        }
    }
}