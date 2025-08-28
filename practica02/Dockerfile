FROM debian:stable-slim

#instalar dependecias
RUN apt update
RUN apt install php -y
RUN apt install apache2 -y

EXPOSE 80

CMD apache2ctl -D FOREGROUND
