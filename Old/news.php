<? if (isset($_GET["id"])) { 
								global $g_db;
								if (!$g_db)
									db_connect();
								if (!$g_db)
									echo "No database connection available!";
								else {
									$res = select_query(array("tblnews"),array("*"),"newsID =".$_GET["id"]);
									if ($res == false)
										echo "Database Error";
									else if ($res == -1)
										echo mess("News Article Not Found!!!");
									else
									{
										$row = mysql_fetch_assoc($res)
										
										?>
<table class="blog" cellpadding="0" cellspacing="0">
                        <tr>
                          <td valign="top"><div>
                              <table class="contentpaneopen">
                                <tr>
                                  <td class="contentheading" width="100%"><? echo $row["newsTitle"]; ?></td>
                                </tr>
                              </table>
                              <table class="contentpaneopen">
                                <tr>
                                  <td valign="top" colspan="2" class="article_indent"><p><p>
								  <? echo $row["newsDesc"]; ?>
								  <p>&nbsp;</p> <a href="index.php?con=news&alln=1" class="mostread">All News...</a>
								  </td>
                                </tr>
                              </table>
                              <span class="article_separator">&nbsp;</span> </div> </td>
                        </tr>
                        
                      </table>
										<?
										
									}
								}
 } else {?>
 <div class="contentheading">All News</div>
<table style="font-size:11px;" width="100%" border="0" cellpadding="5">
              <?php 
		 	if (!$g_db)
				db_connect();
			if (!$g_db)
				echo "<h3>No database connection available!<h3>";
			else {
				$res = select_query(array("tblnews"), array("*"), "1 = 1 order by newsDate");
				
				if ($res == false)
					echo mess("A database error occured!");
				else if ($res == -1)
					echo "<td>".mess("No News articles available")."</td>";
				else{
				$i = 1; ?>
              <tr>
                <td  style=" padding-bottom:10px; border-bottom:1px dashed #999999;" align="center"><strong>Date</strong></td>
                <td  style=" padding-bottom:10px; border-bottom:1px dashed #999999;" width="76%"><span style="font-weight: bold">News</span></td>
              </tr>
              <?php
				$ch = 1;
				while ($row = mysql_fetch_assoc($res))
				{
		   ?>
              <tr>
                <td width="24%"  style=" border-bottom:1px dashed #CCCCCC; vertical-align:middle" valign="middle" align="center"><?php echo date("Y-m-d",strtotime($row["newsDate"])); ?></td>
                <td   style=" border-bottom:1px dashed #CCCCCC; padding:5px;" width="76%"> <a href="index.php?con=news&id=<? echo $row["newsID"]; ?> "><?php echo $row["newsTitle"]; ?></a> </td>
              </tr>
              <?php
		  		} }
		   } ?>
            </table>
<? } ?>