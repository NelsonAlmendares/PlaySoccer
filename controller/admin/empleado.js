// Constante para establecer la ruta y parámetros de comunicación con la API.
const API_USUARIOS = SERVER + 'admin/empleado.php?action=';
const ENDPOINT_TIPO_E = SERVER + 'admin/tipo_empleado.php?action=readAll';

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
                            <td class="contenido">${row.id_empleado}</td>
                            <td class="contenido"><img src="${SERVER}imagenes/empleados/${row.foto_empleado}" class="materialboxed" height="100"></td>
                            <td class="contenido">${row.nombre_empleado}</td>
                            <td class="contenido">${row.apellido_empleado}</td>
                            <td class="contenido">${row.DUI}</td>
                            <td class="contenido">${row.direccion_empleado}</td>
                            <td class="contenido">${row.codigo_empleado}</td>
                            <td class="contenido">${row.tipo_empleado}</td>
                            <td class="contenido">
                                <button class="btn-editar" id="openModal" onclick="openUpdate(${row.id_empleado})"><i class="fa-solid fa-pen-to-square"></i></button>
                                <button class="btn-eliminar" onclick="openDelete(${row.id_empleado})"><i class="fa-solid fa-trash"></i></button>
                                </a>
                            </td>
                        </tr>          
        `;
    });
    // Se agregan las filas al cuerpo de la tabla mediante su id para mostrar los registros.
    document.getElementById('table-e').innerHTML = content;
    // Se inicializa el componente Tooltip para que funcionen las sugerencias textuales.
    //M.Tooltip.init(document.querySelectorAll('.tooltipped'));
}

// Método manejador de eventos que se ejecuta cuando se envía el formulario de buscar.
document.getElementById('search-form').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    // Se llama a la función que realiza la búsqueda. Se encuentra en el archivo components.js
    searchRows(API_USUARIOS, 'search-form');
});

// Función para preparar el formulario al momento de insertar un registro.
function openCreate() {
    // Se crea la variable que guardara todas las etiquetas html.
    let register = '';
    // Se crea todo el formulario.
        register += `            
                <h2 id="modal-titulo"></h2>
                    <!-- No se coloca el id solo al momento de modificar al momento de modificar -->
                    <div class="openModal">
                        <div class="lateral1">
                            <div class="input-field ">
                                <label class="label" for="id_empleado" id="id_e">ID de empleado:</label>
                                <input type="number" class="form-control input-label" id="id_empleado" name="id_empleado" step="000" placeholder="1" min="1"
                                    required />
                            </div>
                            <div class="input-field ">
                                <label class="label" for="nombre_empleado">Nombre de empleado:</label>
                                <input type="text" class="form-control input-label" id="nombre_empleado" name="nombre_empleado" placeholder="Nombre"
                                    required />
                            </div>
                            <div class="input-field ">
                                <label class="label" for="apellido_empleado">Apellido de empleado:</label>
                                <input type="text" class="form-control input-label" id="apellido_empleado" name="apellido_empleado" placeholder="Apellido"
                                    required />
                            </div>
                            <div class="input-field ">
                                <label class="label" for="DUI_empleado">DUI de empleado:</label>
                                <input type="text" class="form-control input-label" id="DUI_empleado" name="DUI_empleado" placeholder="12345678-9"
                                    maxlength="10" required />
                            </div>
                            <div class="input-field ">
                                <label class="label" for="foto_empleado">Foto de empleado:</label>
                                <div class="file-select">
                                    <input type="file" class="form-control" id="foto_empleado" name="foto_empleado" accept=".jpg, .png" required />
                                </div>
                            </div>
                        </div>
                        
                        <div class="lateral2">
                            <div class="input-field ">
                                <label class="label" for="direccion_empleado">Direccion de empleado:</label>
                                <input type="text" class="form-control input-label" id="direccion_empleado" name="direccion_empleado"
                                    placeholder="Residencial, pasaje, casa N°..." required />
                            </div>
                            <div class="input-field ">
                                <label class="label" for="codigo_empleado">Código de empleado:</label>
                                <input type="number" class="form-control input-label" id="codigo_empleado" name="codigo_empleado" step="000"
                                    placeholder="001" min="1" required />
                            </div>
                            <div class="input-field ">
                                <label class="label" for="tipo_empleado">Tipo empleado</label>
                                <select id="tipo_empleado" class="select_id" name="tipo_empleado">
                                </select>
                            </div>
                            <div class="input-field  ">
                                <label class="label" for="clave">Contraseña:</label>
                                <input type="password" id="clave" name="clave" maxlength="8" class="form-control input-label" placeholder="Contraseña"
                                    required />
                            </div>
                            <div class="input-field ">
                                <label class="label" for="password">Confirmar Contraseña:</label>
                                <input id="confirmar" type="password" name="confirmar" maxlength="8" class="form-control input-label"
                                    placeholder="Confirmar contraseña" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="input-field col s12 m6">
                        <a class="active" href="empleados.html" id="cerrar_form">Cerrar</a>
                        <button id="agregar" type="submit">Agregar</button>
                    </div>                          
        `;
    // Se agregan agregan todos los campos al formulario mediante su id para crear un registro.
    document.getElementById('save-form').innerHTML = register;
    // Se asigna el título para el formulario.
    document.getElementById('modal-titulo').textContent = 'Crear usuario de empleado';
    //se ocultan y deshabilitan los campos del id
    document.getElementById('id_empleado').hidden = true;
    document.getElementById('id_e').hidden = true;
    document.getElementById('id_e').disabled = true;
    document.getElementById('id_empleado').disabled = true;
    //se llena el select    
    fillSelect(ENDPOINT_TIPO_E, 'tipo_empleado', null);
}

// Función para preparar el formulario al momento de modificar un registro.
function openUpdate(id_empleado) {
    // Se crea la variable que guardara todas las etiquetas html.
    let update = '';
    // Se crea todo el formulario.
        update += `            
        <h2 id="modal-titulo"></h2>
        <!-- No se coloca el id solo al momento de modificar al momento de modificar -->
        <div class="openModal">
            <div class="lateral1">
                <div class="input-field ">
                    <label class="label" for="id_empleado" id="id_e">ID de empleado:</label>
                    <input type="number" class="form-control input-label" id="id_empleado" name="id_empleado" step="000" placeholder="1" min="1"
                        required />
                </div>
                <div class="input-field ">
                    <label class="label" for="nombre_empleado">Nombre de empleado:</label>
                    <input type="text" class="form-control input-label" id="nombre_empleado" name="nombre_empleado" placeholder="Nombre"
                        required />
                </div>
                <div class="input-field ">
                    <label class="label" for="apellido_empleado">Apellido de empleado:</label>
                    <input type="text" class="form-control input-label" id="apellido_empleado" name="apellido_empleado" placeholder="Apellido"
                        required />
                </div>
                <div class="input-field ">
                    <label class="label" for="DUI_empleado">DUI de empleado:</label>
                    <input type="text" class="form-control input-label" id="DUI_empleado" name="DUI_empleado" placeholder="12345678-9"
                        maxlength="10" required />
                </div>
                <div class="input-field ">
                    <label class="label" for="foto_empleado">Foto de empleado:</label>
                    <div class="file-select">
                        <input type="file" class="form-control" id="foto_empleado" name="foto_empleado" accept=".jpg, .png" />
                    </div>
                </div>
            </div>
            
            <div class="lateral2">
                <div class="input-field ">
                    <label class="label" for="direccion_empleado">Direccion de empleado:</label>
                    <input type="text" class="form-control input-label" id="direccion_empleado" name="direccion_empleado"
                        placeholder="Residencial, pasaje, casa N°..." required />
                </div>
                <div class="input-field ">
                    <label class="label" for="codigo_empleado">Código de empleado:</label>
                    <input type="number" class="form-control input-label" id="codigo_empleado" name="codigo_empleado" step="000"
                        placeholder="001" min="1" required />
                </div>
                <div class="input-field ">
                    <label class="label" for="tipo_empleado">Tipo empleado</label>
                    <select id="tipo_empleado" class="select_id" name="tipo_empleado">
                    </select>
                </div>
                <div class="input-field  ">
                    <label class="label" for="clave">Contraseña:</label>
                    <input type="password" id="clave" name="clave" maxlength="8" class="form-control input-label" placeholder="Contraseña"
                        required />
                </div>
                <div class="input-field ">
                    <label class="label" for="password" id="confirm">Confirmar Contraseña:</label>
                    <input id="confirmar" type="password" name="confirmar" maxlength="8" class="form-control input-label"
                        placeholder="Confirmar contraseña" required>
                </div>
            </div>
        </div>
        
        <div class="input-field col s12 m6">
            <a class="active" href="empleados.html" id="cerrar_form">Cerrar</a>
            <button id="agregar" type="submit">Actualizar</button>
        </div>                           
        `;
    // Se agregan agregan todos los campos al formulario mediante su id para crear un registro.
    document.getElementById('save-form').innerHTML = update;
    // Se asigna el título para el formulario.
    document.getElementById('modal-titulo').textContent = 'Actualizar usuario de empleado';
    // Se deshabilitan los campos de alias y contraseña.
    document.getElementById('id_empleado').hidden = false;
    document.getElementById('id_e').hidden = false;
    document.getElementById('id_empleado').disabled = false;
    document.getElementById('id_e').disabled = false;   
    document.getElementById('confirmar').hidden = true;
    document.getElementById('confirm').hidden = true;
    document.getElementById('clave').disabled = true;
    document.getElementById('confirmar').disabled = true;
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
                    document.getElementById('id_empleado').value = response.dataset.id_empleado;
                    document.getElementById('nombre_empleado').value = response.dataset.nombre_empleado;
                    document.getElementById('apellido_empleado').value = response.dataset.apellido_empleado;
                    document.getElementById('DUI_empleado').value = response.dataset.DUI;                    
                    document.getElementById('direccion_empleado').value = response.dataset.direccion_empleado;
                    document.getElementById('codigo_empleado').value = response.dataset.codigo_empleado;
                    fillSelect(ENDPOINT_TIPO_E, 'tipo_empleado', response.dataset.tipo_empleado);
                    document.getElementById('clave').value = response.dataset.clave;
                    // Se actualizan los campos para que las etiquetas (labels) no queden sobre los datos.
                    //M.updateTextFields();
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
    if (document.getElementById('id_empleado').disabled==true){
        action = 'create';
    } else if (document.getElementById('id_empleado').disabled==false){
        action = 'update';
    }    
    // Se llama a la función para guardar el registro. Se encuentra en el archivo components.js
    saveRow(API_USUARIOS, action, 'save-form');
});

// Función para establecer el registro a eliminar y abrir una caja de diálogo de confirmación.
function openDelete(id_empleado) {
    // Se define un objeto con los datos del registro seleccionado.
    const data = new FormData();
    data.append('id_empleado', id_empleado);
    // Se llama a la función que elimina un registro. Se encuentra en el archivo components.js
    confirmDelete(API_USUARIOS, data);
}