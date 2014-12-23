<?php

# BACKEND HACK
# Takes GET value d for now
# This is meant to be very replaceable, returns JSON to fill next field
# TODO: make this a generic pattern, something like:
#        appIzer.update(changes)-> FIND_TYPE,VALIDATE,UPDATE-DB -> appIzer.refresh();
#
#                UI_event            ->          backend_action
#        appIzer.FORM.change()
#               .FORM.blur()
#        appIzer.update(form_change) -> appIzer.receive(form_change)
#                                    ->        .parse(form_change)
#                                    ->        .updateDatabase(changes)
#        appIzer.refresh()           <-        .returnResponse()
#
#       Since this crude PHP is going to get redone, trying to get the flow right
#       Some clever hacks and 'fake' updating (eg: Facebook/React) can make this fast
#        enough pretty easily til the server stack is mature.
#
#       Plan on this comment evolving

// Check input string, query and give relevant data

// Default to blank response to simplify errors
$nextID = '';
$jsoned = '';

// Add database functions
require_once 'database.php';

// Request string matches date format, next field ID is truck
if ( preg_match('/\d{2}\/\d{2}\/\d{4}/', $_GET['d']) ) {
    $nextID = 'truck';

    // Requests all rows from dummy table trucks, only has id/truck defaults
    foreach(selectData('SELECT * FROM trucks') as $row) {
        $jsoned .= '<option value="'.$row['truck'].'">'.$row['truck'].'</option>';
    }

}

// Request string matches truck 1020
if ( $_GET['d'] == '1020' ) {
    $nextID = 'techs';

    foreach(selectData('SELECT * from techs') as $row) {
        $jsoned .= '<option value="'.$row['name'].'" selected>'.$row['name'].'</option>';
    }

}

if ( $_GET['d'] == '610' ) {
    $nextID = 'techs';
    $jsoned = '<option selected="selected" value="GOOD">GOOD</option>
<option value="BAD">BAD</option>';

}

// JSONify!
$nextID = json_encode($nextID);
$jsoned = json_encode($jsoned);
?>
{
"nextID" : <?=$nextID?>,
"toFill" : <?=$jsoned?>
}

