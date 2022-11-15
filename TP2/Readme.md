# TP2 : Gestion de service

## I. Un premier serveur web

**1. Installation**

**Installer le serveur Apache**

```
[daymoove@web ~]$ sudo dnf install httpd

Installed:
  apr-1.7.0-11.el9.x86_64                                apr-util-1.6.1-20.el9.x86_64
  apr-util-bdb-1.6.1-20.el9.x86_64                       apr-util-openssl-1.6.1-20.el9.x86_64
  httpd-2.4.51-7.el9_0.x86_64                            httpd-filesystem-2.4.51-7.el9_0.noarch
  httpd-tools-2.4.51-7.el9_0.x86_64                      mailcap-2.1.49-5.el9.noarch
  mod_http2-1.15.19-2.el9.x86_64                         mod_lua-2.4.51-7.el9_0.x86_64
  rocky-logos-httpd-90.11-1.el9.noarch

Complete!
```

**Démarrer le service Apache**

```
[daymoove@web ~]$ sudo systemctl start httpd

[daymoove@web ~]$ sudo systemctl status httpd
● httpd.service - The Apache HTTP Server
     Loaded: loaded (/usr/lib/systemd/system/httpd.service; disabled; vendor preset: disabled)
     Active: active (running) since Tue 2022-11-15 10:01:09 CET; 10s ago

[daymoove@web ~]$ sudo systemctl enable httpd
Created symlink /etc/systemd/system/multi-user.target.wants/httpd.service → /usr/lib/systemd/system/httpd.service.


sudo ss -tulpn | grep LISTEN

tcp   LISTEN 0      511                *:80              *:*    users:(("httpd",pid=32889,fd=4),("httpd",pid=32888,fd=4),("httpd",pid=32887,fd=4),("httpd",pid=32885,fd=4))

[daymoove@web ~]$ sudo firewall-cmd --add-port=80/tcp --permanent
success
[daymoove@web ~]$ sudo firewall-cmd --reload
success
```

**TEST**

```
[daymoove@web ~]$ sudo systemctl status httpd
● httpd.service - The Apache HTTP Server
     Loaded: loaded (/usr/lib/systemd/system/httpd.service; enabled; vendor preset: disabled)
     Active: active (running) since Tue 2022-11-15 10:01:09 CET; 9min ago
     
[daymoove@web ~]$ curl localhost
<!doctype html>
<html>
[...]
</html>

PS C:\Users\M.SELVA> curl 10.102.1.11:80
curl : HTTP Server Test Page
This page is used to test the proper operation of an HTTP server after it has been installed on a Rocky Linux
system. If you can read this page, it means that the software it working correctly.
[...]
```

**2. Avancer vers la maîtrise du service**

**Le service Apache...**

```
[daymoove@web ~]$ cat /etc/systemd/system/multi-user.target.wants/httpd.service

[Unit]
Description=The Apache HTTP Server
Wants=httpd-init.service
After=network.target remote-fs.target nss-lookup.target httpd-init.service
Documentation=man:httpd.service(8)

[Service]
Type=notify
Environment=LANG=C

ExecStart=/usr/sbin/httpd $OPTIONS -DFOREGROUND
ExecReload=/usr/sbin/httpd $OPTIONS -k graceful
# Send SIGWINCH for graceful stop
KillSignal=SIGWINCH
KillMode=mixed
PrivateTmp=true
OOMPolicy=continue

[Install]
WantedBy=multi-user.target
```

**Déterminer sous quel utilisateur tourne le processus Apache**

```
[daymoove@web ~]$ cat /etc/httpd/conf/httpd.conf
[...]
User apache
[...]


[daymoove@web ~]$ ps -ef
[...]
apache     32886   32885  0 10:01 ?        00:00:00 /usr/sbin/httpd -DFOREGROUND
apache     32887   32885  0 10:01 ?        00:00:00 /usr/sbin/httpd -DFOREGROUND
apache     32888   32885  0 10:01 ?        00:00:00 /usr/sbin/httpd -DFOREGROUND
apache     32889   32885  0 10:01 ?        00:00:00 /usr/sbin/httpd -DFOREGROUND
[...]


[daymoove@web ~]$ ls -al /usr/share/testpage/
[...]
-rw-r--r--.  1 root root 7620 Jul  6 04:37 index.html
```

**Changer l'utilisateur utilisé par Apache**

```
[daymoove@web ~]$ sudo useradd web -m -s /sbin/nologin

[daymoove@web ~]$ cat /etc/httpd/conf/httpd.conf

ServerRoot "/etc/httpd"

Listen 80

Include conf.modules.d/*.conf

User web
[...]


[daymoove@web ~]$ ps -ef
[...]
web        33242   33241  0 10:46 ?        00:00:00 /usr/sbin/httpd -DFOREGROUND
web        33243   33241  0 10:46 ?        00:00:00 /usr/sbin/httpd -DFOREGROUND
web        33244   33241  0 10:46 ?        00:00:00 /usr/sbin/httpd -DFOREGROUND
web        33245   33241  0 10:46 ?        00:00:00 /usr/sbin/httpd -DFOREGROUND
```

**Faites en sorte que Apache tourne sur un autre port**

```
[daymoove@web ~]$ cat /etc/httpd/conf/httpd.conf

ServerRoot "/etc/httpd"

Listen 8090


[daymoove@web ~]$ sudo firewall-cmd --add-port=8090/tcp --permanent
success

[daymoove@web ~]$ sudo firewall-cmd --remove-port=80/tcp --permanent
success

[daymoove@web ~]$ sudo firewall-cmd --reload
success

[daymoove@web ~]$ sudo ss -tulpn | grep LISTEN
tcp   LISTEN 0      511                *:8090            *:*    users:(("httpd",pid=33502,fd=4),("httpd",pid=33501,fd=4),("httpd",pid=33500,fd=4),("httpd",pid=33497,fd=4))

[daymoove@web ~]$ curl localhost:8090
<!doctype html>
<html>
  <head>
  
PS C:\Users\M.SELVA> curl 10.102.1.11:8090
curl : HTTP Server Test Page
This page is used to test the proper operation of an HTTP server after it has been installed on a Rocky Linux
system. If you can read this page, it means that the software it working correctly.
```

[httpd.conf](./httpd.conf)

## II. Une stack web plus avancée

**2. Setup**

**Install de MariaDB sur db.tp2.linux**
```
[daymoove@db ~]$ sudo dnf install mariadb-server
[...]
Complete!

[daymoove@db ~]$ sudo systemctl enable mariadb
Created symlink /etc/systemd/system/mysql.service → /usr/lib/systemd/system/mariadb.service.
Created symlink /etc/systemd/system/mysqld.service → /usr/lib/systemd/system/mariadb.service.
Created symlink /etc/systemd/system/multi-user.target.wants/mariadb.service → /usr/lib/systemd/system/mariadb.service.

[daymoove@db ~]$ sudo mysql_secure_installation

All done!  If you've completed all of the above steps, your MariaDB
installation should now be secure.

Thanks for using MariaDB!

[daymoove@db ~]$ sudo firewall-cmd --add-port=3306/tcp --permanent
success
```

**Préparation de la base pour NextCloud**

```
[daymoove@db ~]$ sudo mysql -u root -p
Enter password:
Welcome to the MariaDB monitor.  Commands end with ; or \g.
Your MariaDB connection id is 13
Server version: 10.5.16-MariaDB MariaDB Server

Copyright (c) 2000, 2018, Oracle, MariaDB Corporation Ab and others.

Type 'help;' or '\h' for help. Type '\c' to clear the current input statement.

MariaDB [(none)]> CREATE USER 'nextcloud'@'10.102.1.11' IDENTIFIED BY 'pewpewpew';
Query OK, 0 rows affected (0.001 sec)

MariaDB [(none)]> CREATE DATABASE IF NOT EXISTS nextcloud CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
Query OK, 1 row affected (0.000 sec)

MariaDB [(none)]> GRANT ALL PRIVILEGES ON nextcloud.* TO 'nextcloud'@'10.102.1.11';
Query OK, 0 rows affected (0.001 sec)

MariaDB [(none)]> FLUSH PRIVILEGES;
Query OK, 0 rows affected (0.001 sec)

```

**Exploration de la base de données**

```
[daymoove@web ~]$ sudo mysql -u nextcloud -h 10.102.1.12 -p
Enter password:
Welcome to the MySQL monitor.  Commands end with ; or \g.
[...]

mysql>

mysql> SHOW DATABASES;
+--------------------+
| Database           |
+--------------------+
| information_schema |
| nextcloud          |
+--------------------+
2 rows in set (0.00 sec)

mysql> USE nextcloud
Database changed
mysql> show tables
    ->
```

**Trouver une commande SQL qui permet de lister tous les utilisateurs de la base de données**

```
MariaDB [(none)]> select user, host from mysql.user;
+-------------+-------------+
| User        | Host        |
+-------------+-------------+
| nextcloud   | 10.102.1.11 |
| mariadb.sys | localhost   |
| mysql       | localhost   |
| root        | localhost   |
+-------------+-------------+
4 rows in set (0.001 sec)
```

**B. Serveur Web et NextCloud**

```
[daymoove@web ~]$ sudo dnf config-manager --set-enabled crb

[daymoove@web ~]$ sudo dnf install dnf-utils http://rpms.remirepo.net/enterprise/remi-release-9.rpm -y
Installed:
  epel-release-9-4.el9.noarch         remi-release-9.0-6.el9.remi.noarch         yum-utils-4.0.24-4.el9_0.noarch

Complete!

[daymoove@web ~]$ dnf module list php
Complete!

[daymoove@web ~]$ sudo dnf module enable php:remi-8.1 -y
Complete!

[daymoove@web ~]$ sudo dnf install -y php81-php
Complete!
```

**Install de tous les modules PHP nécessaires pour NextCloud**

```
[daymoove@web ~]$ sudo dnf install -y libxml2 openssl php81-php php81-php-ctype php81-php-curl php81-php-gd php81-php-iconv php81-php-json php81-php-libxml php81-php-mbstring php81-php-openssl php81-php-posix php81-php-session php81-php-xml php81-php-zip php81-php-zlib php81-php-pdo php81-php-mysqlnd php81-php-intl php81-php-bcmath php81-php-gmp

Complete!
```

**Récupérer NextCloud**

```
sudo chown -R apache tp2_nextcloud/


[daymoove@web www]$ ls -al

drwxr-xr-x. 14 apache   root          4096 Oct  6 14:47 tp2_nextcloud
```

**Adapter la configuration d'Apache**

```
[daymoove@web ~]$ sudo cat /etc/httpd/conf.d/nextcloud.conf
<VirtualHost *:80>
[...]


[daymoove@web ~]$ sudo systemctl restart httpd
[daymoove@web ~]$ sudo systemctl status httpd
● httpd.service - The Apache HTTP Server
     Loaded: loaded (/usr/lib/systemd/system/httpd.service; enabled; vendor preset: disabled)
    Drop-In: /usr/lib/systemd/system/httpd.service.d
             └─php81-php-fpm.conf
     Active: active (running) since Tue 2022-11-15 12:32:48 CET; 2s ago
```

**C. Finaliser l'installation de NextCloud**

**Exploration de la base de données**

```
MariaDB [(none)]> SELECT COUNT(*) as nextcloud FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'nextcloud';
+-----------+
| nextcloud |
+-----------+
|        95 |
+-----------+
1 row in set (0.001 sec)
```