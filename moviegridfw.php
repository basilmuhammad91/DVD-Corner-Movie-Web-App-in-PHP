<?php

// For Database Connection
include('database_connection.php');

// <!-- BEGIN | Header -->
include "header.php";
// <!-- END | Header -->


// IT WILL ADD MOVIES TO FAVOURITE GRID
if(isset($_POST['add_fav']))
{
	$user_id = $_POST['user_id'];
	$movie_id = $_POST['movie_id'];

	$query = mysqli_query($con, "insert into favorite (user_id, mov_id) values ('$user_id','$movie_id')");
	if($query > 0)
	{
		echo "Movie added";
	}
	else
	{
		echo "Movie not added";
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

<!-- moviegridfw07:38-->
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

	<script>
		$(document).ready(function(){
			$('#search_text').on('keyup',function(){
				var txt = $(this).val();
				if(txt != '')
				{
					$.ajax({
						url: "fetch.php",
						method: "post",
						data: {search: txt},
						dataType: "text",
						success: function(data){
							$('#result').html(data);
							$('.showAll').hide();
						}
					});
				}
				else
				{
					$('#result').html('');
					$('.showAll').show();
				}
			});

			// AJAX PAGINATION

			load_data(3);
			function load_data(page){
				$.ajax({
					url: 'pagination2.php',
					method: 'POST',
					data: {page:page},
					success: function(data){
						$('#pagination_data').html(data);
					}
				});
			}	

			$(document).on('click','.pagination_link', function(){
				var page = $(this).attr('id');
				load_data(page);
			});

		});
	</script>

</head>
<body>

<div class="hero common-hero">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="hero-ct">
					<h1>Movie Listing - Grid Fullwidth</h1>
					<ul class="breadcumb">
						<li class="active"><a href="#">Home</a></li>
						<li> <span class="ion-ios-arrow-right"></span> movie listing</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="page-single">
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="topbar-filter fw">
					<p>Found <span>1,608 movies</span> in total</p>
					<label>Sort by:</label>
					<select>
						<option value="popularity">Popularity Descending</option>
						<option value="popularity">Popularity Ascending</option>
						<option value="rating">Rating Descending</option>
						<option value="rating">Rating Ascending</option>
						<option value="date">Release date Descending</option>
						<option value="date">Release date Ascending</option>
					</select>
					<a href="movielist.html" class="list"><i class="ion-ios-list-outline "></i></a>
					<a  href="moviegridfw.html" class="grid"><i class="ion-grid active"></i></a>
				</div>

				<!-- Search Bar -->
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<input type="text" placeholder="Search for a movie, TV Show or celebrity that you are looking for" class="form-control" style="background: #233a50 !important; margin-bottom: 30px; border: none; height: 40px; color: white" name="search_text" id="search_text">
						</div>
					</div>
				</div>

				<div class="flex-wrap-movielist mv-grid-fw">
						<div id="result"></div>
						<div id="pagination_data"></div>

						<!-- FETCHING MOVIES FROM DATABASE -->
						<?php
						$query = mysqli_query($con,"select * from tbl_movie");
						while ($row = mysqli_fetch_array($query)) {
							?>
							<div class="movie-item-style-2 movie-item-style-1 showAll">
							<img src="data:image/jpeg;base64,<?php echo base64_encode($row[8])?>" alt="">
							<div class="hvr-inner">
	            				<a  href="moviesingle.php?movie_id=<?php echo $row[0]?>"> Read more <i class="ion-android-arrow-dropright"></i> </a>
	            			</div>
							<div class="mv-item-infor">
								<h6><a href="moviesingle.php?movie_id=<?php echo $row[0]?>"><?php echo $row[1]?></a></h6>
								<p class="rate"><i class="ion-android-star"></i><span>8.1</span> /10</p>
								
								<?php
								if(isset($_SESSION['Email']))
								{
									?>

								<form action="#" method="post" margin="0">
									<input type="hidden" name="user_id" value="<?php echo $_SESSION['id'] ?>">
									<input type="hidden" name="movie_id" value="<?php  echo $row[0]?>">
									<input type="submit" name="add_fav" value="Add to Favourite" class="btn submit" style=" background-color: #DD003F; color: white; height: 37px; border: none; border-radius: 30px;font-family: 'Dosis', sans-serif; font-size: 14px; font-weight: bold; text-transform: uppercase; cursor: pointer; padding: 0 10px 0 10px;">
								</form>	

									<?php
								}
								?>

							</div>
						</div>
						<?php
						}
						?>
						<!-- END OF FETCHING MOVIES -->

					
						
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

<!-- moviegridfw07:38-->
</html>