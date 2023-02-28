<?php

session_start();

if (isset($_SESSION['user_id'])) {
	// User is logged in, display the dashboard page
?>
<!DOCTYPE html>
<html>
<head>
	<title>Dashboard</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="container">
		<h1>Welcome, <?php echo $_SESSION['username']; ?>!</h1>
        <p>This is your dashboard.</p>
		<form method="POST" action="logout.php">
			<button type="submit">Logout</button>
		</form>
	</div>
</body>
</html>
<?php
} else {
	// User is not logged in, redirect to the login page
	header('Location: login_form.html');
	exit;
}
?>

