#!/bin/sh
file=$1;
ses=$2;
javac $file;
class=$(cat /app/$file | grep "class" | awk '{print $3}' | cut -d '{' -f1 | head -1)
echo $class;
echo "" > /app/.rez/$ses.out;
java $class > /app/.rez/$ses.out;
