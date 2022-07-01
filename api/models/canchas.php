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
        if ($this->validateNaturalNumber($value)) {
            $this->tamano_cancha = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setMaterial($value)
    {
        if ($this->validateAlphabetic($value)) {
            $this->material_cancha = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setCosto($value)
    {
        if ($this->validateNaturalNumber($values)) {
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

    public function createLine()
    {
        $sql = 'INSERT INTO public.tb_cancha(
                numero_cancha, tamano_cancha, material_cancha, costo_cancha)
                VALUES(?, ?, ?, ?)';
        $params = array($this->numero, $this->tamano, $this->material, $this->costo);
        return Database::executeLine($sql, $params);
    }

    public function readLine()
    {
        $sql = 'SELECT id_cancha, numero_cancha, tamano_cancha, material_cancha, costo_cancha
                FROM public.tb_cancha
                WHERE id_cancha = ?
                ORDER BY numero_cancha';
        $params = array($this->id);
        return Database::getLines($sql, $params);
    }

    public function readAll()
    {
        $sql = 'SELECT numero_cancha AS numero, tamano_cancha AS tamano, material_cancha AS material, costo_cancha AS costo
                FROM tb_cancha
                ORDER BY id_cancha';
        $params = null;
        return Database::getLines($sql, $params);
    }

    public function searchLines($value)
    {
        $sql = 'SELECT numero_cancha AS numero, tamano_cancha AS tamano, material_cancha AS material, costo_cancha AS costo
                FROM tb_cancha
                WHERE numero_cancha ILIKE ? OR tamano_cancha ILIKE ? OR material_cancha ILIKE ?
                ORDER BY id_cancha';
        $params = array($value);
        return Database::getLines($sql, $params);
    }
    
    public function updateLine()
    {
        $sql = 'UPDATE tb_cancha SET tamano_cancha = ?, material_cancha = ?, costo_cancha = ?
        WHERE id_cancha = ?';
        $params = array($this->tamano_cancha, $this->material_cancha, $this->costo_cancha);
        return Database::executeLine($sql, $params);
    }

    public function deleteLine()
    {
        $sql = 'DELETE FROM tb_cancha
                WHERE id_cancha = ?';
        $params = array($this->id_cancha);
        return Database::executeLine($sql, $params);
    }

}

?>
