# Dockerfile.app - container da aplicação PHP
FROM php:7.4-apache

# Instala a extensão mysqli (necessária para conectar ao MySQL)
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

# Copia o index.php para o diretório padrão do Apache
COPY index.php /var/www/html/index.php

# (Opcional) expõe porta 80 para documentar
EXPOSE 80
