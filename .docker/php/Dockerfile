FROM php:8.2-fpm

# Set working directory
WORKDIR /var/www/html

# Install dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    locales-all \
    zip \
    jpegoptim optipng pngquant gifsicle \
    imagemagick \
    vim \
    unzip \
    git \
    curl \
    wget \
    libzip-dev \
    libpq-dev \
    libonig-dev \
    libmagickwand-dev \
    libgmp-dev \
    zlib1g-dev libicu-dev g++ \
    cron \
    supervisor \
    procps \
    sudo


# Aplica a configuração global do Git para este usuário
RUN git config --global --add safe.directory '*'

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*
RUN pecl install imagick

# Install extensions
RUN docker-php-ext-install exif pcntl zip mbstring bcmath sockets
RUN docker-php-ext-configure gd  --with-freetype=/usr/include/ --with-jpeg=/usr/include/
RUN docker-php-ext-install gd pdo pdo_mysql intl gmp
RUN docker-php-ext-enable imagick

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Add user for laravel application
RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www
RUN chown -R www:www /var/www
RUN echo "www ALL=(ALL) NOPASSWD: /usr/bin/supervisord" >> /etc/sudoers

#88 Configuring locale to pt_BR.UTF-8
ENV LC_ALL pt_BR.UTF-8
ENV LANG pt_BR.UTF-8
ENV LANGUAGE pt_BR.UTF-8

# Create supervisor log file and change ownership
RUN touch /var/log/supervisor/supervisord.log
RUN chown www:www /var/log/supervisor/supervisord.log

# Create supervisor pid file and change ownership
RUN touch /var/run/supervisord.pid
RUN chown www:www /var/run/supervisord.pid

# Copy Supervisor configuration
COPY supervisor/supervisord.conf /etc/supervisor/supervisord.conf
RUN chown www:www /etc/supervisor/supervisord.conf && chmod 644 /etc/supervisor/supervisord.conf

# Copy Horizon configuration
COPY horizon/horizon.conf /etc/supervisor/conf.d

# Copy crontab file
COPY crontab /etc/cron.d/laravel-cron
RUN chmod 0644 /etc/cron.d/laravel-cron && crontab /etc/cron.d/laravel-cron && touch /var/log/cron.log

# Copy start script and make it executable
COPY start.sh /usr/local/bin/start.sh
RUN chmod +x /usr/local/bin/start.sh

COPY conf.d/www.conf /usr/local/etc/php-fpm.d/www.conf

# Change current user to www
USER www
RUN echo 'alias pa="php artisan "' >> ~/.bashrc

# Change current user to root
USER root
RUN echo 'alias pa="php artisan "' >> ~/.bashrc

# Change current user to www
USER www
# Expose port 9000 and start php-fpm server
EXPOSE 9000
# Start PHP-FPM, Cron, and Supervisor using the start script
CMD ["/usr/local/bin/start.sh"]
