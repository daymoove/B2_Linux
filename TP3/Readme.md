# TP3 : Amélioration de la solution NextCloud

## Module 1 : Reverse Proxy

### II. Setup

**On utilisera NGINX comme reverse proxy**

```
[daymoove@proxy ~]$ sudo dnf install nginx

Installed:
  nginx-1:1.20.1-10.el9.x86_64     nginx-filesystem-1:1.20.1-10.el9.noarch     rocky-logos-httpd-90.11-1.el9.noarch

Complete!

[daymoove@proxy ~]$ sudo systemctl start nginx

[daymoove@proxy ~]$ ss -tulpn | grep LISTEN
tcp   LISTEN 0      511             [::]:80           [::]:*    users:(("nginx",pid=1139,fd=7),("nginx",pid=1138,fd=7))

[daymoove@proxy ~]$ sudo firewall-cmd --add-port=80/tcp --permanent
success

[daymoove@proxy ~]$ sudo firewall-cmd --reload
success

[daymoove@proxy ~]$ ps -ef
nginx       1139    1138  0 10:48 ?        00:00:00 nginx: worker process


PS C:\Users\M.SELVA> curl 10.102.1.13:80                                                                              
StatusCode        : 200
StatusDescription : OK
```

**Configurer NGINX**

```
[daymoove@proxy ~]$ sudo cat /etc/nginx/conf.d/nc.conf
server {
    server_name web.tp2.linux;


[...]
}
```

```
[daymoove@web /]$ sudo cat /var/www/tp2_nextcloud/config/config.php
[sudo] password for daymoove:
<?php
$CONFIG = array (
  'instanceid' => 'ocnripx8mt8h',
  'passwordsalt' => 'sboRDMyMHGGfYRoT3ytl/e8m1b4+8G',
  'secret' => 'mLRf0eir/MUsOgDys5o4GVbp8e/JpVDXzaXuwzheLFll3I8b',
  'trusted_domains' =>
  array (
          0 => 'web.tp2.linux'
  ),
[...]
);
```

**Modifier votre fichier hosts de VOTRE PC**

```
PS C:\Users\M.SELVA> curl http://web.tp2.linux


StatusCode        : 200
StatusDescription : OK
```

### III. HTTPS

```
[daymoove@proxy ssl]$ sudo openssl req -x509 -nodes -days 365 -newkey rsa:2048 -keyout /etc/ssl/private/nginx-selfsigned.key -out /etc/ssl/certs/nginx-selfsigned.crt

You are about to be asked to enter information that will be incorporated
into your certificate request.
```

```
[daymoove@proxy nginx]$ sudo cat /etc/nginx/conf.d/nc.conf
server {
    server_name web.tp2.linux;


    listen 443 ssl;
    listen [::]:443 ssl;
    include snippets/self-signed.conf;
    include snippets/ssl-params.conf;
[...]
}
```

```
[daymoove@web ~]$ sudo cat /var/www/tp2_nextcloud/config/config.php
[...]
  'overwriteprotocol' => 'https',
);
```

## Module 5 : Monitoring

**Je vous laisse suivre la doc pour le mettre en place**

```
[daymoove@web ~]$ wget -O /tmp/netdata-kickstart.sh https://my-netdata.io/kickstart.sh && sh /tmp/netdata-kickstart.sh

Complete!

[daymoove@web ~]$ sudo systemctl enable netdata
[daymoove@web ~]$ sudo systemctl status netdata
● netdata.service - Real time performance monitoring
     Loaded: loaded (/usr/lib/systemd/system/netdata.service; enabled; vendor preset: disabled)
     Active: active (running) since Fri 2022-11-18 10:15:15 CET; 6min ago
[...]
```

**Configurer Netdata pour qu'il vous envoie des alertes**

```
[daymoove@web ~]$ sudo cat /etc/netdata/health_alarm_notify.conf
###############################################################################
# sending discord notifications

# note: multiple recipients can be given like this:
#                  "CHANNEL1 CHANNEL2 ..."

# enable/disable sending discord notifications
SEND_DISCORD="YES"

# Create a webhook by following the official documentation -
# https://support.discordapp.com/hc/en-us/articles/228383668-Intro-to-Webhooks
DISCORD_WEBHOOK_URL="https://discord.com/api/webhooks/1043105805458755656/zAl1mimWoHoNANNVgVaaE-SyEymFb2897deN6NO-H6vMJdbdsAXVIO4JbBQ6HKGY7akQ"

# if a role's recipients are not configured, a notification will be send to
# this discord channel (empty = do not send a notification for unconfigured
# roles):

DEFAULT_RECIPIENT_DISCORD="alarms"

role_recipients_discord[sysadmin]="${DEFAULT_RECIPIENT_DISCORD}"
role_recipients_discord[dba]="${DEFAULT_RECIPIENT_DISCORD}"
role_recipients_discord[webmaster]="${DEFAULT_RECIPIENT_DISCORD}"

[daymoove@web ~]$ sudo cat /etc/netdata/health.d/cpu_usage.conf

alarm: cpu_usage
on: system.cpu
lookup: average -3s percentage foreach user,system
units: %
every: 10s
warn: $this > 50
crit: $this > 80
info: CPU utilization of users on the system itself.
```

## Module 6 : Automatiser le déploiement

Recuperer le dossier install ci-dessous
[install](./install)

## Module 7 : Fail2Ban

```
[daymoove@proxy ~]$ sudo dnf install epel-release -y

[daymoove@proxy ~]$ sudo dnf install fail2ban -y

```

```
[daymoove@proxy ~]$ sudo cat /etc/fail2ban/jail.conf

findtime  = 1m
[...]
bantime  = 24h
[...]
maxretry = 3

[daymoove@proxy ~]$ sudo cat /etc/fail2ban/jail.d/custom.conf
[sshd]
enabled = true
```

```
[daymoove@proxy ~]$ sudo fail2ban-client status sshd
Status for the jail: sshd
|- Filter
|  |- Currently failed: 0
|  |- Total failed:     3
|  `- Journal matches:  _SYSTEMD_UNIT=sshd.service + _COMM=sshd
`- Actions
   |- Currently banned: 1
   |- Total banned:     1
   `- Banned IP list:   10.102.1.16
   
   
[daymoove@proxy ~]$ sudo fail2ban-client unban 10.102.1.16
1
```