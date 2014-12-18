<?php

# This structure is hacky as shit
# Spits out HTML data to fill header fields, useful for testing
# This is meant to be very replaceable, UI receives from jQuery's .load() function

// Check input string, query and give relevant data
// Hard coded outputs to continue design

$nextID = '""';
$jsoned = '""';

if ( preg_match('/\d{2}\/\d{2}\/\d{4}/', $_GET['d']) ) {
    $nextID = json_encode('truck');
    $jsoned = json_encode(
'<option value="518">518</option>
<option value="1020">1020</option>');

}

if ( $_GET['d'] == '1020' ) {
    $nextID = json_encode('techs');
    $jsoned = json_encode(
'<option selected="selected" value="NEW0">NEW</option>
<option selected="selected" value="NEW1">NEW2</option>');

}

if ( $_GET['d'] == '610' ) {
    $nextID = json_encode('techs');
    $jsoned = json_encode(
'<option selected="selected" value="GOOD">GOOD</option>
<option value="BAD">BAD</option>');

}

?>
{
"nextID" : <?=$nextID?>,
"toFill" : <?=$jsoned?>
}

