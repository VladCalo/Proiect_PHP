<?php 
    //Get Heroku ClearDB connection information
$cleardb_url = parse_url(getenv("CLEARDB_DATABASE_URL"));
$cleardb_server = $cleardb_url["host"];
$cleardb_username = $cleardb_url["user"];
$cleardb_password = $cleardb_url["pass"];
$cleardb_db = substr($cleardb_url["path"],1);
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