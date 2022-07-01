<?php
require_once('../helpers/database.php');
require_once('../helpers/validator.php');
require_once('../models/chaleco.php');

/*
*Se comprueba si hay una accion a realizar o sino de lo contrario se finaliza el script con un mensaje de error
*/
if (isset($_GET['action'])) {
    /*
    *se hace una sesion o se reanuda la que ya tenemos abierta para poder usar variables de sesion en el scrip
    */
    session_start();
    /*
    *Se instancia la clase correspondiente
    */
    $chaleco = new Chalecos;
    /*
    *Se declara e inicia un arreglo para guardar el resultado que retorna la api
    */
    $result = array('status' =>0, 'message' =>null, 'exception' =>null);
    /*
    *Se verifica si esta en una sesion como admin de lo contrario se finaliza el scrip con un mensaje de error 
    */
    if (isset($_SESSION['id_empleado'])) {
        /*
        *se chequea la accion a realzar cuando un admin esta logueado
        */
            /*
            *se abre caso para leer todos los datos de la tabla
            */
        switch ($_GET['action']) {
            case 'readAll':
                if ($result['dataset'] = $chaleco->readAll()) {
                    $result['status'] = 1;
                }elseif (Database::getException()) {
                    $result['exception'] = Database::getException();
                }else {
                    $result['exception']= 'no hay datos registrados';
                }
                break;
                    /*
                    *se abre caso para buscar un dato
                    */
            case 'search':
                $_POST = $chaleco->validateForm($_POST);
                if ($_POST['search'] == '') {
                    $result['exception'] = 'ingrese un dato para buscar';
                }elseif ($result['dataset'] = $chaleco->searchRows($_POST['search'])) {
                    $result['status'] =1;
                    $result['message'] ='dato encontrado crack';
                }elseif (Database::getException()) {
                    $result['exception'] = Database::getException();
                }else {
                    $result['exception'] = 'no hay ninguno parecido';
                }
                break;
                    /*
                    *se abre caso para crear un registro de chaleco
                    */
            case 'create':
                        $_POST = $chaleco->validateForm($_POST);
                        if (!$chaleco->setCosto($_POST['costo_chaleco'])) {
                            $result['exception'] = 'costo incorrecto';
                        } elseif (!$chaleco->setCantidad($_POST['cantidad_chlecos'])) {
                            $result['exception'] = 'Cantidad incorrecta';
                        } elseif (!isset($_POST['id_colorchaleco'])) {
                            $result['exception'] = 'Seleccione una categoría';
                        }elseif (!$chaleco->setIdcolorchaleco($_POST['id_colorchaleco'])) {
                            $result['exception'] = 'seleccione un color';
                        }  elseif (!$chaleco->setTalla(isset($_POST['talla_chaleco']) ? 1 : 0)) {
                            $result['exception'] = 'talla incorrecta';
                        }else {
                            $result['exception'] = Database::getException();;
                        }
                break;
                    /*
                    *Se abre el caso para actualizar un registro
                    private $id_tipobalon = null;
    private $costo_balon = null;
    private $cantidad_balones = null;
    private $id_tamanobalon = null;
                    */
                case 'update':
                        $_POST = $chaleco->validateForm($_POST);
                        if (!$chaleco->setId($_POST['id_chaleco'])) {
                            $result['exception'] = 'Producto incorrecto';
                        } elseif (!$data = $chaleco->readOne()) {
                            $result['exception'] = 'Producto inexistente';
                        } elseif (!$chaleco->setCosto($_POST['costo_chaleco'])) {
                            $result['exception'] = 'Nombre incorrecto';
                        } elseif (!$chaleco->setCantidad($_POST['cantidad_chlecos'])) {
                            $result['exception'] = 'Descripción incorrecta';
                        } elseif (!$chaleco->setIdcolorchaleco($_POST['id_colorchaleco'])) {
                            $result['exception'] = 'Precio incorrecto';
                        } elseif (!$chaleco->setTalla($_POST['talla_chaleco'])) {
                            $result['exception'] = 'Seleccione una categoría';
                        } else {
                            $result['exception'] = Database::getException();
                        }
                break;
                        /*
                        *Se a
                        */
            default:
            $result['exception'] = 'Acción no disponible dentro de la sesión';
                break;
        }
    }
}else {
    print(json_encode('Recurso no disponible'))
}