
<!DOCTYPE html>
<html lang="zh-tw">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- facebook open graph -->
    <meta property="og:title" content="民間司改會隨偵平台">
    <meta property="og:description" content="">
    <meta property="og:url" content="<?=base_url("/")?>">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="1500">
    <meta property="og:image:height" content="1500">

    <title>民間司改會隨偵平台</title>

    <!-- Bootstrap core CSS -->
    <!--<link href="<?=base_url("css/bootstrap.css")?>" rel="stylesheet">-->
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet">
    
    	<?php
	if(function_exists("css_section")){
		css_section();
	}
	?>
</head>

<body>

<div class="navbar navbar-default" role="navigation">
<div class="navbar-header">
<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
    <span class="sr-only">展開選單</span>
    <span class="icon-bar"></span>
    <span class="icon-bar"></span>
    <span class="icon-bar"></span>
</button>
<a class="navbar-brand" href="<?=site_url("/backadmin/")?>">民間司改會隨偵平台後台</a>
</div>
<div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav ">
    	<?php if(_isLogined()){?>
        <li><a href="<?=site_url("/backadmin/user/logout")?>">登出</a></li>
        <?php }else{ ?>
        <li class="active"><a href="<?=site_url("backadmin/")?>">登入</a></li>
        <?php }?>
    </ul>   
</div>
</div>
