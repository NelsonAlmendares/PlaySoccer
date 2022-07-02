<?php

    class Clientes extends validator{
        //Declaramos los attributos
        private $id = null;
        private $nombre = null;
        private $apellido = null;
        private $documento = null;
        private $celular = null;
        private $correo = null;
        private $password = null;
        private $foto = null;
        private $ruta = '../imagenes/clientes/';

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
	            nombre_cliente, apellido_cliente, dui_cliente, celular_cliente, correo_cliente, contrasena_cliente)
	            VALUES (?, ?, ?, ?, ?, ?, ?)';
            $params = array($this->nombre, $this->apellido, $this->documento, $this->celular, $this->celular, $this->password);
            return Database::executeRow($sql, $params);
        }

        function primerUso () {
            $this->foto = '1.png';
            $sql = 'INSERT INTO public.tb_cliente(
                nombre_cliente, apelllido_cliente, dui_cliente, celular_cliente, correo_cliente, contrasena_cliente, foto_cliente)
                VALUES (?, ?, ?, ?, ?, ?, ?);';
            $params = array($this->nombre, $this->apellido, $this->documento, $this->celular, $this->correo, $this->password ,$this->foto);
            return Database::executeRow($sql, $params);
        }

        public function updateRow ($foto_imagen) {
            if ($foto_imagen == '1.png') {
                $this->foto = $foto_imagen;
            } else {
                ($this->foto) ? $this->deleteFile($this->getRuta(), $foto_imagen) : $this->foto = $foto_imagen;
            }
            
            $sql = ' UPDATE public.tb_cliente
                SET nombre_cliente=?, apelllido_cliente=?, dui_cliente=?, celular_cliente=?, correo_cliente=?, foto_cliente=?
                WHERE id_cliente = ? ';
            $params = array($this->nombre, $this->apellido, $this->documento, $this->celular,$this->correo, $this->foto, $this->id);
            return Database::executeRow($sql, $params);
        }

        public function deleteRow () {
            $sql = ' DELETE FROM public.tb_cliente
	            WHERE id_cliente = ?';
            $params = array($this->id);
            return Database::executeRow($sql,$params);
        }

        public function readOne () {
            $sql = 'SELECT id_cliente AS id, nombre_cliente AS nombre, apelllido_cliente AS apellido, dui_cliente AS documento, celular_cliente AS celular, correo_cliente AS correo, contrasena_cliente AS password, foto_cliente AS foto
	            FROM public.tb_cliente
	            WHERE id_cliente = ?';
            $params = array($this->id);
            return Database::getRow($sql, $params);
        }

        public function readAll () {
            $sql = 'SELECT id_cliente AS id, nombre_cliente AS nombre, foto_cliente AS foto, apelllido_cliente AS apellido, dui_cliente AS Documento, celular_cliente AS celular, correo_cliente AS correo
                FROM tb_cliente 
                ORDER BY id_cliente';
            $params = null;
            return Database::getRows($sql,$params);
        }

        public function searchRows ($value) {
            $sql = 'SELECT id_cliente AS id, foto_cliente AS foto, nombre_cliente AS nombre, apelllido_cliente AS apellido, dui_cliente AS Documento, celular_cliente AS celular, correo_cliente AS correo
                FROM tb_cliente 
                WHERE nombre_cliente ILIKE ? OR apelllido_cliente ILIKE ? OR correo_cliente ILIKE ?';
            $params = array("%$value%", "%$value%", "%$value%");
            return Database::getRows($sql, $params);
        }

    }

?>