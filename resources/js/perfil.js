
document.addEventListener("DOMContentLoaded", function () {
    // Para la foto de perfil
    const uploadButton = document.getElementById("uploadButton");
    const fotoInput = document.getElementById("foto");

    if (uploadButton && fotoInput) {
        // console.log("Elementos de logo encontrados");
        uploadButton.addEventListener("click", function () {
            fotoInput.click();
        });

        fotoInput.addEventListener("change", function () {
            if (fotoInput.files && fotoInput.files[0]) {
                fotoInput.closest("form").submit();
            }
        });
    } else {
        console.log("Elementos de foto no encontrados.");
    }

    // Para el logo de protectora
    const uploadLogoButton = document.getElementById("uploadButtonLogo");
    const logoInput = document.getElementById("logo");

    if (uploadLogoButton && logoInput) {
        // console.log("Elementos de logo encontrados");
        uploadLogoButton.addEventListener("click", function () {
            logoInput.click();
        });

        logoInput.addEventListener("change", function () {
            if (logoInput.files && logoInput.files[0]) {
                logoInput.closest("form").submit();
            }
        });
    } else {
        console.log("Elementos de logo no encontrados.");
    }
});
