<?php

session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "proj";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	

	// Validate the user's input
	$username = trim($_POST['username']);
	$email = trim($_POST['email']);
	$password = trim($_POST['password']);

	// Check if the fields are empty or invalid
	if (empty($username)) {
		$_SESSION['error'] = 'Username is required';
		header('Location: signup_form.html');
		exit;
	} 
	else{
		
		$_SESSION["username"]=$username;
	}
	 if (empty($email)) {
		$_SESSION['error'] = 'Email is required';
		header('Location: signup_form.html');
		exit;
	} 
	
	if (empty($password)) {
		$_SESSION['error'] = 'Password is required';
		header('Location: signup_form.html');
		exit;
	}

	// Check if the email is already in use
	$stmt = mysqli_prepare($conn, "SELECT id FROM users WHERE email = ?");
	mysqli_stmt_bind_param($stmt, "s", $email);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_store_result($stmt);

	if (mysqli_stmt_num_rows($stmt) > 0) {
		$_SESSION['error'] = 'Email is already in use';
		header('Location: signup_form.html');
		exit;
	}

	// Hash the password
	$hashed_password = password_hash($password, PASSWORD_DEFAULT);

	// Insert the user's data into the database
	$stmt = mysqli_prepare($conn, "INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
	mysqli_stmt_bind_param($stmt, "sss", $username, $email, $hashed_password);
	mysqli_stmt_execute($stmt);

	$_SESSION['success'] = 'You have successfully signed up. Please log in.';
	header('Location: login_form.html');

	mysqli_stmt_close($stmt);
	mysqli_close($conn);

} else {
	// Redirect the user to the sign up page if they try to access this page directly
	header('Location: signup_form.html');
	exit;
}
?>



