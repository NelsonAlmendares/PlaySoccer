// Constante para establecer la ruta y parámetros de comunicación con la API.
const API_TIPOE = SERVER + 'admin/tipoEmpleado.php?action=';
//Se inicializa el modal de bootstrap
var modal = new bootstrap.Modal(document.getElementById('modal'), {
    keyboard: false
});

// Método manejador de eventos que se ejecuta cuando el documento ha cargado.
document.addEventListener('DOMContentLoaded', function () {
    // Se llama a la función que obtiene los registros para llenar la tabla. Se encuentra en el archivo components.js
    readRows(API_TIPOE);
    // Se define una variable para establecer las opciones del componente Modal.
    let options = {
        dismissible: false,
        onOpenStart: function () {
            // Se restauran los elementos del formulario.
            document.getElementById('save-form').reset();
        }
    }
});

// Función para llenar la tabla con los datos de los registros. Se manda a llamar en la función readRows().
function fillTable(dataset) {
    let content = '';
    // Se recorre el conjunto de registros (dataset) fila por fila a través del objeto row.
    dataset.map(function (row) {
        // Se crean y concatenan las filas de la tabla con los datos de cada registro.
        content += `                         
        <tr>
            <th scope="row">${row.id_tipoempleado}</th>
            <td class="text-center">${row.tipoempleado}</td>
            <td class="text-center">
                <div class="row">
                    <div class="col">
                        <div class="">
                            <button class="btn btn-outline-info" onclick="openUpdate(${row.id_tipoempleado})"> <i class="fa-solid fa-pen-to-square"></i>Editar</button>
                            <button class="btn btn-outline-danger" onclick="openDelete(${row.id_tipoempleado})"> <i class="fa-solid fa-eraser"></i>Eliminar</button>
                        </div>
                    </div>
            </td>
        </tr>         
        `;
        });
    // Se agregan las filas al cuerpo de la tabla mediante su id para mostrar los registros.
    document.getElementById('table-te').innerHTML = content;    
}

// Método manejador de eventos que se ejecuta cuando se envía el formulario de buscar.
document.getElementById('search-form').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    // Se llama a la función que realiza la búsqueda. Se encuentra en el archivo components.js
    searchRows(API_TIPOE, 'search-form');
});

// Función para preparar el formulario al momento de insertar un registro.
function openCreate() {
    //Se abre el modal
    modal.show();
    // Se asigna el título para el modal.
    document.getElementById('titulo-modal').textContent = 'Crear cargo de empleado';
    // Se asigna el texto al boton.
    document.getElementById('btn-accion').textContent = 'Agregar';
    // Se asigna el texto al label.
    document.getElementById('title-descripcion').textContent = 'Cargo de empleado:';
    //se ocultan y deshabilitan los campos correspondientes del id
    document.getElementById('id').hidden = true;
    document.getElementById('id').disabled = true;
    document.getElementById('id-description').hidden = true;  
}

// Función para preparar el formulario al momento de modificar un registro.
function openUpdate(id_tipoempleado) {
    //Se abre el modal
    modal.show();
    // Se asigna el título para el modal.
    document.getElementById('titulo-modal').textContent = 'Actualizar el cargo del empleado';
    // Se asigna el texto al boton.
    document.getElementById('btn-accion').textContent = 'Actualizar';
    // Se asigna el texto al label del id.
    document.getElementById('id-description').textContent = 'Id del cargo del empleado:';
    // Se asigna el texto al label.
    document.getElementById('title-descripcion').textContent = 'Cargo del empleado:';
    //se muestran y habilitan los campos correspondientes del id
    document.getElementById('id').hidden = false;
    document.getElementById('id').disabled = false;
    document.getElementById('id-description').hidden = false;
    const data = new FormData();
    data.append('id_tipoempleado', id_tipoempleado);
    // Petición para obtener los datos del registro solicitado.
    fetch(API_TIPOE + 'readOne', {
        method: 'post',
        body: data
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje en la consola indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    // Se inicializan los campos del formulario con los datos del registro seleccionado.
                    document.getElementById('id').value = response.dataset.id_tipoempleado;
                    document.getElementById('descripcion').value = response.dataset.tipoempleado;                                                        
                } else {
                    sweetAlert(2, response.exception, null);
                }
            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    });
}

// Método manejador de eventos que se ejecuta cuando se envía el formulario de guardar.
document.getElementById('save-form').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    // Se define una variable para establecer la acción a realizar en la API.
    let action; 
    
    // Se comprueba si el campo oculto del formulario esta seteado para actualizar, de lo contrario será para crear.    
    if (document.getElementById('id').disabled==true){
        action = 'create';
    } else if (document.getElementById('id').disabled==false){
        action = 'update';
    }        
    // Se llama a la función para guardar el registro. Se encuentra en el archivo components.js
    saveRow(API_TIPOE, action, 'save-form');
    // Se limpia la caja de dialogo (modal) del formulario.  
    cleanModal();
    // Se cierra la caja de dialogo (modal) del formulario.  
    modal.hide(); 
});

// Función para establecer el registro a eliminar y abrir una caja de diálogo de confirmación.
function openDelete(id_tipoempleado) {
    // Se define un objeto con los datos del registro seleccionado.
    const data = new FormData();
    data.append('id_tipoempleado', id_tipoempleado);
    // Se llama a la función que elimina un registro. Se encuentra en el archivo components.js
    confirmDelete(API_TIPOE, data);
}

// Función para limpiar el formulario del modal
function cleanModal(){
	//se liempia el input accediendo a su ID
	$("#id").val('');
    $("#descripcion").val('');    
}