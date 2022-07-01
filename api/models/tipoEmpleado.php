<?php
/*
*	Clase para manejar la tabla categorias de la base de datos.
*   Es clase hija de Validator.
*/
class Templeado extends Validator
{
    // Declaración de atributos (propiedades).
    private $id = null;
    private $tipo_empleado = null;    

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
            $this->tipo_empleado = $value;
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
        return $this->tipo_empleado;
    }    

    /*
    *   Métodos para realizar las operaciones SCRUD (search, create, read, update, delete).
    */
    public function searchRows($value)
    {
        $sql = 'SELECT id_tipoempleado, tipoempleado
                FROM "tb_tipoEmpleado"
                WHERE tipoempleado ILIKE ?
                ORDER BY tipoempleado';
        $params = array("%$value%");
        return Database::getRows($sql, $params);
    }

    public function createRow()
    {
        $sql = 'INSERT INTO "tb_tipoEmpleado"(tipoempleado)
                VALUES (?)';
        $params = array($this->tipo_empleado);
        return Database::executeRow($sql, $params);
    }

    public function readAll()
    {
        $sql = 'SELECT id_tipoempleado, tipoempleado
                FROM "tb_tipoEmpleado"';
        $params = null;
        return Database::getRows($sql, $params);
    }

    public function readOne()
    {
        $sql = 'SELECT id_tipoempleado, tipoempleado 
                FROM "tb_tipoEmpleado"
                WHERE id_tipoempleado = ?';
        $params = array($this->id);
        return Database::getRow($sql, $params);
    }

    public function updateRow()
    {
        $sql = 'UPDATE "tb_tipoEmpleado"
                SET tipoempleado=?
                WHERE id_tipoempleado = ?';
        $params = array($this->tipo_empleado, $this->id);
        return Database::executeRow($sql, $params);
    }

    public function deleteRow()
    {
        $sql = 'DELETE FROM "tb_tipoEmpleado"
                WHERE id_tipoempleado = ?';
        $params = array($this->id);
        return Database::executeRow($sql, $params);
    }
}
