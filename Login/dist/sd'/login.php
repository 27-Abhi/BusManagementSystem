<!DOCTYPE html>
<html lang="en">

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
</script>

</head>

<body>
	<!-- partial:index.partial.html -->
	



	<div class="container right-panel-active">
		<!-- Conductor Login -->
		<div class="container__form container--signup">
			<form action="" class="form" id="form1" method="POST">
				<h2 class="form__title">Conductor Login</h2>
				<input type="text" placeholder="User ID" name="usernameC" class="input" />
				<input type="password" placeholder="Password" name="passwordC" class="input" />
				<input type="submit" value="loginC" name = "loginC" class="btn">
			</form>
		</div>

		<!-- Driver Login -->
		<div class="container__form container--signin">
			<form action="" class="form" id="form2" method="POST">
				<h2 class="form__title">Driver Login</h2>
				<input type="text" placeholder="User ID" name="usernameD" class="input" />
				<input type="password" placeholder="Password" name="passwordD" class="input" />
				<!-- <button class="btn" onclick="validateD()">Login</button> -->
				<input type="submit" name = "loginD"value="loginD" class="btn">
			</form>
		</div>

		<!-- Overlay -->
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
	<div>
		<a class="btn" href="../../Conductor_DashBoard/AdminDashboard.html">Admin</a>
	</div>


	<!-- partial -->
	<script src="./script.js"></script>

	<?php
if(isset($_POST['loginC']))
{
	session_start();

	$username = $_POST['usernameC'];
	$password = $_POST['passwordC'];

	$connection = mysqli_connect('localhost','root','','test4');
	if(!$connection){die("Connection Error -> ".mysqli_connect_error());}

	$sql = "SELECT * FROM `login` WHERE user_name = '$username' && password = '$password'";
	$result = mysqli_query($connection, $sql);
	$num = mysqli_num_rows($result);
	if($num==1)
	{
		echo "LOGIN SUCCESSFUL";
		$_SESSION['status']="Active";
		header("refresh:0, url=../../Conductor_DashBoard/conductorDashboard.html");
	}
	else
	{
		echo "<script>alert('incorrect id or password')</script>";
		echo "<script>location.href='myLogin.php'</script>";
	}
}
if(isset($_POST['loginD']))
{
	session_start();

	$username = $_POST['usernameD'];
	$password = $_POST['passwordD'];

	$connection = mysqli_connect('localhost','root','','test4');
	if(!$connection){die("Connection Error -> ".mysqli_connect_error());}

	$sql = "SELECT * FROM `login` WHERE user_name = '$username' && password = '$password'";
	$result = mysqli_query($connection, $sql);
	$num = mysqli_num_rows($result);
	if($num==1)
	{
		echo "<script>alert('Login successful')</script>";
		$_SESSION['status']="Active";
		header("refresh:0, url=../../Conductor_DashBoard/Driver_Dashboard.html");
	}
	else
	{
		echo "<script>alert('incorrect id or password')</script>";
		echo "<script>location.href='myLogin.php'</script>";
	}
}


?>

</body>

</html>