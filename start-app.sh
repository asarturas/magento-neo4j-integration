#!/usr/bin/env bash

apt-get update
apt-get install -y git mysql-client libmcrypt-dev libpng-dev
docker-php-ext-install mbstring pdo_mysql mcrypt gd zip
usermod -u 1000 www-data
php-fpm
