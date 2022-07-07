<?php
require_once('../helpers/database.php');
require_once('../helpers/validator.php');
require_once('../models/chaleco.php');

// Se comprueba si existe una acción a realizar, de lo contrario se finaliza el script con un mensaje de error.
if (isset($_GET['action'])) {
    // Se crea una sesión o se reanuda la actual para poder utilizar variables de sesión en el script.
    session_start();
    // Se instancia la clase correspondiente.
    $chalecos = new Chalecos;
    // Se declara e inicializa un arreglo para guardar el resultado que retorna la API.
    $result = array('status' => 0, 'message' => null, 'exception' => null);
    // Se verifica si existe una sesión iniciada como administrador, de lo contrario se finaliza el script con un mensaje de error.
    if (isset($_SESSION['id_empleado'])) {
        // Se compara la acción a realizar cuando un administrador ha iniciado sesión.
        switch ($_GET['action']) {
            case 'readAll':
                if ($result['dataset'] =  $chalecos->readAll()) {
                    $result['status'] = 1;                    
                } elseif (Database::getException()) {
                    $result['exception'] = Database::getException();
                } else {
                    $result['exception'] = 'No hay datos registrados';
                }
                break;
            case 'search':
                $_POST =  $chalecos->validateForm($_POST);
                if ($_POST['buscar'] == '') {
                    if ($result['dataset'] =  $chalecos->readAll()) {
                        $result['status'] = 1;
                    } elseif (Database::getException()) {
                        $result['exception'] = Database::getException();
                    } else {
                        $result['exception'] = 'No hay datos registrados';
                    }
                } elseif ($result['dataset'] =  $chalecos->searchRows($_POST['buscar'])) {
                    $result['status'] = 1;
                    $result['message'] = 'Valor encontrado';
                } elseif (Database::getException()) {
                    $result['exception'] = Database::getException();
                } else {
                    $result['exception'] = 'No hay coincidencias';
                }
                break;
            case 'create':
                $_POST =  $chalecos->validateForm($_POST);
                if (!$chalecos->setCosto($_POST['costo'])) {
                    $result['exception'] = 'Costo no aceptado';                
                }elseif (!$chalecos->setCantidad($_POST['cantidad'])) {
                    $result['exception'] = 'Cantidad no aceptada';                
                } elseif (!isset($_POST['color'])) {
                    $result['exception'] = 'Seleccione el color para el chaleco';
                } elseif (!$chalecos->setColor($_POST['color'])) {
                    $result['exception'] = 'Color incorrecto';    
                } elseif (!isset($_POST['talla'])) {
                    $result['exception'] = 'Seleccione la talla del chaleco';
                } elseif (!$chalecos->setTalla($_POST['talla'])) {
                    $result['exception'] = 'Talla incorrecta';    
                } elseif ( $chalecos->createRow()) {
                    $result['status'] = 1;
                    $result['message'] = 'Chaleco registrado correctamente';                    
                } else {
                    $result['exception'] = Database::getException();
                }
                break;
            case 'readOne':
                if (!$chalecos->setId($_POST['id_chaleco'])) {
                    $result['exception'] = 'El chaleco no existe';
                } elseif ($result['dataset'] = $chalecos->readOne()) {
                    $result['status'] = 1;
                } elseif (Database::getException()) {
                    $result['exception'] = Database::getException();
                } else {
                    $result['exception'] = 'Chaleco inexistente';
                }
                break;
            case 'update':
                $_POST =  $chalecos->validateForm($_POST);
                if (! $chalecos->setId($_POST['id'])) {
                    $result['exception'] = 'Chaleco incorrecto';
                } elseif (!$data =  $chalecos->readOne()) {
                    $result['exception'] = 'Chaleco inexistente';
                } elseif (!$chalecos->setCosto($_POST['costo'])) {
                    $result['exception'] = 'Costo no aceptado';                
                }elseif (!$chalecos->setCantidad($_POST['cantidad'])) {
                    $result['exception'] = 'Cantidad no aceptada';                
                } elseif (!isset($_POST['color'])) {
                    $result['exception'] = 'Seleccione el color para el chaleco';
                } elseif (!$chalecos->setColor($_POST['color'])) {
                    $result['exception'] = 'Color incorrecto';    
                } elseif (!isset($_POST['talla'])) {
                    $result['exception'] = 'Seleccione la talla del chaleco';
                } elseif (!$chalecos->setTalla($_POST['talla'])) {
                    $result['exception'] = 'Talla incorrecta';    
                } elseif ( $chalecos->updateRow()) {
                        $result['status'] = 1;
                        $result['message'] = 'Cargo empleado modificado correctamente';
                } else {
                    $result['exception'] = Database::getException();
                }
                break;
            case 'delete':
                if (! $chalecos->setId($_POST['id_chaleco'])) {
                    $result['exception'] = 'Chaleco incorrecto';
                } elseif (!$data =  $chalecos->readOne()) {
                    $result['exception'] = 'Chaleco inexistente';
                } elseif ( $chalecos->deleteRow()) {
                    $result['status'] = 1;
                    $result['message'] = 'Chaleco eliminado correctamente';                    
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