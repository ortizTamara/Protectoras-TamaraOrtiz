// PRUEBA 1
document.addEventListener('DOMContentLoaded', function () {
    function toggleFavorite(event) {
        event.preventDefault();

        const button = event.currentTarget;
        const heartIcon = button.querySelector('.favorite-icon');
        const isSelected = heartIcon.classList.contains('selected');
        const form = button.closest('form');
        const animalId = form.querySelector('input[name="animal_id"]').value;

        if (!animalId) {
            console.error('ID del animal no encontrado.');
            return;
        }

        const url = `/favoritos/${animalId}`;
        const method = isSelected ? 'DELETE' : 'POST';

        fetch(url, {
            method: method,
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
        })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Error al procesar la solicitud.');
                }
                return response.json();
            })
            .then(data => {
                console.log(data.message);

                if (isSelected) {
                    heartIcon.classList.remove('selected', 'text-danger');

                    // Si estamos en la página de favoritos, aplicar efecto de desvanecimiento
                    if (window.location.pathname === '/favoritos') {
                        const card = button.closest('.col-3');
                        if (card) {
                            card.classList.add('fade-out'); // Añadir la clase para desvanecer
                            setTimeout(() => {
                                card.remove(); // Eliminar la tarjeta después del efecto
                            }, 500); // Tiempo de la animación
                        } else {
                            console.error('No se encontró la tarjeta para el animal.');
                        }
                    }
                } else {
                    heartIcon.classList.add('selected', 'text-danger');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Hubo un error. Por favor, intenta nuevamente.');
            });
    }

    function explodeParticles(event) {
        event.preventDefault();

        const button = event.currentTarget;
        const rect = button.getBoundingClientRect();
        const particlesContainer = button;

        const heartIcon = button.querySelector('.favorite-icon');
        const isSelected = heartIcon.classList.contains('selected');

        if (!isSelected) {
            for (let i = 0; i < 15; i++) {
                const particle = document.createElement("i");
                particle.classList.add("fas", "fa-paw", "particle");

                particle.style.left = `${rect.width / 2 - 10}px`;
                particle.style.top = `${rect.height / 2 - 10}px`;

                const angle = Math.random() * 360;
                const distance = Math.random() * 60 + 40;

                const x = distance * Math.cos(angle);
                const y = distance * Math.sin(angle);

                particle.style.setProperty("--x", `${x}px`);
                particle.style.setProperty("--y", `${y}px`);

                particlesContainer.appendChild(particle);

                setTimeout(() => {
                    particle.remove();
                }, 2000);
            }
        }

        toggleFavorite(event);
    }

    const favoriteButtons = document.querySelectorAll('.favorite-icon-btn');
    favoriteButtons.forEach(button => {
        button.addEventListener('click', explodeParticles);
    });
});


// PRUEBA 2
// document.addEventListener('DOMContentLoaded', function () {
//     function toggleFavorite(event) {
//         event.preventDefault();

//         const button = event.currentTarget;
//         const heartIcon = button.querySelector('.favorite-icon');
//         const isSelected = heartIcon.classList.contains('selected');
//         const form = button.closest('form');
//         const animalId = form.querySelector('input[name="animal_id"]').value;

//         if (!animalId) {
//             console.error('ID del animal no encontrado.');
//             return;
//         }

//         const url = `/favoritos/${animalId}`;
//         const method = isSelected ? 'DELETE' : 'POST';

//         fetch(url, {
//             method: method,
//             headers: {
//                 'Content-Type': 'application/json',
//                 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
//             },
//         })
//             .then(response => {
//                 if (!response.ok) {
//                     throw new Error('Error al procesar la solicitud.');
//                 }
//                 return response.json();
//             })
//             .then(data => {
//                 console.log(data.message);

//                 // Recargar la página después de procesar correctamente
//                 location.reload();
//             })
//             .catch(error => {
//                 console.error('Error:', error);
//                 alert('Hubo un error. Por favor, intenta nuevamente.');
//             });
//     }

//     function explodeParticles(event) {
//         event.preventDefault();

//         const button = event.currentTarget;
//         const rect = button.getBoundingClientRect();
//         const particlesContainer = button;

//         const heartIcon = button.querySelector('.favorite-icon');
//         const isSelected = heartIcon.classList.contains('selected');

//         if (!isSelected) {
//             for (let i = 0; i < 15; i++) {
//                 const particle = document.createElement("i");
//                 particle.classList.add("fas", "fa-paw", "particle");

//                 particle.style.left = `${rect.width / 2 - 10}px`;
//                 particle.style.top = `${rect.height / 2 - 10}px`;

//                 const angle = Math.random() * 360;
//                 const distance = Math.random() * 60 + 40;

//                 const x = distance * Math.cos(angle);
//                 const y = distance * Math.sin(angle);

//                 particle.style.setProperty("--x", `${x}px`);
//                 particle.style.setProperty("--y", `${y}px`);

//                 particlesContainer.appendChild(particle);

//                 setTimeout(() => {
//                     particle.remove();
//                 }, 2000);
//             }
//         }

//         toggleFavorite(event);
//     }

//     const favoriteButtons = document.querySelectorAll('.favorite-icon-btn');
//     favoriteButtons.forEach(button => {
//         button.addEventListener('click', explodeParticles);
//     });
// });
