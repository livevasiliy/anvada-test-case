# Anvada Test-case

### Решенное тестовое задание от компании "ООО Анвада".

Для запуска этого проекта склонируйте себе проект используя у себя в командной строке/терминале
```bash
git clone https://github.com/livevasiliy/anvada-test-case.git
```

После того как проект будет успешно склонирован, перейдите в папку, где лежит копия этого проекта, для этого напишите 
в командной строке/терминале 
```bash
cd ./anvanda-test-case
```
Далее запустите команду для установки всех php-зависимостей указанных в composer.json 

#### У вас должен быть установлен на компьютере composer и версия PHP не ниже 7.2
```bash
composer install
```

Скопируйте себе файл .env.example для этого напишите команду:

Если Windows:
```bash
copy .env.example .env
```

На Linux/macOS:
```bash
cp .env.example .env
```

Далее укажите в .env параметры для подключения к вашей базе данных для этого заполните параметры в файле:

```
DB_DATABASE=anvada-test-case // Название созданной вами базы данных
DB_USERNAME=root // Имя пользователя базы данных
DB_PASSWORD= // Пароль используемого для пользователя
```


После успешной установки всех зависимостей composer, запустите миграцию в указанную базу данных и локальный сервер предоставляемый Laravel, 
для этого запустите команду:
```bash
php artisan migrate
php artisan serve
``` 
```
После успешного запуска проект будет доступен по адресу: http://127.0.0.1:8000
```

### API
Список доступных маршрутов:
- POST /api/v1/document/ - создаем черновик документа
- GET /api/v1/document/{id} - получить документ по id
- PATCH /api/v1/document/{id} - редактировать документ
- POST /api/v1/document/{id}/publish - опубликовать документ
- GET /api/v1/document/?page=1&perPage=20 - получить список документов с
пагинацией, сортировка в последние созданные сверху. 

### Демо

Демо работа проекта доступна по адресу:
https://evening-depths-35612.herokuapp.com 

Далее все выше описанные доступные запросы.
