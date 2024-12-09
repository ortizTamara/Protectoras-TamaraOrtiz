document.addEventListener('DOMContentLoaded', function () {
    const ageRange = document.getElementById('ageRange');
    const selectedAge = document.getElementById('selectedAge');
    const rangeValue = document.getElementById('rangeValue');

    // Mostrar el valor inicial
    rangeValue.textContent = ageRange.value;
    rangeValue.classList.remove('d-none');

    // Actualizar los valores en tiempo real
    ageRange.addEventListener('input', function () {
        const ageValue = ageRange.value;
        selectedAge.value = ageValue;
        rangeValue.textContent = ageValue;
    });
});
