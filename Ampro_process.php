<!DOCTYPE HTML>
<html>
<head>
<style>
.error {color: #FF0000;}
</style>
</head>
<body>

<?php
//echo $_POST['barcode'];
$barcode = $_POST['barcode'];
//echo $barcode;
include("Ampro_station_info.php");
require_once("connMysql.php");
?>
<h1 style="text-align:center";> <?php echo "Ampro System PCB Check in/out"; ?></php></h1>
<h2> <?php echo $station_type; echo " Station    "; echo $line_number; ?></php?></h2>
<h5> <?php echo "<br>";
echo "You currently are processing PCB - ";
echo $barcode;
echo "<br>";
?></php?></h5>

<?php
$con=mysql_connect($db_host,$db_username,$db_password);
mysql_select_db($db_name);
$sql = "SELECT * FROM `PCB_Tracking` WHERE `PCB`='$barcode' order by time DESC limit 1";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);

if (!(($row['line'] == $line_number) and ($row['station'] == $station_type))) {
?>
<h5> <?php echo "<br>";
echo "Message from last station: ";
echo $row['station'];
echo " ";
echo $row['line'];
echo "<br>";
echo $row['note'];
echo "<br>";
?></php?></h5>
<?php
}

if (!(($row['line'] == $line_number) and ($row['station'] == $station_type) and ($row['status'] == 1))) {
    $sql = "INSERT INTO `PCB_Tracking`(`PCB`,`line`, `station`, `status`,
      `scrapped`) VALUES('$barcode', '$line_number','$station_type',1,0)";
    $result=mysql_query($sql, $con);
} 
?>

</body>
</html>


