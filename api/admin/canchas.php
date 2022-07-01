<?php

require_once '../helpers/database.php';
require_once '../helpers/validator.php';
require_once '../models/canchas.php';

if (isset($_GET['action'])) {

    session_start();

    $cancha = new Cancha;

    $result = array('status' => 0, 'message' => null, 'exception' => null);

    if (isset($_SESSION['id_cancha'])) {

        switch ($_GET['action']) {
            case 'readAll':
                if ($result['dataset'] = $cancha->readAll()) {
                    $result['status'] = 1;
                } else if (Database::getException()) {
                    $result['exception'] = Database::getException();
                } else {
                    $result['exception'] = 'No hay datos registrados';
                }
                break;

            case 'search':
                $_POST = $cancha->validateForm($_POST);
                if ($_POST['search'] == '') {
                    $result['exception'] = 'Ingrese un dato para buscar';
                } elseif ($result['dataset'] = $cancha->searchLines($_POST['search'])) {
                    $result['dataset'] = 1;
                    $result['message'] = 'datos encontrados';
                } elseif (Database::getException()) {
                    $result['exception'] = Database::getException();
                } else {
                    $result['exception'] = 'No hay ningún parecido';
                }
                break;

            case 'create':
                $_POST = $cancha->validateFor($_POST);
                if (!$cancha->setNumero($_POST['numero_cancha'])) {
                    $result['exception'] = 'numero invalido';
                } elseif (!$cancha->setTamano($_POST['tamano_cancha'])) {
                    $result['exception'] = 'tamaño invalido';
                } elseif (!$cancha->setMaterial($_POST['material_cancha'])) {
                    $result['exception'] = 'tipo de material incorrecto';
                } elseif (!$cancha->setCosto($_POST['costo_cancha'])) {
                    $result['exception'] = 'precio inexistente';
                } else {
                    $result['exception'] = Database::getException();
                }
                break;

            case 'update':
                $_POST = $cancha->validateForm($_POST);
                if (!$cancha->setId($_POST['id_cancha'])) {
                    $result['exception'] = 'Registro  de cancha inexistente';
                } elseif (!$data = $cancha->readLine()) {
                    $result['exception'] = 'Registro de cancha inexistente';
                } elseif (!$cancha->setTamano($_POST['tamano_cancha'])) {
                    $result['exception'] = 'El tamaño de la cancha es invalido';
                } elseif (!$cancha->setMaterial($_POST['material_cancha'])) {
                    $result['exception'] = 'el tipo de material es invalido';
                } elseif (!$cancha->setCosto($_POST['costo_cancha'])) {
                    $result['exception'] = 'precio inexistente';
                } else {
                    $result['exception'] = Database::getException();
                }
                break;

            default:
                $result['exception'] = 'Acción no disponible dentro de la sesión';
                break;

        }
    }

} else {
    print(json_encode('Recurso no disponible'));
}

?>