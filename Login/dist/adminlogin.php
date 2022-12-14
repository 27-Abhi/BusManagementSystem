<html>

<head>
	<meta charset="UTF-8">
	<title>Bus Management System</title>
	<link rel="icon" type="image/x-icon" href="../../Images/favicon.ico">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
		integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

	<link rel="stylesheet" href="style.css">
	<link rel="icon" type="image/x-icon" href="../../Images/favicon.ico/">

	<script>
		history.pushState(null, null, null);
		window.addEventListener('popstate', function () {
			history.pushState(null, null, null);
		});

		window.history.forward();
		function noBack() {
			window.history.forward();
		}
	</script>
	<title>Login</title>
</head>

<body onLoad="noBack();">
	<nav id="mainNavbar" class="navbar navbar-light navbar-expand-md py-1 px-2 fixed-top"
		style="background-color: #0cb2f9;">
		<a class="navbar-brand" href="#">
			<img src="../../Images/icon.png" width="45" height="35" class="d-inline-block align-middle" alt="">
			BUS MANAGEMENT SYSTEM
		</a>

		<button class="navbar-toggler" data-toggle="collapse" data-target="#navLinks" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse justify-content-between" id="navLinks">


			<ul class="navbar-nav">
				<li class="nav-item">
					<a href="login.php" class="nav-link">HOME</a>
				</li>
				<li class="nav-item">
					<a href="../../about.html" class="nav-link">ABOUT</a>
				</li>
				<li class="nav-item">
					<a href="../../team.html" class="nav-link">TEAM</a>
				</li>


			</ul>

			<span class="nav-item">
				<a class="nav-link" role="button" href="login.php">Driver / Conductor Login</a>
			</span>

		</div>
	</nav>


	<div class="container right-panel-active">
		<!-- admin Login -->
		<div class="container__form container--signup">
			<form action="" class="form" method="POST">
				<input type="text" name="username" class="input" placeholder="Enter your username">
				<input type="password" class="input" name="password" placeholder="Enter your password">
				<br>
				<input type="submit" name="login" value="Admin Login" class='btn'>
			</form>
		</div>
		<div class="container__overlay">
			<div class="overlay">

			</div>
		</div>
	</div>
	</div>

	<!-- partial -->
	<script src="./script.js"></script>
	<!--<div>
		<a class="btn" href="logintest.php">back</a>
	</div>-->
	<?php
    if (isset($_POST['login'])) {
	    session_start();

	    $username = $_POST['username'];
	    $password = $_POST['password'];

	    $connection = mysqli_connect('localhost', 'root', '', 'test4');
	    if (!$connection) {
		    die("Connection Error -> " . mysqli_connect_error());
	    }

	    $sql = "SELECT * FROM `login_admin` WHERE user_name = '$username' && password = '$password'";
	    $result = mysqli_query($connection, $sql);
	    $num = mysqli_num_rows($result);
	    if ($num == 1) {
		    echo "<script>alert('Logged In successfuly!')</script>";
		    $_SESSION['status'] = "Active";
		    $_SESSION['username'] = "$username";
		    header("refresh:0, url=../../Conductor_DashBoard/AdminDashBoard.php");
	    } else {
		    echo "<script>alert('incorrect id or password')</script>";
		    echo "<script>location.href='logintest.php'</script>";
	    }
    }

    ?>
</body>

</html>