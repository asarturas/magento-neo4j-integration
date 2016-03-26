#!/bin/bash

mysql -u$DBUSERNAME -p$DBPASSWORD -h$DBHOST -e "create database $DBNAME"

cd public
n98-magerun install \
    --magentoVersion=magento-mirror-1.9.1.0 \
    --installationFolder=. --dbHost=$DBHOST \
    --dbUser=$DBUSERNAME \
    --dbPass=$DBPASSWORD \
    --dbName=$DBNAME \
    --installSampleData=false \
    --useDefaultConfigParams=yes \
    --baseUrl=http://$APPHOST
cd ..

composer install
