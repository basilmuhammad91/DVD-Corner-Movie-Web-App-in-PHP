<?php

// For Database Connection
include('database_connection.php');


// <!-- BEGIN | Header -->
include "header.php";
// <!-- END | Header -->

// FETCHING USER DETAILS FROM DATABASE
$user_id = @$_SESSION['id'];

$query = mysqli_query($con,"select * from tbl_user_registration where tbl_user_id = '$user_id'");
@$data = mysqli_fetch_array($query);

if(isset($_POST['cancel_order']))
{
	$order_id = $_POST['order_id'];
	$status = "Canceled";

	$query = mysqli_query($con,"update tbl_order set status = '$status' where order_id = '$order_id'");

	if($query)
	{
		echo "<script>window.location.href='userfavoritelist.php';</script>";
	}
	else
	{
		echo "ERROR !";
	}

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

<!-- userfavoritelist13:49-->
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
<!--login form popup-->
<div class="login-wrapper" id="login-content">
    <div class="login-content">
        <a href="#" class="close">x</a>
        <h3>Login</h3>
        <form method="post" action="#">
        	<div class="row">
        		 <label for="username">
                    Username:
                    <input type="text" name="username" id="username" placeholder="Hugh Jackman" pattern="^[a-zA-Z][a-zA-Z0-9-_\.]{8,20}$" required="required" />
                </label>
        	</div>
           
            <div class="row">
            	<label for="password">
                    Password:
                    <input type="password" name="password" id="password" placeholder="******" pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required="required" />
                </label>
            </div>
            <div class="row">
            	<div class="remember">
					<div>
						<input type="checkbox" name="remember" value="Remember me"><span>Remember me</span>
					</div>
            		<a href="#">Forget password ?</a>
            	</div>
            </div>
           <div class="row">
           	 <button type="submit">Login</button>
           </div>
        </form>
        <div class="row">
        	<p>Or via social</p>
            <div class="social-btn-2">
            	<a class="fb" href="#"><i class="ion-social-facebook"></i>Facebook</a>
            	<a class="tw" href="#"><i class="ion-social-twitter"></i>twitter</a>
            </div>
        </div>
    </div>
</div>
<!--end of login form popup-->
<!--signup form popup-->
<div class="login-wrapper"  id="signup-content">
    <div class="login-content">
        <a href="#" class="close">x</a>
        <h3>sign up</h3>
        <form method="post" action="#">
            <div class="row">
                 <label for="username-2">
                    Username:
                    <input type="text" name="username" id="username-2" placeholder="Hugh Jackman" pattern="^[a-zA-Z][a-zA-Z0-9-_\.]{8,20}$" required="required" />
                </label>
            </div>
           
            <div class="row">
                <label for="email-2">
                    your email:
                    <input type="password" name="email" id="email-2" placeholder="" pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required="required" />
                </label>
            </div>
             <div class="row">
                <label for="password-2">
                    Password:
                    <input type="password" name="password" id="password-2" placeholder="" pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required="required" />
                </label>
            </div>
             <div class="row">
                <label for="repassword-2">
                    re-type Password:
                    <input type="password" name="password" id="repassword-2" placeholder="" pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required="required" />
                </label>
            </div>
           <div class="row">
             <button type="submit">sign up</button>
           </div>
        </form>
    </div>
</div>
<!--end of signup form popup-->



<div class="hero user-hero">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="hero-ct">
					<h1><?php echo $data['1']?></h1>
					<ul class="breadcumb">
						<li class="active"><a href="#">Home</a></li>
						<li> <span class="ion-ios-arrow-right"></span>List of your Past Orders</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="page-single userfav_list">
	<div class="container">
		<div class="row ipad-width2">
			<div class="col-md-3 col-sm-12 col-xs-12">
				<div class="user-information">
					<div class="user-img">
						<a href="#"><img src="images/uploads/user-img.png" alt=""><br></a>
						<a href="#" class="redbtn">Change avatar</a>
					</div>
					<div class="user-fav">
						<p>Account Details</p>
						<ul>
							<li><a href="userprofile.php">Profile</a></li>
							<li class="active"><a href="userfavoritelist.php">Favorite movies</a></li>
							<li><a href="userrate.php">Rated movies</a></li>
						</ul>
					</div>
					<div class="user-fav">
						<p>Others</p>
						<ul>
							<li><a href="userprofile.php">Change password</a></li>
							<form action="#" method="post">
								<li class="btn submit"><input type="submit" name="signout" value="Sign Out" class="btn submit" style=" background-color: #DD003F; color: white; height: 37px; width: 100px; border: none; border-radius: 30px;font-family: 'Dosis', sans-serif; font-size: 14px; font-weight: bold; text-transform: uppercase; cursor: pointer;"></li>
							</form>
						</ul>
					</div>
				</div>
			</div>

			<div class="col-md-9 col-sm-12 col-xs-12">
				
				<div class="flex-wrap-movielist user-fav-list">

<!-- FTECHING FAVORITE MOVIES FROM DATABASE -->
					<?php
					$user_id = $_SESSION['id'];
					$query = mysqli_query($con, "
						SELECT * from tbl_order
						INNER JOIN
						tbl_movie
						ON
						tbl_movie.tbl_movie_id = tbl_order.movie_id
						WHERE tbl_order.user_id ='$user_id'
						");
					while ($row = mysqli_fetch_array($query)) {
						?>
						<div class="movie-item-style-2">
						<img src="data:image/jpeg;base64,<?php echo base64_encode($row['tbl_movie_image'] )?>" alt="">
						<div class="mv-item-infor">
							<h6><a href="#"><?php echo $row['tbl_movie_title']?> <span>(2012)</span></a></h6>
							<p class="rate"><span></span> </p><hr>
							<div class="row">
								<div class="col-md-5">
									<p style="color: white"><b>ORDER NO:</b></p>
								</div>
								<div class="col-md-7">
									<p style="color: white"><?php echo $row['order_id']?></p>
								</div>
							</div>
							<div class="row">
								<div class="col-md-5">
									<p style="color: white"><b>DATE:</b></p>
								</div>
								<div class="col-md-7">
									<p style="color: white"><?php echo $row['date']?></p>
								</div>
							</div>
							<div class="row">
								<div class="col-md-5">
									<p style="color: white"><b>PAYMENT TYPE:</b></p>
								</div>
								<div class="col-md-7">
									<p style="color: white"><?php echo $row['payment_type']?></p>
								</div>
							</div>
							<div class="row">
								<div class="col-md-5">
									<p style="color: white"><b>ADDRESS:</b></p>
								</div>
								<div class="col-md-7">
									<p style="color: white"><?php echo $row['address']?></p>
								</div>
							</div>
							<div class="row describe">
								<div class="col-md-5">
									<p style="color: white"><b>STATUS:</b></p>
								</div>
								<div class="col-md-7">
									<p style="color: white"><?php echo $row['status']?></p>
								</div>
							</div>
							
							<div class="row describe">
								<div class="col-md-4">
									<p><?php echo $row['tbl_movie_title']?></p>
								</div>
								<div class="col-md-4">
									<p><?php echo $row['quantity']?> DVDs</p>
								</div>
								<div class="col-md-4">
									<p><?php echo $row['quantity']?> X <?php echo $row['tbl_movie_price']?></p>
								</div>
							</div>
							<div class="row describe">
								<div class="col-md-8">
									<p>TOTAL PRICE</p>
								</div>
								<div class="col-md-4">
									<p>Rs: <?php echo $row['quantity']*$row['tbl_movie_price']?></p>
								</div>
							</div>
							<div class="row describe">
								<div class="col-md-4">
									
									<!-- <input type="submit" name="cancel_order" value="Cancel Order" class="btn submit" style=" background-color: #DD003F; color: white; height: 37px; width: 150px; border: none; border-radius: 30px;font-family: 'Dosis', sans-serif; font-size: 14px; font-weight: bold; text-transform: uppercase; cursor: pointer;"> -->
									
									<!-- DOWNLOAD SLIP BUTTON  -->
									<a href="order_report.php?order_id=<?php echo $row['order_id'] ?>" style=" background-color: #DD003F; color: white; height: 37px; width: 150px; border: none; border-radius: 30px;font-family: 'Dosis', sans-serif; font-size: 16px; font-weight: bold; text-transform: uppercase; cursor: pointer;text-align: center;line-height: 38px">Download Slip</a>

								</div>
								<div class="col-md-1"></div>
								<div class="col-md-7">

									<?php
									if($row['status'] == "Yet to be delivered")
									{
										?>
							<form action="#" method="post">
								<input type="hidden" value="<?php echo $row['order_id']?>" name="order_id">
								<input type="submit" name="cancel_order" value="Cancel Order" class="btn submit" style=" background-color: #DD003F; color: white; height: 37px; width: 150px; border: none; border-radius: 30px;font-family: 'Dosis', sans-serif; font-size: 14px; font-weight: bold; text-transform: uppercase; cursor: pointer;">
							</form>
										<?php
									}
									?>
									
								</div>
							</div>

							<!-- <p class="describe">Earth's mightiest heroes must come together and learn to fight as a team if they are to stop the mischievous Loki and his alien army from enslaving humanity...</p> -->
						</div>
					</div>
						<?php
					}
					?>

				</div>		
				<!-- <div class="topbar-filter"> 
					<label>Movies per page:</label>
					<select>
						<option value="range">5 Movies</option>
						<option value="saab">10 Movies</option>
					</select>
					
					<div class="pagination2">
						<span>Page 1 of 2:</span>
						<a class="active" href="#">1</a>
						<a href="#">2</a>
						<a href="#">3</a>
						<a href="#">...</a>
						<a href="#">78</a>
						<a href="#">79</a>
						<a href="#"><i class="ion-arrow-right-b"></i></a>
					</div>
				</div> -->
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

<!-- userfavoritelist14:04-->
</html>





