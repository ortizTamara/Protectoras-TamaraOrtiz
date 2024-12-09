// document.addEventListener('DOMContentLoaded', function () {
//     const ageRangeInput = document.getElementById('ageRange');
//     const selectedAgeInput = document.getElementById('selectedAge');
//     const rangeValue = document.getElementById('rangeValue');

//     function updateRangeValue() {
//         const min = parseInt(ageRangeInput.min);
//         const max = parseInt(ageRangeInput.max);
//         const val = parseInt(ageRangeInput.value);

//         if (val !== min && val !== max && !isNaN(val)) {
//             rangeValue.style.opacity = 1;
//             rangeValue.textContent = val;
//             selectedAgeInput.value = val;
//         } else {
//             rangeValue.style.opacity = 0;
//             selectedAgeInput.value = '';
//         }

//         // Ajustar posición
//         const percentage = ((val - min) / (max - min)) * 100;
//         rangeValue.style.left = `calc(${percentage}% + (${8 - percentage * 0.15}px))`;
//     }

//     updateRangeValue();

//     ageRangeInput.addEventListener('input', updateRangeValue);
//     });

// PRUEBA 2
document.addEventListener('DOMContentLoaded', function () {
    const ageRangeInput = document.getElementById('ageRange');
    const selectedAgeInput = document.getElementById('selectedAge');
    const rangeValue = document.getElementById('rangeValue');
    const currentAgeDisplay = document.getElementById('currentAgeDisplay');

    function updateRangeValue() {
        const min = parseInt(ageRangeInput.min);
        const max = parseInt(ageRangeInput.max);
        const val = parseInt(ageRangeInput.value);

        if (val !== min && val !== max && !isNaN(val)) {
            rangeValue.style.opacity = 1;
            rangeValue.textContent = val;
            currentAgeDisplay.textContent = `Edad seleccionada: ${val} años`;
            selectedAgeInput.value = val;
        } else {
            rangeValue.style.opacity = 0;
            currentAgeDisplay.textContent = '';
            selectedAgeInput.value = '';
        }

        const percentage = ((val - min) / (max - min)) * 100;
        rangeValue.style.left = `calc(${percentage}% + (${8 - percentage * 0.15}px))`;
    }

    updateRangeValue();

    ageRangeInput.addEventListener('input', updateRangeValue);
});

// PRUEBA 3
// document.addEventListener('DOMContentLoaded', function () {
//     const ageRangeInput = document.getElementById('ageRange');
//     const selectedAgeInput = document.getElementById('selectedAge');
//     const rangeValue = document.getElementById('rangeValue');
//     const currentAgeDisplay = document.getElementById('currentAgeDisplay');

//     function updateRangeValue() {
//         const min = parseInt(ageRangeInput.min);
//         const max = parseInt(ageRangeInput.max);
//         const val = parseInt(ageRangeInput.value);

//         rangeValue.style.opacity = 1;
//         rangeValue.textContent = val;
//         currentAgeDisplay.textContent = `Edad seleccionada: ${val} años`;
//         selectedAgeInput.value = val;

//         const percentage = ((val - min) / (max - min)) * 100;
//         rangeValue.style.left = `calc(${percentage}% + (${8 - percentage * 0.15}px))`;
//     }

//     updateRangeValue();

//     // Escuchar cambios en el rango
//     ageRangeInput.addEventListener('input', updateRangeValue);
// });

// PRUEBA 4
// document.addEventListener('DOMContentLoaded', function () {
//     const ageRangeInput = document.getElementById('ageRange');
//     const selectedAgeInput = document.getElementById('selectedAge');
//     const rangeValue = document.getElementById('rangeValue');
//     const currentAgeDisplay = document.getElementById('currentAgeDisplay');

//     function updateRangeValue() {
//         const min = parseInt(ageRangeInput.min);
//         const max = parseInt(ageRangeInput.max);
//         const val = ageRangeInput.value ? parseInt(ageRangeInput.value) : null;

//         if (val !== null && val !== min && val !== max) {
//             rangeValue.style.opacity = 1;
//             rangeValue.textContent = val;
//             currentAgeDisplay.textContent = `Edad seleccionada: ${val} años`;
//             selectedAgeInput.value = val;
//         } else {
//             rangeValue.style.opacity = 0;
//             currentAgeDisplay.textContent = '';
//             selectedAgeInput.value = '';
//         }

//         if (val !== null) {
//             const percentage = ((val - min) / (max - min)) * 100;
//             rangeValue.style.left = `calc(${percentage}% + (${8 - percentage * 0.15}px))`;
//         }
//     }

//     updateRangeValue();

//     ageRangeInput.addEventListener('input', updateRangeValue);
// });
