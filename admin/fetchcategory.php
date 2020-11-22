<?php

// Include Database
include('../database_connection.php');

$output = '';
$search = $_POST['search'];

$query = "select * from tbl_category where tbl_category_name like '%".$_POST["search"]."%'";

$result = mysqli_query($con, $query);

if(mysqli_num_rows($result) > 0)
{
	$output .= "<h4>Search Category</h4>";
	$output .= "
	<table class='table table-bordered table-striped table-hover js-basic-example dataTable'>
		<thead>
	    <tr>
	        <th>Category Name</th>
	        <th>Category Description</th>
	        <th>Actions</th>
	    </tr>
	    </thead>
	    <tbody>
	";
	while($row = mysqli_fetch_array($result))
	{
		$output .= "
			<tr>
				<td>".$row['1']."</td>
				<td>".$row['2']."</td>
				<td>
					<a href='viewcategory.php?delete_id=".$row[0]."' class='btn btn-primary waves-effect'>Delete</a>
                    <a href='addcategory.php?edit_id=".$row[0]."' class='btn btn-primary waves-effect'>Edit</a>
                                              
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