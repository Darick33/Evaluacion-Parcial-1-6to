<?php
require_once('../config/config.php');

class AlbumArtista {
    public function todos() {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $cadena = "SELECT * FROM `albumes_artistas`";
        $datos = mysqli_query($con, $cadena);

        $con->close();
        
        return $datos;
    }

    public function uno($id_albumes_artistas) {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $cadena = "SELECT * FROM `albumes_artistas` WHERE `id_albumes_artistas` = $id_albumes_artistas";
        $datos = mysqli_query($con, $cadena);

        $con->close();
        
        return $datos;
    }

    public function insertar($album_id, $artista_id) {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $stmt = $con->prepare("INSERT INTO `albumes_artistas` (`album_id`, `artista_id`) VALUES (?, ?)");
            $stmt->bind_param("ii", $album_id, $artista_id);
            
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

    public function actualizar($id_albumes_artistas, $album_id, $artista_id) {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $stmt = $con->prepare("UPDATE `albumes_artistas` SET `album_id` = ?, `artista_id` = ? WHERE `id_albumes_artistas` = ?");
            $stmt->bind_param("iii", $album_id, $artista_id, $id_albumes_artistas);
            
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

    public function eliminar($id_albumes_artistas) {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "DELETE FROM `albumes_artistas` WHERE `id_albumes_artistas` = $id_albumes_artistas";
            if (mysqli_query($con, $cadena)) {
                return "eliminado";
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
