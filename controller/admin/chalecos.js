// Constante para establecer la ruta y parámetros de comunicación con la API.
const API_CHALECO = SERVER + 'admin/chaleco.php?action=';
const ENDPOINT_COLORC = SERVER + 'admin/colorChaleco.php?action=readAll';
const ENDPOINT_TALLAC = SERVER + 'admin/tallaChaleco.php?action=readAll';
//Se inicializa el modal de bootstrap
var modal = new bootstrap.Modal(document.getElementById('modal'), {
  keyboard: false,
});

// Método manejador de eventos que se ejecuta cuando el documento ha cargado.
document.addEventListener('DOMContentLoaded', function () {
  // Se llama a la función que obtiene los registros para llenar la tabla. Se encuentra en el archivo components.js
  readRows(API_CHALECO);
});

// Función para llenar la tabla con los datos de los registros. Se manda a llamar en la función readRows().
function fillTable(dataset) {
  let content = "";
  // Se recorre el conjunto de registros (dataset) fila por fila a través del objeto row.
  dataset.map(function (row) {
    // Se crean y concatenan las filas de la tabla con los datos de cada registro.
    content += `                         
        <tr>
            <th scope="row" class="text-center">${row.id_chaleco}</th>
            <td class="text-center">$${row.costo_cheleco}</td>
            <td class="text-center"> ${row.cantidad_chlecos}</td>
            <td class="text-center">${row.colorchaleco}</td>
            <td class="text-center">${row.tallachaleco}</td>
            <td class="text-center">
                <button class="btn btn-outline-info" onclick="openUpdate(${row.id_chaleco})"><i class="fa-solid fa-pen-to-square"></i></button>
                <button class="btn btn-outline-danger" onclick="openDelete(${row.id_chaleco})"><i class="fa-solid fa-eraser"></i></button>
            </td>
        </tr>         
        `;
  });
  // Se agregan las filas al cuerpo de la tabla mediante su id para mostrar los registros.
  document.getElementById('table-c').innerHTML = content;
}

// Método manejador de eventos que se ejecuta cuando se envía el formulario de buscar.
document
  .getElementById('search-form').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    // Se llama a la función que realiza la búsqueda. Se encuentra en el archivo components.js
    searchRows(API_CHALECO, 'search-form');
  });

// Función para preparar el formulario al momento de insertar un registro.
function openCreate() {
  //Se abre el modal
  modal.show();
  // Se asigna el título para el modal.
  document.getElementById('titulo-modal').textContent = "Crear chaleco";
  // Se asigna el texto al boton.
  document.getElementById('btn-accion').textContent = "Agregar";
  //se ocultan y deshabilitan los campos correspondientes del id
  document.getElementById('id').hidden = true;
  document.getElementById('id').disabled = true;
  document.getElementById('id-description').hidden = true;
  //se llena el select
  fillSelect(ENDPOINT_COLORC, 'color', null);
  fillSelect(ENDPOINT_TALLAC, 'talla', null);
}

// Función para preparar el formulario al momento de modificar un registro.
function openUpdate(id_chaleco) {
  //Se abre el modal
  modal.show();
  // Se asigna el título para el modal.
  document.getElementById('titulo-modal').textContent = "Actualizar el tamaño del balon";
  // Se asigna el texto al boton.
  document.getElementById('btn-accion').textContent = "Actualizar";
  // Se asigna el texto al label del id.
  document.getElementById('id-description').textContent = "Id de balon:";
  //se muestran y habilitan los campos correspondientes del id
  document.getElementById('id').hidden = false;
  document.getElementById('id').disabled = false;
  document.getElementById('id-description').hidden = false;
  const data = new FormData();
  data.append('id_chaleco', id_chaleco);
  // Petición para obtener los datos del registro solicitado.
  fetch(API_CHALECO + 'readOne', {
    method: "post",
    body: data,
  }).then(function (request) {
    // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje en la consola indicando el problema.
    if (request.ok) {
      request.json().then(function (response) {
        // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
        if (response.status) {
          // Se inicializan los campos del formulario con los datos del registro seleccionado.
          document.getElementById('id').value = response.dataset.id_chaleco;
          document.getElementById('costo').value = response.dataset.costo_cheleco;
          document.getElementById('cantidad').value = response.dataset.cantidad_chlecos;
          fillSelect(ENDPOINT_COLORC,'color',response.dataset.colorchaleco);
          fillSelect(ENDPOINT_TALLAC,'talla',response.dataset.tallachaleco);
        } else {
          sweetAlert(2, response.exception, null);
        }
      });
    } else {
      console.log(request.status + " " + request.statusText);
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
    if (document.getElementById('id').disabled == true) {
      action = 'create';
    } else if (document.getElementById('id').disabled == false) {
      action = 'update';
    }
    // Se llama a la función para guardar el registro. Se encuentra en el archivo components.js
    saveRow(API_CHALECO, action, 'save-form');
    // Se limpia la caja de dialogo (modal) del formulario.
    cleanModal();
    // Se cierra la caja de dialogo (modal) del formulario.
    modal.hide();
  });

// Función para establecer el registro a eliminar y abrir una caja de diálogo de confirmación.
function openDelete(id_chaleco) {
  // Se define un objeto con los datos del registro seleccionado.
  const data = new FormData();
  data.append('id_chaleco', id_chaleco);
  // Se llama a la función que elimina un registro. Se encuentra en el archivo components.js
  confirmDelete(API_CHALECO, data);
}

// Función para limpiar el formulario del modal
function cleanModal() {
  //se liempia el input accediendo a su ID
  $("#id").val("");
  $("#costo").val("");
  $("#cantidad").val("");
  $("#talla").val("");
  $("#color").val("");
}
