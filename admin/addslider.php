<?php
// Include Database
include('../database_connection.php');

// Include Universal Layout for Admin sidebars 
include('layout.php');

// Insert data into database
if(isset($_POST['addslider']))
{
    $movie = $_POST['movie'];

    $query = mysqli_query($con,"insert into tbl_slider (movie_id) values('$movie')");

    if($query>0)
    {
        echo "<script>window.location.href='viewslider.php';</script>";
    }
    else
    {
        echo "<script>alert('Not Inserted');</script>";
    }
}

// Edit work from view slider page
if(isset($_GET['edit_id']))
{
    $edtid = $_GET['edit_id'];

    $query = mysqli_query($con, "select * from tbl_slider where tbl_slider_id = '$edtid'");

    $std = mysqli_fetch_array($query);
}

// Update User Data 
if(isset($_POST['updateslider']))
{
    $id = $_POST['Id'];
    $movie = $_POST['movie'];

    $query = mysqli_query($con,"update tbl_slider set movie_id = '$movie' where 	tbl_slider_id = '$id'") or die(mysqli_error($con));

    if($query)
    {
        echo "<script>window.location.href='viewslider.php';</script>";
    }
    else
    {
        echo "<script>alert('Not Inserted');</script>";
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Users </title>
</head>
<body>

<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>FORM EXAMPLES</h2>
            </div>

            <!-- Vertical Layout -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                ADD SLIDER MOVIES
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else here</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        
                        <div class="body">
                            <form method="post" action="addslider.php" enctype="multipart/form-data">
                             <!-- Movie Slider Info -->
                             <div class="row clearfix">
                                    <div class="col-md-3 form-group">
                                    <p>
                                        <b>Movie On Slider</b>
                                    </p>
                                    <input type="hidden" name="Id" value="<?php echo @$std[0]?>">
                                    <select name="movie" class="form-control show-tick form-group">
                                    
                                        <option value="Select">Select</option>
                                        <?php
                                        $query = mysqli_query($con,"select * from tbl_movie");
                                        while($row = mysqli_fetch_array($query))
                                        {
                                        ?>
                                            <option <?php if(@$std[1] == @$row[0]) echo "selected"?> value="<?php echo $row[0]?>"><?php echo $row[1]?></option>
                                        <?php
                                        }
                                        ?>
                                       
                                    </select>

                                </div>
                                </div>

                                <?php
                                if(isset($_GET['edit_id']))
                                {
                                    ?>
                                    <button type="submit" name="updateslider" class="btn btn-primary m-t-15 waves-effect">EDIT SLIDER INFO</button>
                                    <?php
                                }
                                else
                                {
                                    ?>
                                    <button type="submit" name="addslider" class="btn btn-primary m-t-15 waves-effect">ADD SLIDER INFO</button>
                                <?php
                                }
                                ?>

                                
                                
                            </form>
                        </div>
                       
                    </div>
                </div>
            </div>

</body>
</html>