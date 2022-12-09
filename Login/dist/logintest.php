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
	<form action="" method="POST">
		<table>
			<tr>
				<td>
					<input type="text" name="username" placeholder="Enter your username">
				</td>
				<td>
					<input type="password" name="password" placeholder="Enter your password">
				</td>
			</tr>
			<tr>
				<td>
					<input type="submit" name="loginC" value="login">
				</td>
			</tr>
		</table>
	</form>

    <form action="" method="POST">
		<table>
			<tr>
				<td>
					<input type="text" name="username" placeholder="Enter your username">
				</td>
				<td>
					<input type="password" name="password" placeholder="Enter your password">
				</td>
			</tr>
			<tr>
				<td>
					<input type="submit" name="loginD" value="login">
				</td>
			</tr>
		</table>
	</form>
	<?php
if(isset($_POST['loginC']))
{
	session_start();

	$username = $_POST['username'];
	$password = $_POST['password'];

	$connection = mysqli_connect('localhost','root','','test4');
	if(!$connection){die("Connection Error -> ".mysqli_connect_error());}

	$sql = "SELECT * FROM `login` WHERE user_name = '$username' && password = '$password'";
	$result = mysqli_query($connection, $sql);
	$num = mysqli_num_rows($result);
	if($num==1)
	{
		echo "<script>alert('Logged In successfuly!')</script>";
		$_SESSION['status']="Active";
        $_SESSION['username']="$username";
		header("refresh:0, url=../../Conductor_DashBoard/conductorDashboard.php");
	}
	else
	{
		echo "<script>alert('incorrect id or password')</script>";
		echo "<script>location.href='logintest.php'</script>";
	}
}


if(isset($_POST['loginD']))
{
	session_start();

	$username = $_POST['username'];
	$password = $_POST['password'];

	$connection = mysqli_connect('localhost','root','','test4');
	if(!$connection){die("Connection Error -> ".mysqli_connect_error());}

	$sql = "SELECT * FROM `login` WHERE user_name = '$username' && password = '$password'";
	$result = mysqli_query($connection, $sql);
	$num = mysqli_num_rows($result);
	if($num==1)
	{
		echo "<script>alert('Logged In successfuly!')</script>";
		$_SESSION['status']="Active";
        $_SESSION['username']="$username";
		header("refresh:0, url=../../Conductor_DashBoard/Driver_DashBoard.php");
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

