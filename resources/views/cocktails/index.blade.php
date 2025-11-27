<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-900 leading-tight">
            🍹 Explorar Cócteles
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Search Bar -->
            <div class="mb-8">
                <form id="searchForm" class="flex gap-2">
                    <input
                        type="text"
                        id="searchInput"
                        placeholder="Buscar cócteles por nombre..."
                        class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        value="{{ $search }}"
                    >
                    <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 font-semibold">
                        🔍 Buscar
                    </button>
                </form>
            </div>

            <!-- Cocktails Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($cocktails as $cocktail)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
                        <!-- Cocktail Image -->
                        <div class="w-full h-48 overflow-hidden bg-gray-200">
                            <img
                                src="{{ $cocktail['strDrinkThumb'] }}"
                                alt="{{ $cocktail['strDrink'] }}"
                                class="w-full h-full object-cover hover:scale-105 transition"
                            >
                        </div>

                        <!-- Cocktail Info -->
                        <div class="p-4">
                            <h3 class="font-bold text-lg text-gray-900">{{ $cocktail['strDrink'] }}</h3>
                            <p class="text-sm text-gray-600 mb-2">{{ $cocktail['strCategory'] ?? 'N/A' }}</p>
                            <p class="text-xs text-gray-500 mb-4">🥃 {{ $cocktail['strGlass'] ?? 'Unknown Glass' }}</p>

                            <!-- Save Button -->
                            <button
                                class="save-cocktail w-full bg-green-600 text-white py-2 rounded-md hover:bg-green-700 font-semibold transition"
                                data-id="{{ $cocktail['idDrink'] }}"
                            >
                                💾 Guardar en Favoritos
                            </button>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-12">
                        <p class="text-gray-500 text-lg">¡No se encontraron cócteles. ¡Intenta otra búsqueda!</p>
                    </div>
                @endforelse
            </div>

            <!-- Link to Favorites -->
            <div class="mt-12 text-center">
                <a href="{{ route('cocktails.favorites') }}" class="inline-block bg-blue-600 text-white px-8 py-3 rounded-lg hover:bg-blue-700 font-semibold">
                    ⭐ Ver Mis Favoritos
                </a>
            </div>

        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            console.log('🍹 Cocktails page loaded');
            console.log('jQuery available:', typeof $ !== 'undefined');
            console.log('Swal available:', typeof Swal !== 'undefined');

            // Save cocktail handler
            document.querySelectorAll('.save-cocktail').forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    console.log('Save button clicked');

                    const cocktailId = this.getAttribute('data-id');
                    const originalText = this.innerHTML;

                    this.disabled = true;
                    this.innerHTML = '⏳ Saving...';

                    fetch('{{ route("cocktails.store") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({
                            api_id: cocktailId
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        console.log('Save response:', data);
                        if (data.success) {
                            this.innerHTML = '✓ Guardado';
                            this.classList.remove('bg-green-600', 'hover:bg-green-700');
                            this.classList.add('bg-gray-400');

                            if (typeof Swal !== 'undefined') {
                                Swal.fire({
                                    icon: 'success',
                                    title: '✓ ¡Guardado!',
                                    text: 'Cóctel añadido a favoritos',
                                    timer: 2000,
                                    showConfirmButton: false
                                });
                            } else {
                                alert('✓ ¡Cóctel guardado exitosamente!');
                            }
                        }
                    })
                    .catch(error => {
                        console.error('Save error:', error);
                        this.disabled = false;
                        this.innerHTML = originalText;

                        if (typeof Swal !== 'undefined') {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'No se pudo guardar el cóctel'
                            });
                        } else {
                            alert('Error al guardar el cóctel');
                        }
                    });
                });
            });

            // Search form
            const searchForm = document.getElementById('searchForm');
            if (searchForm) {
                searchForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    const searchTerm = document.getElementById('searchInput').value;
                    window.location.href = '{{ route("cocktails.index") }}?search=' + encodeURIComponent(searchTerm);
                });
            }
        });
    </script>
    @endpush
</x-app-layout>
