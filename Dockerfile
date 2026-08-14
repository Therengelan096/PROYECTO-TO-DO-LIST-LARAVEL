FROM php:8.2-apache

# Dependencias del sistema y extensiones de PHP
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    curl \
    && docker-php-ext-install pdo_mysql mbstring bcmath gd

# Modulo rewrite de Apache para que las rutas de Laravel funcionen
RUN a2enmod rewrite

# Configura el DocumentRoot de Apache apuntando a la carpeta /public de Laravel
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/conf-available/*.conf
# Establece el directorio de trabajo
WORKDIR /var/www/html

# Codigo del proyecto al contenedor
COPY . .

# Instala Composer globalmente y ejecuta composer install
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

# Asigna permisos correctos a las carpetas de almacenamiento y caché de Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Expone el puerto 80 del servidor Apache
EXPOSE 80

# Comando para iniciar Apache en primer plano
CMD ["apache2-foreground"]