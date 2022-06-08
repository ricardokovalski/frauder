#!/usr/bin/.env bash
source $(dirname "$0")/colors.sh

echo -e $RED_COLOR"Runing Prune..."$RESET_COLOR
docker system prune -a -f

echo -e $RED_COLOR"Removing volumes..."$RESET_COLOR
docker volume rm -f $(docker volume ls -q)
