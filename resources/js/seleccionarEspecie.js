document.addEventListener("DOMContentLoaded", function () {
    const especieSelect = document.getElementById("especie_id");
    const razaSelect = document.getElementById("raza_id");

    function cargarRazas(especieId) {
        const selectedRaza = razaSelect.value;

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

                        if (raza.id == selectedRaza) {
                            option.selected = true;
                        }

                        razaSelect.appendChild(option);
                    });
                })
                .catch(error => console.error("Error:", error));
        } else {
            fetch(`/razas/${especieId}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error("Error al recuperar las razas");
                    }
                    return response.json();
                })
                .then(data => {
                    razaSelect.innerHTML = '<option value="">Todas</option>';

                    let isSelectedRazaValid = false;

                    data.forEach(raza => {
                        const option = document.createElement("option");
                        option.value = raza.id;
                        option.textContent = raza.nombre;

                        if (raza.id == selectedRaza) {
                            option.selected = true;
                            isSelectedRazaValid = true;
                        }

                        razaSelect.appendChild(option);
                    });


                    if (!isSelectedRazaValid) {
                        razaSelect.value = "";
                    }
                })
                .catch(error => console.error("Error:", error));
        }
    }

    especieSelect.addEventListener("change", function () {
        const especieId = this.value;
        cargarRazas(especieId);
    });

    if (especieSelect.value) {
        cargarRazas(especieSelect.value);
    }
});
