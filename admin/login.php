<?php
	error_reporting(E_ERROR | E_PARSE);	//to remove error messages

	//get form variables
	$redirectPage = $_SESSION['redirect_uri'];
	$username = $_POST['username'];
	$password = $_POST['password'];

	//* DEBUG */ echo 'Redirect page: ' . $_SESSION['redirect_uri'];
	
	//check if username and password is correct
	if( ($username == 'Ray') && ($password == 'Stroud') )
	{
		//store session variable
		session_start();
		$_SESSION['546789uigyftyrsew4e65tyfguo897t6yfcgdrt'] = session_id();
		
		//redirect page if value is set
		if(!empty($redirectPage))
		{
			header("refresh:3;url=$redirectPage");
			$msg = $msg + '<p class="confirm-label"><label>Login Successful. Please click <a href="' + $redirectPage + '">here</a> if not automatically redirected.</label></p>';
		}
		else
		{
			$msg = '<p class="confirm-label"><label>Login Successful. Please continue browsing.</label></p>';
		}
	}
	else if( ($username != '') && ($password != '') )	//if username isn't blank, but incorrect
	{
		$msg = '<p class="error-label"><label>Incorrect Login</label></p>';
	}
	
	include('../includes/header.php');
?>
<h2 id="pageTitle">Login</h2>

<hr>

<form role="form" class="myForm form-horizontal" name="loginForm" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
	<div class="form-group">
		<label class="col-lg-2 col-md-3 col-sm-3 control-label" for="username">Username:</label>
		<div class="col-lg-6 col-md-7 col-sm-8">
			<input type="text" class="form-control" name="username" />
		</div>
	</div>
	<div class="form-group">
		<label class="col-lg-2 col-md-3 col-sm-3 control-label" for="password">Password:</label>
		<div class="col-lg-6 col-md-7 col-sm-8">
			<input type="password" class="form-control" name="password" />
		</div>
	</div>
	<div class="form-group">
		<label class="col-lg-2 col-md-3 col-sm-3 control-label"  for="loginButton">&nbsp;</label>
		<div class="col-lg-6 col-md-7 col-sm-8">
			<input type="submit" class="col-lg-3 col-md-3 btn btn-default" name="loginButton" value="Login" />
		</div>
	</div>
<?php
	//display error message
	if($msg)
	{
		echo $msg;
	}
?>
</form>

<?php
	include('../includes/footer.php');
?>