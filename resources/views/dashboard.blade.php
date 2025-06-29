<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    {{-- BLOQUE PARA MOSTRAR EL MENSAJE 'correcto' DEL LABORATORIO --}}
    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (Session::has('correcto'))
                <div class="bg-gray-100 border border-blue-500 text-blue-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">{{ __('¡Realizado!') }}</strong>
                    <span class="block sm:inline">{{ __('Proceso terminado exitosamente.') }}</span><br>
                    {{ Session::get('correcto') }}
                </div>
            @endif
        </div>
    </div>
    {{-- FIN DEL BLOQUE DEL MENSAJE --}}

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>