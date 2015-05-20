<?php
	include("../includes/admin_check.php");
	include("../includes/header.php");
	
	//get vars
	$selectedId = $_GET['id'];
	$deleted = $_GET['deleted'];
	
	if(isset($_POST['editButton']))
	{
		$ability_id = $_POST['ability_id'];
		$name = $_POST['name'];
		$description = $_POST['description'];
		//* DEBUG */ echo "-- $ability_id | $name | $description |";
		
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
			$aEditMessages = editAbility($ability_id, $name, $description);
		}
	}
	
	//prepop the form values
	if(!empty($selectedId))
	{
		//get ability info
		$selectedAbility = getAbility($selectedId);
		
		$ability_id = $selectedAbility['ability_id'];
		$name = $selectedAbility['name'];
		$description = $selectedAbility['description'];
		//* DEBUG */ echo "-- $ability_id | $name | $description |";
	}
?>

<h2 id="pageTitle">Edit Ability</h2>

<hr>

<?php
	if(isset($deleted))
	{
		echo '<p class="confirm-label"><label>Deleted ability: [' . $deleted . '].<label></p>'. "\n\n<hr>\n\n";
	}
	if(isset($_POST['editButton']))
	{
		if(!empty($aEditMessages['confirm']))
		{
			echo $aEditMessages['confirm'] . "\n\n<hr>\n\n";
		}
	}			
?>

<div id="content" class="row">

<div class="form-horizontal">
	<div class="form-group">
		<label class="control-label col-md-2 col-sm-3" for="abilityDropdown">Select:</label>
		<div class="col-md-6 col-sm-8">
			<select class="form-control select-picker" name="abilityDropdown" onChange="document.location=this.value" value="GO">
				<option value="editAbility.php">-- Select an ability --</option>
				<option value="addAbility.php">-- Add new ability --</option>
				<?php echo getAbilityDropdownOptions('editAbility.php', $selectedId); ?>
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
			<li><a href="editAbility.php?id=<?php echo ($selectedId-1); ?>">Previous</a></li>
			<li><a href="editAbility.php?id=<?php echo ($selectedId+1); ?>">Next</a></li>
		</ul>
<?php 
	} 
?>

<form role="form" class="form-horizontal" name="editForm" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
<!-- \/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\ -->
	<div class="form-group">
		<label class="col-md-2 col-sm-3 control-label" for="ability_id">ID #:</label>
		<div class="col-md-6 col-sm-8">
			<input class="form-control" type="text" name="ability_id" value="<?php echo $selectedId; ?>" readonly />
		</div>
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
		<label class="col-md-2 col-sm-3 control-label" for="description">Description:</label>
		<div class="col-md-6 col-sm-8">
			<textarea class="form-control" rows="10" name="description"><?php echo $description; ?></textarea>
		</div>
		<label class="control-label col-md-4 col-sm-3"><?php 
			if($aValidation['description'] != null){echo $aValidation['description'];}?></label>
	</div>
<!-- \/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\ -->
	<div class="form-group">
		<label class="col-md-2 col-sm-3 control-label" for="editButton">&nbsp;</label>
		<div class="col-md-6 col-sm-8">
			<input class="col-sm-5 col-xs-12 btn btn-default" type="submit" name="editButton" value="Edit Ability" />
			<a class="col-sm-5 hidden-xs pull-right btn btn-default" href="deleteAbility.php?id=<?php echo $selectedId; ?>" onclick="return confirm('Are you sure you want to delete that ability?')">Delete Ability</a>
		</div>
	</div>
<!-- \/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\ -->
	<div class="form-group visible-xs">
		<label class="col-md-2 col-sm-3 control-label" for="deleteButton">&nbsp;</label>
		<div class="col-md-6 col-sm-8">
			<a class="col-sm-5 col-xs-12 pull-right btn btn-default" href="deleteAbility.php?id=<?php echo $selectedId; ?>" onclick="return confirm('Are you sure you want to delete that ability?')">Delete Ability</a>
		</div>
	</div>
<!-- \/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\ -->
</form>
			

</div> <!-- end content -->
<?php
	include("../includes/footer.php");
?>