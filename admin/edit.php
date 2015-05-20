<?php
	include("../includes/admin_check.php");
	include("../includes/header.php");
	
	//get vars
	$selectedId = $_GET['id'];
	$deleted = $_GET['deleted'];
	
	if(isset($_POST['editButton']))
	{
		$pid = $_POST['pid'];
		$pokedex_no = $_POST['pokedex_no'];
		$name = $_POST['name'];
		$type1 = $_POST['type1'];
		$type2 = $_POST['type2'];
		$info = $_POST['info'];
		$height = $_POST['height'];
		$weight = $_POST['weight'];
		$ability1 = $_POST['ability1'];
		$ability2 = $_POST['ability2'];
		$abilityH = $_POST['abilityH'];
		$hp = $_POST['hp'];
		$atk = $_POST['atk'];
		$def = $_POST['def'];
		$sp_atk = $_POST['sp_atk'];
		$sp_def = $_POST['sp_def'];
		$spd = $_POST['spd'];
		//* DEBUG */ echo "-- $pid | $pokedex_no | $name | $type1 | $type2 ? $info | $height | $weight | $ability1 | $ability2 ? $abilityH ? $hp | $atk | $def | $sp_atk | $sp_def | $spd |";
		
		//set up to reload info
		$selectedId = $pid;
		
		//validate inputs
		$aValidation = validatePokemon($pokedex_no, $name, $height, $weight, $hp, $atk, $def, $sp_atk, $sp_def, $spd);
		//* DEBUG */ echo '<pre>'; print_r($aValidation); echo '</pre>';
		
		//edit db
		if($aValidation['bValid'] == true)
		{
			$aEditMessages = editPokemon($pid, $pokedex_no, $name, $type1, $type2, $info, $height, $weight, $ability1, $ability2, $abilityH, $hp, $atk, $def, $sp_atk, $sp_def, $spd);
		}
	}
	
	//prepop the form values
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
		//* DEBUG */ echo "-- $pid | $img_name | $pokedex_no | $name | $type1 | $type2 ? $info | $height | $weight | $ability1 | $ability2 ? $abilityH ? $hp | $atk | $def | $sp_atk | $sp_def | $spd |";
	}
?>

<h2 id="pageTitle">Edit Pokemon</h2>

<hr>

<?php
	if(isset($deleted))
	{
		echo '<p class="confirm-label"><label>Deleted pokemon: [' . $deleted . '].<label></p>'. "\n\n<hr>\n\n";
	}
	if(isset($_POST['editButton']))
	{
		if(!empty($aEditMessages['confirm']))
		{
			echo $aEditMessages['confirm'] . "\n\n<hr>\n\n";
		}	
		if(!empty($aEditMessages['aImageMessages']['confirm']))
		{
			echo $aEditMessages['aImageMessages']['confirm'] . "\n\n<hr>\n\n";
		}
		else
		{
			if(!empty($aEditMessages['aImageMessages']['upload']))
				{echo $aEditMessages['aImageMessages']['upload'] . "\n\n<hr>\n\n";}
			if(!empty($aEditMessages['aImageMessages']['filetype']))
				{echo $aEditMessages['aImageMessages']['filetype'] . "\n\n<hr>\n\n";}
			if(!empty($aEditMessages['aImageMessages']['size']))
				{echo $aEditMessages['aImageMessages']['size'] . "\n\n<hr>\n\n";}
			if(!empty($aEditMessages['aImageMessages']['original']))
				{echo $aEditMessages['aImageMessages']['original'] . "\n\n<hr>\n\n";}
			if(!empty($aEditMessages['aImageMessages']['resize']))
				{echo $aEditMessages['aImageMessages']['resize'] . "\n\n<hr>\n\n";}
		}
	}			
?>

<div id="content" class="row">

<div class="form-horizontal">
	<div class="form-group">
		<label class="control-label col-md-2 col-sm-3" for="pokemonDropdown">Select:</label>
		<div class="col-md-6 col-sm-8">
			<select class="form-control select-picker" name="pokemonDropdown" onChange="document.location=this.value" value="GO">
				<option value="edit.php">-- Select a pokemon --</option>
				<option value="add.php">-- Add new pokemon --</option>
				<?php echo getPokemonDropdownOptions('edit.php', $selectedId); ?>
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
			<li><a href="edit.php?id=<?php echo ($selectedId-1); ?>"><</a></li>
			<li><a href="edit.php?id=rand">Random</a></li>
			<li><a href="edit.php?id=<?php echo ($selectedId+1); ?>">></a></li>
		</ul>

		<div class="form-horizontal">
			<div class="form-group">
				<label class="col-md-2 col-sm-3 control-label">&nbsp;</label>
				<div class="col-md-6 col-sm-8">
					<a class="col-sm-5 col-xs-12 btn btn-default" href="../view.php?id=<?php echo $selectedId; ?>">View Pokemon</a>
				</div>
			</div>
		</div>
<?php 
	} 
?>

<form role="form" class="form-horizontal" name="editForm" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
<!-- \/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\ -->
	<div class="form-group">
		<label class="col-md-2 col-sm-3 control-label" for="pid">ID #:</label>
		<div class="col-md-6 col-sm-8">
			<input class="form-control" type="text" name="pid" value="<?php echo $selectedId; ?>" readonly />
		</div>
	</div>
<!-- \/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\ -->
	<div class="form-group">
		<label class="col-md-2 col-sm-3 control-label" for="img_name">Old Image:</label>
		<div class="col-md-6 col-sm-8">
			<input class="form-control" type="text" name="img_name" value="<?php echo $img_name; ?>" readonly />
		</div>
	</div>
<!-- \/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\ -->
<?php if(!empty($selectedId)){?>
	<div class="form-group">
		<label class="control-label col-md-2 col-sm-3">&nbsp;</label>
		<div class="col-md-6 col-sm-8">
			<img class="preview-image-img img-thumbnail" src="../images/original/<?php echo $img_name; ?>" />
		</div>
	</div>
<?php }?>
<!-- \/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\ -->
	<div class="form-group">
		<label class="control-label col-md-2 col-sm-3" for "image">New Image:</label>
		<div class="col-md-6 col-sm-8">
			<input id="imageFile" class="form-control" type="file" name="image" value="<?php echo $img_name; ?>" />
			<script>$("#imageFile").change(function(){previewImage(this);});</script>
		</div>
	</div>
<!-- \/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\ -->
	<div class="form-group"id="preview-new-image">
		<label class="control-label col-md-2 col-sm-3">&nbsp;</label>
		<div class="col-md-6 col-sm-8">
			<img id="preview-new-image-img" class="preview-image-img img-thumbnail" src="#" />
		</div>
	</div>
<!-- \/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\ -->
	<div class="form-group">
		<label class="col-md-2 col-sm-3 control-label" for="pokedex_no">Pokedex #:</label>
		<div class="col-md-6 col-sm-8">
			<input class="form-control" type="number" name="pokedex_no" placeholder="Pokedex #" value="<?php echo $pokedex_no; ?>" />
		</div>
		<label class="control-label col-md-4 col-sm-3"><?php 
			if($aValidation['pokedex_no'] != null){echo $aValidation['pokedex_no'];}?></label>
	</div>
<!-- \/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\ -->
	<div class="form-group">
		<label class="col-md-2 col-sm-3 control-label" for="name">Name:</label>
		<div class="col-md-6 col-sm-8">
			<input class="form-control" type="text" name="name" placeholder="Name" value="<?php echo $name; ?>" />
		</div>
		<label class="control-label col-md-4 col-sm-3"><?php 
			if($aValidation['name'] != null){echo $aValidation['name'];}?></label>
	</div>
<!-- \/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\ -->
	<div class="form-group">
		<label class="col-md-2 col-sm-3 control-label" for="type1">Type 1:</label>
		<div class="col-md-6 col-sm-8">
			<select class="form-control" name="type1">
				<?php echo getTypeDropdownOptions($type1); ?>
			</select>
		</div>
	</div>
<!-- \/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\ -->
	<div class="form-group">
		<label class="col-md-2 col-sm-3 control-label" for="type2">Type 2:</label>
		<div class="col-md-6 col-sm-8">
			<select class="form-control" name="type2">
				<option value="">None</option>
				<?php echo getTypeDropdownOptions($type2); ?>
			</select>
		</div>
	</div>
<!-- \/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\ -->
	<div class="form-group">
		<label class="col-md-2 col-sm-3 control-label" for="info">Info:</label>
		<div class="col-md-6 col-sm-8">
			<textarea class="form-control" rows="10" name="info"><?php echo $info; ?></textarea>
		</div>
		<label class="control-label col-md-4 col-sm-3"><?php 
			if($aValidation['info'] != null){echo $aValidation['info'];}?></label>
	</div>
<!-- \/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\ -->
	<div class="form-group">
		<label class="col-md-2 col-sm-3 control-label" for="height">Height (m):</label>
		<div class="col-md-6 col-sm-8">
			<input class="form-control" type="number" step="0.1" name="height" placeholder="Height (m)" value="<?php echo $height; ?>" />
		</div>
		<label class="control-label col-md-4 col-sm-3"><?php 
			if($aValidation['height'] != null){echo $aValidation['height'];}?></label>
	</div>
<!-- \/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\ -->
	<div class="form-group">
		<label class="col-md-2 col-sm-3 control-label" for="weight">Weight (kg):</label>
		<div class="col-md-6 col-sm-8">
			<input class="form-control" type="number" step="0.1" name="weight" placeholder="Weight (kg)" value="<?php echo $weight; ?>" />
		</div>
		<label class="control-label col-md-4 col-sm-3"><?php 
			if($aValidation['weight'] != null){echo $aValidation['weight'];}?></label>
	</div>
<!-- \/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\ -->
	<div class="form-group">
		<label class="control-label col-md-2 col-sm-3" for="ability1">Ability 1:</label>
		<div class="col-md-6 col-sm-8">
			<select class="form-control select-picker" name="ability1" onChange="" value="">
				<?php echo getAbilityDropdownOptions(null, $ability1); ?>
			</select>
			<p class="form-control-static view-description"><?php echo getAbilityDescription($ability1); ?></p>
		</div>
	</div>
<!-- \/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\ -->
	<div class="form-group">
		<label class="control-label col-md-2 col-sm-3" for="ability2">Ability 2:</label>
		<div class="col-md-6 col-sm-8">
			<select class="form-control select-picker" name="ability2" onChange="" value="">
				<option value="">None</option>
				<?php echo getAbilityDropdownOptions(null, $ability2); ?>
			</select>
			<p class="form-control-static view-description"><?php echo getAbilityDescription($ability2); ?></p>
		</div>
	</div>
<!-- \/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\ -->
	<div class="form-group">
		<label class="control-label col-md-2 col-sm-3" for="abilityH">Ability H:</label>
		<div class="col-md-6 col-sm-8">
			<select class="form-control select-picker" name="abilityH" onChange="" value="">
				<option value="">None</option>
				<?php echo getAbilityDropdownOptions(null, $abilityH); ?>
			</select>
			<p class="form-control-static view-description"><?php echo getAbilityDescription($abilityH); ?></p>
		</div>
	</div>
<!-- \/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\ -->
	<div class="form-group">
		<label class="col-md-2 col-sm-3 control-label" for="hp">HP:</label>
		<div class="col-md-6 col-sm-8">
			<input class="form-control" type="number" name="hp" placeholder="HP" value="<?php echo $hp; ?>" />
		</div>
		<label class="control-label col-md-4 col-sm-3"><?php 
			if($aValidation['hp'] != null){echo $aValidation['hp'];}?></label>
	</div>
<!-- \/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\ -->
	<div class="form-group">
		<label class="col-md-2 col-sm-3 control-label" for="atk">Attack:</label>
		<div class="col-md-6 col-sm-8">
			<input class="form-control" type="number" name="atk" placeholder="Attack" value="<?php echo $atk; ?>" />
		</div>
		<label class="control-label col-md-4 col-sm-3"><?php 
			if($aValidation['atk'] != null){echo $aValidation['atk'];}?></label>
	</div>
<!-- \/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\ -->
	<div class="form-group">
		<label class="col-md-2 col-sm-3 control-label" for="def">Defense:</label>
		<div class="col-md-6 col-sm-8">
			<input class="form-control" type="number" name="def" placeholder="Defense" value="<?php echo $def; ?>" />
		</div>
		<label class="control-label col-md-4 col-sm-3"><?php 
			if($aValidation['def'] != null){echo $aValidation['def'];}?></label>
	</div>
<!-- \/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\ -->
	<div class="form-group">
		<label class="col-md-2 col-sm-3 control-label" for="sp_atk">Sp Attack:</label>
		<div class="col-md-6 col-sm-8">
			<input class="form-control" type="number" name="sp_atk" placeholder="Sp Attack" value="<?php echo $sp_atk; ?>" />
		</div>
		<label class="control-label col-md-4 col-sm-3"><?php 
			if($aValidation['sp_atk'] != null){echo $aValidation['sp_atk'];}?></label>
	</div>
<!-- \/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\ -->
	<div class="form-group">
		<label class="col-md-2 col-sm-3 control-label" for="sp_def">Sp Defense:</label>
		<div class="col-md-6 col-sm-8">
			<input class="form-control" type="number" name="sp_def" placeholder="Sp Defense" value="<?php echo $sp_def; ?>" />
		</div>
		<label class="control-label col-md-4 col-sm-3"><?php 
			if($aValidation['sp_def'] != null){echo $aValidation['sp_def'];}?></label>
	</div>
<!-- \/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\ -->
	<div class="form-group">
		<label class="col-md-2 col-sm-3 control-label" for="spd">Speed:</label>
		<div class="col-md-6 col-sm-8">
			<input class="form-control" type="number" name="spd" placeholder="Speed" value="<?php echo $spd; ?>" />
		</div>
		<label class="control-label col-md-4 col-sm-3"><?php 
			if($aValidation['spd'] != null){echo $aValidation['spd'];}?></label>
	</div>
<!-- \/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\ -->
	<div class="form-group">
		<label class="col-md-2 col-sm-3 control-label" for="editButton">&nbsp;</label>
		<div class="col-md-6 col-sm-8">
			<input class="col-sm-5 col-xs-12 btn btn-default" type="submit" name="editButton" value="Edit Pokemon" />
			<a class="col-sm-5 hidden-xs pull-right btn btn-default" href="delete.php?id=<?php echo $selectedId; ?>" onclick="return confirm('Are you sure you want to delete that pokemon?')">Delete Pokemon</a>
		</div>
	</div>
<!-- \/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\ -->
	<div class="form-group visible-xs">
		<label class="col-md-2 col-sm-3 control-label" for="deleteButton">&nbsp;</label>
		<div class="col-md-6 col-sm-8">
			<a class="col-sm-5 col-xs-12 pull-right btn btn-default" href="delete.php?id=<?php echo $selectedId; ?>" onclick="return confirm('Are you sure you want to delete that pokemon?')">Delete Pokemon</a>
		</div>
	</div>
<!-- \/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\ -->
</form>
			

</div> <!-- end content -->
<?php
	include("../includes/footer.php");
?>