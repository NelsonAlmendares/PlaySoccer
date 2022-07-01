<?php
/*
*	Clase para manejar la tabla categorias de la base de datos.
*   Es clase hija de Validator.
*/
class Tamano extends Validator
{
    // Declaración de atributos (propiedades).
    private $id = null;
    private $tamano_balon = null;    

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

    public function setTamano($value)
    {
        if ($this->validateAlphanumeric($value, 1, 50)) {
            $this->tamano_balon = $value;
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

    public function getTamano()
    {
        return $this->tamano_balon;
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
    /*-------Función para leer todos los tamaños agregados---------*/
    public function createRow()
    {
        $sql = 'INSERT INTO "tb_tamanoBalon"(tamano_balon)
                VALUES (?)';
        $params = array($this->tamano_balon);
        return Database::executeRow($sql, $params);
    }
    /*-------Función para leer todos los tamaños agregados---------*/
    public function readAll()
    {
        $sql = 'SELECT id_tamanobalon, tamano_balon 
                FROM "tb_tamanoBalon"
                ORDER BY id_tamanobalon';
        $params = null;
        return Database::getRows($sql, $params);
    }

    public function readOne()
    {
        $sql = 'SELECT id_tamanobalon, tamano_balon 
                FROM "tb_tamanoBalon"
                WHERE id_tamanobalon = ?';
        $params = array($this->id);
        return Database::getRow($sql, $params);
    }

    public function updateRow()
    {
        $sql = 'UPDATE "tb_tamanoBalon"
                SET tamano_balon=?
                WHERE id_tamanobalon = ?';
        $params = array($this->tamano_balon, $this->id);
        return Database::executeRow($sql, $params);
    }
    /*----------Función para eliminar un tamaño agregado-------------*/
    public function deleteRow()
    {
        $sql = 'DELETE FROM "tb_tamanoBalon"
                WHERE id_tamanobalon = ?';
        $params = array($this->id);
        return Database::executeRow($sql, $params);
    }
}
