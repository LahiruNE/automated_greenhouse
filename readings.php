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


			<div id="login-form" class="login-form" name="form1" style="width: 1400px !important">   
				<div class="jumbotron jumbotron-fluid">
				  <div class="container">
				    <h1 class="display-4">Sensor Readings</h1>
				  </div>
				</div>

		          <table style="position: relative; margin:auto">
		            	<tr>
		            		<td style="padding: 20px">
		            			<div class="card" style="width: 300px; height: 250px">
								  <img src="./img/001-temperature.png" class="card-img-top" alt="..." style="width: 64px;margin: auto; margin-top: 20px">
								  <div class="card-body">
								    <h5 class="card-title">Temperature</h5>
								    <p class="card-text"><span id="temp">NaN</span> Celcius</p>
										<p class="card-text">Last updated : <span id="tempUpdate">NaN</span></p>
								  </div>
								</div>
		            		</td>
		            		<td style="padding: 20px">
		            			<div class="card" style="width: 300px; height: 250px">
								  <img src="./img/humidity.png" class="card-img-top" alt="..." style="width: 64px; margin: auto; margin-top: 20px">
								  <div class="card-body">
								    <h5 class="card-title">Humidity</h5>
								    <p class="card-text"><span id="humid">NaN</span>%</p>
										<p class="card-text">Last updated : <span id="humidUpdate">NaN</span></p>
								  </div>
								</div>
		            		</td>
										<td style="padding: 20px">
		            			<div class="card" style="width: 300px; height: 250px">
								  <img src="./img/002-soil.png" class="card-img-top" alt="..." style="width: 64px; margin: auto; margin-top: 20px">
								  <div class="card-body">
								    <h5 class="card-title">Soil Moisture</h5>
								    <p class="card-text" id="soil">NaN</p>
										<p class="card-text">Last updated : <span id="soilUpdate">NaN</span></p>
								  </div>
								</div>
		            		</td>
		            	</tr>		            	
		            </table>             

		    </div>
			
		</body>
	</html>  
    
<?php } else {?> 
	header("Location:index.php");

<?php }?>


<script type="text/javascript">
	$( document ).ready(function() {
			getReadings();
	});

	setInterval(function(){ 
		getReadings();
	}, 30000);

	function getReadings(){
		let url = 'http://' + '<?php echo $SETTINGS["ip"]?>' + '/getreadings';

		$.ajax({
			url: url,
			type: 'GET',
			async:false,
			success: function (response) {
					const resArr = response.split('&');
					const nowDate = new Date().toString();

					if(resArr[0]) {
						$("#temp").text(resArr[0]);
						$("#tempUpdate").text(nowDate);
					}

					if(resArr[1]) {
						$("#humid").text(resArr[1]);
						$("#humidUpdate").text(nowDate);
					}                                
			}
		});
	}
</script>