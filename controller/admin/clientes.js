//Constante para establecer las ruta y parámetros de la comunicación con la API
const API_CLIENTES = SERVER + 'admin/clientes.php?action=';

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
					<button class="btn btn-outline-info"><i class="fa-solid fa-pen-to-square"></i></button>
					<button class="btn btn-outline-danger"><i class="fa-solid fa-eraser"></i></button>
				</td>
			</tr>
        `;
   });

	// Agregamos las filas al cuerpo de la tabla
	document.getElementById("table__cliente").innerHTML = content;
}

// Método para manejar los evento para el buscador
// document.getElementById('search-form').addEventListener('submit', function (event) {
// 	event.preventDefault();
// 	// Llamamos a la función encargada
// 	searchRows(API_CLIENTES, 'search-form');
// });

function openCreate () {
	Modal.getInstance(document.getElementById('save-modal').open());
}