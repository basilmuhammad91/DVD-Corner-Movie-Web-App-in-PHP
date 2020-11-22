<?php
// Include Database
include('../database_connection.php');

// Include Universal Layout for Admin sidebars 
include('layout.php');

// Insert data into database
if(isset($_POST['addmovie']))
{
    $title = $_POST['title'];
    $date = $_POST['date'];
    $category = $_POST['category'];
    $producer = $_POST['producer'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $link = $_POST['link'];
    $img = addslashes(file_get_contents($_FILES['image']['tmp_name']));
    $slider_img = addslashes(file_get_contents($_FILES['slider_image']['tmp_name']));
    $page_img = addslashes(file_get_contents($_FILES['page_image']['tmp_name']));

    $query = mysqli_query($con, "insert into tbl_movie (tbl_movie_title, tbl_movie_release_date, tbl_Category_id, tbl_producer_id, tbl_movie_price, tbl_movie_description, tbl_movie_trailer_link, tbl_movie_image, tbl_movie_slider_image, tbl_movie_page_image) values('$title','$date','$category','$producer','$price','$description','$link','$img','$slider_img','$page_img')");


    if($query>0)
    {
        echo "<script>window.location.href='viewmovie.php';</script>";
    }
    else
    {
        echo "<script>alert('Not Inserted');</script>";
    }
}

// Edit work from View Movie page
if(isset($_GET['edit_id']))
{
    $edtid = $_GET['edit_id'];

    $query = mysqli_query($con, "select * from tbl_movie where tbl_movie_id = '$edtid'");

    $std = mysqli_fetch_array($query);
}

// Update Singer Data 
if(isset($_POST['updatesinger']))
{
    $id = $_POST['id'];
    $title = $_POST['title'];
    $date = $_POST['date'];
    $category = $_POST['category'];
    $producer = $_POST['producer'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $link = $_POST['link'];
    $img = addslashes(file_get_contents($_FILES['image']['tmp_name']));
    $slider_img = addslashes(file_get_contents($_FILES['slider_image']['tmp_name']));
    $page_img = addslashes(file_get_contents($_FILES['page_image']['tmp_name']));

    $query = mysqli_query($con,"update tbl_movie set tbl_movie_title = '$title', 	tbl_movie_release_date = '$date', tbl_Category_id = '$category', tbl_producer_id = '$producer', tbl_movie_price = '$price', tbl_movie_description = '$description', tbl_movie_trailer_link = '$link', tbl_movie_image = '$img', tbl_movie_slider_image = '$slider_img', tbl_movie_page_image = '$page_img' where tbl_movie_id = '$id'") or die(mysqli_error($con));

    if($query)
    {
        echo "<script>window.location.href='viewmovie.php';</script>";
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
    <?php
    if(isset($_GET['edit_id']))
    {
?>
<title>Edit Movies | Block Buster Film Review<</title>
<?php
    }
    else
    {
        ?>
        <title>Add Movies | Block Buster Film Review<</title>
        <?php
    }
    ?>

</head>
<body>

<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>Add Movies | Block Buster Film Review</h2>
            </div>

            <!-- Vertical Layout -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                ADD MOVIE
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
                            <form method="post" action="addmovie.php" enctype="multipart/form-data">
                            <!-- Movie Title -->
                            <label for="email_address">Movie Title</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="hidden" name="Id" value="<?php echo @$std[0]?>">
                                        <input type="text" class="form-control" placeholder="Enter Movie Title" required name="title" value="<?php echo @$std[1]?>">
                                    </div>
                                </div>
                                
                                <!-- Movie Release Date -->
                                <label for="date">Movie Release Date</label>
                                <div class="form-group">
                                    <div class="form-line">
                                    <input type="date" class="form-control" required name="date" value="<?php echo @$std[2]?>" style="width:auto">
                                    </div>
                                </div>

                                 <!-- Movie Category -->
                                 <div class="row clearfix">
                                    <div class="col-md-3 form-group">
                                    <p>
                                        <b>Movie Category</b>
                                    </p>
                                    <select name="category" class="form-control show-tick form-group">
                                        <option value="Select">Select</option>
                                        <?php
                                        $query = mysqli_query($con,"select * from tbl_category");
                                        while($row = mysqli_fetch_array($query))
                                        {
                                        ?>
                                            <option <?php if(@$std[3] == @$row[1]) echo "selected"?> value="<?php echo $row[0]?>"><?php echo $row[1]?></option>
                                        <?php
                                        }
                                        ?>
                                       
                                    </select>

                                </div>
                                </div>

                                <!-- Movie Producer -->
                                
                                <div class="row clearfix">
                                    <div class="col-md-3 form-group">
                                    <p>
                                        <b>Movie Producer</b>
                                    </p>
                                    <select name="producer" class="form-control show-tick form-group">
                                        <option value="Select">Select</option>
                                        <?php
                                        $query = mysqli_query($con,"select * from tbl_producer");
                                        while($row = mysqli_fetch_array($query))
                                        {
                                        ?>
                                            <option value="<?php echo $row[0]?>"><?php echo $row[1]?></option>
                                        <?php
                                        }
                                        ?>
                                       
                                    </select>

                                </div>
                                </div>

                                <!-- Movie Price  -->
                                <label for="date">Movie Price</label>
                                <div class="form-group">
                                    <div class="form-line">
                                    <input type="text" class="form-control" placeholder="Enter Movie Price" required name="price" value="<?php echo @$std[5]?>">
                                    </div>
                                </div>


                                <!-- Description  -->
                                <label for="date">Movie Description</label>
                                <div class="form-group">
                                    <div class="form-line">
                                    <textarea name="description" cols="30" rows="5" class="form-control no-resize" required="" aria-required="true" placeholder="Enter description"><?php echo @$std[6]?></textarea>
                                    </div>
                                </div>

<br>
                                    
                                <!-- Movie Trailer Youtube Link  -->
                                <label for="date">Movie Trailer Youtube Link</label>
                                <div class="form-group">
                                    <div class="form-line">
                                    <input type="text" class="form-control" placeholder="Enter Youtube Link for Trailer" required name="link" value="<?php echo @$std[7]?>">
                                    </div>
                                </div>

                                <!-- For Movie Image -->
                                <label for="description">Movie Image</label>
                                <div class="fallback">
                                    <input name="image" type="file" accept="image/jpeg" multiple/>
                                    <?php
                                    if(isset($_GET['edit_id']))
                                    {
                                        ?>
                                        <img src="data:image/jpeg;base64,<?php echo base64_encode($std[8])?>" alt="Movie Image" width="70" height="70">
                                    <?php
                                    }
                                    ?>
                                </div>
<br>
                                <!-- For Movie Slider Image -->
                                <label for="Movie Slider Image">Movie Slider Image</label>
                                <div class="fallback">
                                    <input name="slider_image" type="file" accept="image/jpeg" multiple/>
                                    <?php
                                    if(isset($_GET['edit_id']))
                                    {
                                        ?>
                                        <img src="data:image/jpeg;base64,<?php echo base64_encode($std[9])?>" alt="Movie Slider Image" width="70" height="70">
                                    <?php
                                    }
                                    ?>
                                </div>
<br>
                                <!-- For Movie Page Image -->
                                <label for="Movie Page Image">Movie Page Image</label>
                                <div class="fallback">
                                    <input name="page_image" type="file" accept="image/jpeg" multiple/>
                                    <?php
                                    if(isset($_GET['edit_id']))
                                    {
                                        ?>
                                        <img src="data:image/jpeg;base64,<?php echo base64_encode($std[10])?>" alt="Movie Page Image" width="70" height="70">
                                    <?php
                                    }
                                    ?>
                                </div>
<br>
                                <?php
                                if(isset($_GET['edit_id']))
                                {
                                    ?>
                                    <button type="submit" name="updatesinger" class="btn btn-primary m-t-15 waves-effect">EDIT MOVIE</button>
                                    <?php
                                }
                                else
                                {
                                    ?>
                                    <button type="submit" name="addmovie" class="btn btn-primary m-t-15 waves-effect">ADD MOVIE</button>
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