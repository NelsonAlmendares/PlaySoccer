const TIPO_HORARIO = SERVER + 'admin/horario.php?action=';
const ENDPOINT_TIPO_HORARIO = SERVER + 'admin/tipoHorario.php?action=readAll';

var modal = new bootstrap.Modal(document.getElementById('modal-horario'), {
    keyboard: false
});

document.addEventListener('DOMContentLoaded', function () {
    readRows(TIPO_HORARIO);
});

function fillTable(dataset) {
    let content = '';

    dataset.map(function (row) {
        content += `<tr>
            <th scope="row" class="text-center"> ${row.id} </th>
            <td class="text-center"> ${row.inicio} </td>
            <td class="text-center"> ${row.fin} </td>
            <td class="text-center"> ${row.reservacion} <td>
                <td class="text-center">
                    <button class="btn btn-outline-info" onclick="openUpdate(${row.id})"><i class="fa-solid fa-pen-to-square"></i></button>
                    <button class="btn btn-outline-danger" onclick="openDelete(${row.id})"><i class="fa-solid fa-eraser"></i></button>
                </td>
            </tr>
        `;
    });

    document.getElementById('table_horario').innerHTML = content;
}

//Método para buscar los elementos del formulario
document.getElementById('search-form').addEventListener('submit', function (event) {
    event.preventDefault();
    searchRows(TIPO_HORARIO, 'search-form');
});

function openCreate() {
    modal.show();

    document.getElementById('id').hidden = true;
    document.getElementById('id').disabled = true;
    document.getElementById('id_horario').hidden = true;

    fillSelect(ENDPOINT_TIPO_HORARIO, 'tipo_horario', null)
}

function openUpdate(id) {
    modal.show();

    document.getElementById('id').hidden = false;
    document.getElementById('id').disabled = false;
    document.getElementById('id_horario').hidden = false;

    const data = new FormData();

    data.append('id', id);
    fetch(TIPO_HORARIO + 'readOne', {
        method: 'post',
        body: data
    }).then(function (request) {
        if (request.ok) {
            request.json().then( function (response){
                if (response.status) {
                    document.getElementById('id').value = response.dataset.id;
                    document.getElementById('hora_inicio').value = response.dataset.inicio;
                    document.getElementById('hora_fin').value = response.dataset.fin;
                    fillSelect(ENDPOINT_TIPO_HORARIO, 'tipo_horario', response.dataset.reservacion)
                } else {
                    sweetAlert(2, response.exception, null);
                }
            });
        } else {
            console.log(request.status + " " + request.statusText);
        }
    });
}

function openDelete(id) {

    const data = new FormData();
    data.append('id', id);
    confirmDelete(TIPO_HORARIO, data);
}

//Método para guardar o actualizar los datos del modal
document.getElementById('save-form').addEventListener('submit', function (event) {
    event.preventDefault();

    let action;
    if (document.getElementById('id').disabled == true) {
        action = 'create';
    } else if (document.getElementById('id').disabled == false) {
        action = 'update';
    }

    saveRow(TIPO_HORARIO, action, 'save-form');

    modal.hide();
});