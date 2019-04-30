<?php
session_name('LoginForm');
@session_start();

error_reporting(0);
include("config.php");
include("logout.php");

?>

<?php if(isset($_SESSION['user_info']) && is_array($_SESSION['user_info'])) { ?>

	<html>
		<head>
			<meta charset="utf-8">
	        <meta http-equiv="X-UA-Compatible" content="IE=edge">
	        <title>Login Form</title>
	        <meta name="description" content="">
	        <meta name="viewport" content="width=device-width, initial-scale=1">

	        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

	        <link rel="stylesheet" href="css/main.css">
        <link href='http://fonts.googleapis.com/css?family=Roboto:400,300,500' rel='stylesheet' type='text/css'>
        <link href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
        <script src="js/jquery-1.8.2.min.js"></script>
        <script src="js/jquery.validate.min.js"></script>
        <script src="js/main.js"></script>

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
        <script src="http://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
		<script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script>
		</head>

		<body>
			<?php 
				include("navbar.php");
			?>



			<form id="login-form" class="login-form" name="form1" style="width: 1400px !important">
		        <div id="form-content">
		            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" style="width: 1300px; margin: auto">
		              <ol class="carousel-indicators">
		                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
		                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
		                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
		              </ol>
		              <div class="carousel-inner">
		                <div class="carousel-item active">
		                  <img style="height: 600px; width: 700px" src="./img/1.jpg" class="d-block w-100" alt="...">
		                </div>
		                <div class="carousel-item">
		                  <img style="height: 600px; width: 700px" src="./img/2.jpg" class="d-block w-100" alt="...">
		                </div>
		                <div class="carousel-item">
		                  <img style="height: 600px; width: 700px" src="./img/3.jpg" class="d-block w-100" alt="...">
		                </div>
		              </div>
		              <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
		                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
		                <span class="sr-only">Previous</span>
		              </a>
		              <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
		                <span class="carousel-control-next-icon" aria-hidden="true"></span>
		                <span class="sr-only">Next</span>
		              </a>
		            </div>

		            <table style="margin: auto">
		            	<tr>
		            		<td style="padding: 40px; width: 400px">
		            			<div class="jumbotron" style="height: 450px">
												<h1 class="display-4">Control Panel</h1>
												<p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
												<hr class="my-4">
												<a class="btn btn-primary btn-lg" href="controlPanel.php" role="button">Go</a>
											</div>
		            		</td>
		            		<td style="padding: 40px; width: 400px">
											<div class="jumbotron" style="height: 450px">
												<h1 class="display-4">Get Readings</h1>
												<p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
												<hr class="my-4">
												<a class="btn btn-primary btn-lg" href="readings.php" role="button">Go</a>
											</div>
		            		</td>

		            		<td style="padding: 40px; width: 400px">
		            			<div class="jumbotron" style="height: 450px">
												<h1 class="display-4">About Us</h1>
												<p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
												<hr class="my-4">
												<a class="btn btn-primary btn-lg" href="about.php" role="button">Go</a>
											</div>
		            		</td>
		            	</tr>
		            </table>>
		        </div>

		    </form>
			
		</body>
	</html>  
    
<?php } else {?> 
	header("Location:index.php");

<?php }?>