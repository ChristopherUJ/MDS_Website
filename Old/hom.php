<? 
global $g_db;
			if (!$g_db)
				db_connect();
			if (!$g_db)
				mess("<h3>Could not connect!</h3>");
			else {
				$res3 = select_query(array("tblpages"),array("*"),"pageID = 1");
				if ($res3 == false)
				{
					echo "<h3>System Error. Please try again or come back later. </h3>";
				}
				else if ($res3 == -1)
				{
					mess("Page Entry Not Found");
				}
				else {
					$row = mysql_fetch_assoc($res3);
				}
			}
?> <table style="display:inline;"  cellpadding="0" cellspacing="0">
                        <tr>
                          <td valign="top"><div>
                              <table class="contentpaneopen">
                                <tr>
                                  <td class="contentheading" width="100%"><? echo $row["pageTitle"]; ?></td>
                                </tr>
                              </table>
                              <table class="contentpaneopen">
                                <tr>
                                  <td valign="top" colspan="2" class="article_indent"><?
								  
	$str = '<div align="center" style="position: relative; width: 400px; height: 300px; overflow:hidden; margin-left:100px;">

<OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
 codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0"
 WIDTH="2000" HEIGHT="2000" id="flashslide" ALIGN="">
 <PARAM NAME=movie VALUE="flashslide.swf?src=flash-here.com&imglist_fn=getimglist.php&img_path=img&interval=3000&w=400&h=300"> <PARAM NAME=quality VALUE=high> <PARAM NAME=scale VALUE=noscale> <PARAM NAME=wmode VALUE=transparent> <PARAM NAME=bgcolor VALUE=#FFFFFF> <EMBED src="flashslide.swf?src=flash-here.com&imglist_fn=getimglist.php&img_path=img&interval=3000&w=400&h=300" quality=high scale=noscale wmode=transparent bgcolor=#FFFFFF  WIDTH="2000" HEIGHT="2000" NAME="flashslide" ALIGN=""
 TYPE="application/x-shockwave-flash" PLUGINSPAGE="http://www.macromedia.com/go/getflashplayer"></EMBED>
</OBJECT>

</div>'; 
	echo str_replace("[image_rotator]",$str,$row["pageContent"]);							  
								  
								  ?>
</td>
                                </tr>
                              </table>
                              <span class="article_separator">&nbsp;</span> </div></td>
                        </tr>
                        
                      </table>