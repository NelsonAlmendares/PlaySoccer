<?php
require_once('../helpers/database.php');
require_once('../helpers/validator.php');
require_once('../models/canchas.php');

// Se comprueba si existe una acción a realizar, de lo contrario se finaliza el script con un mensaje de error.
if (isset($_GET['action'])) {
    // Se crea una sesión o se reanuda la actual para poder utilizar variables de sesión en el script.
    session_start();
    // Se instancia la clase correspondiente.
    $canchas = new Canchas;
    // Se declara e inicializa un arreglo para guardar el resultado que retorna la API.
    $result = array('status' => 0, 'message' => null, 'exception' => null);
    // Se verifica si existe una sesión iniciada como administrador, de lo contrario se finaliza el script con un mensaje de error.
    if (isset($_SESSION['id_empleado'])) {
        // Se compara la acción a realizar cuando un administrador ha iniciado sesión.
        switch ($_GET['action']) {
            case 'readAll':
                if ($result['dataset'] =  $canchas->readAll()) {
                    $result['status'] = 1;
                } elseif (Database::getException()) {
                    $result['exception'] = Database::getException();
                } else {
                    $result['exception'] = 'No hay canchas registradas';
                }
                break;
            case 'search':
                $_POST =  $canchas->validateForm($_POST);
                if ($_POST['buscar'] == '') {
                    if ($result['dataset'] =  $canchas->readAll()) {
                        $result['status'] = 1;
                    } elseif (Database::getException()) {
                        $result['exception'] = Database::getException();
                    } else {
                        $result['exception'] = 'No existen canchas registradas';
                    }
                } elseif ($result['dataset'] =  $canchas->searchRows($_POST['buscar'])) {
                    $result['status'] = 1;
                    $result['message'] = 'Valor encontrado';
                } elseif (Database::getException()) {
                    $result['exception'] = Database::getException();
                } else {
                    $result['exception'] = 'No hay coincidencias';
                }
                break;
            case 'create':
                $_POST =  $canchas->validateForm($_POST);                
                if (!$canchas->setNumero($_POST['EnumCancha'])) {
                    $result['exception'] = 'valor incorrecto';                
                }elseif (!$canchas->setTamano($_POST['TamañoCancha'])) {
                    $result['exception'] = 'tamaño de cancha no valido';                
                }elseif (!$canchas->setMaterial($_POST['MaterialCancha'])) {
                    $result['exception'] = 'tipo de material de cancha no valido';                 
                }elseif (!$canchas->setCosto($_POST['costo'])) {
                    $result['exception'] = 'valor monetario de cancha no valido';                 
                } elseif ($canchas->createRow()) {
                    $result['status'] = 1;
                    $result['message'] = 'La cancha se ha registrado exitosamente';                    
                } else {
                    $result['exception'] = Database::getException();
                }
                break;
            case 'readOne':
                if (!$canchas->setId($_POST['id_cancha'])) {
                    $result['exception'] = 'Identificación de cancha desconocida';
                } elseif ($result['dataset'] =  $canchas->readOne()) {
                    $result['status'] = 1;
                } elseif (Database::getException()) {
                    $result['exception'] = Database::getException();
                } else {
                    $result['exception'] = 'El registro que ha solicitado no existe';
                }
                break;
                case 'update':
                    $_POST = $canchas->validateForm($_POST);
                    if (!$canchas->setId($_POST['id'])) {
                        $result['exception'] = 'Cancha incorrecto';
                    } elseif (!$data = $canchas->readOne()) {
                    $result['exception'] = 'Cancha inexistente';
                    }elseif (!$canchas->setNumero($_POST['EnumCancha'])) {
                        $result['exception'] = 'valor incorrecto';                
                    }elseif (!$canchas->setTamano($_POST['TamañoCancha'])) {
                        $result['exception'] = 'tamaño de cancha no valido';                
                    }elseif (!$canchas->setMaterial($_POST['MaterialCancha'])) {
                        $result['exception'] = 'tipo de material de cancha no valido';                 
                    }elseif (!$canchas->setCosto($_POST['costo'])) {
                        $result['exception'] = 'valor monetario de cancha no valido';                 
                    } elseif ($canchas->updateRow()) {
                        $result['status'] = 1;
                        $result['message'] = 'La cancha se ha modificado exitosamente';                    
                    } else {
                        $result['exception'] = Database::getException();
                    }
                    break;
            case 'delete':
                if (!$canchas->setId($_POST['id_cancha'])) {
                    $result['exception'] = 'Identificacion de cancha desconocida';
                } elseif (!$data =  $canchas->readOne()) {
                    $result['exception'] = 'Registro inexistente';
                } elseif ($canchas->deleteRow()) {
                    $result['status'] = 1;
                    $result['message'] = 'Registro de cancha eliminada correctamente';                    
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