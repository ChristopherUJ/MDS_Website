<? 
global $g_db;
			if (!$g_db)
				db_connect();
			if (!$g_db)
				mess("<h3>Could not connect!</h3>");
			else {
				$res3 = select_query(array("tblpages"),array("*"),"pageID = 5");
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
                                          <td valign="top"><? echo str_replace("../","",$row["pageContent"]); ?><p>&nbsp;</p>
<table style="font-size:11px;" width="100%" border="0" cellpadding="5">
              <?php 
		 	if (!$g_db)
				db_connect();
			if (!$g_db)
				echo "<h3>No database connection available!<h3>";
			else {
				$res = select_query(array("tblfaq"), array("*"), "1 = 1 order by faqDate");
				
				if ($res == false)
					echo mess("A database error occured!");
				else if ($res == -1)
					echo "<td>".mess("No Frequently Asked Questions available")."</td>";
				else{
				$i = 1; ?>
              <tr>
                <td  style=" padding-bottom:10px; border-bottom:1px dashed #999999;" width="76%"><span style="font-weight: bold">News</span></td>
              </tr>
              <?php
				$ch = 1;
				while ($row2 = mysql_fetch_assoc($res))
				{
		   ?>
              <tr>
                <td   style=" border-bottom:1px dashed #CCCCCC; padding:5px;" width="76%"> <a href="javascript:void;" onclick="document.getElementById('faq<? echo $row2["faqID"]; ?>').style.display = 'block';"><?php echo $row2["faqQuestion"]; ?></a><div style="margin:10px; display:none;" id="faq<? echo $row2["faqID"]; ?>"><? echo $row2["faqAnswer"]; ?></div></td>
              </tr>
              <?php
		  		} }
		   } ?>
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