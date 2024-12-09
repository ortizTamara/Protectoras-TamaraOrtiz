document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.querySelector('input[type="search"]');
    if (searchInput) {
        searchInput.addEventListener('input', function (event) {
            const input = event.target;
            const form = input.closest('form');

            // Si el campo está vacío, envía el formulario para resetear la búsqueda
            if (input.value === '') {
                form.submit();
            }
        });
    }
});
