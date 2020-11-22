<?php
// Include Database
include('../database_connection.php');

// Include Universal Layout for Admin sidebars 
include('layout.php');

// Delete row work 
if(isset($_GET['delete_id']))
{
    $dltid = $_GET['delete_id'];

    $query = mysqli_query($con,"delete from tbl_ontv where tbl_ontv_id = '$dltid'");

    if($query)
    {
        echo "<script>alert('Deleted Successfully');</script>";
    }
    else
    {
        echo "<script>alert('Error');</script>";
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View ONTV MOvies Info</title>
</head>
<body>

<section class="content">
        <div class="container-fluid">
            
            <!-- Basic Examples -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                VIEW ONTV MOVIES INFO
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                <a href="addontv.php" class="btn btn-primary waves-effect">ADD NEW ONTV MOVIE</a>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>Movie</th>
                                            <th>Movie Title</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Movie</th>
                                            <th>Movie Title</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                        $query = mysqli_query($con,"SELECT tbl_ontv.tbl_ontv_id, tbl_ontv.movie_id, tbl_movie.tbl_movie_title FROM tbl_ontv INNER JOIN tbl_movie ON tbl_ontv.movie_id = tbl_movie.tbl_movie_id");
                                        while($row = mysqli_fetch_array($query))
                                        {

                                        ?>
                                        <tr>
                                            <td><?php echo $row[1]?></td>
                                            <td><?php echo $row[2]?></td>
                                            <td>
                                                <a href="viewontv.php?delete_id=<?php echo $row[0]?>" class="btn btn-primary waves-effect">Delete</a>
                                                <a href="addontv.php?edit_id=<?php echo $row[0]?>" class="btn btn-primary waves-effect">Edit</a>
                                              
                                            </td>
                                        </tr>
                                        <?php
                                            }
                                        ?>
                                      
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Basic Examples -->
          
        </div>
    </section>

    
</body>
</html>