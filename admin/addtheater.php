<?php
// Include Database
include('../database_connection.php');

// Include Universal Layout for Admin sidebars 
include('layout.php');

// Insert data into database
if(isset($_POST['addtheater']))
{
    $movie = $_POST['movie'];

    $query = mysqli_query($con,"insert into theaterinfo (movie_id) values('$movie')");

    if($query>0)
    {
        echo "<script>window.location.href='viewtheater.php';</script>";
    }
    else
    {
        echo "<script>alert('Not Inserted');</script>";
    }
}

// Edit work from view theater page
if(isset($_GET['edit_id']))
{
    $edtid = $_GET['edit_id'];

    $query = mysqli_query($con, "select * from theaterinfo where theater_id = '$edtid'");

    $std = mysqli_fetch_array($query);
}

// Update User Data 
if(isset($_POST['updatetheater']))
{
    $id = $_POST['Id'];
    $movie = $_POST['movie'];

    $query = mysqli_query($con,"update theaterinfo set movie_id = '$movie' where 	theater_id = '$id'") or die(mysqli_error($con));

    if($query)
    {
        echo "<script>window.location.href='viewtheater.php';</script>";
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
                                ADD THEATER MOVIES
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
                            <form method="post" action="addtheater.php" enctype="multipart/form-data">
                             <!-- Movie Theater Info -->
                             <div class="row clearfix">
                                    <div class="col-md-3 form-group">
                                    <p>
                                        <b>Movie In Theater</b>
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
                                    <button type="submit" name="updatetheater" class="btn btn-primary m-t-15 waves-effect">EDIT THEATER INFO</button>
                                    <?php
                                }
                                else
                                {
                                    ?>
                                    <button type="submit" name="addtheater" class="btn btn-primary m-t-15 waves-effect">ADD THEATER INFO</button>
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