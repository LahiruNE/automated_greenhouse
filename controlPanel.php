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

		<style>
			.switch {
				position: relative;
				display: inline-block;
				width: 40px;
				height: 20px;
			}

			.switch input { 
				opacity: 0;
				width: 0;
				height: 0;
			}

			.slider {
				position: absolute;
				cursor: pointer;
				top: 0;
				left: 0;
				right: 0;
				bottom: 0;
				background-color: #ccc;
				-webkit-transition: .4s;
				transition: .4s;
			}

			.slider:before {
				position: absolute;
				content: "";
				height: 16px;
				width: 16px;
				left: 2px;
				bottom: 2px;
				background-color: white;
				-webkit-transition: .4s;
				transition: .4s;
			}

			input:checked + .slider {
				background-color: #2196F3;
			}

			input:focus + .slider {
				box-shadow: 0 0 1px #2196F3;
			}

			input:checked + .slider:before {
				-webkit-transform: translateX(20px);
				-ms-transform: translateX(20px);
				transform: translateX(20px);
			}

			/* Rounded sliders */
			.slider.round {
				border-radius: 20px;
			}

			.slider.round:before {
				border-radius: 50%;
			}
			</style>
		</head>

		<body>
			<?php 
				include("navbar.php");
			?>


			
			<div id="login-form" class="login-form" name="form1" style="width: 1400px !important">   
				<div class="jumbotron jumbotron-fluid">
				  <div class="container">
				    <h1 class="display-4">Control Panel</h1>
				  </div>
				</div>

		          <table style="position: relative; margin:auto">
		            	<tr>
		            		<td style="padding: 20px">
		            			<div class="card" style="width: 300px; height: 250px">
								  <img src="./img/001-doorway.png" class="card-img-top" alt="..." style="width: 64px; margin: auto; margin-top: 20px">
								  <div class="card-body">
								    <h5 class="card-title">Door</h5>
								    <p class="card-text">Open or Close Door</p>
								    <a onclick="controls('door', 1, '<?php echo $SETTINGS["ip"]?>')" class="card-link" style="color: #007bff; cursor: pointer;">Open</a>
    								<a onclick="controls('door', 0, '<?php echo $SETTINGS["ip"]?>')"  class="card-link" style="color: #007bff; cursor: pointer;">Close</a>
								  	<br>
										<table>
											<tr>
												<td style="padding: 5px; padding-left: 0px">
													Automatic Door Control 
												</td>
												<td style="padding: 5px">
													<label class="switch" style="margin-top: 10px">
														<input type="checkbox" id="autoToggle">
														<span class="slider round"></span>
													</label>
												</td>
											</tr>
										</table>
									</div>
								</div>
		            		</td>
		            		<td style="padding: 20px">
		            			<div class="card" style="width: 300px; height: 250px">
								  <img src="./img/002-gas-pipe.png" class="card-img-top" alt="..." style="width: 64px; margin: auto; margin-top: 20px">
								  <div class="card-body">
								    <h5 class="card-title">Valve</h5>
								    <p class="card-text">Open or Close Valve</p>
								    <a onclick="controls('valve', 1, '<?php echo $SETTINGS["ip"]?>')" class="card-link" style="color: #007bff; cursor: pointer;">Open</a>
    								<a onclick="controls('valve', 0, '<?php echo $SETTINGS["ip"]?>')"  class="card-link" style="color: #007bff; cursor: pointer;">Close</a>
								  </div>
								</div>
		            		</td>
		            	</tr>
		            	<tr>
		            		<td style="padding: 20px">
		            			<div class="card" style="width: 300px; height: 250px">
								  <img src="./img/003-idea.png" class="card-img-top" alt="..." style="width: 64px; margin: auto; margin-top: 20px">
								  <div class="card-body">
								    <h5 class="card-title">Light</h5>
								    <p class="card-text">On or Off Light</p>
								    <a onclick="controls('light', 1, '<?php echo $SETTINGS["ip"]?>')" class="card-link" style="color: #007bff; cursor: pointer;">Switch On</a>
    								<a onclick="controls('light', 0, '<?php echo $SETTINGS["ip"]?>')"  class="card-link" style="color: #007bff; cursor: pointer;">Switch Off</a>
								  </div>
								</div>
		            		</td>
		            		<td style="padding: 20px">
		            			<div class="card" style="width: 300px; height: 250px">
								  <img src="./img/005-led-light.png" class="card-img-top" alt="..." style="width: 64px; margin: auto; margin-top: 20px">
								  <div class="card-body">
								    <h5 class="card-title">Nutrition Light</h5>
								    <p class="card-text">On or Off Nutrition Light</p>
								    <a onclick="controls('n_light', 1, '<?php echo $SETTINGS["ip"]?>')" class="card-link" style="color: #007bff; cursor: pointer;">Switch On</a>
    								<a onclick="controls('n_light', 0, '<?php echo $SETTINGS["ip"]?>')"  class="card-link" style="color: #007bff; cursor: pointer;">Switch Off</a>
								  </div>
								</div>
		            		</td>
		            	</tr>
		            	<tr>
		            		<td style="padding: 20px">
		            			<div class="card" style="width: 300px; height: 250px">
								  <img src="./img/004-warning.png" class="card-img-top" alt="..." style="width: 64px; margin: auto; margin-top: 20px">
								  <div class="card-body">
								    <h5 class="card-title">Fire Alarm</h5>
								    <p class="card-text">On or Off Fire Alarm</p>
								    <a onclick="controls('alarm', 1, '<?php echo $SETTINGS["ip"]?>')" class="card-link" style="color: #007bff; cursor: pointer;">Switch On</a>
    								<a onclick="controls('alarm', 0, '<?php echo $SETTINGS["ip"]?>')"  class="card-link" style="color: #007bff; cursor: pointer;">Switch Off</a>
								  </div>
								</div>
							</td>
							<td style="padding: 20px">
		            			<div class="card" style="width: 300px; height: 250px">
								  <img src="./img/006-fan.png" class="card-img-top" alt="..." style="width: 64px; margin: auto; margin-top: 20px">
								  <div class="card-body">
								    <h5 class="card-title">Cooling Fan</h5>
								    <p class="card-text">On or Off Cooling Fan</p>
								    <a onclick="controls('fan', 1, '<?php echo $SETTINGS["ip"]?>')" class="card-link" style="color: #007bff; cursor: pointer;">Switch On</a>
    								<a onclick="controls('fan', 0, '<?php echo $SETTINGS["ip"]?>')"  class="card-link" style="color: #007bff; cursor: pointer;">Switch Off</a>
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
		getAutoStatus();
	});
			
	$('#autoToggle').change(function() {
			
	});

	function getAutoStatus(){
		let url = 'http://' + '<?php echo $SETTINGS["ip"]?>' + '/getautostatus';

		$.ajax({
			url: url,
			type: 'GET',
			async:false,
			success: function (response) {
					if(response == 1) {
						$('#autoToggle').prop('checked', true);
					}     
					else{						
						$('#autoToggle').prop('checked', false)
					}                          
			}
		});
	}
	
	function controls(type, val, ip){
		Swal.fire({
		  title: 'Are you sure?',
		  type: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: 'Yes'
		}).then((result) => {
		  if (result.value) {
				let url = 'http://';

		  	switch(type) {
					case 'door':
						if(val == '0'){
							url = url + ip + "/doorclose";
						}
						else{
							url = url + ip + "/dooropen";
						}	   
						break;
					case 'valve':
						if(val == '0'){
							url = url + ip + "/valveclose";
						}
						else{
							url = url + ip + "/valveopen";
						}  
						break;
					case 'light':
						if(val == '0'){
							url = url + ip + "/lightoff";
						}
						else{
							url = url + ip + "/lighton";
						}	
						break;
					case 'n_light':
						if(val == '0'){
							url = url + ip + "/nlightoff";
						}
						else{
							url = url + ip + "/nlighton";
						}					 
						break;
					case 'alarm':
						if(val == '0'){
							url = url + ip + "/alarmoff";
						}
						else{
							url = url + ip + "/alarmon";
						}
						break;
					case 'fan':
						if(val == '0'){
							url = url + ip + "/fanoff";
						}
						else{
							url = url + ip + "/fanon";
						}
						break;
				} 

				$.ajax({
					url: url,
					type: 'GET',
					async:false,
					success: function (response) {
								swal(
										'Done!',
										response
									);                                
					}
				});
		  }
		})
	}
</script>>