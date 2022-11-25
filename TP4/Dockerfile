FROM debian

RUN apt update -y

RUN apt install apache2 -y

RUN rm /var/www/html/index.html

RUN echo "bonjour" > /var/www/html/index.html

RUN mkdir /etc/apache2/logs

COPY apache2.conf /etc/apache2

EXPOSE 80

CMD ["apache2ctl", "-D", "FOREGROUND"]
