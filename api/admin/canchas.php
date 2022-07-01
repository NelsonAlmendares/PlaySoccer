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
                 *  se abre caso para actuaizar un registro
                 */
        }
    }
}
