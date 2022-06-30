 <?php
require_once('../helpers/database.php');
require_once('../helpers/validator.php');
require_once('../models/tamanoBalon.php');

// Se comprueba si existe una acción a realizar, de lo contrario se finaliza el script con un mensaje de error.
if (isset($_GET['action'])) {
    // Se crea una sesión o se reanuda la actual para poder utilizar variables de sesión en el script.
    session_start();
    // Se instancia la clase correspondiente.
    $tamano_balon = new Tamano;
    // Se declara e inicializa un arreglo para guardar el resultado que retorna la API.
    $result = array('status' => 0, 'message' => null, 'exception' => null);
    // Se verifica si existe una sesión iniciada como administrador, de lo contrario se finaliza el script con un mensaje de error.
    if (isset($_SESSION['id_empleado'])) {
        // Se compara la acción a realizar cuando un administrador ha iniciado sesión.
        switch ($_GET['action']) {
            case 'readAll':
                if ($result['dataset'] =  $tamano_balon->readAll()) {
                    $result['status'] = 1;
                } elseif (Database::getException()) {
                    $result['exception'] = Database::getException();
                } else {
                    $result['exception'] = 'No hay tamaños de balones registrados';
                }
                break;
            case 'search':
                $_POST =  $tamano_balon->validateForm($_POST);
                if ($_POST['buscar'] == '') {
                    $result['exception'] = 'Ingrese un valor para buscar';
                } elseif ($result['dataset'] =  $tamano_balon->searchRows($_POST['buscar'])) {
                    $result['status'] = 1;
                    $result['message'] = 'Valor encontrado';
                } elseif (Database::getException()) {
                    $result['exception'] = Database::getException();
                } else {
                    $result['exception'] = 'No hay coincidencias';
                }
                break;
            case 'create':
                $_POST =  $tamano_balon->validateForm($_POST);
                if (! $tamano_balon->setTamano($_POST['descripcion'])) {
                    $result['exception'] = 'Tamaño balon no aceptado';                
                } elseif ( $tamano_balon->createRow()) {
                    $result['status'] = 1;
                    $result['message'] = 'Tamaño balon agregado correctamente';                    
                } else {
                    $result['exception'] = Database::getException();
                }
                break;
            case 'readOne':
                if (!$tamano_balon->setId_tipoE($_POST['id_tipoE'])) {
                    $result['exception'] = 'Categoría incorrecta';
                } elseif ($result['dataset'] =  $tamano_balon->readOne()) {
                    $result['status'] = 1;
                } elseif (Database::getException()) {
                    $result['exception'] = Database::getException();
                } else {
                    $result['exception'] = 'Categoría inexistente';
                }
                break;
            case 'update':
                $_POST =  $tamano_balon->validateForm($_POST);
                if (! $tamano_balon->setId_tipoE($_POST['id_tipoE'])) {
                    $result['exception'] = 'Tipo empleado incorrecto';
                } elseif (!$data =  $tamano_balon->readOne()) {
                    $result['exception'] = 'Tipo empleado inexistente';
                } elseif (! $tamano_balon->setTipo_e($_POST['tipo_empleado'])) {
                    $result['exception'] = 'Tipo empleado no aceptado';                
                } elseif ( $tamano_balon->updateRow()) {
                        $result['status'] = 1;
                        $result['message'] = 'Tipo empleado modificado correctamente';
                } else {
                    $result['exception'] = Database::getException();
                }
                break;
            case 'delete':
                if (! $tamano_balon->setId($_POST['id_tamanobalon'])) {
                    $result['exception'] = 'Tamano balon incorrecto';
                } elseif (!$data =  $tamano_balon->readOne()) {
                    $result['exception'] = 'Tamano balon inexistente';
                } elseif ( $tamano_balon->deleteRow()) {
                    $result['status'] = 1;
                    $result['message'] = 'Tamano balon eliminado correctamente';                    
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