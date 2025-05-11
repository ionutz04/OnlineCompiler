#!/bin/bash

file=$1;
ses=$2;
echo $file;
cd /home/ionutz/apache/build/python;
#command = "g++ -o /app/$file.out /app/$file && /app/$file.out >> /home/ionutz/apache/app/upload/.rez/$ses.out"
#sudo echo "" > /home/ionutz/apache/app/upload/.rez/$ses.out;
docker run -v /home/ionutz/apache/app/upload:/app ccontainer:latest /app/subprocess.sh $file $ses;
#sudo rm -f /home/ionutz/apache/app/upload/.rez/$ses.out;
#docker run -v /home/ionutz/apache/app/upload:/app ccontainer:latest /app/$file.out >> /home/ionutz/apache/app/upload/.rez/$ses.out;
sudo rm -f /home/ionutz/apache/app/upload/.queue/$ses;

