<?php

    class horario extends validatos {
        $private $id = null;
        $private $hora_inicio = null;
        $private $hora_fin = null;
        $private $tipoHorario = null;

        // Método para validar y asignar valores
        public function setId ($value) {
            if ($this->validateNaturalNumber($value)) {
                $this->id = $value;
                return true;
            } else {
                return false;
            }
        }

        public function set_horaInicio ($value) {
            if ($this->validateTime($value) {
                $this->set_horaInicio = $value;
            }
        }

    }

?>