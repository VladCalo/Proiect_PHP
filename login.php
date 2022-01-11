<?php include 'include/header.php'; ?>
<?php include 'include/db_access.php'; ?>

<?php


#cautam combinatia user parola in baza de date 
$rows = check_credentials($conn, $_POST['username'], $_POST['password']);


if (isset($_POST['Submit'])) {
	$secretKey = "6LfdFP8dAAAAABW4aRkAreIwbikFg1vsi9Kd1vgK";
	$responseKey = $_POST['g-recaptcha-response'];
	$userIP = $_SERVER['REMOTE_ADDR'];

	$url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$responseKey&remoteip=$userIP";
	$response = file_get_contents($url);

	$response = json_decode($response);

	if ($response->success && $rows == 1) {
		$message = 'Succes!';
		$_SESSION['logged_in'] = 1;
		header('Location: dashboard.php');
	} else if ($rows == 0)
		$message =  'Combinatie user parola invalida!';
	else
		$message =  'Captcha verification failed!';
}
print('<span color="#ff0000">' . $message . '<span>');




// if ($rows == 1) {
// 	$message = 'Succes!'; 
// 	$_SESSION['logged_in'] = 1;
// 	header('Location: dashboard.php');
// }
// else
// 	$message = 'Combinatie user parola invalida!';

// #se afiseaza mesajul 
// print('<span color="#ff0000">' . $message . '<span>');
?>