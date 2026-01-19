FROM nixos/nix:latest AS builder

RUN nix-shell -p php82 php82Extensions.pdo php82Extensions.pdo_mysql --run "php -v"

FROM php:8.2-cli

RUN docker-php-ext-install pdo pdo_mysql

WORKDIR /app

COPY . .

EXPOSE 8080

CMD ["php", "-S", "0.0.0.0:8080"]
