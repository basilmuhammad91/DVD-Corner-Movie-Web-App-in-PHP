<?php
// Include Database
include('../database_connection.php');

// Include Universal Layout for Admin sidebars 
include('layout.php');

// Delete row work 
if(isset($_GET['delete_id']))
{
    $dltid = $_GET['delete_id'];

    $query = mysqli_query($con,"delete from tbl_producer where tbl_producer_id = '$dltid'");

    if($query)
    {
        echo "<script>alert('Deleted Successfully');</script>";
    }
    else
    {
        echo "<script>alert('Error');</script>";
    }

}

// IT WILL MODIFY ORDER STATUS
if(isset($_POST['modify_status']))
{
    $order_id = $_POST['order_id'];
    $status = $_POST['status'];

    $query = mysqli_query($con, "update tbl_order set status = '$status' where order_id = '$order_id'") or die(mysqli_error($con));

    if($query)
    {
        // echo "<script>alert('Updated !');</script>";
        echo "<script>window.location.href='canceledbycustomer.php';</script>";
    }
    else
    {
        echo "ERROR !";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Orders</title>
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
                                VIEW ORDERS
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <?php
                            $query = mysqli_query($con,"
                            SELECT * from tbl_order
                            INNER JOIN
                            tbl_movie
                            ON
                            tbl_movie.tbl_movie_id = tbl_order.movie_id
                            INNER JOIN
                            tbl_user_registration
                            ON
                            tbl_user_registration.tbl_user_id = tbl_order.user_id
                            where status = 'Canceled';
                            ");
                            while($row = mysqli_fetch_array($query))
                            {
                                ?><hr>
                            <div class="row">
                                <div class="col-md-3">
                                    <img src="data:image/jpeg;base64,<?php echo base64_encode($row['tbl_movie_image'])?>" alt="">
                                </div>
                                <div class="col-md-8">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <h5>Order No: </h5>
                                                <h5>Date: </h5>
                                                <h5>Payment Type: </h5>
                                                <hr>
                                                <h5>Name :</h5>
                                                <h5>Address :</h5>
                                                <h5>Contact :</h5>
                                                <h5>Email :</h5>
                                            </div>
                                            <div class="col-md-6">
                                                <h5><?php echo $row['order_id'] ?></h5>
                                                <h5><?php echo $row['date'] ?></h5>
                                                <h5><?php echo $row['payment_type'] ?></h5>
                                                <hr>
                                                <h5><?php echo $row['tbl_user_name']?></h5>
                                                <h5><?php echo $row['address'] ?></h5>
                                                <h5><?php echo $row['contact'] ?></h5>
                                                <h5><?php echo $row['tbl_user_email'] ?></h5>
                                                
                                            </div>
                                        </div>
                                        <form action="canceledbycustomer.php" method="post">
                                            <input type="hidden" name="order_id" value="<?php echo $row['order_id']?>">
                                            <div class="row">
                                                <div class="col-md-2">
                                                <h5>Status </h5>
                                                </div>
                                                <div class="col-md-6">
                                                <select name="status" id="">
                                                    <option value="">Select</option>
                                                    <option value="Yet to be delivered" <?php if($row['status'] == "Yet to be delivered") echo "selected"; ?>>Yet to be Delivered</option>
                                                    <option value="Canceled" <?php if($row['status'] == "Canceled") echo "selected"; ?>>Canceled</option>
                                                    <option value="Canceled by Admin" <?php if($row['status'] == "Canceled by Admin") echo "selected"; ?>>Canceled by Admin</option>
                                                    <option value="Delivered" <?php if($row['status'] == "Delivered") echo "selected"; ?>>Delivered</option>
                                                </select>
                                                </div>
                                            </div>
                                            
                                            <input type="submit" class="btn btn-primary waves-effect" value="MODIFY" name="modify_status">
                                        </form>
                                </div>
                            </div>

                          <hr>

                                <?php
                            }
                            ?>
                        </div>
                        
                    </div>
                </div>
            </div>
            <!-- #END# Basic Examples -->
          
        </div>
    </section>

    
</body>
</html>