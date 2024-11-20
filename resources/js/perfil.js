// Función para manejar la vista previa de la foto
// document.addEventListener('DOMContentLoaded', function () {
//     const inputFile = document.getElementById('foto');
//     const profilePreview = document.getElementById('profilePreview');

//     // Agregar un evento para cuando se seleccione un archivo
//     inputFile.addEventListener('change', function (event) {
//         const file = event.target.files[0]; // Obtener el archivo seleccionado
//         if (file) {
//             const reader = new FileReader();

//             // Leer el archivo y establecerlo como fuente de la imagen de vista previa
//             reader.onload = function (e) {
//                 profilePreview.src = e.target.result; // Mostrar la imagen seleccionada
//             };

//             reader.readAsDataURL(file); // Leer el archivo como una URL
//         }
//     });
// });
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
