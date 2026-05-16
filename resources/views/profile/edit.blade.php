<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Avatar --}}
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <h2 class="text-lg font-medium text-gray-900">Foto de perfil</h2>
                    <div class="mt-4 flex items-center gap-6">
                        {{-- Avatar o inicial --}}
                        @if(auth()->user()->avatar_url)
                            <img src="{{ auth()->user()->avatar_url }}"
                                 alt="Avatar"
                                 class="w-20 h-20 rounded-full object-cover">
                        @else
                            <div class="w-20 h-20 rounded-full bg-gray-400 flex items-center justify-center text-white text-2xl font-bold">
                                {{ auth()->user()->initial }}
                            </div>
                        @endif

                        <div class="flex flex-col gap-2">
                            {{-- Subir foto --}}
                            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                <input type="file" name="avatar" accept="image/*" class="text-sm text-gray-600">
                                @error('avatar')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                                <x-primary-button class="mt-2">Subir foto</x-primary-button>
                            </form>

                            {{-- Eliminar foto --}}
                            @if(auth()->user()->avatar)
                                <form method="POST" action="{{ route('profile.avatar.destroy') }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-sm text-red-600 hover:underline">
                                        Eliminar foto
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>