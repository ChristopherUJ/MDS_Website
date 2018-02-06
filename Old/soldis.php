<? if (isset($_GET["id"])) { 
								global $g_db;
								if (!$g_db)
									db_connect();
								if (!$g_db)
									echo "No database connection available!";
								else {
									$res = select_query(array("tblsolutions"),array("*"),"solID =".$_GET["id"]);
									if ($res == false)
										echo "Database Error";
									else if ($res == -1)
										echo mess("Service Not Found!!!");
									else
									{
										$row = mysql_fetch_assoc($res)
										
										?>
<table class="blog" cellpadding="0" cellspacing="0" style="margin:0px;">
                        <tr>
                          <td valign="top"><div>
                              <table class="contentpaneopen" style="margin:0px;">
                                <tr>
                                  <td class="contentheading" width="100%"><img width="60" src="<? echo $row["solImage"]; ?>" align="absmiddle" style="margin-right:10px;"/><? echo $row["solTitle"]; ?></td>
                                </tr>
                              </table>
                              <table class="contentpaneopen">
                                <tr>
                                  <td valign="top" colspan="2" class="article_indent"><p><p>
								  <? echo str_replace("../","",$row["solContent"]); ?>
								  <p>&nbsp;</p>
								  </td>
                                </tr>
                              </table>
                              <span class="article_separator">&nbsp;</span> </div> </td>
                        </tr>
                        
                      </table>
										<?
										
									}
								}
 } else {

echo mess("Solution id not specified!");

 } ?>