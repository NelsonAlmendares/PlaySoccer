<?php
require_once('../helpers/database.php');
require_once('../helpers/validator.php');
require_once('../models/tipoHorario.php');

// Se comprueba si existe una acción a realizar, de lo contrario se finaliza el script con un mensaje de error.
if (isset($_GET['action'])) {
    // Se crea una sesión o se reanuda la actual para poder utilizar variables de sesión en el script.
    session_start();
    // Se instancia la clase correspondiente.
    $tipo_horario = new Thorario;
    // Se declara e inicializa un arreglo para guardar el resultado que retorna la API.
    $result = array('status' => 0, 'message' => null, 'exception' => null);
    // Se verifica si existe una sesión iniciada como administrador, de lo contrario se finaliza el script con un mensaje de error.
    if (isset($_SESSION['id_empleado'])) {
        // Se compara la acción a realizar cuando un administrador ha iniciado sesión.
        switch ($_GET['action']) {
            case 'readAll':
                if ($result['dataset'] =  $tipo_horario->readAll()) {
                    $result['status'] = 1;
                } elseif (Database::getException()) {
                    $result['exception'] = Database::getException();
                } else {
                    $result['exception'] = 'No hay datos registrados';
                }
                break;
            case 'search':
                $_POST =  $tipo_horario->validateForm($_POST);
                if ($_POST['buscar'] == '') {
                    if ($result['dataset'] =  $tipo_horario->readAll()) {
                        $result['status'] = 1;
                    } elseif (Database::getException()) {
                        $result['exception'] = Database::getException();
                    } else {
                        $result['exception'] = 'No hay datos registrados';
                    }
                } elseif ($result['dataset'] =  $tipo_horario->searchRows($_POST['buscar'])) {
                    $result['status'] = 1;
                    $result['message'] = 'Valor encontrado';
                } elseif (Database::getException()) {
                    $result['exception'] = Database::getException();
                } else {
                    $result['exception'] = 'No hay coincidencias';
                }
                break;
            case 'create':
                $_POST =  $tipo_horario->validateForm($_POST);
                if (! $tipo_horario->setTipo($_POST['descripcion'])) {
                    $result['exception'] = 'Tipo horario no aceptado';                
                } elseif ( $tipo_horario->createRow()) {
                    $result['status'] = 1;
                    $result['message'] = 'Tipo horario creado correctamente';                    
                } else {
                    $result['exception'] = Database::getException();
                }
                break;
            case 'readOne':
                if (!$tipo_horario->setId($_POST['id_tipohorario'])) {
                    $result['exception'] = 'Tipo horario incorrecto';
                } elseif ($result['dataset'] =  $tipo_horario->readOne()) {
                    $result['status'] = 1;
                } elseif (Database::getException()) {
                    $result['exception'] = Database::getException();
                } else {
                    $result['exception'] = 'Tipo horario inexistente';
                }
                break;
            case 'update':
                $_POST =  $tipo_horario->validateForm($_POST);
                if (! $tipo_horario->setId($_POST['id'])) {
                    $result['exception'] = 'Tipo horario incorrecto';
                } elseif (!$data =  $tipo_horario->readOne()) {
                    $result['exception'] = 'Tipo horario inexistente';
                } elseif (! $tipo_horario->setTipo($_POST['descripcion'])) {
                    $result['exception'] = 'Tipo horario no aceptado';                
                } elseif ( $tipo_horario->updateRow()) {
                        $result['status'] = 1;
                        $result['message'] = 'Tipo horario modificado correctamente';
                } else {
                    $result['exception'] = Database::getException();
                }
                break;
            case 'delete':
                if (! $tipo_horario->setId($_POST['id_tipohorario'])) {
                    $result['exception'] = 'Tipo horario incorrecto';
                } elseif (!$data =  $tipo_horario->readOne()) {
                    $result['exception'] = 'Tipo horario inexistente';
                } elseif ( $tipo_horario->deleteRow()) {
                    $result['status'] = 1;
                    $result['message'] = 'Tipo horario eliminado correctamente';                    
                } else {
                    $result['exception'] = Database::getException();
                }
                break;
            default:
                $result['exception'] = 'Acción no disponible dentro de la sesión';
        }
        // Se indica el tipo de contenido a mostrar y su respectivo conjunto de caracteres.
        header('content-type: application/json; charset=utf-8');
        // Se imprime el resultado en formato JSON y se retorna al controlador.
        print(json_encode($result));
    } else {
        print(json_encode('Acceso denegado'));
    }
} else {
    print(json_encode('Recurso no disponible'));
}