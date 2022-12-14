# TP1 : (re)Familiaration avec un système GNU/Linux

## 0. Préparation de la machine

**🌞 Setup de deux machines Rocky Linux configurées de façon basique.**

**un accès internet (via la carte NAT)**

node1.tp1.b2

```
[daymoove@node1 ~]$ ip a

3: enp0s8: <BROADCAST,MULTICAST,UP,LOWER_UP> mtu 1500 qdisc fq_codel state UP group default qlen 1000
    link/ether 08:00:27:2d:45:9c brd ff:ff:ff:ff:ff:ff
    inet 10.0.3.15/24 brd 10.0.3.255 scope global dynamic noprefixroute enp0s8
       valid_lft 86244sec preferred_lft 86244sec
    inet6 fe80::b45:fa75:e606:7434/64 scope link noprefixroute
       valid_lft forever preferred_lft forever
```

```
[daymoove@node1 ~]$ ip route show
default via 10.0.3.2 dev enp0s8 proto dhcp src 10.0.3.15 metric 101
10.0.3.0/24 dev enp0s8 proto kernel scope link src 10.0.3.15 metric 101
10.101.1.0/24 dev enp0s3 proto kernel scope link src 10.101.1.11 metric 100
```

node2.tp1.b2

```
[daymoove@node2 ~]$ ip a

3: enp0s8: <BROADCAST,MULTICAST,UP,LOWER_UP> mtu 1500 qdisc fq_codel state UP group default qlen 1000
    link/ether 08:00:27:5e:49:27 brd ff:ff:ff:ff:ff:ff
    inet 10.0.3.15/24 brd 10.0.3.255 scope global dynamic noprefixroute enp0s8
       valid_lft 86190sec preferred_lft 86190sec
    inet6 fe80::a7ef:daed:f233:63eb/64 scope link noprefixroute
       valid_lft forever preferred_lft forever
```

```
[daymoove@node2 ~]$ ip route show
default via 10.0.3.2 dev enp0s8 proto dhcp src 10.0.3.15 metric 101
10.0.3.0/24 dev enp0s8 proto kernel scope link src 10.0.3.15 metric 101
10.101.1.0/24 dev enp0s3 proto kernel scope link src 10.101.1.12 metric 100
```

**un accès à un réseau local**

node1.tp1.b2

```
[daymoove@node1 ~]$ ping 10.101.1.12
PING 10.101.1.12 (10.101.1.12) 56(84) bytes of data.
64 bytes from 10.101.1.12: icmp_seq=1 ttl=64 time=0.532 ms
64 bytes from 10.101.1.12: icmp_seq=2 ttl=64 time=0.631 ms
64 bytes from 10.101.1.12: icmp_seq=3 ttl=64 time=0.380 ms
```

node2.tp1.b2

```
[daymoove@node2 ~]$  ping 10.101.1.11
PING 10.101.1.11 (10.101.1.11) 56(84) bytes of data.
64 bytes from 10.101.1.11: icmp_seq=1 ttl=64 time=0.513 ms
64 bytes from 10.101.1.11: icmp_seq=2 ttl=64 time=0.891 ms
64 bytes from 10.101.1.11: icmp_seq=3 ttl=64 time=0.553 ms
```

**les machines doivent avoir un nom**

node1.tp1.b2

```
sudo hostnamectl set-hostname node1.tp1.b2
```

```
[daymoove@node1 ~]$ hostname
node1.tp1.b2
```

node2.tp1.b2

```
sudo hostnamectl set-hostname node2.tp1.b2
```

```
[daymoove@node2 ~]$ hostname
node2.tp1.b2
```

**utiliser 1.1.1.1 comme serveur DNS**

node1.tp1.b2

```
[daymoove@node1 ~]$ sudo vim /etc/resolv.conf
```

```
[daymoove@node1 ~]$ sudo cat /etc/resolv.conf
# Generated by NetworkManager
search tp1.b2
nameserver 1.1.1.1
```

```
[daymoove@node1 ~]$ dig ynov.com
[...]
;; ANSWER SECTION:
ynov.com.               261     IN      A       104.26.11.233
ynov.com.               261     IN      A       172.67.74.226
ynov.com.               261     IN      A       104.26.10.233
[...]

;; SERVER: 1.1.1.1#53(1.1.1.1)

[...]
```

node2.tp1.b2

```
[daymoove@node2 ~]$ sudo vim /etc/resolv.conf
```

```
[daymoove@node2 ~]$ sudo cat /etc/resolv.conf
# Generated by NetworkManager
search tp1.b2
nameserver 1.1.1.1
```

```
[daymoove@node1 ~]$ dig ynov.com
[...]
;; ANSWER SECTION:
ynov.com.               261     IN      A       104.26.11.233
ynov.com.               261     IN      A       172.67.74.226
ynov.com.               261     IN      A       104.26.10.233
[...]

;; SERVER: 1.1.1.1#53(1.1.1.1)

[...]
```

**les machines doivent pouvoir se joindre par leurs noms respectifs**

node1.tp1.b2

```
sudo vim /etc/hosts

[daymoove@node1 ~]$ sudo cat /etc/hosts
[...]
10.101.1.12 node2.tp1.b2

[daymoove@node1 ~]$ ping node2.tp1.b2
PING node2.tp1.b2 (10.101.1.12) 56(84) bytes of data.
64 bytes from node2.tp1.b2 (10.101.1.12): icmp_seq=1 ttl=64 time=0.388 ms
64 bytes from node2.tp1.b2 (10.101.1.12): icmp_seq=2 ttl=64 time=0.369 ms
```


node2.tp1.b2

```
sudo vim /etc/hosts

[daymoove@node2 ~]$ sudo cat /etc/hosts
[...]
10.101.1.11 node1.tp1.b2

[daymoove@node2 ~]$ ping node1.tp1.b2
PING node1.tp1.b2 (10.101.1.11) 56(84) bytes of data.
64 bytes from node1.tp1.b2 (10.101.1.11): icmp_seq=1 ttl=64 time=0.301 ms
64 bytes from node1.tp1.b2 (10.101.1.11): icmp_seq=2 ttl=64 time=0.449 ms
```

**le pare-feu est configuré pour bloquer toutes les connexions exceptées celles qui sont nécessaires**


node1.tp1.b2
```
[daymoove@node1 ~]$ sudo firewall-cmd --list-all
public (active)
  target: default
  icmp-block-inversion: no
  interfaces: enp0s3 enp0s8
  sources:
  services: cockpit dhcpv6-client ssh
  ports:
  protocols:
  forward: yes
  masquerade: no
  forward-ports:
  source-ports:
  icmp-blocks:
  rich rules:
```

node2.tp1.b2

```
[daymoove@node2 ~]$ sudo firewall-cmd --list-all
[sudo] password for daymoove:
public (active)
  target: default
  icmp-block-inversion: no
  interfaces: enp0s3 enp0s8
  sources:
  services: cockpit dhcpv6-client ssh
  ports:
  protocols:
  forward: yes
  masquerade: no
  forward-ports:
  source-ports:
  icmp-blocks:
  rich rules:
```

## I. Utilisateurs

**1. Création et configuration**

**Ajouter un utilisateur à la machine**

node1.tp1.b2
```
[daymoove@node1 ~]$ sudo useradd node1_admin -m -s /bin/bash

[daymoove@node1 ~]$ cat /etc/passwd
node1_admin:x:1001:1001::/home/node1_admin:/bin/bash
```


node2.tp1.b2
```
[daymoove@node2 ~]$  sudo useradd node2_admin -m -s /bin/bash

[daymoove@node1 ~]$ cat /etc/passwd
node2_admin:x:1001:1001::/home/node2_admin:/bin/bash
```

**Créer un nouveau groupe admins**

node1.tp1.b2

```
[daymoove@node1 ~]$ sudo groupadd admins

[daymoove@node1 ~]$ sudo visudo /etc/sudoers


[daymoove@node1 ~]$ sudo cat /etc/sudoers
[...]
%admins  ALL=(ALL)       ALL
```

node2.tp1.b2

```
[daymoove@node2 ~]$ sudo groupadd admins

[daymoove@node2 ~]$ sudo visudo /etc/sudoers


[daymoove@node2 ~]$ sudo cat /etc/sudoers
[...]
%admins  ALL=(ALL)       ALL
```

**Ajouter votre utilisateur à ce groupe admins**

node1.tp1.b2

```
[daymoove@node1 ~]$ sudo usermod -aG admins node1_admin

[node1_admin@node1 daymoove]$ sudo ls

We trust you have received the usual lecture from the local System
Administrator. It usually boils down to these three things:

    #1) Respect the privacy of others.
    #2) Think before you type.
    #3) With great power comes great responsibility.

[sudo] password for node1_admin:
```

node2.tp1.b2

```
[daymoove@node2 ~]$ sudo usermod -aG admins node2_admin

[node2_admin@node2 daymoove]$ sudo ls

We trust you have received the usual lecture from the local System
Administrator. It usually boils down to these three things:

    #1) Respect the privacy of others.
    #2) Think before you type.
    #3) With great power comes great responsibility.

[sudo] password for node2_admin:
```

**2. SSH**

node1.tp1.b2

```
ssh-copy-id node1_admin@10.101.1.11

PS C:\Users\M.SELVA> ssh node1_admin@10.101.1.11
Last login: Mon Nov 14 12:49:04 2022 from 10.101.1.1
[node1_admin@node1 ~]$
```

node2.tp1.b2

```
ssh-copy-id node2_admin@10.101.1.12

PS C:\Users\M.SELVA> ssh node2_admin@10.101.1.12
Last login: Mon Nov 14 12:49:28 2022 from 10.101.1.1
[node2_admin@node2 ~]$
```

## II. Partitionnement

**2. Partitionnement**

**Utilisez LVM**

-agréger les deux disques en un seul volume group

```
[node1_admin@node1 ~]$ sudo vgcreate firstgroup /dev/sdb
  Volume group "firstgroup" successfully created
  
[node1_admin@node1 ~]$ sudo vgextend firstgroup /dev/sdc
  Volume group "firstgroup" successfully extended
  
  
[node1_admin@node1 ~]$ sudo vgs
  Devices file sys_wwid t10.ATA_____VBOX_HARDDISK___________________________VB56a55c4d-66484ead_ PVID Q2vcTwkzCH5aoeOfehfEaZXnnXNPgCAU last seen on /dev/sda2 not found.
  VG         #PV #LV #SN Attr   VSize VFree
  firstgroup   2   0   0 wz--n- 5.99g 5.99g
```

-créer 3 logical volumes de 1 Go chacun

```
[node1_admin@node1 ~]$ sudo lvcreate -L 1G firstgroup -n firstLV
  Logical volume "firstLV" created.
  
[node1_admin@node1 ~]$ sudo lvcreate -L 1G firstgroup -n secondLV
  Logical volume "secondLV" created.
 
[node1_admin@node1 ~]$ sudo lvcreate -L 1G firstgroup -n thirdLV
  Logical volume "thirdLV" created.
  
[node1_admin@node1 ~]$ sudo lvdisplay
  Devices file sys_wwid t10.ATA_____VBOX_HARDDISK___________________________VB56a55c4d-66484ead_ PVID Q2vcTwkzCH5aoeOfehfEaZXnnXNPgCAU last seen on /dev/sda2 not found.
  --- Logical volume ---
  LV Path                /dev/firstgroup/firstLV
[...]

  --- Logical volume ---
  LV Path                /dev/firstgroup/secondLV
[...]

  --- Logical volume ---
  LV Path                /dev/firstgroup/thirdLV
[...]

```

-formater ces partitions en ext4

```
[node1_admin@node1 ~]$ sudo mkfs -t ext4 /dev/firstgroup/firstLV
[...]
Writing superblocks and filesystem accounting information: done


[node1_admin@node1 ~]$ sudo mkfs -t ext4 /dev/firstgroup/secondLV
[...]
Writing superblocks and filesystem accounting information: done


[node1_admin@node1 ~]$ sudo mkfs -t ext4 /dev/firstgroup/thirdLV

[...]
Writing superblocks and filesystem accounting information: done

```

-monter ces partitions pour qu'elles soient accessibles aux points de montage /mnt/part1, /mnt/part2 et /mnt/part3

```
[node1_admin@node1 ~]$ sudo mount /dev/firstgroup/firstLV /mnt/part1

[node1_admin@node1 ~]$ sudo mount /dev/firstgroup/secondLV /mnt/part2

[node1_admin@node1 ~]$ sudo mount /dev/firstgroup/thirdLV /mnt/part3

[node1_admin@node1 ~]$ mount
[...]
/dev/mapper/firstgroup-firstLV on /mnt/part1 type ext4 (rw,relatime,seclabel)
/dev/mapper/firstgroup-secondLV on /mnt/part2 type ext4 (rw,relatime,seclabel)
/dev/mapper/firstgroup-thirdLV on /mnt/part3 type ext4 (rw,relatime,seclabel)
```


**Grâce au fichier /etc/fstab**

```
[node1_admin@node1 ~]$ sudo cat /etc/fstab

[...]

/dev/firstgroup/firstLV /mnt/part1 ext4 defaults 0 0
/dev/firstgroup/secondLV /mnt/part2 ext4 defaults 0 0
/dev/firstgroup/thirdLV /mnt/part3 ext4 defaults 0 0
```

## III. Gestion de services

**1. Interaction avec un service existant**

**Assurez-vous que...**

```
[node1_admin@node1 ~]$ sudo systemctl status firewalld
● firewalld.service - firewalld - dynamic firewall daemon
     Loaded: loaded (/usr/lib/systemd/system/firewalld.service; enabled; vendor preset: enabled)
     Active: active (running) since Mon 2022-11-14 14:44:42 
[...]
```

**2. Création de service**

**A. Unité simpliste**

**Créer un fichier qui définit une unité de service**

```
[node1_admin@node1 ~]$ sudo cat /etc/systemd/system/web.service
[Unit]
Description=Very simple web service

[Service]
ExecStart=/usr/bin/python3 -m http.server 8888

[Install]
WantedBy=multi-user.target

[node1_admin@node1 ~]$ sudo firewall-cmd --add-port=8888/tcp --permanent
success

[node1_admin@node1 ~]$ sudo systemctl status web
● web.service - Very simple web service
     Loaded: loaded (/etc/systemd/system/web.service; disabled; vendor preset: disabled)
     Active: active (running) since Mon 2022-11-14 15:29:58 [...]
```

**Une fois le service démarré, assurez-vous que pouvez accéder au serveur web**

```
[node2_admin@node2 ~]$ curl 10.101.1.11:8888
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
[...]
```

**B. Modification de l'unité**

**Préparez l'environnement pour exécuter le mini serveur web Python**

```
[node1_admin@node1 ~]$ sudo useradd web -m -s /bin/bash

[node1_admin@node1 ~]$ sudo ls /var/www/meow/
serv

[node1_admin@node1 ~]$ sudo ls -al /var/www/meow/
total 0
drwxr-xr-x. 2 root root 18 Nov 14 15:42 .
drwxr-xr-x. 3 root root 18 Nov 14 15:41 ..
-rw-r--r--. 1 web  root  0 Nov 14 15:42 serv
```

** Modifiez l'unité de service web.service créée précédemment en ajoutant les clauses**

```
[node1_admin@node1 ~]$ sudo cat /etc/systemd/system/web.service
[Unit]
Description=Very simple web service

[Service]
ExecStart=/usr/bin/python3 -m http.server 8888
User=web
WorkingDirectory=/var/www/meow/

[Install]
WantedBy=multi-user.target
```

**Vérifiez le bon fonctionnement avec une commande curl**

```
[node2_admin@node2 ~]$ curl 10.101.1.11:8888
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
[...]
</html>
```