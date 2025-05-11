#!/bin/bash

file=$1;
ses=$2;
echo $file;
cd /home/ionutz/apache/build/python;
#docker run -it $(docker build -q) -v /home/ionutz/apache/app/upload:/app python ./app/$file;
#docker run --rm -v /home/ionutz/apache/app/upload:/app ccontainer:latest gcc -o /app/$file.out /app/$file;
docker run --rm -v /home/ionutz/apache/app/upload:/app ccontainer:latest /app/subprocessc.sh $file $ses;
#sudo rm -f /home/ionutz/apache/app/upload/.rez/$ses.out;
#docker run --rm -v /home/ionutz/apache/app/upload:/app ccontainer:latest /app/$file.out >> /home/ionutz/apache/app/upload/.rez/$ses.out;
sudo rm -f /home/ionutz/apache/app/upload/.queue/$ses;



