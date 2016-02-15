<?php

defined('MVCproject') or die('Access denied');

// домен
define('PATH', 'http://mvc-project.loc/');

// модель
define('MODEL', 'model/model.php');

// контроллер
define('CONTROLLER', 'controller/controller.php');

// views
define('VIEW', 'views/');

// активный шаблон
define('TEMPLATE', VIEW.'project/');

// folder images product
define('PRODUCTIMG', PATH.'userfiles');

// сервер БД
define('HOST', 'localhost');

// пользователь
define('USER', 'root');

// пароль
define('PASS', '');

// БД
define('DB', 'mvc_project');

// название магазина - title
define('TITLE', 'MVCproject');

// email administration
define('ADMIN_EMAIL', 'admin@project.ua');

// administration folder template
define('ADMIN_TEMPLATE', 'templates/');

/* Конфигурация базы данных */
@mysql_connect(HOST, USER, PASS) or die('No connect to Server');
mysql_select_db(DB) or die('No connect to DB');
mysql_query("SET NAMES 'UTF8'") or die('Cant set charset');