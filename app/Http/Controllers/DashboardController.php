<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
public function index(Request $request)
{
    $categoria = $request->query('categoria');

    // Mapeo español → inglés (valores reales en BD)
    $categoriaMap = [
        'conciertos'   => 'concert',
        'deportes'     => 'sport',
        'teatro'       => 'theater',
        'festivales'   => 'festival',
        'conferencias' => 'conference',
    ];

    $categoriaDB = $categoriaMap[$categoria] ?? null;

    $eventos = Event::with(['venue', 'ticketTypes'])
        ->where('status', 'published')
        ->where('event_date', '>', now())
        ->when($categoriaDB, fn($q) => $q->where('category', $categoriaDB))
        ->orderBy('event_date')
        ->take(8)
        ->get();

    $categorias = [
        ['slug' => 'conciertos',   'label' => 'Conciertos',   'emoji' => '🎵'],
        ['slug' => 'deportes',     'label' => 'Deportes',     'emoji' => '⚽'],
        ['slug' => 'teatro',       'label' => 'Teatro',       'emoji' => '🎭'],
        ['slug' => 'festivales',   'label' => 'Festivales',   'emoji' => '🎪'],
        ['slug' => 'conferencias', 'label' => 'Conferencias', 'emoji' => '🎤'],
    ];

    return view('dashboard', compact('eventos', 'categorias', 'categoria'));
}
}