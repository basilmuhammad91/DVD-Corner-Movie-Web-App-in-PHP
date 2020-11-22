<?php
// add_comment.php

// For Database Connection
include('database_connection.php');

$error = '';
$comment_content = '';

if(empty($_POST["comment_content"]))
{
	$error .= '<p class="text-danger">Comment is required</p>';
}
else
{
	$comment_content = $_POST["comment_content"];
	$user_id = $_POST["user_id"];
	$movie_id = $_POST["movie_id"];
}

if($error == '')
{
	$query = mysqli_query($con, "insert into tbl_comment (user_id, movie_id, ccomment_content) values ('$user_id','$movie_id','$comment_content')");
	if($query > 0)
	{
		echo json_encode(array("statusCode"=>200));
	}
	else
	{
		echo json_encode(array("statusCode"=>201));
	}
}

?>