<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
$method = $_SERVER["REQUEST_METHOD"];
if ($method == "OPTIONS") {
    die();
}

require_once('../models/albun.model.php');
error_reporting(0);
$Albunes = new Albun();

switch ($_GET["op"]) {
    case 'todos':
        $datos = array();
        $datos = $Albunes->todos();

        while ($row = mysqli_fetch_assoc($datos)) 
        {
            $todos[] = $row;
        }
        echo json_encode($todos);
        break;

    case 'uno':
        $album_id = $_POST["album_id"];
            $datos = $Albunes->uno($album_id);
            $res = mysqli_fetch_assoc($datos);
            echo json_encode($res);
            break;

    case 'insertar':
        $titulo = $_POST["titulo"];
        $genero = $_POST["genero"];
        $año_lanzamiento = $_POST["año_lanzamiento"];
        $discografica = $_POST["discografica"];
        $artista_id = $_POST["artista_id"];
        
        $datos = $Albunes->insertar($titulo, $genero, $año_lanzamiento, $discografica, $artista_id);
        echo json_encode($datos);
        break;

    case 'actualizar':
        $album_id = $_POST["album_id"];
        $titulo = $_POST["titulo"];
        $genero = $_POST["genero"];
        $año_lanzamiento = $_POST["año_lanzamiento"];
        $discografica = $_POST["discografica"];
        $artista_id = $_POST["artista_id"];
        
        $result = $Albunes->actualizar($album_id, $titulo, $genero, $año_lanzamiento, $discografica, $artista_id);
        echo json_encode($result);
        break;

    case 'eliminar':
        $album_id = $_POST["album_id"];
        $datos = $Albunes->eliminar($album_id);
        echo json_encode($datos);
        break;
}
?>
