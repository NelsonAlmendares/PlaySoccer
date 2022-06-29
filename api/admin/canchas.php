<?php

require_once '../helpers/database.php';
require_once '../helpers/validator.php';
require_once '../models/canchas.php';

//comprobamos si existen acciones por realizar

if (isset($_GET['action'])) {
    //comprobamos si existen sesiones por realizar
    session_start();
    // Instancia correspondiente
    $cancha = new Canchas;
    //Inicializamos el arreglos para guardar el resultado de la API
    $result = array('status' => 0, 'session' => 0, 'message' => null, 'exception' => null, 'dataset' => null, 'codigo' => null);

    if (isset($_SESSION['id_cancha'])) {
        $result['session'] = 1;
        switch ($_GET['action']) {

            //Caso para obtener el numero de la cancha
            case 'getNumero':
                if (isset($_SESSION['codigo_cancha'])) {
                    $result['status'] = 1;
                    $result['codigo'] = $_SESSION['codigo_cancha'];
                    $result['numero'] = $_SESSION['numero_cancha'];
                    $result['tamamo'] = $_SESSION['tamamo_cancha'];
                    $result['material'] = $_SESSION['material_cancha'];
                } else {
                    $result['exception'] = 'No existe ningún registro con esta numeración';
                }
                break;

            // Caso para leer los datos del registro

            case 'readLog':
                if ('') {

                } else {

                }
                break;

            // Caso para editar el registro

            case 'editLog':
                if ('') {

                } else {

                }
                break;

            // Caso para leer todos los datos del registro

            case 'readAll':
                if ($result['dataset'] = $cancha->readAll()) {
                    $result['status'] = 1;
                } elseif (Database::getException()) {
                    $result['exception'] = Database::getException();
                } else {
                    $result['exception'] = 'No hay datos registrados';
                }
                break;

            // Caso para buscar una cancha

            case 'search':
                

            // caso para agregar una cancha

            case 'addCourt':
                $_POST = $cancha->validateForm($_POST);
                if (!$cancha->setNumero($_POST['numero'])) {
                    $result['exception'] = 'Asigne un número valido';
                } elseif (!$cancha->setTamano($_POST['tamano'])) {
                    $result['exception'] = 'Formato incorrecto';
                } elseif (!$cancha->setMaterial($_POST['material'])) {
                    $result['exception'] = 'El tipo de material es invalido';
                } elseif (!$cancha->setCosto($_POST['costo'])) {
                    $result['exception'] = 'Formato incorrecto';
                } elseif ($cancha->createLine()) {
                    $result['status'] = 1;
                    $result['message'] = 'La cancha ha sido agregada exitosamente';
                } elseif (Database::getException()) {
                    $result ['exception'] = Database::getException();
                } else {
                    $result ['exception'] = 'La cancha no se agrego correctamente';
                }
            break;

            // Caso para leer un dato de la cancha

            case 'readLines':
                if(!$cancha-setId($_POST['id'])) {
                    $result['exception'] = 'Cancha incorrecto';
                } elseif($result['dataset'] = $cancha->readLines()) {
                    $result['status'] = 1;
                } elseif(Database::getException()) {
                    $result['Exception'] = Database::getException();
                } else {
                    $result['exception'] = 'Registro inexistente';
                }
            break;

            }
        }
    }
}

?>