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
  
/*    
   if (empty($_POST["comment"])) {
     $comment = "";
   } else {
     $comment = test_input($_POST["comment"]);
   }
*/
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
?>

<form method="post" action="Ampro_process.php" >
   <input type="hidden" name="barcode"
     value="<?php echo $_POST['barcode']; ?>">
   <input type="submit" name="submit" value="submit">
</form>


</body>
</html>

