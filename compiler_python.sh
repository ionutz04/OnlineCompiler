#!/bin/bash

file=$1;
ses=$2;
echo $file;
cd /home/ionutz/apache/build/python;
#docker run -it $(docker build -q) -v /home/ionutz/apache/app/upload:/app python ./app/$file; 
sudo rm -f /home/ionutz/apache/app/upload/.rez/$ses.out;
docker run --rm -v /home/ionutz/apache/app/upload:/app pythoncontainer:latest python /app/$file >> /home/ionutz/apache/app/upload/.rez/$ses.out; 
sudo rm -f /home/ionutz/apache/app/upload/.queue/$ses;


