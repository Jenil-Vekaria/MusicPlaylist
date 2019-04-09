<?php
session_start();
require_once("Connect.php");

/*To ensure we have the form filled out*/
if(isset($_POST) & !empty($_POST)){
	$username = mysqli_real_escape_string($connection, $_POST['username']);
	$password = md5($_POST['password']);

	/*Check whether the information is in the database*/
	$check_in_database = "SELECT * FROM `userInfo` where username='$username' AND password='$password' ";
	$result = mysqli_query($connection, $check_in_database);
	$count = mysqli_num_rows($result);

	//success
	if($count == 1){
		$_SESSION['username'] = strtolower($username);
		if($_SESSION['username'] == 'admin')
			header("location: admin.php");
		else
			header("location: user.php");
	}
	//fail
	else
		$fmsg = "Invalid username/password";
}

if(isset($_SESSION['username'])){
	if($_SESSION['username'] == 'admin')
		header("location: admin.php");
	else
		header("location: user.php");
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Login Page</title>
		<meta name=viewport content='width=700'>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

  	<!--Bootsrap 4 CDN-->
  	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

      <!--Fontawesome CDN-->
  	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">

  	<!--Custom styles-->
  	<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>

<div class="container">
	<div class="d-flex justify-content-center h-100">
		<div class="cardLogin">
			<div class="card-header">
				<h3>Login</h3>
			</div>
			<div class="card-body">
				<form method="POST">
					<?php if(isset($fmsg)){ ?> <div class="alert alert-danger"> <?php echo $fmsg; ?> </div> <?php }?>
					<?php if(isset($smsg)){ ?> <div class="alert alert-success"> <?php echo $smsg; ?> </div> <?php }?>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input type="text" name="username" class="form-control" placeholder="username" required>
					</div>

					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input type="password" name="password" class="form-control" placeholder="password" required>
					</div>

          <div class="row align-items-center remember">
            <input type="checkbox">Remember Me
          </div>

					<div class="form-group">
						<input type="submit" value="Login" class="btn float-right login_btn">
					</div>
				</form>
			</div>
			<br/>

			<div class="card-footer">
				<div class="d-flex justify-content-center links">
					Don't have an account?<a href="register.php">Sign Up</a>
				</div>
			</div>


		</div>
	</div>
</div>
</body>
</html>
