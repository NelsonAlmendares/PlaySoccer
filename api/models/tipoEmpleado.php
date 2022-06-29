<?php
/*
*	Clase para manejar la tabla categorias de la base de datos.
*   Es clase hija de Validator.
*/
class Tipo_empleado extends Validator
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

    public function getTipo_E()
    {
        return $this->tipo_empleado;
    }    

    /*
    *   Métodos para realizar las operaciones SCRUD (search, create, read, update, delete).
    */
    public function searchRows($value)
    {
        $sql = 'SELECT t_e."id_tipoEmpleado", t_e."tipoEmpleado" 
                FROM tipo_empleado t_e
                WHERE t_e."tipoEmpleado" ILIKE ?
                ORDER BY t_e."tipoEmpleado"';
        $params = array("%$value%");
        return Database::getRows($sql, $params);
    }

    public function createRow()
    {
        $sql = 'INSERT INTO tipo_empleado("tipoEmpleado")
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
        $sql = 'SELECT t_e."id_tipoEmpleado", t_e."tipoEmpleado" 
                FROM tipo_empleado t_e
                WHERE t_e."id_tipoEmpleado" = ?';
        $params = array($this->id_tipoE);
        return Database::getRow($sql, $params);
    }

    public function updateRow()
    {
        $sql = 'UPDATE tipo_empleado
                SET "tipoEmpleado"=?
                WHERE "id_tipoEmpleado" = ?';
        $params = array($this->tipo_empleado, $this->id_tipoE);
        return Database::executeRow($sql, $params);
    }

    public function deleteRow()
    {
        $sql = 'DELETE FROM tipo_empleado t_e
                WHERE t_e."id_tipoEmpleado" = ?';
        $params = array($this->id_tipoE);
        return Database::executeRow($sql, $params);
    }
}
