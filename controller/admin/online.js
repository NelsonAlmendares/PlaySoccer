/*
*   Controlador de uso general en las páginas web del sitio privado cuando se ha iniciado sesión.
*   Sirve para manejar las plantillas del encabezado y pie del documento.
*/

// Constante para establecer la ruta y parámetros de comunicación con la API.
const API = SERVER + 'admin/empleado.php?action=';

// Método manejador de eventos que se ejecuta cuando el documento ha cargado.
document.addEventListener('DOMContentLoaded', function () {
    // Petición para obtener en nombre del usuario que ha iniciado sesión.
    fetch(API + 'getUser', {
        method: 'get'
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje en la consola indicando el problema.
        if (request.ok) {
            // Se obtiene la respuesta en formato JSON.
            request.json().then(function (response) {
                // Se revisa si el usuario está autenticado, de lo contrario se envía a iniciar sesión.
                if (response.session) {
                    // Se comprueba si la respuesta es satisfactoria, de lo contrario se direcciona a la página web principal.
                    if (response.status) {
                        const info_user = document.getElementById('info-user');
                        const info_empleado = `
                        <div class="profile-site">
                                 <img src="${SERVER}imagenes/empleado/${response.foto}" class="img-fluid profile" alt="">
                              </div>
                              <div class="card-body text-center">
                                 <h5 class="card-title">${response.nombre} ${response.apellido}</h5>
                                 <p class="card-text">${response.correo}</p>
                              </div>
                              <div class="card-body text-center w-100">
                                 <li><a class="dropdown-item mt-1" href="#">Configuracion <i class="fa-solid fa-gears text-muted"></i></a></li>
                                 <li><a class="dropdown-item mt-1" href="#">Estadísticas <i class="fa-solid fa-chart-line text-info"></i></a></li>
                                 <a class="btn btn-outline-danger w-100" onclick="logOut()">Cerrar Sesión <i class="fa-solid fa-right-from-bracket"></i></a>
                                 <div class="terms">
                                    <li class="terms__li"><a href="">Políticas</a></li>
                                    <span class="text-bold point_separator"><i class="fa-solid fa-circle"></i></span>
                                    <li class="terms__li"><a href="">Términos</a></li>
                                    <span class="text-bold point_separator"><i class="fa-solid fa-circle"></i></span>
                                    <li class="terms__li"><a href="">Cookies</a></li>
                                 </div>
                              </div>
                        `;                                                
                        info_user.innerHTML = info_empleado;                                                
                    } else {
                        sweetAlert(3, response.exception, 'index.html');
                    }
                } else {
                    location.href = 'index.html';
                }
            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    });
});
