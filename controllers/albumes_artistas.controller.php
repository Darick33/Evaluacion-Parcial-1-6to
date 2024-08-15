<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
$method = $_SERVER["REQUEST_METHOD"];
if ($method == "OPTIONS") {
    die();
}

require_once('../models/albumes_artistas.model.php');
error_reporting(0);
$AlbumArtista = new AlbumArtista();

switch ($_GET["op"]) {
    case 'todos':
        $datos = array();
        $datos = $AlbumArtista->todos();

        while ($row = mysqli_fetch_assoc($datos)) 
        {
            $todos[] = $row;
        }
        echo json_encode($todos);
        break;

    case 'uno':
        $id_albumes_artistas = $_POST["id_albumes_artistas"];
        $datos = $AlbumArtista->uno($id_albumes_artistas);
        $res = mysqli_fetch_assoc($datos);
        echo json_encode($res);
        break;

    case 'insertar':
        $album_id = $_POST["album_id"];
        $artista_id = $_POST["artista_id"];
        
        $datos = $AlbumArtista->insertar($album_id, $artista_id);
        echo json_encode($datos);
        break;

    case 'actualizar':
        $id_albumes_artistas = $_POST["id_albumes_artistas"];
        $album_id = $_POST["album_id"];
        $artista_id = $_POST["artista_id"];
        
        $result = $AlbumArtista->actualizar($id_albumes_artistas, $album_id, $artista_id);
        echo json_encode($result);
        break;

    case 'eliminar':
        $id_albumes_artistas = $_POST["id_albumes_artistas"];
        $datos = $AlbumArtista->eliminar($id_albumes_artistas);
        echo json_encode($datos);
        break;
}
?>
