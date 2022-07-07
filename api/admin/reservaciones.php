<?php
    require_once('../helpers/database.php');
    require_once('../helpers/validator.php');
    require_once('../models/reservaciones.php');
    
    // Se comprueba si existe una acción a realizar, de lo contrario se finaliza el script con un mensaje de error.
    if (isset($_GET['action'])){
        // Se crea una sesión o se reanuda la actual para poder utilizar variables de sesión en el script.
        session_start();
        // Se instancia la clase correspondiente.
        $reserva = new Reservaciones;
        // Se declara e inicializa un arreglo para guardar el resultado que retorna la API.
        $result = array('status' => 0, 'message' => null, 'exception' => null);
        // Se verifica si existe una sesión iniciada como administrador, de lo contrario se finaliza el script con un mensaje de error.
        if (isset($_SESSION['id_empleado'])){
            // Se compara la acción a realizar cuando un administrador ha iniciado sesión.
            switch($_GET['action']){
                case 'readAll':
                    if ($result ['dataset'] = $reserva -> readAll()){
                        $result ['status'] = 1;
                    }else if(Database::getException()){
                        $result ['exception'] = Database::getException();
                    }else{
                        $result ['exception'] = 'No hay datos registrados';
                    }
                    break;
                case 'readOne':
                    if(!$reserva ->setId($_POST['id_reserva'])){
                        $result['exception'] = 'Reserva incorrecta';
                    }elseif ($result['dataset'] = $reserva -> readOne()){
                        $result['status'] = 1;
                    }elseif (Database::getException()){
                        $result['exception'] = Database::getException();
                    }else{
                        $result['exception'] = 'Reserva inexistente';
                    }
                    break;
                case 'search':
                    $_POST = $reserva->validateForm($_POST);
                    if ($_POST ['buscar'] = '') {
                        if ($result ['dataset'] = $reserva->readAll()) {
                            $result ['status'] = 1;
                        } elseif (Database::getException()) {
                            $result ['exception'] = Database::getException();
                        } else {
                            $result ['exception'] = 'No hay reservacion registradas';
                        }
                    } elseif ($result ['dataset'] = $reserva->searchRows($_POST['buscar'])) {
                        $result ['status'] = 1;
                        $result ['message'] = 'Valor encontrado';
                    } elseif (Database::getException()) {
                        $result ['exception'] = Database::getException();
                    } else {
                        $result ['exception'] = 'No hay conincidencias';
                    }
                break;
                
                case 'update':
                    $_POST = $reserva -> validateForm($_POST);
                    if (!$reserva -> setId($_POST['id_reserva'])){
                        $result['exception'] = 'Reserva Incorrecta';
                    }elseif (!$data = $reserva -> readOne()){
                        $result['exception'] = 'Reserva inexistente';
                    }elseif(!$reserva -> setFec($_POST['fecha_reserva'])){
                        $result['exception'] = 'Fecha incorrecta';
                    }elseif (!$reservas -> setBalAl($_POST['balones_alquilados'])){
                        $result ['exception'] = "Cantidad incorrecta";
                    }elseif (!$reserva -> setObse($_POST['onbservaciones'])){
                        $result['exception'] = 'Observacion incorrecta'; 
                    }elseif (!$reserva -> setChaleAl($_POST['chalecos_alquilados'])){
                        $result ['exception'] = 'Cantidad incorrecta';
                    }elseif (!$reserva -> setIdemple($_POST['id_empleado'])){
                        $result ['exception'] = 'Nombre de empleado incorrecto';
                    }elseif (!$reserva -> setIdcan($_POST['id_cancha'])){
                        $result ['exception'] = 'Cancha incorrecta';
                    }elseif (!$reserva -> setIdhora($_POST['id_horario'])){
                        $result ['exception'] = 'Horario incorrecto';
                    }elseif (!$reserva -> setIdclien($_POST['id_cliente'])){
                        $result ['exception'] = 'Nombre del cliente incorrecto';
                    }elseif (!$reserva -> setIdasi($_POST['id_asistemcoa'])){
                        $result ['exception'] = 'Tipo de asistencia incorrecto';
                    }elseif (!$reserva -> setIdtibo($_POST['id_tipobalon'])){
                        $result ['exception'] = 'Tipo de balon incorrecto';
                    }elseif (!$reserva -> setIdchale($_POST['id_chaleco'])){
                        $result ['exception'] = 'Chalecos incorrectos';
                    }elseif ($result['dataset'] =  $reserva->readOne()) {
                        $result['status'] = 1;
                    }elseif (Database::getException()) {
                        $result['exception'] = Database::getException();
                    } else {
                        $result['exception'] = 'Reserva inexistente';
                    }
                    break;
                case 'create':
                    $_POST = $reserva -> validateForm($_POST);
    
                    if (!$reserva -> setFec($_POST['fecha'])){
                        $result['exception'] = 'Fecha Incorrecta';
                    }elseif (!$reserva -> setBalAl($_POST['balones'])){
                        $result ['exception'] = "Cantidad incorrecta";
                    }elseif (!$reserva -> setObse($_POST['observacion'])){
                        $result['exception'] = 'Observacion incorrecta'; 
                    }elseif (!$reserva -> setChaleAl($_POST['cantidadChalecos'])){
                        $result ['exception'] = 'Cantidad incorrecta';
                    }elseif (!$reserva -> setIdemple($_POST['empleado'])){
                        $result ['exception'] = 'Nombre de empleado incorrecto';
                    }elseif (!$reserva -> setIdcan($_POST['cancha'])){
                        $result ['exception'] = 'Cancha incorrecta';
                    }elseif (!$reserva -> setIdhora($_POST['horario'])){
                        $result ['exception'] = 'Horario incorrecto';
                    }elseif (!$reserva -> setIdclien($_POST['cliente'])){
                        $result ['exception'] = 'Nombre del cliente incorrecto';
                    }elseif (!$reserva -> setIdasi($_POST['t_asistencia'])){
                        $result ['exception'] = 'Tipo de asistencia incorrecto';
                    }elseif (!$reserva -> setIdtibo($_POST['tipoBalon'])){
                        $result ['exception'] = 'Tipo de balon incorrecto';
                    }elseif (!$reserva -> setIdchale($_POST['chalecos'])){
                        $result ['exception'] = 'Chalecos incorrectos';
                    }elseif($reserva -> createRow()){
                        $result ['status'] = 1;
                        $result ['message'] = 'Reservacion creada correctamente';
                    }else{
                        $result['exception'] = Database::getException();
                    }
                    break;
                    case 'delete':
                        if (!$reserva -> setId($_POST['id_reserva'])) {
                            $result ['exception'] = 'Identificación de Horario desconocida';
                        } elseif (!$reserva -> readOne()) {
                            $result ['exception'] = 'Registro inexistente';
                        } elseif ($reserva -> deleteRow()) {
                            $result ['status'] = 1;
                            $result ['message'] = 'Horario eliminado correctamente';
                        } else {
                            $result ['exception'] = Database::getException();
                        }
                        break;
                    default:
                        $result['exception'] = 'Acción no disponible dentro de la sesión';
            }
             // Se indica el tipo de contenido a mostrar y su respectivo conjunto de caracteres.
             header('content-type: application/json; charset=utf-8');
             // Se imprime el resultado en formato JSON y se retorna al controlador.
             print(json_encode($result));
        }else{
            print(json_encode('Acceso denegado'));
        }
    }else{
        print(json_encode('Recurso no disponible'));
    }
    
?>