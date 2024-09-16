@extends('layouts.app')

@section('content')
    <h1 class="text-4xl font-bold text-teal-800 mb-8">Protectoras de Animales</h1>

    <div class="mb-8 flex items-center">
        <input type="text" placeholder="Buscar protectoras..."
            class="flex-grow text-lg py-6 px-4 border border-gray-300 rounded-lg">
        <button class="ml-4 bg-teal-600 hover:bg-teal-700 text-white px-8 py-6 flex items-center">
            <svg class="icon h-6 w-6 mr-2">
                <use href="https://unpkg.com/lucide@0.41.0/icons/search.svg#search"></use>
            </svg>
            <span>Buscar</span>
        </button>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <!-- Ejemplo de protectora 1 -->
        <div class="bg-white shadow-lg hover:shadow-xl transition-shadow duration-300 rounded-lg">
            <div class="p-6">
                <div class="mb-4 flex justify-center">
                    <img src="/placeholder.svg?height=200&width=200" alt="Arca de Noé"
                        class="w-32 h-32 rounded-full object-cover border-4 border-teal-500" />
                </div>
                <h3 class="text-2xl font-bold text-teal-700 text-center mb-2">Arca de Noé</h3>
                <div class="flex items-center justify-center text-gray-600 mb-4">
                    <svg class="icon h-5 w-5 mr-2">
                        <use href="https://unpkg.com/lucide@0.41.0/icons/map-pin.svg#map-pin"></use>
                    </svg>
                    <p>Sevilla, España</p>
                </div>
                <div class="flex items-center justify-center text-teal-600 font-semibold">
                    <svg class="icon h-6 w-6 mr-2">
                        <use href="https://unpkg.com/lucide@0.41.0/icons/users.svg#users"></use>
                    </svg>
                    <p>16 casos en adopción</p>
                </div>
            </div>
            <div class="bg-teal-50 p-4 flex justify-center">
                <button
                    class="text-teal-600 hover:bg-teal-100 border-teal-300 border px-4 py-2 rounded-lg flex items-center">
                    <svg class="icon h-5 w-5 mr-2">
                        <use href="https://unpkg.com/lucide@0.41.0/icons/info.svg#info"></use>
                    </svg>
                    Más información
                </button>
            </div>
        </div>

        <!-- Ejemplo de protectora 2 -->
        <div class="bg-white shadow-lg hover:shadow-xl transition-shadow duration-300 rounded-lg">
            <div class="p-6">
                <div class="mb-4 flex justify-center">
                    <img src="/placeholder.svg?height=200&width=200" alt="Miguel Tisera"
                        class="w-32 h-32 rounded-full object-cover border-4 border-teal-500" />
                </div>
                <h3 class="text-2xl font-bold text-teal-700 text-center mb-2">Miguel Tisera</h3>
                <div class="flex items-center justify-center text-gray-600 mb-4">
                    <svg class="icon h-5 w-5 mr-2">
                        <use href="https://unpkg.com/lucide@0.41.0/icons/map-pin.svg#map-pin"></use>
                    </svg>
                    <p>Santa Fe, Argentina</p>
                </div>
                <div class="flex items-center justify-center text-teal-600 font-semibold">
                    <svg class="icon h-6 w-6 mr-2">
                        <use href="https://unpkg.com/lucide@0.41.0/icons/users.svg#users"></use>
                    </svg>
                    <p>1 caso en adopción</p>
                </div>
            </div>
            <div class="bg-teal-50 p-4 flex justify-center">
                <button
                    class="text-teal-600 hover:bg-teal-100 border-teal-300 border px-4 py-2 rounded-lg flex items-center">
                    <svg class="icon h-5 w-5 mr-2">
                        <use href="https://unpkg.com/lucide@0.41.0/icons/info.svg#info"></use>
                    </svg>
                    Más información
                </button>
            </div>
        </div>

        <!-- Repite el mismo bloque para más protectoras -->
        <!-- Ejemplo de protectora 3 -->
        <div class="bg-white shadow-lg hover:shadow-xl transition-shadow duration-300 rounded-lg">
            <div class="p-6">
                <div class="mb-4 flex justify-center">
                    <img src="/placeholder.svg?height=200&width=200" alt="Rescate Animal Marina Alta"
                        class="w-32 h-32 rounded-full object-cover border-4 border-teal-500" />
                </div>
                <h3 class="text-2xl font-bold text-teal-700 text-center mb-2">Rescate Animal Marina Alta</h3>
                <div class="flex items-center justify-center text-gray-600 mb-4">
                    <svg class="icon h-5 w-5 mr-2">
                        <use href="https://unpkg.com/lucide@0.41.0/icons/map-pin.svg#map-pin"></use>
                    </svg>
                    <p>Alicante, España</p>
                </div>
                <div class="flex items-center justify-center text-teal-600 font-semibold">
                    <svg class="icon h-6 w-6 mr-2">
                        <use href="https://unpkg.com/lucide@0.41.0/icons/users.svg#users"></use>
                    </svg>
                    <p>21 casos en adopción</p>
                </div>
            </div>
            <div class="bg-teal-50 p-4 flex justify-center">
                <button
                    class="text-teal-600 hover:bg-teal-100 border-teal-300 border px-4 py-2 rounded-lg flex items-center">
                    <svg class="icon h-5 w-5 mr-2">
                        <use href="https://unpkg.com/lucide@0.41.0/icons/info.svg#info"></use>
                    </svg>
                    Más información
                </button>
            </div>
        </div>

    </div>
@endsection
