<?php

session_start();

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	// Validate the user's credentials
	$username = $_POST['username'];
	$password = $_POST['password'];

	// In a real-world scenario, you would need to validate the user's credentials against a database
	// For simplicity, we'll just assume that the username is "user" and the password is "password"
	if ($username == 'user' && $password == 'password') {

		// Set the user's session variables
		$_SESSION['username'] = $username;

		// Redirect the user to the dashboard
		header('Location: dashboard.php');

	} else {

		// Redirect the user back to the login page with an error message
		header('Location: login.php?login=failed');

	}

} else {

	// Redirect the user back to the login page
	header('Location: login.php');

}

?>
