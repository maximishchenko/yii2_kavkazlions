# РОО ДЮСШЕ Львы Кавказа

## Установка

1. Клонировать репозиторий

```shell
git clone git@github.com:maximishchenko/yii2_kavkazlions.git
```

2. Установить зависимости `composer`
```shell
composer install
```

3. Произвести инициализацию окружения

```shell
php init --env=Development --overwrite=All
```

> [!INFO]
> Добавить параметры подключения к БД MySQL в файл `common\config\main-local.php`

4. Запустить применение миграций БД

```shell
php yii migrate
```

## Подготовка окружения разработки (OSPanel 6)

### Добавление проекта в OSPanel

Необходимо создать файл `.osp/project.ini` в корне каталога проекта со следующим содержанием:

```
[kavkazlions.local]

http_engine = Apache
node_engine = 
php_engine  = PHP-8.4
```

> В примере используется web-сервер Apache и PHP версии 8.4


При заполнении параметров подключения к БД в файле `common\config\main-local.php` необходимо указывать адрес хоста MySQL

> [!INFO]
> 
> В примере используются следующие параметры:
> 1. Имя хоста для подключения БД: `mysql-8.4.local`
> 2. Имя БД: `kavkazlions`
> 3. Имя пользователя БД: `root`
> 4. Пароль пользователя БД: `password`

```php
<?php

return [
    'components' => [
        'db' => [
            'class' => \yii\db\Connection::class,
            'dsn' => 'mysql:host=mysql-8.4.local;dbname=kavkazlions',
            'username' => 'root',
            'password' => 'password',
            'charset' => 'utf8',
        ],
        ...
    ],
];
```

### Запуск тестов

```shell
vendor/bin/codecept run --env php-builtin
```