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

   // Inicializamos el modal
   Modal.init(document.querySelectorAll('.modal'), options);
});

	// Funión para llenar la tabla con los datos de los registros
	function fillTable (dataset) {
   	let content = '';
    	// Se recorre el registro con el 'dataset' fila por fila
    	dataset.map (function (row){
      	content += `
         	<tr>
				<th scope="row" class="text-center"> ${row.id} </th>
				<td class="text-center"><img src=" ${SERVER}images/clientes/${row.foto}" class="img-fluid perfiles" alt=""></td>
				<td class="text-center"> ${row.nombre} </td>
				<td class="text-center"> ${row.apellido} </td>
				<td class="text-center"> ${row.docuemento} </td> 
				<td class="text-center"> <b>+530</b> ${row.celular} </td>
				<td class="text-center"> ${row.correo} </td>
				<td class="text-center">
					<button class="btn btn-outline-info" onclick="${row.id}"><i class="fa-solid fa-pen-to-square"></i></button>
					<button class="btn btn-outline-danger" onclick="${row.id}"><i class="fa-solid fa-eraser"></i></button>
				</td>
			</tr>
        `;
   });
	// Agregamos las filas al cuerpo de la tabla
	document.getElementById("table__cliente").innerHTML = content;
}

//Funcion para la busqeda de los formularios
document
  .getElementById("search-form").addEventListener("submit", function (event) {
	//Evitamos la carga del sitio
    event.preventDefault();
	//Llamomos a la funcion para la realizar la buqueda de los fomularios
	searchRows(API_CLIENTES, 'search-form');
  });

// Funcion oara iniciar el modal para agregar un cliente
function openCreate () {
	modal.show();
	document.getElementById('modal-title').textContent = 'Agregar un cliente';
	document.getElementById('id').disable = true;
	document.getElementById('id').hidden = true;
	document.getElementById('id-cliente').hidden = true;
}

function openUpdate (id) {
	modal.show();
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
	if (document.getElementById('id').disabled == true) {
		action = 'create';
	} else if (document.getElementById('id').disabled == true) {
		action = 'update';
	}

	// llamamos a la función para guardar los datos
	saveRow(API_CLIENTES, action, 'sava-form');
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