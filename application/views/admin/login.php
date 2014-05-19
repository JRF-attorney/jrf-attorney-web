<?php include("_site_header.php") ?>
<div id="main-form" class="main-form">
    <div class="container">
		
				<?php if($status=="error"){ ?>
			<div class="alert alert-error">
				<?=empty($message) ? "您輸入的帳號或密碼錯誤" : $message ?>
			</div>
			<?php } ?>
			<a class="btn btn-default" href="<?=site_url("backadmin/logining")?>"> Google 登入</a>
	
	</div>
</div>
<?php include("_site_footer.php") ?>