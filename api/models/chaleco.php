<?php
/*
*clase para manejar la tabla chalecos de la bd
*clase hija de validator
*/
class chalecos extends Validator
{
    /*
    *Se declaran loa atributos (propiedades)
    */
    private $id_chaleco = null;
    private $costo_chaleco = null;
    private $cantidad_chlecos = null;
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
        $this->costo_chaleco = null;
        return true;
      }else{
         return false;  
     }
    }
    public function setCantidad($value)
    {
       if ($this->validateNaturalNumber($value)) {
        $this->cantidad_chlecos = null;
        return true;
      }else{
         return false;  
     }
    }
    public function setIdcolorchaleco($value)
    {
       if ($this->validateNaturalNumber($value)) {
        $this->id_colorchaleco = null;
        return true;
      }else{
         return false;  
     }
    }
    public function setTalla($value)
    {
       if ($this->validateNaturalNumber($value)) {
        $this->talla_chaleco = null;
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
        return $this->cantidad_chlecos;
    }
    public function getIdcolorchaleco()
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
        $sql = 'SELECT id_chaleco, costo_chaleco,cantidad_chlecos,colorchaleco,talla_chaleco
        FROM tb_chaleco INNER JOIN tb_colorChaleco USING(id_categoria)
        where costo_chaleco ILIKE ? OR talla_chaleco ILIKE ?
        ORDER BY costo_chaleco';
         $params = array("%$value%", "%$value%");
         return Database::getRows($sql, $params);
    }
        /*
        *Metodo para crear 
        */
    public function createRow()
    {
        $sql = 'INSERT INTO tb_chaleco(costo_chaleco,cantidad_chlecos,id_colorchaleco, talla_chaleco)
        VALUES(?,?,?,?)';
        $params = array($this->costo_chaleco, $this->cantidad_chlecos,$this->id_colorchaleco, $this->talla_chaleco);
        return Database::executeRow($sql,$params);
    }
        /*
        *Metodo para leer el contendio de la tabla 
        */
    public function readAll()
    {
        $sql = 'SELECT id_chaleco, costo_chaleco,cantidad_chlecos,colorchaleco,talla_chaleco
        FROM tb_chaleco INNER JOIN tb_colorChaleco USING(id_categoria)
        ORDER BY costo_chaleco';
        $params = null;
        return Database::getRows($sql, $params);
    }
        /*
        *MEtodo para leer un dato(lo vamos a usar en el metodo de actualizar ya en la API.)
        */
    public function readOne()
    {
        $sql = 'SELECT id_chaleco, costo_chaleco,cantidad_chlecos,id_colorchaleco,talla_chaleco
        FROM tb_chaleco
        WHERE id_chaleco = ?';
        $params = array($this->id_chaleco);
        return Database::getRow($sql, $params);
    }
        /*
        *Metodo para actualizar chaleco
        */
    public function updateRow()
    {
        $sql = 'UPDATE tb_chaleco
        SET costo_chaleco = ?, cantidad_chlecos = ?, id_colorchaleco = ?, talla_chaleco = ?
        WHERE id_chaleco = ?';
        $params = array($this->costo_chaleco, $this->cantidad_chlecos, $this->id_colorchaleco,$this->talla_chaleco,$this->id_chaleco);
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