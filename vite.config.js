import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                 'resources/css/app.css',
                'resources/js/registrarse.js',
                'resources/js/app.js',
                'resources/js/calcularEdadTamanio.js',
                'resources/js/marcarFavorito.js',
                'resources/js/miProtectora.js',
                'resources/js/ocultarAnimal.js',
                'resources/js/ocultarFavorito.js',
                'resources/js/perfil.js',
                'resources/js/rangoEdad.js',
                'resources/js/registrarse.js',
                'resources/js/resetearBusqueda.js',
                'resources/js/seleccionarEspecie.js',
                'resources/js/validador.js',
                'resources/js/validadorAnimal.js'
            ],
            refresh: true,
        }),
    ],
    css: {
        preprocessorOptions: {
            scss: {
                quietDeps: true, // Ignorar las advertencias de dependencias
            },
        },
    },
});
