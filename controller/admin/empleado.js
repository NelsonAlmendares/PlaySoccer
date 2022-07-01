// Constante para establecer la ruta y parámetros de comunicación con la API.
const API_USUARIOS = SERVER + 'admin/empleado.php?action=';
const ENDPOINT_TIPO_E = SERVER + 'admin/tipoEmpleado.php?action=readAll';
//Se inicializa el modal de bootstrap
var modal = new bootstrap.Modal(document.getElementById('modal-empleado'), {
    keyboard: false
});

// Método manejador de eventos que se ejecuta cuando el documento ha cargado.
document.addEventListener('DOMContentLoaded', function () {
    // Se llama a la función que obtiene los registros para llenar la tabla. Se encuentra en el archivo components.js
    readRows(API_USUARIOS);
    // Se define una variable para establecer las opciones del componente Modal.
    let options = {
        dismissible: false,
        onOpenStart: function () {
            // Se restauran los elementos del formulario.
            document.getElementById('save-form').reset();
        }
    }
    // Se inicializa el componente Modal para que funcionen las cajas de diálogo.
    //M.Modal.init(document.querySelectorAll('.modal'), options);
});

// Función para llenar la tabla con los datos de los registros. Se manda a llamar en la función readRows().
function fillTable(dataset) {
    let content = '';
    // Se recorre el conjunto de registros (dataset) fila por fila a través del objeto row.
    dataset.map(function (row) {
        // Se crean y concatenan las filas de la tabla con los datos de cada registro.
        content += `            
                <tr>
                    <th scope="row" class="text-center">${row.id_empleado}</th>
                    <td class="text-center"> <img src="${SERVER}imagenes/empleado/${row.foto_empleado}" class="img-fluid perfiles" alt=""> </td>
                    <td class="text-center"> ${row.nombre_empleado} </td>
                    <td class="text-center"> ${row.apellido_empleado} </td>
                    <td class="text-center"> ${row.dui_empleado} </td>
                    <td class="text-center"> <b>503</b> ${row.celular_empleado} </td>
                    <td class="text-center"> ${row.correo_empleado} </td>
                    <td class="text-center"> ${row.tipo_empleado} </td>
                    <td class="text-center">
                    <button class="btn btn-outline-info" onclick="openUpdate(${row.id_empleado})"><i class="fa-solid fa-pen-to-square"></i></button>
                    <button class="btn btn-outline-danger" onclick="openDelete(${row.id_empleado})"><i class="fa-solid fa-eraser"></i></button>
                    </td>
                </tr>          
        `;
    });
    // Se agregan las filas al cuerpo de la tabla mediante su id para mostrar los registros.
    document.getElementById('table-e').innerHTML = content;    
}

// Método manejador de eventos que se ejecuta cuando se envía el formulario de buscar.
document.getElementById('search-form').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    // Se llama a la función que realiza la búsqueda. Se encuentra en el archivo components.js
    searchRows(API_USUARIOS, 'search-form');
});

// Función para preparar el formulario al momento de crear un usuario para el empleado.
function openCreate() {
    //Se abre el modal
    modal.show();
    // Se asigna el título para el modal.
    document.getElementById('titulo-modal').textContent = 'Crear usuario de empleado';
    // Se asigna el texto al boton.
    document.getElementById('btn-accion').textContent = 'Agregar';
    //se ocultan y deshabilitan los campos correspondientes del id
    document.getElementById('id').hidden = true;
    document.getElementById('id').disabled = true;
    document.getElementById('id-empleado').hidden = true;
    //se ocultan y deshabilitan los campos correspondientes del foto
    document.getElementById('foto').hidden = true;
    document.getElementById('foto').disabled = true;
    document.getElementById('foto_empleado').hidden = true;
    document.getElementById('foto_empleado').disabled = true;
    //Se muestran y habilitan los campos correspondientes de confirmación de contraseña  
    document.getElementById('confirmar').hidden = false;
    document.getElementById('confirmar').disabled = false;
    //Se habilita los campos correspondientes a la contraseña
    document.getElementById('clave').disabled = false;
    //se llena el select    
    fillSelect(ENDPOINT_TIPO_E, 'tipo_empleado', null);
}

// Función para preparar el formulario al momento de modificar un registro.
function openUpdate(id_empleado) {
    //Se abre el modal
    modal.show();
    // Se asigna el título para el modal.
    document.getElementById('titulo-modal').textContent = 'Actualizar usuario de empleado';
    // Se asigna el texto al boton.
    document.getElementById('btn-accion').textContent = 'Actualizar';
    //Se muestran y habilitan los campos correspondientes del id
    document.getElementById('id').hidden = false;
    document.getElementById('id').disabled = false;
    document.getElementById('id-empleado').hidden = false;   
    //Se muestran y habilitan los campos correspondientes del foto
    document.getElementById('foto').hidden = false;
    document.getElementById('foto').disabled = false;
    document.getElementById('foto_empleado').hidden = false;
    document.getElementById('foto_empleado').disabled = false;
    //Se oculta y deshabilitan los campos correspondientes de confirmación de contraseña  
    document.getElementById('confirmar').hidden = true;
    document.getElementById('confirmar').disabled = true;
    //Se deshabilita los campos correspondientes a la contraseña
    document.getElementById('clave').disabled = true;
    // Se define un objeto con los datos del registro seleccionado.
    const data = new FormData();
    data.append('id_empleado', id_empleado);
    // Petición para obtener los datos del registro solicitado.
    fetch(API_USUARIOS + 'readOne', {
        method: 'post',
        body: data
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje en la consola indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    // Se inicializan los campos del formulario con los datos del registro seleccionado.
                    document.getElementById('id').value = response.dataset.id_empleado;
                    document.getElementById('nombre').value = response.dataset.nombre_empleado;
                    document.getElementById('apellido').value = response.dataset.apellido_empleado;
                    document.getElementById('dui').value = response.dataset.dui_empleado;                    
                    document.getElementById('celular').value = response.dataset.celular_empleado;
                    document.getElementById('email').value = response.dataset.correo_empleado;
                    fillSelect(ENDPOINT_TIPO_E, 'tipo_empleado', response.dataset.tipo_empleado);
                    document.getElementById('clave').value = response.dataset.contrasena_empleado;
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
    saveRow(API_USUARIOS, action, 'save-form');
    // Se limpia la caja de dialogo (modal) del formulario.  
    cleanModal();
    // Se cierra la caja de dialogo (modal) del formulario.  
    modal.hide();   
});

// Función para establecer el registro a eliminar y abrir una caja de diálogo de confirmación.
function openDelete(id_empleado) {
    // Se define un objeto con los datos del registro seleccionado.
    const data = new FormData();
    data.append('id_empleado', id_empleado);
    // Se llama a la función que elimina un registro. Se encuentra en el archivo components.js
    confirmDelete(API_USUARIOS, data);
}

// Función para limpiar el formulario del modal
function cleanModal(){
	//se liempia el input accediendo a su ID
	$("#nombre").val('');
    $("#apellido").val('');
    $("#dui").val('');
    $("#celular").val('');
    $("#email").val('');
    $("#foto_empleado").val('');
    $("#clave").val('');
    $("#confirmar").val('');
}