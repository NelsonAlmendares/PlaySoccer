<?php
/*
*	Clase para manejar la tabla categorias de la base de datos.
*   Es clase hija de Validator.
*/
class Asistencia extends Validator
{
    // Declaración de atributos (propiedades).
    private $id = null;
    private $asistencia = null;    

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

    public function setAsistencia($value)
    {
        if ($this->validateAlphanumeric($value, 1, 50)) {
            $this->asistencia = $value;
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

    public function getAsistencia()
    {
        return $this->asistencia;
    }    

    /*
    *   Métodos para realizar las operaciones SCRUD (search, create, read, update, delete).
    */
    public function searchRows($value)
    {
        $sql = 'SELECT id_asistencia, descripcion_asistencia 
                FROM tb_asistencia
                WHERE descripcion_asistencia ILIKE ?
                ORDER BY descripcion_asistencia';
        $params = array("%$value%");
        return Database::getRows($sql, $params);
    }
    /*-------Función para leer todos los tamaños agregados---------*/
    public function createRow()
    {
        $sql = 'INSERT INTO tb_asistencia(descripcion_asistencia)
                VALUES (?)';
        $params = array($this->asistencia);
        return Database::executeRow($sql, $params);
    }
    /*-------Función para leer todos los tamaños agregados---------*/
    public function readAll()
    {
        $sql = 'SELECT id_asistencia, descripcion_asistencia 
                FROM tb_asistencia
                ORDER BY id_asistencia';
        $params = null;
        return Database::getRows($sql, $params);
    }

    public function readOne()
    {
        $sql = 'SELECT id_asistencia, descripcion_asistencia 
                FROM tb_asistencia
                WHERE id_asistencia = ?';
        $params = array($this->id);
        return Database::getRow($sql, $params);
    }

    public function updateRow()
    {
        $sql = 'UPDATE tb_asistencia
                SET descripcion_asistencia=?
                WHERE id_asistencia = ?';
        $params = array($this->asistencia, $this->id);
        return Database::executeRow($sql, $params);
    }
    /*----------Función para eliminar un tamaño agregado-------------*/
    public function deleteRow()
    {
        $sql = 'DELETE FROM tb_asistencia
                WHERE id_asistencia = ?';
        $params = array($this->id);
        return Database::executeRow($sql, $params);
    }
}
