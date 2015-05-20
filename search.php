<?php
	include("includes/header.php");
	
	//get page number
	$thisPageNum = 1;
	if(isset($_GET['pg']))
	{
		$thisPageNum = $_GET['pg'];
	}
	
	if(isset($_GET['search']))
	{
		//get post vars
		$searchTerm = $_GET['val'];
		$orderByColumn = $_GET['by'];

		//set the per page var
		$resultsPerPage = 120;
		$maxButtonsToShow = 7;
		
		//calculate whereSql
		if(is_numeric($searchTerm))
		{
			$whereSql = "where pokedex_no = '$searchTerm'";
		}
		else
		{	
			$likeSearchTerm = '%' . strtolower($searchTerm) . '%';
			$whereSql = "where lower(name) like '$likeSearchTerm'";
		}
		//* DEBUG */ echo "<p>WHERE: $whereSql</p>";
		
		//make orderBySql
		$orderBySql = "order by name asc";
		//* DEBUG */ echo "<p>orderBySql: $orderBySql</p>";
		
		//calc paging
		$aPagingVars = getPagingVars('pokemon', $whereSql, $thisPageNum, $resultsPerPage, $maxButtonsToShow);
		//* DEBUG */ echo '<pre>'; print_r($aPagingVars); echo '</pre>';
		
		//query the posts for the page
		$aFields = array('pid', 'img_name', 'pokedex_no', 'name', 'type1', 'type2', 'info', 'height', 'weight', 'ability1', 'ability2', 'abilityH', 'hp', 'atk', 'def', 'sp_atk', 'sp_def', 'spd', 'bst');
		$aPagePokemon = listPageResults('pokemon', $aFields, $whereSql, $orderBySql, $aPagingVars['limitSql']);
	}
?>

<h2 id="pageTitle">Search by Name or #</h2>

<hr>

<form class="form form-horizontal" role="search" method="get" action="search.php">
	<div class="form-group">
		<label class="control-label col-sm-2" for="search">&nbsp;</label>
		<div class="col-sm-6">
			<input type="text" class="form-control" name="val" placeholder="Search by Name or #" value="<?php echo empty($searchTerm) ? '' : $searchTerm; ?>" />
			<input type="submit" class="visible-xs btn btn-default" name="search" value="Search" />
		</div>
		<input type="submit" class="hidden-xs btn btn-default" name="search" value="Search" />
	</div>
</form>


<div id="content" class="row">

<?php 
if(isset($_GET['search']))
{
	if(!empty($aPagePokemon))
	{
		echo "\n<hr>\n";
		echo $aPagingVars['pagingHtml'];
		echo getPokemonThumbHtml($aPagePokemon); 
		echo $aPagingVars['pagingHtml'];
	}
	else
	{
		echo "\n<hr>\n";
		echo '<p class="error-label"><label>No results.</label></p>';;
	}
}
?>

</div> <!-- end content -->
<?php
	include("includes/footer.php");
?>