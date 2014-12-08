<?php

# This structure is hacky as shit
# Spits out data to fill field data

// Check input string, query and give relevant data
// Hard coded outputs to continue design

if ( preg_match('/\d{2}\/\d{2}\/\d{4}/', $_GET['d']) ) {

?>
<option value="518">518</option>
<option value="1020">1020</option>
<?php
}

if ( $_GET['d'] == '1020' ) {
?>
<option selected="selected" value="Ron">Ron</option>
<option selected="selected" value="James">James</option>
<?php
}

?>
