#!/bin/bash

set -euo pipefail

# Env
export DEBIAN_FRONTEND=noninteractive
locale-gen pl_PL pl_PL.UTF-8 en_US en_US.UTF-8 && dpkg-reconfigure locales
# Sys
apt-get update
apt-get -y install net-tools acl iptables-persistent
apt-get -y install software-properties-common
# PHP 
apt-get update && add-apt-repository ppa:ondrej/php
apt-get -y install php8.1 php8.1-cli php8.1-pdo php8.1-mysql php8.1-xml php8.1-soap 
apt-get -y install php8.1-gd php8.1-mbstring php8.1-zip php8.1-intl php8.1-mcrypt php8.1-amqp
apt-get -y install php8.1-curl php8.1-redis php8.1-gnupg php8.1-xdebug php8.1-xmlrpc php8.1-bcmath