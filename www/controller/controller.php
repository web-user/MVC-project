<?php
defined('MVCproject') or die('Access denied');
session_start();
// $_SESSION = array();
// unset($_SESSION); // или $_SESSION = array() для очистки всех данных сессии

// include model 
require_once MODEL;

// connection library functions
require_once 'functions/functions.php';




// feedback
if( $_POST['feedback'] ){
	feedback();
	exit;
}

// registration
if( $_POST['reg'] ){
	registration();
	exit;
}

// authorization
if($_POST['auth']){
    authorization();
    if($_SESSION['auth']['user']){
        // если пользователь авторизовался
        echo "<p>Добро пожаловать, {$_SESSION['auth']['user']}</p>";
        exit;
    }else{
        // если авторизация неудачна
        echo $_SESSION['auth']['error'];
        unset($_SESSION['auth']);
        exit;
    }
}

// exit user
if( $_GET['do'] == 'logout' ){
	logout();
	redirect();
}

// obtain a dynamic part of the pattern
$view = empty($_GET['view']) ? 'reg' : $_GET['view'];

switch ($view) {
	case('hits'):
		//лидеры продаж
		$eyestoppers = eyestopper('hits');
	break;

	case ('page'):
		// отдельная страница
		$page_id =  abs((int)$_GET['page_id']);
		$get_page = get_page($page_id);

	break;


	case ('archive'):
		// архив новостей

		// options navigation
		$perpage = 2; // кол-во товаров на страницу
		if( isset($_GET['page']) ){
			$page = (int)$_GET['page'];
			if( $page < 1 ) $page = 1;
		}else{
			$page = 1;
		}
		$count_rows = count_news(); // общее кол-во новостей
		$pages_count = ceil($count_rows / $perpage);//  кол-во страниц
		if( !$pages_count ) $pages_count = 1; // минимум 1 страница
		if( $page > $pages_count ) $page  = $pages_count; // если запрошеная страница больше максимума
		$start_pos = ($page - 1) * $perpage; // начальная позиция для запроса

		$all_news = get_all_news($start_pos,$perpage);

	break;

	case('reg'):
		// registration
	break;
	case('weather'):
		// weather
	break;
	case('feedback'):
		// feedback
	break;


	default:
		$view = 'hits';
		$eyestoppers = eyestopper('hits');
	break;
}


// // include views
require_once TEMPLATE.'index.php';