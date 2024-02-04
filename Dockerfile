FROM php:8.1.0-fpm
 

# Copy composer.lock and composer.json
COPY composer.lock composer.json /var/www/html/subscription_sync/

# Set working directory
WORKDIR /var/www/html/subscription_sync

# Install dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    libzip-dev\
    libonig-dev\
    curl \
    libgmp-dev \
    libcurl4-openssl-dev \
    default-mysql-client

RUN pecl install ds
# RUN pecl install event



# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install extensions
RUN docker-php-ext-install pdo_mysql mbstring zip exif pcntl
RUN docker-php-ext-configure gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/
RUN docker-php-ext-install gd
RUN docker-php-ext-install gmp
RUN docker-php-ext-install bcmath
RUN docker-php-ext-enable bcmath
RUN docker-php-ext-enable ds


# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer


#RUN chmod 777 -R ./docker_setting/bin
#RUN chmod 777 -R ./storage



#COPY crontab /etc/cron.d/crontab

# Give execution rights on the cron job
#RUN chmod 0644 /etc/cron.d/crontab

# Apply cron job
#RUN crontab /etc/cron.d/crontab

# Create the log file to be able to run tail
#RUN touch /var/log/cron.log

# Run the command on container startup
#CMD cron && tail -f /var/log/cron.log



# Add user for laravel application
RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

# Copy existing application directory contents
COPY . /var/www/html/subscription_sync

# RUN php artisan optimize

# RUN pip install tradingview-ta

# Copy existing application directory permissions
COPY --chown=www-data:www-data . /var/www/html/subscription_sync

# Change current user to www
USER www

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]
