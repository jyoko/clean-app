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

<link rel="stylesheet" href="./js/jquery-ui-1.11.2.custom/jquery-ui.min.css">
<script src="./js/jquery-ui-1.11.2.custom/external/jquery/jquery.js"></script>
<script src="./js/jquery-ui-1.11.2.custom/jquery-ui.min.js"></script>

<!-- Internal files -->

<link rel="stylesheet" href="./style/worksheet.css">
<link rel="stylesheet" media="(orientation: portrait)" href="./style/portrait.css">
<link rel="stylesheet" media="(orientation: landscape)" href="./style/landscape.css">
<link rel="stylesheet" media="(max-width: 900px)" href="./style/maxwidth.css">
<link rel="stylesheet" media="(min-width: 900px)" href="./style/minwidth.css">
<script src="./js/appizer/appizer.js"></script>

</head>
<body>

<form id="header">

<label>
<span class="headerLbl">Date</span>
<input type="text" name="date" required id="date" placeholder="<?=$month.'/'.$day.'/'.$year?>">
</label>

<label>
<span class="headerLbl">Truck</span>
<select name="truck" id="truck">
 <option value="518">518</option>
 <option value="1020">1020</option>
 <option value="610">610</option>
</select>
</label>

<label>
<span class="headerLbl">Technician(s)</span>
<select multiple name="techs" id="techs">
 <option value="NAME0">NAME0</option>
 <option value="NAME1">NAME1</option>
</select>
</label>

<label><input type="button" name="next0" value="Next">
</label>

</form>

</body>
</html>
