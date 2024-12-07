// document.addEventListener('DOMContentLoaded', function() {
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

//             heartIcon.classList.add('selected');
//         } else {
//             heartIcon.classList.remove('selected');
//         }
//     }

//     const favoriteButtons = document.querySelectorAll('.favorite-icon-btn');
//     favoriteButtons.forEach(button => {
//         button.addEventListener('click', explodeParticles);
//     });

//     const favoriteLinks = document.querySelectorAll('a');
//     favoriteLinks.forEach(link => {
//         link.addEventListener('click', function(event) {
//             event.preventDefault();
//         });
//     });
// });
document.addEventListener('DOMContentLoaded', function () {
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

            heartIcon.classList.add('selected');
        } else {
            heartIcon.classList.remove('selected');
        }
    }

    const favoriteButtons = document.querySelectorAll('.favorite-icon-btn');
    favoriteButtons.forEach(button => {
        button.addEventListener('click', explodeParticles);
    });
});
