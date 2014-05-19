<!DOCTYPE html>
<html >
<head>
	<meta charset="utf-8">
	<title><?php
		if(isset($pageTitle)){
			if(empty($selector) || $selector != "home"){
				echo $pageTitle." - 民間司改會隨偵平台"  ;
			}else{
				echo $pageTitle; 
			}
		} else{
			echo "民間司改會隨偵平台" ; 
		}
	?></title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
	<meta name="google-site-verification" content="AkD7jR9M0OkMfRj9N4EgYUOlcrscDtf9kgfsKcFDvbI" />
	<!-- Optional theme -->
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php if(function_exists("css_section")){
    	css_section();
     }?>
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
<a class="navbar-brand" href="<?=site_url("/")?>">民間司改會隨偵平台 </a>
</div>
<div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav ">
    </ul>   
</div>
</div>