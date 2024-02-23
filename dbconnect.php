<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpassword = "";
$dbname = "db";

$dbconn = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname);

if(!$dbconn)
{
    die("Connection failed: ". mysqli_connect_error());
}
?>