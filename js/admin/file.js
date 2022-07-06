let archivo = document.querySelector('#archivo');
archivo.addEventListener('change', () => {
    document.querySelector('#nombre').innerText = archivo.files[0].name;
});