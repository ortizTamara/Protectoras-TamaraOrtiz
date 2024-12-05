document.addEventListener("DOMContentLoaded", function () {
    // Función para calcular la edad en años desde la fecha de nacimiento
    function calcularEdad(fechaNacimiento) {
        const nacimiento = new Date(fechaNacimiento);
        const hoy = new Date();

        let edad = hoy.getFullYear() - nacimiento.getFullYear();
        const m = hoy.getMonth() - nacimiento.getMonth();

        // Ajustamos la edad si el cumpleaños aún no ha ocurrido este año
        if (m < 0 || (m === 0 && hoy.getDate() < nacimiento.getDate())) {
            edad--;
        }

        return edad;
    }

    // Función para calcular el tamaño del animal según el peso
    function calcularTamaño(peso) {
        let tamaño = '';

        if (peso <= 5) {
            tamaño = 'Pequeño';
        } else if (peso > 5 && peso <= 20) {
            tamaño = 'Mediano';
        } else if (peso > 20) {
            tamaño = 'Grande';
        }

        return tamaño;
    }

    // Obtener la fecha de nacimiento desde el HTML
    const fechaNacimientoElement = document.getElementById('animal-age');
    const fechaNacimiento = fechaNacimientoElement ? fechaNacimientoElement.textContent.trim() : '';

    // Agregar depuración para ver si la fecha se extrae correctamente
    console.log('Fecha de nacimiento:', fechaNacimiento);

    // Verificar si la fecha está en el formato correcto
    if (isNaN(new Date(fechaNacimiento))) {
        console.error("La fecha no es válida:", fechaNacimiento);
    }

    // Obtener el peso desde el HTML (debe estar en el formato correcto)
    const pesoElement = document.getElementById('animal-size');
    const peso = pesoElement ? parseFloat(pesoElement.textContent.trim()) : 0;

    if (fechaNacimiento && !isNaN(peso)) {
        // Calcular la edad
        const edad = calcularEdad(fechaNacimiento);
        fechaNacimientoElement.textContent = edad + " años"; // Mostrar la edad calculada

        // Calcular el tamaño
        const tamaño = calcularTamaño(peso);
        pesoElement.textContent = tamaño; // Mostrar el tamaño calculado
    } else {
        console.error("No se encontraron los datos de fecha de nacimiento o peso.");
    }
});
