# ─────────────────────────────────────────────────────────────────────────────
# Makefile — TicketWave
# Atajos para los comandos más comunes de Docker + Laravel
# Uso: make <comando>
# ─────────────────────────────────────────────────────────────────────────────

# Primera vez — clonar el repo y correr esto:
setup:
	copy .env.example .env
	docker compose up -d --build
	docker compose exec app composer install
	docker compose exec app php artisan key:generate
	docker compose exec app php artisan migrate --seed
	docker compose exec app php artisan storage:link
	docker compose exec app npm install
	docker compose exec app npm run build
	@echo ""
	@echo "✅ TicketWave corriendo en http://localhost:8000"
	@echo "📊 phpMyAdmin en http://localhost:8080 (ejecuta: make tools)"

# Levantar los contenedores
up:
	docker compose up -d

# Apagar los contenedores
down:
	docker compose down

# Ver logs en tiempo real
logs:
	docker compose logs -f app

# Abrir una terminal dentro del contenedor de Laravel
shell:
	docker compose exec app bash

# Correr migraciones
migrate:
	docker compose exec app php artisan migrate

# Correr migraciones + seeders (resetea datos)
fresh:
	docker compose exec app php artisan migrate:fresh --seed

# Limpiar caché de Laravel
clear:
	docker compose exec app php artisan cache:clear
	docker compose exec app php artisan config:clear
	docker compose exec app php artisan route:clear
	docker compose exec app php artisan view:clear

# Correr Composer (ej: make composer cmd="require laravel/breeze")
composer:
	docker compose exec app composer $(cmd)

# Correr Artisan (ej: make artisan cmd="make:model Evento -m")
artisan:
	docker compose exec app php artisan $(cmd)

# Levantar phpMyAdmin
tools:
	docker compose --profile tools up -d phpmyadmin
	@echo "📊 phpMyAdmin en http://localhost:8080"

# Destruir todo (contenedores + volúmenes = borra la BD)
destroy:
	docker compose down -v
	@echo "⚠️  Volúmenes eliminados — la base de datos fue borrada"

.PHONY: setup up down logs shell migrate fresh clear composer artisan tools destroy
