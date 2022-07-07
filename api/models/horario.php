<?php

    class horario extends validator {
        
        private $id = null;
        private $hora_inicio = null;
        private $hora_fin = null;
        private $tipoHorario = null;

        // Métodos para validar y asignar valores
        public function setId ($value) {
            if ($this->validateNaturalNumber ($value)) {
                $this->id = $value;
                return true;
            } else {
                return false;
            }
        }

        public function setHoraInicio ($value) {
            if ($this->validateTime($value)) {
                $this->hora_inicio = $value;
                return true;
            } else {
                return false;
            }
        }

        public function setHoraFin ($value) {
            if ($this->validateTime($value)) {
                $this->hora_fin =  $value;
                return true;
            } else {
                return false;
            }
        }

        public function setTipoHorario ($value) {
            if ($this->validateNaturalNumber($value)) {
                $this->tipoHorario = $value;
                return true;
            } else {
                return false;
            }
        }

        // Métodos para obtener los valores de los atributos

        public function getId () {
            return $this->id;
        }

        public function getHoraInicio () {
            return $this->hora_inicio;    
        }

        public function getHoraFin () {
            return $this->hora_fin;
        }

        public function getTipoHorario () {
            return $this->tipoHorario;
        }

        /* Métodos para las operaciones CRUD del sistema*/

        public function createRow () {
            $sql = 'INSERT INTO public.tb_horario(
	            hora_inicio, hora_fin, id_tipohorario)
	            VALUES (?, ?, ?)';
            $params = array ($this->hora_inicio, $this->hora_fin, $this->tipoHorario);
            return Database::executeRow($sql,$params);
        }

        public function readAll () {
            $sql = 'SELECT id_horario AS id, hora_inicio AS inicio, hora_fin AS fin, horario_reservacion 
                FROM PUBLIC.tb_horario th INNER JOIN PUBLIC."tb_tipoHorario" tph ON th.id_tipoHorario =  tph.id_tipoHorario
                ORDER BY id_horario';
            $params = null;
            return Database::getRows($sql, $params);
        }

        public function searchRows ($value) {
            $sql = 'SELECT id_horario AS id, hora_inicio AS inicio, hora_fin AS fin, horario_reservacion 
                FROM PUBLIC.tb_horario th INNER JOIN PUBLIC."tb_tipoHorario" tph ON th.id_tipoHorario =  tph.id_tipoHorario
                WHERE hora_incio ILIKE ?
                ORDER BY id_horario';
            $params = array("%$value%");
            return Database::getRows($sql, $params);
        }

        public function readOne () {
            $sql = 'SELECT id_horario AS id, hora_inicio AS inicio, hora_fin AS fin, horario_reservacion 
                FROM PUBLIC.tb_horario th INNER JOIN PUBLIC."tb_tipoHorario" tph ON th.id_tipoHorario =  tph.id_tipoHorario
                WHERE id_horario = ?';
            $params = array ($this->id);
            return Database::getRow($sql, $params);
        }

        public function updateRow () {
            $sql = 'UPDATE public.tb_horario
	            SET hora_inicio=?, hora_fin=?, id_tipohorario=?
	            WHERE id_horario = ?';
            $params = array ($this->hora_inicio, $this->hora_fin, $this->tipoHorario);
            return Database::executeRow($sql, $params);
        }

        public function deleteRow () {
            $sql = 'DELETE FROM public.tb_horario
	            WHERE id_horario = ?';
            $params = array ($this->id);
            return Database::executeRow($sql, $params);
        }
    }

?>