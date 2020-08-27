<?php

// first create your database and user (assign user to DB) then import subject.sql into the database via PHPMyAdmin

$host = "localhost"; // do not change even when uploading to Cpanel

$db = "a9916631_The_scp_foundation"; // change this to your database name
$user = "a9916631_zina";
$pwd = "pleasejustwork";

$dsn = "mysql:host=$host; dbname=$db";

try{
    $conn = new PDO($dsn, $user, $pwd);
}
catch(PDOException $error){
    echo "<h3>Error</h3>" . $error->getMessage();
}

?>