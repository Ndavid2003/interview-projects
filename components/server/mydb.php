<?php 

    $con = new mysqli("localhost","root", '', 'tm');

    //Check connection 

    if($con->connect_errno) {
        echo "Failed to connect to database: " . $con->connect_error;
        exit();
    }

?>