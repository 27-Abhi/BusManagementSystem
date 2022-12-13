<html>

<head>
	<meta charset="UTF-8">
	<title>Bus Management System</title>
	<link rel="icon" type="image/x-icon" href="../../Images/favicon.ico">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
        crossorigin="anonymous">
	
	<link rel="stylesheet" href="style.css">
	<script>
		history.pushState(null, null, null);
		window.addEventListener('popstate', function () {
			history.pushState(null, null, null);
		});
		<title>Login</title>
	</script>
</head>

<body>
	<nav id="mainNavbar" class="navbar navbar-light navbar-expand-md py-1 px-2 fixed-top" style="background-color: #0cb2f9;">
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
				<a class="nav-link" role="button" href="adminlogin.php">Admin Login</a>
			</span>
			
        </div>
    </nav>

	<div class="container right-panel-active">
		<!-- Conductor Login -->
		
		<div class="container__form container--signup">
			<form action="" class="form" method="POST">
				<input type="text" name="username" class="input" placeholder="Enter your Conductor ID">
				<input type="password" class="input" name="password" placeholder="Enter your password"><br>
				<input type="submit" name="loginC" value="login" class='btn'></input>
			</form>
		</div>

		<!-- Driver Login -->
		<div class="container__form container--signin">
			<form action="" method="POST" class='form'>
				<input type="text" name="username" class="input" placeholder="Enter your Driver ID">
				<input type="password" name="password" class="input" placeholder="Enter your password"><br>
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
	    if ($num >= 1) {
		    echo "<script>alert('Logged In successfuly!')</script>";
		    $_SESSION['status'] = "Active";
		    $_SESSION['username'] = "$username";
		    header("refresh:1, url=../../Conductor_DashBoard/Driver_DashBoard.php");
	    } else {
		    echo "<script>alert('incorrect id or password')</script>"
		    ;
		    echo "<script>location.href='logintest.php'</script>";
	    }
    }

    ?>

	<!-- <div>
		<a class="btn" href="adminlogin.php">Admin</a>
	</div>-->
	<!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>

    <script>
        $(function () {
            $(document).scroll(function () {
                var $nav = $("#mainNavbar");
                $nav.toggleClass("scrolled", $(this).scrollTop() > $nav.height());
            });
        });
    </script>
	

	
</body>

</html>