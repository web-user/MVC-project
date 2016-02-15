<?php defined('MVCproject') or die('Access denied');?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title><?php echo TITLE; ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta name="description" content="" />
<meta name="author" content="" />
<!-- css -->
<link href="<?php echo TEMPLATE; ?>css/bootstrap.min.css" rel="stylesheet" />
<link href="<?php echo TEMPLATE; ?>css/style.css" rel="stylesheet" />


<link rel="stylesheet" type="text/css" media="screen" href="<?php echo TEMPLATE; ?>css/bootstrap.css">
<link rel="stylesheet" href="<?php echo TEMPLATE; ?>css/theme.css">



</head>
<body>
<div id="wrapper">
	<!-- start header -->
	<header>
    <section class="callaction">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h1 class="title-style"><a href="/"><?php echo TITLE; ?></a></h1>
            </div>
            <div class="col-md-4">
                <div class="big-cta">
                    <div class="cta-text">
                    </div>
                </div>
            </div>
        </div>
    </div>
    </section>
        <div class="navbar navbar-default navbar-static-top bg-img">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="navbar-collapse collapse ">
                    <ul class="nav navbar-nav">
                        <li class=""><a href="/">Главная</a></li>
                        <li><a href="?view=weather">Weather</a></li>
                        <li><a href="?view=feedback">Feedback</a></li>
                    </ul>
                </div>
            </div>
        </div>
	</header>
	<!-- end header -->








