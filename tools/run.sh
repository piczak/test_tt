#!/bin/sh

cd ../app/config/

file='parameters.yml'

db_host() {
    s='[[:space:]]*' w='[a-zA-Z0-9_]*' fs=$(echo $file)
    sed -ne "s|^\($s\)\($w\)$s:$s\(.*\)$s|\1$fs\2$fs\3|p"  $1 |
    
    awk -F$fs '{ 
        if ($2 == "database_host") {
            {print $3}
        }
    }'   
}
db_host $file

db_name() {
    s='[[:space:]]*' w='[a-zA-Z0-9_]*' fs=$(echo $file)
    
    sed -ne "s|^\($s\)\($w\)$s:$s\(.*\)$s|\1$fs\2$fs\3|p"  $1 |
    
    awk -F$fs '{ 
        if ($2 == "database_name") {
            {print $3}
        }
    }'
}
db_name $file

db_user() {
    s='[[:space:]]*' w='[a-zA-Z0-9_]*' fs=$(echo $file)
    
    sed -ne "s|^\($s\)\($w\)$s:$s\(.*\)$s|\1$fs\2$fs\3|p"  $1 |
    
    awk -F$fs '{ 
        if ($2 == "database_user") {
            {print $3}
        }
    }'
}
db_user $file

db_password() {
    s='[[:space:]]*' w='[a-zA-Z0-9_]*' fs=$(echo $file)
    
    sed -ne "s|^\($s\)\($w\)$s:$s\(.*\)$s|\1$fs\2$fs\3|p"  $1 |
    
    awk -F$fs '{ 
        if ($2 == "database_password") {
            if ( $3 == "null") {
                {print $3}
            } else {
                {print $3}
            }
        }
    }'
}

host=$(db_host $file)
name=$(db_name $file)
user=$(db_user $file)
password=$(db_password $file)

if [ "$password"=="null" ]
then
    password=''
fi

cd ../../

app/console doctrine:database:drop --force

app/console doctrine:database:create

app/console doctrine:schema:update --force

cd tools

#pwd

#echo $host, $name, $user, $password

mysql --host=$host --user=$user --password=$test $name < TCO.sql






