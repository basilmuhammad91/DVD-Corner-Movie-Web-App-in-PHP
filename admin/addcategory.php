<?php
// Include Database
include('../database_connection.php');

// Include Universal Layout for Admin sidebars 
include('layout.php');

// Insert data into database
if(isset($_POST['addcategory']))
{
    $name = $_POST['name'];
    $description = $_POST['description'];

    $query = mysqli_query($con, "insert into tbl_category (tbl_Category_name, 	tbl_Category_description) values('$name','$description')");

    if($query>0)
    {
        echo "<script>window.location.href='viewcategory.php';</script>";
    }
    else
    {
        echo "<script>alert('Not Inserted');</script>";
    }
}

// Edit work from viewuser page
if(isset($_GET['edit_id']))
{
    $edtid = $_GET['edit_id'];

    $query = mysqli_query($con, "select * from tbl_category where tbl_Category_id = '$edtid'");

    $std = mysqli_fetch_array($query);
}

// Update User Data 
if(isset($_POST['updatecategory']))
{
    $id = $_POST['Id'];
    $name = $_POST['name'];
    $description = $_POST['description'];

    $query = mysqli_query($con,"update tbl_category set tbl_Category_name = '$name', tbl_Category_description = '$description' where tbl_Category_id = '$id'") or die(mysqli_error($con));

    if($query)
    {
        echo "<script>window.location.href='viewcategory.php';</script>";
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
                                ADD CATEGORIES
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
                            <form method="post" action="addcategory.php" enctype="multipart/form-data">
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
                                    <textarea name="description" type="text" cols="30" rows="5" class="form-control no-resize" required="" aria-required="true" placeholder="Enter description"><?php echo @$std[2]?></textarea>
                                    </div>
                                </div>

                                <?php
                                if(isset($_GET['edit_id']))
                                {
                                    ?>
                                    <button type="submit" name="updatecategory" class="btn btn-primary m-t-15 waves-effect">EDIT CATEGORY</button>
                                    <?php
                                }
                                else
                                {
                                    ?>
                                    <button type="submit" name="addcategory" class="btn btn-primary m-t-15 waves-effect">ADD CATEGORY</button>
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