<?php

if ($peticionAjax) {
    require_once "../model/mainModel.php";
} else {
    require_once "./model/mainModel.php";
}

class CorreoModel extends mainModel
{
    protected function saveCorreoModel($data) {
        try {
            $sql = mainModel::conect()->prepare("INSERT INTO tcorreo(name, email, addressee, description, image) VALUES (:name, :email, :addressee, :description, :image)");
            $sql->bindParam(":name", $data["name"]);
            $sql->bindParam(":email", $data["email"]);
            $sql->bindParam(":addressee", $data["addressee"]);
            $sql->bindParam(":description", $data["description"]);
            $sql->bindParam(":image", $data["image"]);
            return $sql->execute(); // Retorna true o false
        } catch (PDOException $e) {
            // Manejo de errores PDO
            error_log("Error PDO en saveCorreoModel: " . $e->getMessage());
            return false;
        } catch (Exception $e) {
            // Manejo de otros errores
            error_log("Error general en saveCorreoModel: " . $e->getMessage());
            return false;
        }
    }

    protected function updateCorreoModel($data) {
        try {
            $sql = mainModel::conect()->prepare("UPDATE tcorreo SET name = :name, email = :email, addressee = :addressee, description = :description, image = :image WHERE idCorreo = :idCorreo");
            $sql->bindParam(":idCorreo", $data["idCorreo"]);
            $sql->bindParam(":name", $data["name"]);
            $sql->bindParam(":email", $data["email"]);
            $sql->bindParam(":addressee", $data["addressee"]);
            $sql->bindParam(":description", $data["description"]);
            $sql->bindParam(":image", $data["image"]);
            return $sql->execute(); // Retorna true o false
        } catch (PDOException $e) {
            error_log("Error PDO en updateCorreoModel: " . $e->getMessage());
            return false;
        } catch (Exception $e) {
            error_log("Error general en updateCorreoModel: " . $e->getMessage());
            return false;
        }
    }
}