// document.addEventListener("DOMContentLoaded", function () {
//     const especieSelect = document.getElementById("especie_id");
//     const razaSelect = document.getElementById("raza_id");

//     especieSelect.addEventListener("change", function () {
//         const especieId = this.value;

//         if (!especieId) {
//             fetch('/razas')
//                 .then(response => {
//                     if (!response.ok) {
//                         throw new Error("Error al recuperar las razas");
//                     }
//                     return response.json();
//                 })
//                 .then(data => {
//                     razaSelect.innerHTML = '<option value="" disabled selected>Selecciona una raza</option>';

//                     data.forEach(raza => {
//                         const option = document.createElement("option");
//                         option.value = raza.id;
//                         option.textContent = raza.nombre;
//                         razaSelect.appendChild(option);
//                     });
//                 })
//                 .catch(error => console.error("Error:", error));
//         } else {
//             fetch(`/razas/${especieId}`)
//                 .then(response => {
//                     if (!response.ok) {
//                         throw new Error("Error al recuperar las razas");
//                     }
//                     return response.json();
//                 })
//                 .then(data => {
//                     razaSelect.innerHTML = '<option value="" disabled selected>Selecciona una raza</option>';

//                     data.forEach(raza => {
//                         const option = document.createElement("option");
//                         option.value = raza.id;
//                         option.textContent = raza.nombre;
//                         razaSelect.appendChild(option);
//                     });
//                 })
//                 .catch(error => console.error("Error:", error));
//         }
//     });
// });
document.addEventListener("DOMContentLoaded", function () {
    const especieSelect = document.getElementById("especie_id");
    const razaSelect = document.getElementById("raza_id");

    function cargarRazas(especieId) {
        // Si no hay especie seleccionada, cargar todas las razas
        if (!especieId) {
            fetch('/razas')
                .then(response => {
                    if (!response.ok) {
                        throw new Error("Error al recuperar las razas");
                    }
                    return response.json();
                })
                .then(data => {
                    razaSelect.innerHTML = '<option value="">Todas</option>';

                    data.forEach(raza => {
                        const option = document.createElement("option");
                        option.value = raza.id;
                        option.textContent = raza.nombre;
                        razaSelect.appendChild(option);
                    });
                })
                .catch(error => console.error("Error:", error));
        } else {
            // Si hay especie seleccionada, cargar razas específicas
            fetch(`/razas/${especieId}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error("Error al recuperar las razas");
                    }
                    return response.json();
                })
                .then(data => {
                    razaSelect.innerHTML = '<option value="">Todas</option>'; // Resetear al cambiar especie

                    data.forEach(raza => {
                        const option = document.createElement("option");
                        option.value = raza.id;
                        option.textContent = raza.nombre;
                        razaSelect.appendChild(option);
                    });
                })
                .catch(error => console.error("Error:", error));
        }
    }

    // Escuchar cambios en el selector de especie
    especieSelect.addEventListener("change", function () {
        const especieId = this.value;
        razaSelect.value = ""; // Resetear la selección de raza
        cargarRazas(especieId);
    });

    // Cargar razas iniciales basadas en la especie seleccionada (al cargar la página)
    if (especieSelect.value) {
        cargarRazas(especieSelect.value);
    }
});
