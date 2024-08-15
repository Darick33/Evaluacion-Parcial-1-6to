<?php
require_once('../config/config.php');

class Albun {
    public function todos() {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $cadena = "SELECT * FROM `albunes`";
        $datos = mysqli_query($con, $cadena);

        $con->close();
        
        return $datos;
    }

    public function uno($album_id) {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $cadena = "SELECT * FROM `albunes` WHERE `album_id` = $album_id";
        $datos = mysqli_query($con, $cadena);

        $con->close();
        
        return $datos;
    }

    public function insertar($titulo, $genero, $año_lanzamiento, $discografica, $artista_id) {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $stmt = $con->prepare("INSERT INTO `albunes` (`titulo`, `genero`, `año_lanzamiento`, `discografica`, `artista_id`) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $titulo, $genero, $año_lanzamiento, $discografica, $artista_id);
            
            if ($stmt->execute()) {
                return  "insertado";

            } else {
                return $stmt->error;
            }
        } catch (Exception $th) {
            return $th->getMessage(); 
        } finally {
                $con->close(); 
        }
    }

    public function actualizar($album_id, $titulo, $genero, $año_lanzamiento, $discografica, $artista_id) {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $stmt = $con->prepare("UPDATE `albunes` SET `titulo` = ?, `genero` = ?, `año_lanzamiento` = ?, `discografica` = ?, `artista_id` = ? WHERE `album_id` = ?");
            $stmt->bind_param("sssssi", $titulo, $genero, $año_lanzamiento, $discografica, $artista_id, $album_id);
            
            if ($stmt->execute()) {
                return "actualizado";
            } else {
                return $stmt->error;
            }
        } catch (Exception $th) {
            return $th->getMessage(); 
        } finally {
                $con->close(); 
        }
    }

    public function eliminar($album_id) {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "DELETE FROM `albunes` WHERE `album_id` = $album_id";
            if (mysqli_query($con, $cadena)) {
                return "Eliminado";

            } else {
                return $con->error;
            }
        } catch (Exception $th) {
            return $th->getMessage();
        } finally {
            $con->close();
        }
    }
}
?>
