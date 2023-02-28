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

	

	$email = trim($_POST['email']);
	$password = trim($_POST['password']);

	// Check if the fields are empty or invalid
	if (empty($email)) {
		$_SESSION['error'] = 'Email is required';
		header('Location: login_form.html');
		exit;
	} else if (empty($password)) {
		$_SESSION['error'] = 'Password is required';
		header('Location: login_form.html');
		exit;
	}

	// Retrieve the user's data from the database
	$stmt = mysqli_prepare($conn, "SELECT * FROM users WHERE email = ?");
	mysqli_stmt_bind_param($stmt, "s", $email);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);

	if (mysqli_num_rows($result) == 1) {
		$row = mysqli_fetch_assoc($result);

		// Verify the password
		if (password_verify($password, $row['password'])) {
			$_SESSION['user_id'] = $row['id'];
			header('Location: dashboard.php');
			exit;
		} else {
			$_SESSION['error'] = 'Invalid email or password';
			header('Location: login_form.html');
			exit;
		}
	} else {
		$_SESSION['error'] = 'Invalid email or password';
		header('Location: login_form.html');
		exit;
	}

	mysqli_stmt_close($stmt);
	mysqli_close($conn);

} else {
	// Redirect the user to the login page if they try to access this page directly
	header('Location: login_form.html');
	exit;
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="container">
		<h1>Login</h1>
		<?php
			if (isset($_SESSION['error'])) {
				echo '<div class="error">' . $_SESSION['error'] . '</div>';
				unset($_SESSION['error']);
			}
		?>
		<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
			<label for="email">Email</label>
			<input type="email" name="email" id="email" required>
			<label for="password">Password</label>
			<input type="password" name="password" id="password" required>
			<button type="submit">Log in</button>
		</form>
		<p>Don't have an account? <a href="signup_form.html">Sign up</a></p>
	</div>
</body>
</html>
