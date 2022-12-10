<html>

<head>
	<meta charset="UTF-8">
	<title>Kadamba Bus Management System</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
	<link rel="stylesheet" href="./style.css">
	<script>
		history.pushState(null, null, null);
		window.addEventListener('popstate', function () {
			history.pushState(null, null, null);
		});
		<title>Login</title>
	</script>
</head>

<body>
	<div class="container right-panel-active">
		<!-- Conductor Login -->
		<div class="container__form container--signup">
			<form action="" class="form" method="POST">
				<input type="text" name="username" class="input" placeholder="Enter your username">
				<input type="password" class="input" name="password" placeholder="Enter your password">
				<input type="submit" name="loginC" value="login" class='btn'>
			</form>
		</div>

		<!-- Driver Login -->
		<div class="container__form container--signin">
			<form action="" method="POST" class='form'>
				<input type="text" name="username" class="input" placeholder="Enter your username">
				<input type="password" name="password" class="input" placeholder="Enter your password">
				<input type="submit" name="loginD" value="login" class='btn'>
			</form>
		</div>


		<div class="container__overlay">
			<div class="overlay">
				<div class="overlay__panel overlay--left">
					<button class="btn" id="signIn">Driver Login</button>
				</div>
				<div class="overlay__panel overlay--right">
					<button class="btn" id="signUp">Conductor Login</button>
				</div>
			</div>
		</div>
	</div>
	<!-- partial -->
	<script src="./script.js"></script>

	<div>
		<a class="btn" href="adminlogin.php">Admin</a>
	</div>

	<?php
    if (isset($_POST['loginC'])) {
	    session_start();

	    $username = $_POST['username'];
	    $password = $_POST['password'];

	    $connection = mysqli_connect('localhost', 'root', '', 'test4');
	    if (!$connection) {
		    die("Connection Error -> " . mysqli_connect_error());
	    }

	    $sql = "SELECT * FROM `login` WHERE user_name = '$username' && password = '$password'";
	    $result = mysqli_query($connection, $sql);
	    $num = mysqli_num_rows($result);
	    if ($num == 1) {
		    echo "<script>alert('Logged In successfuly!')</script>";
		    $_SESSION['status'] = "Active";
		    $_SESSION['username'] = "$username";
		    header("refresh:0, url=../../Conductor_DashBoard/conductorDashboard.php");
	    } else {
		    echo "<script>alert('incorrect id or password')</script>";
		    echo "<script>location.href='logintest.php'</script>";
	    }
    } else if (isset($_POST['loginD'])) {
	    session_start();

	    $username = $_POST['username'];
	    $password = $_POST['password'];

	    $connection = mysqli_connect('localhost', 'root', '', 'test4');
	    if (!$connection) {
		    die("Connection Error -> " . mysqli_connect_error());
	    }

	    $sql = "SELECT * FROM `login_driver` WHERE user_name = '$username' && password = '$password'";
	    $result = mysqli_query($connection, $sql);
	    $num = mysqli_num_rows($result);
	    if ($num == 1) {
		    echo "<script>alert('Logged In successfuly!')</script>";
		    $_SESSION['status'] = "Active";
		    $_SESSION['username'] = "$username";
		    header("refresh:0, url=../../Conductor_DashBoard/Driver_DashBoard.php");
	    } else {
		    echo "<script>alert('incorrect id or password')</script>";
		    echo "<script>location.href='logintest.php'</script>";
	    }
    }

    ?>
</body>

</html>