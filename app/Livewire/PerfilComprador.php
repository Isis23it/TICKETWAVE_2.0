<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;

class PerfilComprador extends Component
{
    use WithFileUploads;

    public bool $editando = false;

    public string $name         = '';
    public string $email        = '';
    public string $new_password = '';
    public $avatarTemp          = null;

    public function mount(): void
    {
        $user        = Auth::user();
        $this->name  = $user->name;
        $this->email = $user->email;
    }

    public function toggleEditar(): void
    {
        $this->editando = !$this->editando;
        if (!$this->editando) {
            $this->cancelar();
        }
    }

    public function cancelar(): void
    {
        $user               = Auth::user()->fresh();
        $this->name         = $user->name;
        $this->email        = $user->email;
        $this->new_password = '';
        $this->avatarTemp   = null;
        $this->editando     = false;
    }

    public function guardar(): void
    {
        $this->validate([
            'name'         => 'required|string|max:255',
            'email'        => 'required|email|max:255|unique:users,email,' . Auth::id(),
            'new_password' => ['nullable', Password::min(8)],
            'avatarTemp'   => 'nullable|image|max:2048',
        ]);

        $user       = Auth::user();
        $avatarPath = $user->avatar;

        if ($this->avatarTemp) {
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }
            $avatarPath = $this->avatarTemp->store('avatars', 'public');
        }

        $updateData = [
            'name'   => $this->name,
            'email'  => $this->email,
            'avatar' => $avatarPath,
        ];

        if (!empty($this->new_password)) {
            $updateData['password'] = Hash::make($this->new_password);
        }

        $user->update($updateData);

        $this->avatarTemp   = null;
        $this->editando     = false;
        $this->new_password = '';

        session()->flash('status', 'profile-updated');
    }

    public function eliminarAvatar(): void
    {
        $user = Auth::user();
        if ($user->avatar) {
            Storage::disk('public')->delete($user->avatar);
            $user->update(['avatar' => null]);
        }
    }

    public function render()
    {
        return view('livewire.perfil-comprador');
    }
}