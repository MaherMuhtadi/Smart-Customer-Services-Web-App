# Uses the official PHP image as the base image
FROM php:apache

# Installs mysqli
RUN apt-get update
RUN docker-php-ext-install mysqli

# Copies the app source code to the appropriate directory in the image
COPY src/ /var/www/html/

# Exposes the port that the Apache server will listen to
EXPOSE 80