 <?php
require_once('../helpers/database.php');
require_once('../helpers/validator.php');
require_once('../models/tallaChaleco.php');

// Se comprueba si existe una acción a realizar, de lo contrario se finaliza el script con un mensaje de error.
if (isset($_GET['action'])) {
    // Se crea una sesión o se reanuda la actual para poder utilizar variables de sesión en el script.
    session_start();
    // Se instancia la clase correspondiente.
    $talla_chaleco = new Talla;
    // Se declara e inicializa un arreglo para guardar el resultado que retorna la API.
    $result = array('status' => 0, 'message' => null, 'exception' => null);
    // Se verifica si existe una sesión iniciada como administrador, de lo contrario se finaliza el script con un mensaje de error.
    if (isset($_SESSION['id_empleado'])) {
        // Se compara la acción a realizar cuando un administrador ha iniciado sesión.
        switch ($_GET['action']) {
            case 'readAll':
                if ($result['dataset'] =  $talla_chaleco->readAll()) {
                    $result['status'] = 1;
                } elseif (Database::getException()) {
                    $result['exception'] = Database::getException();
                } else {
                    $result['exception'] = 'No hay tallas de chalecos registradas';
                }
                break;
            case 'search':
                $_POST =  $talla_chaleco->validateForm($_POST);
                if ($_POST['buscar'] == '') {
                    if ($result['dataset'] =  $talla_chaleco->readAll()) {
                        $result['status'] = 1;
                    } elseif (Database::getException()) {
                        $result['exception'] = Database::getException();
                    } else {
                        $result['exception'] = 'No hay tallas de chalecos registradas';
                    }
                } elseif ($result['dataset'] =  $talla_chaleco->searchRows($_POST['buscar'])) {
                    $result['status'] = 1;
                    $result['message'] = 'Valor encontrado';
                } elseif (Database::getException()) {
                    $result['exception'] = Database::getException();
                } else {
                    $result['exception'] = 'No hay coincidencias';
                }
                break;
            case 'create':
                $_POST =  $talla_chaleco->validateForm($_POST);
                if (! $talla_chaleco->setTalla($_POST['descripcion'])) {
                    $result['exception'] = 'Talla de chaleco no aceptada';                
                } elseif ( $talla_chaleco->createRow()) {
                    $result['status'] = 1;
                    $result['message'] = 'Talla de chaleco agregada correctamente';                    
                } else {
                    $result['exception'] = Database::getException();
                }
                break;
            case 'readOne':
                if (!$talla_chaleco->setId($_POST['id_talla'])) {
                    $result['exception'] = 'Talla de chaleco incorrecta';
                } elseif ($result['dataset'] =  $talla_chaleco->readOne()) {
                    $result['status'] = 1;
                } elseif (Database::getException()) {
                    $result['exception'] = Database::getException();
                } else {
                    $result['exception'] = 'Talla de chaleco inexistente';
                }
                break;
            case 'update':
                $_POST =  $talla_chaleco->validateForm($_POST);
                if (! $talla_chaleco->setId($_POST['id'])) {
                    $result['exception'] = 'Talla de chalecos incorrecto';
                } elseif (!$data =  $talla_chaleco->readOne()) {
                    $result['exception'] = 'Talla de chalecos inexistente';
                } elseif (! $talla_chaleco->setTalla($_POST['descripcion'])) {
                    $result['exception'] = 'Talla de chalecos no aceptada';                
                } elseif ( $talla_chaleco->updateRow()) {
                        $result['status'] = 1;
                        $result['message'] = 'Talla de chalecos modificada correctamente';
                } else {
                    $result['exception'] = Database::getException();
                }
                break;
            case 'delete':
                if (! $talla_chaleco->setId($_POST['id_talla'])) {
                    $result['exception'] = 'Talla de chaleco incorrecta';
                } elseif (!$data =  $talla_chaleco->readOne()) {
                    $result['exception'] = 'Talla de chaleco inexistente';
                } elseif ( $talla_chaleco->deleteRow()) {
                    $result['status'] = 1;
                    $result['message'] = 'Talla de chaleco eliminado correctamente';                    
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