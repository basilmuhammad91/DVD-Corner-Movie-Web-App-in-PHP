<?php

// Include Database
include('../database_connection.php');

$output = '';

$query = "select * from tbl_artists INNER JOIN tbl_movie ON tbl_movie.tbl_movie_id = tbl_artists.tbl_movie_id where tbl_Artists_name like '%".$_POST["search"]."%'";

$result = mysqli_query($con,$query);

if(mysqli_num_rows($result))
{
    $output.= "<h4>Search Artists</h4>";
    $output.= "
    <table class='table table-bordered table-striped table-hover js-basic-example dataTable'>
		<thead>
	    <tr>
	        <th>Artist Name</th>
            <th>Description</th>
            <th>Artist Image</th>
	        <th>Artist Mobie</th>
	    </tr>
	    </thead>
	    <tbody>
    ";

    while($row = mysqli_fetch_array($result))
    {
        $output.= "
        <tr>
            <td>".$row['1']."</td>
            <td>".$row['2']."</td>
            <td><img src='data:image/jpeg;base64,".base64_encode($row[3])."' width='70' height='70' ></td>
            <td>".$row['tbl_movie_title']."</td>

            <td>
                <a href='viewartists?delete_id=".$row[0]."' class='btn btn-primary waves-effect'>Delete</a>
                <a href='addartists.php?edit_id=".$row[0]."' class='btn btn-primary 	waves-effect'>Edit</a>
            </td>

        </tr>
        ";
    }

    $output .= "</tbody></table>";
	echo $output;

}

else
{
    echo "DATA_NOT_FOUND";
}

?>
