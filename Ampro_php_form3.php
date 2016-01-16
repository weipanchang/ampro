<!DOCTYPE HTML>
<html>
<head>
<style>
.error {color: #FF0000;}
</style>
</head>
<body>

<?php
// define variables and set to empty values
$barcode = "";
$comment = "";
$barcodeerror = "";
$commenterror = "";
$error=0;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   if (empty($_POST["barcode"])) {
     $barcodeerror = "Barcode is required";
     $error=1;
   }
   elseif (strlen($_POST["barcode"]) != 13) {
     $barcodeerror = "Invalid Barcode. Please rescan!";
     $error=1;
   }
   elseif  (!(ctype_digit($_POST["barcode"]))) {
     $barcodeerror = "Invalid Barcode. Please rescan!";
     $error=1;
   }
   else {
     $barcode = test_input($_POST["barcode"]);
     $error=0;
   }

}

function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}

include("Ampro_station_info.php");
?>

<h1 style="text-align:center; color:blue; text-decoration: underline";>Ampro System PCB Check in/out</h1>
<h3 style="text-align:center; color:blue; text-decoration: underline";> <?php echo $station_type; echo " Station    "; echo $line_number; ?></php?></h3>
<form method = "post" action="">
<p><span class="error">* Please Scan the Barcode *</span></p>
   Barcode:  <input type="text" name="barcode" value="<?php echo $barcode;?>">
<!--   Barcode:  <input type="text" name="barcode" value="">-->
   <span class="error"> <?php echo $barcodeerror;?></span>
   <br><br>
   <br><br>
</form>

<?php
echo "<h3>Your Input:</h3>";
echo $barcode;
echo "<br>";
echo $comment;
echo "<br>";


require_once("connMysql.php");

$con=mysql_connect($db_host,$db_username,$db_password);
mysql_select_db($db_name);
$rowcount=0;
$sql = "SELECT * FROM `PCB_Tracking` WHERE PCB='$barcode'";

if (($barcode != "") and ($error == 0)) {
   $result=mysql_query($sql, $con);
   $rowcount=mysql_num_rows($result);
}

if ( $rowcount == 0) {
   if (($station_type =="AOI") and ($error == 0) and ($barcode != "")) {
      $sql = "INSERT INTO `PCB_Tracking`(`PCB`,`line`, `station`, `status`,
      `scrapped`) VALUES('$barcode', '$line_number','$station_type',0,0)";
      mysql_select_db($db_name);
      $result=mysql_query($sql, $con);
         if(! $result ) {
            die('Could not enter data: ' . mysql_error());
         }
         else {
         echo "<br>";
         echo "<br>";
         echo "Create new PCB record successfully, Please Check In!\n";
         echo "<br>";
         echo "<br>";
         }
      mysql_close($con);
?>
      <form method="post" action="Ampro_process.php" >
         <input type="hidden" name="barcode"
           value="<?php echo $_POST['barcode']; ?>">
         <input type="submit" name="submit" value="Check In">
      </form>
<?php
   }
   elseif (($error==0) and ($rowcount == 0) and ($barcode != "")) {
      echo "<br>";
      echo "Barcode is not in database. Please send this PCB to AOI Station";
      echo "<br>";
   }

}
else {
   mysql_close($con);
   if ($error==0) {
?>
<form method="post" action="Ampro_process.php" >
   <input type="hidden" name="barcode"
     value="<?php echo $_POST['barcode']; ?>">
   <input type="submit" name="submit" style="color: #FF0000; font-size: larger;" value="Check In">
</form>
<?php
   }
}
?>

</body>
</html>