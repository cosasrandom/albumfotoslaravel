<x-app-layout>
    <!-- Decoración floral -->
    <div class="absolute top-10 right-10 opacity-10">
        <svg class="w-24 h-24 text-pink-400" fill="currentColor" viewBox="0 0 24 24">
            <path d="M12,2C6.5,2,2,6.5,2,12s4.5,10,10,10s10-4.5,10-10S17.5,2,12,2z M12,20c-4.4,0-8-3.6-8-8s3.6-8,8-8s8,3.6,8,8 S16.4,20,12,20z M15,9c0,1.7-1.3,3-3,3S9,10.7,9,9s1.3-3,3-3S15,7.3,15,9z"/>
        </svg>
    </div>

    <!-- Header mejorado -->
    <div class="py-8 px-4 sm:px-6 lg:px-8 bg-gradient-to-r from-pink-50 to-purple-50 border-b border-pink-100">
        <div class="max-w-3xl mx-auto text-center">
            <h1 class="font-bold text-3xl md:text-4xl text-transparent bg-clip-text bg-gradient-to-r from-pink-500 to-purple-600">
                {{ __('Álbum de FATIMA') }}
            </h1>
            <p class="mt-2 text-pink-400 italic">Tus recuerdos más preciados en un solo lugar</p>
        </div>
    </div>

    <!-- Contenido principal -->
    <div class="py-12 relative">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white bg-opacity-70 backdrop-blur-sm rounded-2xl shadow-xl overflow-hidden">
                <div class="p-6 md:p-8">
                    <!-- Botón nuevo álbum -->
                    <div class="flex justify-end mb-8">
                        <a href="#" class="inline-flex items-center px-5 py-3 bg-gradient-to-r from-pink-500 to-purple-600 border border-transparent rounded-full font-semibold text-sm text-white uppercase tracking-widest hover:from-pink-600 hover:to-purple-700 transition-all duration-300 transform hover:-translate-y-0.5 shadow-lg shadow-pink-200 hover:shadow-xl">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            {{ __('Nuevo álbum') }}
                        </a>
                    </div>

                    @if (sizeof($albumes) > 0)
                    <h2 class="text-xl font-medium text-gray-900 mb-6 flex items-center">
                        <svg class="w-6 h-6 mr-2 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                        </svg>
                        {{ __('Tus álbumes') }}
                    </h2>
                    
                    <!-- Grid de álbumes -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($albumes as $album)
                        <div class="bg-white border border-pink-100 rounded-xl shadow-md overflow-hidden transition-all duration-300 hover:shadow-xl hover:border-pink-200">
                            <!-- Cabecera con degradado -->
                            <div class="bg-gradient-to-r from-pink-500 to-purple-500 p-4">
                                <h4 class="text-xl font-bold text-white">{{ $album->nombre }}</h4>
                            </div>
                            
                            <div class="p-4">
                                <p class="text-gray-600 mt-2 text-sm min-h-[50px]">
                                    {{ $album->descripcion ?: 'Sin descripción' }}
                                </p>

                                <!-- Miniaturas de fotos -->
                                <div class="mt-4">
                                    @if ($album->fotos->count() > 0)
                                    <div class="grid grid-cols-2 gap-2">
                                        @foreach ($album->fotos->take(2) as $foto)
                                        <div class="relative overflow-hidden rounded-lg aspect-square border-2 border-white shadow">
                                            <img src="{{ asset('storage/' . $foto->ruta) }}" alt="{{ $foto->nombre }}" class="w-full h-full object-cover transform transition duration-500 hover:scale-110">
                                            <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent"></div>
                                        </div>
                                        @endforeach
                                    </div>
                                    @else
                                    <div class="bg-pink-50 border-2 border-dashed border-pink-200 rounded-lg p-6 text-center">
                                        <svg class="w-10 h-10 mx-auto text-pink-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        <p class="text-pink-400 text-sm mt-2">{{ __('Añade tus primeras fotos') }}</p>
                                    </div>
                                    @endif
                                </div>

                                <!-- Contador de fotos -->
                                <div class="mt-3 flex items-center text-sm text-pink-500">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    {{ $album->fotos->count() }} {{ __('fotos') }}
                                </div>

                                <!-- Botones de acción -->
                                <div class="mt-4 flex flex-wrap gap-2">
                                    <a href="{{ route('album.fotos.index', ['album_id' => $album->id]) }}" class="flex-1 min-w-[120px] inline-flex items-center justify-center px-3 py-2 bg-gradient-to-r from-emerald-500 to-teal-600 border border-transparent rounded-full font-semibold text-xs text-white uppercase tracking-widest hover:opacity-90 transition-all">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                        {{ __('Ver Fotos') }}
                                    </a>
                                    
                                    <a href="#" class="inline-flex items-center justify-center px-3 py-2 bg-gradient-to-r from-lime-400 to-green-500 border border-transparent rounded-full font-semibold text-xs text-white uppercase tracking-widest hover:opacity-90 transition-all">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                        {{ __('Editar') }}
                                    </a>
                                    
                                    <a href="#" onclick="return confirm('¿Está seguro que desea eliminar este álbum?')" class="inline-flex items-center justify-center px-3 py-2 bg-gradient-to-r from-orange-500 to-red-600 border border-transparent rounded-full font-semibold text-xs text-white uppercase tracking-widest hover:opacity-90 transition-all">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                        {{ __('Eliminar') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <!-- Estado vacío -->
                    <div class="text-center py-12">
                        <div class="max-w-md mx-auto">
                            <div class="bg-pink-50 rounded-full w-24 h-24 flex items-center justify-center mx-auto mb-6">
                                <svg class="w-12 h-12 text-pink-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-800 mb-2">{{ __('Aún no tienes álbumes') }}</h3>
                            <p class="text-gray-600 mb-6">{{ __('Comienza creando tu primer álbum para guardar tus recuerdos') }}</p>
                            <a href="#" class="inline-flex items-center px-5 py-3 bg-gradient-to-r from-pink-500 to-purple-600 border border-transparent rounded-full font-semibold text-sm text-white uppercase tracking-widest hover:from-pink-600 hover:to-purple-700 transition-all duration-300 shadow-lg shadow-pink-200 hover:shadow-xl">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                {{ __('Crear nuevo álbum') }}
                            </a>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>