<?php
// Include Database
include('../database_connection.php');

// Include Universal Layout for Admin sidebars 
include('layout.php');

// Insert data into database
if(isset($_POST['addnews']))
{
    $title = $_POST['title'];
    $date = date("Y-m-d H:i:s");
    $description = $_POST['description'];
    $img = addslashes(file_get_contents($_FILES['image']['tmp_name']));
    $cimg = addslashes(file_get_contents($_FILES['cover_image']['tmp_name']));

    $query = mysqli_query($con, "insert into news (news_title, date, news_description, news_image, news_cover_image) values('$title','$date','$description','$img','$cimg')");

    if($query>0)
    {
        echo "<script>window.location.href='viewnews.php';</script>";
    }
    else
    {
        echo "<script>alert('Not Inserted');</script>";
    }
}

// Edit work from viewnews page
if(isset($_GET['edit_id']))
{
    $edtid = $_GET['edit_id'];

    $query = mysqli_query($con, "select * from news where id = '$edtid'");

    $std = mysqli_fetch_array($query);
}

// Update News Data 
if(isset($_POST['updatenews']))
{
    $id = $_POST['Id'];
    $title = $_POST['title'];
    $date = $date = date("Y-m-d H:i:s");
    $description = $_POST['description'];
    $query = 0;
    $IsNewsImageOK=isset($_FILES['image']) && $_FILES['image']['error'] != UPLOAD_ERR_NO_FILE;
    $IsCoverImageOK=isset($_FILES['cover_image']) && $_FILES['cover_image']['error'] != UPLOAD_ERR_NO_FILE;
    

    if($IsNewsImageOK && $IsCoverImageOK)
    {
        $img = addslashes(file_get_contents($_FILES['image']['tmp_name']));
        $cimg = addslashes(file_get_contents($_FILES['cover_image']['tmp_name']));
        $query = mysqli_query($con,"update news set news_title = '$title', news_description = '$description', news_image = '$img',news_cover_image = '$cimg' where id = '$id'") or die(mysqli_error($con));
    }
    else if($IsNewsImageOK)
    {
        $img = addslashes(file_get_contents($_FILES['image']['tmp_name']));
        $query = mysqli_query($con,"update news set news_title = '$title', news_description = '$description', news_image = '$img' where id = '$id'") or die(mysqli_error($con));
    }
    else if ($IsCoverImageOK)
    {
        $cimg = addslashes(file_get_contents($_FILES['cover_image']['tmp_name']));
        $query = mysqli_query($con,"update news set news_title = '$title', news_description = '$description', news_cover_image = '$cimg' where id = '$id'") or die(mysqli_error($con));
    }
    else
    {   
        $query = mysqli_query($con,"update news set news_title = '$title', news_description = '$description' where id = '$id'") or die(mysqli_error($con));
    }
   
    if($query)
    {
        echo "<script>window.location.href='viewnews.php';</script>";
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
    <title>Add News </title>
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
                                ADD NEWS
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
                            <form method="post" action="addnews.php" enctype="multipart/form-data">
                            <label for="email_address">News Title</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="hidden" name="Id" value="<?php echo @$std[0]?>">
                                        <input type="text" class="form-control" placeholder="Enter name" required name="title" value="<?php echo @$std[1]?>">
                                    </div>
                                </div>

                                <!-- News Description -->
                                <label for="description">Description</label>
                                <div class="form-group">
                                    <div class="form-line">
                                    <textarea name="description" cols="30" rows="5" class="form-control no-resize" required="" aria-required="true" placeholder="Enter description"><?php echo @$std[3]?></textarea>
                                    </div>
                                </div>

                                <!-- News Image -->
                                <label for="description">News Image</label>
                                <div class="fallback">
                                    <input name="image" type="file" accept="image/jpeg"/>
                                    <?php
                                    if(isset($_GET['edit_id']))
                                    {
                                        ?>
                                        <img src="data:image/jpeg;base64,<?php echo base64_encode($std[4])?>" alt="News Image" width="70" height="70">
                                       
                                        <?php
                                    }
                                    ?>
                                </div>
<br>
                                <!-- News Cover Image -->
                                <label for="description">News Cover Image</label>
                                <div class="fallback">
                                    <input name="cover_image" type="file" accept="image/jpeg"/>
                                    <?php
                                    if(isset($_GET['edit_id']))
                                    {
                                        ?>
                                        <img src="data:image/jpeg;base64,<?php echo base64_encode($std[5])?>" alt="News Cover Image" width="70" height="70">
                                       
                                        <?php
                                    }
                                    ?>
                                </div>
<br>
                                <?php
                                if(isset($_GET['edit_id']))
                                {
                                    ?>
                                    <button type="submit" name="updatenews" class="btn btn-primary m-t-15 waves-effect">EDIT ARTIST</button>
                                    <?php
                                }
                                else
                                {
                                    ?>
                                    <button type="submit" name="addnews" class="btn btn-primary m-t-15 waves-effect">ADD NEWS</button>
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