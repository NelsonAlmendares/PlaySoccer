// constante para establecer la ruta y parametros de comunicacion

const API_CANCHAS = SERVER + 'admin/canchas.php?action='

var modal = new bootstrap.Modal(document.getElementById('modal-canchas'), {
  keyboard: false,
})

// método manejador de eventos que se ejecuta cuando el documento ha cargado

document.addEventListener('DOMContentLoaded', function () {
  // se llama a la funcion que obtiene los registros para llenar la tabla
  readRows(API_CANCHAS)
  // se define una variable para establecer las opciones del componente

  let options = {
    dismissible: false,
    onOpenStart: function () {
      // se restauran los elementos del formulario
      document.getElementById('save-form').reset()
    },
  }
})

// funcion para llenar la tabla con los dtos de los registros.

function fillTable(dataset) {
  let content = ''
  // se recorre el conjunto de registros
  dataset.map(function (row) {
    content += `
        <tr>
            <td scope="row" class="text-center">${row.id_cancha}</td>
            <td class="text-center"> ${row.numero_cancha} </td>
            <td class="text-center"> ${row.tamano_cancha} </td>
            <td class="text-center"> ${row.material_cancha} </td>
            <td class="text-center"> ${row.costo_cancha} </td>
            <td class="text-center">
            <button class="btn btn-outline-info" onclick="openUpdate(${row.id_cancha})"><i class="fa-solid fa-pen-to-square"></i></button>
            <button class="btn btn-outline-danger" onclick="openDelete(${row.id_cancha})"><i class="fa-solid fa-eraser"></i></button>
            </td>
        </tr>
        `;
  });

  // método manejador de eventos que se ejecuta cuando se envia el formulario de buscar
  document.getElementById('table-c').innerHTML = content;
}

// método manejador de eventos que se ejecuta cuando se envia el formulario de buscar

document.getElementById('search-form').addEventListener('submit', function (event) {
    // se evita recargar la pagina web despues de enviar el formulario
    event.preventDefault();
    // se llama a la función que realiza la busqueda.
    searchRows(API_CANCHAS, 'search-form');
});

// Función para preparar el formulario al momento de agregar un registro de una nueva cancha

function openCreate() {
    // se abre el modal
    modal.show();
    // Se asigna el título para el modal.
    document.getElementById('staticBack').textContent = 'Agregar Cancha'
    // se asigna el texto al boton 
    document.getElementById('btn-save').textContent = 'Agregar';
    //se ocultan y deshabilitan los campos correspondientes del id
    document.getElementById('id').hidden = true;
    document.getElementById('id').disabled = true;
    document.getElementById('id_cancha').hidden = true;

}

// Función para preparar el formulario al momento de modificar un registro.

function openUpdate(id_cancha) {
    //Se abre el modal
    // Se asigna el título para el modal.
    document.getElementById('staticBack').textContent = 'Actualizar Registro';
    // Se asigna el texto al boton.
    document.getElementById('btn-save').textContent = 'Actualizar';
    //Se muestran y habilitan los campos correspondientes del id
    document.getElementById('id').hidden = false;
    document.getElementById('id').disabled = false;
    document.getElementById('id_cancha').hidden = false;

    // Se define un objeto con los datos del registro seleccionado.
    const data = new FormData();
    data.append('id_cancha', id_cancha);
    // Petición para obtener los datos del registro solicitado.
    fetch(API_CANCHAS + 'readOne', {
        method: 'post',
        body: data
    }).then(function (request) {
         // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje en la consola indicando el problema.
         if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if(response.status) {
                    // Se inicializan los campos del formulario con los datos del registro seleccionado.
                    document.getElementById('id').value = response.dataset.id_cancha;
                    document.getElementById('EnumCancha').value = response.dataset.numero_cancha;
                    document.getElementById('MaterialCancha').value = response.dataset.material_cancha;
                    document.getElementById('TamañoCancha').value = response.dataset.tamaño_cancha;
                    document.getElementById('costo').value = response.dataset.costo_cancha;
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
      // Se comprueba si el campo oculto del formulario esta seteado para actualizar, de lo contrario será para crear.    

      let action;

      // Se comprueba si el campo oculto del formulario esta seteado para actualizar, de lo contrario será para crear.    
      if (document.getElementById('id').disabled==true){
        action = 'create';
      } else if (document.getElementById('id').disabled==false){
        action = 'update';
      }
      // Se llama a la función para guardar el registro. Se encuentra en el archivo components.js
      saveRow(API_CANCHAS, action, 'save-form');
      // Se limpia la caja de dialogo (modal) del formulario.  
      cleanModal();
      // Se cierra la caja de dialogo (modal) del formulario.  
      modal.hide();
});

// Función para establecer el registro a eliminar y abrir una caja de diálogo de confirmación.

function openDelete(id_cancha) {

  const data = new FormData();
  data.append('id_cancha', id_cancha);
   // Se llama a la función que elimina un registro. Se encuentra en el archivo components.js
   confirmDelete(API_CANCHAS, data);
}

function cleanModal(){
  $("#EnumCancha").val('');
  $("#TamañoCancha").val('');
  $("#MaterialCancha").val('');
  $("#costo").val('');
}


