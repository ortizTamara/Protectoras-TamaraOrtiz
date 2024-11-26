document.addEventListener("DOMContentLoaded", function () {
    const touchedFields = {
        nombre: false,
        especie: false,
        raza: false,
        color: false,
        fechaNacimiento: false,
        sexo: false,
        peso: false,
        nivelActividad: false,
        estado: false,
        comportamientos: false,
        opcionesEntrega: false,
        imagen: false,
    };


    // ESTADO -> Validar selección
    function validateEstado() {
        const estadoField = document.getElementById("estado_animal_id");
        const estadoError = document.getElementById("estadoError");

        if (!estadoField.value) {
            estadoError.textContent = "Selecciona un estado.";
            return false;
        } else {
            estadoError.textContent = "";
        }
        return true;

    }

    // NOMBRE -> solo letras y espacios, formato con mayúsculas iniciales
    function validateNombre() {
        const nombreField = document.getElementById("nombre");
        const nombreError = document.getElementById("nombreError");
        const nombrePattern = /^[A-Za-zÁÉÍÓÚáéíóúñÑ\s]+$/;

        if (touchedFields.nombre) {
            if (nombreField.value.trim() === "") {
                nombreError.textContent = "El nombre es obligatorio.";
                return false;
            } else if (!nombrePattern.test(nombreField.value)) {
                nombreError.textContent = "El nombre solo puede contener letras y espacios.";
                return false;
            } else {
                // Formatear a "Primera Mayúscula"
                const palabras = nombreField.value
                    .trim()
                    .split(" ")
                    .map((word) => word.charAt(0).toUpperCase() + word.slice(1).toLowerCase());
                nombreField.value = palabras.join(" ");
                nombreError.textContent = "";
            }
        }
        return true;
    }

    // SELECCIÓN DE ESPECIE
    function validateEspecie() {
        const especieField = document.getElementById("especie_id");
        const especieError = document.getElementById("especieError");

        if (touchedFields.especie) {
            if (especieField.value === "") {
                especieError.textContent = "Selecciona una especie.";
                return false;
            } else {
                especieError.textContent = "";
            }
        }
        return true;
    }

    // SELECCIÓN DE RAZA
    function validateRaza() {
        const razaField = document.getElementById("raza_id");
        const razaError = document.getElementById("razaError");

        if (razaField.value === "") {
            razaError.textContent = "";
            return true;
        }

        razaError.textContent = "";
        return true;
    }

    // SELECCIÓN DE COLOR
    function validateColor() {
        const colorField = document.getElementById("color_id");
        const colorError = document.getElementById("colorError");

        if (touchedFields.color) {
            if (colorField.value === "") {
                colorError.textContent = "Selecciona un color.";
                return false;
            } else {
                colorError.textContent = "";
            }
        }
        return true;
    }

   // FECHA DE NACIMIENTO -> comprobamos que no sea futura
    function validateFechaNacimiento() {
    const fechaNacimientoField = document.getElementById("fecha_nacimiento");
    const fechaNacimientoError = document.getElementById("fechaNacimientoError");
    const fechaActual = new Date();

    if (touchedFields.fechaNacimiento) {
        // Comprobamos si el campo está vacío
        if (!fechaNacimientoField.value) {
            fechaNacimientoError.textContent = "La fecha de nacimiento es obligatoria.";
            return false;
        }

        // Convertimos el valor del campo en un objeto de fecha
        const fechaSeleccionada = new Date(fechaNacimientoField.value);

        // Validamos si es una fecha válida
        if (isNaN(fechaSeleccionada)) {
            fechaNacimientoError.textContent = "Selecciona una fecha válida.";
            return false;
        }

        // Verificamos si la fecha seleccionada es futura
        if (fechaSeleccionada > fechaActual) {
            fechaNacimientoError.textContent = "La fecha de nacimiento no puede ser futura.";
            return false;
        }

        // Si todas las validaciones son correctas
        fechaNacimientoError.textContent = "";
    }

    return true;
    }

    // SELECCIÓN DE SEXO
    function validateGenero() {
        const generoField = document.getElementById("genero_animal_id");
        const generoError = document.getElementById("generoError");

        if (touchedFields.sexo) {
            if (generoField.value === "") {
                generoError.textContent = "Selecciona el género del animal.";
                return false;
            } else {
                generoError.textContent = "";
            }
        }
        return true;
    }

    // PESO -> QUE SEA MAYOR A 0
    function validatePeso() {
        const pesoField = document.getElementById("peso");
        const especieField = document.getElementById("especie_id");
        const pesoError = document.getElementById("pesoError");

        const especieId = parseInt(especieField.value);
        // const pesoValue = parseFloat(pesoField.value.replace(',', '.'));
        const pesoValue = parseFloat(pesoField.value);


        const pesoRangos = {
            1: { min: 0.5, max: 10 }, // Gato
            2: { min: 5, max: 50 },  // Perro
        };

        if (isNaN(pesoValue) || pesoValue <= 0) {
            pesoError.textContent = "El peso debe ser mayor a 0.";
            return false;
        }

        if (pesoRangos[especieId]) {
            const { min, max } = pesoRangos[especieId];
            if (pesoValue < min || pesoValue > max) {
                pesoError.textContent = `El peso debe estar entre ${min} kg y ${max} kg para esta especie.`;
                return false;
            }
        } else {
            pesoError.textContent = "Selecciona una especie válida.";
            return false;
        }

        pesoError.textContent = ""; // Limpia errores si todo es válido
        return true;
    }

    // SELECCIÓN NIVEL DE ACTIVIDAD
    function validateNivelActividad() {
        const nivelActividadField = document.getElementById("nivel_actividad_id"); // Cambiado aquí
        const nivelActividadError = document.getElementById("nivelActividadError");

        if (touchedFields.nivelActividad) {
            if (nivelActividadField.value === "") {
                nivelActividadError.textContent = "Selecciona un nivel de actividad.";
                return false;
            } else {
                nivelActividadError.textContent = "";
            }
        }
        return true;
    }

    // COMPORTAMIENTOS -> validamos que haya al menos uno seleccionado por categoría
    function validateComportamientos() {
        const checkboxes = document.querySelectorAll('input[name="comportamientos[]"]');
        const comportamientosError = document.getElementById("comportamientosError");

        // Verificar si al menos un checkbox está seleccionado
        const isChecked = Array.from(checkboxes).some((checkbox) => checkbox.checked);

        if (!isChecked) {
            comportamientosError.textContent = "Selecciona al menos un comportamiento.";
            return false;
        } else {
            comportamientosError.textContent = "";
            return true;
        }
    }

    // OPCIONES DE ENTREGA -> Validamos al menos una opción seleccionada
    function validateOpcionesEntrega() {
        const opcionesEntrega = document.querySelectorAll('input[name="opciones_entrega[]"]');
        const opcionesEntregaError = document.getElementById("opcionesEntregaError");

        const selected = Array.from(opcionesEntrega).some((checkbox) => checkbox.checked);

        if (!selected) {
            opcionesEntregaError.textContent = "Selecciona al menos una opción de entrega.";
            return false;
        } else {
            opcionesEntregaError.textContent = "";
            return true;
        }
    }

    // FOTO -> Validar que haya sido cargada
    function validateImagen() {
        const imagenField = document.getElementById("imagen");
        const imagenError = document.getElementById("imagenError");

        // Verificar si se seleccionó una imagen
        if (!imagenField.files || imagenField.files.length === 0) {
            imagenError.textContent = "Es obligatorio subir una imagen.";
            imagenError.style.display = "block"; // Asegurar que el mensaje sea visible
            return false;
        }

        const file = imagenField.files[0];
        const allowedTypes = ["image/jpeg", "image/png", "image/gif"];

        // Verificar el tipo de archivo
        if (!allowedTypes.includes(file.type)) {
            imagenError.textContent = `El tipo de archivo no es válido. Solo se permiten: ${allowedTypes.join(", ")}.`;
            imagenError.style.display = "block";
            return false;
        }

        // Verificar el tamaño del archivo
        if (file.size > 2 * 1024 * 1024) {
            imagenError.textContent = "La imagen no debe superar los 2 MB.";
            imagenError.style.display = "block";
            return false;
        }

        // Si pasa todas las validaciones
        imagenError.textContent = "";
        imagenError.style.display = "none";
        return true;
    }

    // Mostrar vista previa de la imagen
    document.getElementById("imagen").addEventListener("change", function () {
        const preview = document.getElementById("imagen_preview");
        const fileName = document.getElementById("imagenName");
        const file = this.files[0];

        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                preview.src = e.target.result;
                preview.classList.remove("d-none");
            };
            reader.readAsDataURL(file);

            // Mostrar el nombre del archivo
            fileName.textContent = `Archivo seleccionado: ${file.name}`;
            fileName.classList.remove("d-none");
        } else {
            // Resetear vista previa y nombre del archivo
            preview.src = "#";
            preview.classList.add("d-none");
            fileName.textContent = "";
            fileName.classList.add("d-none");
        }
    });

    // VALIDAMOS TODOS LOS CAMPOS AL ENVIAR EL FORMULARIO
    function validateForm() {
        let isValid = true;
        isValid = validateNombre() && isValid;
        isValid = validateEstado() && isValid;
        isValid = validateFechaNacimiento() && isValid;
        isValid = validateGenero() && isValid;
        isValid = validatePeso() && isValid;
        isValid = validateColor() && isValid;
        isValid = validateEspecie() && isValid;
        isValid = validateRaza() && isValid;
        isValid = validateNivelActividad() && isValid;
        isValid = validateComportamientos() && isValid;
        isValid = validateOpcionesEntrega() && isValid;
        isValid = validateImagen() && isValid;
        return isValid;
    }

    document.getElementById("estado_animal_id").addEventListener("change", () => {
        touchedFields.estado = true;
        validateEstado();
    });

    document.getElementById("nombre").addEventListener("input", () => {
        touchedFields.nombre = true;
        validateNombre();
    });

    document.getElementById("especie_id").addEventListener("change", () => {
        touchedFields.especie = true;
        validateEspecie();
    });

    document.getElementById("raza_id").addEventListener("change", () => {
        touchedFields.raza = true;
        validateRaza();
    });

    document.getElementById("color_id").addEventListener("change", () => {
        touchedFields.color = true;
        validateColor();
    });

    document.getElementById("genero_animal_id").addEventListener("change", () => {
        touchedFields.sexo = true;
        validateGenero();
    });

    document.getElementById("fecha_nacimiento").addEventListener("input", () => {
        touchedFields.fechaNacimiento = true;
        validateFechaNacimiento();
    });

    document.getElementById("peso").addEventListener("input", () => {
        touchedFields.peso = true;
        validatePeso();
    });


    document.getElementById("nivel_actividad_id").addEventListener("change", () => {
        touchedFields.nivelActividad = true;
        validateNivelActividad();
    });

    document.querySelectorAll('input[name="comportamientos[]"]').forEach((checkbox) => {
        checkbox.addEventListener("change", () => {
            validateComportamientos();
        });
    });

    document.querySelectorAll('input[name="opciones_entrega[]"]').forEach((checkbox) => {
        checkbox.addEventListener("change", () => {
            touchedFields.opcionesEntrega = true;
            validateOpcionesEntrega();
        });
    });

    document.getElementById("imagen").addEventListener("change", () => {
        touchedFields.imagen = true;
        validateImagen();
    });


    document.querySelector(".create-animal__form").addEventListener("submit", function (event) {
        const isValidImagen = validateImagen();

        if (!isValidImagen) {
            event.preventDefault();
        }
    });
});
