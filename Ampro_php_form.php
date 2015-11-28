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
$dbh = new PDO("mysql:host =192.168.1.136,port=3306;dbname = $db_name;", $db_username,$db_password);  


//$sql = "SELECT COUNT(*) FROM `PCB_Tracking` WHERE PCB='343434'";
$sql = "SELECT COUNT(*) FROM PCB_Tracking;";
$query=$dbh->prepare($sql);
$result=$query->execute();
echo $result;
$count=$result->rowCount();
echo $count;

//if (empty($result) AND  ($result->rowCount() = 0)) {
if ( $count == '0') {

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

