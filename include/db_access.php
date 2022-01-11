<?php

function check_credentials($conn, $user, $pass) {
    $sql = 'select * from users where username = "'.$conn->real_escape_string($user).'" and password ="'.$conn->real_escape_string($pass).'"';
	$result = mysqli_query($conn, $sql);
	#numaram inregistrarile returnate
	$rows = mysqli_num_rows($result);
    if ($rows==1) 
        return true;
}

?>