document.addEventListener('DOMContentLoaded', function () {
    const favoriteButtons = document.querySelectorAll('.favorite-icon-btn');

    favoriteButtons.forEach(button => {
        button.addEventListener('click', function (event) {
            event.preventDefault();

            const form = this.closest('form');
            const animalId = form.querySelector('input[name="animal_id"]').value;

            if (!animalId) {
                console.error('ID del animal no encontrado.');
                return;
            }

            const url = `/favoritos/${animalId}`;
            const method = this.querySelector('.favorite-icon').classList.contains('selected') ? 'DELETE' : 'POST';

            fetch(url, {
                method: method,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
                body: new FormData(form),
            })
            .then(response => {
                if (response.ok) {
                    const animalElement = document.getElementById(`animal-${animalId}`);
                    if (method === 'DELETE' && animalElement) {
                        animalElement.style.transition = 'opacity 0.5s ease-out';
                        animalElement.style.opacity = '0';
                        setTimeout(() => animalElement.remove(), 200);
                    }
                    const heartIcon = this.querySelector('.favorite-icon');
                    heartIcon.classList.toggle('selected');
                    heartIcon.classList.toggle('text-danger');
                } else {
                    alert('Ocurrió un error al intentar actualizar el favorito.');
                }
            })
            .catch(error => {
                console.error('Error al procesar el favorito:', error);
                alert('Error al procesar la solicitud.');
            });
        });
    });
});
