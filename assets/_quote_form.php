<?php 

/**
*
*
*
*
*
*
*
*
*/


?>

<form class="form-horizontal" action="?" method="POST" style="position:relative; border:2px solid #ed6d00; padding:20px 40px;">


	<?php if(@$_REQUEST['quote-submit'] && !$result["Errors"]) : ?>
		<div class="alert alert-success">Thank you, we have received your submission.</div>
	<?php elseif(@$_REQUEST['quote-submit'] && $result["Errors"]) : ?>
		<div class="alert alert-warning">Please fill out all fields marked with a *.</div>
	<?php endif; ?>
	<!--
	<div style="width:100%; height:100%; position:absolute; background-color:rgba(0, 0, 0, 0.4); z-index:1000; top:0; left:0;">
		<h2 class="text-center" style="position:absolute; width:100%; padding:20px 0; top:10%; background-color:white;">Coming Soon!</h2>
	</div>
	-->
	<h3>STEP ONE: Contact Information</h3>
	<!-- First Name -->
	<div class="form-group<?php if(@$result['First Name']) echo " has-error"; ?>">
		<label for="fname" class="col-sm-4 control-label">* First Name</label>
		<div class="col-sm-6">
			<input type="text" class="form-control" id="fname" name="First Name" value="<?php echo @$_REQUEST["First Name"]; ?>" placeholder="">
		</div>
	</div>
	
	
	<!-- Last Name -->
	<div class="form-group<?php if(@$result['Last Name']) echo " has-error"; ?>">
		<label for="lname" class="col-sm-4 control-label">* Last Name</label>
		<div class="col-sm-6">
			<input type="text" class="form-control" id="lname" name="Last Name" value="<?php echo @$_REQUEST["Last Name"]; ?>" placeholder="">
		</div>
	</div>
	
	
	<!-- Company Name -->
	<div class="form-group<?php if(@$result['Company Name']) echo " has-error"; ?>">
		<label for="company" class="col-sm-4 control-label">* Company Name</label>
		<div class="col-sm-6">
			<input type="text" class="form-control" id="company" name="Company Name" value="<?php echo @$_REQUEST["Company Name"]; ?>" placeholder="">
		</div>
	</div>
	
	
	<!-- Email -->
	<div class="form-group<?php if(@$result['Email Address']) echo " has-error"; ?>">
		<label for="email" class="col-sm-4 control-label">* Email Address</label>
		<div class="col-sm-6">
			<input type="email" class="form-control" id="email" name="Email Address" value="<?php echo @$_REQUEST["Email Address"]; ?>" placeholder="">
		</div>
	</div>
	
	
	<!-- Phone Number -->
	<div class="form-group<?php if(@$result['Phone Number']) echo " has-error"; ?>">
		<label for="phone" class="col-sm-4 control-label">* Phone Number</label>
		<div class="col-sm-4">
			<input type="text" class="form-control" id="phone" name="Phone Number" value="<?php echo @$_REQUEST["Phone Number"]; ?>" placeholder="">
		</div>
	</div>
	
	
	<!-- Alt Phone -->
	<div class="form-group">
		<label for="altphone" class="col-sm-4 control-label">Alternative Phone Number</label>
		<div class="col-sm-4">
			<input type="text" class="form-control" id="altphone" name="Alternative Phone Number" value="<?php echo @$_REQUEST["Alternative Phone Number"]; ?>" placeholder="">
		</div>
	</div>
	
	
	<!-- Addr 1 -->
	<div class="form-group">
		<label for="addr1" class="col-sm-4 control-label">Address Line 1</label>
		<div class="col-sm-6">
			<input type="text" class="form-control" id="addr1" name="Address Line 1" value="<?php echo @$_REQUEST["Address Line 1"]; ?>" placeholder="">
		</div>
	</div>
	
	
	<!-- Addr 2 -->
	<div class="form-group">
		<label for="addr2" class="col-sm-4 control-label">Address Line 2</label>
		<div class="col-sm-6">
			<input type="text" class="form-control" id="addr2" name="Address Line 2" value="<?php echo @$_REQUEST["Address Line 2"]; ?>" placeholder="">
		</div>
	</div>
	
	
	<!-- City -->
	<div class="form-group">
		<label for="city" class="col-sm-4 control-label">City</label>
		<div class="col-sm-6">
			<input type="text" class="form-control" id="city" name="City" value="<?php echo @$_REQUEST["City"]; ?>" placeholder="">
		</div>
	</div>
	
	
	<!-- Postal/Zip Code -->
	<div class="form-group">
		<label for="pc" class="col-sm-4 control-label">Postal/Zip Code</label>
		<div class="col-sm-4">
			<input type="text" class="form-control" id="pc" name="Postal/Zip Code" value="<?php echo @$_REQUEST["Postal/Zip Code"]; ?>" placeholder="">
		</div>
	</div>
	
	
	<!-- Province/State -->
	<div class="form-group">
		<label for="province" class="col-sm-4 control-label">Province/State</label>
		<div class="col-sm-6">
			<input type="text" class="form-control" id="province" name="Province/State" value="<?php echo @$_REQUEST["Province/State"]; ?>" placeholder="">
		</div>
	</div>
	
	
	<!-- Country -->
	<div class="form-group">
		<label for="country" class="col-sm-4 control-label">Country</label>
		<div class="col-sm-6">
			<input type="text" class="form-control" id="country" name="Country" value="<?php echo @$_REQUEST["Country"]; ?>" placeholder="">
		</div>
	</div>
	
	<hr />
	
	<h3>STEP TWO: Quote Information</h3>
	
	<!-- Service Select -->
	<div class="form-group<?php if(@$result['Service Required']) echo " has-error"; ?>">
		<label for="country" class="col-sm-4 control-label">* Service Required</label>
		<div class="col-sm-8">
			<select class="form-control" id="service" name="Service Required">
				<option value="0"<?php if(!@$_REQUEST["Service Required"]) echo " selected"; ?>)>Choose Service</option>
				<option value="Bins-front-end"<?php if(@$_REQUEST["Service Required"] == "Bins-front-end") echo " selected"; ?>>Bins (front end)</option>
				<option value="Bins-roll-off"<?php if(@$_REQUEST["Service Required"] == "Bins-roll-off") echo " selected"; ?>>Bins (roll-off)</option>
				<option value="Boom Crane Services"<?php if(@$_REQUEST["Service Required"] == "Boom Crane Services") echo " selected"; ?>>Boom Crane Services</option>
				<option value="Construction Site Cleanup"<?php if(@$_REQUEST["Service Required"] == "Construction Site Cleanup") echo " selected"; ?>>Construction Site Cleanup</option>
				<option value="Construction Site Clerk"<?php if(@$_REQUEST["Service Required"] == "Construction Site Clerk") echo " selected"; ?>>Construction Site Clerk</option>
				<option value="Daylight Services"<?php if(@$_REQUEST["Service Required"] == "Daylight Services") echo " selected"; ?>>Daylight Services</option>
				<option value="Demolition Services"<?php if(@$_REQUEST["Service Required"] == "Demolition Services") echo " selected"; ?>>Demolition Services</option>
				<option value="Dump Truck Services"<?php if(@$_REQUEST["Service Required"] == "Dump Truck Services") echo " selected"; ?>>Dump Truck Services</option>
				<option value="Dust Control"<?php if(@$_REQUEST["Service Required"] == "Dust Control") echo " selected"; ?>>Dust Control</option>
				<option value="Equipment Float Services"<?php if(@$_REQUEST["Service Required"] == "Equipment Float Services") echo " selected"; ?>>Equipment Float Services</option>
				<option value="Excavation Services"<?php if(@$_REQUEST["Service Required"] == "Excavation Services") echo " selected"; ?>>Excavation Services</option>
				<option value="Flusher Truck"<?php if(@$_REQUEST["Service Required"] == "Flusher Truck") echo " selected"; ?>>Flusher Truck</option>
				<option value="Handyman Supply Services"<?php if(@$_REQUEST["Service Required"] == "Handyman Supply Services") echo " selected"; ?>>Handyman Supply Services</option>
				<option value="Hydro Vac Excavation Services"<?php if(@$_REQUEST["Service Required"] == "Hydro Vac Excavation Services") echo " selected"; ?>>Hydro Vac Excavation Services</option>
				<option value="Labourer"<?php if(@$_REQUEST["Service Required"] == "Labourer") echo " selected"; ?>>Labourer</option>
				<option value="Other"<?php if(@$_REQUEST["Service Required"] == "Other") echo " selected"; ?>>Other</option>

				<option value="Power Washing"<?php if(@$_REQUEST["Service Required"] == "Power Washing") echo " selected"; ?>>Power Washing</option>
				<option value="Road Cleaning"<?php if(@$_REQUEST["Service Required"] == "Road Cleaning") echo " selected"; ?>>Road Cleaning</option>
				<option value="Service Men"<?php if(@$_REQUEST["Service Required"] == "Service Men") echo " selected"; ?>>Service Men</option>
				<option value="Street/Parking Lot Sweeping"<?php if(@$_REQUEST["Service Required"] == "Street/Parking Lot Sweeping") echo " selected"; ?>>Street/Parking Lot Sweeping</option>
				<option value="Water Box/Valve Box Replacement"<?php if(@$_REQUEST["Service Required"] == "Water Box/Valve Box Replacement") echo " selected"; ?>>Water Box/Valve Box Replacement</option>
				<option value="Water Cannon"<?php if(@$_REQUEST["Service Required"] == "Water Cannon") echo " selected"; ?>>Water Cannon</option>
				<option value="Water Supply - Potable/Cistern"<?php if(@$_REQUEST["Service Required"] == "Water Supply - Potable/Cistern") echo " selected"; ?>>Water Supply - Potable/Cistern</option>
				<option value="Water Supply - Swimming Pools"<?php if(@$_REQUEST["Service Required"] == "Water Supply - Swimming Pools") echo " selected"; ?>>Water Supply - Swimming Pools</option>
				<option value="Water Supply - Directional &amp; Geo Thermal Drilling"<?php if(@$_REQUEST["Service Required"] == "Water Supply - Directional &amp; Geo Thermal Drilling") echo " selected"; ?>>Water Supply - Directional &amp; Geo Thermal Drilling</option>						
				<option value="Water Supply - Vegetation Watering"<?php if(@$_REQUEST["Service Required"] == "Water Supply - Vegetation Watering") echo " selected"; ?>>Water Supply - Vegetation Watering</option>
			</select>
		</div>
	</div>
	

	<!-- Start Date -->
	<div class="form-group<?php if(@$result['Start Date']) echo " has-error"; ?>">
		<label for="start" class="col-sm-4 control-label">* Start Date (mm/dd/yy please)</label>
		<div class="col-sm-4">
			<input type="text" class="form-control" id="start" name="Start Date" value="<?php echo @$_REQUEST["Start Date"]; ?>" placeholder="">
		</div>
	</div>
	
	<!-- Start Date -->
	<div class="form-group">
		<label for="start">Project Details/Comments</label>
		<textarea class="form-control" rows="5" name="Project Details/Comments" ><?php echo @$_REQUEST["Project Details/Comments"]; ?></textarea>
	</div>
	
	<div class="checkbox">
		<label>
			<input type="checkbox" value="1" name="Notify about deals"<?php if(@$_REQUEST["Notify about deals"]) echo " checked"; ?>>
			Check here if you would like to be notified about our special deals in the future!
		</label>
	</div>
	
	<div class="form-group text-right">
		<button type="submit" class="btn-lg btn-primary" name="quote-submit" value="1">Submit</button>
	</div>
</form>

