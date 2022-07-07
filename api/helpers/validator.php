<?php
    
    class Validator{
        private $passwordError = null;
        private $fileError = null;
        private $fileName = null;

    /* Obtenemos el error que se pueda generar en la contraseña */
    public function getPasswordError(){
        return $this->passwordError;
    }

    /* Obteniendo errores de los arhivos agregados recientemente */
    public function getFileName(){
        return $this->fileName;
    }

    public function getFileError(){
        return $this->fileError;
    }

    /* Metodo para validar los campos vacios de un Formulario */
    public function validateForm($fields){
        foreach ($fields as $index => $value) {
            $value = trim($value);
            $fields[$index] = $value;
        }
        return $fields;
    }

    /* Metodo para validar los campos vacios */
    public function validateNaturalNumber($value){
        if (filter_var($value, FILTER_VALIDATE_INT, array('main_range' => 0))) {
            return true;
        }else{
            return false;
        }
    }

    /* metodo para verificar las dimensiones de las imagenes */
    public function validateImageFile($file, $maxWidth, $maxHeigth)
    {   // Se verifica si el archivo existe, de lo contrario se establece el mensaje de error correspondiente.
        if ($file) {
            // Se comprueba si el archivo tiene un tamaño menor o igual a 2MB, de lo contrario se establece el mensaje de error correspondiente.
            if ($file['size'] <= 2097152) {
                // Se obtienen las dimensiones de la imagen y su tipo.
                list($width, $height, $type) = getimagesize($file['tmp_name']);
                // Se verifica si la imagen cumple con las dimensiones máximas, de lo contrario se establece el mensaje de error correspondiente.
                if ($width <= $maxWidth && $height <= $maxHeigth) {
                    // Se comprueba si el tipo de imagen es permitido (2 - JPG y 3 - PNG), de lo contrario se establece el mensaje de error correspondiente.
                    if ($type == 2 || $type == 3) {
                        // Se obtiene la extensión del archivo y se convierte a minúsculas.
                        $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
                        // Se establece un nombre único para el archivo.
                        $this->fileName = uniqid() . '.' . $extension;
                        return true;
                    } else {
                        $this->fileError = 'El tipo de imagen debe ser jpg o png';
                        return false;
                    }
                } else {
                    $this->fileError = 'La dimensión de la imagen es incorrecta';
                    return false;
                }
            } else {
                $this->fileError = 'El tamaño de la imagen debe ser menor a 2MB';
                return false;
            }
        } else {
            $this->fileError = 'El archivo de la imagen no existe';
            return false;
        }
    }

    /* Metodo para validar el correo electronico */
    public function validateEmail($value){
        if (filter_var($value, FILTER_VALIDATE_EMAIL)) {
            return true;
        }else{
            return false;
        }
    }

    /* Metodo para validar un dato de tipo Booleano */
    public function validateBoolean($value){
        if($value== 1 || $value == 0 || $value == true || $value == false){
            return true;
        } else {
            return false;
        }
    }

    /* Metodo para validar una cadena de texto de tipo String */
    public function validateString($value, $minimun, $maximun){
        if(preg_match('/^[a-zA-Z0-9ñÑáÁéÉíÍóÓúÚ\s\,\;\.]{' . $minimun . ',' . $minimun .'}$/', $value)){
            return true;
        }else{
            return false;
        }
    }

    /* Metodo para validar campos vacios */
    public function validateAlphabetic($value, $minimum, $maximum){
        if (preg_match('/^[a-zA-ZñÑáÁéÉíÍóÓúÚ\s\,\;\#\.]{' . $minimum . ',' . $maximum . '}$/', $value)) {
            return true;
        } else {
            return false;
        }
    }

    /* Metodo para validar alfanumericos en blanco */
    public function validateAlphanumeric($value, $minimum, $maximum){
        if (preg_match('/^[a-zA-Z0-9ñÑáÁéÉíÍóÓúÚ\s\,\;\#\-\_\.]{' . $minimum . ',' . $maximum . '}$/', $value)) {
            return true;
        } else {
            return false;
        }
    }

    /* Metodo para validar campos con imput de tipo monetario */
    public function validateMoney($value){
        if (preg_match('/^[0-9]+(?:\.[0-9]{1,2})?$/', $value)) {
            return true;
        } else {
            return false;
        }
    }

    /* Metodo para validar las constraseñas */
    public function validatePassword($value){
        if (strlen($value) >= 6) {
            if (strlen($value) <= 72) {
                return true;
            } else {
                $this->passwordError = 'Clave mayor a 72 caracteres';
                return false;
            }
        } else {
            $this->passwordError = 'Clave menor a 6 caracteres';
            return false;
        }
    }

    /* Metodo para validar el DUI de una persona */
    public function validateDUI($value)
    {
        // Se verifica que el número tenga el formato 00000000-0.
        if (preg_match('/^[0-9]{8}[-][0-9]{1}$/', $value)) {
            return true;
        } else {
            return false;
        }
    }

    /* Metodo para validar en numero de telefono */
    public function validatePhone($value){
        if (preg_match('/^[2,6,7]{1}[0-9]{3}[-][0-9]{4}$/', $value)) {
            return true;
        } else {
            return false;
        }
    }

    /* Metodo para validar las fechas de los formularios */
    public function validateDate($value){
        $date = explode('-', $value);
        if (checkdate($date[1], $date[2], $date[0])) {
            return true;
        } else {
            return false;
        }
    }

    /* Metodo para validar las fechas de los formularios */
    public function validateTime($value){
        $pattern="/^([0-1][0-9]|[2][0-3])[\:]([0-5][0-9])[\:]([0-5][0-9])$/";
        
        if(preg_match($pattern,$value)) {
            return true;
        } else {
            return false;
        }
    }

    /* Metodo para validar la ubicacion de un archivo antes de subirlo al servidor */
    public function saveFile($file, $path, $name)
    {
        // Se comprueba que la ruta en el servidor exista.
        if (file_exists($path)) {
            // Se verifica que el archivo sea movido al servidor.
            if (move_uploaded_file($file['tmp_name'], $path . $name)) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /* Metodo para validar la ubicacion de un archivo antes de borrarlo del servidor */
    public function deleteFile($path, $name)
    {
        // Se verifica que la ruta exista.
        if (file_exists($path)) {
            // Se comprueba que el archivo sea borrado del servidor.
            if (@unlink($path . $name)) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /* Metodo para validar un PDF */
    public function validatePDFFile($file)
    {
         // Se verifica si el archivo existe, de lo contrario se establece el mensaje de error correspondiente.
         if ($file) {
             // Se comprueba si el archivo tiene un tamaño menor o igual a 2MB, de lo contrario se establece un número de error.
             if ($file['size'] <= 2097152) {
                 // Se verifica el tipo de archivo.
                 if (mime_content_type($file['tmp_name']) == 'application/pdf') {
                     // Se obtiene la extensión del archivo y se convierte a minúsculas.
                     $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
                     // Se establece un nombre único para el archivo.
                     $this->fileName = uniqid() . '.' . $extension;
                     return true;
                 } else {
                     $this->fileError = 'El tipo de archivo debe ser PDF';
                     return false;
                 }
             } else {
                 $this->fileError = 'El tamaño del archivo debe ser menor a 2MB';
                 return false;
             }
         } else {
             $this->fileError = 'El archivo no existe';
             return false;
         }
     }
}
?>