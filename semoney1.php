<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">  
<html xmlns="http://www.w3.org/1999/xhtml">  
<head>  
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />  
<title>Airetalk Rate Center </title>
</head>
<!--<link href="default.css" rel="stylesheet" type="text/css" /> -->
</head>  
<body> 




<form method="post" action="semoney1.php">

Check Member Data


  <table> 

      <td>Enter Money</td>
      <td><input type="text" name="money" size="30" value="-99999"></td>
    </tr>
	 <tr>

      <td>Enter idx</td>
      <td><input type="text" name="idx" size="30" value="<?= $idx ?>"></td>
    </tr>
	 <tr>



      <td><input type="submit" value="Submit"></td>
  </table>


</form>

 
<?php  

	$money = $_POST['money'];
	$idx = $_POST['idx'];


$DBConnect=mysql_connect("localhost", "root", "abc123") or die(mysql_error());
mysql_select_db("freeswitch") or die(mysql_error());
//$phonenum1 = preg_replace("/[^0-9]/", '', $phonenum1);


$num1 = $money;

//$num1 = "+".$num1;
$success = false;
$TableName = "accounts";

//----------------------- Please use $plan to select dialplan
//------------------------use rate for calling rate
	
$result = mysql_query("UPDATE $TableName set cash='$num1' WHERE id ='$idx'");  
if ($result)
{
		$success = true; 
        echo " Inject money =".$num1;		
		}  

mysql_close($DBConnect);




?> 
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>




</body>  




</html>   





