<?
	require_once "com/session.php";
	require_once "com/globals.php";
	require_once "com/dbcon.php";
	require_once "com/db_funcs.php"; 
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script>
image4 = new Image(); image4.src = "assets/topmenu-item-right-bg-act.jpg";
image5 = new Image(); image5.src = "assets/topmenu-item-left-bg-act.jpg"; 
image6 = new Image(); image6.src = "assets/tail.jpg"; 
</script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Marine Data, Marine, Data" />
<meta name="description" content="Automatic Identification Systems, Vessel Traffic Management and Informations Systems." />
<title>Marine Data Solutions</title>
<link rel="stylesheet" href="assets/template.css" type="text/css" />
<link rel="stylesheet" href="assets/constant.css" type="text/css" />
<script type="text/javascript">
var _gaq = _gaq || [];
_gaq.push(['_setAccount', 'UA-32729290-1']);
_gaq.push(['_trackPageview']);

(function() {
var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
})();
</script>
</head>
<body>
<div  id="tail">
<div style="width:911px; margin:auto;">
  <table style="width:911px;" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td><div id="top">
          <div class="left-bg">
            <div class="right-bg">
              <div id="logo"> <a href="http://www.marinedata.co.za" title="Home"><img style="margin-top:30px; margin-left:70px;" src="assets/mlogo.gif" /></a> </div>
              <div id="top-funk">
			  	<a href="http://www.kongsberg.com/" target="_blank"><img src="images/kongsberg_logo.png" alt="Kongsberg" title="Proudly Associated With Kongsberg" style="float: left;height: 60px;margin-right: 40px;margin-top: 17px;"></a>
				<a href="http://www.facebook.com/MarineDataSolutionsptyLtd" target="_blank"><img src="images/find_us_on_facebook.jpg" title="Find Us On Facebook" alt="Facebook" style="height: 35px;float: left;margin-top: 33px;"></a>
                <div id="search">
                  <div class="module-search">
                    <h3>Search</h3>
                    <form action="index.php" method="get">
					<input type="hidden" name="con" value="search" />
                      <div class="search">
                        <input name="searchword" id="mod_search_searchword"  maxlength="20" alt="Search" class="inputbox" type="text" size="20" value="" style="margin-top:3px;"  onblur="if(this.value=='') this.value='search...';" onfocus="if(this.value=='search...') this.value='';" />
                        <input type="image" value="Search"  style="padding:0px; margin-left:-3px; width:50px; height:26px;" class="button" src="assets/searchButton.gif" onclick="this.form.searchword.focus();"/>
                      </div>
                    </form>
                  </div>
                </div>
                <div id="topmenu" style="margin-left:50px; width:550px;">
                  <div class="module-topmenu">
                    <ul class="menu-nav">
                      <li class="item53"><a href="index.php"><span><em>Home</em></span></a></li>
                      <li class="item29"><a href="index.php?con=about"><span><em>About</em></span></a></li>
                      <li class="item54"><a href="index.php?con=solutions"><span><em>Solutions</em></span></a></li>
                      <li class="item18"><a href="index.php?con=proj"><span><em>Projects</em></span></a></li>
					  <li class="item19"><a href="index.php?con=downloads"><span><em>Downloads</em></span></a></li>
					  <li class="item57"><a href="http://marinedata.co.za.www32.jnb2.host-h.net/stats/site/login" target="_blank"><span><em>MIS</em></span></a></li>
                      <li class="item57"><a href="index.php?con=cont"><span><em>Contact Us</em></span></a></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div id="header">
          <div class="left-bg">
            <div class="right-bg<? if ($_GET["con"] != "cont") echo "2"; ?>" align="left"><br>
              <style>
 .slog h1 {
font-family:Tahoma; font-size:18px; color:#484848; font-weight:normal; margin:0px; margin-top:4px;
 }
</style>
              <div align="left" style="width:400px; margin-left:40px; margin-top:60px;"><img src="images/driven.png"  /></div>
            </div>
          </div>
        </div>
        <!-- contents start here -->
        <div id="content">
          <div class="shadow-l">
            <div class="shadow-tl">
              <div class="shadow-r">
                <div class="shadow-tr">
                  <div class="space">
                    <div class="width">
                      <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td width="206" align="center" style="text-align:left"><div id="left">
                    <div class="module_menu">
                      <div class="first">
                        <div class="sec">
                          <div class="third">
                            <h3>Latest Projects:</h3>
                            <div class="box-indent">
                              <div class="width">
                                <ul class="menu">
<? global $g_db;
								if (!$g_db)
									db_connect();
								if (!$g_db)
									echo "No database connection available!";
								else {
									$res = select_query(array("tblprojects"),array("*"),"1=1 limit 5");
									if ($res == false)
										echo "Database Error";
									else if ($res == -1)
										echo "No Projects available";
									else
									{
										while($row = mysql_fetch_assoc($res))
										{
										?>
                                  <li><a href="index.php?con=projdis&id=<? echo $row["projID"]; ?>"><span><em><? echo $row["projTitle"]; ?></em></span></a></li>
										<?
										}
									}
								}
			 ?>
                                  <li style="margin-top:5px;"><a href="index.php?con=proj"><span><em>All Projects</em></span></a></li>
                                </ul>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
					<?  if (!isset($_GET["alln"])) {?>
                    <div class="module">
                      <div class="first">
                        <div class="sec">
                          <div class="third">
                            <h3>News</h3>
                            <div class="box-indent">
                              <div class="width">
                                <ul class="mostread">
								<? global $g_db;
								if (!$g_db)
									db_connect();
								if (!$g_db)
									echo "No database connection available!";
								else {
									$res = select_query(array("tblnews"),array("*"),"1=1 order by newsDate DESC limit 5");
									if ($res == false)
										echo "Database Error";
									else if ($res == -1)
										echo "No news available";
									else
									{
										while($row = mysql_fetch_assoc($res))
										{
										?>
 <li class="mostread"> <a href="index.php?con=news&id=<? echo $row["newsID"]; ?>" class="mostread"><? echo $row["newsTitle"]; ?></a> </li>
										<?
										}
									}
								}
			 ?>

                                  <li class="mostread"> <a href="index.php?con=news&alln=1" class="mostread">More News ...</a> </li>
                                </ul>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div><? } ?>
                    <div class="module_menu">
                      <div class="first">
                        <div class="sec">
                          <div class="third">
                            <h3>Links:</h3>
                            <div class="box-indent">
                              <div class="width">
                                <ul class="menu">
                                  <li id="current" class="active item1"><? global $g_db;
								if (!$g_db)
									db_connect();
								if (!$g_db)
									echo "No database connection available!";
								else {
									$res = select_query(array("tbllinks"),array("*"),"1=1");
									if ($res == false)
										echo "Database Error";
									else if ($res == -1)
										echo "No links available";
									else
									{
										while($row = mysql_fetch_assoc($res))
										{
										?>
 <li class="item50"><a href="<? echo $row["linkUrl"]; ?>" target="_blank"><span><em><? echo $row["linkTitle"]; ?></em></span></a></li>
										<?
										}
									}
								}
			 ?>
                                </ul>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div></td>
                          <td>                
                    <div class="comp-cont" style="padding:10px;">
					<?php 
					if (!isset($_GET["con"])) {require_once "hom.php";}
				   else { 
				   $ff = (@include($_GET["con"]) . ".php");
				   if ($ff != 1) pagnf();
				   
				   } ?>
                    </div>
                </td>
                        </tr>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div></td>
    </tr>
  </table>
  </div>
</div>
<div id="footer">
  <div class="main">
    <div class="bg-bot">
      <div class="bg-right">
        <div class="bg-left">
          <div class="space"><table width="100%" border="0" cellpadding="10">
  <tr>
    <td align="left" style="padding-left:30px;"><a href="index.php?con=disclaimer">Disclaimer</a> </td>
    <td align="right"  style="padding-right:30px; color:#FFFFFF;">Proudly associated with <a href="http://www.kongsberg.com/" target="_blank">Kongsberg</a><img style="border:none; display:inline; margin-left:5px;" align="absmiddle" src="images/kl.gif" /></td>
  </tr>
</table>
</div>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>
