 <? 
global $g_db;
			if (!$g_db)
				db_connect();
			if (!$g_db)
				mess("<h3>Could not connect!</h3>");
			else {
				$res3 = select_query(array("tblpages"),array("*"),"pageID = 2");
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
?><table class="blog" cellpadding="0" cellspacing="0">
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
	echo $row["pageContent"];							  
								  
								  ?>

								  </td>
                                </tr>
                              </table>
                              <span class="article_separator">&nbsp;</span> </div></td>
                        </tr>
                        
                      </table>