# Specification
```
Спарсить (программно) первые 15 новостей с rbk.ru (блок, откуда брать новости показан на скриншоте) и вставить в базу 
данных (составить структуру самому) или в файл. Вывести все новости, сократив текст до 200 символов в качестве описания, 
со ссылкой на полную новость с кнопкой подробнее. На полной новости выводить картинку если есть в новости.
```

# Deploy
## Steps on host:
### 0. Create any dir, and make deploy steps inside of it:
### 1. git clone https://github.com/gettads/parser-structure.git
### 2. rm -rf ./www/app
### 3. git clone https://github.com/gettads/parser-core.git ./www/app
### 4. docker-compose up -d --build
### 5. docker exec -it php bash 
## Steps inside of docker's contrainer (php-fpm):
### 6. cd /var/www/app
### 7. composer update
### 8. php bin/console doctrine:migrations:migrate
