<?php include(__DIR__."/../_site_header.php")?>
<div id="main-form" class="main-form">
    <div class="container">
		<!-- Nav tabs -->
		<ul class="nav nav-tabs">
		</ul>

		<h1>新增案件</h1>
		<div class="tab-content">
			<div class="tab-pane" style="display:block;padding:20px;">
				<form class="form-horizontal col-sm-8" role="form" action="<?=site_url("backadmin/event/create")?>"  >
				  <div class="form-group">
				    <label for="name" class="col-sm-2 control-label">個案姓名</label>
				    <div class="col-sm-4">
				      <?=form_input(Array("name"=>"name","class"=> "form-control"))?>
				    </div>
				  </div>
				  <div class="form-group">
				    <label class="col-sm-2 control-label">個案電話</label>
				    <div class="col-sm-4">
				    	<?=form_input(Array("name"=>"phone","class"=> "form-control"))?>
				    </div>
				  </div>
				  <div class="form-group">
				    <label class="col-sm-2 control-label">逮捕原因（案由）</label>
				    <div class="col-sm-10">
				    	<?=form_textarea(Array("name"=>"reason","class"=> "form-control"))?>
				    </div>
				  </div>
				  <div class="form-group">
				    <label class="col-sm-2 control-label">該地所在律師公會</label>
				    <div class="col-sm-10">
				    	<?=form_dropdown("belongto",Array(1,2,3),null," class='form-control' ")?>
				    </div>
				  </div>
				  <div class="form-group">
				    <label class="col-sm-2 control-label">地點</label>
				    <div class="col-sm-10">
				    	<?=form_input(Array("name"=>"location","class"=> "form-control"))?>
				    </div>
				  </div>
				  <div class="form-group">
				    <label class="col-sm-2 control-label">地址</label>
				    <div class="col-sm-10">
				    	<?=form_input(Array("name"=>"address","class"=> "form-control"))?>
				    </div>
				  </div>
				  <div class="form-group">
				    <div class="col-sm-offset-2 col-sm-10">
				      <div class="checkbox">
				        <label><?=form_checkbox(Array("notify","class"=> ""),"true",true)?> 用 App &amp; Email 通知該區義務律師</label>
				      </div>
				    </div>
				  </div>
				  <div class="form-group">
				    <div class="col-sm-offset-2 col-sm-10">
				      <button type="submit" class="btn btn-default">送出</button>
				    </div>
				  </div>
				</form>				
			</div>
		</div>

	</div>
</div>
<?php include(__DIR__."/../_site_footer.php") ?>