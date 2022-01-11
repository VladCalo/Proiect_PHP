<?php include 'include/header.php';?>
<?php 
#conexiunea la baza de date
include 'include/db_connect.php';

#daca s-a apasat butonul submit
if (isset($_POST['Submit'])) 
	#procesare login 
	include 'login.php';
else
	#afisare formular login
	include 'main.php';

include 'include/db_disconnect.php';

?>

