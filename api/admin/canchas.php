<?php
require_once '../helpers/database.php';
require_once '../helpers/validator.php';
require_once '../models/canchas.php';

/**
 * Se comprueba si hay una accion a realizar, de lo contrario se finaliza el script  con un mensaje de error
 */

if (isset($_GET['action'])) {
    /**
     * Se hace una sesion o se reanuda la que ya tenemos abierta
     */
    session_start();
    /**
     *  se instancia la clase correspondiente
     */
    $cancha = new Cancha;
    /**
     *  se declara e inicia un arreglo para guardar el resultado
     */
    $result = array('status' => 0, 'message' => null, 'exception' => null);
    /**
     * se verifica si esta en una sesion como admin de lo contrario se finaliza
     */
    if (isset($_SESSION['id_cancha'])) {
        /**
         * se verifica la accion a realizar cuando un admin esta logueado
         */
        /**
         * se abre un caso para leer todos los datos de la tabla
         */

        switch ($_GET['action']) {
            case 'readAll':
                if ($result['dataset'] = $cancha->readALL()) {
                    $result['status'] = 1;
                } elseif (Database::getException()) {
                    $result['exception'] = Database::getException();
                } else {
                    $result['exception'] = 'No hay datos registrados';
                }
                break;
                /**
                 *  se abre caso para buscar datos 
                 */

                 case 'search':
                    $_POST = $cancha->validateForm($_POST);
                    if($_POST['search'] == '') {
                        if($result['dataset'] = $cancha->readAll()) {
                            $result['status'] = 1;
                        } elseif (Database::getException()) {
                            $result['exception'] = Database::getException();
                        } else {
                            $result['exception'] ='No hay datos registrados';
                        }
                    } elseif($result['dataset'] = $cancha->searchRows($_POST['buscar'])) {
                        $result['status'] = 1;
                        $result['message'] = 'Registro encontrado';
                    } elseif(Database::getException()) {
                        $result['exception'] = Database::getException();
                    } else {
                        $result['exception'] ='No hay coincidencias';
                    }
                    break;
            /**
                 *  se abre caso para registrar o añadir nuevas canchas
                 */

            case 'create':
                $_POST = $cancha->validateForm($_POST);
                if (!$cancha->setNumero($_POST['numero_cancha'])) {
                    $result['exception'] = 'numero invalido';
                } elseif (!$cancha->setTamano($_POST['tamano_cancha'])) {
                    $result['exception'] = 'tamaño invalido';
                } elseif (!$cancha->setMaterial($_POST['material_cancha'])) {
                    $result['exception'] = 'tipo de material invalido';
                } elseif (!$cancha->setCosto($_POST['costo_cancha'])) {
                    $result['exception'] = 'Valor monetario invalido';
                } else {
                    $result['exception'] = Database::getException();
                }
                break;

                /**
                 *  se abre caso para leer un registro 
                 */
                case 'readOne':
                    if(!$cancha->setId($_POST['id_cancha'])) {
                        $result['exception'] = 'Identificación de cancha incorrecta';
                    } elseif($result['dataset'] = $cancha->readOne()) {
                        $result['status'] = 1;
                    } elseif(Database::getException()) {
                        $result['exception'] = Database::getException();
                    } else {
                        $result['exception'] = 'Registro de cancga inexistente';
                    }
                    break;

                    /**
                     *  se abre un caso para actualizar registros de canchas
                     */
                
                case 'update':
                    $_POST = $cancha->validateForm($_POST);
                    if(!$cancha->setId($_POST['id_cancha'])) {
                        $result['exception'] = 'Identificación de cancha incorrecto';
                    } elseif (!$data = $cancha ->readOne()) {
                        $result['exception'] = 'Registro de cancga inexistente';
                    } elseif (!$cancha->setTamano($_POST['descripcion'])) {
                        $result['exception'] = 'El tamaño de la cancha no aceptada';
                    } elseif ( $cancha->updateRow()){
                        $result['status'] = 1;
                        $result['message'] = 'Los datos de la cancha han sido modificados correctamente';
                    } else {
                        $result['exception'] = Database::getException();
                    }
                    break;

                    /**
                     *  se abre un caso para eliminar un dato
                     */
                    case 'delete':
                        if(!$cancha->setId($_POST['id_cancha'])) {
                            $result['exception'] = 'identificacion de cancha incorrecta';
                        }elseif(!$data = $cancha->readOne()) {
                            $result['exception'] = 'Registro de cancha inexistente';
                        }elseif($cancha->deleteRow()) {
                            $result['status'] = 1;
                            $result['message'] = 'Registro eliminado correctamente';
                        } else {
                            $result['exception'] = Database::getException();
                        }
                        break;
                    default:
                        $result['exception'] = 'Acción no disponible dentro de la sesión';
            }
            header('content-type: application/json; charset=utf-8');
        } else {
            print(json_encode('Acceso denegado'));
        }
    } else {
        print(json_encode('Recurso no disponible'));
    }
    