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
		else if ( strtolower($_POST["user"]) != "marine")
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
<script>
image4 = new Image(); image4.src = "assets/topmenu-item-right-bg-act.jpg";
image5 = new Image(); image5.src = "assets/topmenu-item-left-bg-act.jpg"; 
image6 = new Image(); image6.src = "assets/tail.jpg"; 
</script>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Marine Data, Marine, Data" />
<meta name="description" content="Automatic Identification Systems, Vessel Traffic Management and Informations Systems." />
<title>Marine Data Solutions</title>
<link rel="stylesheet" href="assets/template.css" type="text/css" />
<link rel="stylesheet" href="assets/constant.css" type="text/css" />
</head>
<body>
<div id="tail">
  <div class="main">
    <div id="top">
      <div class="left-bg">
        <div class="right-bg">
          <div id="logo"> <a href="http://www.marinedata.co.za/admin/" title="Home"><img style="margin-top:30px; margin-left:70px;" src="assets/lol.gif" /></a> </div>
          <div id="top-funk">
            <div id="search">
              <div class="module-search">
              </div>
            </div>
            <div id="topmenu" style="margin-left:50px; width:550px;">
              <div class="module-topmenu">
                <ul class="menu-nav" style="margin:0px; padding:0px;">
                  <li class="item53"><a href="index.php?con=page"><span><em>Pages</em></span></a></li>
                  <li class="item53"><a href="index.php?con=sol"><span><em>Solutions</em></span></a></li>
                  <li class="item29"><a href="index.php?con=proj"><span><em>Projects</em></span></a></li>
                  <li class="item54"><a href="index.php?con=employees"><span><em>Employees</em></span></a></li>
                  <li class="item18"><a href="index.php?con=news"><span><em>News</em></span></a></li>
                  <li class="item18"><a href="index.php?con=links"><span><em>Links</em></span></a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div id="header">
      <div class="left-bg">
        <div class="right-bg"><img style="margin-left:60px; margin-top:5px;" src="assets/slogpics.jpg" width="379" height="64" /><br>
          <style>
 .slog h1 {
font-family:Tahoma; font-size:18px; color:#484848; font-weight:normal; margin:0px; margin-top:4px;
 }
</style>
<div style="width:400px; margin-left:40px; margin-top:60px;"></div>
</div>
      </div>
    </div>
    <div id="content">
      <div class="shadow-l">
        <div class="shadow-tl">
          <div class="shadow-r">
            <div class="shadow-tr">
              <div class="space">
                <div class="width">
                  <div id="right">
				  </div>

                  <div id="container" style="margin-left:0px;">
                    <div class="comp-cont">
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
	<form action="index.php" method="post"><table style="padding:10px; " align="center" cellpadding="10" border="0">
  <tr>
    <td style="width:80px;"><b>Username:</b></td>
    <td><input type="text" size="30" name="user"  /></td>
  </tr>
  <tr>
    <td><b>Password:</b></td>
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
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div id="footer">
  <div class="main">
    <div class="bg-bot">
      <div class="bg-right">
        <div class="bg-left">
          <div class="space"></div>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>
