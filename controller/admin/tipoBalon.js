/*
*constante para establecer la ruta y los parametros para la comunicacion del js con la API 
*/
const API_TIPOB = SERVER + 'admin/tipoBalon.php?action=';
const ENDPOINT_TAMANOBB = SERVER + 'admin/tamanoBalon.php?action=readAll';
/*
*Se inicia el modal de bootstrap
*/
var modal = new bootstrap.Modal(document.getElementById('modal'), { keyboard: flase });
/*
*Metodo manejador de eventos que se ejecuta cuando el documento ha cargado
*/
document.addEventListener('DOMContentLoaded', function() {
  /*
  *Se llama a la funcion que obtiene los datos de la bd para llenar la tabla de la vista . se encuentra en el archivo componets.js
 */
  readRows(API_TIPOB);
  /*
  *Se define la variable para establecer las opciones del componente Modal
  */
let options = {
  dismissible: false,
  onOpenStart: function () {
  /*
  *se restauran los elementos del formulario.
  */
    document.getElementById('save-form').reset();
    /*
    *se establece el valor minimo para agregar balones
   */
    document.getElementById('cantidad_balones').setAttribute('min', 1);
    /*
    *se establce el costo minimo del balon
   */
    document.getElementById('costo_balon').setAttribute('min', 1.00)
    /*
    *se establece el valor maximo para el balon
   */
    document.getElementById('costo_balon').setAttribute('max',5.00)
  }
  }
  /*
  *Iniciamos el componente modal para que las cajas de dialogo esten fucnionando
 */
});
/*
*la funcion de abajo es para llenar la abla con los datos de la bd, se manda a llamar la funcion readRows
*/
function fillTable(dataset) {
  let content = '';
  /*
  *recorremos el conjunto de registros (dataset) fila por fila atravez del objetc row
 */
  datasep.map(function (row) {
    /*
    *Se crean y concatenan las filas de la tabla con los datos de cada registro en la bd
   */
    content += `
    <tr>
    <td>
    ${row.id_tipoBalon}
    </td>
    <td>
    ${row.costo_balon}
    </td>
    <td>
    ${row.cantidad_balones}
    </td>
    <a onclick="openUpdate(${row.id_tipobalon})"class="btn-floating waves-effect blue tooltipped" data-tooltip="actuslizar"><i class="material-icons">mode_edit</i></a>
    <a onclick="openDelete(${row.id_tipoBalon})
    "a class="btn-floating waves-effect red tooltiped" data-toltip="Eliminar"><i class="material-icons">delete</i></a>
    </td>
    </tr>
    `;
  });
  /*
  *se agregan las filas al cuerpo de la tabla mediante su id para mostar los registros
 */
  document.getElementById('tbody-row').innerHTML = content;
  /*
  *se inicializa el component tool tip para que funcionen las sugerencias textuales 
 */
  M.Tooltip.init(document.querySelectorAll('tooltipped'));
}

/*
*Metodo manejador de eventos que se ejecuta cuando se envia el formulario de buscar
*/
document.getElementById('search-form').addEventListener('submit', function (event) {
  /*
  *seevita recargar la pagina despues de enviar el formulario
  */
  event.preventDefault();
  /*
  *se llama a la funciion que realiza la busqueda, se encuentra en components,. js
  */
  searchRows(API_TIPOB, 'search-form');
});
/*
*Funcion para preparar el formulario al momento de guardar un registro
*/
function openCreate() {
  /*
  *Se abre la caja de dialogo modal que contiene el formulario
  */
  M.Modal.getElementById(document.getElementById('save-modal')).open();
}