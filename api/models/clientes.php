<?php

    class Clientes extends Validator{
        //Declaramos los attributos
        private $id = null;
        private $nombre = null;
        private $apellido = null;
        private $documento = null;
        private $celular = null;
        private $correo = null;
        private $password = null;
        private $foto = null;
        private $ruta = '../images/clientes';

        /* 
        * Métodos para alidar y asignar valores a los atributos
        */
        public function setId ($value) {
            if ($this->validateNaturalNumber($value)) {
                $this->id = $value;
                return true;
            } else {
                return false;
            }
        }

        public function setNombre($value) {
            if ($this->validateAlphabetic($value, 1, 50)) {
                $this->nombre = $value;
                return true;
            } else {
                return false;
            }
        }

        public function setApellido ($value) {
            if ($this->validateAlphabetic($value, 1, 50)) {
                $this->apellido = $value;
                return true; 
            } else {
                return false;
            }
        }

        public function setDocumento ($value){
            if ($this->validateDUI($value)) {
                $this->documento = $value;
                return true;
            } else {
                return false;
            }
        }

        public function setCelular ($value) {
            if ($this->validatePhone($value)) {
                $this->celular = $value;
                return true;
            } else {
                return false;
            }
        }

        public function setCorreo ($value) {
            if ($this->validateEmail($value)) {
                $this->correo = $value;
                return true;
            } else {
                return false;
            }
        }

        public function setPassword ($value) {
            if ($this->validatePassword($value)) {
                $this->password = $value;
                return true;
            } else {
                return false;
            }
        }

        public function setFoto ($file) {
            if ($this->validateImageFile($file, 800, 800)) {
                $this->foto = $this->getFileName();
                return true;
            } else {
                return false;
            }
        }

        /* 
        * Métodos para obtener los valores de los atributos
        */

        public function getId() {
            return $this->id;
        }

        public function getNombre () {
            return $this->nombre;
        }

        public function getApellido () {
            return $this->apellido;
        }

        public function getDocumento () {
            return $this->documento;
        }

        public function getCelular () {
            return $this->celular;
        }

        public function getCorreo () {
            return $this->correo;
        }

        public function getPassword () {
            return $this->password;
        }

        public function getFoto () {
            return $this->foto;
        }

        public function getRuta () {
            return $this->ruta;
        }

        public function readProfile () {
            $sql = 'SELECT id_cliente, nombre_cliente, apellido_cliente, dui_cliente, celular_cliente, correo_cliente, contrasena_cliente, foto_cliente
                FROM tb_cliente
                WHERE id_cliente = ?';
            $params = array ($_SESSION ['id'] );
            return Database::getRow($sql, $params);
        }

        //Opercciones básicas para el CRUD
        public function createRow () {
            $sql = 'INSERT INTO public.tb_cliente(
	            nombre_cliente, apellido_cliente, dui_cliente, celular_cliente, correo_cliente, contrasena_cliente, foto_cliente)
	            VALUES (?, ?, ?, ?, ?, ?, ?)';
            $params = array($this->nombre, $this->apellido, $this->documento, $this->celular, $this->celular, $this->password, $this->foto);
            return Database::executeRow($sql, $params);
        }

        public function updateRow ($foto) {
            # code...
        }

        public function readOne () {
            $sql = 'SELECT id_cliente, nombre_cliente, apellido_cliente, dui_cliente, celular_cliente, correo_cliente, contrasena_cliente, foto_cliente
	            FROM public.tb_cliente
	            WHERE id_cliente = ?
	            ORDER BY nombre_cliente';
            $params = array($this->id);
            return Database::getRow($sql, $params);
        }

        public function readAll () {
            $sql = 'SELECT foto_cliente AS foto, nombre_cliente AS nombre, apelllido_cliente AS apellido, dui_cliente AS DUI, celular_cliente AS celular, correo_cliente AS correo
                FROM tb_cliente 
                ORDER BY id_cliente';
            $params = null;
            return Database::getRows($sql,$params);
        }

        public function searchRows ($value) {
            $sql = 'SELECT foto_cliente AS foto, nombre_cliente AS nombre, apellido_cliente AS apellido, dui_cliente AS DUI, celular_cliente AS celular, correo_cliente AS correo
                FROM tb_cliente 
                WHERE nombre_cliente ILIKE ? OR apellido_cliente ILIKE ? OR correo_cliente ILIKE ?
                ORDER BY id_cliente';
            $params = array("$value");
            return Database::getRows($sql, $params);
        }

    }

?>