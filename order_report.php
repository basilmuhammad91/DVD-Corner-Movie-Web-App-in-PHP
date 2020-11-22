<?php
// order_report.php

// For Database Connection
include('database_connection.php');

// include autoloader
require_once 'dompdf/autoload.inc.php';

// reference the Dompdf namespace

use Dompdf\Dompdf;

//initialize dompdf class

$document = new Dompdf();

if(isset($_GET['order_id']))
{
    $order_id = $_GET['order_id'];

    $query = mysqli_query($con,"

    SELECT * from tbl_order
    INNER JOIN
    tbl_user_registration
    ON
    tbl_order.user_id = tbl_user_registration.tbl_user_id
    INNER JOIN
    tbl_movie
    ON
    tbl_movie.tbl_movie_id = tbl_order.movie_id
    WHERE tbl_order.order_id = $order_id
    ");

    @$row = mysqli_fetch_array($query);

    $total_price = $row[6]*$row[20];

}

$html = "

<html>
    <head>
    <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css' integrity='sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk' crossorigin='anonymous'>
        <style>
            /** Define the margins of your page **/
            @page {
                margin: 100px 25px;
            }

            header {
                position: fixed;
                top: -60px;
                left: 0px;
                right: 0px;
                height: 50px;

                /** Extra personal styles **/
                background-color: #03a9f4;
                color: white;
                text-align: center;
                line-height: 35px;
            }

            footer {
                position: fixed; 
                bottom: -60px; 
                left: 0px; 
                right: 0px;
                height: 50px; 

                /** Extra personal styles **/
                background-color: #03a9f4;
                color: white;
                text-align: center;
                line-height: 35px;
            }
            
        </style>
    </head>
    <body>
        <!-- Define header and footer blocks before your content -->
        
        <hr>
       <div class='row' style='margin-left:20px'>
            <div style='width:300px; float:left'>
                <p>MOVIE TITLE:</p>
                <p>CUSTOMER ID:</p>
                <p>CUSTOMER NAME:</p>
                <p>MOVIE NAME:</p>
                <p>ORDER NO:</p>
                <p>DATE:</p>
                <p>PAYMENT TYPE:</p>
                <p>ADDRESS:</p>
                <p>STATUS:</p>
                <p>QUANTITY:</p>
                <p>MOVIE PRICE</p>
                <p>TOTAL PRICE</p>
            </div>
            <div style='width:500px'>
                <p><b>$row[16]</b></p>
                <p><b>$row[1]</b></p>
                <p><b>$row[12]</b></p>
                <p><b>$row[16]</b></p>
                <p><b>$row[0]</b></p>
                <p><b>$row[3]</b></p>
                <p><b>$row[4]</b></p>
                <p><b>$row[7]</b></p>
                <p><b>$row[5]</b></p>
                <p><b>$row[6]</b></p>
                <p><b>$row[20]</b></p>
                <p><b>$total_price</p></b></p>
            </div>
        </div>
        <hr>
        <hr>
        
       
    </body>
</html>
";

$document -> loadHtml($html); 

// set page size and orientation
$document -> setPaper('A4','landscape');

// Render the HTML as PDF
$document -> render();

// Get the output of generated pdf in browser
$document -> stream();

?>

