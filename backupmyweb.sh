#!/bin/bash

date

DATE=`date +%Y%m%d`
TARGET=${DATE}.tar.gz
rm -rf 2016*
mkdir $DATE

mysqldump -uroot -pkix2204 symfony > ${DATE}/symfony.sql
cp /usr/local/etc/nginx/nginx.conf ${DATE}
cp -r ~/mywebsite/web/uploads/ ${DATE}
tar zcvf $TARGET ${DATE}

bypy upload $TARGET $TARGET

exit 0
