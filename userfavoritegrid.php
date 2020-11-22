
<?php


// For Database Connection
include('database_connection.php');

// <!-- BEGIN | Header -->
include "header.php";
// <!-- END | Header -->

// FETCHING USER DETAILS FROM DATABASE
$user_id = @$_SESSION['id'];

$query = mysqli_query($con,"select * from tbl_user_registration where tbl_user_id = '$user_id'");
$data = mysqli_fetch_array($query);

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

<!-- userfavoritegrid13:40-->
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
					<h1><?php echo $data['tbl_user_name']?></h1>
					<ul class="breadcumb">
						<li class="active"><a href="#">Home</a></li>
						<li> <span class="ion-ios-arrow-right"></span>Favorite movies</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="page-single">
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
				<div class="topbar-filter user">
					<p>Found <span>1,608 movies</span> in total</p>
					<label>Sort by:</label>
					<select>
						<option value="range">-- Choose option --</option>
						<option value="saab">-- Choose option 2--</option>
					</select>
					<a href="userfavoritelist.php" class="list"><i class="ion-ios-list-outline "></i></a>
					<a  href="userfavoritegrid.php" class="grid"><i class="ion-grid active"></i></a>
				</div>
				<div class="flex-wrap-movielist grid-fav">
						
						<!-- FTECHING FAVORITE MOVIES FROM DATABASE -->
						<?php
						$query = mysqli_query($con, "
						SELECT tbl_user_registration.tbl_user_name, favorite.fav_id, favorite.mov_id, tbl_movie.tbl_movie_title, tbl_movie.tbl_movie_image 
						FROM favorite 
						INNER JOIN
						tbl_movie
						ON
						tbl_movie.tbl_movie_id = favorite.mov_id
						INNER JOIN 
						tbl_user_registration
						ON
						tbl_user_registration.tbl_user_id = favorite.user_id
						WHERE favorite.user_id = '$user_id'");

						while ($row = mysqli_fetch_array($query)) {
							?>
							<div class="movie-item-style-2 movie-item-style-1 style-3">
							<img src="data:image/jpeg;base64,<?php echo base64_encode($row['tbl_movie_image'])?>" alt="">
							<div class="hvr-inner">
	            				<a  href="moviesingle.php?movie_id=<?php echo $row['mov_id']?>"> Read more <i class="ion-android-arrow-dropright"></i> </a>
	            			</div>
							<div class="mv-item-infor">
								<h6><a href="moviesingle.php"><?php echo $row['tbl_movie_title'] ?></a></h6>
								<p class="rate"><i class="ion-android-star"></i><span>8.1</span> /10</p>
							</div>
						</div>
						<?php
						}
						?>			
						
				</div>		
				<div class="topbar-filter">
					<label>Movies per page:</label>
					<select>
						<option value="range">20 Movies</option>
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

<!-- userfavoritegrid13:49-->
</html>