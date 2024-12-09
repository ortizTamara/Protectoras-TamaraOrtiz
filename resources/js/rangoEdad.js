document.addEventListener('DOMContentLoaded', function () {
    const ageRange = document.getElementById('ageRange');
    const selectedAge = document.getElementById('selectedAge');
    const rangeValue = document.getElementById('rangeValue');

    rangeValue.textContent = ageRange.value;
    rangeValue.classList.remove('d-none');

    ageRange.addEventListener('input', function () {
        const ageValue = ageRange.value;
        selectedAge.value = ageValue;
        rangeValue.textContent = ageValue;
    });
});
