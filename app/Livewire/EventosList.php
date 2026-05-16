<?php

namespace App\Livewire;

use App\Models\Event;
use Livewire\Component;
use Livewire\WithPagination;

/**
 * Componente Livewire para el listado de eventos en la landing page.
 * Muestra eventos publicados con búsqueda y filtro por categoría en tiempo real.
 * Vista: resources/views/livewire/eventos-list.blade.php
 */
class EventosList extends Component
{
    use WithPagination;

    /** @var string Texto del input de búsqueda. wire:model lo sincroniza automáticamente */
    public string $busqueda = '';

    /** @var string Categoría seleccionada para filtrar */
    public string $categoria = '';

    /**
     * Resetear paginación cuando cambia la búsqueda o categoría.
     */
    public function updatingBusqueda(): void
    {
        $this->resetPage();
    }

    public function updatingCategoria(): void
    {
        $this->resetPage();
    }

    public function render()
    {
        $eventos = Event::where('status', 'published')
            ->when($this->busqueda, fn($q) =>
                $q->where('name', 'like', "%{$this->busqueda}%"))
            ->when($this->categoria, fn($q) =>
                $q->where('category', $this->categoria))
            ->get();

        $categorias = Event::where('status', 'published')
            ->distinct()
            ->pluck('category')
            ->filter();

        return view('livewire.eventos-list', compact('eventos', 'categorias'));
    }
}