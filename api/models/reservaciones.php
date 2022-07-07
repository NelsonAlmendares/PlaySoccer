<?php
    
    class Reservaciones extends Validator{
        // Declaración de atributos (propiedades).
        private $id_reserva = null;
        private $fecha_reserva = null;
        private $balones_alquilados = null;
        private $observaciones = null;
        private $chalecos_alquilados = null;
        private $id_empleado = null;
        private $id_cancha = null;
        private $id_horario = null;
        private $id_cliente = null;
        private $id_asistencia = null;
        private $id_tipobalon = null;
        private $id_chalecos = null;
    
    
        /*
        *   Métodos para validar y asignar valores de los atributos.
        */
    
        public function setId($value)
        {
            if ($this->validateNaturalNumber($value)) {
                $this->id_reserva = $value;
                return true;
            } else {
                return false;
            }
        }
    
        public function setFec($value)
        {
            if ($this->validateDate($value)) {
                $this->fecha_reserva = $value;
                return true;
            } else {
                return false;
            }
        }
    
        public function setBalAl($value)
        {
            if ($this->validateNaturalNumber($value)) {
                $this->balones_alquilados = $value;
                return true;
            } else {
                return false;
            }
        }
    
        public function setObse($value)
        {
            if ($this->validateAlphabetic($value, 1, 50)) {
                $this->observaciones = $value;
                return true;
            } else {
                return false;
            }
        }
    
        public function setChaleAl($value)
        {
            if ($this->validateNaturalNumber($value)) {
                $this->chalecos_alquilados = $value;
                return true;
            } else {
                return false;
            }
        }
    
        public function setIdemple($value)
        {
            if ($this->validateNaturalNumber($value)) {
                $this->id_empleado = $value;
                return true;
            } else {
                return false;
            }
        }
    
        public function setIdcan($value)
        {
            if ($this->validateNaturalNumber($value)) {
                $this->id_cancha = $value;
                return true;
            } else {
                return false;
            }
        }
    
        public function setIdhora($value)
        {
            if ($this->validateNaturalNumber($value)) {
                $this->id_horario = $value;
                return true;
            } else {
                return false;
            }
        }
    
        public function setIdclien($value)
        {
            if ($this->validateNaturalNumber($value)) {
                $this->id_cliente = $value;
                return true;
            } else {
                return false;
            }
        }
    
        public function setIdasi($value)
        {
            if ($this->validateNaturalNumber($value)) {
                $this->id_asistencia = $value;
                return true;
            } else {
                return false;
            }
        }
    
        public function setIdtibo($value)
        {
            if ($this->validateNaturalNumber($value)) {
                $this->id_tipobalon = $value;
                return true;
            } else {
                return false;
            }
        }
    
        public function setIdchale($value)
        {
            if ($this->validateNaturalNumber($value)) {
                $this->id_chalecos = $value;
                return true;
            } else {
                return false;
            }
        }
        
        /*
        *   Métodos para obtener valores de los atributos.
        */
    
        public function getId()
        {
            return $this->id_reserva;
        }
    
        public function getFec()
        {
            return $this->fecha_reserva;
        }
    
        public function getBalAl()
        {
            return $this->balones_alquilados;
        }
    
        public function getObse()
        {
            return $this->observaciones;
        }
    
        public function getChaleAl()
        {
            return $this->chalecos_alquilados;
        }
    
        public function getIdemple()
        {
            return $this->id_empleado;
        }
    
        public function getIdcan()
        {
            return $this->id_cancha;
        }
    
        public function getIdhora()
        {
            return $this->id_horario;
        }
    
        public function getIdclien()
        {
            return $this->id_cliente;
        }
    
        public function getIdasi()
        {
            return $this->id_asistencia;
        }
    
        public function getIdtibo()
        {
            return $this->id_tipobalon;
        }
    
        public function getIdchale()
        {
            return $this->id_chalecos;
        }
    
        /*
        *   Métodos para realizar las operaciones SCRUD (search, create, read, update, delete).
        */
        /*-------------Método para buscar el Fecha reserva.-------------*/
        public function searchFecha($value)
        {
            $sql = 'SELECT id_reserva, fecha_reserva, balones_alquilados, 
            observaciones, chalecos_alquilados, id_empleado, id_cancha, 
            id_horario, id_cliente, id_asistencia, id_tipobalon, id_chalecos
            FROM public.tb_reserva
            WHERE fecha_reserva ILIKE ?';
            $params = array("%$value%");
            return Database::getRows($sql, $params);
        }
    
        /*----------------Método para crear reservas--------------------*/
        public function createRow()
        {           
            $sql = 'INSERT INTO public.tb_reserva(
            fecha_reserva, balones_alquilados,
            observaciones, chalecos_alquilados, id_empleado, id_cancha, 
            id_horario, id_cliente, id_asistencia, id_tipobalon, id_chalecos)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
            $params = array($this->fecha_reserva, $this->balones_alquilados, $this->observaciones,$this -> chalecos_alquilados, $this->id_empleado, $this->id_cancha, $this->id_horario, $this->id_cliente, $this->id_asistencia, $this->id_tipobalon, $this->id_chalecos);                
            return Database::executeRow($sql, $params);
        }
    
        public function readOne()
        {
            $sql = 'SELECT id_reserva, fecha_reserva, balones_alquilados, 
            observaciones, chalecos_alquilados, tb_e.id_empleado as id_empleado, tb_ch.id_cancha as id_cancha,
            tb_hr.id_horario as id_horario , tb_cl.id_cliente as id_cliente, tb_as.id_asistencia as id_asistencia, tb_tb.id_tipobalon as id_tipobalon, tb_chal.id_chaleco as id_chaleco
            FROM tb_reserva tb_res
            INNER JOIN "tb_empleado" tb_e ON tb_res.id_empleado = tb_e.id_empleado
            INNER JOIN "tb_cancha" tb_ch ON  tb_res.id_cancha = tb_ch.id_cancha
            INNER JOIN "tb_horario" tb_hr ON tb_res.id_horario = tb_hr.id_horario
            INNER JOIN "tb_cliente" tb_cl ON tb_res.id_cliente = tb_cl.id_cliente
            INNER JOIN "tb_asistencia" tb_as ON tb_res.id_asistencia = tb_as.id_asistencia
            INNER JOIN "tb_tipoBalon" tb_tb ON tb_res.id_tipobalon = tb_tb.id_tipobalon
            INNER JOIN "tb_chaleco" tb_chal ON tb_res.id_chalecos = tb_chal.id_chaleco
            WHERE id_reserva = ?';
            $params = array($this->id_reserva);
            return Database::getRow($sql, $params);
        }
    
        public function readAll()
        {
            $sql = 'SELECT id_reserva, fecha_reserva, balones_alquilados, 
            observaciones, chalecos_alquilados, tb_e.id_empleado as id_empleado, tb_ch.id_cancha as id_cancha,
            tb_hr.id_horario as id_horario , tb_cl.id_cliente as id_cliente, tb_as.id_asistencia as id_asistencia, tb_tb.id_tipobalon as id_tipobalon, tb_chal.id_chaleco as id_chaleco
            FROM tb_reserva tb_res
            INNER JOIN "tb_empleado" tb_e ON tb_res.id_empleado = tb_e.id_empleado
            INNER JOIN "tb_cancha" tb_ch ON  tb_res.id_cancha = tb_ch.id_cancha
            INNER JOIN "tb_horario" tb_hr ON tb_res.id_horario = tb_hr.id_horario
            INNER JOIN "tb_cliente" tb_cl ON tb_res.id_cliente = tb_cl.id_cliente
            INNER JOIN "tb_asistencia" tb_as ON tb_res.id_asistencia = tb_as.id_asistencia
            INNER JOIN "tb_tipoBalon" tb_tb ON tb_res.id_tipobalon = tb_tb.id_tipobalon
            INNER JOIN "tb_chaleco" tb_chal ON tb_res.id_chalecos = tb_chal.id_chaleco
            ORDER BY id_reserva';
            $params = null;
            return Database::getRows($sql, $params);
        }
    
        public function updateRow()
        {
            $sql = 'UPDATE public.tb_reserva
            SET fecha_reserva=?, balones_alquilados=?, observaciones=?, chalecos_alquilados=?, id_empleado=?, id_cancha=?, id_horario=?, id_cliente=?, id_asistencia=?, id_tipobalon=?, id_chalecos=?
            WHERE id_reserva = ?';
            $params = array($this->fecha_reserva, $this->balones_alquilados, $this->observaciones,$this -> chalecos_alquilados, $this->id_empleado, $this->id_cancha, $this->id_horario, $this->id_cliente, $this->id_asistencia, $this->id_tipobalon, $this->id_chalecos);
            return Database::executeRow($sql, $params);
        }
    
        public function deleteRow()
        {
            $sql = 'DELETE FROM public.tb_reserva
            WHERE id_reserva = ?';
            $params = array($this->id_reserva);
            return Database::executeRow($sql, $params);
        }
    }
?>