<?php
defined('MVCproject') or die('Access denied');
// model

/*Archive News*/
function get_all_news($start_pos,$perpage){
	$query = "SELECT `id`, `name`, `anons`, `date` FROM feedback ORDER BY id DESC LIMIT $start_pos, $perpage";
	$res = mysql_query($query);

	$all_news = array();

	while($row = mysql_fetch_assoc($res)){
		$all_news[] = $row;
	}
	return $all_news;
}

/*quantity News*/
function count_news(){
	$query = "SELECT COUNT(id) FROM feedback";
	$res = mysql_query($query);

	$count_news = mysql_fetch_row($res);

	return $count_news[0];
}

function feedback(){
		$kapcha = $_POST['kapcha'];
		$namefeedback = clear($_POST['namefeedback']);
		$emailfeedback = clear($_POST['emailfeedback']);
		$text = clear($_POST['text']);

		if( empty($namefeedback) ) {
			$error .="<li>Enter Name</li>";
		}
		if( empty($emailfeedback) ) {
			$error .="<li>Enter Email</li>";
		}

		if($_POST['kapcha'] != $_SESSION['rand_code']) {
			$error .="<li>Не правельно введен проверочный код !</li>";
		}else{
			echo "OK";
		}
		if( !empty($error) ){
			echo "<div class='error'>Не заполнены обязательные поля:<br> <ul>$error</ul></div> ";
		}
}

// regestration
function registration(){
	// проверка полей на заполнения
	$error = '';

	$login = clear($_POST['login']);
	$pass = trim($_POST['pass']);
	$name = clear($_POST['name']);
	$email = clear($_POST['email']);
	$datetime = clear($_POST['datetime']);
	$address = clear($_POST['address']);
	$gender = clear($_POST['gender']);
	$surname = clear($_POST['surname']);




	if( empty($login) ) {
		$error .="<li>Enter login</li>";
	}
	if( empty($pass) ) {
		$error .="<li>Enter password</li>";
	}
	if( empty($name) ) {
		$error .="<li>Enter Name</li>";
	}
	if( empty($email) ) {
		$error .="<li>Enter email</li>";
	}
	if( empty($surname) ) {
		$error .="<li>Enter surname</li>";
	}
	if( !empty($error) ){
		echo "<div class='error'>Не заполнены обязательные поля:<br> <ul>$error</ul></div> ";
	}




	if( empty($error) ){
		// если поля заполнены 
		// проверкак сушествования логин 
		$query = "SELECT customer_id FROM customers WHERE login = '$login' LIMIT 1";
		$res = mysql_query($query) or die(mysql_error());
		if( $row = mysql_num_rows($res) ){
			// если такой логин уже есть
			$_SESSION['reg']['res'] = "<div class='error'>Пользователь с таким логином уже есть. Введите другой логин</div>";
			$_SESSION['reg']['name'] = $name;
			$_SESSION['reg']['email'] = $email;
			$_SESSION['reg']['datetime'] = $datetime;
			$_SESSION['reg']['surname'] = $surname;
			echo "<div class='error'>Пользователь с таким логином уже есть. Введите другой логин</div>";


		}else{
			// если проверка пройдена регестрируем
			$pass = md5($pass);
			$query = "INSERT INTO customers (name, surname, email, gender, date, login, password)
				VALUES ('$name', '$surname', '$email', '$gender', '$datetime', '$login', '$pass')";
			$res = mysql_query($query) or die(mysql_error());
			if( mysql_affected_rows() > 0 ){
				//если запись добавлена
				$_SESSION['reg']['res'] = "<div class='success'>Регистрация прошла успешно.</div>";
				$_SESSION['auth']['user'] = $name;
				$_SESSION['auth']['customer_id'] = mysql_insert_id();
				$_SESSION['auth']['email'] = $email;
				echo "<div class='success'>Регистрация прошла успешно.</div>";
			}else{
				//есди поля не заполнены
				$_SESSION['reg']['res'] = "<div class='error'>Error!</div> ";
				$_SESSION['reg']['login'] = $login;
				$_SESSION['reg']['name'] = $name;
				$_SESSION['reg']['email'] = $email;
				$_SESSION['reg']['datetime'] = $phone;
				$_SESSION['reg']['surname'] = $surname;
			}
		}

	}else{
		//есди поля не заполнены
		$_SESSION['reg']['res'] = "<div class='error'>Не заполнены обязательные поля:<br> <ul>$error</ul></div> ";
		$_SESSION['reg']['login'] = $login;
		$_SESSION['reg']['name'] = $name;
		$_SESSION['reg']['email'] = $email;
		$_SESSION['reg']['datetime'] = $phone;
		$_SESSION['reg']['surname'] = $surname;
	}

}

//authorization
function authorization(){
    $login = mysql_real_escape_string(trim($_POST['loginauth']));
    $pass = trim($_POST['passauth']);
    
    if(empty($login) OR empty($pass)){
        // если пусты поля логин/пароль
        $_SESSION['auth']['error'] = "Поля логин/пароль должны быть заполнены!";
    }else{
        // если получены данные из полей логин/пароль
        $pass = md5($pass);
        
        $query = "SELECT customer_id, name, email FROM customers WHERE login = '$login' AND password = '$pass' LIMIT 1";
        $res = mysql_query($query) or die(mysql_error());
        if(mysql_num_rows($res) == 1){
            // если авторизация успешна
            $row = mysql_fetch_row($res);
            $_SESSION['auth']['customer_id'] = $row[0];
            $_SESSION['auth']['user'] = $row[1];
            $_SESSION['auth']['email'] = $row[2];
        }else{
            // если неверен логин/пароль
            $_SESSION['auth']['error'] = "Логин/пароль введены неверно!";
        }
    }
}


// add customer
function add_customer($name, $email, $phone, $address){
	$query = "INSERT INTO customers (name, email, phone, address) 
		VALUES ('$name', '$email', '$phone', '$address')";
		$res = mysql_query($query);

		if( mysql_affected_rows() > 0 ){
			//else gost add receiving id customers
			//возврашает id добавленого customer
			return mysql_insert_id();
		}else{
			//есди не добавлен customer
			$_SESSION['order']['res'] = "<div class='error'>Возникла ошибка при добавлении заказа:<br> <ul>$error</ul></div> ";
			$_SESSION['order']['name'] = $name;
			$_SESSION['order']['email'] = $email;
			$_SESSION['order']['phone'] = $phone;
			$_SESSION['order']['address'] = $address;
			return false;
		}
}


// отправка уведомления о заказе
function mail_order($order_id, $email){


	    // тема письма
	    $thm = "Заказ с интернет-магазина";

	            // текст письма
	    $newtext = wordwrap($message_new, 30, "<br />\n");
	    // текст письма
	    $message = " 
	    <html>
	    <head>
	    </head>
	    <body>
	         <div >
	         	<p>Благодарим за заказ!</p>
	         	<p>Номер вашего заказа - {$order_id}</p>
	         	<p>Заказаные товары -";

	    foreach($_SESSION['cart'] as $goods_id => $value){
	    $message .= "Наименования: {$value['name']}, цена: {$value['price']}, количество: {$value['qty']}шт <br>";
	    }

	    $message .= "</p><p>Итого: {$_SESSION['total_quantity']}</p>
	            <p>Сумма: {$_SESSION['total_sum']}</p>
	         	</div>
	    		</body>
	    		</html>";


	    // Для отправки HTML-письма должен быть установлен заголовок Content-type
	    $headers  = 'MIME-Version: 1.0' . "\r\n";

	    $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";

	    // Дополнительные заголовки
	    $headers .= 'To: Admin' . "\r\n";

	    $headers .= 'From: STROI' . "\r\n";

	    $headers .='X-Mailer: PHP/' . phpversion(); 

	    mail($email, $thm, $message,  $headers );

	    mail(ADMIN_EMAIL, $thm, $message,  $headers );

}
