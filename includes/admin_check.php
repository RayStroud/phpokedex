<?php
	session_start();
	
	//if admin sessions is not set
	if(!isset($_SESSION['546789uigyftyrsew4e65tyfguo897t6yfcgdrt']))
	{
		//pass which page user is trying to access
		$_SESSION['redirect_uri'] = $_SERVER['REQUEST_URI'];

		//forward page request
		header('Location:/phpokedex/admin/login.php');
		die();
	}
?>