<x-guest-layout>
    <x-jet-authentication-card>

        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <h2 class="text-center text-xl font-semibold text-gray-800 mb-6">
            Iniciar sesión
        </h2>

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-4">
                <x-jet-label for="email" value="Correo electrónico" />
                <x-jet-input
                    id="email"
                    class="block mt-1 w-full"
                    type="email"
                    name="email"
                    required
                    autofocus
                />
            </div>

            <div class="mb-6">
                <x-jet-label for="password" value="Contraseña" />
                <x-jet-input
                    id="password"
                    class="block mt-1 w-full"
                    type="password"
                    name="password"
                    required
                />
            </div>

            <x-jet-button class="w-full justify-center">
                Entrar
            </x-jet-button>
        </form>

    </x-jet-authentication-card>
</x-guest-layout>
