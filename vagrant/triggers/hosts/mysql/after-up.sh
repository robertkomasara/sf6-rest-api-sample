#!/bin/bash

set -euo pipefail;

# { echo "bind-address = 0.0.0.0"; } >> "/etc/mysql/mariadb.conf.d/50-server.cnf"; service mariadb restart;

sudo mysql -u root -e 'DROP DATABASE IF EXISTS interview;';
sudo mysql -u root -e 'DROP USER IF EXISTS "interview-user"@"192.168.56.101";';
sudo mysql -u root -e "CREATE DATABASE interview;";
sudo mysql -u root -e 'CREATE USER "interview-user"@"192.168.56.101" IDENTIFIED BY "interview-password";';
sudo mysql -u root -e 'GRANT ALL PRIVILEGES ON interview.* TO "interview-user"@"192.168.56.101";';
sudo mysql -u root -e 'FLUSH PRIVILEGES; SHOW GRANTS FOR "interview-user"@"192.168.56.101";';