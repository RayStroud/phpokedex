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
		$bGen1 = $_GET['g1'];
		$bGen2 = $_GET['g2'];
		$bGen3 = $_GET['g3'];
		$bGen4 = $_GET['g4'];
		$bGen5 = $_GET['g5'];
		$bGen6 = $_GET['g6'];
		$type1 = $_GET['t1'];
		$type2 = $_GET['t2'];
		$bstMod = $_GET['bstM'];
		$bstNum = $_GET['bstN'];
		$hpMod = $_GET['hpM'];
		$hpNum = $_GET['hpN'];
		$atkMod = $_GET['atkM'];
		$atkNum = $_GET['atkN'];
		$defMod = $_GET['defM'];
		$defNum = $_GET['defN'];
		$sp_atkMod = $_GET['sp_atkM'];
		$sp_atkNum = $_GET['sp_atkN'];
		$sp_defMod = $_GET['sp_defM'];
		$sp_defNum = $_GET['sp_defN'];
		$spdMod = $_GET['spdM'];
		$spdNum = $_GET['spdN'];
		$orderByColumn = $_GET['by'];
		$orderBySort = $_GET['sort'];
		//* DEBUG */ echo "<p>GEN: $bGen1 | $bGen2 | $bGen3 | $bGen4 | $bGen5 | $bGen6</p>";
		//* DEBUG */ echo "<p>TYPES: $type1 | $type2</p> ";
		//* DEBUG */ echo "<p>BST: $bstMod | $bstNum</p>";
		//* DEBUG */ echo "<p>HP: $hpMod | $hpNum</p>";
		//* DEBUG */ echo "<p>ATK: $atkMod | $atkNum</p>";
		//* DEBUG */ echo "<p>DEF: $defMod | $defNum</p>";
		//* DEBUG */ echo "<p>SAT: $sp_atkMod | $sp_atkNum</p>";
		//* DEBUG */ echo "<p>SDF: $sp_defMod | $sp_defNum</p>";
		//* DEBUG */ echo "<p>SPD: $spdMod | $spdNum</p>";

		//set the per page var
		$resultsPerPage = 120;
		$maxButtonsToShow = 7;
		
		//calculate whereSql
		$whereSql = calculateWhereSql($bGen1, $bGen2, $bGen3, $bGen4, $bGen5, $bGen6,
		$type1, $type2, 
		$bstMod, $bstNum, 
		$hpMod, $hpNum, 
		$atkMod, $atkNum, 
		$defMod, $defNum, 
		$sp_atkMod, $sp_atkNum, 
		$sp_defMod, $sp_defNum, 
		$spdMod, $spdNum);
		//* DEBUG */ echo "<p>whereSql: $whereSql</p>";
		
		//make orderBySql
		$orderBySql = "order by $orderByColumn $orderBySort";
		//* DEBUG */ echo "<p>orderBySql: $orderBySql</p>";
		
		//calc paging
		$aPagingVars = getPagingVars('pokemon', $whereSql, $thisPageNum, $resultsPerPage, $maxButtonsToShow);
		//* DEBUG */ echo '<pre>'; print_r($aPagingVars); echo '</pre>';
		
		//query the posts for the page
		$aFields = array('pid', 'img_name', 'pokedex_no', 'name', 'type1', 'type2', 'info', 'height', 'weight', 'ability1', 'ability2', 'abilityH', 'hp', 'atk', 'def', 'sp_atk', 'sp_def', 'spd', 'bst');
		$aPagePokemon = listPageResults('pokemon', $aFields, $whereSql, $orderBySql, $aPagingVars['limitSql']);
	}
?>

<h2 id="pageTitle">Advanced Search</h2>

<hr>

<div id="content" class="row">

<form role="form" class="form-horizontal" name="addForm" method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<!-- \/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\ -->
	<div class="form-group">
		<label class="col-md-2 col-sm-3 control-label">Generation:</label>
		<div class="col-lg-7 col-md-8 col-sm-6">
			<div class="checkbox-inline first-checkbox">
				<label><input type="checkbox" name="g1" value="1" <?php if(isset($_GET['search']) && empty($bGen1)){;}else{echo 'checked="checked"';} ?>>Gen I</label>
			</div>
			<div class="checkbox-inline">
				<label><input type="checkbox" name="g2" value="1" <?php if(isset($_GET['search']) && empty($bGen2)){;}else{echo 'checked="checked"';} ?>>Gen II</label>
			</div>
			<div class="checkbox-inline">
				<label><input type="checkbox" name="g3" value="1" <?php if(isset($_GET['search']) && empty($bGen3)){;}else{echo 'checked="checked"';} ?>>Gen III</label>
			</div>
			<div class="visible-sm visible-xs" style="height:0;"><br /></div>
			<div class="checkbox-inline first-checkbox">
				<label><input type="checkbox" name="g4" value="1" <?php if(isset($_GET['search']) && empty($bGen4)){;}else{echo 'checked="checked"';} ?>>Gen IV</label>
			</div>
			<div class="checkbox-inline">
				<label><input type="checkbox" name="g5" value="1" <?php if(isset($_GET['search']) && empty($bGen5)){;}else{echo 'checked="checked"';} ?>>Gen V</label>
			</div>
			<div class="checkbox-inline">
				<label><input type="checkbox" name="g6" value="1" <?php if(isset($_GET['search']) && empty($bGen6)){;}else{echo 'checked="checked"';} ?>>Gen VI</label>
			</div>
		</div>
	</div>
<!-- \/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\ -->
	<div class="form-group">
	</div>
<!-- \/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\ -->
	<div class="form-group">
		<label class="col-md-2 col-sm-3 control-label">Types:</label>
		<div class="col-lg-7 col-md-8 col-sm-6">
			<div class="col-md-3 col-sm-5 col-xs-7">
				<select class="form-control" name="t1">
					<option value="">None</option>
					<?php echo getTypeDropdownOptions($type1); ?>
				</select>
			</div>
			<div class="col-md-3 col-sm-5 col-xs-7">
				<select class="form-control" name="t2">
					<option value="">None</option>
					<?php echo getTypeDropdownOptions($type2); ?>
				</select>
			</div>
		</div>
	</div>
<!-- \/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\ -->
	<div class="form-group">
	</div>
<!-- \/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\ -->
	<div class="form-group">
		<label class="col-md-2 col-sm-3 control-label">Stats:</label>
		<div class="col-lg-7 col-md-8 col-sm-6">
			<!-- \/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\ -->
			<label class="col-md-1 col-sm-2 col-xs-12 control-label grey-label" for="hpM">HP:</label>
			<div class="col-md-3 col-sm-5 col-xs-7">
				<select class="form-control" name="hpM">
					<?php echo getStatModDropdownOptions($hpMod); ?>
				</select>
			</div>
			<div class="col-md-2 col-sm-4 col-xs-5">
				<input class="form-control" type="number" name="hpN" placeholder="#" value="<?php echo $hpNum; ?>" />
			</div>
			<!-- \/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\ -->
			<label class="col-md-1 col-sm-2 col-xs-12 control-label grey-label" for="atkM">Atk:</label>
			<div class="col-md-3 col-sm-5 col-xs-7">
				<select class="form-control" name="atkM">
					<?php echo getStatModDropdownOptions($atkMod); ?>
				</select>
			</div>
			<div class="col-md-2 col-sm-4 col-xs-5">
				<input class="form-control" type="number" name="atkN" placeholder="#" value="<?php echo $atkNum; ?>" />
			</div>
			<!-- \/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\ -->
			<label class="col-md-1 col-sm-2 col-xs-12 control-label grey-label" for="defM">Def:</label>
			<div class="col-md-3 col-sm-5 col-xs-7">
				<select class="form-control" name="defM">
					<?php echo getStatModDropdownOptions($defMod); ?>
				</select>
			</div>
			<div class="col-md-2 col-sm-4 col-xs-5">
				<input class="form-control" type="number" name="defN" placeholder="#" value="<?php echo $defNum; ?>" />
			</div>
			<!-- \/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\ -->
			<label class="col-md-1 col-sm-2 col-xs-12 control-label grey-label" for="sp_atkM">SAt:</label>
			<div class="col-md-3 col-sm-5 col-xs-7">
				<select class="form-control" name="sp_atkM">
					<?php echo getStatModDropdownOptions($sp_atkMod); ?>
				</select>
			</div>
			<div class="col-md-2 col-sm-4 col-xs-5">
				<input class="form-control" type="number" name="sp_atkN" placeholder="#" value="<?php echo $sp_atkNum; ?>" />
			</div>
			<!-- \/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\ -->
			<label class="col-md-1 col-sm-2 col-xs-12 control-label grey-label" for="sp_defM">SDf:</label>
			<div class="col-md-3 col-sm-5 col-xs-7">
				<select class="form-control" name="sp_defM">
					<?php echo getStatModDropdownOptions($sp_defMod); ?>
				</select>
			</div>
			<div class="col-md-2 col-sm-4 col-xs-5">
				<input class="form-control" type="number" name="sp_defN" placeholder="#" value="<?php echo $sp_defNum; ?>" />
			</div>
			<!-- \/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\ -->
			<label class="col-md-1 col-sm-2 col-xs-12 control-label grey-label" for="spdM">Spd:</label>
			<div class="col-md-3 col-sm-5 col-xs-7">
				<select class="form-control" name="spdM">
					<?php echo getStatModDropdownOptions($spdMod); ?>
				</select>
			</div>
			<div class="col-md-2 col-sm-4 col-xs-5">
				<input class="form-control" type="number" name="spdN" placeholder="#" value="<?php echo $spdNum; ?>" />
			</div>
			<!-- \/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\ -->
			<label class="col-md-1 col-sm-2 col-xs-12 control-label grey-label" for="bstM">BST:</label>
			<div class="col-md-3 col-sm-5 col-xs-7">
				<select class="form-control" name="bstM">
					<?php echo getStatModDropdownOptions($bstMod); ?>
				</select>
			</div>
			<div class="col-md-2 col-sm-4 col-xs-5">
				<input class="form-control" type="number" name="bstN" placeholder="#" value="<?php echo $bstNum; ?>" />
			</div>
		</div>
	</div>
<!-- \/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\ -->
	<div class="form-group">
	</div>
<!-- \/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\ -->
	<div class="form-group">
		<label class="col-md-2 col-sm-3 control-label">Order:</label>
		<div class="col-lg-7 col-md-8 col-sm-6">
			<div class="col-md-3 col-sm-5 col-xs-7">
				<select class="form-control" name="by">
					<?php echo getOrderByDropdownOptions($orderByColumn); ?>
				</select>
			</div>
			<div class="col-md-3 col-sm-6 col-xs-7">
				<select class="form-control" name="sort">
					<option value="asc"<?php echo ($orderBySort == 'asc') ? ' selected' : ''; ?>>A-Z / 1-9</option>
					<option value="desc"<?php echo ($orderBySort == 'desc') ? ' selected' : ''; ?>>Z-A / 9-1</option>
				</select>
			</div>
		</div>
	</div>
<!-- \/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\ -->
	<div class="form-group">
	</div>
<!-- \/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\ -->
	<div class="form-group">
		<label class="col-md-2 col-sm-3 control-label" for="search">&nbsp;</label>
		<div class="col-md-9 col-sm-8">
			<input class="col-lg-2 col-md-3 col-sm-4 col-xs-12 btn btn-default" type="submit" name="search" value="Search" />
		</div>
	</div>
<!-- \/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\ -->
	<div class="form-group">
	</div>
<!-- \/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\ -->
	<div class="form-group">
		<label class="col-md-2 col-sm-3 control-label">Try These Searches!</label>
		<div class="col-md-9 col-sm-8">
			<ul class="feat-search-list">
				<li><a href="advsearch.php?bstM=gt&bstN=600&by=spd&sort=desc&search=Search"><span class="glyphicon glyphicon-search"></span> High-Stat Pokemon ordered by Highest Speed</a></li>
				<li><a href="advsearch.php?g1=1&g2=1&g3=1&g4=1&g5=1&t1=Fairy&by=pokedex_no&sort=asc&search=Search"><span class="glyphicon glyphicon-search"></span> Fairy-type Pokemon not from Generation VI</a></li>
				<li><a href="advsearch.php?t1=Fighting&atkM=gt&atkN=120&by=bst&sort=desc&search=Search"><span class="glyphicon glyphicon-search"></span> Fighting-type Pokemon with High Attack, ordered by Highest Stats</a></li>
				<li><a href="advsearch.php?defM=gt&defN=100&sp_defM=gt&sp_defN=100&by=spd&sort=asc&search=Search"><span class="glyphicon glyphicon-search"></span> High Defense and Sp Defense Pokemon, ordered by Lowest Speed</a></li>
				<li><a href="advsearch.php?spdM=gt&spdN=100&bstM=lt&bstN=500&by=spd&sort=desc&search=Search"><span class="glyphicon glyphicon-search"></span> Low-Stat Pokemon with High Speed, ordered by Highest Speed</a></li>
			</ul>
		</div>
	</div>
<!-- \/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\ -->
</form>


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