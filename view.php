<?php
	include("includes/header.php");
	
	//check if admin
	session_start();
	if(isset($_SESSION['546789uigyftyrsew4e65tyfguo897t6yfcgdrt']))
	{
		$bAdmin = true;
	}
	
	//get vars
	$selectedId = $_GET['id'];//prepop the form values
	
	if(!empty($selectedId))
	{
		//get pokemon info
		if($selectedId == 'rand')
		{
			$selectedPokemon = getRandomPokemon();
			$selectedId = $selectedPokemon['pid'];
		}
		else
		{
			$selectedPokemon = getPokemon($selectedId);
		}
		
		$pid = $selectedPokemon['pid'];
		$img_name = $selectedPokemon['img_name'];
		$pokedex_no = $selectedPokemon['pokedex_no'];
		$name = $selectedPokemon['name'];
		$type1 = $selectedPokemon['type1'];
		$type2 = $selectedPokemon['type2'];
		$info = $selectedPokemon['info'];
		$height = $selectedPokemon['height'];
		$weight = $selectedPokemon['weight'];
		$ability1 = $selectedPokemon['ability1'];
		$ability2 = $selectedPokemon['ability2'];
		$abilityH = $selectedPokemon['abilityH'];
		$hp = $selectedPokemon['hp'];
		$atk = $selectedPokemon['atk'];
		$def = $selectedPokemon['def'];
		$sp_atk = $selectedPokemon['sp_atk'];
		$sp_def = $selectedPokemon['sp_def'];
		$spd = $selectedPokemon['spd'];
		$bst = $selectedPokemon['bst'];
		//* DEBUG */ echo "-- $pid | $img_name | $pokedex_no | $name | $type1 | $type2 ? $info | $height | $weight | $ability1 | $ability2 ? $abilityH ? $hp | $atk | $def | $sp_atk | $sp_def | $spd |";
	}
?>

<h2 id="pageTitle">Stats</h2>

<hr>

<div id="content" class="row">

<div class="form-horizontal">
	<div class="form-group">
		<label class="control-label col-md-2 col-sm-3" for="pokemonDropdown">Select:</label>
		<div class="col-md-6 col-sm-8">
			<select class="form-control select-picker" name="pokemonDropdown" onChange="document.location=this.value" value="GO">
				<option value="view.php">-- Select a pokemon --</option>
				<?php echo getPokemonDropdownOptions('view.php', $selectedId); ?>
			</select>
		</div>
	</div>
</div>

<hr>

<?php 
	if(!empty($selectedId))
	{ 
?>
		<ul class="pager">
			<li><a href="view.php?id=<?php echo ($selectedId-1); ?>">&lt;</a></li>
			<li><a href="view.php?id=rand">Random</a></li>
			<li><a href="view.php?id=<?php echo ($selectedId+1); ?>">&gt;</a></li>
		</ul>
<?php 
		if(isset($bAdmin))
		{ 
?>
			<div class="form-horizontal">
				<div class="form-group">
					<div class="col-md-6 col-sm-8 pad-left-30">
						<a class="col-sm-5 col-xs-12 btn btn-default" href="admin/edit.php?id=<?php echo $selectedId; ?>">Edit Pokemon</a>
					</div>
				</div>
			</div>
<?php 
		} 
	}
?>
<div class="col-md-4 col-sm-6">
	<div class="view-thumb"><img class="view-thumb-img img-thumbnail" src="images/square240/<?php echo $img_name; ?>" /></div>
	
	<div class="form-group"></div>
	
	<table class="stats-table visible-sm">
		<tbody>
			<tr>
				<th class="stats-table-header"><span class="grey-label">HP</span></th>
				<td class="stats-table-value"><?php echo $hp; ?></td>
				<td><?php echo getStatBarDivHtml('hp', $hp); ?></td>
			</tr>
			<tr>
				<th class="stats-table-header"><span class="grey-label">Atk</span></th>
				<td class="stats-table-value"><?php echo $atk; ?></td>
				<td><?php echo getStatBarDivHtml('atk', $atk); ?></td>
			</tr>
			<tr>
				<th class="stats-table-header"><span class="grey-label">Def</span></th>
				<td class="stats-table-value"><?php echo $def; ?></td>
				<td><?php echo getStatBarDivHtml('def', $def); ?></td>
			</tr>
			<tr>
				<th class="stats-table-header"><span class="grey-label">SAt</span></th>
				<td class="stats-table-value"><?php echo $sp_atk; ?></td>
				<td><?php echo getStatBarDivHtml('sp_atk', $sp_atk); ?></td>
			</tr>
			<tr>
				<th class="stats-table-header"><span class="grey-label">SDf</span></th>
				<td class="stats-table-value"><?php echo $sp_def; ?></td>
				<td><?php echo getStatBarDivHtml('sp_def', $sp_def); ?></td>
			</tr>
			<tr>
				<th class="stats-table-header"><span class="grey-label">Spd</span></th>
				<td class="stats-table-value"><?php echo $spd; ?></td>
				<td><?php echo getStatBarDivHtml('spd', $spd); ?></td>
			</tr>
			<tr>
				<th class="stats-table-header"><span class="grey-label">BST</span></th>
				<td class="stats-table-value"><?php echo $bst; ?></td>
				<th style="width:100%;"><?php echo getStatBarDivHtml('bst', $bst); ?></th>
			</tr>
		</tbody>
	</table>
</div>
<div class="col-md-4 col-sm-6">
	<div class="form-horizontal">
		<div class="form-group">
			<label class="grey-label control-label col-sm-4">#</label>
			<div class="col-sm-8">
				<p class="form-control-static"><?php echo $pokedex_no; ?></p>
			</div>
		</div>
		<div class="form-group">
			<label class="grey-label control-label col-sm-4">Name</label>
			<div class="col-sm-8">
				<p class="form-control-static"><?php echo $name; ?></p>
			</div>
		</div>
		<div class="form-group">
			<label class="grey-label control-label col-sm-4">Type</label>
			<div class="col-sm-8 col-sm-4">
				<p class="form-control-static view-types"><?php echo getTypeHtml($type1); if(!empty($type2)){ echo ' ' . getTypeHtml($type2);} ?></p>
			</div>
		</div>
		<div class="form-group">
			<label class="grey-label control-label col-sm-4">Info</label>
			<div class="col-sm-8">
				<p class="form-control-static view-description"><?php echo $info; ?></p>
			</div>
		</div>
		<div class="form-group">
			<label class="grey-label control-label col-sm-4">Height</label>
			<div class="col-sm-8">
				<p class="form-control-static"><?php echo number_format($height, 1) . ' m'; ?></p>
			</div>
		</div>
		<div class="form-group">
			<label class="grey-label control-label col-sm-4">Weight</label>
			<div class="col-sm-8">
				<p class="form-control-static"><?php echo number_format($weight, 1) . ' kg'; ?></p>
			</div>
		</div>
		<div class="form-group">
			<label class="grey-label control-label col-sm-4">Abilities</label>
			<div class="col-sm-8">
				<p class="form-control-static"><?php echo getAbilityName($ability1); ?></p>
				<p class="form-control-static view-description"><?php echo getAbilityDescription($ability1); ?></p>
				<p class="form-control-static"><?php echo getAbilityName($ability2); ?></p>
				<p class="form-control-static view-description"><?php echo getAbilityDescription($ability2); ?></p>
				<p class="form-control-static"><?php echo getAbilityName($abilityH); ?></p>
				<p class="form-control-static view-description"><?php echo getAbilityDescription($abilityH); ?></p>
			</div>
		</div>
		<div class="form-group"></div>
	</div>
</div>
<div class="col-md-4 col-sm-6">
	<table class="stats-table hidden-sm">
		<tbody>
			<tr>
				<th class="stats-table-header"><span class="grey-label">HP</span></th>
				<td class="stats-table-value"><?php echo $hp; ?></td>
				<td><?php echo getStatBarDivHtml('hp', $hp); ?></td>
			</tr>
			<tr>
				<th class="stats-table-header"><span class="grey-label">Atk</span></th>
				<td class="stats-table-value"><?php echo $atk; ?></td>
				<td><?php echo getStatBarDivHtml('atk', $atk); ?></td>
			</tr>
			<tr>
				<th class="stats-table-header"><span class="grey-label">Def</span></th>
				<td class="stats-table-value"><?php echo $def; ?></td>
				<td><?php echo getStatBarDivHtml('def', $def); ?></td>
			</tr>
			<tr>
				<th class="stats-table-header"><span class="grey-label">SAt</span></th>
				<td class="stats-table-value"><?php echo $sp_atk; ?></td>
				<td><?php echo getStatBarDivHtml('sp_atk', $sp_atk); ?></td>
			</tr>
			<tr>
				<th class="stats-table-header"><span class="grey-label">SDf</span></th>
				<td class="stats-table-value"><?php echo $sp_def; ?></td>
				<td><?php echo getStatBarDivHtml('sp_def', $sp_def); ?></td>
			</tr>
			<tr>
				<th class="stats-table-header"><span class="grey-label">Spd</span></th>
				<td class="stats-table-value"><?php echo $spd; ?></td>
				<td><?php echo getStatBarDivHtml('spd', $spd); ?></td>
			</tr>
			<tr>
				<th class="stats-table-header"><span class="grey-label">BST</span></th>
				<td class="stats-table-value"><?php echo $bst; ?></td>
				<th style="width:100%;"><?php echo getStatBarDivHtml('bst', $bst); ?></th>
			</tr>
		</tbody>
	</table>
</div>

</div> <!-- end content -->
<?php
	include("includes/footer.php");
?>