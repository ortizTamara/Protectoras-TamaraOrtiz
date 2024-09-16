let isShelter = false;

function toggleShelterForm() {
    isShelter = !isShelter;
    const shelterForm = document.getElementById("shelterForm");
    const shelterToggleText = document.getElementById("shelterToggleText");
    const submitBtn = document.getElementById("submitBtn");
    const userForm = document.getElementById("userForm");

    if (isShelter) {
        shelterForm.style.display = "block";
        shelterToggleText.textContent = "¿Eres un usuario normal?";
        submitBtn.textContent = "Registrar Protectora";

        userForm.classList.remove("col-md-12");
        userForm.classList.add("col-md-6");
    } else {
        shelterForm.style.display = "none";
        shelterToggleText.textContent = "¿Eres una protectora?";
        submitBtn.textContent = "Registrarse como Usuario";

        // Volver a hacer el formulario de usuario ocupar el ancho completo
        userForm.classList.remove("col-md-6");
        userForm.classList.add("col-md-12");
    }
}

function handleSubmit(event) {
    event.preventDefault();
    // Lógica para enviar los datos
    console.log("Form submitted");
}
