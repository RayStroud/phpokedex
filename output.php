<?php
	include("includes/header.php");
?>

<h2 id="pageTitle">Output</h2>

<hr>
	<pre>
<?php
	echo makeSqlToInsertAllPokemon();
?>
	</pre>

</div> <!-- end content -->
<?php
	include("includes/footer.php");
?>