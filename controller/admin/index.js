// Constante para establecer la ruta y parámetros de comunicación con la API.
const API_USUARIOS = SERVER + 'admin/empleado.php?action=';

// Método manejador de eventos que se ejecuta cuando el documento ha cargado.
document.addEventListener('DOMContentLoaded', function () {
  // Petición para consultar si existen usuarios registrados.
  fetch(API_USUARIOS + 'readUsers', {
    method: 'get',
  }).then(function (request) {
    // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje en la consola indicando el problema.
    if (request.ok) {
      request.json().then(function (response) {
        // Se comprueba si existe una sesión, de lo contrario se revisa si la respuesta es satisfactoria.
        if (response.session) {
          location.href = 'main.html';
        } else if (response.status) {
          Toast(4, 'Debe autenticarse para ingresar', null);          
        } else {
          sweetAlert(3, response.exception, 'registro.html');
        }
      });
    } else {
      console.log(request.status + ' ' + request.statusText);
    }
  });
});

// Método manejador de eventos que se ejecuta cuando se envía el formulario de iniciar sesión.
document.getElementById('inicio-sesion').addEventListener('submit', function (event) {
    // Se evita recargar la página web después de enviar el formulario.
    event.preventDefault();
    // Petición para revisar si el administrador se encuentra registrado.
    fetch(API_USUARIOS + 'logIn', {
      method: 'post',
      body: new FormData(document.getElementById('inicio-sesion')),
    }).then(function (request) {
      // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje en la consola indicando el problema.
      if (request.ok) {
        request.json().then(function (response) {
          // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
          if (response.status) {
            sweetAlert(1, response.message, 'main.html');
          } else {
            Toast(2, response.exception, null);
          }
        });
      } else {
        console.log(request.status + ' ' + request.statusText);
      }
    });
  });
