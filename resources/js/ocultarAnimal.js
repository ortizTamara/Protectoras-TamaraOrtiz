document.addEventListener('DOMContentLoaded', function () {
    const deleteButtons = document.querySelectorAll('.delete-animal');

    deleteButtons.forEach(button => {
        button.addEventListener('click', function (event) {
            event.preventDefault();

            const animalId = this.dataset.id;
            const form = this.closest('form');

            fetch(form.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
                body: new FormData(form),
            })
            .then(response => {
                if (response.ok) {
                    const animalElement = document.getElementById(`animal-${animalId}`);
                    if (animalElement) {
                        animalElement.style.transition = 'opacity 0.5s';
                        animalElement.style.opacity = '0';
                        setTimeout(() => animalElement.remove(), 500);
                    }
                } else {
                    alert('Ocurrió un error al intentar eliminar el animal.');
                }
            })
            .catch(error => {
                console.error('Error al eliminar:', error);
                alert('Error al procesar la solicitud.');
            });
        });
    });
});
