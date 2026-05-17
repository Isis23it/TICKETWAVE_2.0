<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

/**
 * Controlador para la página pública de detalle de evento.
 * Muestra la información completa del evento y sus tipos de entrada.
 */
class EventoController extends Controller
{
    /**
     * Muestra el detalle de un evento publicado.
     * Carga eager loading de venue y ticketTypes para evitar N+1 queries.
     *
     * @param Event $evento Inyectado automáticamente por Route Model Binding
     */
    public function show(Event $evento)
    {
        // Solo mostrar eventos publicados
        if ($evento->status !== 'published') {
            abort(404);
        }

        // Cargar relaciones necesarias
        $evento->load(['venue', 'ticketTypes']);

        return view('eventos.show', compact('evento'));
    }
}