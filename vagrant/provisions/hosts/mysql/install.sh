#!/bin/bash

set -euo pipefail;

# Env
export DEBIAN_FRONTEND=noninteractive;
locale-gen pl_PL pl_PL.UTF-8 en_US en_US.UTF-8 && dpkg-reconfigure locales;
# Apt
apt-get update; 
apt-get -y install net-tools mariadb-server-10.6;