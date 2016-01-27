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
      <title>Ampro Issue management main page</title>
      <link rel="STYLESHEET" type="text/css" href="style/fg_membersite.css">
</head>
<body>
<div id='fg_membersite_content'>
<h2>Ampro Issue management main page</h2>
Welcome back <?= $fgmembersite->UserFullName(); ?>!


<li><a href='list_issue.php' style="color:blue">List All Issue</a></li>
<li><a href='add_issue.php' style="color:blue">Add New Issue</a></li>
<li><a href='delete_issue.php' style="color:blue">Delete A Issue</a></li>


<br><br><br>
<p><a href='login-home.php'>Back to Main Page</a></p>
</div>
</body>
</html>