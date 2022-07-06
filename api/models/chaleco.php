<?php
/*
*clase para manejar la tabla chalecos de la bd
*clase hija de validator
*/
class Chalecos extends Validator
{
    /*
    *Se declaran loa atributos (propiedades)
    */
    private $id_chaleco = null;
    private $costo_chaleco = null;
    private $cantidad_chalecos = null;
    private $id_colorchaleco = null;
    private $talla_chaleco = null;
    /*
    *metodo para validar y asignar valores a los atributos  (set y get)
    */
    public function setId($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->id_chaleco = $value;
            return true;
        }else{
            return false;
        }
    }
    public function setCosto($value)
    {
       if ($this->validateMoney($value)) {
        $this->costo_chaleco = $value;
        return true;
      }else{
         return false;  
     }
    }
    public function setCantidad($value)
    {
       if ($this->validateNaturalNumber($value)) {
        $this->cantidad_chalecos = $value;
        return true;
      }else{
         return false;  
     }
    }
    public function setColor($value)
    {
       if ($this->validateNaturalNumber($value)) {
        $this->id_colorchaleco = $value;
        return true;
      }else{
         return false;  
     }
    }
    public function setTalla($value)
    {
       if ($this->validateNaturalNumber($value)) {
        $this->talla_chaleco = $value;
        return true;
      }else{
         return false;  
     }
    }
    /* 
    *metodo para obtener los valores
    */
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
        return $this->cantidad_chalecos;
    }
    public function getColor()
    {
        return $this->id_colorchaleco;
    }
    public function getTalla()
    {
        return $this->talla_chaleco;
    }
    /*
    *Metodos del SCRUD
    */
        /*
        *buscar una fila
        */
    public function searchRows($value)
    {
        $sql = 'SELECT id_chaleco, costo_cheleco, cantidad_chlecos, tcc.colorchaleco AS colorchaleco, ttc.tallachaleco AS tallachaleco
        FROM public."tb_chaleco" tch INNER JOIN public."tb_colorChaleco" tcc ON tch.id_colorchaleco = tcc.id_color
        INNER JOIN public."tb_tallaChaleco" ttc ON tch.talla_chaleco = ttc.id_talla 
        where colorchaleco ILIKE ? OR tallachaleco ILIKE ?
        ORDER BY costo_cheleco';
         $params = array("%$value%", "%$value%");
         return Database::getRows($sql, $params);
    }
        /*
        *Metodo para crear 
        */
    public function createRow()
    {
        $sql = 'INSERT INTO tb_chaleco(costo_cheleco,cantidad_chlecos,id_colorchaleco, talla_chaleco)
        VALUES (?,?,?,?)';
        $params = array($this->costo_chaleco, $this->cantidad_chalecos,$this->id_colorchaleco, $this->talla_chaleco);
        return Database::executeRow($sql, $params);
    }

        /*
        *MEtodo para leer un dato(lo vamos a usar en el metodo de actualizar ya en la API.)
        */
    public function readOne()
    {
        $sql = 'SELECT id_chaleco, costo_cheleco, cantidad_chlecos, tcc.colorchaleco AS colorchaleco, ttc.tallachaleco AS tallachaleco
        FROM public."tb_chaleco" tch INNER JOIN public."tb_colorChaleco" tcc ON tch.id_colorchaleco = tcc.id_color
        INNER JOIN public."tb_tallaChaleco" ttc ON tch.talla_chaleco = ttc.id_talla
        WHERE id_chaleco = ? ';
        $params = array($this->id_chaleco);
        return Database::getRow($sql, $params);
    }
                /*
        *Metodo para leer el contendio de la tabla 
        */
    public function readAll()
    {
        $sql = 'SELECT id_chaleco, costo_cheleco, cantidad_chlecos, tcc.colorchaleco AS colorchaleco, ttc.tallachaleco AS tallachaleco
        FROM public."tb_chaleco" tch INNER JOIN public."tb_colorChaleco" tcc ON tch.id_colorchaleco = tcc.id_color
        INNER JOIN public."tb_tallaChaleco" ttc ON tch.talla_chaleco = ttc.id_talla
        ORDER BY id_chaleco';
        $params = null;
        return Database::getRows($sql, $params);
    }
        /*
        *Metodo para actualizar chaleco
        */
    public function updateRow()
    {
        $sql = 'UPDATE tb_chaleco
        SET costo_cheleco = ?, cantidad_chlecos = ?, id_colorchaleco = ?, talla_chaleco = ?
        WHERE id_chaleco = ?';
        $params = array($this->costo_chaleco, $this->cantidad_chalecos, $this->id_colorchaleco,$this->talla_chaleco,$this->id_chaleco);
        return Database::executeRow($sql, $params);
    }
        /*
        *Metodo para eliminar un chaleco
        */
    public function deleteRow()
    {
        $sql = 'DELETE FROM tb_chaleco
        WhERE id_chaleco =?';
        $params = array ($this->id_chaleco);
        return Database::executeRow($sql, $params);
    }
}