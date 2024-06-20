FROM php:7.4-fpm

WORKDIR /var/www/

RUN apt-get update && apt-get install -y supervisor

RUN apt-get update && apt-get install -y \
      apt-utils \
      libpq-dev \
      libpng-dev \
      libzip-dev \
      zip unzip \
      git && \
      docker-php-ext-install pdo_mysql && \
      docker-php-ext-install bcmath && \
      docker-php-ext-install gd && \
      docker-php-ext-install zip && \
      docker-php-ext-install pdo_pgsql && \
      apt-get clean && \
      rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* \
      && adduser \
            --disabled-password \
            --shell /sbin/nologin \
            --home /home/appuser \
            --no-create-home \
            --uid 1000 \
            appuser

COPY ./.docker/app/php.ini /usr/local/etc/php/conf.d/php.ini
ENV TZ=Europe/Moscow

RUN mkdir -p "/etc/supervisor/logs"

COPY .docker/supervisor/supervisord.conf /etc/supervisor/supervisord.conf

CMD ["/usr/bin/supervisord", "-n", "-c",  "/etc/supervisor/supervisord.conf"]
