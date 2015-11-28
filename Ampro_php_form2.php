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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   if (empty($_POST["barcode"])) {
     $barcodeerror = "Barcode is required";
   } else {
     $barcode = test_input($_POST["barcode"]);
   }
  
}

function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}
?>

<h2>Ampro System PCB Check in/out</h2>
<form method = "post" action="">
<p><span class="error">* Please Scan the Barcode *</span></p>
   Barcode:  <input type="text" name="barcode" value="<?php echo $barcode;?>">
   <span class="error"> <?php echo $barcodeerror;?></span>
   <br><br>
   <br><br>
</form>   
<?php
echo "<h2>Your Input:</h2>";
echo $barcode;
echo "<br>";
echo $comment;
echo "<br>";


require_once("connMysql.php"); 
$con=mysql_connect($db_host,$db_username,$db_password);
mysql_select_db($db_name);
$rowcount=0;
$sql = "SELECT COUNT(*) FROM `PCB_Tracking` WHERE PCB=$barcode";

if ($barcode != "") { 
$result=mysql_query($sql);
$data=mysql_fetch_assoc($result);
$rowcount= mysql_result($result, 0);
}

if ( $rowcount == 0) {

echo "<br>";
echo "Barcode is not in database";
echo "<br>";
}
else {
?>
<form method="post" action="Ampro_process.php" >
   <input type="hidden" name="barcode"
     value="<?php echo $_POST['barcode']; ?>">
   <input type="submit" name="submit" value="submit">
</form>


<?php
}
?>


</body>
</html>

