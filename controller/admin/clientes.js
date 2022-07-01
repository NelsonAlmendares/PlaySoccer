//Constante para establecer las ruta y parámetros de la comunicación con la API
const API_CLIENTES = SERVER + 'admin/clientes.php?action=';

var modal = new bootstrap.Modal(document.getElementById('modal-cliente'), {
	keyboard: false
})

// Método manejador de eventos
document.addEventListener('DOMContentLoaded', function () {
   // Llamamos a la función para obtner los registros
   readRows(API_CLIENTES);
   // Variable para establecer las opciones del modal
   let options = {
      dismissible: false,
      onOpenStart: function () {
         document.getElementById('save-form').reset();
      }
   }
});

	// Funión para llenar la tabla con los datos de los registros
	function fillTable (dataset) {
   	let content = '';
    	// Se recorre el registro con el 'dataset' fila por fila
    	dataset.map (function (row){
      	content += `
         	<tr>
				<th scope="row" class="text-center"> ${row.id} </th>
				<td class="text-center"><img src=" ${SERVER}imagenes/clientes/${row.foto}" class="img-fluid perfiles" alt=""></td>
				<td class="text-center"> ${row.nombre} </td>
				<td class="text-center"> ${row.apellido} </td>
				<td class="text-center"> ${row.documento} </td> 
				<td class="text-center"> <b>+530</b> ${row.celular} </td>
				<td class="text-center"> ${row.correo} </td>
				<td class="text-center">
					<button class="btn btn-outline-info" onclick="openUpdate(${row.id})"><i class="fa-solid fa-pen-to-square"></i></button>
					<button class="btn btn-outline-danger" onclick="openDelete(${row.id})"><i class="fa-solid fa-eraser"></i></button>
				</td>
			</tr>
        `;
   });
	// Agregamos las filas al cuerpo de la tabla
	document.getElementById("table__cliente").innerHTML = content;
}

//Funcion para la busqeda de los formularios
document.getElementById('search-form').addEventListener('submit', function (event) {
	//Evitamos la carga del sitio
    event.preventDefault();
	//Llamomos a la funcion para la realizar la buqueda de los fomularios
	searchRows(API_CLIENTES, 'search-form');
  });

// Funcion oara iniciar el modal para agregar un cliente
function openCreate () {
	modal.show();
	document.getElementById('modal-title').textContent = 'Agregar un cliente';
	//Desabilitamos los input de id
	document.getElementById('id').disabled = true;
	document.getElementById('id').hidden = true;
	document.getElementById('id-cliente').hidden = true;
	// Ocultamos los campos de foto
	document.getElementById('foto').hidden = true;
	document.getElementById('foto').disabled = true;
	document.getElementById('foto_cliente').hidden = true;
	document.getElementById('foto_cliente').disabled = true;
	//Se muestran los campos de contraseña
	document.getElementById('password').hidden = false;
	document.getElementById('password').disabled = false;
}

function openUpdate (id) {
	// Mostramos el modal
	modal.show();
	// Asignamos el nombre del modal
	document.getElementById('modal-title').textContent = 'Actualizar usuario de cliente';
	// Desahabiliamos los campos del ID del cliente
	document.getElementById('id').hidden = false;
  	document.getElementById('id').disabled = false;
  	document.getElementById('id-cliente').hidden = false;
	//Mostramos los campos correspondientes
	document.getElementById('foto').hidden = false;
  	document.getElementById('foto').disabled = false;
  	document.getElementById('foto_cliente').hidden = false;
  	document.getElementById('foto_cliente').disabled = false;
	// mostramos campos correspondientes a la constaseña
	document.getElementById('password2').hidden = true;
  	document.getElementById('password2').disabled = true;
	// Mostramos los campos necesarios para la contaseña
	document.getElementById('password').disabled = true;

	const data = new FormData();
	data.append('id', id);

	fetch(API_CLIENTES + 'readOne', {
		method: 'post',
		body: data
	}).then(function (request) {
		if (request.ok) {
			request.json().then(function (response) {
				if (response.status) {
					document.getElementById('id').value = response.dataset.id;
					document.getElementById('nombre').value = response.dataset.nombre;
					document.getElementById('apellido').value = response.dataset.apellido;
					document.getElementById('documento').value = response.dataset.documento;
					document.getElementById('email').value = response.dataset.correo;
					document.getElementById('celular').value = response.dataset.celular;
					document.getElementById('password').value = response.dataset.password;
        		} else {
					sweetAlert(2, response.exception, null);
				}
			});
		} else {
			console.log(request.status + " " + request.statusText);
		}
	});
}

function openDelete (id) {
	// Se define el objeto con los datos del registro que se ha seleccionado
	const data = new FormData();
	data.append('id', id);
	//Se llama a la función para la confirmación
	confirmDelete(API_CLIENTES, data);
}

// Función para guardar los registros
document.getElementById('save-form').addEventListener('submit', function (event){
	
	// Evitamos la carga del sitio
	event.preventDefault();
	// Se define la variable para la acción a realizar
	let action;

	// Se comprueba según el campo oculto
	if (document.getElementById('id').disabled==true) {
		action = 'create';
	} else if (document.getElementById('id').disabled == false) {
		action = 'update';
	}

	// llamamos a la función para guardar los datos
	saveRow(API_CLIENTES, action, 'save-form');
	cleanModal();
	modal.hide();

});

function cleanModal () {
	$("#nombre").val('');
	$("#apellido").val('');
	$("#documento").val('');
	$("#celular").val('');
	$("#email").val('');
	$("#foto").val('');
	$("#clave").val('');
	$("#confirmar").val("");
}