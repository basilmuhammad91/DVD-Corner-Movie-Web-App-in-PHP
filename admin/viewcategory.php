<?php
// Include Database
include('../database_connection.php');

// Include Universal Layout for Admin sidebars 
include('layout.php');

// Delete row work 
if(isset($_GET['delete_id']))
{
    $dltid = $_GET['delete_id'];

    $query = mysqli_query($con,"delete from tbl_category where tbl_Category_id = '$dltid'");

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
    <title>View Categories</title>
    <!-- Script Files -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function(){
            $('#search_text').on('keyup',function(){
                var txt = $(this).val();
                if(txt != '')
                {
                    $.ajax({
                        url: "fetchcategory.php",
                        method: "post",
                        data: {search: txt},
                        dataType: "text",
                        success: function(data){
                            $('#result').html(data);
                            $('.showAll').hide();
                        }
                    });
                }
                else
                {
                    $('#result').html('');
                    $('.showAll').show();
                }
            })
        });
    </script>
</head>
<body>

<section class="content">
        <div class="container-fluid">
            
            <!-- Basic Examples -->
            <div class="row clearfix">
                        <div class="row">
                            <div class="col-md-4 float-right" style="margin-left:20px;">
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="text" id="search_text" name="search_text" class="form-control" placeholder="Search Category" style="padding: 5px;">
                                    </div>
                                </div>
                            </div>
                        </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                VIEW CATEGORIES
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                <a href="addcategory.php" class="btn btn-primary waves-effect">ADD NEW CATEGORY</a>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <div id="result"></div>
                                    <thead class="showAll">

                                        <tr>
                                            <th>Category Name</th>
                                            <th>Category Description</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tfoot class="showAll">
                                        <tr>
                                            <th>Category Name</th>
                                            <th>Category Description</th>
                                            <th>Actions</th>
                                        </tr>
                                    </tfoot>
                                    <tbody class="showAll">
                                        <?php
                                        $query = mysqli_query($con,"select * from tbl_category");
                                        while($row = mysqli_fetch_array($query))
                                        {

                                        ?>
                                        <tr>
                                            <td><?php echo $row[1]?></td>
                                            <td><?php echo $row[2]?></td>
                                            <td>
                                                <a href="viewcategory.php?delete_id=<?php echo $row[0]?>" class="btn btn-primary waves-effect">Delete</a>
                                                <a href="addcategory.php?edit_id=<?php echo $row[0]?>" class="btn btn-primary waves-effect">Edit</a>
                                              
                                            </td>
                                        </tr>
                                        <?php
                                            }
                                        ?>
                                      
                                    </tbody>
                                </div>
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