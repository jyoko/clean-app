<?php

# BACKEND HACK
# Takes GET value d for now
# This is meant to be very replaceable, returns JSON to fill next field
#
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
// TODO: don't replace fields, just add SELECTED
if ( preg_match('/\d{2}\/\d{2}\/\d{4}/', $_GET['d']) ) {
    $nextID = 'truck';

    // Change date format for SQL
    $date = date('Y-m-d', strtotime($_GET['d']));

    $checkSheet = selectData('SELECT truckid,crewid FROM worksheets WHERE date=\''.$date.'\'');
    if ($checkSheet) {
        foreach($checkSheet as $row) {
            foreach(selectData('SELECT truck FROM trucks WHERE id=\''.$row['truckid'].'\'') as $truck) {
                $jsoned .= '<option value="'.$row['crewid'].'">'.$truck['truck'].'</option>';
            }
        }
    } else {
        foreach(selectData('SELECT * FROM trucks') as $row) {
            $jsoned .= '<option value="0">'.$row['truck'].'</option>';
        }
    }
}

// Request string matches truck 1020
if ( is_numeric($_GET['d']) ) {
    $nextID = 'techs';
    $id = $_GET['d'];
    if ($id != 0) {
        $query = 'SELECT techs.name FROM techs,crews WHERE crews.id=\''.$id.'\' AND '.
                 'crews.techid = techs.id';
        foreach(selectData($query) as $row) {
            $jsoned .= '<option value="'.$row['name'].'" selected>'.$row['name'].'</option>';
        }
    } else {
        $query = 'SELECT name FROM techs';
        foreach(selectData($query) as $row) {
            $jsoned .= '<option value="'.$row['name'].'">'.$row['name'].'</option>';
        }
    }
}

// JSONify!
$nextID = json_encode($nextID);
$jsoned = json_encode($jsoned);
?>
{
"nextID" : <?=$nextID?>,
"toFill" : <?=$jsoned?>
}

