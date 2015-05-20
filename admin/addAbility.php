<?php
	include("../includes/admin_check.php");
	include("../includes/header.php");
	
	if(isset($_POST['addButton']))
	{
		$name = $_POST['name'];
		$description = $_POST['description'];
		//* DEBUG */ echo "-- $name | $description |";
		
		//validate
		$bValid = true;
		if(empty($name))
		{
			$aValidationMessages['name'] = '<p class="error-label"><label>*Required</label></p>';
			$bValid = false;
		}
		else if(strlen($name) > 20)
		{
			$aValidationMessages['name'] = '<p class="error-label"><label>*Less than 20 characters</label></p>';
			$bValid = false;
		}
		if(empty($description))
		{
			$aValidationMessages['description'] = '<p class="error-label"><label>*Required</label></p>';
			$bValid = false;
		}
		
		//add to db
		if($bValid)
		{
			$aAddMessages = addAbility($name, $description);
			
			//if add was successful
			if(!empty($aAddMessages['confirm']))
			{
				unset($name);
				unset($description);
			}
		}
	}
?>

<h2 id="pageTitle">Add Ability</h2>

<hr>

<?php
	if(isset($_POST['addButton']))
	{
		if(!empty($aAddMessages['confirm']))
		{
			echo $aAddMessages['confirm'] . "\n\n<hr>\n\n";
		}
	}
?>

<div id="content" class="row">

<div class="form-horizontal">
	<div class="form-group">
		<label class="control-label col-md-2 col-sm-3" for="abiityDropdown">Select:</label>
		<div class="col-md-6 col-sm-8">
			<select class="form-control select-picker" name="abiityDropdown" onChange="document.location=this.value" value="GO">
				<option value="editAbility.php">-- Select an ability --</option>
				<option value="addAbility.php" selected>-- Add new ability --</option>
				<?php echo getAbilityDropdownOptions('editAbility.php', null); ?>
			</select>
		</div>
	</div>
</div>

<hr>

<form role="form" class="form-horizontal" name="addForm" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
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
		<label class="col-md-2 col-sm-3 control-label" for="description">Description:</label>
		<div class="col-md-6 col-sm-8">
			<textarea class="form-control" rows="10" name="description"><?php echo $description; ?></textarea>
		</div>
		<label class="control-label col-md-4 col-sm-3"><?php 
			if($aValidationMessages['description'] != null){echo $aValidationMessages['description'];}?></label>
	</div>
<!-- \/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\ -->
	<div class="form-group">
		<label class="col-md-2 col-sm-3 control-label" for="addButton">&nbsp;</label>
		<div class="col-md-6 col-sm-8">
			<input class="col-sm-5 col-xs-12 btn btn-default" type="submit" name="addButton" value="Add Ability" />
		</div>
	</div>
<!-- \/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\ -->
</form>
</div> <!-- end content -->
<?php
	include("../includes/footer.php");
?>