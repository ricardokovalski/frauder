#!/usr/bin/.env bash
source $(dirname "$0")/colors.sh
options=(`docker container ls --filter "label=php" --format "{{.Names}}"`)

echo -e $RED_COLOR"Composer Dump..."$RESET_COLOR
docker-compose -f ./docker-compose.yml exec php-fpm composer dump-autoload -o
