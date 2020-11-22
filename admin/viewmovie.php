<?php
// Include Database
include('../database_connection.php');

// Include Universal Layout for Admin sidebars 
include('layout.php');

// Delete row work 
if(isset($_GET['delete_id']))
{
    $dltid = $_GET['delete_id'];

    $query = mysqli_query($con,"delete from tbl_movie where tbl_movie_id = '$dltid'");

    if($query)
    {
        echo "<script>alert('Deleted Successfully');</script>";
    }
    else
    {
        echo "<script>alert('Error');</script>";
    }

}
if(isset($_POST["change_image"]))
{
    $id=$_POST["Id"];
    $img=addslashes(file_get_contents($_FILES['Img']['tmp_name']));
    $column=$_POST["Column"];

    $query=mysqli_query($con, "update tbl_movie set $column = '$img' where tbl_movie_id = '$id'") or die(mysqli_error($con));

    if($query)
    {
          echo "<script>alert('Image Update Successfully');</script>";
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
    <title>View Users</title>
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
                                VIEW MOVIES
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                <a href="addmovie.php" class="btn btn-primary waves-effect">ADD NEW MOVIES</a>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>Movie Title</th>
                                            <th>Movie Release Date</th>
                                            <th>Movie Category</th>
                                            <th>Movie Producer</th>
                                            <th>Movie Price</th>
                                            <th>Movie Description</th>
                                            <th>Movie Trailer Link</th>
                                            <th>Movie Image</th>
                                            <th>Movie Slider Image</th>
                                            <th>Movie Page Image</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Movie Title</th>
                                            <th>Movie Release Date</th>
                                            <th>Movie Category</th>
                                            <th>Movie Producer</th>
                                            <th>Movie Price</th>
                                            <th>Movie Description</th>
                                            <th>Movie Trailer Link</th>
                                            <th>Movie Image</th>
                                            <th>Movie Slider Image</th>
                                            <th>Movie Page Image</th>
                                            <th>Actions</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                        $query = mysqli_query($con,"select * from tbl_movie");
                                        while($row = mysqli_fetch_array($query))
                                        {

                                        ?>
                                        <tr>
                                            <td><?php echo $row[1]?></td>
                                            <td><?php echo $row[2]?></td>
                                            <td><?php echo $row[3] ?></td>
                                            <td><?php echo $row[4] ?></td>
                                            <td><?php echo $row[5] ?></td>
                                            <td><?php echo $row[6] ?></td>
                                            <td><?php echo $row[7] ?></td>
                                            <td>
                                                <img src="data:image/jpeg;base64,<?php echo base64_encode($row[8])?>" width="70" height="70" alt="Movie Image">    
                                            <form action="viewmovie.php" method="post" enctype="multipart/form-data">
                                            <input type="hidden" name="Column" value="tbl_movie_image" >
                                            <input type="hidden" name="Id" value="<?php echo $row[0]?>">

                                            <input type="file" name="Img">
                                            <input type="submit" value="Update Image" name="change_image" class="btn btn-primary waves-effect">
                                            </form>
                                            </td>
                                            <td>
                                                <img src="data:image/jpeg;base64,<?php echo base64_encode($row[9])?>" width="70" height="70" alt="Movie Image">
                                                <form action="viewmovie.php" method="post" enctype="multipart/form-data">
                                            <input type="hidden" name="Column" value="tbl_movie_slider_image" >
                                            <input type="hidden" name="Id" value="<?php echo $row[0]?>">

                                            <input type="file" name="Img">
                                            <input type="submit" value="Update Image" name="change_image" class="btn btn-primary waves-effect">
                                            </form>
                                            </td>
                                            <td>
                                                <img src="data:image/jpeg;base64,<?php echo base64_encode($row[10])?>" width="70" height="70" alt="Movie Image">
                                                <form action="viewmovie.php" method="post" enctype="multipart/form-data">
                                            <input type="hidden" name="Column" value="tbl_movie_page_image" >
                                            <input type="hidden" name="Id" value="<?php echo $row[0]?>">

                                            <input type="file" name="Img">
                                            <input type="submit" value="Update Image" name="change_image" class="btn btn-primary waves-effect">
                                            </form>
                                            

                                            </td>
                                            <td>
                                                <a href="viewmovie.php?delete_id=<?php echo $row[0]?>" class="btn btn-primary waves-effect">Delete</a>
                                                <a href="addmovie.php?edit_id=<?php echo $row[0]?>" class="btn btn-primary waves-effect">Edit</a>
                                              
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