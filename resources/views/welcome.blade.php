<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TicketWave</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-[#051F20]">

{{-- Navbar --}}
<nav class="fixed top-0 left-0 right-0 z-50 flex items-center justify-between px-8 py-4 bg-[#163832]">
    <div class="flex items-center gap-10">
        <a href="/" class="text-[#83D5AB] font-bold text-xl">T<span class="text-white">icketwave</span></a>
        <div class="hidden md:flex gap-8 text-white text-sm">
            <a href="#" class="hover:text-[#83D5AB] transition">Evento</a>
            <a href="#" class="hover:text-[#83D5AB] transition">Categorías</a>
            <a href="#" class="hover:text-[#83D5AB] transition">Lugares</a>
        </div>
    </div>
    <div class="flex gap-3">
        <a href="{{ route('login') }}" class="bg-[#235347] text-white px-5 py-2 rounded-lg text-sm font-semibold hover:bg-[#0B2B26] transition">Iniciar sesión</a>
        <a href="{{ route('register') }}" class="bg-[#8EDBB1] text-[#051F20] px-5 py-2 rounded-lg text-sm font-semibold hover:bg-[#83D5AB] transition">Registrarse</a>
    </div>
</nav>

{{-- Hero Section --}}
<section class="relative h-[80vh] flex items-center bg-cover bg-center"
    style="background-image: url('{{ asset('hero.jpg') }}')">

    <div class="absolute inset-0 bg-[#051F20]/70"></div>

    <div class="relative z-10 px-8 max-w-6xl mx-auto w-full pt-16">
        <h1 class="text-4xl md:text-5xl font-semibold text-white mb-6 max-w-lg">
            Vive experiencias inolvidables
        </h1>

        <a href="#eventos" class="inline-block bg-[#8EDBB1] text-[#051F20] px-6 py-3 rounded-lg font-semibold hover:bg-[#83D5AB] transition">
            Explorar eventos
        </a>
    </div>
</section>

{{-- Beneficios --}}
<section class="bg-[#0B2B26] py-8 border-y border-[#235347]">
    <div class="max-w-6xl mx-auto px-8 grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
        <div class="flex flex-col items-center gap-2">
            <span class="text-3xl">🛡️</span>
            <p class="font-semibold text-[#DAF1DE]">Pago seguro</p>
            <p class="text-sm text-[#8EB69B]">Compra 100% segura y confiable.</p>
        </div>
        <div class="flex flex-col items-center gap-2">
            <span class="text-3xl">📱</span>
            <p class="font-semibold text-[#DAF1DE]">Entradas móviles</p>
            <p class="text-sm text-[#8EB69B]">Lleva tus entradas desde tu celular.</p>
        </div>
        <div class="flex flex-col items-center gap-2">
            <span class="text-3xl">🎧</span>
            <p class="font-semibold text-[#DAF1DE]">Atención 24/7</p>
            <p class="text-sm text-[#8EB69B]">Estamos aquí para ayudarte.</p>
        </div>
        <div class="flex flex-col items-center gap-2">
            <span class="text-3xl">🎫</span>
            <p class="font-semibold text-[#DAF1DE]">Miles de eventos</p>
            <p class="text-sm text-[#8EB69B]">Conciertos, deportes, teatro y más.</p>
        </div>
    </div>
</section>

{{-- Listado de eventos con búsqueda Livewire --}}
<section id="eventos" class="bg-[#051F20] min-h-screen py-12">
    <div class="max-w-6xl mx-auto px-8">
        <h2 class="text-3xl font-semibold text-white mb-8 text-center">Eventos destacados</h2>
        @livewire('eventos-list')
    </div>
</section>

{{-- Footer --}}
<footer class="bg-[#0B2B26] border-t border-[#235347] py-10">
    <div class="max-w-6xl mx-auto px-8 grid grid-cols-2 md:grid-cols-4 gap-6">
        <div>
            <p class="text-white font-bold text-lg mb-2">TicketWave</p>
        </div>
        <div>
            <p class="text-[#8EB69B] font-semibold mb-2">Explorar</p>
        </div>
        <div>
            <p class="text-[#8EB69B] font-semibold mb-2">Información</p>
        </div>
        <div>
            <p class="text-[#8EB69B] font-semibold mb-2">Empresa</p>
        </div>
    </div>
    <p class="text-center mt-6 text-[#8EB69B] text-sm">@ 2026 eventos, todos los derechos reservados</p>
</footer>

@livewireScripts
</body>
</html>