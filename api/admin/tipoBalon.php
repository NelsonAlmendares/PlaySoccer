<?php
require_once('../helpers/database.php');
require_once('../helpers/validator.php');
require_once('../models/tipoBalon.php');

/*
*Se comprueba si hay una accion a realizar o sino de lo contrario se finaliza el script con un mensaje de error
*/
if (isset($_GET['action'])){
    /*
    *se hace una sesion o se reanuda la que ya tenemos abierta para poder usar variables de sesion en el scrip
    */
    session_start();
    /*
    *Se instancia la clase correspondiente
    */
    $tipoBalon = new Tipo;
   /*
    *Se declara e inicia un arreglo para guardar el resultado que retorna la api
    */
    $result = array('status' => 0, 'message' => null, 'exception' => null);
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
        if ($result['dataset'] = $tipoBalon->readAll()) {
          $result['status'] = 1;
        } elseif (Database::getException()) {
          $result['exception'] = Database::getException();
        } else {
          $result['exception'] = 'no hay datos registrados';
        }
        break;
        /*
        *se abre caso para buscar un dato
        */
      case 'search':
        $_POST = $tipoBalon->validateForm($_POST);
        if ($_POST['search'] == '') {
          $result['exception'] = 'ingrese un dato para buscar';
        } elseif ($result['dataset'] = $tipoBalon->searchRows($_POST['search'])) {
          $result['status'] = 1;
          $result['message'] = 'dato encontrado';
        } elseif (Database::getException()) {
          $result['exception'] = Database::getException();
        } else {
          $result['exception'] = 'no hay ninguno parecido';
        }
        break;
        /*
        *se abre caso para crear un registro
        */
      case 'create':
        $_POST = $tipoBalon->validateForm($_POST);
        if (!$tipoBalon->setCosto($_POST['costo_balon'])) {
          $result['exception'] = 'costo incorrecto';
        } elseif (!$tipoBalon->setCantidad($_POST['cantidad_balones'])) {
          $result['exception'] = 'Cantidad incorrecta';
        } elseif (!isset($_POST['id_tamanobalon'])) {
          $result['exception'] = 'Seleccione un tamaño de balon';
        } elseif (!$tipoBalon->setIdtamano($_POST['id_tamanobalon'])) {
          $result['exception'] = 'seleccione un tamaño balon';
        } else {
          $result['exception'] = Database::getException();;
        }
        break;
        /*
        *Se abre el caso para actualizar un registro
        */
      case 'update':
        $_POST = $tipoBalon->validateForm($_POST);
        if (!$tamano_balon->setId($_POST['id_tipobalon'])) {
          $result['exception'] = 'Producto incorrecto';
        } elseif (!$data = $tipoBalon->readOne()) {
          $result['exception'] = 'Producto inexistente';
        } elseif (!$tipoBalon->setCosto($_POST['costo_balon'])) {
          $result['exception'] = 'Costo incorrecto';
        } elseif (!$tipoBalon->setCantidad($_POST['cantidad_balones'])) {
          $result['exception'] = 'Cantidad incorrecta';
        } elseif (!$tipoBalon->setIdtamano($_POST['id_tamanobalon'])) {
          $result['exception'] = 'Tamaño incorrecto';
        }else {
          $result['exception'] = Database::getException();
        }
        break;
        /*
        *se crea el caso de eliminar
        */
      case 'delete':
        if (!$tipoBalon->setId($_POST['id_tipobalon'])) {
          $result['exception'] = 'Tipo balon incorrecto incorrect';
        } elseif (!$data =  $tipoBalon->readOne()) {
          $result['exception'] = 'tipo balon inexistente';
        } elseif ($tipoBalon->deleteRow()) {
          $result['status'] = 1;
          $result['message'] = 'Tipo balon eliminado correctamente';
        } else {
          $result['exception'] = Database::getException();
        }
        break;
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