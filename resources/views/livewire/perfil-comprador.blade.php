<div class="max-w-2xl mx-auto space-y-6">

    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold text-white">Mi Perfil</h1>
        <button wire:click="toggleEditar"
                class="px-4 py-2 rounded-lg text-sm font-semibold transition"
                style="{{ $editando ? 'background-color:#1a3328; color:#94a3b8; border:1px solid #2d6a4f;' : 'background-color:#4ade80; color:#0d1f1a;' }}">
            {{ $editando ? 'Cancelar' : 'Editar perfil' }}
        </button>
    </div>

    @if(session('status') === 'profile-updated')
        <div class="rounded-lg px-4 py-3 text-sm font-medium" style="background-color:#1a3d2e; color:#4ade80; border:1px solid #2d6a4f;">
            ✓ Perfil actualizado correctamente.
        </div>
    @endif

    {{-- TARJETA PRINCIPAL --}}
    <div class="rounded-xl p-6" style="background-color:#1a3328; border:1px solid #2d6a4f;">

        {{-- AVATAR --}}
        <div class="flex items-center gap-6 mb-6">
            {{-- Foto actual o inicial --}}
            @php $user = auth()->user(); @endphp

            @if($avatarTemp)
                <img src="{{ $avatarTemp->temporaryUrl() }}"
                     class="w-24 h-24 rounded-full object-cover"
                     style="border:3px solid #4ade80;">
            @elseif($user->avatar_url)
                <img src="{{ $user->avatar_url }}"
                     class="w-24 h-24 rounded-full object-cover"
                     style="border:3px solid #4ade80;">
            @else
                <div class="w-24 h-24 rounded-full flex items-center justify-center text-3xl font-bold"
                     style="background-color:#2d6a4f; color:#fff; border:3px solid #4ade80;">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>
            @endif

            @if($editando)
                <div class="flex flex-col gap-2">
                    <label class="block text-sm font-medium mb-1" style="color:#94a3b8;">Foto de perfil</label>
                    <input type="file" wire:model="avatarTemp" accept="image/*"
                           class="text-sm" style="color:#94a3b8;">
                    @error('avatarTemp')
                        <p class="text-sm" style="color:#f87171;">{{ $message }}</p>
                    @enderror
                    <p class="text-xs" style="color:#4a6741;">Máx. 2MB — JPG, PNG o WEBP</p>

                    @if($user->avatar)
                        <button wire:click="eliminarAvatar" type="button"
                                class="text-sm hover:underline text-left" style="color:#f87171;">
                            Eliminar foto actual
                        </button>
                    @endif
                </div>
            @else
                <div>
                    <p class="text-lg font-semibold text-white">{{ $user->name }}</p>
                    <p class="text-sm" style="color:#94a3b8;">{{ $user->email }}</p>
                    <span class="inline-block mt-1 px-2 py-0.5 rounded-full text-xs font-medium"
                          style="background-color:#1a3d2e; color:#4ade80; border:1px solid #2d6a4f;">
                        {{ ucfirst($user->role) }}
                    </span>
                </div>
            @endif
        </div>

        {{-- FORMULARIO DE EDICIÓN --}}
        @if($editando)
            <form wire:submit.prevent="guardar" class="space-y-4">

                <div>
                    <label class="block text-sm font-medium mb-1" style="color:#94a3b8;">Nombre completo</label>
                    <input type="text" wire:model="name"
                           class="w-full rounded-lg px-4 py-2.5 text-sm focus:outline-none"
                           style="background-color:#0d2d1f; color:#e2e8f0; border:1px solid #2d6a4f;">
                    @error('name')
                        <p class="text-sm mt-1" style="color:#f87171;">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1" style="color:#94a3b8;">Correo electrónico</label>
                    <input type="email" wire:model="email"
                           class="w-full rounded-lg px-4 py-2.5 text-sm focus:outline-none"
                           style="background-color:#0d2d1f; color:#e2e8f0; border:1px solid #2d6a4f;">
                    @error('email')
                        <p class="text-sm mt-1" style="color:#f87171;">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1" style="color:#94a3b8;">Nueva contraseña</label>
                    <input type="password" wire:model="new_password"
                           placeholder="Déjala vacía para no cambiarla"
                           class="w-full rounded-lg px-4 py-2.5 text-sm focus:outline-none"
                           style="background-color:#0d2d1f; color:#e2e8f0; border:1px solid #2d6a4f;">
                    @error('new_password')
                        <p class="text-sm mt-1" style="color:#f87171;">{{ $message }}</p>
                    @enderror
                    <p class="text-xs mt-1" style="color:#4a6741;">Mínimo 8 caracteres</p>
                </div>

                <div class="flex items-center gap-3 pt-2">
                    <button type="submit"
                            class="px-6 py-2.5 rounded-lg text-sm font-semibold transition"
                            style="background-color:#4ade80; color:#0d1f1a;">
                        Guardar cambios
                    </button>
                    <button type="button" wire:click="cancelar"
                            class="px-6 py-2.5 rounded-lg text-sm font-semibold transition"
                            style="background-color:#1a3328; color:#94a3b8; border:1px solid #2d6a4f;">
                        Cancelar
                    </button>
                </div>
            </form>
        @endif
    </div>

    {{-- BORRAR CUENTA --}}
    <div class="rounded-xl p-6" style="background-color:#1a3328; border:1px solid #7f1d1d;">
        <h2 class="text-base font-semibold mb-1" style="color:#f87171;">Borrar cuenta</h2>
        <p class="text-sm mb-4" style="color:#94a3b8;">
            Una vez que elimines tu cuenta, todos tus datos serán eliminados permanentemente.
        </p>
        <form method="POST" action="{{ route('profile.destroy') }}">
            @csrf
            @method('DELETE')
            <div class="mb-3">
                <label class="block text-sm font-medium mb-1" style="color:#94a3b8;">Confirma tu contraseña</label>
                <input type="password" name="password"
                       class="w-full max-w-sm rounded-lg px-4 py-2.5 text-sm focus:outline-none"
                       style="background-color:#0d2d1f; color:#e2e8f0; border:1px solid #7f1d1d;">
                @error('password', 'userDeletion')
                    <p class="text-sm mt-1" style="color:#f87171;">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit"
                    onclick="return confirm('¿Estás seguro? Esta acción no se puede deshacer.')"
                    class="px-6 py-2.5 rounded-lg text-sm font-semibold transition"
                    style="background-color:#7f1d1d; color:#fff;">
                Borrar cuenta
            </button>
        </form>
    </div>

</div>