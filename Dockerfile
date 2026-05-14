# ─────────────────────────────────────────────────────────────────────────────
# Dockerfile — TicketWave / Laravel
# Imagen de desarrollo local (no es la de producción)
# ─────────────────────────────────────────────────────────────────────────────

FROM php:8.3-fpm

# ─── Variables de construcción ───────────────────────────────────────────────
ARG user=ticketwave
ARG uid=1000

# ─── Dependencias del sistema ────────────────────────────────────────────────
RUN apt-get update && apt-get install -y \
  git \
  curl \
  libpng-dev \
  libonig-dev \
  libxml2-dev \
  libzip-dev \
  libicu-dev \
  libsodium-dev \
  zip \
  unzip \
  && apt-get clean \
  && rm -rf /var/lib/apt/lists/*

# ─── Node.js y npm (requerido por Laravel Vite / Filament) ─────────────────
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
  && apt-get install -y nodejs \
  && npm install -g npm@latest

# ─── Extensiones PHP necesarias para Laravel ─────────────────────────────────
RUN docker-php-ext-install \
  pdo_mysql \
  mbstring \
  exif \
  pcntl \
  bcmath \
  gd \
  zip \
  intl \
  sodium

# ─── Composer ────────────────────────────────────────────────────────────────
COPY --from=composer:2.7 /usr/bin/composer /usr/bin/composer

# ─── Usuario no-root (evita problemas de permisos en el host) ────────────────
RUN useradd -G www-data,root -u $uid -d /home/$user $user \
  && mkdir -p /home/$user/.composer \
  && chown -R $user:$user /home/$user

# ─── Directorio de trabajo ───────────────────────────────────────────────────
WORKDIR /var/www

USER $user
