<?php 
	session_start();
	require_once 'database.php'; 
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Login and Register System</title>
		<link rel="stylesheet" href="style.css" />
	</head>
	<body>
		<nav class="nav">
			<div class="container">
				<h1 class="logo"><a href="index.php">My Website</a></h1>
				<ul>
					<li><a href="index.php" class="current">Home</a></li>
					<li><a href="login.php">Login</a></li>
					<li><a href="logout.php">Logout</a></li>
					<li><a href="register.php">Register</a></li>
				</ul>
			</div>
		</nav>