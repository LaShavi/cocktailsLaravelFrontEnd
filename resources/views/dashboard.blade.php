<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-900 leading-tight">
            🍹 Panel
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Welcome Section -->
            <div class="mb-12">
                <div class="bg-white rounded-lg shadow p-8">
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">¡Bienvenido, {{ Auth::user()->name }}! 👋</h3>
                    <p class="text-gray-600">Explora y gestiona tus cócteles favoritos fácilmente.</p>
                </div>
            </div>

            <!-- Quick Actions Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
                <div class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition">
                    <h4 class="text-xl font-bold text-blue-600 mb-2">🔍 Explorar</h4>
                    <p class="text-gray-600 mb-4">Descubre cócteles de nuestra base de datos API</p>
                    <a href="{{ route('cocktails.index') }}" class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 font-semibold text-sm">
                        Comenzar a Explorar →
                    </a>
                </div>

                <div class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition">
                    <h4 class="text-xl font-bold text-green-600 mb-2">💾 Favoritos</h4>
                    <p class="text-gray-600 mb-4">Ve y gestiona tu colección guardada</p>
                    <a href="{{ route('cocktails.favorites') }}" class="inline-block bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 font-semibold text-sm">
                        Mis Favoritos →
                    </a>
                </div>

                <div class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition">
                    <h4 class="text-xl font-bold text-purple-600 mb-2">⚙️ Perfil</h4>
                    <p class="text-gray-600 mb-4">Gestiona la configuración de tu cuenta</p>
                    <a href="{{ route('profile.edit') }}" class="inline-block bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700 font-semibold text-sm">
                        Mi Perfil →
                    </a>
                </div>
            </div>

            <!-- Info Box -->
            <div class="bg-blue-50 border-l-4 border-blue-600 rounded-lg p-6">
                <h4 class="text-lg font-bold text-blue-900 mb-2">💡 Primeros Pasos</h4>
                <p class="text-blue-800">Usa la navegación anterior para explorar cócteles, guarda tus favoritos y gestiona tu perfil. ¡Feliz mezcla!</p>
            </div>

        </div>
    </div>
</x-app-layout>
