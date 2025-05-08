<?php 

if ($peticionAjax) {
    require_once "../model/mainModel.php";
} else {
    require_once "./model/mainModel.php";
}

class CombustibleModel extends mainModel
{
    protected function saveCombustibleModel($data) {
        try {
            $sql = mainModel::conect()->prepare("INSERT INTO tcombustible(name, idChoferes, idVehiculos, kilometraje, cantidad, monto, tipoCombustible, estacionServicio, comprobanteURL) VALUES (:name, :idChoferes, :idVehiculos, :kilometraje, :cantidad, :monto, :tipoCombustible, :estacionServicio, :comprobanteURL)");
            $sql->bindParam(":name", $data["name"]);
            $sql->bindParam(":idChoferes", $data["idChoferes"]);
            $sql->bindParam(":idVehiculos", $data["idVehiculos"]);
            $sql->bindParam(":kilometraje", $data["kilometraje"]);
            $sql->bindParam(":cantidad", $data["cantidad"]);
            $sql->bindParam(":monto", $data["monto"]);
            $sql->bindParam(":tipoCombustible", $data["tipoCombustible"]);
            $sql->bindParam(":estacionServicio", $data["estacionServicio"]);
            $sql->bindParam(":comprobanteURL", $data["comprobanteURL"]);

            return $sql->execute(); // Retorna true o false
        } catch (Exception $e) {
            // Manejo de errores (opcional)
            return false;
        }
    }

    protected function updateCombustibleModel($data) {
        try {
            $sql = mainModel::conect()->prepare("UPDATE tcombustible SET name = :name, idChoferes = :idChoferes, idVehiculos = :idVehiculos, kilometraje = :kilometraje, cantidad = :cantidad, monto = :monto, tipoCombustible = :tipoCombustible, estacionServicio = :estacionServicio, comprobanteURL = :comprobanteURL WHERE idCombustible = :idCombustible");
            $sql->bindParam(":idCombustible", $data["idCombustible"]);
            $sql->bindParam(":name", $data["name"]);        
            $sql->bindParam(":idChoferes", $data["idChoferes"]);
            $sql->bindParam(":idVehiculos", $data["idVehiculos"]);
            $sql->bindParam(":kilometraje", $data["kilometraje"]);
            $sql->bindParam(":cantidad", $data["cantidad"]);
            $sql->bindParam(":monto", $data["monto"]);
            $sql->bindParam(":tipoCombustible", $data["tipoCombustible"]);
            $sql->bindParam(":estacionServicio", $data["estacionServicio"]);
            $sql->bindParam(":comprobanteURL", $data["comprobanteURL"]);

            return $sql->execute(); // Retorna true o false
        } catch (Exception $e) {
            // Manejo de errores (opcional)
            return false;
        }
    }
}
