<?
	require_once "com/session.php";
	require_once "com/globals.php";
	require_once "com/dbcon.php";
	require_once "com/db_funcs.php"; 
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
        <div id="search">
          <form action="index.php" method="get">
            <div class="search">
              <div class="search-input">
			  	<input type="hidden" name="con" value="search" />
                <input name="searchword" id="mod_search_searchword" maxlength="20" alt="Search" class="inputbox" type="text" size="20" value="search..."  onblur="if(this.value=='') this.value='search...';" onfocus="if(this.value=='search...') this.value='';" />
              </div>
              <div class="search-button">
                <input type="image" value="Search" class="button" src="images/searchButton.gif" onclick="this.form.searchword.focus();"/>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div id="topmenu">
        <div class="module-topmenu">
          <div class="cr"></div>
          <ul class="menu-nav">
            <li <? if (!isset($_GET["con"]) || $_GET["con"] == "home") echo 'id="current" class="active"'; ?>><a href="index.php"><span>Home</span></a></li>
            <li <? if ($_GET["con"] == "about") echo 'id="current" class="active"'; ?>><a href="index.php?con=about"><span>About</span></a></li>
            <li <? if ($_GET["con"] == "services") echo 'id="current" class="active"'; ?>><a href="index.php?con=services"><span>Services</span></a></li>
            <li <? if ($_GET["con"] == "solutions") echo 'id="current" class="active"'; ?>><a href="index.php?con=solutions"><span>Solutions</span></a></li>
            <li <? if ($_GET["con"] == "news") echo 'id="current" class="active"'; ?>><a href="index.php?con=news"><span>News</span></a></li>
            <li <? if ($_GET["con"] == "faq") echo 'id="current" class="active"'; ?>><a href="index.php?con=faq"><span>FAQs</span></a></li>
            <li <? if ($_GET["con"] == "contactus") echo 'id="current" class="active"'; ?>><a href="index.php?con=contactus"><span>Contacts</span></a></li> 
          </ul>
        </div>
      </div>
    </div>
    <div id="wrapper">
      <div class="width">
        <div id="boxes">
          <div class="user1">
            <div class="module-box">
              <div class="first">
                <div class="sec">
                  <div class="width">
                    <div class="sect"><strong><span style="padding-left:4px;">Effective services</span>,</strong><span style="padding-left:4px;"><br />
                      Maximise uptime and productivity and tailored  to suit your exact requirements</span>.</div>
                    <a class="click" href="index.php?con=services">More about our Services </a> </div>
                </div>
              </div>
            </div>
          </div>
          <div class="user2">
            <div class="module-box">
              <div class="first">
                <div class="sec">
                  <div class="width">
                    <div class="sect"><strong>Our solutions include:</strong> <br />
                    Desktops and Servers, Network Design &amp; Installation, Access control Equipment and more.</div>
                  <a class="click" href="index.php?con=solutions">More Information </a> </div>
                </div>
              </div>
            </div>
          </div>
          <div class="user3">
            <div class="module-box">
              <div class="first">
                <div class="sec">
                  <div class="width">
                    <div class="sect"><strong>We  have 24hr Staff on Standby ,</strong> see our FAQ for general questions or send us a enquiry on our contact page. </div>
                    <a class="click" href="index.php?con=contactus">Contact Us </a> </div>
                </div>
              </div>
            </div>
          </div>
          <div class="user4">
            <div class="module-box">
              <div class="first">
                <div class="sec"></div>
              </div>
            </div>
          </div>
        </div>
        <div class="container">
          <div id="left">
            <div class="module_menu">
              <div class="first">
                <div class="sec">
                  <h3><span>News</span></h3>
                  <div class="box-indent">
                    <div class="width">
                      <ul class="menu">
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
 <li> <a style="font-size:11px;" href="index.php?con=news&id=<? echo $row["newsID"]; ?>"><? echo $row["newsTitle"]; ?></a> </li>
										<?
										}
									}
								}
			 ?>

                                  <li > <a href="index.php?con=news&alln=1" style="font-size:11px;" >More News ...</a> </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="module">
              <div class="first">
                <div class="sec">
                  <h3><span>Unique Service</span></h3>
                  <div class="box-indent">
                    <div class="width">
                      <table>
                        <tr>
                          <td valign="top" align="left"><strong>• </strong></td>
                          <td align="left" style="padding-left:4px;">Effective services to maximise uptime and productivity.<br />
                            <br /></td>
                        </tr>
                        <tr>
                          <td valign="top" align="left"><strong>• </strong></td>
                          <td align="left" style="padding-left:4px;">Our turnaround times mean minimised downtime and improved productivity.<br />
                            <br /></td>
                        </tr>
                        <tr>
                          <td valign="top" align="left"><strong>• </strong></td>
                          <td align="left" style="padding-left:4px;">Tailored solutions to suit your requirements.<br />
                            <br /></td>
                        </tr>
                        <tr>
                          <td valign="top" align="left"><strong>• </strong></td>
                          <td align="left" style="padding-left:4px;">As a leading black empowerment company we offer you a long-term partnership.</td>
                        </tr>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
<div class="module">
              <div class="first">
                <div class="sec">
                  <h3><span>Links</span></h3>
                  <div class="box-indent">
                    <div class="width">
                      <table style="margin-left:20px;">
<? global $g_db;
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
                        <tr>
                          <td valign="middle" align="left" width="12" style="vertical-align:middle"><img src="images/click.gif" width="8" style="margin:0px;" height="5" /></td>
                          <td align="left" style="padding:4px;vertical-align:middle"><a href="<? echo $row["linkUrl"]; ?>" target="_blank"><? echo $row["linkTitle"]; ?></em></a></td>
                        </tr>
										<?
										}
									}
								}
			 ?>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="contant">
            <div class="indent">
              		<?php 
					if (!isset($_GET["con"])) {require_once "hom.php";}
				   else { 
				   $ff = (@include($_GET["con"]) . ".php");
				   if ($ff != 1) pagnf();
				   
				   } ?>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div id="footer">
      <div class="footer-left">
        <div class="footer-right">
          <div class="space" style="text-align:center; padding-top:17px">
            <table border="0" align="center" style="width:auto;" cellspacing="0" cellpadding="5">
              <tr>
                <td align="center" style="width:auto; padding:3px;">[ <a href="index.php">Home</a> ] </td>
                <td align="center" style="width:auto; padding:3px;">[ <a href="index.php?con=about">About</a> ]  </td>
                <td align="center" style="width:auto; padding:3px;">[ <a href="index.php?con=services">Services</a> ] </td>
                <td align="center" style="width:auto; padding:3px;">[ <a href="index.php?con=solutions">Solutions</a> ] </td>
                <td align="center" style="width:auto; padding:3px;">[ <a href="index.php?con=support">Support</a> ] </td>
                <td align="center" style="width:auto; padding:3px;">[ <a href="index.php?con=faq">FAQ</a> ] </td>
                <td align="center" style="width:auto; padding:3px;">[ <a href="index.php?con=news">News</a> ] </td>
                <td align="center" style="width:auto; padding:3px;">[ <a href="index.php?con=contactus">Contact Us</a> ] </td>
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