<?php
$user = "root";
$pass = "abc123";
try
{
    $dbh = new PDO('mysql:host = 127.0.0.1; dbname=Ampro', $user,$pass);
    if($dbh)
    {
        print "Connected successfully";
    }
}
catch (PDOException $e)
{
    print "Error: " . $e->getMessage(). "<br/>";
    die();
}

?>
