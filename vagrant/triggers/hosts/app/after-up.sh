#!/bin/bash

set -euo pipefail;

[ ! -f /usr/local/bin/composer ] && 
{
    wget https://getcomposer.org/download/latest-2.2.x/composer.phar;
    sudo mv composer.phar /usr/local/bin/composer;
    sudo chown -v vagrant:vagrant /usr/local/bin/composer;
    sudo chmod +x /usr/local/bin/composer;
}

cd src/ && /usr/local/bin/composer install --working-dir .;

nohup php -S 0.0.0.0:8080 -t src/public > ../httpd.log 2>&1 &

# php src/bin/console doctrine:migrations:migrate
# php src/bin/console api:fixtures
