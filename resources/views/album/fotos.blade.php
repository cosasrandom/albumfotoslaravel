<x-app-layout>
    <!-- Decoración floral -->
    <div class="absolute top-10 left-10 opacity-10">
        <svg class="w-24 h-24 text-pink-400" fill="currentColor" viewBox="0 0 24 24">
            <path d="M12,2C6.5,2,2,6.5,2,12s4.5,10,10,10s10-4.5,10-10S17.5,2,12,2z M12,20c-4.4,0-8-3.6-8-8s3.6-8,8-8s8,3.6,8,8 S16.4,20,12,20z M15,9c0,1.7-1.3,3-3,3S9,10.7,9,9s1.3-3,3-3S15,7.3,15,9z"/>
        </svg>
    </div>

    <x-slot name="header">
        <div class="bg-gradient-to-r from-pink-50 to-purple-50 py-6 border-b border-pink-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="font-semibold text-2xl text-transparent bg-clip-text bg-gradient-to-r from-pink-500 to-purple-600">
                    <svg class="w-6 h-6 inline mr-2 -mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                    </svg>
                    {{ __('Fotos del Álbum: ') }}<span class="font-bold">{{ $album->nombre }}</span>
                </h2>
                <p class="mt-1 text-pink-400 italic">{{ $album->descripcion ?: 'Tus recuerdos más preciados en este álbum' }}</p>
                <!-- Botón para volver a los álbumes principales -->
                <div class="mt-4">
                    <a href="{{ route('album.mostrar') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-full text-sm font-semibold transition-colors duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        {{ __('Volver a Mis Álbumes') }}
                    </a>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-12 relative">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white bg-opacity-70 backdrop-blur-sm rounded-2xl shadow-xl overflow-hidden">
                <div class="p-6 md:p-8">
                    <!-- Mensajes de sesión -->
                    @if (session('correcto'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <strong class="font-bold">¡Éxito!</strong>
                            <span class="block sm:inline">{{ session('correcto') }}</span>
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <strong class="font-bold">¡Error!</strong>
                            <span class="block sm:inline">{{ session('error') }}</span>
                        </div>
                    @endif

                    <!-- Botón crear foto -->
                    <div class="flex justify-end mb-8">
                        <a href="{{ route('foto.create', $album) }}" class="inline-flex items-center px-5 py-3 bg-gradient-to-r from-pink-500 to-purple-600 border border-transparent rounded-full font-semibold text-sm text-white uppercase tracking-widest hover:from-pink-600 hover:to-purple-700 transition-all duration-300 transform hover:-translate-y-0.5 shadow-lg shadow-pink-200 hover:shadow-xl">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            {{ __('Añadir Nueva Foto') }}
                        </a>
                    </div>

                    {{-- Verificar si hay fotos --}}
                    @if ($fotos->count() > 0)
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                            @foreach ($fotos as $foto)
                                <div class="bg-white border border-pink-100 rounded-xl shadow-md overflow-hidden transition-all duration-300 hover:shadow-xl hover:border-pink-200">
                                    <div class="p-4 bg-gradient-to-r from-pink-50 to-purple-50">
                                        <h5 class="text-lg font-bold text-gray-800 truncate">
                                            <svg class="w-5 h-5 inline mr-1 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                            {{ $foto->nombre }}
                                        </h5>
                                    </div>
                                    
                                    <div class="p-4">
                                        <div class="relative overflow-hidden rounded-lg aspect-square">
                                            <!-- Asegúrate de que $foto->foto_ruta es la columna correcta para la ruta de la imagen -->
                                            <img src="{{ asset('storage/' . $foto->foto_ruta) }}" alt="{{ $foto->nombre }}" class="w-full h-60 object-cover rounded-lg transition duration-500 hover:scale-105">
                                            <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                                        </div>
                                        
                                        <p class="text-gray-600 mt-3 text-sm min-h-[50px]">
                                            {{ $foto->descripcion ?: 'Sin descripción' }}
                                        </p>

                                        <div class="mt-4 flex flex-wrap gap-2">
                                            <a href="{{ route('foto.edit', $foto) }}" class="flex-1 inline-flex items-center justify-center px-3 py-2 bg-gradient-to-r from-lime-400 to-green-500 border border-transparent rounded-full font-semibold text-xs text-white uppercase tracking-widest hover:opacity-90 transition-all">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                </svg>
                                                {{ __('Editar') }}
                                            </a> 
                                            
                                            <!-- Botón de Eliminar Foto (puedes implementarlo más adelante) -->
                                            <form action="{{ route('foto.destroy', $foto) }}" method="POST" onsubmit="return confirm('¿Está seguro que desea eliminar esta foto? Esta acción no se puede deshacer.');" class="flex-1">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="w-full inline-flex items-center justify-center px-3 py-2 bg-gradient-to-r from-orange-500 to-red-600 border border-transparent rounded-full font-semibold text-xs text-white uppercase tracking-widest hover:opacity-90 transition-all">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                    </svg>
                                                    {{ __('Eliminar') }}
                                                </button>
                                            </form> 
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <!-- Estado vacío -->
                        <div class="text-center py-16">
                            <div class="max-w-md mx-auto">
                                <div class="bg-pink-50 rounded-full w-24 h-24 flex items-center justify-center mx-auto mb-6">
                                    <svg class="w-12 h-12 text-pink-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-semibold text-gray-800 mb-2">{{ __('Este álbum está vacío') }}</h3>
                                <p class="text-gray-600 mb-6">{{ __('Comienza añadiendo tus primeras fotos para crear recuerdos inolvidables') }}</p>
                                <a href="{{ route('foto.create', $album) }}" class="inline-flex items-center px-5 py-3 bg-gradient-to-r from-pink-500 to-purple-600 border border-transparent rounded-full font-semibold text-sm text-white uppercase tracking-widest hover:from-pink-600 hover:to-purple-700 transition-all duration-300 shadow-lg shadow-pink-200 hover:shadow-xl">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                    {{ __('Añadir Nueva Foto') }}
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
