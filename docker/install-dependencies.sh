#!/bin/bash

curl -sS https://getcomposer.org/installer | php
mv ./composer.phar /usr/local/bin/composer
chmod +x /usr/local/bin/composer

curl -o n98-magerun.phar http://files.magerun.net/n98-magerun-latest.phar
mv ./n98-magerun.phar /usr/local/bin/n98-magerun
chmod +x /usr/local/bin/n98-magerun
