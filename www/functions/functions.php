<?php 
defined('MVCproject') or die('Access denied');

//print array 
function print_arr($arr){
	echo "<pre>";
	print_r($arr);
	echo "</pre>";
}

// перенаправляем
function redirect($http = false){
	if($http) $redirect = $http;
	else $redirect = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : PATH;
    header("Location: $redirect");
    exit;
}

//cleaning of incoming data
function clear($var){
	$var = mysql_real_escape_string(strip_tags(trim($var)));
	return $var;
}





// exit user
function logout(){
	unset($_SESSION['auth']);
}

// pagination
function pagination($page=mull, $pages_count=mull){
	if( $_SERVER['QUERY_STRING'] ){ // если есть параметры в адресной строке
		foreach( $_GET as $key => $value ){
			// формируем строку параметров без номера страници
			if( $key != 'page' ) {
				$uri .= "{$key}={$value}&amp;";
			}
		}
		
	}

	// формирование сылок 
	$back =''; // сылка назад
	$forward = ''; // сылка вперед 
	$startpage = ''; // сылка в начало 
	$endpage = ''; // сылка в конец
	$page2left =''; // вторая страница слева 
	$page1left = ''; // первая страница слева
	$page2right = ''; // вторая страница справа
	$page1right = ''; // первая страница справа

	if( $page > 1 ){
		$back = "<a class='nav_link' href='?{$uri}page=".($page-1)."'>&lt;</a> ";
	}

	if( $page < $pages_count ){
		$forward = "<a class='nav_link' href='?{$uri}page=".($page+1)."'>&gt;</a> ";
	}

	if( $page > 3 ){
		$startpage = "<a class='nav_link' href='?{$uri}page=1'>&laquo;</a> ";
	}
	if( $page < ($pages_count - 2) ){
		$endpage = "<a class='nav_link' href='?{$uri}page={$pages_count}'>&raquo;</a> ";
	}
	if( $page - 2 > 0 ){
		$page2left = "<a class='nav_link' href='?{$uri}page=".($page-2)."'>".($page-2)."</a> ";
	}
	if( $page - 1 > 0 ){
		$page1left = "<a class='nav_link' href='?{$uri}page=".($page-1)."'>".($page-1)."</a> ";
	}
	if( $page + 2 <= $pages_count ){
		$page2right = "<a class='nav_link' href='?{$uri}page=".($page+2)."'>".($page+2)."</a> ";
	}
	if( $page + 1 <= $pages_count ){
		$page1right = "<a class='nav_link' href='?{$uri}page=".($page+1)."'>".($page+1)."</a> ";
	}

	// формируем вывод навмгации 
	echo '<div class"pagination">'.$startpage.$back.$page2left.$page1left.'<a class="nav_active">'.$page.'</a>'.$page1right.$page2right.$forward.$endpage.'</div>';


}