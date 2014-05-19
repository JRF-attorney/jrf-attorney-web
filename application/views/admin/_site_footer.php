
    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3 text-center">
                    <hr>
                    <p>Copyright &copy; 民間司改會-隨偵平台 2014</p>
                </div>
            </div>
        </div>
    </footer>
    <!-- /Footer -->

    <!-- JavaScript -->
    <!-- <script src="<?=base_url("js/jquery-1.10.2.js")?>"></script> -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <!-- <script src="<?=base_url("js/bootstrap.js")?>"></script> -->
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>

	<?php
	if(function_exists("js_section")){
		if(empty($params)){
			$params = null;
		}
		js_section($params);
	}
	?>

</body>

</html>
