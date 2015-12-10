<!DOCTYPE HTML>
<html>
<head>
<style>
.error {color: #FF0000;}
</style>
</head>
<body>

<?php
if ($_POST['barcode'] == null ) {
    header("location:Ampro_php_form3.php"); 
}

$barcode = $_POST['barcode'];
//echo $barcode;

include("Ampro_station_info.php");
require_once("connMysql.php");
?>
<h1 style="text-align:center; color:blue; text-decoration: underline";> <?php echo "Ampro System PCB Check in/out"; ?></php></h1>
<h3 style="text-align:center; color:blue; text-decoration: underline";> <?php echo $station_type; echo " Station    "; echo $line_number; ?></php?></h3>
<h4> <?php echo "<br>";
echo "You currently are processing PCB - ";
echo $barcode;
echo "<br>";
?></php?></h4>

<?php
$con=mysql_connect($db_host,$db_username,$db_password);
mysql_select_db($db_name);
$sql = "SELECT * FROM `PCB_Tracking` WHERE `PCB`='$barcode' order by time DESC limit 1";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);

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
    </php?></h5>
<?php

    $sql = "INSERT INTO `PCB_Tracking`(`PCB`,`line`, `station`, `status`,
      `scrapped`, `note`) VALUES('$barcode', '$line_number','$station_type',1,0, 'Checked in')";
    $result=mysql_query($sql, $con);
} 
?>

<form method="post" action="" id="usrform" >
    <input type="hidden" name="barcode"
    value="<?php echo $_POST['barcode']; ?>"
    <br>
    (Please limit to  500 characters):<textarea name="note" id="note" cols=70 rows=7 style="color: #FF0000; font-size: larger;"></textarea>
    <br>
    <br>
    <input type="checkbox" name="Scrapped" value="Scrapped"> Scrapped this PCB <br>
    <br>
    <br>
    <input type="submit" name="submit2" style="color: #FF0000; font-size: larger;" value="Check Out">
</form>
<br>
<!--Note (Please limit to  500 characters): <textarea name="comment" rows="5" cols="80" form="usrform"></textarea>-->
<br>
<br>
<br>

<?php
if (isset($_POST['submit2'])){
    $note = htmlspecialchars($_POST['note']);

    if(isset($_POST['Scrapped'])){

        $sql = "INSERT INTO `PCB_Tracking`(`PCB`,`line`, `station`, `status`,
        `scrapped`, `note`) VALUES('$barcode', '$line_number','$station_type',0,1,'$$note')";
    }
    else {

        $sql = "INSERT INTO `PCB_Tracking`(`PCB`,`line`, `station`, `status`,
        `scrapped`, `note`) VALUES('$barcode', '$line_number','$station_type',0,0,'$note')";
    }   

    mysql_select_db($db_name);
    mysql_query($sql) or die ('error: ' . mysql_error());

   header("location:Ampro_php_form3.php"); 

}

?>

</body>
</html>


