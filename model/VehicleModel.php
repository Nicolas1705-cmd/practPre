<?php 

if ($peticionAjax) {
    require_once "../model/mainModel.php";
} else {
    require_once "./model/mainModel.php";
}

class VehicleModel extends mainModel
{
    protected function saveVehicleModel($data) {
        try {
            $sql = mainModel::conect()->prepare("INSERT INTO tvehicle(nserie, plate, nVin, nEngine, color, currentPlate, previousPlate, annotations, owner, estado, modelYear, idDepa, idVehicleBrand, idVehicleModel, idPersonal) VALUES (:nserie, :plate, :nVin, :nEngine, :color, :currentPlate, :previousPlate, :annotations, :owner, :estado, :modelYear, :idDepa, :idVehicleBrand, :idVehicleModel, :idPersonal)");
            $sql->bindParam(":nserie", $data["nserie"]);
            $sql->bindParam(":plate", $data["plate"]);
            $sql->bindParam(":nVin", $data["nVin"]);
            $sql->bindParam(":nEngine", $data["nEngine"]);
            $sql->bindParam(":color", $data["color"]);
            $sql->bindParam(":currentPlate", $data["currentPlate"]);
            $sql->bindParam(":previousPlate", $data["previousPlate"]);
            $sql->bindParam(":annotations", $data["annotations"]);
            $sql->bindParam(":owner", $data["owner"]);
            $sql->bindParam(":estado", $data["estado"]);
            $sql->bindParam(":modelYear", $data["modelYear"]);
            $sql->bindParam(":idDepa", $data["idDepa"]);
            $sql->bindParam(":idVehicleBrand", $data["idVehicleBrand"]);
            $sql->bindParam(":idVehicleModel", $data["idVehicleModel"]);
            $sql->bindParam(":idPersonal", $data["idPersonal"]);
            return $sql->execute(); // Retorna true o false
        } catch (Exception $e) {
            // Manejo de errores (opcional)
            return false;
        }
    }

    protected function updateVehicleModel($data) {
        try {
            $sql = mainModel::conect()->prepare("UPDATE tvehicle SET nserie = :nserie, plate = :plate, nVin = :nVin, nEngine = :nEngine, color = :color, currentPlate = :currentPlate, previousPlate = :previousPlate, annotations = :annotations, owner = :owner, estado = :estado, modelYear = :modelYear, idDepa = :idDepa, idVehicleBrand = :idVehicleBrand, idVehicleModel = :idVehicleModel, idPersonal = :idPersonal WHERE idVehicle = :idVehicle");
            $sql->bindParam(":idVehicle", $data["idVehicle"]);
            $sql->bindParam(":nserie", $data["nserie"]);           
            $sql->bindParam(":plate", $data["plate"]);
            $sql->bindParam(":nVin", $data["nVin"]);
            $sql->bindParam(":nEngine", $data["nEngine"]);
            $sql->bindParam(":color", $data["color"]);
            $sql->bindParam(":currentPlate", $data["currentPlate"]);
            $sql->bindParam(":previousPlate", $data["previousPlate"]);
            $sql->bindParam(":annotations", $data["annotations"]);
            $sql->bindParam(":owner", $data["owner"]);
            $sql->bindParam(":estado", $data["estado"]);
            $sql->bindParam(":modelYear", $data["modelYear"]);
            $sql->bindParam(":idDepa", $data["idDepa"]);
            $sql->bindParam(":idVehicleBrand", $data["idVehicleBrand"]);
            $sql->bindParam(":idVehicleModel", $data["idVehicleModel"]);
            $sql->bindParam(":idPersonal", $data["idPersonal"]);
            return $sql->execute(); // Retorna true o false
        } catch (Exception $e) {
            // Manejo de errores (opcional)
            return false;
        }
    }
}