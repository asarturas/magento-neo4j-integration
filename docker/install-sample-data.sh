#!/bin/bash

cd sample-data
if [ ! -f magento-sample-data-1.9.1.0.tar.gz ]; then
    curl -o magento-sample-data-1.9.1.0.tar.gz http://netix.dl.sourceforge.net/project/mageloads/assets/1.9.1.0/magento-sample-data-1.9.1.0.tar.gz
fi
if [ ! -d magento-sample-data-1.9.1.0 ]; then
    tar -xvzf magento-sample-data-1.9.1.0.tar.gz
fi
cd magento-sample-data-1.9.1.0/
cp -Rf media/* ../../public/media/
cp -Rf skin/* ../../public/skin/

mysql -u$DBUSERNAME -p$DBPASSWORD -h$DBHOST $DBNAME < magento_sample_data_for_1.9.1.0.sql

cd ../../public
chmod -R 777 ./var
chown -R www-data: ./var

n98-magerun sy:se:ru
n98-magerun in:re:al
n98-magerun admin:user:create admin arturas@smorgun.lt admin123123 Arturas Smorgun
n98-magerun admin:notifications
