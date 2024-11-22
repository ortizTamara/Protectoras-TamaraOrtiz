document.addEventListener("DOMContentLoaded", function () {
    // Función para mostrar la previsualización del logo antes de enviarlo
    function previewLogo(event) {
        const logoPreview = document.getElementById('logo-preview');
        const file = event.target.files[0];
        const reader = new FileReader();

        reader.onload = function(e) {
            logoPreview.src = e.target.result; // Cambia la imagen del logo por la seleccionada
        }

        if (file) {
            reader.readAsDataURL(file);
        }
    }

    // Función para activar el modo de edición de los campos de texto (como nombre, dirección)
    function enableEdit() {
        // Hacemos los campos de entrada editables
        document.getElementById('name').removeAttribute('readonly');
        document.getElementById('address').removeAttribute('readonly');
        document.getElementById('adoption-process').removeAttribute('readonly');
        document.getElementById('save-button').style.display = 'inline-block'; // Mostrar el botón guardar
        document.getElementById('edit-button').style.display = 'none'; // Ocultar el botón editar
    }

    // Función para guardar los cambios (esto sería simulado en este caso)
    function saveChanges() {
        const name = document.getElementById('name').value;
        const address = document.getElementById('address').value;
        const adoptionProcess = document.getElementById('adoption-process').value;

        // Aquí puedes hacer una petición AJAX para guardar los cambios en la base de datos (en el backend)

        alert('Cambios guardados: \nNombre: ' + name + '\nDirección: ' + address + '\nProceso de adopción: ' + adoptionProcess);

        // Después de guardar, bloqueamos de nuevo los campos y ocultamos el botón de guardar
        document.getElementById('name').setAttribute('readonly', true);
        document.getElementById('address').setAttribute('readonly', true);
        document.getElementById('adoption-process').setAttribute('readonly', true);
        document.getElementById('save-button').style.display = 'none';
        document.getElementById('edit-button').style.display = 'inline-block'; // Mostrar el botón editar
    }

    // Añadir evento al botón de guardar cambios
    document.getElementById('save-button')?.addEventListener('click', saveChanges);

    // Añadir evento al botón de editar
    document.getElementById('edit-button')?.addEventListener('click', enableEdit);

    // Añadir el evento de previsualización del logo
    document.getElementById('logo')?.addEventListener('change', previewLogo);
});
