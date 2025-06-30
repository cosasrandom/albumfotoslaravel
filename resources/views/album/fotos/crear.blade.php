<x-app-layout>
    <!-- Decoración floral -->
    <div class="absolute top-10 right-10 opacity-10">
        <svg class="w-24 h-24 text-pink-400" fill="currentColor" viewBox="0 0 24 24">
            <path d="M12,2C6.5,2,2,6.5,2,12s4.5,10,10,10s10-4.5,10-10S17.5,2,12,2z M12,20c-4.4,0-8-3.6-8-8s3.6-8,8-8s8,3.6,8,8 S16.4,20,12,20z M15,9c0,1.7-1.3,3-3,3S9,10.7,9,9s1.3-3,3-3S15,7.3,15,9z"/>
        </svg>
    </div>

    <div class="py-8 px-4 sm:px-6 lg:px-8 bg-gradient-to-r from-pink-50 to-purple-50 border-b border-pink-100">
        <div class="max-w-3xl mx-auto text-center">
            <h1 class="font-bold text-3xl md:text-4xl text-transparent bg-clip-text bg-gradient-to-r from-pink-500 to-purple-600">
                {{ __('Añadir Nueva Foto') }}
            </h1>
            <p class="mt-2 text-pink-400 italic">Al álbum: {{ $album->nombre }}</p>
        </div>
    </div>

    <div class="py-12 relative">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white bg-opacity-70 backdrop-blur-sm rounded-2xl shadow-xl overflow-hidden">
                <div class="p-6 md:p-8">
                    @if (session('correcto'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <strong class="font-bold">¡Realizado!</strong>
                            <span class="block sm:inline">{{ session('correcto') }}</span>
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <strong class="font-bold">¡Error!</strong>
                            <span class="block sm:inline">{{ session('error') }}</span>
                        </div>
                    @endif

                    <h3 class="text-xl font-medium text-gray-900 mb-6 flex items-center">
                        <svg class="w-6 h-6 mr-2 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.867-1.299A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.867 1.299A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        {{ __('Subir Nueva Foto') }}
                    </h3>

                    <!-- Es crucial añadir enctype="multipart/form-data" para subir archivos -->
                    <form method="POST" action="{{ route('foto.store', $album) }}" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="album_id" value="{{ $album->id }}">

                        <div class="mb-5">
                            <label for="nombre" class="block text-sm font-semibold text-gray-700 mb-1">Nombre de la Foto</label>
                            <input type="text" name="nombre" id="nombre" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm 
                                       focus:border-pink-400 focus:ring focus:ring-pink-200 focus:ring-opacity-50
                                       transition duration-150 ease-in-out px-4 py-2" 
                                value="{{ old('nombre') }}" required autofocus>
                            @error('nombre')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-5">
                            <label for="descripcion" class="block text-sm font-semibold text-gray-700 mb-1">Descripción (Opcional)</label>
                            <textarea name="descripcion" id="descripcion" rows="3" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm 
                                       focus:border-pink-400 focus:ring focus:ring-pink-200 focus:ring-opacity-50
                                       transition duration-150 ease-in-out px-4 py-2">{{ old('descripcion') }}</textarea>
                            @error('descripcion')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="foto" class="block text-sm font-semibold text-gray-700 mb-1">Archivo de la Foto</label>
                            <input type="file" name="foto" id="foto" 
                                class="mt-1 block w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer 
                                       focus:outline-none focus:border-pink-400 focus:ring focus:ring-pink-200 focus:ring-opacity-50" 
                                required>
                            @error('foto')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" 
                                class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-pink-500 to-purple-600 
                                       border border-transparent rounded-full font-semibold text-sm text-white 
                                       uppercase tracking-widest hover:from-pink-600 hover:to-purple-700 
                                       transition-all duration-300 transform hover:-translate-y-0.5 shadow-lg shadow-pink-200 hover:shadow-xl
                                       focus:outline-none focus:ring-2 focus:ring-pink-500 focus:ring-offset-2">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 0115.9 6L16 6a3 3 0 013 3v10a2 2 0 01-2 2H7a2 2 0 01-2-2v-1a1 1 0 011-1h.5a1 1 0 011 1V16z"></path>
                                </svg>
                                {{ __('Subir Foto') }}
                            </button>
                        </div>
                    </form>

                    <!-- Botón para volver a las fotos del álbum -->
                    <div class="mt-8 text-center">
                        <a href="{{ route('foto.index', ['album_id' => $album->id]) }}" class="inline-flex items-center px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-full text-sm font-semibold transition-colors duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            {{ __('Volver a las Fotos del Álbum') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
