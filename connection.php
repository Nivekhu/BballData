<?php 
$mydb = @mysql_connect("localhost", "huk", "900502862"); 
if( !$mydb) 
{ 
    echo( "Connection to database server failed <br>"); 
    exit( ); 
}

$servername = "localhost";
$username = "huk";
$password = "900502862";
$dbname = "huk";

// Create connection
$mysqli_conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($mysqli_conn->connect_error) {
    die("Connection failed: " . $mysqli_conn->connect_error);
} 
