<?php
    class Database{
        /* variablas para la conexion con la base de datos */
        private static $connection = null;
        private static $statement = null;
        private static $error = null;

        public static function connect(){
            $server = 'localhost';
            $database = 'PlaySoccer';
            $username = 'postgres';
            $password = 'admin';


            self::$connection = new PDO('pgsql:host=' . $server . ';dbname=' . $database . ';port=5432' , $username, $password);
        }

        /* Funcion para las operaciones insert, update y delete */

        public static function executeRow($query, $values){
            try {
                self::connect();
                self::$statement = self::$connection->prepare($query);
                $state = self::$statement->execute($values);
                self::$connection = null;
                return $state;
            } catch (PDOException $error) {
                self::setException($error->getCode(), $error->getMessage()); 
                return false;
            }
        }

        public static function getLastRow($query, $values)
    {
        try {
            self::connect();
            self::$statement = self::$connection->prepare($query);
            if (self::$statement->execute($values)) {
                $id = self::$connection->lastInsertId();
            } else {
                $id = 0;
            }
            // Se anula la conexión con el servidor de base de datos.
            self::$connection = null;
            return $id;
        } catch (PDOException $error) {
            // Se obtiene el código y el mensaje de la excepción para establecer un error personalizado.
            self::setException($error->getCode(), $error->getMessage());
            return 0;
        }
    }

        /*Funcion para mandar a llamar los registros con sentencia de sql tipo SELECT retornando un valor booleano*/
        public static function getRows($query, $values){
            try {
                self::connect();
                self::$statement = self::$connection->prepare($query);
                self::$statement->execute($values);
                self::$connection = null;
                return self::$statement->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $error) {
                self::setException($error->getCode(), $error->getMessage());
                return false;
            }
        }

        /*
    *   Método para obtener un registro de una sentencia SQL tipo SELECT.
    *
    *   Parámetros: $query (sentencia SQL) y $values (arreglo de valores para la sentencia SQL).
    *   
    *   Retorno: arreglo asociativo del registro si la sentencia SQL se ejecuta satisfactoriamente o false en caso contrario.
    */
    public static function getRow($query, $values)
    {
        try {
            self::connect();
            self::$statement = self::$connection->prepare($query);
            self::$statement->execute($values);
            // Se anula la conexión con el servidor de base de datos.
            self::$connection = null;
            return self::$statement->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $error) {
            // Se obtiene el código y el mensaje de la excepción para establecer un error personalizado.
            self::setException($error->getCode(), $error->getMessage());
            die(self::getException());
        }
    }

        private static function setException($code, $message){
        // Se asigna el mensaje del error original por si se necesita.
        self::$error = utf8_encode($message);
        // Se compara el código del error para establecer un error personalizado.
        switch ($code) {
            case '7':
                self::$error = 'Existe un problema al conectar con el servidor';
                break;
            case '42703':
                self::$error = 'Nombre de campo desconocido';
                break;
            case '23505':
                self::$error = 'Dato duplicado, no se puede guardar';
                break;
            case '42P01':
                self::$error = 'Nombre de tabla desconocido';
                break;
            case '23503':
                self::$error = 'Registro ocupado, no se puede eliminar';
                break;
            default:
                //self::$error = 'Ocurrió un problema en la base de datos';
            }
        }

        /* Metodo para obtener errores de una excecion */
        public static function getException(){
            return self::$error;
        }
    }
?>