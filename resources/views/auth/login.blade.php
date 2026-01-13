@extends('layouts.guest')

@section('content')
<div class="bg-white shadow-md rounded-lg px-6 py-8">
    
    <div class="flex justify-center mb-6">
        <x-jet-authentication-card-logo />
    </div>

    <h2 class="text-center text-xl font-semibold mb-6">
        Iniciar sesión
    </h2>

    <x-jet-validation-errors class="mb-4" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div>
            <x-jet-label for="email" value="Correo electrónico" />
            <x-jet-input id="email" class="block mt-1 w-full"
                type="email" name="email" required autofocus />
        </div>

        <div class="mt-4">
            <x-jet-label for="password" value="Contraseña" />
            <x-jet-input id="password" class="block mt-1 w-full"
                type="password" name="password" required />
        </div>

        <div class="mt-6">
            <x-jet-button class="w-full justify-center">
                Entrar
            </x-jet-button>
        </div>
    </form>

</div>
@endsection
