<x-filament-panels::page>

    @if (!$this->editando)
        <div style="display:flex; flex-direction:column; align-items:center; gap:1.5rem; padding:2.5rem 1rem;">

            {{-- Avatar --}}
            @if (Auth::user()->avatar_url)
                <img
                    src="{{ Auth::user()->avatar_url }}"
                    alt="Avatar"
                    style="height:7rem; width:7rem; border-radius:9999px; object-fit:cover; border:4px solid var(--primary-500); box-shadow:0 10px 25px rgba(0,0,0,0.4);"
                >
            @else
                <div style="height:7rem; width:7rem; border-radius:9999px; background:var(--primary-600); border:4px solid var(--primary-400); display:flex; align-items:center; justify-content:center; box-shadow:0 10px 25px rgba(0,0,0,0.4);">
                    <span style="font-size:2.5rem; font-weight:700; color:white; user-select:none;">
                        {{ Auth::user()->avatar_inicial }}
                    </span>
                </div>
            @endif

            {{-- Nombre y rol --}}
            <div style="text-align:center;">
                <h2 style="font-size:1.5rem; font-weight:700; color:white; margin:0;">
                    {{ Auth::user()->name }}
                </h2>
                <span style="display:inline-block; margin-top:0.5rem; padding:0.25rem 0.75rem; border-radius:9999px; font-size:0.75rem; font-weight:600;
                    {{ Auth::user()->isAdmin() ? 'background:rgba(239,68,68,0.15); color:#f87171; border:1px solid rgba(239,68,68,0.3);' : 'background:rgba(59,130,246,0.15); color:#60a5fa; border:1px solid rgba(59,130,246,0.3);' }}">
                    {{ ucfirst(Auth::user()->role) }}
                </span>
            </div>

            {{-- Tarjeta --}}
            <div style="width:100%; max-width:32rem; border-radius:1rem; border:1px solid rgba(255,255,255,0.1); background:rgba(255,255,255,0.05); padding:1.5rem; box-shadow:0 20px 40px rgba(0,0,0,0.3);">
                <h3 style="font-size:0.75rem; font-weight:600; text-transform:uppercase; letter-spacing:0.1em; color:#9ca3af; margin:0 0 1.25rem 0;">
                    Mi Información
                </h3>

                <dl style="margin:0;">
                    <div style="display:flex; justify-content:space-between; align-items:center; padding-bottom:1rem; border-bottom:1px solid rgba(255,255,255,0.08); margin-bottom:1rem;">
                        <dt style="font-size:0.875rem; color:#9ca3af;">Nombre completo</dt>
                        <dd style="font-size:0.875rem; font-weight:600; color:white; margin:0;">{{ Auth::user()->name }}</dd>
                    </div>
                    <div style="display:flex; justify-content:space-between; align-items:center; padding-bottom:1rem; border-bottom:1px solid rgba(255,255,255,0.08); margin-bottom:1rem;">
                        <dt style="font-size:0.875rem; color:#9ca3af;">Correo electrónico</dt>
                        <dd style="font-size:0.875rem; font-weight:600; color:white; margin:0;">{{ Auth::user()->email }}</dd>
                    </div>
                    <div style="display:flex; justify-content:space-between; align-items:center;">
                        <dt style="font-size:0.875rem; color:#9ca3af;">Rol</dt>
                        <dd style="font-size:0.875rem; font-weight:600; color:white; margin:0;">{{ ucfirst(Auth::user()->role) }}</dd>
                    </div>
                </dl>

                <div style="margin-top:1.5rem; display:flex; gap:0.75rem;">
                    <x-filament::button wire:click="toggleEditar" color="primary" style="flex:1;">
                        Editar Perfil
                    </x-filament::button>

                    <form action="{{ route('filament.admin.auth.logout') }}" method="POST" style="flex:1;">
                        @csrf
                        <x-filament::button type="submit" color="gray" outlined style="width:100%;">
                            Cerrar sesión
                        </x-filament::button>
                    </form>
                </div>
            </div>
        </div>

    @else
        <div style="max-width:32rem; margin:0 auto;">
            <div style="border-radius:1rem; border:1px solid rgba(255,255,255,0.1); background:rgba(255,255,255,0.05); padding:2rem; box-shadow:0 20px 40px rgba(0,0,0,0.3);">
                <h2 style="font-size:1.125rem; font-weight:700; color:white; margin:0 0 1.5rem 0;">Editar Perfil</h2>

                <form wire:submit="guardar">
                    {{ $this->form }}

                    <div style="margin-top:1.5rem; display:flex; gap:0.75rem;">
                        <x-filament::button type="submit" color="primary" style="flex:1;">
                            Guardar cambios
                        </x-filament::button>

                        <x-filament::button type="button" wire:click="cancelar" color="gray" outlined style="flex:1;">
                            Cancelar
                        </x-filament::button>
                    </div>
                </form>
            </div>
        </div>
    @endif

</x-filament-panels::page>