<?php
// Include Database
include('../database_connection.php');

// Include Universal Layout for Admin sidebars 
include('layout.php');

// Insert data into database
if(isset($_POST['addusers']))
{
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = mysqli_query($con, "insert into tbl_user_registration (tbl_user_name, tbl_user_email,tbl_user_password) values('$name','$email','$password')");

    if($query)
    {
        echo "<script>window.location.href='viewusers.php';</script>";
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

    $query = mysqli_query($con, "select * from tbl_user_registration where tbl_user_id = '$edtid'");

    $std = mysqli_fetch_array($query);
}

// Update User Data 
if(isset($_POST['updateuser']))
{
    $id = $_POST['Id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = mysqli_query($con,"update tbl_user_registration set tbl_user_name = '$name', tbl_user_email = '$email', tbl_user_password = '$password' where tbl_user_id = '$id'") or die(mysqli_error($con));

    if($query)
    {
        echo "<script>window.location.href='viewusers.php';</script>";
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
                                ADD USERS
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
                            <form method="post" action="addusers.php">
                            <label for="email_address">Name</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="hidden" name="Id" value="<?php echo @$std[0]?>">
                                        <input type="text" class="form-control" placeholder="Enter your name" required name="name" value="<?php echo @$std[1]?>">
                                    </div>
                                </div>
                                <label for="email_address">Email Address</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="email" id="email_address" class="form-control" required placeholder="Enter your email address" name="email" value="<?php echo @$std[2]?>">
                                    </div>
                                </div>
                                <label for="password">Password</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="password" id="password" class="form-control" placeholder="Enter your password" required name="password" value="<?php echo @$std[1]?>">
                                    </div>
                                </div>

                                <?php
                                if(isset($_GET['edit_id']))
                                {
                                    ?>
                                    <button type="submit" name="updateuser" class="btn btn-primary m-t-15 waves-effect">EDIT USER</button>
                                    <?php
                                }
                                else
                                {
                                    ?>
                                    <button type="submit" name="addusers" class="btn btn-primary m-t-15 waves-effect">ADD USER</button>
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