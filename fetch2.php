<?php

// For Database Connection
include('database_connection.php');

$output = '';

$query = "select * from tbl_movie where tbl_movie_title like '%".$_POST["search"]."%'";
// $query = "select * from tbl_movie";

$result = mysqli_query($con, $query);

if(mysqli_num_rows($result) > 0)
{
	while($row = mysqli_fetch_array($result))
	{
		$output .= "
			<div class='movie-item-style-2 movie-item-style-1' style='float:left;'>
				<img src='data:image/jpeg;base64,".base64_encode($row[8])."'>
				<div class='hvr-inner'>
	            	<a href='moviesingle.php?movie_id=".$row[0]."''> Read more <i class='ion-android-arrow-dropright'></i> </a>
				</div>
				<div class='mv-item-infor'>
								<h6><a href='moviesingle.php?movie_id=".$row[0]."'>".$row[1]."</a></h6>
								<p class='rate'><i class='ion-android-star'></i><span>8.1</span> /10</p>
								
							</div>
			</div>
		";
	}
	echo $output;
}
else
{
	echo "DATA NOR FOUND";
}

?>