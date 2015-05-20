<?php
	include("includes/header.php");
	
	//get page number
	$thisPageNum = 1;
	if(isset($_GET['pg']))
	{
		$thisPageNum = $_GET['pg'];
	}

	//set the per page var
	$resultsPerPage = 120;
	$maxButtonsToShow = 7;
	
	//calc paging
	$aPagingVars = getPagingVars('pokemon', '', $thisPageNum, $resultsPerPage, $maxButtonsToShow);
	
	//query the posts for the page
	$aFields = array('pid', 'img_name', 'pokedex_no', 'name', 'type1', 'type2', 'info', 'height', 'weight', 'ability1', 'ability2', 'abilityH', 'hp', 'atk', 'def', 'sp_atk', 'sp_def', 'spd');
	$aPagePokemon = listPageResults('pokemon', $aFields, '', '', $aPagingVars['limitSql']);
?>

<h2 id="pageTitle">Pokedex</h2>

<hr>

<div id="content" class="row">

<?php 
if(!empty($aPagePokemon))
{
	echo $aPagingVars['pagingHtml'];
	echo getPokemonThumbHtml($aPagePokemon); 
	echo $aPagingVars['pagingHtml'];
}
else
{
	echo '<p class="error-label"><label>No images.</label></p>';;
}
?>

</div> <!-- end content -->
<?php
	include("includes/footer.php");
?>