// Constante para establecer la ruta y parámetros de comunicación con la API
const API_RESERVACION = SERVER + 'admin/reservaciones.php?action=';
const ENDPOINT_CHALECO = SERVER + 'admin/chaleco.php?action=readAll';
const ENDPOINT_HORARIO = SERVER + 'admin/horario.php?action=readAll';
const ENDPOINT_EMPLEADO = SERVER + 'admin/empleado.php?action=readAll';
const ENDPOINT_ASISTENCIA = SERVER + 'admin/asistencia.php?action=readAll';
const ENDPOINT_CLIENTE = SERVER + 'admin/clientes.php?action=readAll';
const ENDPOINT_T_Balon = SERVER + 'admin/tipoBalon.php?action=readAll';
const ENDPOINT_CANCHA = SERVER + 'admin/canchas.php?action=readAll';
//Se inicializa el modal de bootstrap
var modal = new bootstrap.Modal(document.getElementById('agregar'), {
    keyboard: false
});

// Método manejador de eventos que se ejecuta cuando el documento ha cargado.
document.addEventListener('DOMContentLoaded', function (){
    // Se llama a la función que obtiene los registros para llenar la tabla. Se encuentra en el archivo components.js
    readRows(API_RESERVACION);
});

// Función para llenar la tabla con los datos de los registros. Se manda a llamar en la función readRows().
function fillTable(dataset){
    let content = '';
    // Se recorre el conjunto de registros (dataset) fila por fila a través del objeto row.
    dataset.map(function(row){
        // Se crean y concatenan las filas de la tabla con los datos de cada registro.
        content += ` 
        <tr>
        <th scope="row" class="text-center">${row.id_reserva}</th>
        <td class="text-center"> ${row.fecha_reserva}</td>
        <td class="text-center"> ${row.balones_alquilados}</td>
        <td class="text-center"> ${row.observaciones} </td>
        <td class="text-center"> ${row.chalecos_alquilados} </td>
        <td class="text-center"> ${row.id_empleado} </td>
        <td class="text-center"> ${row.id_cancha} </td>
        <td class="text-center"> ${row.hora_inicio} </td>
        <td class="text-center"> ${row.horafin} </td>
        <td class="text-center"> ${row.nombre} </td>
        <td class="text-center"> ${row.apellido} </td>
        <td class="text-center"> ${row.descripcion} </td>
        <td class="text-center"> ${row.costo} </td>
        <td class="text-center"> ${row.costo_chaleco} </td>
        <td class="text-center">
        <button class="btn btn-outline-info" onclick="openUpdate(${row.id_reserva})"><i class="fa-solid fa-pen-to-square"></i></button>
        <button class="btn btn-outline-danger" onclick="openDelete(${row.id_reserva})"><i class="fa-solid fa-eraser"></i></button>
        </td>
    </tr>     
        ` 
    });
    // Se agregan las filas al cuerpo de la tabla mediante su id para mostrar los registros.
    document.getElementById('table-ad').innerHTML = content;  
}
// Método manejador de eventos que se ejecuta cuando se envía el formulario de buscar.
document.getElementById('search-form').addEventListener('submit', function(event){
    // Se evita recargar la página web después de enviar el formulario.
        event.preventDefault();
    // Se llama a la función que realiza la búsqueda. Se encuentra en el archivo components.js
    searchRows(API_RESERVACION, 'search-form');
    });
// Función para preparar el formulario al momento de crear un usuario para el empleado.
function openCreate(){
    // Se limpia la caja de dialogo (modal) del formulario.  
    cleanModal();
    modal.show();
    // Se asigna el título para el modal.
    document.getElementById('titulo-modal').textContent = 'Agregar una nueva reservacion';
    // Se asigna el texto al boton.
    document.getElementById('btn-accion').textContent = 'Agregar';
    //se ocultan y deshabilitan los campos correspondientes del id
    document.getElementById('id').hidden = true;
    document.getElementById('id').disabled = true;
    document.getElementById('id-reserva').hidden = true;
    //se ocultan y deshabilitan los campos del empleado
    document.getElementById('empleado').disabled= true;
    document.getElementById('empleado').hidden= true;
    document.getElementById('desc-empleado').hidden= true;
    //se llena el select 
    fillSelect(ENDPOINT_ASISTENCIA, 't_asistencia', null);
    fillSelect(ENDPOINT_CHALECO, 'chalecos', null);
    fillSelect(ENDPOINT_CANCHA, 'cancha', null);
    fillSelect(ENDPOINT_HORARIO, 'horario', null);
    fillSelect(ENDPOINT_CLIENTE, 'cliente', null);    
    fillSelect(ENDPOINT_T_Balon, 'tipoBalon', null);
    
}
// Función para preparar el formulario al momento de modificar un registro.
function openUpdate(id_reserva){
    // Se limpia la caja de dialogo (modal) del formulario.  
    modal.show();
    // Se asigna el título para el modal.
    document.getElementById('titulo-modal').textContent = 'Modificar la reserva';
    // Se asigna el texto al boton.
    document.getElementById('btn-accion').textContent = 'Agregar';
    //se ocultan y deshabilitan los campos correspondientes del id
    document.getElementById('id').hidden = false;
    document.getElementById('id').disabled = false;
    document.getElementById('id-reserva').hidden = false;
    //se muestran y habilitan los campos del empleado
    document.getElementById('empleado').disabled= true;
    document.getElementById('empleado').hidden= false;
    document.getElementById('desc-empleado').hidden= false;
    //se llena el select 
    fillSelect(ENDPOINT_EMPLEADO, 'empleado', null);
    fillSelect(ENDPOINT_ASISTENCIA, 't_asistencia', null);
    fillSelect(ENDPOINT_CHALECO, 'chalecos', null);
    fillSelect(ENDPOINT_CANCHA, 'cancha', null);
    fillSelect(ENDPOINT_HORARIO, 'horario', null);
    fillSelect(ENDPOINT_CLIENTE, 'cliente', null);    
    fillSelect(ENDPOINT_T_Balon, 'tipoBalon', null);
    // Se define un objeto con los datos del registro seleccionado.
    const data = new FormData();
    data.append('id_reservas', id_reserva);
    // Petición para obtener los datos del registro solicitado
    fetch(API_RESERVACION + 'readOne',{
    method: 'post',
    body: data
    }).then(function(request){
    // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje en la consola indicando el problema.
        if(request.ok){
            request.json().then(function(response){
                 // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if(response.status){
                // Se inicializan los campos del formulario con los datos del registro seleccionado.
                    document.getElementById('id').value = response.dataset.id_reserva;
                    document.getElementById('fecha').value = response.dataset.fecha_reserva;
                    document.getElementById('balones').value = response.dataset.balones_alquilados;
                    document.getElementById('observaciones').value = response.dataset.observaciones;
                    document.getElementById('cantidadChalecos').value = response.dataset.chalecos_alquilados;
                    fillSelect(ENDPOINT_EMPLEADO, 'empleado', response.dataset.id_empleado);
                    fillSelect(ENDPOINT_CANCHA, 'cancha',response.dataset.id_cancha);
                    fillSelect(ENDPOINT_HORARIO, 'horario',response.dataset.id_horario);
                    fillSelect(ENDPOINT_CLIENTE, 'cliente', response.dataset.id_cliente);
                    fillSelect(ENDPOINT_ASISTENCIA, 't_asistencia', response.dataset.id_asistencia);
                    fillSelect(ENDPOINT_T_Balon, 'tipoBalon', response.dataset.id_tipobalon);
                    fillSelect(ENDPOINT_CHALECO, 'chalecos', response.dataset.id_chaleco);
                }else{
                    sweetAlert(2, response.exception, null);
                }
            });
        }else{
            console.log(request.status+''+ request.statusText);
        }
    });
}
// Método manejador de eventos que se ejecuta cuando se envía el formulario de guardar.
document.getElementById('save-form').addEventListener('submit', function(event){
     // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    // Se define una variable para establecer la acción a realizar en la API.
    let action;
    // Se comprueba si el campo oculto del formulario esta seteado para actualizar, de lo contrario será para crear.    
    if (document.getElementById('id').disabled==true){
        action = 'create';
    }else if(document.getElementById('id').disabled==false){
        action = 'update';
    }
    // Se llama a la función para guardar el registro. Se encuentra en el archivo components.js
    saveRow(API_RESERVACION, action, 'save-form', modal);
     // Se cierra la caja de dialogo (modal) del formulario.  
     modal.hide();
});
// Función para establecer el registro a eliminar y abrir una caja de diálogo de confirmación.
function openDelete(id_reserva){
    // Se define un objeto con los datos del registro seleccionado.
    const data = new FormData();
    data.append('id_reserva', id_reserva);
    // Se llama a la función que elimina un registro. Se encuentra en el archivo components.js
    confirmDelete(API_RESERVACION, data);
}

function cleanModal(){
	//se liempia el input accediendo a su ID
    document.getElementById('save-form').reset();
}