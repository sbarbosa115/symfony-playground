FROM ubuntu:18.04

RUN apt update --fix-missing
RUN apt update && apt-get install software-properties-common curl -y
RUN add-apt-repository -y ppa:ondrej/php && apt-get update
RUN apt install nginx php8.0 php8.0-fpm php8.0-common php8.0-mysql php8.0-mbstring php8.0-xml php8.0-zip php8.0-gd php8.0-bcmath php8.0-curl\
    php8.0-sqlite3 php8.0-xdebug supervisor -y && \
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY Docker/nginx/site.conf /etc/nginx/sites-available/site.conf
COPY Docker/nginx/nginx.conf /etc/nginx/nginx.conf
COPY Docker/conf/supervisord.conf /etc/supervisor/conf.d/supervisord.conf
RUN ln -s /etc/nginx/sites-available/site.conf /etc/nginx/sites-enabled/

RUN openssl req -x509 -nodes -days 365 -newkey rsa:2048 -keyout /etc/ssl/certs/candidatos.talentu.local.key -out /etc/ssl/certs/candidatos.talentu.local.crt -subj "/C=CO/ST=Bogota D.C/L=Colombia/O=Talentu/OU=Development/CN=candidatos.talentu.local"

WORKDIR /var/www/html

EXPOSE 80 443

CMD ["supervisord"]