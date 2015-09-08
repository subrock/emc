#!/bin/sh

echo "initializing database..."
echo 
pwd
mysql -u root -ptestme < administration/dump_from_copy_DeployServers.sql
echo "complete."

