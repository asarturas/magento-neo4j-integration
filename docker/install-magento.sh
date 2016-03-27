#!/bin/bash

mysql -uapp -papp -hdb -e "create database app"

cd public
n98-magerun install \
    --magentoVersion=magento-mirror-1.9.1.0 \
    --installationFolder=. --dbHost=db \
    --dbUser=app \
    --dbPass=app \
    --dbName=app \
    --installSampleData=false \
    --useDefaultConfigParams=yes \
    --baseUrl=http://magento-neo4j.local
cd ..

composer install
