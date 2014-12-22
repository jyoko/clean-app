<?php
# Basic database functions for backend scripts

// Connect
$db = mysqli_connect('localhost','root','appitizer','clean');
if (!$db) {
    die('Connection failed');
}

// passes SELECT queries and returns array of return rows as associative arrays
function selectData($query) {
// Connect
$db = mysqli_connect('localhost','root','appitizer','clean');
if (!$db) {
    die('Connection failed');
}
    $result = mysqli_query($db, $query);
    $return = [];
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $return[] = $row;
        }
    }
    return $return;
}

// passes UPDATE queries and returns success value
function updateData($query) {
    // implementation
}

// passes DELETE queries and returns success value
function deleteData($query) {
    // implementation may be compatible with updateData()
}
?>
