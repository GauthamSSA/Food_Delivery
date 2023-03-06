<?php

session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "proj";

$conn = mysqli_connect($servername, $username, $password, $dbname);
//mysql_select_db("root", $con);

if (isset($_SESSION['user_id'])) 
{

	// User is logged in, display the dashboard page
?>
<!DOCTYPE html>
<html>
<head>
	<title>Dashboard</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<header class="container">
	<h1><b>Kiki's Delivery service<b></h1>
</header>
<body >
	<div class="container">
		<h1>Welcome,USER !</h1>
		
        <p>This is your dashboard.</p>
		<form method="POST" action="logout.php">
			<button type="submit">Logout</button>
		</form>

	</div>
	<div>
	<div class="restaurant-list">

        <a href="Restaurant1.html" style="color: #000000;">
            <div class="restaurant">
              <img src="Img 1.jpg" alt="Restaurant Logo">
              <h2>Restaurant 1</h2>
            </div>
          </a>
          

		<div class="restaurant">
            <a href="Restaurant2.html" style="color: #000000;">
			<img src="Img 2.jpg" alt="Restaurant Logo">
			<h2>Restaurant 2</h2>
            </a>
		</div>

		<div class="restaurant">
            <a href="Restaurant3.html" style="color: #000000;">
			<img src="Img 3.jpg" alt="Restaurant Logo">
			<h2>Restaurant 3</h2>
            </a>
		</div>

		<div class="restaurant">
            <a href="Restaurant4.html" style="color: #000000;">
			<img src="Img 4.jpg" alt="Restaurant Logo">
			<h2>Restaurant 4</h2>
            </a>
		</div>
        
		<div class="restaurant">
            <a href="Restaurant5.html" style="color: black;">    
			<img src="Img 5.jpg" alt="Restaurant Logo">
			<h2>Restaurant 5</h2>
		</div>
	</div>
</div>


</body>
</html>
<?php
} 

else {
	// User is not logged in, redirect to the login page
	header('Location: login_form.html');
	exit;
}

?>
