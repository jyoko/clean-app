<?php
# Basic database function wrappers
# Super basic SELECT, UPDATE/INSERT, and DELETE functions
#  to keep translating the logic simple.
# TODO: Optimize, error handling, security

// Creates connection
function manageDB($action) {

    if ($action == 'connect') {
        $db = mysqli_connect('localhost','root','appitizer','clean');
        if (!$db) {
            die('Error connecting');
        }
        return $db;
    }

}

// passes SELECT queries and returns array of return rows as associative arrays
function selectData($query) {

    $db = manageDB('connect');
    $result = mysqli_query($db, $query);

    $return = [];
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $return[] = $row;
        }
    }

    return $return;
}

// Takes one array key:col=>val for INSERTs, add $array['colCheck']=>'value' to UPDATE table
// eg: updateData('users',{'uname':'bill','pword':'god'}, one-element $sqlWvar)
function updateData($sqlTable,$sqlNvars,$sqlWvar=FALSE) {

    if ($sqlWvars !== FALSE) {
        // Flatten new vars array for query statement
        $setString = '';
        foreach ($sqlNvars as $col=>$val) {
            $setString .= $col.'=\''.$val.'\',';
        }
        $setString = rtrim($setString,',');

        $query =    'UPDATE '.$sqlTable.' '.
                    'SET '.$setString.' '.
                    'WHERE '.key($sqlWvar).'='.current($sqlWvar);
    } else {
        // Flatten new vars array for query statement
        $colNames = '';
        $colValues = '';
        foreach ($sqlNvars as $col=>$val) {
            $colNames .= $col.',';
            $colValues .= '\''.$val.'\',';
        }
        $colNames = rtrim($colNames,',');
        $colValues = rtrim($colValues,',');

        $query =    'INSERT INTO '.$sqlTable.' ('.$colNames.') '.
                    'VALUES ('.$colValues.')';
    }

    // Returns TRUE on success, FALSE on error
    return mysqli_query($GLOBALS['db'],$query);
}

// passes DELETE queries and returns success value
function deleteData($query) {
    // implementation
}
?>
