#!/bin/bash

curl -sS https://getcomposer.org/installer | php
mv ./composer.phar /usr/local/bin/composer
chmod +x /usr/local/bin/composer

curl -o n98-magerun.phar http://files.magerun.net/n98-magerun-latest.phar
mv ./n98-magerun.phar /usr/local/bin/n98-magerun
chmod +x /usr/local/bin/n98-magerun

apt-get update
apt-get install -y git mysql-client libmcrypt-dev libpng-dev
docker-php-ext-install mbstring pdo_mysql mcrypt gd zip

mysql -u$DBUSERNAME -p$DBPASSWORD -h$DBHOST -e "create database $DBNAME"

