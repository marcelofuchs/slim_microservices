#!/bin/sh

composer(){
    docker exec --user 1000  -it php_fpm bash -c "$1 $2 $3 $4 $5 $6 $7 $8 $9;"
}

artisan(){
    docker exec --user 1000 -it php_fpm bash -c "php $1 $2 $3 $4 $5 $6 $7 $8 $9;"
}

npm (){
    docker exec -it node_rtn sh -c "$1 $2 $3 $4 $5 $6 $7 $8 $9"
}

doctrine (){
    echo "php ./bin/$1 $2 $3 $4 $5 $6 $7 $8 $9;"
    docker exec --user 1000  -it php_fpm bash -c "php ./bin/$1 $2 $3 $4 $5 $6 $7 $8 $9;"
}

install(){
    echo ""
    echo "================================================================="
    echo "==================== BUILDING DOCKERS ==========================="
    # docker-compose -f docker-compose.yml build
    docker-compose -f docker-compose.yml up -d

    echo ""
    echo "================================================================="
    echo "=================== INSTALLING COMPOSER ========================="
    docker exec --user 1000 -it php_fpm bash -c "composer install;"
    docker exec --user 1000 -it php_fpm bash -c "composer dump-autoload;"

    # echo ""
    # echo "================================================================="
    # echo "============== INSTALLING NODE DEPENDENCIES ====================="
    # docker exec -it node_rtn sh -c "npm install && npm audit fix && npm run dev"

    # echo ""    
    # echo "================================================================="
    # echo "================== LARAVEL DEPENDENCIES ========================="
    # docker exec --user 1000 -it php_fpm bash -c "php artisan key:generate && artisan cache:clear;"

    # echo ""
    # echo "================================================================="
    # echo "================== DATABASE MIGRATIONS =========================="
    # docker exec --user 1000 -it php_fpm bash -c "php artisan migrate;"

    # echo ""
    # echo "================================================================="
    # echo "===================== DATABASE SEED ============================="
    # docker exec --user 1000 -it php_fpm bash -c "php artisan db:seed;"
    # docker exec -it php_fpm bash -c "php artisan doctrine:generate:proxies;"

    # echo "========================== END =================================="
}

build(){
    docker-compose -f docker-compose.yml $@
}

up(){
    docker-compose -f docker-compose.yml $@
}

down(){
    docker-compose -f docker-compose.yml $@
}

case $1 in
	artisan)
		echo "Artisan..."
		artisan $@
		;;
	composer)
		echo "Composer..."
		composer $@
		;;
	doctrine)
		echo "Doctrine..."
		doctrine $@
		;;
	# npm)
	# 	echo "Npm ...."
	# 	npm $@
	# 	;;
	install)
		echo "Installing..."
		install $@
		;;
	build)
		echo "Building..."
		build $@
		break
		;;
	up)
		echo "Starting..."
		up $@
		break
		;;
	down)
		echo "Stopping..."
		build $@
		break
		;;
	*)
		docker-compose -f docker-compose.yml $@
		;;
esac