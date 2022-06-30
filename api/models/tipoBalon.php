<?php

class Tipo extends Validator
{
    private $id = null;
    private $costo_balon = null;
    private $cantidad_balones = null;
    private $id_tamanobalon = null;

    public function setId($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->id = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setCosto($value)
    {
        if ($this->validateMoney($value)) {
            $this->costo_balon = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setCantidad($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->cantidad_balones = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setIdtamano;o($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->id_tamanobalon = $value;
            return true;
        } else {
            return false;
        }
    }

    public function getId()
    {
        return $this->id_chaleco;
    }
    public function getCosto()
    {
        return $this->costo_chaleco;
    }
    public function getCantidad()
    {
        return $this->cantidad_chlecos;
    }
    public function getIdcolorchaleco()
    {
        return $this->id_colorchaleco;
    }
    
}