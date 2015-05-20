<?php
	include("../includes/admin_check.php");
	include("../includes/header.php");
	
	if(isset($_POST['addButton']))
	{
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
		//* DEBUG */ echo "-- $pokedex_no | $name | $type1 | $type2 ? $info | $height | $weight | $ability1 | $ability2 ? $abilityH ? $hp | $atk | $def | $sp_atk | $sp_def | $spd |";
		
		//validate inputs
		$aValidationMessages = validatePokemon($pokedex_no, $name, $height, $weight, $hp, $atk, $def, $sp_atk, $sp_def, $spd);
		//* DEBUG */ echo '<pre>'; print_r($aValidationMessages); echo '</pre>';
		
		//add to db
		if($aValidationMessages['bValid'] == true)
		{
			$aAddMessages = addPokemon($pokedex_no, $name, $type1, $type2, $info, $height, $weight, $ability1, $ability2, $abilityH, $hp, $atk, $def, $sp_atk, $sp_def, $spd);
			
			//if add was successful
			if(!empty($aAddMessages['confirm']))
			{
				unset($pokedex_no);
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
		}
	}
?>

<h2 id="pageTitle">Add Pokemon</h2>

<hr>

<?php
	if(isset($_POST['addButton']))
	{
		if(!empty($aAddMessages['confirm']))
		{
			echo $aAddMessages['confirm'] . "\n\n<hr>\n\n";
		}	
		if(!empty($aAddMessages['aImageMessages']['confirm']))
		{
			echo $aAddMessages['aImageMessages']['confirm'] . "\n\n<hr>\n\n";
		}
		else
		{
			if(!empty($aAddMessages['aImageMessages']['upload']))
				{echo $aAddMessages['aImageMessages']['upload'] . "\n\n<hr>\n\n";}
			if(!empty($aAddMessages['aImageMessages']['filetype']))
				{echo $aAddMessages['aImageMessages']['filetype'] . "\n\n<hr>\n\n";}
			if(!empty($aAddMessages['aImageMessages']['size']))
				{echo $aAddMessages['aImageMessages']['size'] . "\n\n<hr>\n\n";}
			if(!empty($aAddMessages['aImageMessages']['original']))
				{echo $aAddMessages['aImageMessages']['original'] . "\n\n<hr>\n\n";}
			if(!empty($aAddMessages['aImageMessages']['resize']))
				{echo $aAddMessages['aImageMessages']['resize'] . "\n\n<hr>\n\n";}
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
				<option value="add.php" selected>-- Add new pokemon --</option>
				<?php echo getPokemonDropdownOptions('edit.php', null); ?>
			</select>
		</div>
	</div>
</div>

<hr>

<form role="form" class="form-horizontal" name="addForm" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
<!-- \/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\ -->
	<div class="form-group">
		<label class="control-label col-md-2 col-sm-3" for="image">Add Image:</label>
		<div class="col-md-6 col-sm-8">
			<input id="imageFile" class="form-control" type="file" name="image" />
			<script>$("#imageFile").change(function(){previewImage(this);});</script>
		</div>
	</div>
<!-- \/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\ -->
	<div class="form-group" id="preview-new-image">
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
			if($aValidationMessages['pokedex_no'] != null){echo $aValidationMessages['pokedex_no'];}?></label>
	</div>
<!-- \/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\ -->
	<div class="form-group">
		<label class="col-md-2 col-sm-3 control-label" for="name">Name:</label>
		<div class="col-md-6 col-sm-8">
			<input class="form-control" type="text" name="name" placeholder="Name" value="<?php echo $name; ?>" />
		</div>
		<label class="control-label col-md-4 col-sm-3"><?php 
			if($aValidationMessages['name'] != null){echo $aValidationMessages['name'];}?></label>
	</div>
<!-- \/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\ -->
	<div class="form-group">
		<label class="col-md-2 col-sm-3 control-label" for="type1">Type 1:</label>
		<div class="col-md-6 col-sm-8">
			<select class="form-control" name="type1">
				<?php echo getTypeDropdownOptions(null); ?>
			</select>
		</div>
	</div>
<!-- \/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\ -->
	<div class="form-group">
		<label class="col-md-2 col-sm-3 control-label" for="type2">Type 2:</label>
		<div class="col-md-6 col-sm-8">
			<select class="form-control" name="type2">
				<option value="">None</option>
				<?php echo getTypeDropdownOptions(null); ?>
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
			if($aValidationMessages['info'] != null){echo $aValidationMessages['info'];}?></label>
	</div>
<!-- \/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\ -->
	<div class="form-group">
		<label class="col-md-2 col-sm-3 control-label" for="height">Height (m):</label>
		<div class="col-md-6 col-sm-8">
			<input class="form-control" type="number" step="0.1" name="height" placeholder="Height (m)" value="<?php echo $height; ?>" />
		</div>
		<label class="control-label col-md-4 col-sm-3"><?php 
			if($aValidationMessages['height'] != null){echo $aValidationMessages['height'];}?></label>
	</div>
<!-- \/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\ -->
	<div class="form-group">
		<label class="col-md-2 col-sm-3 control-label" for="weight">Weight (kg):</label>
		<div class="col-md-6 col-sm-8">
			<input class="form-control" type="number" step="0.1" name="weight" placeholder="Weight (kg)"  value="<?php echo $weight; ?>"/>
		</div>
		<label class="control-label col-md-4 col-sm-3"><?php 
			if($aValidationMessages['weight'] != null){echo $aValidationMessages['weight'];}?></label>
	</div>
<!-- \/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\ -->
	<div class="form-group">
		<label class="control-label col-md-2 col-sm-3" for="ability1">Ability 1:</label>
		<div class="col-md-6 col-sm-8">
			<select class="form-control select-picker" name="ability1" onChange="" value="">
				<?php echo getAbilityDropdownOptions(null, null); ?>
			</select>
		</div>
	</div>
<!-- \/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\ -->
	<div class="form-group">
		<label class="col-md-2 col-sm-3 control-label" for="ability1Desc">&nbsp;</label>
		<div class="col-md-6 col-sm-8">
			<textarea id="ability1Info" class="form-control ability-info" name="ability1Desc" rows="10" disabled></textarea>
		</div>
	</div>
<!-- \/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\ -->
	<div class="form-group">
		<label class="control-label col-md-2 col-sm-3" for="ability2">Ability 2:</label>
		<div class="col-md-6 col-sm-8">
			<select class="form-control select-picker" name="ability2" onChange="" value="">
				<option value="">None</option>
				<?php echo getAbilityDropdownOptions(null, null); ?>
			</select>
		</div>
	</div>
<!-- \/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\ -->
	<div class="form-group">
		<label class="col-md-2 col-sm-3 control-label" for="ability2Info">&nbsp;</label>
		<div class="col-md-6 col-sm-8">
			<textarea id="ability2Info" class="form-control ability-info" name="ability2Info" rows="10" disabled></textarea>
		</div>
	</div>
<!-- \/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\ -->
	<div class="form-group">
		<label class="control-label col-md-2 col-sm-3" for="abilityH">Ability H:</label>
		<div class="col-md-6 col-sm-8">
			<select class="form-control select-picker" name="abilityH" onChange="" value="">
				<option value="">None</option>
				<?php echo getAbilityDropdownOptions(null, null); ?>
			</select>
		</div>
	</div>
<!-- \/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\ -->
	<div class="form-group">
		<label class="col-md-2 col-sm-3 control-label" for="abilityHInfo">&nbsp;</label>
		<div class="col-md-6 col-sm-8">
			<textarea id="abilityHInfo" class="form-control ability-info" name="abilityHInfo" rows="10" disabled></textarea>
		</div>
	</div>
<!-- \/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\ -->
	<div class="form-group">
		<label class="col-md-2 col-sm-3 control-label" for="hp">HP:</label>
		<div class="col-md-6 col-sm-8">
			<input class="form-control" type="number" name="hp" placeholder="HP" value="<?php echo $hp; ?>" />
		</div>
		<label class="control-label col-md-4 col-sm-3"><?php 
			if($aValidationMessages['hp'] != null){echo $aValidationMessages['hp'];}?></label>
	</div>
<!-- \/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\ -->
	<div class="form-group">
		<label class="col-md-2 col-sm-3 control-label" for="atk">Attack:</label>
		<div class="col-md-6 col-sm-8">
			<input class="form-control" type="number" name="atk" placeholder="Attack" value="<?php echo $atk; ?>" />
		</div>
		<label class="control-label col-md-4 col-sm-3"><?php 
			if($aValidationMessages['atk'] != null){echo $aValidationMessages['atk'];}?></label>
	</div>
<!-- \/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\ -->
	<div class="form-group">
		<label class="col-md-2 col-sm-3 control-label" for="def">Defense:</label>
		<div class="col-md-6 col-sm-8">
			<input class="form-control" type="number" name="def" placeholder="Defense" value="<?php echo $def; ?>" />
		</div>
		<label class="control-label col-md-4 col-sm-3"><?php 
			if($aValidationMessages['def'] != null){echo $aValidationMessages['def'];}?></label>
	</div>
<!-- \/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\ -->
	<div class="form-group">
		<label class="col-md-2 col-sm-3 control-label" for="sp_atk">Sp Attack:</label>
		<div class="col-md-6 col-sm-8">
			<input class="form-control" type="number" name="sp_atk" placeholder="Sp Attack" value="<?php echo $sp_atk; ?>" />
		</div>
		<label class="control-label col-md-4 col-sm-3"><?php 
			if($aValidationMessages['sp_atk'] != null){echo $aValidationMessages['sp_atk'];}?></label>
	</div>
<!-- \/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\ -->
	<div class="form-group">
		<label class="col-md-2 col-sm-3 control-label" for="sp_def">Sp Defense:</label>
		<div class="col-md-6 col-sm-8">
			<input class="form-control" type="number" name="sp_def" placeholder="Sp Defense" value="<?php echo $sp_def; ?>" />
		</div>
		<label class="control-label col-md-4 col-sm-3"><?php 
			if($aValidationMessages['sp_def'] != null){echo $aValidationMessages['sp_def'];}?></label>
	</div>
<!-- \/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\ -->
	<div class="form-group">
		<label class="col-md-2 col-sm-3 control-label" for="spd">Speed:</label>
		<div class="col-md-6 col-sm-8">
			<input class="form-control" type="number" name="spd" placeholder="Speed" value="<?php echo $spd; ?>" />
		</div>
		<label class="control-label col-md-4 col-sm-3"><?php 
			if($aValidationMessages['spd'] != null){echo $aValidationMessages['spd'];}?></label>
	</div>
<!-- \/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\ -->
	<div class="form-group">
		<label class="col-md-2 col-sm-3 control-label" for="addButton">&nbsp;</label>
		<div class="col-md-6 col-sm-8">
			<input class="col-sm-5 col-xs-12 btn btn-default" type="submit" name="addButton" value="Add Pokemon" />
		</div>
	</div>
<!-- \/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\ -->
</form>
</div> <!-- end content -->
<?php
	include("../includes/footer.php");
?>