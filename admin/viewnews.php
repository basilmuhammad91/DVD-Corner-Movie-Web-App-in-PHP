<?php
// Include Database
include('../database_connection.php');

// Include Universal Layout for Admin sidebars 
include('layout.php');

// Delete row work 
if(isset($_GET['delete_id']))
{
    $dltid = $_GET['delete_id'];

    $query = mysqli_query($con,"delete from news where id = '$dltid'");

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
    <title>View News</title>
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
                                VIEW NEWS
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                <a href="addnews.php" class="btn btn-primary waves-effect">ADD NEW NEWS</a>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>News Title</th>
                                            <th>Date</th>
                                            <th>Description</th>
                                            <th>News Image</th>
                                            <th>News Cover Image</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>News Title</th>
                                            <th>Date</th>
                                            <th>Description</th>
                                            <th>News Image</th>
                                            <th>News Cover Image</th>
                                            <th>Actions</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                        $query = mysqli_query($con,"select * from news");
                                        while($row = mysqli_fetch_array($query))
                                        {

                                        ?>
                                        <tr>
                                            <td><?php echo $row[1]?></td>
                                            <td><?php echo $row[2]?></td>
                                            <td><?php echo $row[3]?></td>
                                            <td>
                                                <img src="data:image/jpeg;base64,<?php echo base64_encode($row[4])?>" width="70" height="70" alt="News Image">    
                                            </td>
                                            <td>
                                                <img src="data:image/jpeg;base64,<?php echo base64_encode($row[5])?>" width="70" height="70" alt="News Cover Image">    
                                            </td>
                                            <td>
                                                <a href="viewnews.php?delete_id=<?php echo $row[0]?>" class="btn btn-primary waves-effect">Delete</a>
                                                <a href="addnews.php?edit_id=<?php echo $row[0]?>" class="btn btn-primary waves-effect">Edit</a>
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