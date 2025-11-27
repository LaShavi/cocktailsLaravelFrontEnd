<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-900 leading-tight">
            ⭐ Mis Cócteles Favoritos
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if($cocktails->count() > 0)
                <!-- DataTable Controls -->
                <div class="mb-4 flex justify-between items-center">
                    <div>
                        <label class="text-gray-700 font-semibold">Mostrar
                            <select id="pageLength" class="px-2 py-1 border border-gray-300 rounded">
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="-1">Todos</option>
                            </select>
                            entradas
                        </label>
                    </div>
                    <div>
                        <input type="text" id="tableSearch" placeholder="🔍 Buscar cócteles..." class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>

                <!-- DataTable Container -->
                <div class="bg-white rounded-lg shadow-md overflow-x-auto">
                    <table id="cocktailsTable" class="w-full border-collapse">
                        <thead>
                            <tr class="bg-gray-100 border-b-2 border-gray-300">
                                <th class="px-6 py-4 text-left text-sm font-bold text-gray-900 whitespace-nowrap">Imagen</th>
                                <th class="px-6 py-4 text-left text-sm font-bold text-gray-900 whitespace-nowrap">Nombre</th>
                                <th class="px-6 py-4 text-left text-sm font-bold text-gray-900 whitespace-nowrap">Categoría</th>
                                <th class="px-6 py-4 text-left text-sm font-bold text-gray-900 whitespace-nowrap">Copa</th>
                                <th class="px-6 py-4 text-center text-sm font-bold text-gray-900 whitespace-nowrap">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($cocktails as $cocktail)
                                <tr class="hover:bg-gray-50 transition" id="row-{{ $cocktail->id }}">
                                    <td class="px-6 py-4">
                                        <img src="{{ $cocktail->image_url }}" alt="{{ $cocktail->name }}" class="w-16 h-16 rounded-lg object-cover shadow-sm">
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="font-semibold text-gray-900">{{ $cocktail->name }}</span>
                                    </td>
                                    <td class="px-6 py-4 text-gray-600">{{ $cocktail->category ?? 'N/A' }}</td>
                                    <td class="px-6 py-4 text-gray-600">{{ $cocktail->glass ?? 'Unknown' }}</td>
                                    <td class="px-6 py-4 text-center">
                                        <button
                                            class="delete-cocktail inline-flex items-center gap-1 px-3 py-2 bg-red-600 text-white rounded hover:bg-red-700 font-semibold text-sm transition"
                                            data-id="{{ $cocktail->id }}"
                                        >
                                            🗑️ Eliminar
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination Info -->
                <div class="mt-6 text-sm text-gray-600 text-center mb-4">
                    <p>Mostrando <strong id="pageInfo">1</strong> a <strong id="endInfo">{{ min(10, $cocktails->count()) }}</strong> de <strong>{{ $cocktails->count() }}</strong> favoritos</p>
                </div>

                <!-- Pagination Buttons -->
                <div class="flex justify-center gap-4 mb-8">
                    <button id="prevBtn" class="px-6 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 font-semibold transition disabled:opacity-50 disabled:cursor-not-allowed" disabled>
                        ← Anterior
                    </button>
                    <span id="pageCounter" class="px-4 py-2 text-gray-700 font-semibold">Página <strong>1</strong></span>
                    <button id="nextBtn" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-semibold transition disabled:opacity-50 disabled:cursor-not-allowed">
                        Siguiente →
                    </button>
                </div>

                <!-- Link back to explore -->
                <div class="mt-8 text-center">
                    <a href="{{ route('cocktails.index') }}" class="inline-block bg-green-600 text-white px-8 py-3 rounded-lg hover:bg-green-700 font-semibold">
                        🔍 Continuar Explorando
                    </a>
                </div>
            @else
                <!-- Empty State -->
                <div class="bg-white rounded-lg shadow-md p-12 text-center">
                    <div class="text-6xl mb-4">🍸</div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">¡Sin Favoritos Aún</h3>
                    <p class="text-gray-600 mb-6">¡Comienza a explorar y guarda tus cócteles favoritos!</p>
                    <a href="{{ route('cocktails.index') }}" class="inline-block bg-green-600 text-white px-8 py-3 rounded-lg hover:bg-green-700 font-semibold">
                        🔍 Explorar Cócteles
                    </a>
                </div>
            @endif

        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            console.log('🍸 Favorites page loaded');

            @if($cocktails->count() > 0)
                // Simple pagination and filtering (no DataTable complexity)
                const table = document.getElementById('cocktailsTable');
                const tbody = table.querySelector('tbody');
                const allRows = Array.from(tbody.querySelectorAll('tr'));
                const pageLength = 10;
                let currentPage = 1;

                // Pagination elements
                const prevBtn = document.getElementById('prevBtn');
                const nextBtn = document.getElementById('nextBtn');
                const pageCounter = document.getElementById('pageCounter');

                // Handle page length change
                const pageLengthSelect = document.getElementById('pageLength');
                pageLengthSelect.addEventListener('change', function() {
                    currentPage = 1;
                    paginate();
                });

                // Handle search
                const searchInput = document.getElementById('tableSearch');
                searchInput.addEventListener('keyup', function() {
                    currentPage = 1;
                    paginate();
                });

                // Handle prev button
                prevBtn.addEventListener('click', function() {
                    if (currentPage > 1) {
                        currentPage--;
                        paginate();
                    }
                });

                // Handle next button
                nextBtn.addEventListener('click', function() {
                    const rows = getVisibleRows();
                    const itemsPerPage = pageLengthSelect.value == -1 ? rows.length : parseInt(pageLengthSelect.value);
                    const totalPages = Math.ceil(rows.length / itemsPerPage);
                    if (currentPage < totalPages) {
                        currentPage++;
                        paginate();
                    }
                });

                function getVisibleRows() {
                    const searchTerm = searchInput.value.toLowerCase();
                    return allRows.filter(row => {
                        const text = row.textContent.toLowerCase();
                        return text.includes(searchTerm);
                    });
                }

                function paginate() {
                    const rows = getVisibleRows();
                    const itemsPerPage = pageLengthSelect.value == -1 ? rows.length : parseInt(pageLengthSelect.value);
                    const totalPages = Math.ceil(rows.length / itemsPerPage);

                    // Hide all rows
                    allRows.forEach(row => row.style.display = 'none');

                    // Show current page rows
                    const start = (currentPage - 1) * itemsPerPage;
                    const end = Math.min(start + itemsPerPage, rows.length);

                    for (let i = start; i < end; i++) {
                        rows[i].style.display = '';
                    }

                    // Update page info
                    document.getElementById('pageInfo').textContent = rows.length === 0 ? 0 : start + 1;
                    document.getElementById('endInfo').textContent = end;

                    // Update buttons
                    prevBtn.disabled = currentPage === 1;
                    nextBtn.disabled = currentPage === totalPages || totalPages === 0;
                    pageCounter.innerHTML = `Página <strong>${currentPage}</strong> de <strong>${totalPages || 1}</strong>`;
                }

                // Initial pagination
                paginate();
            @endif            // Delete cocktail handler
            document.querySelectorAll('.delete-cocktail').forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    const cocktailId = this.getAttribute('data-id');
                    const row = document.getElementById(`row-${cocktailId}`);

                    if (typeof Swal !== 'undefined') {
                        Swal.fire({
                            title: '¿Eliminar Cóctel?',
                            text: '¡Esta acción no se puede deshacer!',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#d33',
                            cancelButtonColor: '#3085d6',
                            confirmButtonText: '¡Sí, elimínalo!',
                            cancelButtonText: 'Cancelar'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                performDelete(cocktailId, row);
                            }
                        });
                    } else {
                        if (confirm('¿Estás seguro de que quieres eliminar este cóctel?')) {
                            performDelete(cocktailId, row);
                        }
                    }
                });
            });

            function performDelete(cocktailId, row) {
                fetch(`/cocktails/${cocktailId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    console.log('Delete response:', data);
                    if (data.success) {
                        row.style.opacity = '0.5';
                        row.style.textDecoration = 'line-through';
                        setTimeout(() => {
                            row.remove();

                            if (typeof Swal !== 'undefined') {
                                Swal.fire({
                                    icon: 'success',
                                    title: '¡Eliminado!',
                                    text: 'Cóctel removido de favoritos',
                                    timer: 2000,
                                    showConfirmButton: false
                                });
                            } else {
                                alert('✓ ¡Cóctel eliminado exitosamente!');
                            }

                            // Check if table is empty
                            if (document.querySelectorAll('#cocktailsTable tbody tr').length === 0) {
                                location.reload();
                            }
                        }, 300);
                    }
                })
                .catch(error => {
                    console.error('Delete error:', error);
                    if (typeof Swal !== 'undefined') {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'No se pudo eliminar el cóctel'
                        });
                    } else {
                        alert('Error al eliminar el cóctel');
                    }
                });
            }
        });
    </script>
    @endpush
</x-app-layout>
