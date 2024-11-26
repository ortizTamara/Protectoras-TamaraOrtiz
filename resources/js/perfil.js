
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



    // Para la imagen del animal
    // const uploadImageButton = document.getElementById("uploadButtonImagen");
    // const imagenInput = document.getElementById("imagen");

    // if (uploadImageButton && imagenInput) {
    //     uploadImageButton.addEventListener("click", function () {
    //         imagenInput.click();
    //     });

    //     imagenInput.addEventListener("change", function () {
    //         if (imagenInput.files && imagenInput.files[0]) {
    //             imagenInput.closest("form").submit();
    //         }
    //     });
    // } else {
    //     console.log("Elementos de imagen no encontrados.");
    // }
    const imagenInput = document.getElementById("imagen");
    const preview = document.getElementById("imagen_preview");
    const fileName = document.getElementById("imagenName");

    if (imagenInput) {
        imagenInput.addEventListener("change", function () {
            if (imagenInput.files && imagenInput.files[0]) {
                const reader = new FileReader();

                reader.onload = function (e) {
                    preview.src = e.target.result;
                    preview.classList.remove("d-none");
                };

                fileName.textContent = imagenInput.files[0].name;
                reader.readAsDataURL(imagenInput.files[0]);
            }
        });
    }
});
