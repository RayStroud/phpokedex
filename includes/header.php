<?php
	error_reporting(E_ERROR | E_PARSE);	//to remove error messages
	include("mysql_connect.php");
	include("functions.php");
?>
<html>

<head>
	<title>PHPokedex</title>
	<link rel="icon" href="/phpokedex/favicon.png?v=1">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <link href="/phpokedex/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="/phpokedex/assets/css/bootstrap-theme.min.css" rel="stylesheet">
    <script src="/phpokedex/assets/js/bootstrap.min.js"></script>
    <link href="/phpokedex/styles/style.css" rel="stylesheet">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
</head>

<body>
	<div id="banner">
		<h1>PHPokedex</h1>
	</div>
	
	<div class="navbar navbar-inverse" role="navigation">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#menu">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
		</div>
	
		<div class="collapse navbar-collapse" id="menu">
			<ul class="nav navbar-nav">
<?php
			//get this page
			$pageUrl = $_SERVER['REQUEST_URI'];
		
			//make array of page name and urls
			//the ['url'][0] is the url visited when clicked
			//every other ['url'] highlights that menu item when visited
			$aSites[0]['name'] = 'Home';
			$aSites[0]['url'][0] = '/phpokedex/index.php';
			$aSites[1]['name'] = 'Pokedex';
			$aSites[1]['url'][0] = '/phpokedex/pokedex.php';
			$aSites[2]['name'] = 'Search';
			$aSites[2]['url'][0] = '/phpokedex/search.php';
			$aSites[2]['dropdown'][0]['name'] = 'by Name or #';
			$aSites[2]['dropdown'][0]['url'][0] = '/phpokedex/search.php';
			$aSites[2]['dropdown'][1]['name'] = 'Advanced';
			$aSites[2]['dropdown'][1]['url'][0] = '/phpokedex/advsearch.php';
			$aSites[3]['name'] = 'Admin';
			$aSites[3]['url'][0] = '/phpokedex/admin/edit.php';
			$aSites[3]['url'][1] = '/phpokedex/admin/login.php';
			$aSites[3]['dropdown'][0]['name'] = 'Pokemon';
			$aSites[3]['dropdown'][0]['url'][0] = '/phpokedex/admin/edit.php';
			$aSites[3]['dropdown'][0]['url'][1] = '/phpokedex/admin/add.php';
			$aSites[3]['dropdown'][1]['name'] = 'Ability';
			$aSites[3]['dropdown'][1]['url'][0] = '/phpokedex/admin/editAbility.php';
			$aSites[3]['dropdown'][1]['url'][1] = '/phpokedex/admin/addAbility.php';
			
			//output navbar links
			echo getMenuListHtml($aSites, $pageUrl);
?>
			</ul>
			<form class="navbar-form navbar-right" role="search" method="get" action="/phpokedex/search.php">
				<div class="form-group">
					<input type="text" class="form-control" name="val" placeholder="Search by Name or #">
				</div>
				<input type="submit" class="btn btn-default" name="search" value="Search" />
			</form>
		</div>
	</div>
	<div style="clear: both; height: 0px;"></div>
	<div id="container" class="container">
<!--HEADER ENDS HERE-->