FROM debian:11.6-slim
ENV COMPOSER_ALLOW_SUPERUSER=1
ENV COMPOSER_PROCESS_TIMEOUT=200000
RUN apt-get update && apt-get -y install software-properties-common ca-certificates lsb-release apt-transport-https gnupg2 wget
RUN sh -c 'echo "deb https://packages.sury.org/php/ $(lsb_release -sc) main" > /etc/apt/sources.list.d/php.list'
RUN wget -qO - https://packages.sury.org/php/apt.gpg | apt-key add -
RUN apt-get update && apt-get -y install zip unzip php8.2 php8.2-xml php8.2-mysql php8.2-zip php8.2-curl php8.2-mbstring php8.2-fpm php8.2-gd
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php composer-setup.php
RUN php -r "unlink('composer-setup.php');"
RUN mv composer.phar /usr/local/bin/composer
RUN apt-get update && apt-get -y install nginx
COPY ./www.conf /etc/php/8.2/fpm/pool.d/
COPY ./app.conf /etc/nginx/sites-available/
RUN ln -s /etc/nginx/sites-available/app.conf /etc/nginx/sites-enabled/
RUN mkdir -m 777 /run/php
WORKDIR /usr/src/app
CMD bash -c "chmod -R 777 /usr/src && chown -R www-data:www-data /usr/src && service php8.2-fpm restart && service nginx restart && composer install" && tail -f /dev/null
