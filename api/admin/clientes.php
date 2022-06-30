<?php

    require_once('../helpers/database.php');
    require_once('../helpers/validator.php');
    require_once('../models/clientes.php');

    // Comprobamos si existe una acción a realizar
    if (isset($_GET ['action'] )) {
        // Comporbamos si exite una sesión 
        session_start();
        // Instancia correspondiente 
        $cliente = New Clientes;
        // Inicializamos el arreglo para guardar el resultado de la API
        $result = array('status' => 0, 'session' => 0, 'message' => null, 'exception' => null, 'dataset' => null, 'codigo' => null);

        if (isset($_SESSION['id_empleado'])) {
            $result['session'] = 1;
            switch ($_GET['action']) {

                // Caso para obtener el usuario
                case 'getUser':
                    if (isset($_SESSION['codigo_cliente'])) {
                        $result ['status'] = 1;
                        $result ['codigo'] = $_SESSION ['codigo_cliente'];
                        $result ['nombre'] = $_SESSION ['nombre_cliente'];
                        $result ['foto'] = $_SESSION ['foto_cliente'];
                        $result ['rol'] = $_SESSION ['tipo_cliente'];
                    } else {
                        $result ['exception'] = 'Código de cliente indefinido';
                    }
                break;

                // Caso para cerrar sesión 
                case 'LogOut': 
                    if (session_destroy()) {
                        $result ['status'] = 1;
                        $result ['message'] = 'Sesión cerrada correctamente';
                    } else {
                        $result ['exception'] = 'Ocurrió un problema al cerrar la sesión';
                    }
                break;

                //Caso para leer los datos del perfil
                case 'readProfile': 
                    if ($result ['dataset'] = $cliente->readProfile()) {
                        $result ['status'] = 1;
                    } elseif (Database::getException()) {
                        $result ['exception'] = Database::getException();
                    } else {
                        $result ['exception'] = 'Empleado Inexistente';
                    }
                break;

                // Caso para editar el perfil
                case 'editProfile':
                    if ('') {

                    } else {

                    }
                break;

                // Casi para leer todos los datos del registro
                case 'readAll':
                    if ($result ['dataset'] = $cliente->readAll()) {
                        $result['status'] = 1;
                    } elseif (Database::getException()) {
                        $result ['exception'] = Database::getException();
                    } else {
                        $result ['exception'] = 'No hay datos registrados';
                    }
                break;

                // Caso para buscar un cliente
                case 'search':
                    $_POST = $cliente->validateForm($_POST);
                    if ($_POST ['buscar'] == '') {
                        $result ['exception'] = 'Ingrese un dato para buscar';
                    } elseif ($cliente->validateAlphabetic($_POST ['buscar'] ,0 ,50)) {
                        if ($result ['dataset'] = $cliente->searchRows($_POST ['buscar'] )) {
                            $result ['status'] = 1;
                            $result ['message'] = 'Datos encontrados';
                        } else {
                            $result ['Exception'] = 'No hay coincidencias';
                        }
                    } elseif ($cliente->validateAlphabetic($_POST ['buscar'],0 ,50)) {
                        if ($result ['dataset'] = $cliente->searchRows($_POST ['buscar'] )) {
                            $result ['status'] = 1;
                            $result ['message'] = 'Datos encontrados';
                        } else {
                            $result ['exception'] = 'No hay coincidencias';
                        }
                    } elseif ($cliente->validateEmail($_POST ['buscar'])){
                        if ($result ['dataset'] = $cliente->searchRows($_POST ['buscar'])) {
                            $result ['status'] = 1;
                            $result ['message'] = 'Datos encontrados';
                        } else {
                            $result ['exception'] = 'No hay coincidencias';
                        }
                    } elseif (Database::getException()) {
                        $result ['exception'] = Database::getException();
                    } else {
                        $result ['exception'] = 'No hay coincidencias';
                    }
                break;

                //Caso para crear un usuario
                case 'create';
                    $_POST = $cliente->validateForm($_POST);
                    if (!$cliente->setNombre ($_POST ['nombre'] )) {
                        $result ['exception'] = 'Nombre Incorrecto';
                    } elseif (!$cliente->setApellido ($_POST ['apellido'] )) {
                        $result ['exception'] = 'Apellido Incorrecto' ;
                    } elseif (!$cliente->setDocumento ($_POST ['documento'] )) {
                        $result ['exception'] = 'Dui Incorrecto';
                    } elseif (!$cliente->setCelular ($_POST['celular'] )) {
                        $result ['exception'] = 'Celular Incorrecto';
                    } elseif (!$cliente->setCorreo ($_POST ['correo'])) {
                        $result ['exception'] = 'Correo Incorrecto';
                    } elseif ($_POST['clave'] != $_POST ['confirmar'] ) {
                        $result ['exception'] = 'Las contraseñas deben de ser iguales';
                    } elseif (!$cliente->setPassword ($_POST ['clave'] )) {
                        $result ['exception'] = $cliente->getPasswordError();
                    } elseif (!$cliente->setFoto ($_FILES ['foto']['tmp_name'] )) {
                        $result ['exception'] = 'Selecciona una imagen';
                    } elseif (!is_uploaded_file($_FILES['foto']['tmp_name'])) {
                        $result ['exception'] = $cliente->getFileError();
                    } elseif ($cliente->createRow()) {
                        $result ['status'] = 1;
                        if ($cliente->saveFile($_FILES['foto'], $cliente->getRuta(), $cliente->getFoto())) {
                            $result ['message'] = 'El cliente se registró correctamente';
                        } else {
                            $result ['message'] = 'El cliente se registró pero no se guardó la imagen ';
                        }
                    } elseif(Database::getException()){
                        $result ['exception'] = Database::getException(); 
                    } else {
                        $result ['exception'] = 'El cliente no se registro correctamente';
                    }
                break;

                // Caso para leer un dato del cliente
                case 'readOne':
                    if (!$cliente->setId($_POST ['id'])) {
                        $result ['exception'] = 'Cliente incorrecto';
                    } elseif ($result['dataset'] = $cliente->readOne()) {
                        $result ['status'] = 1;
                    } elseif (Database::getException()) {
                        $result ['exception'] = Database::getException();
                    } else {
                        $result ['exception'] = 'Cliente inexistente';
                    }
                break;

                case 'update':

                break;

                default:
                    $result ['exception'] = 'Acción no disponible dentro de la sesión';
                break;
            }
        } else {
            // Se comprueba la acción a realizar cuando el administrador no ha iniciado sesión
            switch ($_GET['action']) {
                //Caso para leer todos los usuarios
                case 'readUsers';
                    if ($cliente->readAll()) {
                        $result['status'] = 1;
                        $result['message'] = 'Existe al menos un usuario registrado';
                    } else {
                        $result['exception'] = 'No existen usurios registados';
                    }
                break;

                case 'register':
                    $_POST = $cliente->validateForm($_POST);
                    if (!$cliente->setNombre($_POST['nombre'])) {
                        $result ['exception'] = 'Nombres incorrectos';
                    } elseif (!$cliente->setApellido($_POST['apellido'])) {
                        $result ['exception'] = 'Apellido Incorrecto';
                    } elseif (!$cliente->setDocumento($_POST['documento'])) {
                        $result ['exception'] = 'DUI incorrecto';
                    } elseif (!$cliente->setCelular($_POST['celular'])) {
                        $result ['exception'] = 'Celular incorrecto';
                    } elseif (!$cliente->setCorreo($_POST['correo'])) {
                        $result ['exception'] = 'Correo incorrecrto';
                    } elseif ($_POST ['clave'] != $_POST['confirmar']) {
                        $result['exception'] = 'Claver diferentes';
                    } elseif (!$cliente->setPassword($_POST['password'])) {
                        $result['exception'] = $cliente->getPasswordError();
                    } elseif (!is_uploaded_file($_FILES['foto']['tmp_name'])) {
                        $result['excpetion'] = $cliente->getFileError();
                    } elseif ($cliente->createRow()) {
                        $result ['status'] = 1;
                        if ($cliente->saveFile($_FILES ['foto'], $cliente->getRuta(), $cliente->getFoto() )) {
                            $result ['message'] = 'El empleado se registró correctamente';
                        } else {
                            $result ['exception'] = 'El cliente se registró pero no se guardó la imagen';
                        }
                    } elseif (Database::getException()) {
                        $result ['exception'] = Database::getException();
                    } else {
                        $result ['exception'] = 'El cliente no se registró';
                    }
                break;
                
                case 'logIn':
                    $_POST = $cliente->validateForm($_POST);
                    if ('') {

                    } else {
                        
                    }
                break;

                default:
                    $result ['exception'] = 'Acción no disponible fuera de la sesión';
                break;
            }
        }

        header ('content-type: application/json; charset=utf-8');
        print (json_encode($result));

    } else {
        print (json_encode('Recurso no disponible'));
    }

?>