#!/usr/bin/env bash
apt-get -y purge php5-common
apt-get install python-software-properties
add-apt-repository ppa:ondrej/php
apt-get update
apt-get -y install php7.1 php7.1-fpm php7.1-mysql php-curl libapache2-mod-php7.1 php7.1-mbstring php7.1-curl php7.1-xml php7.1-mongo php7.1-soap php7.1-oauth
composer self-update
a2enmod php7.1
apachectl restart
export LC_ALL=C
