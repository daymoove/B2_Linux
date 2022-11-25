# TP4 : Conteneurs

## I. Docker

### 1. Install

**Installer Docker sur la machine**

```
[daymoove@docker1 ~]$ sudo dnf config-manager --add-repo https://download.docker.com/linux/centos/docker-ce.repo

Adding repo from: https://download.docker.com/linux/centos/docker-ce.repo


[daymoove@docker1 ~]$ sudo dnf install docker-ce docker-ce-cli containerd.io

Complete!


[daymoove@docker1 ~]$ sudo systemctl status docker
● docker.service - Docker Application Container Engine
     Loaded: loaded (/usr/lib/systemd/system/docker.service; disabled; vendor preset: disabled)
     Active: active (running) since Thu 2022-11-24 11:09:21 CET; 5s ago


[daymoove@docker1 ~]$ sudo usermod -aG docker daymoove
```

### 3. Lancement de conteneurs

**Utiliser la commande docker run**

```
[daymoove@docker1 ~]$ docker run --name web -d -v /home/daymoove/index.html:/usr/share/nginx/html -v /home/daymoove/moutarde.conf:/etc/nginx/conf.d -p 8888:80 nginx -m 6m --cpus=0.5


[daymoove@docker1 ~]$ docker ps -a
CONTAINER ID   IMAGE     COMMAND                  CREATED          STATUS                        PORTS                                   NAMES
9c477c719e3b   nginx     "/docker-entrypoint.…"   20 seconds ago   Created                       0.0.0.0:8888->80/tcp, :::8888->80/tcp   web
```

[Dockerfile](./Dockerfile)

## II. Images

### 2. Construisez votre propre Dockerfile

**Construire votre propre image**

```
[daymoove@docker1 ~]$ docker build . -t myappache
[...]
Successfully built 6bfe46095777
Successfully tagged myappache:latest

[daymoove@docker1 ~]$ docker run -d -p 80:80 myappache
46a8a51f107e15eeb59f2f184c9a989cfc0b6889c1f7a05ec23c823bde4b199a

[daymoove@docker1 ~]$ curl localhost:80
bonjour
```

## III. docker-compose

### 2. Make your own meow

```
[daymoove@docker1 ~]$ cd app

[daymoove@docker1 ~]$ git clone https://github.com/AFERREIRA33/Scanner_reseau.git

[daymoove@docker1 ~]$ docker build . -t scannerres

[daymoove@docker1 ~]$ docker compose up
```

[app/Dockerfile](./app/Dockerfile)

[app/docker-compose.yml](./app/docker-compose.yml)