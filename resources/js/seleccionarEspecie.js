document.addEventListener("DOMContentLoaded", function () {
    const especieSelect = document.getElementById("especie_id");
    const razaSelect = document.getElementById("raza_id");

    especieSelect.addEventListener("change", function () {
        const especieId = this.value;

        // Realizamos una solicitud http para obtener las razas asociadas a la especie seleccionada
        fetch(`/especies/${especieId}/razas`)
            .then(response => {
                if (!response.ok) {
                    throw new Error("Error al recuperar las razas");
                }
                return response.json();
            })
            .then(data => {
                razaSelect.innerHTML = '<option value="" disabled selected>Selecciona una raza</option>';

                data.forEach(raza => {
                    const option = document.createElement("option");
                    option.value = raza.id;
                    option.textContent = raza.nombre;
                    razaSelect.appendChild(option);
                });
            })
            .catch(error => console.error("Error:", error));
    });
});