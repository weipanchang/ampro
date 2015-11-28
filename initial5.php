<?php

try
{
$dbh = new PDO("mysql:host =127.0.0.1;port=3306;dbname=Ampro", 'root', 'abc123');
    if($dbh)
    {
        print "Connected successfully";
    }
}
catch (PDOException $e)
{
    print "Error: " . "No Connection. ". "<br/>";
    die();
}

?>
