<?php

// Connection with database, Database Name : 'db_dvd_corner'

$con = mysqli_connect('localhost','root','','db_dvd_corner');

if(!$con)
{
    echo "Database not connected: ";
}
// else
// {
//     echo "Database connected";
// }

?>