#!/bin/bash

sudo apt-get update
sudo apt-get install -y iputils-ping
SERVERIP=$(ping -c1 server | grep -oE "server \\([^\)]+)" | head -1 | grep -oE "[0-9\.]{2,}")
echo "$SERVERIP magento-neo4j.local" | sudo tee -a /etc/hosts

/opt/bin/entry_point.sh
