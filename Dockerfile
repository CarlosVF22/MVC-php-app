# Usa una imagen base de PHP
FROM php:8.1-apache

# Copia el contenido de la aplicación al contenedor
COPY ./app /var/www/html

RUN chmod 644 /var/www/html/.htaccess

# Copiar la configuración personalizada de Apache
COPY 000-default.conf /etc/apache2/sites-available/000-default.conf


# Habilita el módulo de Apache para PHP
RUN docker-php-ext-install mysqli

# Configura el servidor Apache
RUN a2enmod rewrite

# Instalar dependencias requeridas para Composer
RUN apt-get update && \
    apt-get install -y unzip && \
    apt-get clean

# Descargar e instalar Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Expon el puerto 80 para el servidor web
EXPOSE 80

# Comando para iniciar Apache
CMD ["apache2-foreground"]
