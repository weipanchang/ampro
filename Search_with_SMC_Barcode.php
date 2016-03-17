<?php
require_once("./include/membersite_config.php");

if(!$fgmembersite->CheckLogin())
{
    $fgmembersite->RedirectToURL("login.php");
    exit;
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
      <meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
      <title>Search with SMC Barcode Page</title>
      <link rel="STYLESHEET" type="text/css" href="style/fg_membersite.css">
</head>
<h2>Search with SMC Barcode</h2>
<form method="post" action="Search_with_SMC_Barcode.php">
<table> 
<!--<tr>
<td style="color:blue" >Enter Ampro System Barcode</td>
<td><input type="text" name="AMP_barcode" size="12" value=""></td>
</tr>-->

<tr>
<td style="color:blue" >Enter SuperMicro Barcode</td>
<td><input type="text" name="SMC_barcode" size="12" value=""></td>
</tr>
<td ><input type="submit" value="Submit" style="background-color:#0000ff; color:#fff;" ></td>
</table>
</form>
<?php
require_once("connMysql.php");
$con=mysql_connect($db_host,$db_username,$db_password);
mysql_select_db($db_name);
if (!isset($_POST['AMP_barcode'])) 
    {
    $AMP_barcode = null;
    }
else 
    {
    $AMP_barcode = $_POST['AMP_barcode'];
    }

if (!isset($_POST['SMC_barcode'])) 
    {
    $SMC_barcode = null;
    }
else 
    {
    $SMC_barcode = $_POST['SMC_barcode']; 
    }

if (($_POST) && ( strlen($SMC_barcode) == 12 )) {

    echo "<h2> PCB Issue Log  : </h2>";
    echo "<br>";
    echo "<table width='1300' border='5'; style='border-collapse: collapse;border-color: silver;'>";  
    echo "<tr style='font-weight: bold;'>";  
    echo "<td width=3%' align='center'>Rec</td>";
    echo "<td width='1%' align='center'>AMP Barcode</td><td width='4%' align='center'>HMC Barcode</td>";
    echo "<td width='15%' align='center'>Shipped</td>";  
    echo "<td width='15%' align='center'>Operator</td>";  
    echo "<td width='15%' align='center'>Updater</td>";
    echo "<td width='3%' align='center'>Comment</td><td width='8%' align='center'>Date</td>";
    echo "<td width='8%' align='center'>Time</td></tr>";

    $sql = "SELECT * FROM `PCB_Barcode` WHERE `SMC_barcode` = '$SMC_barcode' ORDER BY `time` DESC";
    $result=mysql_query($sql, $con);
    while($row=mysql_fetch_array($result))  {
        if ($row['shipping_status'] == 1){
            $shipped = "Yes";
        }
        else {
            $shipped= "No";
        }
        echo "<tr style='font-weight: bold;'>"; 
        echo "<tr>";  
        echo "<td align='center' width='3%'>" . $row['recnumber'] . "</td>";  
        echo "<td align='center' width='5%'>" . $row['AMP_barcode'] . "</td>";
        echo "<td align='center' width='1%'>" . $row['SMC_barcode'] . "</td>";
        echo "<td align='center' width='1%'>" . $shipped . "</td>";
        echo "<td align='center' width='4%'>" . $row['operator'] . "</td>";
        echo "<td align='left' width='15%'>" . $row['updater'] . "</td>";
        echo "<td align='left' width='15%'>" . $row['comment'] . "</td>";  
        echo "<td align='center' width='8%'>" . $row['date'] . "</td>";
        echo "<td align='center' width='8%'>" . $row['time'] . "</td>";
        
    echo "</tr>";
    }
    echo "</table>";

    echo "   ";
}
    echo "</table>";

    echo "   ";

mysql_close($con);



?> 

<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>

<p>
Logged in as: <?= $fgmembersite->UserFullName() ?>
</p>
<p>
<a href='login-home.php'>Menu Page</a>
</p>
</div>
</body>
</html>