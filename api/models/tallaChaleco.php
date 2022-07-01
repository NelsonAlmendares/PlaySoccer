<?php
/*
*	Clase para manejar la tabla categorias de la base de datos.
*   Es clase hija de Validator.
*/
class Talla extends Validator
{
    // Declaración de atributos (propiedades).
    private $id = null;
    private $talla_chaleco = null;    

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

    public function setTalla($value)
    {
        if ($this->validateAlphanumeric($value, 1, 50)) {
            $this->talla_chaleco = $value;
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

    public function getTalla()
    {
        return $this->talla_chaleco;
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
        $sql = 'INSERT INTO "tb_tallaChaleco"(tallachaleco)
                VALUES (?)';
        $params = array($this->talla_chaleco);
        return Database::executeRow($sql, $params);
    }
    /*-------Función para leer todos los tamaños agregados---------*/
    public function readAll()
    {
        $sql = 'SELECT id_talla, tallachaleco 
                FROM "tb_tallaChaleco"
                ORDER BY id_talla';
        $params = null;
        return Database::getRows($sql, $params);
    }

    public function readOne()
    {
        $sql = 'SELECT id_talla, tallachaleco 
                FROM "tb_tallaChaleco"
                WHERE id_talla = ?';
        $params = array($this->id);
        return Database::getRow($sql, $params);
    }

    public function updateRow()
    {
        $sql = 'UPDATE "tb_tallaChaleco"
                SET tallachaleco=?
                WHERE id_talla = ?';
        $params = array($this->talla_chaleco, $this->id);
        return Database::executeRow($sql, $params);
    }
    /*----------Función para eliminar un tamaño agregado-------------*/
    public function deleteRow()
    {
        $sql = 'DELETE FROM "tb_tallaChaleco"
                WHERE id_talla = ?';
        $params = array($this->id);
        return Database::executeRow($sql, $params);
    }
}
