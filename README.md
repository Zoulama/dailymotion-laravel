# Dailymotion python service

The Dailymotion user service is a python 3 project that handles user Registration in a Mongo DB 

## requirements  php7.4 or php8 because all my variables are typed
```
brew install php@7.4
```

## Clone  project
```
git clone https://github.com/Zoulama/dailymotion-python.py.git
```

## Create .env file
```
cp .env.example .env
```

## Run composer
```
make build
```
## Run dailymotion-laravel locally
```
make up
```

## Go to mailtrip.io , create an account and setup conf values on docker-compose.yml

|                Name | Description     |
|-------------------- |-----------------|
| MAIL_SERVER         | smtp.mailtrap.io|
| MAIL_PORT           | 587             |
| MAIL_USERNAME       | username        |
| MAIL_PASSWORD       | password        |

## set  mailtrip conf  values  in .env file
```
MAIL_DRIVER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=587
MAIL_USERNAME=xxxxxxxx
MAIL_PASSWORD=xxxxxxx
MAIL_FROM_ADDRESS=contact@daily.com
```

[Head to]( http://localhost:9099/documentation/api/rest/swagger/)


## got to http://localhost:9099/documentation/api/rest/swagger/


## down container
```
make down
```
