#!/bin/bash

file=$1;
ses=$2;
echo $file;
#docker run -it $(docker build -q) -v /home/ionutz/apache/app/upload:/app python ./app/$file; 
#docker run --rm -v /home/ionutz/apache/app/upload:/app javacontainer:latest javac $file;
#class=$(cat /home/ionutz/apache/app/upload/$file | head -1 | cut -d " " -f3 | cut -d '{' -f1);
#class=$(cat /home/ionutz/apache/app/upload/$file | grep "class" | awk '{print $3}' | cut -d '{' -f1 | head -1)
#echo $class 
#echo "#!/bin/sh" > /home/ionutz/apache/app/upload/temp.sh
#echo "javac "$file >> /home/ionutz/apache/app/upload/temp.sh
#echo "java "$class >> /home/ionutz/apache/app/upload/temp.sh
#sudo chgrp docker /home/ionutz/apache/app/upload/temp.sh
#sudo chmod +x /home/ionutz/apache/app/upload/temp.sh
docker run --rm -v /home/ionutz/apache/app/upload:/app javacontainer:latest /app/subprocessjava.sh $file $ses;
sudo rm -f /home/ionutz/apache/app/upload/.queue/$ses;



