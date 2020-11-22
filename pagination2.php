<?php
// Pagination2.php

// For Database Connection
include('database_connection.php');

$record_per_page = 6;
$page = '';
$output = '';

if(isset($_POST['page']))
{
	$page = $_POST['page'];
}
else
{
	$page = 1;
}

$start_from = ($page - 1) * $record_per_page;

$result = mysqli_query($con,"select * from tbl_movie limit $start_from,$record_per_page");

while($row = mysqli_fetch_array($result))
	{
		$output .= "
			<div class='movie-item-style-2 movie-item-style-1' style='float:left'>
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
	$output .= '<br>';

	$page_result = mysqli_query($con, "select * from tbl_movie");
	$total_records = mysqli_num_rows($page_result);
	$total_pages = ceil($total_records/$record_per_page);

	for($i = 1; $i <= $total_pages; $i++)
	{
		$output .= "
			<span class='pagination_link text-center' style='padding:5px; border: solid 1px black; background-color: white; cursor: pointer' id='".$i."'>".$i."</span>
		";
	}


	$output .="<br><br>";
	echo $output;

?>