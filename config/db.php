<?php
//настраиваем подключение к БД
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=127.0.0.1;dbname=dbnews',
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8',
];
