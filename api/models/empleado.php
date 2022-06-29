<?php
/*
*	Clase para manejar la tabla usuarios de la base de datos.
*   Es clase hija de Validator.
*/
class Empleados extends Validator
{
    // Declaración de atributos (propiedades).
    private $id_empleado = null;
    private $nombre_empleado = null;
    private $apellido_empleado = null;
    private $DUI_empleado = null;
    private $celular_empleado = null;
    private $correo_empleado = null;
    private $clave = null;
    private $foto_empleado = null;
    private $tipo_empleado = null;
    private $ruta = '../imagenes/empleado/';

    /*
    *   Métodos para validar y asignar valores de los atributos.
    */
    public function setId($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->id_empleado = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setNombre($value)
    {
        if ($this->validateAlphabetic($value, 1, 50)) {
            $this->nombre_empleado = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setApellido($value)
    {
        if ($this->validateAlphabetic($value, 1, 50)) {
            $this->apellido_empleado = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setDUI($value)
    {
        if ($this->validateDUI($value)) {
            $this->DUI_empleado = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setCelular($value)
    {
        if ($this->validatePhone($value)) {
            $this->celular_empleado = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setCorreo($value)
    {
        if ($this->validateEmail($value)) {
            $this->correo_empleado = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setClave($value)
    {
        if ($this->validatePassword($value)) {
            $this->clave = password_hash($value, PASSWORD_DEFAULT);
            return true;
        } else {
            return false;
        }
    }

    public function setFoto($file)
    {
        if ($this->validateImageFile($file,800,800)) {
            $this->foto_empleado = $this->getFileName();
            return true;
        } else {
            return false;
        }
    }

    public function setTipo($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->tipo_empleado = $value;
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
        return $this->id_empleado;
    }

    public function getNombre()
    {
        return $this->nombre_empleado;
    }

    public function getApellido()
    {
        return $this->apellido_empleado;
    }

    public function getDUI()
    {
        return $this->DUI_empleado;
    }    

    public function getCelular()
    {
        return $this->celular_empleado;
    }

    public function getCorreo()
    {
        return $this->correo_empleado;
    }

    public function getClave()
    {
        return $this->clave;
    }

    public function getFoto()
    {
        return $this->foto_empleado;
    }
    
    public function getTipo()
    {
        return $this->tipo_empleado;
    }

    public function getRuta()
    {
        return $this->ruta;
    }

    /*
    *   Métodos para gestionar la cuenta del usuario.
    */

    /*-------------Método para proporcionar el id del empleado.-------------*/
    public function checkUser($correo_empleado)
    {
        $sql = 'SELECT id_empleado FROM tb_empleado WHERE correo_empleado = ?';
        $params = array($correo_empleado);
        if ($data = Database::getRow($sql, $params)) {
            $this->id_empleado = $data['id_empleado'];
            $this->correo_empleado = $correo_empleado;
            return true;
        } else {
            return false;
        }
    }

    /*-------------Método para proporcionar el nombre y foto del empleado.-------------*/
    public function readUserName($correo_empleado)
    {
        $sql = 'SELECT nombre_empleado, apellido_empleado, foto_empleado
                FROM tb_empleado
                WHERE correo_empleado = ?';
        $params = array($this->correo_empleado);
        if ($data = Database::getRow($sql, $params)) {
            $this->nombre_empleado = $data['nombre_empleado'];
            $this->apellido_empleado = $data['apellido_empleado'];
            $this->foto_empleado = $data['foto_empleado'];
            $this->correo_empleado = $correo_empleado;
            return true;
        } else {
            return false;
        }
    }

    /*-------------Método para proporcionar el rol o tipo de empleado.-------------*/
    public function readUserRol($correo_empleado)
    {
        $sql = 'SELECT tb_te.tipoempleado
                FROM  "tb_tipoEmpleado" tb_te, tb_empleado tb_e 
                WHERE tb_te.id_tipoempleado=tb_e.id_tipoempleado AND tb_e.correo_empleado= ?';
        $params = array($this->correo_empleado);
        if ($data = Database::getRow($sql, $params)) {
            $this->tipo_empleado = $data['tipoempleado'];
            $this->correo_empleado = $correo_empleado;
            return true;
        } else {
            return false;
        }
    }

    public function checkPassword($password)
    {
        $sql = 'SELECT contrasena_empleado FROM tb_empleado WHERE id_empleado = ?';
        $params = array($this->id_empleado);
        $data = Database::getRow($sql, $params);
        // Se verifica si la contraseña coincide con el hash almacenado en la base de datos.
        if (password_verify($password, $data['contrasena_empleado'])) {
            return true;
        } else {
            return false;
        }
    }

    public function changePassword()
    {
        $sql = 'UPDATE tb_empleado SET clave_empleado = ? WHERE id_empleado = ?';
        $params = array($this->clave, $_SESSION['id_empleado']);
        return Database::executeRow($sql, $params);
    }

    public function readProfile()
    {
        $sql = 'SELECT id_empleado, nombres_empleado, apellido_empleado, "DUI", direccion_empleado, codigo_empleado, tipo_empleado, foto_empleado
                FROM tb_empleado
                WHERE id_empleado = ?';
        $params = array($_SESSION['id_empleado']);
        return Database::getRow($sql, $params);
    }

    public function editProfile()
    {
        $sql = 'UPDATE tb_empleado
                SET nombre_empleado = ?, apellido_empleado = ?, "DUI" = ?, direccion_empleado = ?, codigo_empleado = ?, tipo_empleado = ?
                WHERE id_empleado = ?';
        $params = array($this->nombre_empleado, $this->apellido_empleado, $this->DUI_empleado, $this->direccion_empleado, $this->codigo_empleado, $this->tipo_empleado, $_SESSION['id_empleado']);
        return Database::executeRow($sql, $params);
    }

    /*
    *   Métodos para realizar las operaciones SCRUD (search, create, read, update, delete).
    */
    /*-------------Método para buscar el nombre y apellido del empleado.-------------*/
    public function searchRows($value)
    {
        $sql = 'SELECT id_empleado, nombre_empleado, apellido_empleado, dui_empleado, celular_empleado, correo_empleado, contrasena_empleado, foto_empleado, tb_te.tipoempleado AS tipo_empleado
                FROM tb_empleado tb_e
                INNER JOIN "tb_tipoEmpleado" tb_te ON tb_e.id_tipoempleado=tb_te.id_tipoempleado
                WHERE apellido_empleado ILIKE ? OR nombre_empleado ILIKE ? OR correo_empleado ILIKE ? OR tipoempleado ILIKE ?';
        $params = array("%$value%", "%$value%", "%$value%", "%$value%");
        return Database::getRows($sql, $params);
    }
    /*-------------Método para buscar el celular del empleado.-------------*/
    public function searchCelular($value)
    {
        $sql = 'SELECT id_empleado, nombre_empleado, apellido_empleado, dui_empleado, celular_empleado, correo_empleado, contrasena_empleado, foto_empleado, tb_te.tipoempleado AS tipo_empleado
                FROM tb_empleado tb_e
                INNER JOIN "tb_tipoEmpleado" tb_te ON tb_e.id_tipoempleado=tb_te.id_tipoempleado
                WHERE celular_empleado ILIKE ?';
        $params = array("%$value%");
        return Database::getRows($sql, $params);
    }
    /*-------------Método para buscar el DUI del empleado.-------------*/
    public function searchDui($value)
    {
        $sql = 'SELECT id_empleado, nombre_empleado, apellido_empleado, dui_empleado, celular_empleado, correo_empleado, contrasena_empleado, foto_empleado, tb_te.tipoempleado AS tipo_empleado
                FROM tb_empleado tb_e
                INNER JOIN "tb_tipoEmpleado" tb_te ON tb_e.id_tipoempleado=tb_te.id_tipoempleado
                WHERE dui_empleado ILIKE ?';
        $params = array("%$value%");
        return Database::getRows($sql, $params);
    }
    /*----------------Método para el primer uso--------------------*/
    public function primerUso()
    {   
        //Se asigna una imagen predeterminada        
        $this->foto_empleado = '1.png';
        $sql = 'INSERT INTO tb_empleado(nombre_empleado, apellido_empleado, dui_empleado, celular_empleado, correo_empleado, contrasena_empleado, foto_empleado, id_tipoempleado)
           VALUES ( ?, ?, ?, ?, ?, ?, ?, ?)';
        $params = array($this->nombre_empleado, $this->apellido_empleado, $this->DUI_empleado, $this->celular_empleado, $this->correo_empleado, $this->clave, $this->foto_empleado, $this->tipo_empleado);                
        return Database::executeRow($sql, $params);
    }
    /*----------------Método para crear empleados--------------------*/
    public function createRow()
    {           
        $sql = 'INSERT INTO tb_empleado(nombre_empleado, apellido_empleado, dui_empleado, celular_empleado, correo_empleado, contrasena_empleado, foto_empleado, id_tipoempleado)
           VALUES ( ?, ?, ?, ?, ?, ?, ?, ?)';
        $params = array($this->nombre_empleado, $this->apellido_empleado, $this->DUI_empleado, $this->celular_empleado, $this->correo_empleado, $this->clave, $this->foto_empleado, $this->tipo_empleado);                
        return Database::executeRow($sql, $params);
    }
    /*-------------Método para buscar empleados-----------*/
    public function readAll()
    {
        $sql = 'SELECT id_empleado, nombre_empleado, apellido_empleado, dui_empleado, celular_empleado, correo_empleado, contrasena_empleado, foto_empleado, tb_te.tipoempleado AS tipo_empleado
                FROM tb_empleado tb_e
                INNER JOIN "tb_tipoEmpleado" tb_te ON tb_e.id_tipoempleado=tb_te.id_tipoempleado
                ORDER BY id_empleado';
        $params = null;
        return Database::getRows($sql, $params);
    }
    /*-------------Método para buscar el prefil de un empleado-----------*/
    public function readOne()
    {
        $sql = 'SELECT id_empleado, nombre_empleado, apellido_empleado, dui_empleado, celular_empleado, correo_empleado, contrasena_empleado, foto_empleado, tb_te.tipoempleado AS tipo_empleado
                FROM tb_empleado tb_e
                INNER JOIN "tb_tipoEmpleado" tb_te ON tb_e.id_tipoempleado=tb_te.id_tipoempleado
                WHERE id_empleado = ?';
        $params = array($this->id_empleado);
        return Database::getRow($sql, $params);
    }
/*-------------Método para actualizar el prefil de un empleado-----------*/
    public function updateRow($foto_imagen)
    {
        // Se verifica si la imagen que existe no es la default, para no eliminarla
        if(!$foto_imagen=='1.png'){
            // Se verifica si existe una nueva imagen para borrar la actual, de lo contrario se mantiene la actual.
            ($this->foto_empleado) ? $this->deleteFile($this->getRuta(), $foto_imagen) : $this->foto_empleado = $foto_imagen;
        }else{
            $this->foto_empleado = $foto_imagen;
        }
        

        $sql = 'UPDATE tb_empleado 
                SET nombre_empleado=?, apellido_empleado=?, dui_empleado=?, correo_empleado=?, id_tipoempleado=?, celular_empleado=?, foto_empleado=?
	            WHERE id_empleado = ?';
        $params = array($this->nombre_empleado, $this->apellido_empleado, $this->DUI_empleado, $this->correo_empleado, $this->tipo_empleado, $this->celular_empleado, $this->foto_empleado, $this->id_empleado);
        return Database::executeRow($sql, $params);
    }

    public function deleteRow()
    {
        $sql = 'DELETE FROM tb_empleado
                WHERE id_empleado = ?';
        $params = array($this->id_empleado);
        return Database::executeRow($sql, $params);
    }
}
