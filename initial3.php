<?php
$con=mysqli_connect("localhost","root","abc123","Ampro");



// Check connection


        if(!$con)
        {
            die('Could not connect: ' . mysql_error());
        }
        else
        {
            echo "Connection established!";
        }
        mysql_close($con);

?>
