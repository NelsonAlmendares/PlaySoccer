<?php
/*
*	Clase para manejar la tabla categorias de la base de datos.
*   Es clase hija de Validator.
*/
class Color extends Validator
{
    // Declaración de atributos (propiedades).
    private $id = null;
    private $color_chaleco = null;    

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

    public function setColor($value)
    {
        if ($this->validateAlphanumeric($value, 1, 50)) {
            $this->color_chaleco = $value;
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

    public function getColor()
    {
        return $this->color_chaleco;
    }    

    /*
    *   Métodos para realizar las operaciones SCRUD (search, create, read, update, delete).
    */
    public function searchRows($value)
    {
        $sql = 'SELECT id_color, colorchaleco 
                FROM "tb_colorChaleco"
                WHERE colorchaleco ILIKE ?
                ORDER BY colorchaleco';
        $params = array("%$value%");
        return Database::getRows($sql, $params);
    }
    /*-------Función para leer todos los tamaños agregados---------*/
    public function createRow()
    {
        $sql = 'INSERT INTO "tb_colorChaleco"(colorchaleco)
                VALUES (?)';
        $params = array($this->color_chaleco);
        return Database::executeRow($sql, $params);
    }
    /*-------Función para leer todos los tamaños agregados---------*/
    public function readAll()
    {
        $sql = 'SELECT id_color, colorchaleco 
                FROM "tb_colorChaleco"
                ORDER BY id_color';
        $params = null;
        return Database::getRows($sql, $params);
    }

    public function readOne()
    {
        $sql = 'SELECT id_color, colorchaleco 
                FROM "tb_colorChaleco"
                WHERE id_color = ?';
        $params = array($this->id);
        return Database::getRow($sql, $params);
    }

    public function updateRow()
    {
        $sql = 'UPDATE "tb_colorChaleco"
                SET colorchaleco=?
                WHERE id_color = ?';
        $params = array($this->color_chaleco, $this->id);
        return Database::executeRow($sql, $params);
    }
    /*----------Función para eliminar un tamaño agregado-------------*/
    public function deleteRow()
    {
        $sql = 'DELETE FROM "tb_colorChaleco"
                WHERE id_color = ?';
        $params = array($this->id);
        return Database::executeRow($sql, $params);
    }
}
