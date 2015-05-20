<?php
	//connect to DB
	mysql_connect("localhost", "rstroud2", "pass19") or die(mysql_error());
	//select DB
	mysql_select_db("rstroud2") or die(mysql_error());
	
	//stop SQL injections in all POST vars
	foreach($_POST as $key => $value)
	{
		$_POST[$key] = mysql_real_escape_string($value);
	}
	//stop SQL injections in all GET vars
	foreach($_GET as $key => $value)
	{
		$_GET[$key] = mysql_real_escape_string($value);
	}
?>