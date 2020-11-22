<?php
// Include Database
include('../database_connection.php');

// Include Universal Layout for Admin sidebars 
include('layout.php');

// Delete row work 
if(isset($_GET['delete_id']))
{
    $dltid = $_GET['delete_id'];

    $query = mysqli_query($con,"delete from tbl_singers where tbl_singers_id = '$dltid'");

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
    <title>View Artists</title>
</head>
<body>

    <script>
    
        $(document).ready(function(){
            // alert("hello");
            // Work for searching
            $('#search_text').on('keyup',function(){
                var txt = $(this).val();
                if(txt != "")
                {
                    $.ajax({
                        url: "fetchsinger.php",
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
            });
        });

    </script>


<section class="content">
        <div class="container-fluid">
            
            <!-- Basic Examples -->
            <div class="row clearfix">

                        <!-- For Search bar -->
                        <div class="row">
                            <div class="col-md-4 float-right" style="margin-left:20px;">
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="text" id="search_text" name="search_text" class="form-control" placeholder="Search Singer" style="padding: 5px;">
                                    </div>
                                </div>
                            </div>
                        </div>

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                VIEW SINGER
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                <a href="addsinger.php" class="btn btn-primary waves-effect">ADD NEW SINGERS</a>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <div id="result"></div>
                                    <thead class="showAll">
                                        <tr>
                                            <th>Singer Name</th>
                                            <th>Singer Description</th>
                                            <th>Singer Image</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tfoot class="showAll">
                                        <tr>
                                            <th>Singer Name</th>
                                            <th>Singer Description</th>
                                            <th>Singer Image</th>
                                            <th>Actions</th>
                                        </tr>
                                    </tfoot>
                                    <tbody class="showAll">
                                        <?php
                                        $query = mysqli_query($con,"select * from tbl_singers");
                                        while($row = mysqli_fetch_array($query))
                                        {

                                        ?>
                                        <tr>
                                            <td><?php echo $row[1]?></td>
                                            <td><?php echo $row[2]?></td>
                                            <td>
                                                <img src="data:image/jpeg;base64,<?php echo base64_encode($row[3])?>" width="70" height="70" alt="Singer Image">    
                                                
                                            </td>
                                            <td>
                                                <a href="viewsinger.php?delete_id=<?php echo $row[0]?>" class="btn btn-primary waves-effect">Delete</a>
                                                <a href="addsinger.php?edit_id=<?php echo $row[0]?>" class="btn btn-primary waves-effect">Edit</a>
                                              
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