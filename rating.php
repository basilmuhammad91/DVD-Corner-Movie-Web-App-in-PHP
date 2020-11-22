<?php

// For Database Connection
include('database_connection.php');

// <!-- BEGIN | Header -->

include "header.php";

// <!-- END | Header -->

if(isset($_POST["save"]))
{
	// $user_id = $_SESSION['user_id'];
	// $movie_id = $_GET['movie_id'];
	$ratedIndex = $con->real_escape_string($_POST['ratedIndex']);
	$ratedIndex++;


	$query=mysqli_query($con, "insert into rating (ratedIndex) values ('$ratedIndex')");

	if ($query) {
		echo "Done";
	}
	else
	{
		echo "Error";
	}
}


?>