// document.addEventListener("DOMContentLoaded", function () {
//     function calcularEdad(fechaNacimiento) {
//         const nacimiento = new Date(fechaNacimiento);
//         const hoy = new Date();

//         let edad = hoy.getFullYear() - nacimiento.getFullYear();
//         const m = hoy.getMonth() - nacimiento.getMonth();

//         if (m < 0 || (m === 0 && hoy.getDate() < nacimiento.getDate())) {
//             edad--;
//         }

//         return edad;
//     }

//     function calcularTamaño(peso) {
//         let tamaño = '';

//         if (peso <= 5) {
//             tamaño = 'Pequeño';
//         } else if (peso > 5 && peso <= 20) {
//             tamaño = 'Mediano';
//         } else if (peso > 20) {
//             tamaño = 'Grande';
//         }

//         return tamaño;
//     }

//     const fechaNacimientoElement = document.getElementById('fecha_nacimiento');
//     const fechaNacimiento = fechaNacimientoElement ? fechaNacimientoElement.textContent.trim() : '';

//     console.log('Fecha de nacimiento:', fechaNacimiento);

//     if (isNaN(new Date(fechaNacimiento))) {
//         console.error("La fecha no es válida:", fechaNacimiento);
//     }

//     const pesoElement = document.getElementById('animal-size');
//     const peso = pesoElement ? parseFloat(pesoElement.textContent.trim()) : 0;

//     if (fechaNacimiento && !isNaN(peso)) {
//         // Calcular la edad
//         const edad = calcularEdad(fechaNacimiento);
//         fechaNacimientoElement.textContent = edad + " años";

//         const tamaño = calcularTamaño(peso);
//         pesoElement.textContent = tamaño;
//     } else {
//         console.error("No se encontraron los datos de fecha de nacimiento o peso.");
//     }
// });
document.addEventListener("DOMContentLoaded", function () {
    // Función para calcular la edad en años, meses, semanas y días desde la fecha de nacimiento
    function calcularEdad(fechaNacimiento) {
        const nacimiento = new Date(fechaNacimiento);
        const hoy = new Date();

        const diferenciaTiempo = hoy - nacimiento; // Diferencia en milisegundos
        const díasTotales = Math.floor(diferenciaTiempo / (1000 * 60 * 60 * 24)); // Convertir a días
        const semanas = Math.floor(díasTotales / 7);
        const meses = Math.floor(díasTotales / 30.44); // Promedio de días en un mes
        const años = Math.floor(díasTotales / 365.25); // Promedio de días en un año

        return { días: díasTotales, semanas, meses, años };
    }

    // Función para mostrar la edad según el rango
    function mostrarEdad({ días, semanas, meses, años }) {
        if (años >= 1) {
            return `${años} año${años > 1 ? "s" : ""}`;
        } else if (meses >= 1) {
            return `${meses} mes${meses > 1 ? "es" : ""}`;
        } else if (semanas >= 1) {
            return `${semanas} semana${semanas > 1 ? "s" : ""}`;
        } else {
            return `${días} día${días > 1 ? "s" : ""}`;
        }
    }

    // Función para calcular el tamaño del animal según el peso
    function calcularTamaño(peso) {
        if (peso <= 5) {
            return 'Pequeño';
        } else if (peso > 5 && peso <= 20) {
            return 'Mediano';
        } else if (peso > 20) {
            return 'Grande';
        }
    }

    // Obtener elementos del HTML
    const fechaNacimientoElement = document.getElementById("fecha_nacimiento");
    const fechaNacimiento = fechaNacimientoElement ? fechaNacimientoElement.textContent.trim() : "";

    const pesoElement = document.getElementById("animal-size");
    const peso = pesoElement ? parseFloat(pesoElement.textContent.trim()) : 0;

    // Calcular y mostrar la edad
    if (fechaNacimiento) {
        const edad = calcularEdad(fechaNacimiento);
        const edadTexto = mostrarEdad(edad);
        fechaNacimientoElement.textContent = edadTexto;
    } else {
        console.error("No se encontró la fecha de nacimiento.");
    }

    // Calcular y mostrar el tamaño
    if (!isNaN(peso)) {
        const tamaño = calcularTamaño(peso);
        pesoElement.textContent = tamaño;
    } else {
        console.error("No se encontró el peso.");
    }
});
