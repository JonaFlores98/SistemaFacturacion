<div class="w-full sm:max-w-sm bg-white shadow-xl rounded-xl px-6 py-6">

    {{-- LOGO --}}
    @isset($logo)
        <div class="flex justify-center mb-4">
            {{ $logo }}
        </div>
    @endisset

    {{-- CONTENIDO --}}
    {{ $slot }}

</div>
