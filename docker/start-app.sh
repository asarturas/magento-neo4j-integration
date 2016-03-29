#!/bin/bash

apt-get update
apt-get install -y git mysql-client libmcrypt-dev libpng-dev
docker-php-ext-install mbstring pdo_mysql mcrypt gd zip
usermod -u 1000 www-data

SCRIPT=$(readlink -f $0)
SCRIPTPATH=`dirname $SCRIPT`
$SCRIPTPATH/install-dependencies.sh
$SCRIPTPATH/install-magento.sh
$SCRIPTPATH/install-sample-data.sh

mkdir -p /etc/php5/fpm/pool.d
cp /shared-php-config/php-fpm.conf  /etc/php5/fpm/php-fpm.conf
cp /shared-php-config/www.conf      /etc/php5/fpm/pool.d/www.conf

php-fpm
