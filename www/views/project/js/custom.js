/*global jQuery:false */
jQuery(document).ready(function($) {

		//add some elements with animate effect

$(function () {                                      // Когда страница загрузится
    $('.nav li a').each(function () {             // получаем все нужные нам ссылки
        var location = window.location.href; // получаем адрес страницы
        var link = this.href;                // получаем адрес ссылки
        if(location == link) {               // при совпадении адреса ссылки и адреса окна
            $(this).addClass('active');  //добавляем класс
        }
    });
});

		$(".big-cta").hover(
			function () {
			$('.cta a').addClass("animated shake");
			},
			function () {
			$('.cta a').removeClass("animated shake");
			}
		);

		var top_show = 150; // В каком положении полосы прокрутки начинать показ кнопки "Наверх"
		var delay = 1000; // Задержка прокрутки

		  $(window).scroll(function () { // При прокрутке попадаем в эту функцию
		    /* В зависимости от положения полосы прокрукти и значения top_show, скрываем или открываем кнопку "Наверх" */
		    if ($(this).scrollTop() > top_show) $('#top').fadeIn();
		    else $('#top').fadeOut();
		  });
		  $('#top').click(function () { // При клике по кнопке "Наверх" попадаем в эту функцию
		    /* Плавная прокрутка наверх */
		    $('body, html').animate({
		      scrollTop: 0
		    }, delay);
		  });





		$( '.grngrdn-check' ).click( function () {
			if ( $( this ).find( 'input' ).is( ':checked' ) ) {
				$( this ).addClass( 'grngrdn-active' );
				// $( this ).find( 'input' ).attr( 'checked', false );
				$(".hide-dost").show(300);
			}
			else {
				
				$( this ).removeClass( 'grngrdn-active' );
				// $( this ).find( 'input' ).attr( 'checked', true );
				$(".hide-dost").hide(300);
			}
		});

		// authorization
    $("#auth").click(function(e){
        e.preventDefault();
        var msg = $("#my-form").serialize();
        var loginauth = $("#loginauth").val();
        var passauth = $("#passauth").val();
        var auth = $("#auth").val();
        $.ajax({
           url: './',
           type: 'POST',
           data: {auth: auth, loginauth: loginauth, passauth: passauth},
           success: function(res){
                if(res != 'Поля логин/пароль должны быть заполнены!' && res != 'Логин/пароль введены неверно!'){
                    // если пользователь успешно авторизован
                    window.location = "/";
                }else{
                    // если авторизация неудачна
                    $(".error").remove();
                    $(".authform").append('<div class="error"></div>');
                    $(".error").hide().fadeIn(500).html(res);
                }
           },
           error: function(){
                alert("Error!");
           }
        });
    });


    		// registration
        $("#reg").click(function(e){
        	e.preventDefault();
        	var login = $("#login").val();
        	var pass = $("#pass").val();
        	var reg = $("#reg").val();
  			var gender = $( "input:checked" ).val();
  			var datetime = $("#datetime").val();
  			var surname = $("#surname").val();
  			var name = $("#name").val();
  			var email = $("#email").val();
        	 if(login.length == 0 ){
            		$(".reg-sss").html('<font size="3" color="red">Не все поля заполнены. Попробуйте еще раз</font>');
            	}else{
            		$.ajax({
            		   url: './',
            		   type: 'POST',
            		   data: {login: login, reg: reg, gender: gender, datetime: datetime, surname: surname, email: email, pass: pass, name: name},
            		   success: function(res){
            		        if(res){
            		           $(".reg-sss").html(res);
            		           console.log(res)
            		           if(res == "<div class='success'>Регистрация прошла успешно.</div>" ){
            		           		window.location = "/";
            		           		$("#login").val('');
            		           }
            		        }else{
            		            // если авторизация неудачна
            		            $(".error").remove();
            		            $(".authform").append('<div class="error"></div>');
            		            $(".error").hide().fadeIn(500).html(res);
            		        }
            		   },
            		   error: function(){
            		        alert("Error!");
            		   }
            		});
            	}


        });


  		// registration
      $("#feedback").click(function(e){
      	e.preventDefault();
      	var feedback = $("#feedback").val();
      	var kapcha = $("#kapcha").val();
      	var namefeedback = $("#namefeedback").val();

          		$.ajax({
          		   url: './',
          		   type: 'POST',
          		   data: {feedback: feedback, kapcha: kapcha},
          		   success: function(res){
          		        if(res){
          		           $(".reg-sss").html(res);
          		           console.log(res)
          		        }else{
          		            // если авторизация неудачна
          		            $(".error").remove();
          		            $(".authform").append('<div class="error"></div>');
          		            $(".error").hide().fadeIn(500).html(res);
          		        }
          		   },
          		   error: function(){
          		        alert("Error!");
          		   }
          		});
  


      });



    //    custom placeholder:
    function Placeholder(options) {
    	var $input = options.elem,
    		placeholderValue = $input.attr('placeholder');
    	$input.on('focus', onfocus);
    	$input.on('blur', onblur);

    	function onfocus() {
    		if(!$(this).val()){
    			$(this).attr('placeholder','');
    		}
    	}

    	function onblur(){
    		if(!$(this).val()) {
    			$(this).attr('placeholder',placeholderValue);
    		}
    	}
    }

    $('input[type="text"]').each(function(){
    	new Placeholder({elem: $(this)});
    });

		// клавиша ENTER при пересчете
		$('.new-input').keypress(function(e){
			if( e.which == 13 ){
				return false;
			}
		});

		//перересчет товара в корзине
		$('.new-input').each(function(){
			var qty_start = $(this).val(); // количество до изменения

			$(this).change(function(){
				var qty = $(this).val(); // кол перед изменения
				var res = confirm("Пересчитать карзину ?");
				if(res){
					var id = $(this).attr("id");
					id = id.substr(2);
					if( !parseInt(qty) ){
						qty = qty_start;
					}
					// передача параметров
					window.location = "?view=cart&qty=" + qty + "&id=" +id;
				}else{
					//если отменили пересчет карзины
					$(this).val(qty_start);
				}
			});
		});




		$(".box").hover(
			function () {
			$(this).find('.icon').addClass("animated fadeInDown");
			$(this).find('p').addClass("animated fadeInUp");
			},
			function () {
			$(this).find('.icon').removeClass("animated fadeInDown");
			$(this).find('p').removeClass("animated fadeInUp");
			}
		);
		
		
		$('.accordion').on('show', function (e) {
		
			$(e.target).prev('.accordion-heading').find('.accordion-toggle').addClass('active');
			$(e.target).prev('.accordion-heading').find('.accordion-toggle i').removeClass('icon-plus');
			$(e.target).prev('.accordion-heading').find('.accordion-toggle i').addClass('icon-minus');
		});
		
		$('.accordion').on('hide', function (e) {
			$(this).find('.accordion-toggle').not($(e.target)).removeClass('active');
			$(this).find('.accordion-toggle i').not($(e.target)).removeClass('icon-minus');
			$(this).find('.accordion-toggle i').not($(e.target)).addClass('icon-plus');
		});	

		







});

