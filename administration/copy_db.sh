#!/bin/bash

DBUSER=root
DBPASSWORD=testme
DBSNAME=$2
DBNAME=$1
DBSERVER=localhost

mysqldump --verbose --user=$DBUSER --password=$DBPASSWORD --databases $DBSNAME > dump_from_copy_$DBSNAME.sql

fCreateTable=""
fInsertData=""
echo "Copying database..."
DBCONN="-h ${DBSERVER} -u ${DBUSER} --password=${DBPASSWORD}"
echo "DROP DATABASE IF EXISTS ${DBNAME}" | mysql ${DBCONN}
echo "CREATE DATABASE ${DBNAME}" | mysql ${DBCONN}
for TABLE in `echo "SHOW TABLES" | mysql $DBCONN $DBSNAME | tail -n +2`; do
	echo $TABLE;
        createTable=`echo "SHOW CREATE TABLE ${TABLE}"|mysql -B -r $DBCONN $DBSNAME|tail -n +2|cut -f 2-`
        fCreateTable="${fCreateTable} ; ${createTable}"
        insertData="INSERT INTO ${DBNAME}.${TABLE} SELECT * FROM ${DBSNAME}.${TABLE}"
        fInsertData="${fInsertData} ; ${insertData}"
done;
echo "$fCreateTable ; $fInsertData" | mysql $DBCONN $DBNAME
echo "Copy complete!"
echo 
echo "Updating config..."
CURDIR=`pwd`
#cd ../
#tar cfz ../tmp.tgz *
tar cfz ../../tmp.tgz ../*
mkdir -p ../../$1
tar xfz ../../tmp.tgz -C ../../$1
rm -f ../../tmp.tgz
for i in `grep -rl $2 ../../$1/* | grep -v trash` ; do echo "Analyzing $i with $1 from $2." ; sed -i s/$2/$1/g $i ; done
echo "Update complete!"
grep -r $2 ../../$1 | grep -v trash

