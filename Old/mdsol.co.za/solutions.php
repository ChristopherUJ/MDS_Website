<? 
global $g_db;
			if (!$g_db)
				db_connect();
			if (!$g_db)
				mess("<h3>Could not connect!</h3>");
			else {
				$res3 = select_query(array("tblpages"),array("*"),"pageID = 4");
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
?> <div class="width">
                <div class="border-left">
                  <div class="border-right">
                    <div class="border-top">
                      <div class="border-bottom">
                        <div class="corner-top-left">
                          <div class="corner-top-right">
                            <div class="corner-bottom-left">
                              <div class="corner-bottom-right">
                                <div class="width">
                                  <div class="title-top">
                                    <div class="title-bottom">
                                      <div class="title-top-left">
                                        <div class="title-top-right">
                                          <div class="title-bottom-left">
                                            <div class="title-bottom-right">
                                              <div class="width">
                                                <table class="contentpaneopen">
                                                  <tr>
                                                    <td class="contentheading" width="100%"><? echo $row["pageTitle"]; ?></td>
                                                    <td align="right" width="100%" class="buttonheading"> </td>
                                                    <td align="right" width="100%" class="buttonheading"> </td>
                                                    <td align="right" width="100%" class="buttonheading"><a href="#" title="Print"  rel="nofollow"><img src="images/printButton.png" alt="Print"></a></td>
                                                  </tr>
                                                </table>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="article-indent">
                                    <div class="width">
                                      <table class="contentpaneopen">
                                        <tr>
                                          <td class="logotype"><table>
                                              <tr></tr>
                                              <tr>
                                                <td valign="top" class="createdate"><? echo date("l, d F Y H:i",time()); ?></td>
                                              </tr>
                                            </table></td>
                                        </tr>
                                        <tr>
                                          <td valign="top"><? echo str_replace("../","",$row["pageContent"]); ?>
										  <style>
								  .biga a {
								  	font-size:15px;
								  }
								  
								  .biga img {
								  	border:none;
								  }
								  </style>
		<table style="width:100%; margin-top:20px;" align="center" class="biga"><tr>
<?
			if (!$g_db)
				db_connect();
			if (!$g_db)
				mess("<h3>Could not connect!</h3>");
			else {
				$res3 = select_query(array("tblsolutioncat"),array("*"),"1=1 order by solcatID ASC");
				if ($res3 == false)
				{
					echo "<h3>System Error. Please try again or come back later. </h3>";
				}
				else if ($res3 == -1)
				{
?>
          <td>No Solution Categories Found</td>
<?
				}
				else {
					$i = 0;
					$cc = @mysql_num_rows($res3);
					while($row = mysql_fetch_assoc($res3))
					{ $i++;

					?>
          <td align="center" <? if ($i == $cc && $cc % 2 != 0 ) { echo "colspan='2'"; } ?>  valign="middle" style="padding-top:15px; padding-bottom:15px; width:50%"><a href="index.php?con=sol&cat=<? echo $row["solcatID"]; ?>" title="<? echo $row["solcatTitle"]; ?>"><img src="<? echo $row["solcatImage"]; ?>"/><br><p></p><? echo $row["solcatTitle"]; ?></a></td>
					<?
						if ($i % 2 == 0 && $i != 1)
						 echo "</tr><tr>";
					}
				}
			} ?>
        </tr>
      </table>

                                          </td>
                                        </tr>
                                        <tr>
                                          <td class="modifydate"> Last Updated on <? echo date("l, d F Y H:i",strtotime($row["pageLastUpdate"])); ?> </td>
                                        </tr>
                                      </table>
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
                <span class="article_separator">&nbsp;</span> </div>