<?php
    require_once('../helpers/database.php');
    require_once('../helpers/validator.php');
    require_once('../models/horario.php');

if (isset($_GET['action'])) {
    session_start();

    $horario = new Horario;
    $result = array ('status' => 0, 'message' => null, 'exception' => null);

    if (isset($_SESSION ['id_empleado'])) {
            switch ($_GET['action']) {
                case 'readAll':
                    if ($result ['dataset'] = $horario -> readAll()) {
                        $result ['status'] = 1;
                    } elseif (Database::getException()) {
                        $result ['exception'] = Database::getException();
                    } else {
                        $result ['exception'] = 'No hay horarios registrados';
                    }
                break;
                
                case 'search':
                    $_POST = $horario->validateForm($_POST);
                    if ($_POST ['buscar'] = '') {
                        if ($result ['dataset'] = $horario->readAll()) {
                            $result ['status'] = 1;
                            $result ['message'] = 'Todos los datos han sido cargados';
                        } elseif (Database::getException()) {
                            $result ['exception'] = Database::getException();
                        } else {
                            $result ['exception'] = 'No hay canchas registradas';
                        }
                    } elseif ($horario->validateTime($_POST['buscar'])) {
                        if ($result ['dataset'] = $horario->searchHora($_POST['buscar'])) {
                            $result ['status'] = 1;
                            $result['message'] = 'Valor encontrado';
                        } else {
                            $result['exception'] = 'No hay coincidencias';
                        }
                    }
                break;
                    
                case 'create':
                    $_POST = $horario->validateForm($_POST);

                    if (!$horario->setHoraInicio($_POST['hora_inicio'])) {
                        $result ['exception'] = 'Valor inicio incorrecto';
                    } elseif (!$horario->setHoraFin($_POST['hora_fin'])) {
                        $result ['exception'] = 'Valor final incorrecto';
                    } elseif (!isset($_POST['tipo_horario'])) {
                        $result ['exception'] = 'Seleccione el tipo de horario';
                    }elseif (!$horario->setTipoHorario($_POST['tipo_horario'])) {
                        $result ['exception'] = 'Id de cancha incorrecto';
                    } elseif ( $horario->createRow() ) {
                        $result ['status'] = 1;
                        $result ['message'] = 'Horario registrado corretamente';
                    } else {
                        $result['exception'] = Database::getException();
                    }
                break;

                case 'readOne':
                    if (!$horario->setId($_POST['id'])) {
                        $result ['exception'] = 'Identificaci??n de horario desconocida';
                    } elseif ($result ['dataset'] = $horario->readOne()) {
                        $result ['status'] = 1;
                    } elseif (Database::getException()) {
                        $result ['exception'] = Database::getException();
                    } else {
                        $result ['exception'] = 'El horario soliciatado no existe';
                    }
                break;

                case 'update':
                    $_POST = $horario->validateForm($_POST);
                    if (!$horario->setId($_POST['id'])){
                        $result ['exception'] = 'Horario incorrecto';
                    } elseif (!$horario->setHoraInicio($_POST['hora_inicio'])) {
                        $result ['execption'] = 'Valor de inicio incorrecto';
                    } elseif (!$horario->setHoraFin($_POST['hora_fin'])){
                        $result ['exception'] = 'Valor de fin incorrecto';
                    } elseif (!$horario->setTipoHorario($_POST['tipo_horario'])) {
                        $result ['exceotion'] = 'Valor de tipo horario incorrecto';
                    } elseif ($horario->updateRow()) {
                        $result ['status'] = 1;
                        $result ['message'] = 'Horario modificado correctamente';
                    } else {
                        $result ['exception'] = Database::getException();
                    }
                    break;

                case 'delete':
                    if (!$horario->setId($_POST['id'])) {
                        $result ['exception'] = 'Identificaci??n de Horario desconocida';
                    } elseif (!$horario->readOne()) {
                        $result ['exception'] = 'Registro inexistente';
                    } elseif ($horario->deleteRow()) {
                        $result ['status'] = 1;
                        $result ['message'] = 'Horario eliminado correctamente';
                    } else {
                        $result ['exception'] = Database::getException();
                    }
                    break;

                default:
                    $result['exception'] = 'Acci??n no disponible dentro de la sesi??n';
                    break;
            }
        } else {
            print(json_encode('Acceso denegado'));
        }
        // Se indica el tipo de contenido a mostrar y su respectivo conjunto de caracteres.
        header('content-type: application/json; charset=utf-8');
        // Se imprime el resultado en formato JSON y se retorna al controlador.
        print(json_encode($result));
    } else {
        print(json_encode('Recurso no disponible'));
    }
