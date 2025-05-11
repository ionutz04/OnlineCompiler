Student: Ionescu Ionuț
Facultate: Facultatea de Cibernetică, Statistică și Informatică Economică
Grupa și Seria: 1020E

>[!info] ***Introducere***:
>"Online Compiler"-ul este o aplicație distribuită web care este capabilă de compilarea și rularea scripturilor scrise în diverse limbaje de programare cum ar fi: C, C++, JAVA și PYTHON, folosind o arhitectură complexă de containere Docker, utilizând pentru fiecare limbaj de programare câte un container, în afară de limbajele C și C++ care vor fi compilate și rulate pe un singur container de alpine:latest.

>[!tip] Arhitectura aplicației
>Această aplicație se bazează pe legătura dintre mai multe containere: containerul de apache2 și php-fpm, și cel de MySQL (pentru login, logout, sign up), dar și dintre, de exemplu, containerul de apache2 și php-fpm și cel de python(figura 1).![[Drawing 2024-04-01 10.50.52.excalidraw]] 
>Pentru a rula un cod, (conform schemei de mai sus) utilizatorul trebuie să se logheze folosind pagina login.php ![[Drawing 2024-04-01 11.18.39.excalidraw]] cu contul și parola creată pe pagina signup.php. ![[Drawing 2024-04-01 11.19.34.excalidraw]] După ce s-a creat contul, în baza de date vor apărea utilizatorul, parola, dar și permisiunile pe care le are, pentru că, bazat pe ce abonament deține utilizatorul, permisiunile pot fi:
>- 63: pentru toate permisiunile (111111 în binar)
>- 62: pentru toate permisiunile în afară de compilarea programelor în Python (111110 în binar)
>- și așa mai departe.
>Rularea programelor se face cu ajutorul containerelor Docker rulate pe server NU permanent. Pe serverul gazdă, pe Debian-ul 12, se află 5 script-uri de bash (o să atașez doar `old_compiler.sh` și `container_c.sh`):
>>[!note] Script-uri:
>>old_compiler.sh
>>---
>>```
>>#!/bin/bash
>>list=$(ls -1 /home/ionutz/apache/app/upload/.queue/);
>>if [ -z "$list" ]
>>then
>>    echo "Nothing to compile!";
>>else     echo $list;
>>        for i in $list; do
>>                file=$(cat /home/ionutz/apache/app/upload/.queue/$i);
>>                cd /home/ionutz/apache/build/python;
>>                ext="${file##*.}";
>>                ses=$i;
>>                echo $(date)" we identified the session "$ses" that needs "$file" to be compiled";
>>                case "$ext" in
>>                    c)
>>                        /home/ionutz/compiler_c.sh "$file" "$ses"
>>                        ;;
>>                    cpp)
>>                        /home/ionutz/compiler_cpp.sh "$file" "$ses"
>>                        ;;
>>                    py)
>>                        /home/ionutz/compiler_python.sh "$file" "$ses"
>>                        ;;
>>                    java)
>>                        /home/ionutz/compiler_java.sh "$file" "$ses"
>>                        ;;
>>                    *)
>>                        echo "Unsupported file type: $ext"
>>                        exit 1
>>                        ;;
>>                esac
>>
>>        done;
>>
>>fi
>>```
>>container_c.sh
>>---
>>```
>>#!/bin/bash
>>file=$1;
>>ses=$2;
>>echo $file;
>>cd /home/ionutz/apache/build/python;
>>#docker run -it $(docker build -q) -v /home/ionutz/apache/app/upload:/app python >./app/$file;
>>docker run --rm -v /home/ionutz/apache/app/upload:/app ccontainer:latest gcc -o /app/$file.out /app/$file;
>>sudo rm -f /home/ionutz/apache/app/upload/.rez/$ses.out;
>>docker run --rm -v /home/ionutz/apache/app/upload:/app ccontainer:latest /app/$file.out >> >/home/ionutz/apache/app/upload/.rez/$ses.out;
>>sudo rm -f /home/ionutz/apache/app/upload/.queue/$ses;
>>```
>![[Drawing 2024-04-01 11.50.13.excalidraw]]
