<!-- BEGIN | Header -->
<?php

include "header.php";

// For Sign Out
if(isset($_POST['signout']))
{
	unset($_SESSION['Email']);
	unset($_SESSION['Name']);

	header("location: index.php");

}

// FETCHING USER DATA FROM DATABASE BY SESSION
$user_id  = @$_SESSION['id'];
$query = mysqli_query($con,"select * from tbl_user_registration where tbl_user_id = '$user_id'");
$row = mysqli_fetch_array($query);

$password = $row['tbl_user_password'];

if(isset($_POST['change_password']))
{
	$old_password = $_POST['old_password'];
	$new_password = $_POST['new_password'];
	$new_confirm_password = $_POST['new_confirm_password'];

	if($old_password == $password && $new_password == $new_confirm_password)
	{
		$query = mysqli_query($con, "update tbl_user_registration set tbl_user_password = '$new_password' where tbl_user_id = '$user_id'");
		if($query)
		{
			echo "Password Changed";
		}
		else
		{
			echo "ERROR !";
		}
	}
	else
	{
		echo "Password not corrected";
	}

}

if(isset($_POST['update']))
{
	$name = $_POST['name'];
	$email = $_POST['email'];

	$query = mysqli_query($con, "update tbl_user_registration set tbl_user_name = '$name', tbl_user_email = '$email' where tbl_user_id = '$user_id'") or die(mysqli_error($con));	

	if($query)
	{
		echo "Data Updated";
	}
	else
	{
		echo "ERROR !";	}
}
?>


<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7 no-js" lang="en-US">
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8 no-js" lang="en-US">
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html lang="en" class="no-js">

<!-- userprofile14:04-->
<head>
	<!-- Basic need -->
	<title>Open Pediatrics</title>
	<meta charset="UTF-8">
	<meta name="description" content="">
	<meta name="keywords" content="">
	<meta name="author" content="">
	<link rel="profile" href="#">

    <!--Google Font-->
    <link rel="stylesheet" href='http://fonts.googleapis.com/css?family=Dosis:400,700,500|Nunito:300,400,600' />
	<!-- Mobile specific meta -->
	<meta name=viewport content="width=device-width, initial-scale=1">
	<meta name="format-detection" content="telephone-no">

	<!-- CSS files -->
	<link rel="stylesheet" href="css/plugins.css">
	<link rel="stylesheet" href="css/style.css">

</head>
<body>
<!--preloading-->
<div id="preloader">
    <img class="logo" src="images/logo1.png" alt="" width="119" height="58">
    <div id="status">
        <span></span>
        <span></span>
    </div>
</div>
<!--end of preloading-->
<div class="hero user-hero">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="hero-ct">
					<h1><?php echo $row['tbl_user_name'] ?></h1>
					<ul class="breadcumb">
						<li class="active"><a href="#">Home</a></li>
						<li> <span class="ion-ios-arrow-right"></span>Profile</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="page-single">
	<div class="container">
		<div class="row ipad-width">
			<div class="col-md-3 col-sm-12 col-xs-12">
				<div class="user-information">
					<div class="user-img">
						<a href="#"><img src="images/uploads/user-img.png" alt=""><br></a>
						<a href="#" class="redbtn">Change avatar</a>
					</div>
					<div class="user-fav">
						<p>Account Details</p>
						<ul>
							<li  class="active"><a href="userprofile.php">Profile</a></li>
							<li><a href="userfavoritelist.php">Favorite movies</a></li>
							<li><a href="userrate.html">Rated movies</a></li>
						</ul>
					</div>
					<div class="user-fav">
						<p>Others</p>
						<ul>
							<li><a href="#">Change password</a></li>
								<form action="#" method="post">
									<li class="btn submit"><input type="submit" name="signout" value="Sign Out" class="btn submit" style=" background-color: #DD003F; color: white; height: 37px; width: 100px; border: none; border-radius: 30px;font-family: 'Dosis', sans-serif; font-size: 14px; font-weight: bold; text-transform: uppercase; cursor: pointer;"></li>
								</form>
						</ul>
					</div>
				</div>
			</div>
			<div class="col-md-9 col-sm-12 col-xs-12">
				<div class="form-style-1 user-pro" action="#">
					<form action="#" method="post" class="user">
						<h4>01. Profile details</h4>
						<div class="row">
							<div class="col-md-6 form-it">
								<label>Username</label>
								<input type="text" name="name" value="<?php echo $row['tbl_user_name']?>" required>
							</div>
							<div class="col-md-6 form-it">
								<label>Email Address</label>
								<input type="text" name="email" value="<?php echo $row['tbl_user_email'] ?>" required>
							</div>
						</div>
						<div class="row">
							<div class="col-md-2">
								<input class="submit" type="submit" name="update" value="save" required>
							</div>
						</div>	
					</form>
					<form action="#" method="post" class="password">
						<h4>02. Change password</h4>
						<div class="row">
							<div class="col-md-6 form-it">
								<label>Old Password</label>
								<input type="password" name="old_password" placeholder="**********" required>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 form-it">
								<label>New Password</label>
								<input type="password" name="new_password" placeholder="***************" required>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 form-it">
								<label>Confirm New Password</label>
								<input type="password" name="new_confirm_password" placeholder="*************** " required>
							</div>
						</div>
						<div class="row">
							<div class="col-md-2">
								<input class="submit" type="submit" value="change" name="change_password">
							</div>
						</div>	
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- footer section-->
<?php

include "footer.php";

?><!-- end of footer section-->

<script src="js/jquery.js"></script>
<script src="js/plugins.js"></script>
<script src="js/plugins2.js"></script>
<script src="js/custom.js"></script>
</body>

<!-- userprofile14:04-->
</html>