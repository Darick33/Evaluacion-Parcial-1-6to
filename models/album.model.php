<?php
require_once('../config/config.php');

class Album {
    public function todos() {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $cadena = "SELECT * FROM `albumes`";
        $datos = mysqli_query($con, $cadena);

        $con->close();
        
        return $datos;
    }

    public function uno($album_id) {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $cadena = "SELECT * FROM `albumes` WHERE `album_id` = $album_id";
        $datos = mysqli_query($con, $cadena);

        $con->close();
        
        return $datos;
    }

    public function insertar($titulo, $genero, $año_lanzamiento, $discografica) {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $stmt = $con->prepare("INSERT INTO `albumes` (`titulo`, `genero`, `año_lanzamiento`, `discografica`) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $titulo, $genero, $año_lanzamiento, $discografica);
            
            if ($stmt->execute()) {
                return "insertado";
            } else {
                return $stmt->error;
            }
        } catch (Exception $th) {
            return $th->getMessage(); 
        } finally {
            $con->close(); 
        }
    }

    public function actualizar($album_id, $titulo, $genero, $año_lanzamiento, $discografica, ) {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $stmt = $con->prepare("UPDATE `albumes` SET `titulo` = ?, `genero` = ?, `año_lanzamiento` = ?, `discografica` = ? WHERE `album_id` = ?");
            $stmt->bind_param("ssssi", $titulo, $genero, $año_lanzamiento, $discografica , $album_id);
            
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
            $cadena = "DELETE FROM `albumes` WHERE `album_id` = $album_id";
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
