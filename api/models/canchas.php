<?php

class Canchas extends Validator
{
    // Declaración de atributos (propiedades)

    private $id_cancha = null;
    private $numero = null;
    private $tamano = null;
    private $material = null;
    private $costo = null;

    // Métodos para validar y asignar valores a los atributos

    public function setId($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->id_cancha = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setNumero($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->numero_cancha = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setTamano($value)
    {
        if ($this->validateAlphanumeric($value, 1, 100)) {
            $this->tamano_cancha = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setMaterial($value)
    {
        if ($this->validateAlphabetic($value, 1, 100)) {
            $this->material_cancha = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setCosto($value)
    {
        if ($this->validateMoney($value)) {
            $this->costo_cancha = $value;
            return true;
        } else {
            return false;
        }
    }

    /**
     *  Métodos para obtener los valores de los atributos
     */

    public function getId()
    {
        return $this->id_cancha;
    }

    public function getNumero()
    {
        return $this->numero_cancha;
    }

    public function getTamano()
    {
        return $this->tamano_cancha;
    }

    public function getMaterial()
    {
        return $this->material_cancha;
    }
    public function getCosto()
    {
        return $this->costo_cancha;
    }

    /**
     *  Métodos para gestionar el registro de canchas
     */

    /*-----------------------Método basicos para el Scrud -------------------- */

    // buscar una fila

    public function searchRows($value)
    {
        $sql = 'SELECT id_cancha, numero_cancha, tamano_cancha, material_cancha, costo_cancha
        FROM tb_cancha
        where tamano_cancha ILIKE ? OR material_cancha ILIKE ?
        ORDER by tamano_cancha';
        $params = array("%$value%","%$value%");
        return Database::getRows($sql, $params);
    }

    // agregar una cancha

    public function createRow()
    {
        $sql = 'INSERT INTO tb_cancha (numero_cancha, tamano_cancha, material_cancha, costo_cancha)
        VALUES(?, ?, ?, ?)';
        $params = array($this->numero_cancha, $this->tamano_cancha, $this->material_cancha, $this->costo_cancha);
        return Database::executeRow($sql, $params);
    }

    // metodo para leer el contenido de la tabla
    public function readAll()
    {
        $sql = 'SELECT id_cancha, numero_cancha, tamano_cancha, material_cancha, costo_cancha
        FROM tb_cancha
        ORDER BY id_cancha';
        $params = null;
        return Database::getRows($sql, $params);
    }

    // metodo para leer un dato
    public function readOne()
    {
        $sql = 'SELECT id_cancha, numero_cancha, tamano_cancha, material_cancha, costo_cancha
        FROM tb_cancha
        WHERE id_cancha = ?';
        $params = array($this->id_cancha);
        return Database::getRow($sql, $params);
    }

    // metodo para actualizar canchas

    public function updateRow()
    {
        $sql = 'UPDATE tb_cancha
        SET numero_cancha = ?, tamano_cancha = ?, material_cancha = ?, costo_cancha = ?
        WHERE id_cancha = ?';
        $params = array($this->numero_cancha, $this->tamano_cancha, $this->material_cancha, $this->costo_cancha, $this->id_cancha);
        return Database::executeRow($sql, $params);
    }
    // metodo para eliminar una cancha

    public function deleteRow()
    {
        $sql = 'DELETE FROM tb_cancha 
        WHERE id_cancha = ?';
        $params = array($this->id_cancha);
        return Database::executeRow($sql, $params);
    }
}
