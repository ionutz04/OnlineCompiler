#!/bin/sh
file=$1;
ses=$2;
g++ -o /app/$file.out /app/$file;
sudo echo "" > /app/.rez/$ses.out;
/app/$file.out >> /app/.rez/$ses.out;
