document.addEventListener('DOMContentLoaded', function () {
    let isShelter = false;

    function toggleShelterForm() {
        isShelter = !isShelter;
        const shelterForm = document.getElementById('shelterForm');
        const shelterToggleText = document.getElementById('shelterToggleText');
        const submitBtn = document.getElementById('submitBtn');
        const userForm = document.getElementById('userForm');
        const isShelterInput = document.getElementById('isShelter');
        const shelterFields = shelterForm.querySelectorAll('input, select, textarea');


        if (isShelter) {
            shelterForm.style.display = 'block';
            shelterToggleText.textContent = '¿Eres un usuario normal?';
            submitBtn.textContent = 'Registrar Protectora';
            userForm.classList.remove('col-md-12');
            userForm.classList.add('col-md-6');
            isShelterInput.value = '1'; // Establecemos el valor en 1 si es una protectora

            shelterFields.forEach(field => {
                field.disabled = false;
                if (!['instagram', 'twitter', 'facebook', 'website'].includes(field.id)) {
                    field.required = true; // Solo los campos no opcionales son requeridos
                }
            });
        } else {
            shelterForm.style.display = 'none';
            shelterToggleText.textContent = '¿Eres una protectora?';
            submitBtn.textContent = 'Registrarse como Usuario';
            userForm.classList.remove('col-md-6');
            userForm.classList.add('col-md-12');
            isShelterInput.value = '0'; // Establecemos el valor en 0 si es un usuario normal

            shelterFields.forEach(field => {
                field.disabled = true; // Deshabilitar todos los campos
                field.required = false; // Eliminar el atributo requerido de todos los campos
                field.value = ''; // Limpiar el valor del campo
            });
        }
    }

    document.getElementById('toggleButton').addEventListener('click', function(event) {
        event.preventDefault(); // Evitamos que el botón envíe el formulario
        toggleShelterForm();
    });

    // Ocultamos o mostramos el campo de Comunidad Autónoma si seleccionamos el Pais.
    const countrySelect = document.getElementById('country');
    const communityContainer = document.getElementById('communityContainer');

    countrySelect.addEventListener('change', function() {
        if (countrySelect.value !== '') {
            communityContainer.style.display = 'block'; // Mostramos la comunidad autónoma
        } else {
            communityContainer.style.display = 'none'; // Ocultamos la comunidad autónoma si no se selecciona país
        }
    });

    // Ocultamos o mostramos Provincias según la selección de Comunidad Autónoma
    const communitySelect = document.getElementById('autonomousCommunity');
    const provinceSelect = document.getElementById('province');
    const provinceContainer = document.getElementById('provinceContainer');
    const postalCodeField = document.getElementById('postalCode');

    // Inicialmente deshabilitamos el campo de código postal
    postalCodeField.disabled = true;

    communitySelect.addEventListener('change', function() {
        const communityId = this.value;

        // Limpiamos las opciones anteriores de provincia y deshabilitamos el campo de código postal
        provinceSelect.innerHTML = '<option value="">Selecciona una provincia</option>';
        postalCodeField.disabled = true;
        postalCodeField.value = ''; // Limpiamos el campo de código postal
        document.getElementById('postalCodeError').textContent = ''; // Limpiamos el mensaje de error

        if (communityId) {
            provinceContainer.style.display = 'block'; // Mostramos Provincias solo si hay una Comunidad Autónoma seleccionada

            // Realizamos solicitud AJAX para obtener las provincias en formato JSON
            fetch(`/provincias/${communityId}`)
                .then(response => response.json())
                .then(data => {
                    // Agregamos cada provincia a las opciones del campo
                    data.forEach(provincia => {
                        const option = document.createElement('option');
                        option.value = provincia.id;
                        option.textContent = provincia.nombre;
                        provinceSelect.appendChild(option);
                    });
                })
                .catch(error => console.error('Error al cargar provincias:', error));
        } else {
            provinceContainer.style.display = 'none'; // Ocultamos Provincias si no se selecciona Comunidad Autónoma
        }
    });

    // Habilitar el campo de código postal cuando se seleccione una provincia
    provinceSelect.addEventListener('change', function() {
        if (provinceSelect.value !== '') {
            postalCodeField.disabled = false;
        } else {
            postalCodeField.disabled = true;
            postalCodeField.value = ''; // Limpiar el campo de código postal si no hay provincia seleccionada
            document.getElementById('postalCodeError').textContent = ''; // Limpiar el mensaje de error
        }
    });
});

function handleSubmit(event) {
    event.preventDefault();
    // Lógica para enviar los datos
    console.log("Form submitted");
}
