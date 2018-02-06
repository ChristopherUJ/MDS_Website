<?
		if (!$g_db)
				db_connect();
			if (!$g_db)
				echo "<h3>No database connection available!<h3>";
			else {
				$resc = select_query(array("tblsolutioncat"), array("*"), "solcatID = ".$_GET["cat"]);
				
				if ($resc == false)
					echo mess("A database error occured!");
				else if ($resc == -1)
 				{}
				else{
						$rowc = mysql_fetch_assoc($resc);
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
                                                    <td class="contentheading" width="100%"><? echo $rowc["solcatTitle"]; ?></td>
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
                                          <td valign="top"><? if ($rowc["solcatDesc"] != NULL && $rowc["solcatDesc"] != "") { echo str_replace("../","",$rowc["solcatDesc"]); } ?>
<table width="70%" border="0" cellspacing="0" cellpadding="10" style="margin-left:15px;margin-top:15px;">
  <tr>
    <td>
      <table style="font-size:11px;" width="100%" border="0" cellpadding="5">
              <?php 
		 	if (!$g_db)
				db_connect();
			if (!$g_db)
				echo "<h3>No database connection available!<h3>";
			else {
				$res = select_query(array("tblsolutions"), array("*"), "solCat = ".$_GET["cat"]);
				
				if ($res == false)
					echo mess("A database error occured!");
				else if ($res == -1)
					echo mess("No Solutions available");
				else{
				$i = 1; ?>
              <?php
				$ch = 1;
				while ($row = mysql_fetch_assoc($res))
				{
				
				$i++;
		   ?>
              <tr valign="middle">
                <td width="40" style="vertical-align:middle"><img align="absmiddle" width="40" src="<?php echo $row["solImage"]; ?>"/></td>
                <td style="vertical-align:middle; text-transform:capitalize; padding-left:10px;"><a href="index.php?con=soldis&id=<? echo $row["solID"]; ?>"><?php echo $row["solTitle"]; ?></a></td>
              </tr>
              <tr valign="middle">
                <td ></td>
                <td >&nbsp;</td>
              </tr>
              <?php
		  		} }
		   } ?>
      </table>
	</td>
  </tr>
</table>
                                          </td>
                                        </tr>
                                        <tr>
                                          <td class="modifydate"></td>
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