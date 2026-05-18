<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Iniciar sesión — TicketWave</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { min-height: 100vh; overflow: hidden; font-family: 'Poppins', sans-serif; background: #050d08; }

        /* COLUMNAS VERTICALES ANIMADAS */
        .strips-wrapper {
            position: fixed; inset: -20%; z-index: 0;
            display: flex;
            gap: 8px;
            transform: rotate(-12deg) scale(1.25);
        }
        .col-strip {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }
        .col-strip.up    { animation: scrollUp   28s linear infinite; }
        .col-strip.down  { animation: scrollDown 24s linear infinite; }
        .col-strip.up2   { animation: scrollUp   32s linear infinite; }
        .col-strip.down2 { animation: scrollDown 30s linear infinite; }
        .col-strip.up3   { animation: scrollUp   26s linear infinite; }
        .col-strip.down3 { animation: scrollDown 35s linear infinite; }

        @keyframes scrollUp {
            0%   { transform: translateY(0); }
            100% { transform: translateY(-50%); }
        }
        @keyframes scrollDown {
            0%   { transform: translateY(-50%); }
            100% { transform: translateY(0); }
        }

        .strip-item {
            flex-shrink: 0;
            height: 220px;
            background-size: cover;
            background-position: center;
            border-radius: 10px;
            filter: brightness(0.5);
        }

        /* OVERLAY */
        .overlay {
            position: fixed; inset: 0; z-index: 1;
            background: rgba(0, 0, 0, 0.62);
        }

        /* CARD */
        .card {
            position: relative; z-index: 2;
            /*background: #172A24;*/
            /*border: 1px solid #2d6a4f;*/
            border-radius: 20px;
            padding: 2.25rem 2.5rem;
            width: 100%; max-width: 440px;
        }

        /* INPUTS */
        input[type=email],
        input[type=password] {
            width: 100%; padding: 0.75rem 1rem;
            background: #f1f5f2; color: #0d1f1a;
            border: none; border-radius: 8px;
            font-size: 0.95rem; outline: none;
            font-family: 'Poppins', sans-serif;
            transition: box-shadow 0.2s;
        }
        input[type=email]:focus,
        input[type=password]:focus {
            box-shadow: 0 0 0 2px #4ade80;
        }

        /* BOTONES */
        .btn-primary {
            width: 100%; padding: 0.85rem;
            background: #4ade80; color: #0a1f14;
            font-weight: 700; font-size: 1rem;
            border-radius: 50px; border: none;
            cursor: pointer; transition: opacity 0.2s;
            font-family: 'Poppins', sans-serif;
        }
        .btn-primary:hover { opacity: 0.88; }

        .btn-outline {
            width: 100%; padding: 0.75rem;
            background: transparent; color: #4ade80;
            font-weight: 600; font-size: 0.9rem;
            border-radius: 50px; border: 2px solid #2d6a4f;
            cursor: pointer; transition: background 0.2s;
            text-align: center; display: block;
            font-family: 'Poppins', sans-serif;
            text-decoration: none;
        }
        .btn-outline:hover { background: #1a3328; }

        /* CHIP AYUDA */
        .help-chip {
            position: fixed; bottom: 1.25rem; left: 1.25rem; z-index: 10;
            background: #0d2d1f;
            border: 1px solid #2d6a4f;
            border-radius: 50px;
            padding: 0.4rem 1.1rem;
        }
        .help-chip a {
            color: #4a7a5a;
            font-size: 0.78rem;
            text-decoration: none;
            font-family: 'Poppins', sans-serif;
        }
        .help-chip a:hover { color: #4ade80; }
    </style>
</head>
<body>

    @php
    $cols = [
        // Columna 1 — sube
        [
            '/images/login/btscon.jpg',
            '/images/login/coldcon.jpg',
            '/images/login/conc.jpg',
            '/images/login/cone.jpg',
        ],
        // Columna 2 — baja
        [
            '/images/login/enhyepncon.jpg',
            '/images/login/imaginecon.jpg',
            '/images/login/jckcon.jpg',
            '/images/login/manaconci.jpg',
        ],
        // Columna 3 — sube
        [
            '/images/login/mckcon.jpg',
            '/images/login/ramsteincon.jpg',
            '/images/login/siwftcon.jpg',
            '/images/login/straycon.jpg',
        ],
        // Columna 4 — baja
        [
            '/images/login/tomocon.jpg',
            '/images/login/tomorrow.jpg',
            '/images/login/btscon.jpg',
            '/images/login/coldcon.jpg',
        ],
        // Columna 5 — sube
        [
            '/images/login/imaginecon.jpg',
            '/images/login/enhyepncon.jpg',
            '/images/login/ramsteincon.jpg',
            '/images/login/conc.jpg',
        ],
        // Columna 6 — baja
        [
            '/images/login/jckcon.jpg',
            '/images/login/straycon.jpg',
            '/images/login/manaconci.jpg',
            '/images/login/tomorrow.jpg',
        ],
    ];
    $dirs = ['up', 'down', 'up2', 'down2', 'up3', 'down3'];
    @endphp

    {{-- FONDO: COLUMNAS ANIMADAS --}}
    <div class="strips-wrapper">
        @foreach($cols as $i => $images)
            <div class="col-strip {{ $dirs[$i] }}">
                {{-- duplicar imágenes para loop infinito sin saltos --}}
                @foreach(array_merge($images, $images) as $img)
                    <div class="strip-item" style="background-image: url('{{ $img }}');"></div>
                @endforeach
            </div>
        @endforeach
    </div>

    <div class="overlay"></div>

    {{-- CARD CENTRADA --}}
    <div style="position:relative; z-index:2; min-height:100vh; display:flex; align-items:center; justify-content:center; padding:1rem;">
        <div class="card">

            {{-- Logo --}}
            <div style="text-align:center; margin-bottom:1.75rem;">
                <h1 style="font-size:2.6rem; font-weight:800; color:#fff; font-family:'Poppins',sans-serif; line-height:1.1;">
                    <span style="color:#4ade80;">T</span>icketwave
                </h1>
                <p style="color:#94a3b8; font-size:0.85rem; margin-top:0.35rem;">
                    Tu próximo gran momento empieza aquí
                </p>
                <p style="color:#fff; font-weight:600; margin-top:0.6rem; font-size:1rem;">
                    Inicio de sesión
                </p>
            </div>

            {{-- Mensaje de sesión --}}
            @if(session('status'))
                <div style="background:#1a3d2e; color:#4ade80; border:1px solid #2d6a4f; border-radius:8px; padding:0.75rem 1rem; font-size:0.85rem; margin-bottom:1rem;">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                {{-- Correo --}}
                <div style="margin-bottom:1rem;">
                    <label style="display:block; color:#94a3b8; font-size:0.85rem; margin-bottom:0.4rem;">
                        Correo
                    </label>
                    <input type="email" name="email"
                           value="{{ old('email') }}"
                           placeholder="correo@ejemplo.com"
                           required autofocus>
                    @error('email')
                        <p style="color:#f87171; font-size:0.8rem; margin-top:0.3rem;">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Contraseña --}}
                <div style="margin-bottom:0.5rem;">
                    <label style="display:block; color:#94a3b8; font-size:0.85rem; margin-bottom:0.4rem;">
                        Contraseña
                    </label>
                    <input type="password" name="password"
                           placeholder="••••••••" required>
                    @error('password')
                        <p style="color:#f87171; font-size:0.8rem; margin-top:0.3rem;">{{ $message }}</p>
                    @enderror
                </div>

                {{-- ¿Olvidaste? — alineado a la izquierda --}}
                @if(Route::has('password.request'))
                    <div style="text-align:left; margin-bottom:1.25rem;">
                        <a href="{{ route('password.request') }}"
                           style="color:#4ade80; font-size:0.82rem; text-decoration:none;">
                            ¿Olvidaste tu contraseña?
                        </a>
                    </div>
                @endif

                <button type="submit" class="btn-primary">Iniciar sesión</button>
            </form>

            {{-- Registro --}}
            <div style="margin-top:1rem; text-align:center;">
                <p style="color:#94a3b8; font-size:0.85rem; margin-bottom:0.5rem;">
                    ¿No tienes una cuenta?
                </p>
                <a href="{{ route('register') }}" class="btn-outline">¡Regístrate!</a>
            </div>

        </div>
    </div>

    {{-- CHIP AYUDA — fixed esquina inferior izquierda --}}
    <div class="help-chip">
        <a href="#">? ¿Necesitas ayuda? Centro de ayuda</a>
    </div>

</body>
</html>