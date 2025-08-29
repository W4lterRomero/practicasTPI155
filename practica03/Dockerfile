from debian:stable-slim

#instalar dependecias
run apt update
run apt upgrade
run apt install nginx -y
run apt install php-fpm -y

expose 80

cmd service php8.4-fpm start && nginx -g "daemon off;"