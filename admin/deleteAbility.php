<?php
	include("../includes/admin_check.php");
	include("../includes/mysql_connect.php");
	
	//pull the selected char to delete
	$selectedId = $_GET['id'];
	
	if(!isset($selectedId))		//if the id isn't set
	{
		echo "No ID, so exiting";
		exit();
	}
	
	mysql_query("delete from ability where ability_id='$selectedId'") or die(mysql_error());
	
	//redirect back to edit.php
	header("Location: editAbility.php?deleted=$selectedId");
?>