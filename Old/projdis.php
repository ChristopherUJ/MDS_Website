<? if (isset($_GET["id"])) { 
								global $g_db;
								if (!$g_db)
									db_connect();
								if (!$g_db)
									echo "No database connection available!";
								else {
									$res = select_query(array("tblprojects"),array("*"),"projID =".$_GET["id"]);
									if ($res == false)
										echo "Database Error";
									else if ($res == -1)
										echo mess("Project Not Found!!!");
									else
									{
										$row = mysql_fetch_assoc($res)
										
										?>
<table class="blog" cellpadding="0" cellspacing="0">
                        <tr>
                          <td valign="top"><div>
                              <table class="contentpaneopen">
                                <tr>
                                  <td class="contentheading" width="100%"><? echo $row["projTitle"]; ?></td>
                                </tr>
                              </table>
                              <table class="contentpaneopen">
                                <tr>
                                  <td valign="top" colspan="2" class="article_indent"><p><p>
								  <? echo str_replace("../","",$row["projContent"]); ?>
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