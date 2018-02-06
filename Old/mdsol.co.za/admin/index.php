<?
	require_once "com/session.php";
	require_once "com/globals.php";
	require_once "com/dbcon.php";
	require_once "com/db_funcs.php"; 
	
	if (isset($_POST["go"]))
	{
		$err = false;
		
		if (strtolower($_POST["pass"]) != "experts")
			$err = true;
		else if ( strtolower($_POST["user"]) != "technology")
			$err = true;
			
		if ($err == false)
			$_SESSION["loggedin"] = true;
		else
			unset($_SESSION["loggedin"]);
			
		session_write_close();
	} 
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="keywords" content="MDSOL, Technology, Networks, Data Networks, BEE technology company" />
<meta name="description" content="We help Good Companies become Great Companies through the provision of state of the art Technology Solutions" />
<title>MDSOL - Taking care of you Technology Needs</title>
<script type="text/javascript" src="images/mootools.js"></script>
<script type="text/javascript" src="images/caption.js"></script>
<link rel="stylesheet" href="images/template.css" type="text/css" />
<link rel="stylesheet" href="images/constant.css" type="text/css" />
</head> 
<body id="body">
<div id="tail">
  <div class="main">
    <div id="header">
      <div id="top">
        <div style="font:'Trebuchet MS'; margin-right:29px; padding-top:5px; font-size:16px; color:#FFFFFF; text-align:right;">
          Welcome Administrator
        </div>
      </div>
      <div id="topmenu">
        <div class="module-topmenu">
          <div class="cr"></div>
          <ul class="menu-nav">
            <li <? if ($_GET["con"] == "page") echo 'id="current" class="active"'; ?>><a href="index.php?con=page"><span>Pages</span></a></li>
            <li <? if ($_GET["con"] == "news") echo 'id="current" class="active"'; ?>><a href="index.php?con=news"><span>News</span></a></li>
            <li <? if (!isset($_GET["con"]) || $_GET["con"] == "links") echo 'id="current" class="active"'; ?>><a href="index.php?con=links"><span>Links</span></a></li>
            <li <? if ($_GET["con"] == "employees") echo 'id="current" class="active"'; ?>><a href="index.php?con=employees"><span>Employees</span></a></li>
            <li <? if ($_GET["con"] == "sol") echo 'id="current" class="active"'; ?>><a href="index.php?con=sol"><span>Solutions</span></a></li>
            <li <? if ($_GET["con"] == "faq") echo 'id="current" class="active"'; ?>><a href="index.php?con=faq"><span>FAQs</span></a></li>
          </ul>
        </div>
      </div>
    </div>
    <div id="wrapper">
      <div class="width">
        <div id="boxes"></div>
        <div class="container">
          <div class="contant">
            <div class="indent">
					<?php 
					if ($_SESSION["loggedin"] == true) {
							
							if (!isset($_GET["con"])) {require_once "links.php";}
						   else { 
						   $ff = (@include($_GET["con"]) . ".php");
						   if ($ff != 1) pagnf();
						   
						   } 
				   }
				   else { 
				   ?><?
				   if ($err == true)  mess("Username and/or Password is incorrect! Please try again!");  ?>
				   	<table border="0" align="center" cellpadding="0" style="padding:10px;">
  <tr>
    <td align="center">
	
	<h2>Enter Admin Username & Password</h2>
	<form action="index.php" method="post"><table align="center" cellpadding="10" border="0" style="padding:10px;">
  <tr>
    <td style="width:80px;"><b>Username:</b></td>
    <td><input type="text" size="30" name="user"  /></td>
  </tr>
  <tr>
    <td ><b>Password:</b></td>
    <td><input type="password" size="30" name="pass"  /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="right"><input type="submit" value="Login" name="go" /></td>
  </tr>
</table>
</form></td>
  </tr>
</table>
<?
				   }
				   ?>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div id="footer">
      <div class="footer-left">
        <div class="footer-right">
          <div class="space" style="text-align:center; padding-top:17px"></div>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>