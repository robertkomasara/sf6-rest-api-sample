#!/bin/bash
z
set -euo pipefail;

src/composer.phar install --working-dir ./src;

nohup php -S 0.0.0.0:8080 -t src/public > httpd.log 2>&1 &

# php src/bin/console doctrine:migrations:migrate
# php src/bin/console api:fixtures
