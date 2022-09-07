<?php

// server info
$server = 'localhost';
$user = 'root';
$pass = '';
$db = 'masterlist';

// connect to the database
$mysqli = new mysqli($server, $user, $pass, $db);
$mysqli -> autocommit(FALSE);


// show errors (remove this line if on a live site)
mysqli_report(MYSQLI_REPORT_ERROR);

?>