# TP 5

## Install Black Candy


```
sudo dnf config-manager --add-repo https://download.docker.com/linux/centos/docker-ce.repo

sudo dnf install docker-ce docker-ce-cli containerd.io -y

sudo dnf config-manager --add-repo https://download.docker.com/linux/centos/docker-ce.repo

sudo dnf install docker-compose-plugin
```


```
curl https://raw.githubusercontent.com/blackcandy-org/black_candy/v2.1.1/docker-compose.yml > docker-compose.yml

sudo systemctl start docker

sudo systemctl enable docker

docker compose up -d

sudo firewall-cmd --add-port=80/tcp --permanent
```

## Install Netdata

```
sudo dnf install wget

wget -O /tmp/netdata-kickstart.sh https://my-netdata.io/kickstart.sh && sh /tmp/netdata-kickstart.sh


sudo systemctl enable netdata


sudo systemctl status netdata

sudo firewall-cmd --add-port=19999/tcp --permanent

```

[cpu_usage.conf](./cpu_usage.conf)

[health_alarm_notify.conf](./health_alarm_notify.conf)

