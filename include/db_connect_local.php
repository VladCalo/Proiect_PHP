<?php 
    //Get Heroku ClearDB connection information
$cleardb_server = 'eu-cdbr-west-01.cleardb.com';
$cleardb_username = 'beb0bd69b1e477';
$cleardb_password = '6b3f8b1f';
$cleardb_db = 'heroku_a31cdcde8e7306d';
$active_group = 'default';
$query_builder = TRUE;

// Connect to DB
$conn = mysqli_connect($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);

if ($conn == NULL)
    echo "nu s-a putut realiza conexiunea la baza de date!";

#pornim o sesiune noua, cu lifetime de 24 de ore
session_start();

function check_session () {
    if ((!isset($_SESSION['logged_in'])))
        header("Location: index.php");
}


?>  