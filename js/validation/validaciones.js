const formulario = document.getElementById('formulario');
const inputs = document.querySelectorAll("#formulario input");

//Expresiones reguklares para la validación de un formulario
const expresiones = {
	usuario: /^[a-zA-Z0-9\_\-]{4,16}$/, // Letras, numeros, guion y guion_bajo
	nombre: /^[a-zA-ZÀ-ÿ\s]{4,10}$/, // Letras y espacios, pueden llevar acentos.
	apellido: /^[a-zA-ZÀ-ÿ\s]{4,15}$/, // Letras y espacios, pueden llevar acentos.
	password: /^.{4,12}$/, // 4 a 12 digitos.
	documento: /^[a-zA-Z0-9\-]{4,16}$/,
	correo: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/,
	telefono: /^[0-9\-]{4,16}$/, // 7 a 14 numeros.
};

//Objeto para validar si el campo está vaío
const campos = {
	usuario: false,
	nombre: false,
	apellido: false,
	password: false,
	documento: false,
	correo: false,
	telefono: false,
};

//Función para validar el formulario
const validarForm = (e) => {
  switch (e.target.name) {
   case "usuario":
      validarCampo(expresiones.usuario, e.target, e.target.name);
      break;
   case "nombre":
      validarCampo(expresiones.nombre, e.target, e.target.name);
      break;
   case 'apellido':
      validarCampo(expresiones.apellido, e.target, e.target.name)
    	break;
   case "password":
      validarCampo(expresiones.password, e.target, e.target.name);
      validarPassword2();
      break;
   case "password2":
      validarPassword2();
      break;
   case 'documento':
		validarCampo(expresiones.documento, e.target, e.target.name)
	break;
   case "correo":
      validarCampo(expresiones.correo, e.target, e.target.name);
      break;
   case "telefono":
      validarCampo(expresiones.telefono, e.target, e.target.name);
      break;

    default:
		// Nada por defecto todo ha sido validado
      break;
  }
};

	/* Función para validar los campos, se usan como parámetros 'expresion' para recorrer las 
		exprpesiones reguales que están definidas arriba, 'input' para reconocer a cual nos referenciamos
		y campo para obtener el nombre del imput en especifico */

const validarCampo = (expresion, input, campo) => {
  	if (expresion.test(input.value)) {
		document.getElementById(`grupo__${campo}`).classList.remove("formulario__grupo-incorrecto");
		document.getElementById(`grupo__${campo}`).classList.add("formulario__grupo-correcto");
		document.querySelector(`#grupo__${campo} i`).classList.add("fa-circle-check");
		document.querySelector(`#grupo__${campo} i`).classList.remove("fa-circle-xmark");
		document.querySelector(`#grupo__${campo} .formulario__input-error`).classList.remove("formulario__input-error-activo");
		campos [campo] = true;
  	} else {
		document.getElementById(`grupo__${campo}`).classList.add("formulario__grupo-incorrecto");
		document.getElementById(`grupo__${campo}`).classList.remove("formulario__grupo-correcto");
		document.querySelector(`#grupo__${campo} i`).classList.add("fa-circle-xmark");
		document.querySelector(`#grupo__${campo} i`).classList.remove("fa-circle-check");
		document.querySelector(`#grupo__${campo} .formulario__input-error`).classList.add("formulario__input-error-activo");
		campos [campo] = false;
  }
};

//Función para validar que las contraseñas sean iguales
const validarPassword2 = () => {
	const inputPassword1 = document.getElementById("password");
	const inputPassword2 = document.getElementById("password2");

  	if (inputPassword1.value !== inputPassword2.value) {
		document.getElementById(`grupo__password2`).classList.add("formulario__grupo-incorrecto");
		document.getElementById(`grupo__password2`).classList.remove("formulario__grupo-correcto");
		document.querySelector(`#grupo__password2 i`).classList.add("fa-circle-xmark");
		document.querySelector(`#grupo__password2 i`).classList.remove("fa-circle-check");
		document.querySelector(`#grupo__password2 .formulario__input-error`).classList.add("formulario__input-error-activo");
	 campos ['password'] = false;
  	} else {
		document.getElementById(`grupo__password2`).classList.remove("formulario__grupo-incorrecto");
		document.getElementById(`grupo__password2`).classList.add("formulario__grupo-correcto");
		document.querySelector(`#grupo__password2 i`).classList.add("fa-circle-check");
		document.querySelector(`#grupo__password2 i`).classList.remove("fa-circle-xmark");
		document.querySelector(`#grupo__password2 .formulario__input-error`).classList.remove("formulario__input-error-activo");
		campos ['password'] = true;
  }
};

//Función para validar que se ha dejado de presionar una tecla
inputs.forEach((input) => {
	input.addEventListener("keyup", validarForm);
	input.addEventListener("blur", validarForm);
});

//Cargamos los eeventos que van directo al sitio
formulario.addEventListener('submit', (e) => {
  	e.preventDefault();
  	//Accediendo al elemento terminos para validarlo
	const terminos = document.getElementById('terminos');
  	if (campos.nombre && campos.apellido && campos.documento &&campos.password, campos.correo, campos.telefono && terminos.checked) {
		formulario.reset();

		document.getElementById('formulario__mensaje-exito').classList.add('formulario__mensaje-exito-activo');

		//Eliminamos la clase
		setTimeout(() => {
			document.getElementById('formulario__mensaje-exito').classList.remove('formulario__mensaje-exito-activo');
		}, 5000);

		//Eliminamos los íconos
		document.querySelectorAll('.formulario__grupo-correcto').forEach((icono) => {
			icono.classList.remove("formulario__grupo-correcto");
		});
  	} else {
		document.getElementById('formulario__mensaje').classList.add('formulario__mensaje-activo');
		setTimeout(() => {
			document.getElementById('formulario__mensaje').classList.remove('formulario__mensaje-activo');
		}, 2000);
	}
});
