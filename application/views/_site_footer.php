	<div class="footer">
      <div class="container" style="padding-bottom:20px;">
    	 <hr />
    	 <p>Powered by TonyQ, welcome to fork or contribute on our Github projects
    	 	(<a href="https://github.com/tony1223/antispite-web" target="_blank">Website</a>/
    	 	 <a href="https://github.com/tony1223/antispite-extension" target="_blank">Chrome Extension</a> /
    	 	 <a href="https://github.com/tony1223/antispite-addon" target="_blank">Firefox Addon</a>  
    	 	). </p>
      </div>
    </div>


	<div id="fb-root"></div>

	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
	<!-- Latest compiled and minified JavaScript -->
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>

	<?php
	if(function_exists("js_section")){
		if(empty($params)){
			$params = null;
		}
		js_section($params);
	}
	?>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/zh_TW/all.js#xfbml=1&appId=537183223010563";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>	
	</body>
</html>
