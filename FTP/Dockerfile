# base image
FROM php:7.3-apache

# install additional packages
RUN apt-get update && apt-get install -y \
  libpng-dev \
  libjpeg-dev \
  libzip-dev \
  zip \
  unzip \
  && docker-php-ext-configure gd --with-jpeg \
  && docker-php-ext-install gd mysqli pdo pdo_mysql zip

# install FTP server
RUN apt-get update && apt-get install -y pure-ftpd

# create FTP user
RUN useradd ftpuser -m -s /bin/false \
  && pure-pw useradd ftpuser -u ftpuser -d /home/ftpuser

# create directory for FTP user
RUN mkdir -p /home/ftpuser/uploads \
  && chown -R ftpuser:ftpuser /home/ftpuser/uploads \
  && chmod 755 /home/ftpuser/uploads

# copy web files
COPY ./php/ /var/www/html/

# open ports
EXPOSE 80 21 30000-30009

# start services
CMD service pure-ftpd start && apache2-foreground