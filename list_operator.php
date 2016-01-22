

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/x
html1/DTD/xhtml1-strict.dtd">  
<html xmlns="http://www.w3.org/1999/xhtml">  
<head>  
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />  
<title>Ampro System List All Operators</title>
</head>
<!--<link href="default.css" rel="stylesheet" type="text/css" /> -->
</head>  
<body> 
<div id='fg_membersite_content'>
<h2 style="color:blue; text-decoration: underline ">Ampro System</h2>
<p style="color:red">
Warning: This page is only to allow Ampro Management to access.<br> 
</p>
<p style="color:blue">
List All Operators
</p>

require_once("connMysql.php");

<!--    echo "<h2> PCB Activity Check  : </h2>";-->
    echo "<table width='1000' border='5'; style='border-collapse: collapse;border-color: silver;'>";  
    echo "<tr style='font-weight: bold;'>";  
    echo "<td width='30' align='center'>Rec Number</td><td width='30' align='center'>Operator Name</td></tr>";  
    
    $DBConnect=mysql_connect("$db_host", "$db_username", "$db_password") or die(mysql_error());
    mysql_select_db("$db_name") or die(mysql_error());
    $result = mysql_query("SELECT * FROM `PCB_Operator` order by name");
?>