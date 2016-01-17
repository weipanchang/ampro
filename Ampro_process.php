<!DOCTYPE HTML>
<html>
<head>
<style>
.error {color: #FF0000;}
</style>
</head>
<body>

<?php
    include("Ampro_station_info.php");
    require_once("connMysql.php");
    if ($_POST['barcode'] == null ) {
        header("location:Ampro_php_form3.php"); 
    }
    
    $barcode = $_POST['barcode'];
    $operator = $_POST['name'];
    if ($station_type =="AOI") {
        $model = $_POST['model'];
    }
    
    include("Ampro_station_info.php");
    require_once("connMysql.php");
?>
<h1 style="text-align:center; color:blue; text-decoration: underline";> <?php echo "Ampro System PCB Check in/out"; ?></php></h1>
<h3 style="text-align:center; color:blue; text-decoration: underline";> <?php echo $station_type; echo " Station    "; echo $line_number; ?></php?></h3>
<h4 style="text-align:center; color:blue;";> <?php echo "Name: "; echo $operator;?></php?></h4>
<h4>
<?php
    //echo "You currently are processing PCB - ";
    //echo $barcode;
    //echo "<br>";
?></php?></h4>

<?php
    $con=mysql_connect($db_host,$db_username,$db_password);
    mysql_select_db($db_name);
    $sql = "SELECT * FROM `PCB_Tracking` WHERE `PCB`='$barcode' order by time DESC limit 1";
    $result=mysql_query($sql);
    $row=mysql_fetch_array($result);
    $top = $row['top'];
    $bottom = $row['bottom'];
?>
    <h4 style="text-align:center; color:blue;";> <?php echo "Model: "; echo $row['model'];?></php?></h4>
<?php
    echo "You currently are processing PCB - ";
    echo $barcode;
    echo "<br>";
    $test="test123";
    if (!(($row['line'] == $line_number) and ($row['station'] == $station_type) and ($row['status'] == 1))) {
?>
    <h5>
    <?php echo "<br>";
    echo "Message from last station: ";
    echo $row['station'];
    echo " ";
    echo $row['line'];
    echo "<br>";
    echo $row['note'];
    echo "<br>";
    ?>
    </h5>
<?php

    $sql = "INSERT INTO `PCB_Tracking`(`PCB`, `model`, `top`, `bottom`,`line`, `station`, `status`,
      `scrapped`, `operator`, `note`) VALUES('$barcode', '$model', '$top', '$bottom','$line_number','$station_type',1,0,'$operator', 'Checked in')";
    $result=mysql_query($sql, $con);
    //if (!isset($_POST['operator'])) {
    //    $operator = null;
    //}
    //else {
    //    $operator = $_POST['operator'];
    //}
} 
?>

<form name="myform" action="" method="POST">
    <div align="center"><br>
    <?php
        if ($top == 1){
    ?>
            <input type="checkbox" name="option1" value=$top checked> Top
    <?php
        }
        else {
    ?>
            <input type="checkbox" name="option1" value=$top > Top
    <?php
        }
        if ($bottom == 1){
    ?>      <input type="checkbox" name="option1" value=$bottom checked> Bottom
    <?php
        }
        else {
    ?>
            <input type="checkbox" name=$ value=$bottom > Bottom   
    <?php
        }
    ?>
    <br>
    <br>
    <br>
    <br>
    </div>
    <input type="checkbox" name="Issue Code 1" value=$test > <?php echo $test ?>
    <br>
    <br>
    <br>
    <br>
    (Please limit to  100 characters):<textarea name="note" id="note" cols=70 rows=2 style="color: #FF0000; font-size: larger;"></textarea>
    <br>
    <br>
    <input type="checkbox" name="Scrapped" value="Scrapped"> Scrapped this PCB <br>
    <br>
    <br>
    <input type="submit" name="submit2" style="color: #FF0000; font-size: larger;" value="Check Out">
    <input type="hidden" name="name" value="<?php echo  $operator;?>">
    <input type="hidden" name="model" value="<?php echo $model;?>">
</form>
<br>
<!--Note (Please limit to  500 characters): <textarea name="comment" rows="5" cols="80" form="usrform"></textarea>-->
<br>
<br>
<br>

<?php
    function clean($string) {
       $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
    
       return preg_replace('/[^A-Za-z0-9#!*&?!@%\-]/', '', $string); // Removes special chars.
    }
    
    if (isset($_POST['submit2'])) {
        $note = htmlspecialchars($_POST['note']);
        $note=clean($note);


        if(isset($_POST['Scrapped'])){
    
            $sql = "INSERT INTO `PCB_Tracking`(`PCB`,`model`,`line`, `station`, `status`,
            `scrapped`,`operator`, `note`) VALUES('$barcode','$model','$line_number','$station_type',0,1,'$operator','$note')";
        }
        else {
    
            $sql = "INSERT INTO `PCB_Tracking`(`PCB`,`model`,`line`, `station`, `status`,
            `scrapped`,`operator`, `note`) VALUES('$barcode','$model','$line_number','$station_type',0,0,'$operator','$note')";
        }   
    
        mysql_select_db($db_name);
        mysql_query($sql) or die ('error: ' . mysql_error());
    
       header("location:Ampro_php_form3.php"); 
    
    }
?>

</body>
</html>


