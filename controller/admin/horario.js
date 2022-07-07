const TIPO_HORARIO = SERVER + 'admin/horario.php?action=';

var modal = new bootstrap.Modal(document.getElementById('modal-horario'), {
    keyboard: false
});

document.addEventListener('DOMContentLoaded', function (){
    readRows(TIPO_HORARIO);
});

function fillTable (dataset) {
    let content = '';

    dataset.map(function (row) {
        content = `<tr>
            <th scope="row" class="text-center"> ${row.id} </th>
            <td class="text-center"> ${row.hora_inicio} </td>
            <td class="text-center"> ${row.hora_fin} </td>
            <td class="text-center"> ${row.tipoHorario} <td>
                <td class="text-center">
                    <button class="btn btn-outline-info" onclick="openUpdate(${row.id_horario})"><i class="fa-solid fa-pen-to-square"></i></button>
                    <button class="btn btn-outline-danger" onclick="openDelete(${row.id_horario})"><i class="fa-solid fa-eraser"></i></button>
                </td>
            </tr>
        `;
    });

    document.getElementById('table_horario').innerHTML = content;
}

document.getElementById('search-form').addEventListener('submit', function (event){
    event.preventDefault();
    searchRows(TIPO_HORARIO, 'search-form');
});

function openCreate () {
    modal.show();

    document.getElementById('id').hidden = true;
    document.getElementById('id').disabled = true;
    document.getElementById('id_horario').hidden = true;
}

function openUpdate () {

}

function openDelete () {

}