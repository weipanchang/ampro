<?PHP
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
      <title>Home page</title>
      <link rel="STYLESHEET" type="text/css" href="style/fg_membersite.css">
</head>
<body>
<div id='fg_membersite_content'>
<h2>Home Page</h2>
Welcome back <?= $fgmembersite->UserFullName(); ?>!

<li><p><a href='change-pwd.php'>Change password</a></p></li>

<li><a href='All_PCB_check.php' style="color:blue"> Monitoring Recent PCB Activity</a></li>
<li><a href='PCB_Issue_Log.php' style="color:blue"> Display Individual PCB Issue List</a></li>
<li><a href='PCB_Through_AOI_Day.php' style="color:blue"> PCB Through AOI on Day Shift</a></li>
<li><a href='PCB_Through_AOI_Night.php' style="color:blue"> PCB Through AOI on Night Shift</a></li>
<li><a href='Ampro_operator_menu.php' style="color:blue">Edit Operator Name List</a></li>
<li><a href='Ampro_issue_menu.php' style="color:blue">Edit Station Issue List</a></li>
<li><a href='Ampro_model_menu.php' style="color:blue">Edit PCB Model List</a></li>

<br><br><br>
<p><a href='logout2.php'>Logout</a></p>
</div>
</body>
</html>
