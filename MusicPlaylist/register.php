<?php
require_once("Connect.php");

/*To ensure we have the form filled out*/
if(isset($_POST) & !empty($_POST)){
	$username = mysqli_real_escape_string($connection, $_POST['username']);
	$password = md5($_POST['password']);
	$confirm_password = md5($_POST['confirm_password']);

	$does_user_exists = "SELECT * FROM `userInfo` WHERE username='$username'";
	$result = mysqli_query($connection, $does_user_exists);
	$count = mysqli_num_rows($result);
	if($count == 1)
		$fmsg = "User already exists";
	else {
		if($password != $confirm_password)
			$pmsg = "Password do not match";
		else {
			$sql = "INSERT INTO `userInfo` (username, password) VALUES ('$username', '$password')";
			$result = mysqli_query($connection, $sql);
			if($result)
				$smsg = "Registeration Sucessful";
		}
	}
}


?>

<!DOCTYPE html>
<html>
<head>
	<title>Register Page</title>

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
		<!--CARD !-->
		<div class="card">

			<!--LOGIN TITLE !-->
			<div class="card-header">
				<h3>Register</h3>
			</div>

			<!--REGISTER INFORMATION !-->
			<div class="card-body">
				<form method="POST">

					<!--SUCCESS / ERROR Message !-->
					<?php if(isset($fmsg)){ ?> <div class="alert alert-danger"> <?php echo $fmsg; ?> </div> <?php }?>
					<?php if(isset($pmsg)){ ?> <div class="alert alert-danger"> <?php echo $pmsg; ?> </div> <?php }?>
					<?php if(isset($smsg)){ ?> <div class="alert alert-success"> <?php echo $smsg; ?> </div> <?php }?>


					<!--USERNAME !-->
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input type="text" name="username" class="form-control" placeholder="username" required>
					</div>

					<!--PASSWORD !-->
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input type="password" name="password"class="form-control" placeholder="password" required>
					</div>

					<!--CONFIRM PASSWORD!-->
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input type="password" name="confirm_password" class="form-control" placeholder="confirm password" required>
					</div>

					<!--REGISTER BUTTON !-->
					<div class="form-group">
						<input type="submit" value="Register" class="btn float-right login_btn">
					</div>

				</form>
			</div>

			<!--HAVE AN ACCOUNT !-->
			<div class="card-footer">
				<div class="d-flex justify-content-center links">
					Already have an account?<a href="login.php">Login</a>
				</div>
			</div>


		</div>
	</div>
</div>


</body>
</html>
