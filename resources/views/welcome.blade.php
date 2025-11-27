<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Aplicación de Cócteles</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-900">
    <!-- Navigation -->
    <nav class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-blue-600">🍹 Aplicación de Cócteles</h1>
            <div class="space-x-4">
                @auth
                    <a href="{{ url('/dashboard') }}" class="text-blue-600 hover:text-blue-800 font-semibold">Panel</a>
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="text-red-600 hover:text-red-800 font-semibold">Cerrar Sesión</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 font-semibold">Iniciar Sesión</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700 font-semibold">Registrarse</a>
                    @endif
                @endauth
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
        <div class="text-center">
            <h2 class="text-5xl font-bold text-gray-900 mb-6">Bienvenido a la Aplicación de Cócteles</h2>
            <p class="text-xl text-gray-600 mb-8">Explora, guarda y gestiona tus cócteles favoritos</p>

            @guest
                <div class="space-x-4">
                    <a href="{{ route('login') }}" class="inline-block bg-blue-600 text-white px-8 py-3 rounded-lg hover:bg-blue-700 font-semibold text-lg">
                        Comenzar - Iniciar Sesión
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="inline-block border-2 border-blue-600 text-blue-600 px-8 py-3 rounded-lg hover:bg-blue-50 font-semibold text-lg">
                            Crear Cuenta
                        </a>
                    @endif
                </div>
            @else
                <a href="{{ url('/dashboard') }}" class="inline-block bg-blue-600 text-white px-8 py-3 rounded-lg hover:bg-blue-700 font-semibold text-lg">
                    Ir al Panel
                </a>
            @endguest
        </div>

        <!-- Features Section -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-20">
            <div class="bg-white p-8 rounded-lg shadow">
                <h3 class="text-2xl font-bold text-blue-600 mb-4">🔍 Explorar</h3>
                <p class="text-gray-600">Explora miles de cócteles de nuestra base de datos API</p>
            </div>
            <div class="bg-white p-8 rounded-lg shadow">
                <h3 class="text-2xl font-bold text-blue-600 mb-4">💾 Guardar</h3>
                <p class="text-gray-600">Guarda tus cócteles favoritos en tu colección personal</p>
            </div>
            <div class="bg-white p-8 rounded-lg shadow">
                <h3 class="text-2xl font-bold text-blue-600 mb-4">📊 Gestionar</h3>
                <p class="text-gray-600">Organiza y gestiona todos tus cócteles guardados fácilmente</p>
            </div>
        </div>
    </div>
</body>
</html>
