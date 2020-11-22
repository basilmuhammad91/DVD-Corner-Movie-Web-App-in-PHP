<?php
// Include Database
include('../database_connection.php');

// Include Universal Layout for Admin sidebars 
include('layout.php');

// Insert data into database
if(isset($_POST['addproducer']))
{
    $name = $_POST['name'];
    $description = $_POST['description'];
    $img = addslashes(file_get_contents($_FILES['image']['tmp_name']));

    $query = mysqli_query($con, "insert into tbl_producer (tbl_producer_name, tbl_producer_description, tbl_producer_image) values('$name','$description','$img')");

    if($query>0)
    {
        echo "<script>alert('Data Inserted');</script>";
    
    
    }
    else
    {
        echo "<script>alert('Not Inserted');</script>";
    }
}

// Edit work from View Producer page
if(isset($_GET['edit_id']))
{
    $edtid = $_GET['edit_id'];

    $query = mysqli_query($con, "select * from tbl_producer where tbl_producer_id = '$edtid'");

    $std = mysqli_fetch_array($query);
}

// Update Producer Data 
if(isset($_POST['updateproducer']))
{
    $id = $_POST['Id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    

if(!isset($_FILES['image']) || $_FILES['image']['error']== UPLOAD_ERR_NO_FILE)
{   
    $query = mysqli_query($con,"update tbl_producer set tbl_producer_name = '$name', tbl_producer_description = '$description' where tbl_producer_id = '$id'") or die(mysqli_error($con));
}
else
{
    $img = addslashes(file_get_contents($_FILES['image']['tmp_name']));
    $query = mysqli_query($con,"update tbl_producer set tbl_producer_name = '$name', tbl_producer_description = '$description', tbl_producer_image = '$img' where tbl_producer_id = '$id'") or die(mysqli_error($con));
  
}
    

    if($query)
    {
        echo "<script>window.location.href='viewproducer.php';</script>";
     // header("Location:viewproducer.php");
      
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
                                ADD PRODUCER
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
                            <form method="post" action="addproducer.php" enctype="multipart/form-data">
                            <label for="email_address">Name</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="hidden" name="Id" value="<?php echo @$std[0]?>">
                                        <input type="text" class="form-control" placeholder="Enter name" required name="name" value="<?php echo @$std[1]?>">
                                    </div>
                                </div>
                                
                                <label for="description">Description</label>
                                <div class="form-group">
                                    <div class="form-line">
                                    <textarea name="description" cols="30" rows="5" class="form-control no-resize" required="" aria-required="true" placeholder="Enter description"><?php echo @$std[2]?></textarea>
                                    </div>
                                </div>

                                <div class="fallback">
                                    <input name="image" type="file" accept="image/jpeg"/>
                                    <?php
                                    if(isset($_GET['edit_id']))
                                    {
                                        ?>
                                        <img src="data:image/jpeg;base64,<?php echo base64_encode($std[3])?>" alt="Producer Image Image" width="70" height="70">
                                    <?php
                                    }
                                    ?>
                                </div>

                                <?php
                                if(isset($_GET['edit_id']))
                                {
                                    ?>
                                    <button type="submit" name="updateproducer" class="btn btn-primary m-t-15 waves-effect">EDIT PRODUCER</button>
                                    <?php
                                }
                                else
                                {
                                    ?>
                                    <button type="submit" name="addproducer" class="btn btn-primary m-t-15 waves-effect">ADD PRODUCER</button>
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