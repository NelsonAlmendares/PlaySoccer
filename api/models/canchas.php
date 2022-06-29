<?php

class Canchas extends Validator
{
    // Declaración de atributos (propiedades)

    private $id_cancha = null;
    private $numero_cancha = null;
    private $tamano_cancha = null;
    private $material_cancha = null;
    private $costo_cancha = null;

    // Métodos para validar y asignar valores a los atributos

    public function setId($values)
    {
        if ($this->validateNaturalNumber($values)) {
            $this->id_cancha = $values;
            return true;
        } else {
            return false;
        }
    }

    public function setNumero($values)
    {
        if ($this->validateNaturalNumber($values)) {
            $this->numero_cancha = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setTamano($values)
    {
        if ($this->validateNaturalNumber($values)) {
            $this->tamano_cancha = $values; 
            return true;
        } else {
            return false;
        }
    }

    public function setMaterial($values)
    {
        if ($this->validateAlphabetic($values)) {
            $this->material_cancha = $values;
            return true;
        } else {
            return false;
        }
    }

    public function setCosto($values)
    {
        if ($this->validateNaturalNumber($values)) {
            $this->costo_cancha = $values;
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

      /*-----------------------Método para proporcionar el id de la cancha -------------------- */

      public function checkCourt($numero_cancha)
      {
        $sql = 'SELECT id_cancha FROM tb_cancha WHERE numero_cancha = ? ';
        $params = array($numero_cancha);
        if ($data = Database::getRow($sql, $params)) {
            $this->id_cancha = $data['id_cancha'];
            $this->numero_cancha = $numero_cancha;
            return true;
        } else {
            return false;
        }
      }

      
}



