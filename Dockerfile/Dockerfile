FROM php:8.2-cli

# Install PHP extensions and server
RUN apt-get update && apt-get install -y \
    unzip \
    zip \
    curl \
    git \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    && docker-php-ext-install pdo pdo_mysql zip

# Copy project files
COPY . /var/www/html
WORKDIR /var/www/html

# Expose the port Render expects
EXPOSE 10000

# Start PHP built-in server
CMD ["php", "-S", "0.0.0.0:10000"]
