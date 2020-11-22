<?php

// For Database Connection
include('database_connection.php');

// BRGIN HEADER

include "header.php";

// <!-- END | Header -->

if(isset($_GET['movie_id']))
{
	$user_id = $_SESSION['id'];
	$movie_id = $_GET['movie_id'];

	$query = mysqli_query($con,"select tbl_movie_id, tbl_movie_title, tbl_movie_image,tbl_movie_trailer_link, year(tbl_movie_release_date), tbl_movie_description FROM tbl_movie where tbl_movie_id = '$movie_id'") or die(mysqli_error($con));

	$std = mysqli_fetch_array($query);

}

if(isset($_POST['order_movie']))
{
	$user_id = $_POST['user_id'];
	$movie_id = $_POST['movie_id'];
	$date = date("Y-m-d H:i:s");
	$payment_type = $_POST['payment_type'];
	$status = $_POST['status'];
	$quantity = $_POST['quantity'];
	$address = $_POST['address'];
	$contact_number = $_POST['contact_number'];
	$card_number = $_POST['card_number'];
	$cnic_number = $_POST['cnic_number'];

	$query = mysqli_query($con, "insert into tbl_order (user_id, movie_id, date, payment_type, status, quantity, address, contact, card_no, cnic_no) values('$user_id','$movie_id','$date','$payment_type','$status','$quantity','$address','$contact_number','$card_number','$cnic_number')");

	// $query = mysqli_query($con,"insert into tbl_order (user_id, movie_id, date, payment_type, status, quantity, address, contact, card_no, cnic_no) values('$user_id','$movie_id','$date','$payment_type','$status','$quantity','$address','$contact_number','$card_number','$cnic_number')") or die(mysqli_error($con));

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

<!-- moviesingle07:38-->
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

<div class="hero mv-single-hero">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<!-- <h1> movie listing - list</h1>
				<ul class="breadcumb">
					<li class="active"><a href="#">Home</a></li>
					<li> <span class="ion-ios-arrow-right"></span> movie listing</li>
				</ul> -->
			</div>
		</div>
	</div>
</div>
<div class="page-single movie-single movie_single">
	<div class="container">
		<div class="row ipad-width2">
			<div class="col-md-4 col-sm-12 col-xs-12">
				<div class="movie-img sticky-sb">
					<img src="data:image/jpeg;base64,<?php echo base64_encode($std['tbl_movie_image'])?>" alt="">
					<div class="movie-btn">	
						<div class="btn-transform transform-vertical red">
							<div><a href="#" class="item item-1 redbtn"> <i class="ion-play"></i> Watch Trailer</a></div>
							<div><a href="<?php echo @$std[3]?>" class="item item-2 redbtn fancybox-media hvr-grow"><i class="ion-play"></i></a></div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-8 col-sm-12 col-xs-12">
				<div class="movie-single-ct main-content">
					<h1 class="bd-hd"><?php echo @$std[1]?> <span><?php echo @$std[4]?></span></h1>
					<div class="form-style-1 user-pro" action="#">
					
					<form action="#" method="post">

						<h4>Order Movie</h4>

						<input type="hidden" value="<?php echo $user_id?>" name="user_id">
						<input type="hidden" value="<?php echo $movie_id?>" name="movie_id">
						<input type="hidden" value="Yet to be delivered" name="status">
						
						<div class="row">
							<div class="col-md-6 form-it">
								<label>Address</label>
								<input type="text" name="address" required>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 form-it">
								<label>Contact Number</label>
								<input type="text" name="contact_number" required>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 form-it">
								<label>Card Number</label>
								<input type="text" name="card_number" required>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 form-it">
								<label>CNIC Number</label>
								<input type="text" name="cnic_number" required>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 form-it">
								<label>Quantity</label>
								<input type="number" name="quantity" required>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 form-it">
								<label>Payment type</label>
								<select name="payment_type" id="">
									<option value="">Select</option>
									<option value="Wallet">Wallet</option>
									<option value="Cash On Delivery">Cash On Delivery</option>
								</select>
							</div>
						</div>
					
						<div class="row">
							<div class="col-md-2">
								<input class="submit" type="submit" value="Order" name="order_movie">
							</div>
						</div>	
					</form>
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

<!-- moviesingle11:03-->
</html>