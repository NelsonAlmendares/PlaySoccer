<?php
/*
*	Clase para manejar la tabla categorias de la base de datos.
*   Es clase hija de Validator.
*/
class Thorario extends Validator
{
    // Declaración de atributos (propiedades).
    private $id = null;
    private $tipo_horario = null;    

    /*
    *   Métodos para validar y asignar valores de los atributos.
    */
    public function setId($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->id = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setTipo($value)
    {
        if ($this->validateAlphanumeric($value, 1, 50)) {
            $this->tipo_horario = $value;
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
        return $this->id;
    }

    public function getTipo()
    {
        return $this->tipo_horario;
    }    

    /*
    *   Métodos para realizar las operaciones SCRUD (search, create, read, update, delete).
    */
    public function searchRows($value)
    {
        $sql = 'SELECT id_tipohorario, horario_reservacion 
                FROM "tb_tipoHorario"
                WHERE horario_reservacion ILIKE ?
                ORDER BY horario_reservacion';
        $params = array("%$value%");
        return Database::getRows($sql, $params);
    }

    public function createRow()
    {
        $sql = 'INSERT INTO "tb_tipoHorario"(horario_reservacion)
                VALUES (?)';
        $params = array($this->tipo_horario);
        return Database::executeRow($sql, $params);
    }

    public function readAll()
    {
        $sql = 'SELECT id_tipohorario, horario_reservacion
                FROM "tb_tipoHorario"';
        $params = null;
        return Database::getRows($sql, $params);
    }

    public function readOne()
    {
        $sql = 'SELECT id_tipohorario, horario_reservacion 
                FROM "tb_tipoHorario"
                WHERE id_tipohorario = ?';
        $params = array($this->id);
        return Database::getRow($sql, $params);
    }

    public function updateRow()
    {
        $sql = 'UPDATE "tb_tipoHorario"
                SET horario_reservacion=?
                WHERE id_tipohorario = ?';
        $params = array($this->tipo_horario, $this->id);
        return Database::executeRow($sql, $params);
    }

    public function deleteRow()
    {
        $sql = 'DELETE FROM "tb_tipoHorario"
                WHERE id_tipohorario = ?';
        $params = array($this->id);
        return Database::executeRow($sql, $params);
    }
}
