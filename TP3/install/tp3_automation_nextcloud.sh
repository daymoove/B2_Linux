#!/bin/bash

#install apache

dnf install httpd -y

#install next cloud

dnf config-manager --set-enabled crb -y
dnf install dnf-utils http://rpms.remirepo.net/enterprise/remi-release-9.rpm -y
dnf module list php -y
sudo dnf module enable php:remi-8.1 -y
sudo dnf install -y php81-php
dnf install -y libxml2 openssl php81-php php81-php-ctype php81-php-curl php81-php-gd php81-php-iconv php81-php-json php81-php-libxml php81-php-mbstring php81-php-openssl php81-php-posix php81-php-session php81-php-xml php81-php-zip php81-php-zlib php81-php-pdo php81-php-mysqlnd php81-php-intl php81-php-bcmath php81-php-gmp

mkdir /var/www

mv install/conf_file/nextcloud /var/www
chown -R apache /var/www/nextcloud
name="$(hostname)"
sed -i '/  ServerName  localhost.localdomain/c\  ServerName  '$name'' install/conf_file/nextcloud.conf
mv install/conf_file/nextcloud.conf /etc/httpd/conf.d

#firewall

firewall-cmd --add-port=80/tcp --permanent
firewall-cmd --reload

systemctl start httpd
