<?php
	include("includes/header.php");
	
	$randomPokemon = getRandomPokemon();
?>

<h2 id="pageTitle">Home</h2>

<hr>

<div id="content" class="row">

	<div class="featured-pokemon">
		<a href="view.php?id=<?php echo $randomPokemon['pid']; ?>"><span class="link-spanner"></span></a>
		<img class="view-image-img img-thumbnail" src="images/square240/<?php echo $randomPokemon['img_name']; ?>" />
		<h4><?php echo $randomPokemon['name']; ?></h4>
	</div>

	<h3>Welcome</h3>
	<p>
		PHPokedex is an exercise in working with PHP and MySQL. It is a catalog of the different species in the Pokemon universe. It works great for a catalog project because there is a lot of different information about each species. Pokemon can be caught and collected, and each one belongs to a distinct species of Pokemon. Each species is different from another in certain ways, and each individual Pokemon of the species is different from another of that species in certain ways. This catalog shows how each species is different:
	</p>
	<ul>
		<li>
			Each species has a Pokedex number, which is for tracking the species.
		</li>
		<li>
			Each species has a name, description, height, and weight.
		</li>
		<li>
			Each species is categorized by either one or two out of 18 possible element types.
		</li> 
		<li>
			Each species has a set of abilities that it can have (up to three distinct abilities), but a single Pokemon of that species has only of those abilities.
		</li>
		<li>
			Each species has a set of base stats, although a single Pokemon has a slight variance from those base stats.
		</li>
<!--
		<li>
			Each species has a certain evolutionary sequence, where one species evolves into another under a certain condition.
		</li>
-->
	</ul>
	
	<div id="featured-searches">
		<h3>Try these Advanced Searches!</h3>
		<ul class="feat-search-list">
			<li><a href="advsearch.php?bstM=gt&bstN=600&by=spd&sort=desc&search=Search"><span class="glyphicon glyphicon-search"></span> High-Stat Pokemon ordered by Highest Speed</a></li>
			<li><a href="advsearch.php?g1=1&g2=1&g3=1&g4=1&g5=1&t1=Fairy&by=pokedex_no&sort=asc&search=Search"><span class="glyphicon glyphicon-search"></span> Fairy-type Pokemon not from Generation VI</a></li>
			<li><a href="advsearch.php?t1=Fighting&atkM=gt&atkN=120&by=bst&sort=desc&search=Search"><span class="glyphicon glyphicon-search"></span> Fighting-type Pokemon with High Attack, ordered by Highest Stats</a></li>
			<li><a href="advsearch.php?defM=gt&defN=100&sp_defM=gt&sp_defN=100&by=spd&sort=asc&search=Search"><span class="glyphicon glyphicon-search"></span> High Defense and Sp Defense Pokemon, ordered by Lowest Speed</a></li>
			<li><a href="advsearch.php?spdM=gt&spdN=100&bstM=lt&bstN=500&by=spd&sort=desc&search=Search"><span class="glyphicon glyphicon-search"></span> Low-Stat Pokemon with High Speed, ordered by Highest Speed</a></li>
		</ul>
	</div>
	
	<h3>Features</h3>
	<p>
		Some notable features of PHPokedex include:
	</p>
	<ul>
		<li>
			<a href="pokedex.php">Pokedex</a> - This page displays all Pokemon. <!-- Users can choose to display by thumbnail view or by detailed view. -->
		</li>
		<li>
			<a href="view.php?id=29">View Pokemon</a> - This page shows all information about a single species of Pokemon. If the admin is logged in, there is a link to edit that Pokemon's information.
		</li>
		<li>
			<a href="search.php">Search by Name or #</a> - Users can search for a Pokemon by name or Pokedex number.
		</li>
		<li>
			<a href="advsearch.php">Advanced Search</a> - Users can search for a Pokemon species based on several details. They can choose one, many, all, or none of the search features. 
		</li>
		<li>
			Pagination - The search results (<a href="pokedex.php">Pokedex</a>, <a href="search.php">Search</a>, <a href="advsearch.php">Adv Search</a>) are split into pages. There are controls to change pages: First, Previous, Next, Last, and numbered page links. There is an adjustable limit to how many pagination buttons are shown, and they adjust with each page. There is an adjustable limit to how many results are displayed per page. The pagination functions can also be used for other projects, as the table name, list of fields, and "where-clause" string are passed in as parameters.
		</li>
		<li>
			<a href="admin/edit.php">Admin</a> - Add, Edit or Delete a Pokemon and its information. This section is protected by a secure login. 
		</li>
		<ul>
			<li>
				After selecting an image to upload, a preview of that image is automatically shown without having to upload the image first.
			</li>
			<li>
				On uploading an image, the original is stored on the server, and several copies are made at various sizes. The server adjusts the width and height of the image to allow the full image to be centered on a white square background.
			</li>
			<li>
				<!-- Three --> Two different MySQL tables are used to store the data: one for the Pokemon species, and one for the abilities.
			</li>
		</ul>
		<li>
			Responsive - The site uses <a href="http://getbootstrap.com/" target="_blank">Twitter Bootstrap</a> to make it fully responsive for mobile devices. <a href="#" target="popup" onClick="wopen('#', 'popup', 320, 480); return false;">Click here</a> to see site in mobile-size.
		</li>
		<li>
			A semi-recursive method is used for displaying the menu links and its dropdown links. It also highlights the menu item if the page belongs to that category. 
		</li>
	</ul>
	
	<h3>Specifications</h3>
	<p>
		The specifications for the project are:
	</p>
	<h5>Basic PHP/MySQL input functionality [5 marks]</h5>
	<ul class="specs-list">
		<li>Good admin section. An admin should be able to insert, delete, edit, etc. <span class="checked glyphicon glyphicon-ok"></span></li>
		<li>Admin section is secured. <span class="checked glyphicon glyphicon-ok"></span></li>
		<li>All necessary validation such as required-field, min-length, JPEG-only, etc. <span class="checked glyphicon glyphicon-ok"></span></li>
	</ul>
	<h5>Content [5 marks]</h5>
	<ul>
		<li>All info for at least 25 items including titles, images, descriptions, and at least 3 other fields of info. <span class="checked glyphicon glyphicon-ok"></span></li>
		<li>Good description of project, genres, etc. on homepage. <span class="checked glyphicon glyphicon-ok"></span></li>
		<li>Multiple image sizes utilized. <span class="checked glyphicon glyphicon-ok"></span></li>
	</ul>
	<h5>Overall design/usability [5 marks]</h5>
	<ul>
		<li>Visual design is appealing and professional. <span class="checked glyphicon glyphicon-ok"></span></li>
		<li>All content is easily accessible; all text readable. <span class="checked glyphicon glyphicon-ok"></span></li>
		<li>A single item view must be available as well as list views. <span class="checked glyphicon glyphicon-ok"></span></li>
		<li>The database filters are natural categories that work with the content and lead the user into believing they are navigating a site, NOT querying a database. <span class="checked glyphicon glyphicon-ok"></span></li>
		<li>Thumbnails are well designed and implemented into the design. <span class="checked glyphicon glyphicon-ok"></span></li>
		<li>The Home page has an interesting layout that entices the user to explore further. <span class="checked glyphicon glyphicon-ok"></span></li>
			<ul>
				<li>Intro to this project. <span class="checked glyphicon glyphicon-ok"></span></li>
				<li>Featured items, categories, etc. Graphical features recommended. <span class="checked glyphicon glyphicon-ok"></span></li>
				<li>Main navigation present. <span class="checked glyphicon glyphicon-ok"></span></li>
			</ul>
	</ul>
	<h5>MySQL filtering and navigation, features/widgets [5 marks]</h5>
	<ul>
		<li>All items are shown from a well thought out system of categories and other cataloging parameters. <span class="checked glyphicon glyphicon-ok"></span></li>
		<ul>
			<li>One of which should show a range of values (MySQL BETWEEN). If prices or any other values do not seem to work with your content, try a rating system. <span class="checked glyphicon glyphicon-ok"></span></li>
		</ul>
		<li>Interesting use of any MySQL generated widgets, features or teaser items. <span class="checked glyphicon glyphicon-ok"></span></li>
		<ul>
			<li>Pagination (if you can make it work; the one script we went through cannot be used without extensive modification). <span class="checked glyphicon glyphicon-ok"></span></li>
		</ul>
			<li>Interesting query feature(s) that you have researched yourself and implemented and that we have not covered in class. <span class="checked glyphicon glyphicon-ok"></span></li>
			<li>Do NOT show too many filters that result in the user constantly trying filters that result in no results. If an advanced filtering system does not work for your content, use a simpler one. <span class="checked glyphicon glyphicon-ok"></span></li>
		<ul>
			<li>You could have a dedicated search page however with advanced filters, an advanced search, etc. <span class="checked glyphicon glyphicon-ok"></span></li>
		</ul>
	</ul>
	<h5>Additional Features and media [5 marks]</h5>
	<ul>
		<li>Impress classmates, employers, and teachers with any features you would like to figure out.</li>
		<li>Examples:</li>
		<ul>
			<li>A true responsive layout that can be accessed from mobile devices. <span class="checked glyphicon glyphicon-ok"></span></li>
			<li>DVD Youtube video embedded trailers.</li>
			<li>JQuery or similar features for output or admin validation, image cropping, etc.</li>
			<li>Anything else you would like to try; perhaps consult the instructor first if you're not sure about it.</li>
		</ul>
		<li><i>Additional features in this project:</i></li>
		<ul>
			<li>Validation messages for individual fields on add/edit pages. <span class="checked glyphicon glyphicon-ok"></span></li>
			<li>Image preview before uploading. <span class="checked glyphicon glyphicon-ok"></span></li>
			<li>Image converter - full image in square. <span class="checked glyphicon glyphicon-ok"></span></li>
			<li>Horizontal bar graph for stats <span class="checked glyphicon glyphicon-ok"></span></li>
			<li>Changing the order of the results for the <a href="advsearch.php">Advanced Search</a>. <span class="checked glyphicon glyphicon-ok"></span></li>
			<li>Recursive method to display navigation. Current page highlighted on navbar. <span class="checked glyphicon glyphicon-ok"></span></li>
			<!-- <li>Two different display options. <span class="checked glyphicon glyphicon-ok"></span></li> -->
		</ul>
	</ul>

</div> <!-- end content -->
<?php
	include("includes/footer.php");
?>