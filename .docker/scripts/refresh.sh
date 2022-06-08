#!/usr/bin/.env bash
source $(dirname "$0")/colors.sh

ASK=$RED_COLOR"Are You sure to remove and rebuild all containers? "$RESET_COLOR
PS3=$ASK

select opt in "Yes" "No"
do
    case $opt in
        Yes)
            echo 'Refreshing...'
	        docker-compose -f ./docker-compose.yaml down
	        echo -e "Rebuilding ..."
	        docker-compose -f ./docker-compose.yaml build
	        docker-compose -f ./docker-compose.yaml up -d
	        docker ps
	        break;;
        *)
            break;;
    esac
done
