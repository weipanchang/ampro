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
     $nameErr = "Barcode is required";
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
<p><span class="error">* Please Scan the Barcod *</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
   Barcode:  <input type="text" name="barcode">
   <span class="error"> <?php echo $barcodeerror;?></span>
   <br><br>
<!--   E-mail: <input type="text" name="email">
   <span class="error"> <?php echo $emailErr;?></span>
   <br><br>
   Website: <input type="text" name="website">
   <span class="error"><?php echo $websiteErr;?></span>
   <br><br>
   Comment: <textarea name="Note from Last Location" rows="6" cols="40"></textarea>
   <br><br>
   Action:
   <input type="radio" name="Action" value="Check In">Check In
   <input type="radio" name="Action" value="Check Out">Check Out
   <span class="error"> <?php echo $genderErr;?></span>
   <br><br>
   <input type="submit" name="submit" value="Submit">
-->
</form>

<?php
echo "<h2>Your Input:</h2>";
echo $barcode;
echo "<br>";
echo $comment;
echo "<br>";
?>

</body>
</html>

