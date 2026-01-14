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

            <!-- USUARIO -->
            <div class="mb-4">
                <x-jet-label for="usuario_login" value="Usuario" />
                <x-jet-input
                    id="usuario_login"
                    class="block mt-1 w-full"
                    type="text"
                    name="usuario_login"
                    required
                    autofocus
                />
            </div>

            <!-- CONTRASEÑA -->
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
