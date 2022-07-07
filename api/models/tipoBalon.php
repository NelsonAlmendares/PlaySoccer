<?php
/*select costo_balon, cantidadad_balones, tamano_balon 
*from public."tb_tipoBalon" tb INNER JOIN public."tb_tamanoBalon" tm ON tb.id_tamanoBalon = tm.id_tamanoBalon
*/
class Tipo extends Validator
{
    private $id_tipobalon = null;
    private $costo_balon = null;
    private $cantidad_balones = null;
    private $id_tamanobalon = null;

    public function setId($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->id_tipobalon = $value;
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

    public function setTamano($value)
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
        return $this->id_tipobalon;
    }
    public function getCosto()
    {
        return $this->costo_balon;
    }
    public function getCantidad()
    {
        return $this->cantidad_balones;
    }
    public function getTamano()
    {
        return $this->id_tamanobalon;
    }

    public function searchRows($value)
    {
        $sql = 'SELECT id_tipobalon, costo_balon, cantidadad_balones, tm.tamano_balon AS tamano_balon
        from public."tb_tipoBalon" tb INNER JOIN public."tb_tamanoBalon" tm ON tb.id_tamanoBalon = tm.id_tamanoBalon
        where tamano_balon ILIKE ? 
        ORDER BY costo_balon';
        $params = array("%$value%");
        return Database::getRows($sql, $params);
    }
    public function createRow()
    {
        $sql = 'INSERT INTO "tb_tipoBalon"(costo_balon,cantidadad_balones, id_tamanobalon)
        VALUES(?,?,?)';
        $params = array($this->costo_balon, $this->cantidad_balones,$this->id_tamanobalon);
        return Database::executeRow($sql, $params);
    }
    public function readAll()
    {
        $sql = 'SELECT id_tipobalon, costo_balon, cantidadad_balones, tm.tamano_balon AS tamano_balon
        from public."tb_tipoBalon" tb INNER JOIN public."tb_tamanoBalon" tm ON tb.id_tamanoBalon = tm.id_tamanoBalon
        order by id_tipobalon';
        $params = null;
        return Database::getRows($sql, $params);
    }
    public function readOne()
    {
        $sql = 'SELECT id_tipobalon, costo_balon, cantidadad_balones, tm.tamano_balon AS tamano_balon
        from public."tb_tipoBalon" tb INNER JOIN public."tb_tamanoBalon" tm ON tb.id_tamanoBalon = tm.id_tamanoBalon
        WHERE id_tipobalon = ?';
        $params = array($this->id_tipobalon);
        return Database::getRow($sql, $params);
    }
    public function updateRow()
    {
        $sql = 'UPDATE "tb_tipoBalon" SET costo_balon = ?, cantidad_balones = ?, id_tamanobalon = ? WHERE id_tipobalon = ?';
        $params = array($this->costo_balon, $this->cantidad_balones, $this->id_tamanobalon, $this->id_tipobalon);
        return Database::executeRow($sql, $params);
    }
    public function deleteRow()
    {
        $sql = 'DELETE FROM "tb_tipoBalon" where id_tipobalon = ?';
        $params = array($this->id_tipobalon);
        return Database::executeRow($sql, $params);
    }
}