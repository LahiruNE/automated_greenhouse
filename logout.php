<?php 

if(isset($_GET['ac']) && $_GET['ac'] == 'logout'){
	$_SESSION['user_info'] = null;
	unset($_SESSION['user_info']);
}

?>	