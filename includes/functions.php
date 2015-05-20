<script>
function previewImage(input) 
{
	if (input.files && input.files[0]) 
	{
		var reader = new FileReader();
		
		reader.onload = function (e) 
		{
			$('#preview-new-image-img').attr('src', e.target.result);
			$('#preview-new-image').css("display", "block");
		}
		
		reader.readAsDataURL(input.files[0]);
	}
}
function wopen(url, name, w, h)
{
	//Fudge factors for window decoration space.
	w += 32;
	h += 96;
	var win = window.open(url, name, 'width=' + w + ', height=' + h + ', ' +
		'location=no, menubar=no, ' + 'status=no, toolbar=no, scrollbars=no, resizable=no');
	win.resizeTo(w, h);
	win.focus();
}
function updateAbility1Description()
{
	
}
</script>
<?php
function nl2p($string)
{
	$paragraphs = '';

	foreach (explode("\n", $string) as $line)
	{
		if (trim($line))
		{
			$paragraphs .= '<p>' . $line . '</p>';
		}
	}

	return $paragraphs;
}

//@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
//		DATEBASE QUERIES
//@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
function getPokemon($pid)
{
	//query
	$result = mysql_query("select * from pokemon where pid='$pid'") or die(mysql_error());
	
	//loop through
	if($row = mysql_fetch_array($result))
	{
		//pull on out
		$this['pid'] = $row['pid'];
		$this['img_name'] = $row['img_name'];
		$this['pokedex_no'] = $row['pokedex_no'];
		$this['name'] = $row['name'];
		$this['type1'] = $row['type1'];
		$this['type2'] = $row['type2'];
		$this['info'] = $row['info'];
		$this['height'] = $row['height'];
		$this['weight'] = $row['weight'];
		$this['ability1'] = $row['ability1'];
		$this['ability2'] = $row['ability2'];
		$this['abilityH'] = $row['abilityH'];
		$this['hp'] = $row['hp'];
		$this['atk'] = $row['atk'];
		$this['def'] = $row['def'];
		$this['sp_atk'] = $row['sp_atk'];
		$this['sp_def'] = $row['sp_def'];
		$this['spd'] = $row['spd'];
		$this['bst'] = $row['bst'];
		
		return $this;
	}
}

function getAbility($ability_id)
{
	//query
	$result = mysql_query("select * from ability where ability_id='$ability_id'") or die(mysql_error());
	
	//loop through
	if($row = mysql_fetch_array($result))
	{
		//pull on out
		$this['ability_id'] = $row['ability_id'];
		$this['name'] = $row['name'];
		$this['description'] = $row['description'];
		
		return $this;
	}
}

function listPokemon()
{
	//query
	$result = mysql_query('select * from pokemon order by pid') or die(mysql_error());
	
	//loop through
	while($row = mysql_fetch_array($result))
	{
		//pull on out
		$this['pid'] = $row['pid'];
		$this['img_name'] = $row['img_name'];
		$this['pokedex_no'] = $row['pokedex_no'];
		$this['name'] = $row['name'];
		$this['type1'] = $row['type1'];
		$this['type2'] = $row['type2'];
		$this['info'] = $row['info'];
		$this['height'] = $row['height'];
		$this['weight'] = $row['weight'];
		$this['ability1'] = $row['ability1'];
		$this['ability2'] = $row['ability2'];
		$this['abilityH'] = $row['abilityH'];
		$this['hp'] = $row['hp'];
		$this['atk'] = $row['atk'];
		$this['def'] = $row['def'];
		$this['sp_atk'] = $row['sp_atk'];
		$this['sp_def'] = $row['sp_def'];
		$this['spd'] = $row['spd'];
		$this['bst'] = $row['bst'];
		
		//add to array
		$aAll[] = $this;
	}
	
	return $aAll;
}

function listAbilities()
{
	//query
	$result = mysql_query('select * from ability order by name asc') or die(mysql_error());
	
	//loop through
	while($row = mysql_fetch_array($result))
	{
		//pull on out
		$this['ability_id'] = $row['ability_id'];
		$this['name'] = $row['name'];
		$this['description'] = $row['description'];
		
		//add to array
		$aAll[] = $this;
	}
	
	return $aAll;
}

function getAbilityDescription($ability_id)
{
	$result = mysql_query("select description from ability where ability_id = '$ability_id'") or die(mysql_error());
	
	if($row = mysql_fetch_array($result))
	{
		return $row['description'];
	}
}

function getAbilityName($ability_id)
{
	$result = mysql_query("select name from ability where ability_id = '$ability_id'") or die(mysql_error());
	
	if($row = mysql_fetch_array($result))
	{
		return $row['name'];
	}
}

function getPokemonByPartialName($partialName)
{
	//query
	$result = mysql_query("select * from pokemon where name like '$partialName'") or die(mysql_error());
	
	//loop through
	if($row = mysql_fetch_array($result))
	{
		//pull on out
		$this['pid'] = $row['pid'];
		$this['img_name'] = $row['img_name'];
		$this['pokedex_no'] = $row['pokedex_no'];
		$this['name'] = $row['name'];
		$this['type1'] = $row['type1'];
		$this['type2'] = $row['type2'];
		$this['info'] = $row['info'];
		$this['height'] = $row['height'];
		$this['weight'] = $row['weight'];
		$this['ability1'] = $row['ability1'];
		$this['ability2'] = $row['ability2'];
		$this['abilityH'] = $row['abilityH'];
		$this['hp'] = $row['hp'];
		$this['atk'] = $row['atk'];
		$this['def'] = $row['def'];
		$this['sp_atk'] = $row['sp_atk'];
		$this['sp_def'] = $row['sp_def'];
		$this['spd'] = $row['spd'];
		$this['bst'] = $row['bst'];
		
		return $this;
	}
}

function getRandomPokemon()
{
	//query
	$result = mysql_query("select * from pokemon order by rand() limit 1") or die(mysql_error());
	
	//loop through
	if($row = mysql_fetch_array($result))
	{
		//pull on out
		$this['pid'] = $row['pid'];
		$this['img_name'] = $row['img_name'];
		$this['pokedex_no'] = $row['pokedex_no'];
		$this['name'] = $row['name'];
		$this['type1'] = $row['type1'];
		$this['type2'] = $row['type2'];
		$this['info'] = $row['info'];
		$this['height'] = $row['height'];
		$this['weight'] = $row['weight'];
		$this['ability1'] = $row['ability1'];
		$this['ability2'] = $row['ability2'];
		$this['abilityH'] = $row['abilityH'];
		$this['hp'] = $row['hp'];
		$this['atk'] = $row['atk'];
		$this['def'] = $row['def'];
		$this['sp_atk'] = $row['sp_atk'];
		$this['sp_def'] = $row['sp_def'];
		$this['spd'] = $row['spd'];
		$this['bst'] = $row['bst'];
		
		return $this;
	}
}

//@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
//		DROPDOWNS
//@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
function getPokemonDropdownOptions($rootUrl, $selectedId)
{
	//get from db
	$aPokemon = listPokemon();
	
	//loop through pokemon
	foreach($aPokemon as $pokemon)
	{
		//pull out vars
		$thisId = $pokemon['pid'];
		$thisDexNo = $pokemon['pokedex_no'];
		$thisName = $pokemon['name'];
		
		//if linking to a page
		if(!empty($rootUrl))
		{
			//set value with link
			$dropdownOptions .= "\n<option value=\"$rootUrl?id=$thisId\"";
		}
		else
		{
			//set value with id
			$dropdownOptions .= "\n<option value=\"$thisId\"";
		}
		
		//if this id is selected
		if($selectedId == $thisId)
		{
			//select option in dropdown
			$dropdownOptions .= ' selected';
		}
		
		//set text
		$dropdownOptions .= ">[$thisDexNo] $thisName</option>";
	}
	$dropdownOptions .= "\n\n";	
	return $dropdownOptions;
}

function getAbilityDropdownOptions($rootUrl, $selectedId)
{
	//get abilities
	$aAbilities = listAbilities();
	
	foreach($aAbilities as $thisAbility)
	{
		//pull out vars
		$thisId = $thisAbility['ability_id'];
		$thisName = $thisAbility['name'];
		
		//if linking to a page
		if(!empty($rootUrl))
		{
			//set value with link
			$dropdownOptions .= "\n<option value=\"$rootUrl?id=$thisId\"";
		}
		else
		{
			//set value with name
			$dropdownOptions .= "\n<option value=\"$thisId\"";
		}
		
		//if this ability is selected
		if($selectedId == $thisId)
		{
			//select option in dropdown
			$dropdownOptions .= ' selected';
		}
		
		//set text
		$dropdownOptions .= ">$thisName</option>";
	}
	$dropdownOptions .= "\n\n";	
	return $dropdownOptions;
}

function getTypeDropdownOptions($selectedType)
{
	$aTypes = array('Normal', 'Fire', 'Water', 'Electric', 'Grass', 'Ice', 'Fighting', 'Poison', 'Ground', 'Flying', 'Psychic', 'Bug', 'Rock', 'Ghost', 'Dragon', 'Dark', 'Steel', 'Fairy');
	
	foreach($aTypes as $type)
	{
		$dropdownOptions .= "\n<option value=\"$type\"";
		if($selectedType == $type)
		{
			//select option in dropdown
			$dropdownOptions .= ' selected';
		}
		$dropdownOptions .= ">$type</option>";
	}
	$dropdownOptions .= "\n\n";	
	return $dropdownOptions;
}

function getStatModDropdownOptions($selectedMod)
{
	$aMods['gt'] = 'Above';
	$aMods['lt'] = 'Below';
	$aMods['eq'] = 'Equals';
	
	foreach($aMods as $val => $text)
	{
		$dropdownOptions .= "\n<option value=\"$val\"";
		if($selectedMod == $val)
		{
			//select option in dropdown
			$dropdownOptions .= ' selected';
		}
		$dropdownOptions .= ">$text</option>";
	}
	$dropdownOptions .= "\n\n";
	return $dropdownOptions;
}

function getOrderByDropdownOptions($selectedColumnName)
{
	$aColumns['pokedex_no'] = '#';
	$aColumns['name'] = 'Name';
	$aColumns['height'] = 'Height';
	$aColumns['weight'] = 'Weight';
	$aColumns['bst'] = 'BST';
	$aColumns['hp'] = 'HP';
	$aColumns['atk'] = 'Attack';
	$aColumns['def'] = 'Defense';
	$aColumns['sp_atk'] = 'Sp Atk';
	$aColumns['sp_def'] = 'Sp Def';
	$aColumns['spd'] = 'Speed';
	
	foreach($aColumns as $columnName => $dropdownText)
	{
		$dropdownOptions .= "\n<option value=\"$columnName\"";
		if($selectedColumnName == $columnName)
		{
			//select option in dropdown
			$dropdownOptions .= ' selected';
		}
		$dropdownOptions .= ">$dropdownText</option>";
	}
	$dropdownOptions .= "\n\n";
	return $dropdownOptions;
}

//@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
//		PAGING
//@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
function getPagingVars($tableName, $whereSql, $thisPageNum, $resultsPerPage, $maxButtonsToShow)
{
	//calc how many results there are
	$countResult = mysql_query ("select count(*) from $tableName $whereSql");
	$nResults = mysql_result($countResult, 0);

	//if there are more results than the page can hold
	if($nResults > $resultsPerPage)
	{
		//calculate the page splits, and leftover results on last page
		$leftoverResultsOnLastPage = round($nResults % $resultsPerPage, 0);
		$pageSplits = round(($nResults - $leftoverResultsOnLastPage)/$resultsPerPage, 0);
		
		//calc num of pages, based on if results fit perfectly without leftovers
		$nPages = ($leftoverResultsOnLastPage == 0) ? $pageSplits : $pageSplits + 1;
		
		//if there are more pages than pagination max
		if($nPages > ($maxButtonsToShow - 2) )
		{
			//calculate the limit of how many pages to see before and after the current page
			$pageSpreadLimit = ceil($maxButtonsToShow / 2);
			//* DEBUG */ echo "<p>page $thisPageNum of $nPages, max $maxButtonsToShow pages with $pageSpreadLimit spread, $resultsPerPage/page</p>";
			
			//if first page, disable previous button, start at pg 1
			if($thisPageNum == 1)
			{
				$endPage = $maxButtonsToShow - 2;
				$pagingHtml = getPagingHtml($thisPageNum, 1, $endPage, $nPages, false, false, true, true);
			}
			//if last page, disable next button, end at last page
			else if($thisPageNum == $nPages)
			{
				$startPage = $nPages - ($maxButtonsToShow - 3);
				$pagingHtml = getPagingHtml($thisPageNum, $startPage, $nPages, $nPages, true, true, false, false);
			}
			//if not first page, but before the page spread limit, start at pg 1
			else if($thisPageNum < $pageSpreadLimit)
			{
				$endPage = $maxButtonsToShow - 3;
				$pagingHtml = getPagingHtml($thisPageNum, 1, $endPage, $nPages, false, true, true, true);
			}
			//if not last page, but within spread limit of last page, end at last page
			else if($thisPageNum > ($nPages - ($pageSpreadLimit - 1) ) )
			{
				$startPage = $nPages - ($maxButtonsToShow - 4);
				$pagingHtml = getPagingHtml($thisPageNum, $startPage, $nPages, $nPages, true, true, true, false);
			}
			//if beyond the spread limits, keep page in the middle with spread-limit on each side
			else
			{
				$startPage = $thisPageNum - ($pageSpreadLimit - 3);
				$endPage = $thisPageNum + ($pageSpreadLimit - 3);
				$pagingHtml = getPagingHtml($thisPageNum, $startPage, $endPage, $nPages, true, true, true, true);
			}
		}
		//if there are not more pages than pagination max
		else
		{
			//if on the first page, disable previous button
			if($thisPageNum == 1)
			{	
				$pagingHtml = getPagingHtml($thisPageNum, 1, $nPages, $nPages, false, true, true, false);
			}
			//if on last page, disable last button
			else if($thisPageNum == $nPages)
			{
				$pagingHtml = getPagingHtml($thisPageNum, 1, $nPages, $nPages, false, true, true, false);
			}
			//if neither, print previous, next, and buttons for all pages
			else
			{
				$pagingHtml = getPagingHtml($thisPageNum, 1, $nPages, $nPages, false, true, true, false);
			}
		}
		
		//make query string limits
		$firstResultOnPage = ($thisPageNum*$resultsPerPage)-$resultsPerPage;
		$limitSql = "limit $firstResultOnPage, $resultsPerPage";
	}
	//if the page can hold all the results
	else
	{
		//no pages needed, skip pagination code
	
		//make query string limits
		$limitSql = "limit 0, $resultsPerPage";
	}
	
	//prepare return values
	$aPagingVars['limitSql'] = $limitSql;
	$aPagingVars['pagingHtml'] = $pagingHtml;
	
	return $aPagingVars;
}

function getPagingHtml($thisPageNum, $startPage, $endPage, $lastPage, $bShowFirst, $bShowPrevious, $bShowNext, $bShowLast)
{
	//* DEBUG */ echo "<p>pg$thisPageNum. from $start to $end.";
	//* DEBUG */ if(!$bDisablePrevious){echo ' prev. ';}
	//* DEBUG */ if(!$bDisableNext){echo ' next. ';}
	//* DEBUG */ echo '</p>';
		
	//get url
	$rootURL = $_SERVER['REQUEST_URI'];
	
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////take out all instances of ?pg=#### or &pg=#####
	
	//if there are already query strings
	if (parse_url($rootURL, PHP_URL_QUERY))
	{
		//add to url query with &
		$urlQueryStarter = '&';
	}
	//if there are no query strings already
	else
	{
		//start a url query string with ?
		$urlQueryStarter = '?';
	}

	//start pagingHtml code
	$pagingHtml = "\n" . '<div class="paging"><ul class="pagination pagination-sm">';
	
	//FIRST button
	if($bShowFirst)
	{	
		$pagingHtml .= "\n\t" . '<li><a href="' . $rootURL . $urlQueryStarter . 'pg=1">&laquo;</a></li>';
	}
	
	//PREVIOUS button
	if($bShowPrevious)
	{	
		$previousPage = $thisPageNum - 1;
		$pagingHtml .= "\n\t" . '<li><a href="' . $rootURL . $urlQueryStarter . 'pg=' . $previousPage . '">&lt;</a></li>';
	}

	//loop through from start to end
	for($i = $startPage; $i <= $endPage; $i++)
	{
		//if not current page number
		if($i != $thisPageNum)
		{
			$pagingHtml .= "\n\t" . '<li><a href="' . $rootURL . $urlQueryStarter . 'pg=' . $i . '">' . $i . '</a></li>';
		}
		//if current page number
		else
		{
			$pagingHtml .= "\n\t" . '<li class="active"><a href="#">' . $thisPageNum . '</a></li>';
		}
	}
	
	//NEXT button
	if($bShowNext)
	{
		$nextPage = $thisPageNum + 1;
		$pagingHtml .= "\n\t" . '<li><a href="' . $rootURL . $urlQueryStarter . 'pg=' . $nextPage . '">&gt;</a></li>';
	}
	
	//LAST BUTTON
	if($bShowLast)
	{
		$pagingHtml .= "\n\t" . '<li><a href="' . $rootURL . $urlQueryStarter . 'pg=' . $lastPage . '">&raquo;</a></li>';
	}
			
	//end pagingHtml code
	$pagingHtml .= "\n" . '</ul></div>' . "\n\n";
	
	return $pagingHtml;
}

function listPageResults($tableName, $aFields, $whereSql, $orderBySql, $limitSql)
{
	//query
	$results = mysql_query("select * from $tableName $whereSql $orderBySql $limitSql") or die(mysql_error());
	
	//loop through and extract results
	while($row = mysql_fetch_array($results))
	{
		//loop through and extract fields
		foreach($aFields as $field)
		{
			$result[$field] = $row[$field];
		}
		
		//add to array
		$aResults[] = $result;
	}
	
	return $aResults;
}


//@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
//		SEARCH
//@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
function calculateWhereSql($bGen1, $bGen2, $bGen3, $bGen4, $bGen5, $bGen6, 
	$type1, $type2, 
	$bstMod, $bstNum, 
	$hpMod, $hpNum, 
	$atkMod, $atkNum, 
	$defMod, $defNum, 
	$sp_atkMod, $sp_atkNum, 
	$sp_defMod, $sp_defNum, 
	$spdMod, $spdNum)
{
	//////////////////////////////////////////////////////////////////////////////////////////////////////
	//	GENERATIONS
	//////////////////////////////////////////////////////////////////////////////////////////////////////
	$aGenerationsClauses = array();
	
	if(!empty($bGen1))
	{
		array_push($aGenerationsClauses, "pokedex_no between '1' and '151'");
	}
	if(!empty($bGen2))
	{
		array_push($aGenerationsClauses, "pokedex_no between '152' and '251'");
	}
	if(!empty($bGen3))
	{
		array_push($aGenerationsClauses, "pokedex_no between '153' and '386'");
	}
	if(!empty($bGen4))
	{
		array_push($aGenerationsClauses, "pokedex_no between '387' and '493'");
	}
	if(!empty($bGen5))
	{
		array_push($aGenerationsClauses, "pokedex_no between '494' and '649'");
	}
	if(!empty($bGen6))
	{
		array_push($aGenerationsClauses, "pokedex_no between '650' and '718'");
	}
	
	foreach($aGenerationsClauses as $index => $clause)
	{
		//for first item, we don't use OR
		if($index == 0)
		{
			$generationsSql .= $clause;
		}
		//for every other item, we use OR
		else
		{
			$generationsSql .= ' OR ' . $clause;
		}
	}
	
	//////////////////////////////////////////////////////////////////////////////////////////////////////
	//	TYPES
	//////////////////////////////////////////////////////////////////////////////////////////////////////
	$aTypesClauses = array();
	
	//if user selected both types
	if(!empty($type1) && !empty($type2))
	{
		//if selected the same type for both
		if($type1 == $type2)
		{
			array_push($aTypesClauses, "type1 = '$type1' or type2 = '$type2'");
		}
		//if selected different types for both
		else
		{
			array_push($aTypesClauses, "(type1 = '$type1' and type2 = '$type2') or (type1 = '$type2' and type2 = '$type1')");
		}
	}
	//if user did not select both
	else
	{
		//if user selected just type1
		if(!empty($type1))
		{
			array_push($aTypesClauses, "type1 = '$type1' or type2 = '$type1'");
		}
		//if user selected just type2
		if(!empty($type2))
		{
			array_push($aTypesClauses, "type1 = '$type2' or type2 = '$type2'");
		}
	}
	
	foreach($aTypesClauses as $index => $clause)
	{
		//for first item, we don't use OR
		if($index == 0)
		{
			$typesSql .= $clause;
		}
		//for every other item, we use OR
		else
		{
			$typesSql .= ' OR ' . $clause;
		}
	}
	
	//////////////////////////////////////////////////////////////////////////////////////////////////////
	//	STATS
	//////////////////////////////////////////////////////////////////////////////////////////////////////
	$aStatsClauses = array();
	
	if(!empty($hpNum))
	{
		array_push($aStatsClauses, getModSql('hp', $hpMod, $hpNum));
	}
	if(!empty($atkNum))
	{
		array_push($aStatsClauses, getModSql('atk', $atkMod, $atkNum));
	}
	if(!empty($defNum))
	{
		array_push($aStatsClauses, getModSql('def', $defMod, $defNum));
	}
	if(!empty($sp_atkNum))
	{
		array_push($aStatsClauses, getModSql('sp_atk', $sp_atkMod, $sp_atkNum));
	}
	if(!empty($sp_defNum))
	{
		array_push($aStatsClauses, getModSql('sp_def', $sp_defMod, $sp_defNum));
	}
	if(!empty($spdNum))
	{
		array_push($aStatsClauses, getModSql('spd', $spdMod, $spdNum));
	}
	if(!empty($bstNum))
	{
		array_push($aStatsClauses, getModSql('bst', $bstMod, $bstNum));
	}
	
	foreach($aStatsClauses as $index => $clause)
	{
		//for first item, we don't use AND
		if($index == 0)
		{
			$statsSql .= $clause;
		}
		//for every other item, we use OR
		else
		{
			$statsSql .= ' AND ' . $clause;
		}
	}
	
	//////////////////////////////////////////////////////////////////////////////////////////////////////
	//	MAKE WHERE CLAUSE
	//////////////////////////////////////////////////////////////////////////////////////////////////////
	
	//GO THROUGH EACH ONE TO FIND OUT WHERE TO PUT THE 'WHERE'
	//if user selected some generations
	if(!empty($generationsSql))
	{
		$whereSql .= "WHERE ($generationsSql) ";
	}
	//if user did not select some generations
	else
	{
		//if user selected some types
		if(!empty($typesSql))
		{
			$whereSql .= "WHERE ($typesSql) ";
		}
		//if user did not select some types
		else
		{
			//if user selected some stats
			if(!empty($statsSql))
			{
				$whereSql .= "WHERE ($statsSql) ";
			}
			//if user selected nothing
			else
			{
				$whereSql .= "WHERE 1";
			}
		}
	}
	
	//ADD ON THE OTHERS IF THERE ARE ANY
	if(!empty($typesSql))
	{
		$whereSql .= " AND ($typesSql) ";
	}
	
	if(!empty($statsSql))
	{
		$whereSql .= " AND ($statsSql) ";
	}

	return $whereSql;
}

function getModSql($columnName, $mod, $num)
{
	$sql = '';
	switch($mod)
	{
		case 'gt':
			$sql = "$columnName > '$num'";
			break;
		case 'lt':
			$sql = "$columnName < '$num'";
			break;
		default:
			$sql = "$columnName = '$num'";
			break;
	}
	return $sql;
}


//@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
// 		DISPLAY
//@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
function getPokemonThumbHtml($aPokemon)
{
	//make var for storing output
	$pokemonHtml = "\n"	. '<div class="search-results">';
	
	foreach($aPokemon as $pokemon)
	{
		$pokemonHtml .= "\n\t"	. '<div class="search-thumb-pokemon">';
		$pokemonHtml .= "\n\t\t"		. '<a href="view.php?id=' . $pokemon['pid'] . '"><span class="link-spanner"></span></a>';
		$pokemonHtml .= "\n\t\t\t"	. '<div class="search-thumb-pokedex_no">#' . $pokemon['pokedex_no'] . '</div>';
		$pokemonHtml .= "\n\t\t\t"	. '<div class="search-thumb-image"><img class="search-thumb-image-img img-thumbnail" src="images/square96/' . $pokemon['img_name'] . '" /></div>';
		$pokemonHtml .= "\n\t\t\t"	. '<div class="search-thumb-types">' .
			'<span class="element-type type-small type-' . $pokemon['type1'] . '">' . 
				$pokemon['type1'] . '</span> ';
		if(!empty($pokemon['type2']))
		{
			$pokemonHtml .= '<span class="element-type type-small type-' . $pokemon['type2'] . '">' .
				$pokemon['type2'] . '</span>';
		}
		$pokemonHtml .= '</div>';
		$pokemonHtml .= "\n\t\t\t"	. '<div class="search-thumb-name"><h5>' . $pokemon['name'] . '</h5></div>';
		$pokemonHtml .= "\n\t"	. '</div>';
	}
	
	$pokemonHtml .= "\n\t"	. '<div class="clearfix">';
	$pokemonHtml .= "\n"	. '</div>';
	$pokemonHtml .= "\n\n";
	
	return $pokemonHtml;
}

function getPokemonSummaryHtml($aPokemon)
{
	//make var for storing output
	$pokemonHtml = "\n"	. '<div class="search-results">';
	
	foreach($aPokemon as $pokemon)
	{
		$pokemonHtml .= "\n\t"	. '<div class="search-summary-pokemon">';
		$pokemonHtml .= "\n\t\t"		. '<a href="view.php?id=' . $pokemon['pid'] . '"><span class="link-spanner"></span></a>';
		$pokemonHtml .= "\n\t\t\t"	. '<span class="search-summary-image"><img class="search-summary-image-img img-thumbnail" src="images/square50/' . $pokemon['img_name'] . '" /></span>';
		$pokemonHtml .= "\n\t\t\t"	. '<span class="search-summary-types">' .
			'<span class="element-type type-small type-' . $pokemon['type1'] . '">' . 
				$pokemon['type1'] . '</span> ';
		if(!empty($pokemon['type2']))
		{
			$pokemonHtml .= '<span class="element-type type-small type-' . $pokemon['type2'] . '">' .
				$pokemon['type2'] . '</span>';
		}
		$pokemonHtml .= '</span>';
		$pokemonHtml .= "\n\t\t\t"	. '<span class="search-summary-pokedex_no">#' . $pokemon['pokedex_no'] . '</span>';
		$pokemonHtml .= "\n\t\t\t"	. '<span class="search-summary-name"><h5>' . $pokemon['name'] . '</h5></div>';
		$pokemonHtml .= "\n\t"	. '</span>';
	}
	
	$pokemonHtml .= "\n"	. '</div>';
	$pokemonHtml .= "\n\n";
	
	return $pokemonHtml;
}

function getTypeHtml($type)
{
	return '<div class="element-type type-' . strtolower($type) . '">' . $type . '</div>';
}

function getStatBarDivHtml($stat, $val)
{
	$max['hp'] = 255; 		$min['hp'] = 1;
	$max['atk'] = 190; 		$min['atk'] = 5;
	$max['def'] = 230; 		$min['def'] = 5;
	$max['sp_atk'] = 194; 	$min['sp_atk'] = 10;
	$max['sp_def'] = 230; 	$min['sp_def'] = 20;
	$max['spd'] = 180; 		$min['spd'] = 5;
	$max['bst'] = 780; 		$min['bst'] = 180;
	
	$percent = ( ($val - $min[$stat]) / ($max[$stat] - $min[$stat]) ) * 100;
	
	if($percent < 34)
	{
		$qualifier = 'low';
	}
	else if($percent > 66)
	{
		$qualifier = 'high';		
	}
	else
	{
		$qualifier = 'med';		
	}
	
	$statbarDivHtml = '<div class="stat-bar stat-bar-' . $qualifier . '" style="width:' . $percent . '%;"></div>';
	
	return $statbarDivHtml;
}

function getTypeAbbr($type)
{
	$typeAbbr = '';
	switch($type)
	{
		case 'Normal':
			$typeAbbr = 'NOR';
			break;
		case 'Fire':
			$typeAbbr = 'FIR';
			break;
		case 'Water':
			$typeAbbr = 'WAT';
			break;
		case 'Electric':
			$typeAbbr = 'ELE';
			break;
		case 'Grass':
			$typeAbbr = 'GRA';
			break;
		case 'Ice':
			$typeAbbr = 'ICE';
			break;
		case 'Fighting':
			$typeAbbr = 'FIG';
			break;
		case 'Poison':
			$typeAbbr = 'POI';
			break;
		case 'Ground':
			$typeAbbr = 'GRO';
			break;
		case 'Flying':
			$typeAbbr = 'FLY';
			break;
		case 'Psychic':
			$typeAbbr = 'PSY';
			break;
		case 'Bug':
			$typeAbbr = 'BUG';
			break;
		case 'Rock':
			$typeAbbr = 'ROC';
			break;
		case 'Ghost':
			$typeAbbr = 'GHO';
			break;
		case 'Dragon':
			$typeAbbr = 'DRG';
			break;
		case 'Dark':
			$typeAbbr = 'DRK';
			break;
		case 'Steel':
			$typeAbbr = 'STE';
			break;
		case 'Fairy':
			$typeAbbr = 'FAI';
			break;
	}
	return $typeAbbr;
}

//@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
//		ADMIN
//@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
function validatePokemon($pokedex_no, $name, $height, $weight, $hp, $atk, $def, $sp_atk, $sp_def, $spd)
{
	$aMessages['bValid'] = true;
	
	if(!is_numeric($pokedex_no))
	{
		$aMessages['pokedex_no'] = '<p class="error-label"><label>*Must be a #</label></p>';
		$aMessages['bValid'] = false;
	}
	
	if(empty($name))
	{
		$aMessages['name'] = '<p class="error-label"><label>*Required</label></p>';
		$aMessages['bValid'] = false;
	}
	else if(strlen($name) > 30)
	{
		$aMessages['name'] = '<p class="error-label"><label>*Less than 30 characters</label></p>';
		$aMessages['bValid'] = false;
	}
	
	if(!is_numeric($height))
	{
		$aMessages['height'] = '<p class="error-label"><label>*Must be a #</label></p>';
		$aMessages['bValid'] = false;
	}
	
	if(!is_numeric($weight))
	{
		$aMessages['weight'] = '<p class="error-label"><label>*Must be a #</label></p>';
		$aMessages['bValid'] = false;
	}
	
	if(!is_numeric($hp))
	{
		$aMessages['hp'] = '<p class="error-label"><label>*Must be a #</label></p>';
		$aMessages['bValid'] = false;
	}
	
	if(!is_numeric($atk))
	{
		$aMessages['atk'] = '<p class="error-label"><label>*Must be a #</label></p>';
		$aMessages['bValid'] = false;
	}
	
	if(!is_numeric($def))
	{
		$aMessages['def'] = '<p class="error-label"><label>*Must be a #</label></p>';
		$aMessages['bValid'] = false;
	}
	
	if(!is_numeric($sp_atk))
	{
		$aMessages['sp_atk'] = '<p class="error-label"><label>*Must be a #</label></p>';
		$aMessages['bValid'] = false;
	}
	
	if(!is_numeric($sp_def))
	{
		$aMessages['sp_def'] = '<p class="error-label"><label>*Must be a #</label></p>';
		$aMessages['bValid'] = false;
	}
	
	if(!is_numeric($spd))
	{
		$aMessages['spd'] = '<p class="error-label"><label>*Must be a #</label></p>';
		$aMessages['bValid'] = false;
	}
	
	return $aMessages;
	//VALID:	bValid 	
	//ERRORS:	pokedex_no, name, info, height, weight, hp, atk, def, sp_atk, sp_def, spd
}

function addPokemon($pokedex_no, $name, $type1, $type2, $info, $height, $weight, $ability1, $ability2, $abilityH, $hp, $atk, $def, $sp_atk, $sp_def, $spd)
{
	//calculate BST
	$bst = $hp + $atk + $def + $sp_atk + $sp_def + $spd;
	
	//if file is uploaded
	if(isset($_FILES['image']) && $_FILES['image']['size'] > 0)
	{
		//upload image
		$aMessages['aImageMessages'] = uploadImage();
		
		//if upload was successful
		if($aMessages['aImageMessages']['confirm'])
		{
			$img_name = $_FILES['image']['name'];
		}
		//if upload failed
		else
		{
			$img_name = null;
		}
	}
	//if file is not uploaded
	else
	{
		$img_name = null;
		$aMessages['aImageMessages']['upload'] = '<p class="error-label"><label>No image was submitted.</label></p>';
	}
	
	//check for null variables
	if(empty($type2)){$type2 = null;}
	if(empty($ability2)){$ability2 = null;}
	if(empty($abilityH)){$abilityH = null;}
	
	//start insert statement
	$sql = 'insert into pokemon (pokedex_no, name, type1, info, height, weight, ability1, ';
	
	//add nullables
	if(!empty($img_name)){$sql .= 'img_name, ';}
	if(!empty($type2)){$sql .= 'type2, ';}
	if(!empty($ability2)){$sql .= 'ability2, ';}
	if(!empty($abilityH)){$sql .= 'abilityH, ';}
	
	//insert values
	$sql .= "hp, atk, def, sp_atk, sp_def, spd, bst) values ('$pokedex_no', '$name', '$type1', '$info', '$height', '$weight', '$ability1', ";
	
	//add nullables
	if(!empty($img_name)){$sql .= "'$img_name', ";}
	if(!empty($type2)){$sql .= "'$type2', ";}
	if(!empty($ability2)){$sql .= "'$ability2', ";}
	if(!empty($abilityH)){$sql .= "'$abilityH', ";}
	
	//finish sql statement
	$sql .= "'$hp', '$atk', '$def', '$sp_atk', '$sp_def', '$spd', '$bst')";
	//* DEBUG */ echo $sql;
	
	//execute sql statement
	mysql_query($sql) or die(mysql_error());
	
	//message
	$aMessages['confirm'] = '<p class="confirm-label"><label>Pokemon added.</label></p>';
	
	return $aMessages;
	//CONFIRM:	confirm
	
	//aImageMessages
	//ERRORS:	filetype, size, original, resize, upload
	//CONFIRM:	confirm
}

function addAbility($name, $description)
{
	//start insert statement
	$sql = "insert into ability (name, description) values ('$name', '$description')";
	//* DEBUG */ echo $sql;
	
	//execute sql statement
	mysql_query($sql) or die(mysql_error());
	
	//message
	$aMessages['confirm'] = '<p class="confirm-label"><label>Ability added.</label></p>';
	
	return $aMessages;
	//CONFIRM:	confirm
}

function editPokemon($pid, $pokedex_no, $name, $type1, $type2, $info, $height, $weight, $ability1, $ability2, $abilityH, $hp, $atk, $def, $sp_atk, $sp_def, $spd)
{
	//calculate BST
	$bst = $hp + $atk + $def + $sp_atk + $sp_def + $spd;
	
	//if new file is uploaded
	if(isset($_FILES['image']) && $_FILES['image']['size'] > 0)
	{
		//upload image
		$aMessages['aImageMessages'] = uploadImage();
		
		//if upload was successful
		if($aMessages['aImageMessages']['confirm'])
		{
			$img_name = $_FILES['image']['name'];
		}
		//if upload failed
		else
		{
			$img_name = null;
		}
	}
	//if new file is not uploaded
	else
	{
		$img_name = null;
	}
	
	//check for null variables
	if(empty($type2)){$type2 = null;}
	if(empty($ability2)){$ability2 = null;}
	if(empty($abilityH)){$abilityH = null;}
	
	//start update statement
	$sql = "update pokemon set pokedex_no='$pokedex_no', name='$name', type1='$type1', info='$info', height='$height', weight='$weight', ability1='$ability1', ";
	
	//add nullables
	if(!empty($img_name)){$sql .= "img_name='$img_name', ";}
	if(!empty($type2)){$sql .= "type2='$type2', ";}
	if(!empty($ability2)){$sql .= "ability2='$ability2', ";}
	if(!empty($abilityH)){$sql .= "abilityH='$abilityH', ";}
	
	//finish update statement
	$sql .= "hp='$hp', atk='$atk', def='$def', sp_atk='$sp_atk', sp_def='$sp_def', spd='$spd', bst='$bst' where pid='$pid' limit 1";
	
	//* DEBUG */ echo $sql;
	
	//execute sql statement
	mysql_query($sql) or die(mysql_error());
	
	//message
	$aMessages['confirm'] = '<p class="confirm-label"><label>Pokemon information updated.</label></p>';
	
	return $aMessages;
	//CONFIRM:	confirm
	
	//aImageMessages
	//ERRORS:	filetype, size, original, resize
	//CONFIRM:	confirm
}

function editAbility($ability_id, $name, $description)
{
	//start update statement
	$sql = "update ability set name='$name', description='$description' where ability_id='$ability_id' limit 1";
	//* DEBUG */ echo $sql;
	
	//execute sql statement
	mysql_query($sql) or die(mysql_error());
	
	//message
	$aMessages['confirm'] = '<p class="confirm-label"><label>Ability information updated.</label></p>';
	
	return $aMessages;
	//CONFIRM:	confirm
}

function uploadImage()
{
	//* DEBUG */ echo '<pre>'; print_r($_FILES); echo '</pre>';
	
	//directories to move files
	$originalFolder = '../images/original/';
	//$aSquareDimensions = array(50, 96, 100, 125, 150, 240, 260, 290, 350, 500, 720);
	$aSquareDimensions = array(96, 290);

	//validation vars
	$bValid = true;
	
	// validate file type
	if( !($_FILES['image']['type'] == "image/jpeg" 
		|| $_FILES['image']['type'] == "image/png") )
	{
		$aMessages['filetype'] = '<p class="error-label"><label>Image was not saved. Incorrect file-type. Please upload .jpg or .png files only.</label></p>';
		$bValid = false;
	}
	
	//validate file size
	if( $_FILES['image']['size'] > 5000000 )
	{
		$aMessages['size'] = '<p class="error-label"><label>Image was not saved. File size is too large. Please upload files smaller than 5MB.</label></p>';
		$bValid = false;
	}
	
	if($bValid == true)
	{
		//if not uploaded successfully
		if( ! move_uploaded_file($_FILES['image']['tmp_name'], $originalFolder.$_FILES['image']['name'] ))
		{
			$aMessages['original'] .= '<p class="error-label"><label>Image could not be saved.</label></p>';
		}
		else
		{
			//store path to original file
			$storedImagedFilepath = $originalFolder.$_FILES['image']['name'];
			
			//make resized versions
			foreach($aSquareDimensions as $dimensions)
			{
				//make folder path for resized image
				$thisFolderPath = '../images/square' . $dimensions . '/';
				
				//resize image, either jpeg or png
				if($_FILES['image']['type'] == "image/jpeg")
				{
					$bSuccess = createSquareImage('jpeg', $storedImagedFilepath, $thisFolderPath, $dimensions);
				}
				else if($_FILES['image']['type'] == "image/png")
				{
					$bSuccess = createSquareImage('png', $storedImagedFilepath, $thisFolderPath, $dimensions);
				}
			}
			
			//if resized versions worked
			if($bSuccess)
			{
				$aMessages['confirm'] = '<p class="confirm-label"><label>Image uploaded successfully: ' . $_FILES['image']['name'] . '<label></p>';
			}
			//if resized versions didn't work
			else
			{
				$aMessages['resize'] = '<p class="error-label"><label>Could not process image.</label></p>';
			}
		}		
	}
	
	return $aMessages;	
	//ERRORS:	filetype, size, original, resize
	//CONFIRM:	confirm
}

function createSquareImage($imageFormat, $sourceFilePath, $outputFilePath, $outputDimensions)
{
	//shortcut of getting width and height
	list($width, $height) = getimagesize($sourceFilePath);
	
	//if taller than wide
	if($height > $width)
	{
		//get new dimensions
		$newHeight = $outputDimensions;
		$newWidth = $newHeight * $width / $height;
		
		//get where to place image in square to center it
		$topLeftCorner_y = 0;
		$topLeftCorner_x = ($newHeight - $newWidth) / 2;
	}
	//if wider than tall
	else
	{
		//get new dimensions
		$newWidth = $outputDimensions;
		$newHeight = $newWidth * $height / $width;
		
		//get where to place image in square to center it
		$topLeftCorner_x = 0;
		$topLeftCorner_y = ($newWidth - $newHeight) / 2;
	}
	
	//* DEBUG */ echo "<br/><br/>srcFile: $sourceFilePath | outFile: $outputFilePath | dimensions: $outputDimensions | <br/>height: $height | width: $width | newHeight: $newHeight | newWidth: $newWidth | x: $topLeftCorner_x | y: $topLeftCorner_y <br/><br/>";
	
	//create blank image control at smaller size, with a white background
	$squareImage = imagecreatetruecolor($outputDimensions, $outputDimensions);
	$whiteColor = imagecolorallocate($squareImage, 255, 255, 255);
	imagefill($squareImage, 0, 0, $whiteColor);
	
	//get image control for source image
	if($imageFormat == 'jpeg')
	{
		$sourceImage = imagecreatefromjpeg($sourceFilePath);
	}
	else if($imageFormat == 'png')
	{
		$sourceImage = imagecreatefrompng($sourceFilePath);
	}
	
	//resize and copy
	imagecopyresampled($squareImage, $sourceImage, $topLeftCorner_x , $topLeftCorner_y , 0,0, $newWidth, $newHeight, $width, $height);
	
	//output to file
	$newFileName = $outputFilePath.$_FILES['image']['name'];
	
	//compress back to jpeg @ quality 80
	if($imageFormat == 'jpeg')
	{
		$bSuccess = imagejpeg($squareImage, $newFileName, 80);
	}
	else if($imageFormat == 'png')
	{
		$bSuccess = imagepng($squareImage, $newFileName, 7);
	}
	
	//clear memory
	imagedestroy($squareImage);
	imagedestroy($sourceImage);
	
	//echo '<p><img src="' . $newFileName . '"/></p>';
	
	return $bSuccess;
}


//@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
//		DATA TRANSFORM
//@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
function makeSqlToInsertAllPokemon()
{
	//var to store sql
	$allPokemonInsertSql = '';

	//query
	$result = mysql_query('select * from pokemon order by pid') or die(mysql_error());
	
	//loop through
	while($row = mysql_fetch_array($result))
	{
		//pull on out
		$img_name = $row['img_name'];
		$pokedex_no = $row['pokedex_no'];
		$name = $row['name'];
		$type1 = $row['type1'];
		$type2 = $row['type2'];
		$info = $row['info'];
		$height = $row['height'];
		$weight = $row['weight'];
		$ability1 = $row['ability1'];
		$ability2 = $row['ability2'];
		$abilityH = $row['abilityH'];
		$hp = $row['hp'];
		$atk = $row['atk'];
		$def = $row['def'];
		$sp_atk = $row['sp_atk'];
		$sp_def = $row['sp_def'];
		$spd = $row['spd'];
		$bst = $hp + $atk + $def + $sp_atk + $sp_def + $spd;
		//* DEBUG */ echo "\n\n-- $pokedex_no | $img_name | $name | $type1 | $type2 ? $info | $height | $weight | $ability1 | $ability2 ? $abilityH ? $hp | $atk | $def | $sp_atk | $sp_def | $spd | $bst |";
		
		//take out special character's in name and info
		$invalidChars = array("'", '’', "\"", 'é', '$', '+', '-');
		$replacementChars = array('&#39;', '&#39;', '&quot;', '&eacute;', '&#36;', '&#43;', '&#45;');
		$info = str_replace($invalidChars, $replacementChars, $info);
		$name = str_replace($invalidChars, $replacementChars, $name);
	
		//check for null variables
		if(empty($type2)){$type2 = null;}
		if(empty($ability2)){$ability2 = null;}
		if(empty($abilityH)){$abilityH = null;}
		
		//start insert statement
		$sql = "\nINSERT INTO pokemon (img_name,pokedex_no,name,type1,info,height,weight,ability1,";
		
		//add nullables
		if(!empty($type2)){$sql .= 'type2,';}
		if(!empty($ability2)){$sql .= 'ability2,';}
		if(!empty($abilityH)){$sql .= 'abilityH,';}
		
		//insert values
		$sql .= "hp,atk,def,sp_atk,sp_def,spd,bst) VALUES ('$img_name','$pokedex_no','$name','$type1','$info','$height','$weight','$ability1',";
		
		//add nullables
		if(!empty($type2)){$sql .= "'$type2',";}
		if(!empty($ability2)){$sql .= "'$ability2',";}
		if(!empty($abilityH)){$sql .= "'$abilityH',";}
		
		//finish sql statement
		$sql .= "'$hp','$atk','$def','$sp_atk','$sp_def','$spd','$bst');";
		//* DEBUG */ echo $sql;
		
		//add to sql var
		$allPokemonInsertSql .= $sql;
		
		unset($pokedex_no);
		unset($img_name);
		unset($name);
		unset($type1);
		unset($type2);
		unset($info);
		unset($height);
		unset($weight);
		unset($ability1);
		unset($ability2);
		unset($abilityH);
		unset($hp);
		unset($atk);
		unset($def);
		unset($sp_atk);
		unset($sp_def);
		unset($spd);
	}
	
	return $allPokemonInsertSql;
}

function uploadAllImages()
{
	ini_set('max_execution_time', 300); //300 seconds = 5 minutes
	
	//query
	$result = mysql_query("select distinct img_name from pokemon where pokedex_no > '647' order by pid") or die(mysql_error());
	
	//loop through
	while($row = mysql_fetch_array($result))
	{
		$img_name = $row['img_name'];
		
		uploadImage2($img_name);
	}
}

function uploadImage2($imgName)
{
	//directories to move files
	$sugimoriFolder = 'images/sugimori/';
	$originalFolder = 'images/original/';
	//$aSquareDimensions = array(50, 96, 100, 125, 150, 240, 260, 290, 350, 500, 720);
	$aSquareDimensions = array(96, 290);

	//validation vars
	//if not uploaded successfully
	if( ! copy($sugimoriFolder.$imgName, $originalFolder.$imgName ))
	{
		echo '<p class="error-label"><label>Image could not be copied.</label></p>';
	}
	else
	{
		//store path to original file
		$storedImagedFilepath = $originalFolder.$imgName;
		
		//make resized versions
		foreach($aSquareDimensions as $dimensions)
		{
			//make folder path for resized image
			$thisFolderPath = 'images/square' . $dimensions . '/';
			
			//resize image, either jpeg or png
			$bSuccess = createSquareImage2($imgName, 'png', $storedImagedFilepath, $thisFolderPath, $dimensions);
		}
		
		//if resized versions worked
		if($bSuccess)
		{
			echo '<p class="confirm-label"><label>Image uploaded successfully: ' . $imgName . '<label></p>';
		}
		//if resized versions didn't work
		else
		{
			echo '<p class="error-label"><label>Could not process image.</label></p>';
		}
	}	
	
}

function createSquareImage2($imgName, $imageFormat, $sourceFilePath, $outputFilePath, $outputDimensions)
{
	//shortcut of getting width and height
	list($width, $height) = getimagesize($sourceFilePath);
	
	//if taller than wide
	if($height > $width)
	{
		//get new dimensions
		$newHeight = $outputDimensions;
		$newWidth = $newHeight * $width / $height;
		
		//get where to place image in square to center it
		$topLeftCorner_y = 0;
		$topLeftCorner_x = ($newHeight - $newWidth) / 2;
	}
	//if wider than tall
	else
	{
		//get new dimensions
		$newWidth = $outputDimensions;
		$newHeight = $newWidth * $height / $width;
		
		//get where to place image in square to center it
		$topLeftCorner_x = 0;
		$topLeftCorner_y = ($newWidth - $newHeight) / 2;
	}
	
	//* DEBUG */ echo "<br/><br/>srcFile: $sourceFilePath | outFile: $outputFilePath | dimensions: $outputDimensions | <br/>height: $height | width: $width | newHeight: $newHeight | newWidth: $newWidth | x: $topLeftCorner_x | y: $topLeftCorner_y <br/><br/>";
	
	//create blank image control at smaller size, with a white background
	$squareImage = imagecreatetruecolor($outputDimensions, $outputDimensions);
	$whiteColor = imagecolorallocate($squareImage, 255, 255, 255);
	imagefill($squareImage, 0, 0, $whiteColor);
	
	//get image control for source image
	$sourceImage = imagecreatefrompng($sourceFilePath);
	
	//resize and copy
	imagecopyresampled($squareImage, $sourceImage, $topLeftCorner_x , $topLeftCorner_y , 0,0, $newWidth, $newHeight, $width, $height);
	
	//output to file
	$newFileName = $outputFilePath.$imgName;
	
	$bSuccess = imagepng($squareImage, $newFileName, 7);
	
	//clear memory
	imagedestroy($squareImage);
	imagedestroy($sourceImage);
	
	//echo '<p><img src="' . $newFileName . '"/></p>';
	
	return $bSuccess;
}

function updateHeightAndWeight()
{
	//var to store sql
	$allPokemonUpdateSql = '';

	//query
	$result = mysql_query('select * from hw_table order by id') or die(mysql_error());
	
	//loop through
	while($row = mysql_fetch_array($result))
	{
		//pull on out
		$id = $row['id'];
		$name = $row['name'];
		$height = $row['height'];
		$weight = $row['weight'];
		
		$sql = "\nUPDATE pokemon SET height='$height', weight='$weight' WHERE pokedex_no='$id' AND name='$name';\n";
		
		$allPokemonUpdateSql .= $sql;
		
		unset($id);
		unset($name);
		unset($height);
		unset($weight);
		unset($sql);
	}
	
	return $allPokemonUpdateSql;
}

//@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
//		MENU CODE
//@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@

function getMenuListHtml($aListItems, $pageUrl)
{
	$menuListHtml = '';

	//loop through listItems
	foreach($aListItems as $listItem)
	{
		//get dropdown list html
		$bDropdowns = false;
		if(is_array($listItem['dropdown']))
		{
			$bDropdowns = true;
		}
		
		//Check if pageUrl matches any urls, so it can make the link active
		$bSelectedPage = false;
		
		//loop through urls
		foreach($listItem['url'] as $thisListItemUrl)
		{
			if( stristr($pageUrl, $thisListItemUrl) )
			{
				$bSelectedPage = true;
			}
		}
		//if any dropdown items are active
		if($bDropdowns)
		{
			//loop through dropdown list items
			foreach($listItem['dropdown'] as $thisDropdownListItem)
			{
				//loop through dropdown list item urls
				foreach($thisDropdownListItem['url'] as $thisDropdownListItemUrl)
				{
					if( stristr($pageUrl, $thisDropdownListItemUrl) )
					{
						$bSelectedPage = true;
					}
				}
			}
		}
		
		//start opening li tag
		$menuListHtml .= "\n" . '<li class="';
		
		//if pageUrl matches any urls
		if($bSelectedPage == true)
		{
			$menuListHtml .= ' active';
		}
		
		//if it has dropdowns
		if($bDropdowns == true)
		{
			$menuListHtml .= ' dropdown';
		}
		
		//finish opening <li>, start opening <a>
		$menuListHtml .= '"><a href="' . $listItem['url'][0] . '"';
		
		//if it has a dropdown
		if($bDropdowns == true)
		{
			$menuListHtml .= 'data-toggle="dropdown" class="dropdown-toggle"';
		}		
		
		//finish opening <a>, add list item text
		$menuListHtml .= '>' . $listItem['name'];
		
		//if it has a dropdown
		if($bDropdowns == true)
		{
			$menuListHtml .= '<b class="caret"></b>';
		}
		
		//close </a>
		$menuListHtml .=  '</a>';
		
		//do dropdowns
		if($bDropdowns)
		{
			$menuListHtml .= "\n" . '<ul class="dropdown-menu">';
			$menuListHtml .= "\n" . getMenuListHtml($listItem['dropdown'], $pageUrl);
			$menuListHtml .= "\n" . '</ul>';
		}	
		
		//close </li>
		$menuListHtml .= "\n" . '</li>';
	}
	
	return $menuListHtml;
}

?>






































