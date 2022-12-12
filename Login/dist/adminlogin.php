<html>
<head>
<meta charset="UTF-8">
	<title>Kadamba Bus Management System</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
	<link rel="stylesheet" href="./style.css">
	<link rel="icon" type="image/x-icon" href="../../Images/favicon.ico/">
	
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
		<!-- admin Login -->
		<div class="container__form container--signup">
	<form action="" class="form" method="POST">
			<input type="text" name="username" class="input" placeholder="Enter your username">
			<input type="password" class="input" name="password" placeholder="Enter your password">
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
    <div>
		<a class="btn" href="logintest.php">back</a>
	</div>
<?php
if(isset($_POST['login']))
{
	session_start();

	$username = $_POST['username'];
	$password = $_POST['password'];

	$connection = mysqli_connect('localhost','root','','test4');
	if(!$connection){die("Connection Error -> ".mysqli_connect_error());}

	$sql = "SELECT * FROM `login_admin` WHERE user_name = '$username' && password = '$password'";
	$result = mysqli_query($connection, $sql);
	$num = mysqli_num_rows($result);
	if($num==1)
	{
		echo "<script>alert('Logged In successfuly!')</script>";
		$_SESSION['status']="Active";
        $_SESSION['username']="$username";
		header("refresh:0, url=../../Conductor_DashBoard/AdminDashBoard.php");
	}
	else
	{
		echo "<script>alert('incorrect id or password')</script>";
		echo "<script>location.href='logintest.php'</script>";
	}
}

?>
</body>
</html>

