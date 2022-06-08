help: 	 		## Show this help.
	@fgrep -h "##" $(MAKEFILE_LIST) | fgrep -v fgrep | sed -e 's/\\$$//' | sed -e 's/##//'

build: 		 	## Build all docker containers.
	@docker-compose -f docker-compose.yml build --no-cache

up: 	 		## Up all docker containers.
	@docker-compose -f ./docker-compose.yml up -d

down: 	 		## Down all docker containers.
	@docker-compose -f ./docker-compose.yml down

refresh:  		## Put down, rebuild and up all docker containers.
	@bash ./.docker/scripts/refresh.sh

in: 	        	## Show user a list of avaliable docker containers to go inside like root.
	@bash ./.docker/scripts/in-root.sh

logs:			## Show logs of all containers.
	@bash ./.docker/scripts/docker-log.sh

docker-clean:		## Remove all Containers, Images, Networks and Volumes.
	@bash ./.docker/scripts/docker-clean.sh

composer-install:	## Install composer in php container.
	@bash ./.docker/scripts/composer-install.sh

composer-dump:		## Run composer dump in php container.
	@bash ./.docker/scripts/composer-dump.sh

first-install:    	## Execute the first start of the project.
	echo "First Install"
	make build
	make up
	make composer-install
	make composer-dump
