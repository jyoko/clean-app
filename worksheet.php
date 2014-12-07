<?php

# This is a hacky mess, hurray fast prototyping
# Probably better restructured as JSON or similar
# Working around that concept

# Temporary date fill
list($dayLong,$day,$monthLong,$month,$year) = explode(' ', date('l j F n Y'));




?><!DOCTYPE html>
<html>
<head>
<title>Worksheet - <?=$year.$month.$day;?></title>

<!-- External files -->

<link rel="stylesheet" href="./include/jquery-ui-1.11.2.custom/jquery-ui.min.css">
<script src="./include/jquery-ui-1.11.2.custom/external/jquery/jquery.js"></script>
<script src="./include/jquery-ui-1.11.2.custom/jquery-ui.min.js"></script>

<!-- Internal files -->

<link rel="stylesheet" href="./worksheet.css">
<link rel="stylesheet" media="(max-width: 640px)" href="./max640.css">
<link rel="stylesheet" media="(min-width: 640px)" href="./min640.css">
<link rel="stylesheet" media="(orientation: portrait)" href="./portrait.css">
<link rel="stylesheet" media="(orientation: landscape)" href="./landscape.css">
<script src="./include/clean.js"></script>

<script>
$(function() {
	$("#date").datepicker();
});
</script>

</head>
<body>

<form id="header">
<label for="date">Date</label>
<input type="text" name="date" required id="date" placeholder="<?=$month.'/'.$day.'/'.$year?>">

<label for="truck">Truck</label>
<select name="truck" id="truck">
 <option value="518">518</option>
 <option value="1020">1020</option>
 <option value="610">610</option>
</select>

<label for="techs">Technician(s)</label>
<select multiple name="techs" id="techs">
 <option value="NAME">NAME</option>
 <option value="NAME2">NAME2</option>
 <option value="OTHER">OTHER</option>
</select>

<label for="submit"></label>
<input type="submit" name="submit" id="next" value="Next">
</form>

</body>
</html>
