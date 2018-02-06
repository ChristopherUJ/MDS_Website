<div class="width">
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
                                                    <td class="contentheading" width="100%">Search Results for '<span style="color:#006600;"><? echo $_GET["searchword"]; ?></span>'</td>
                                                    <td align="right" width="100%" class="buttonheading"> </td>
                                                    <td align="right" width="100%" class="buttonheading"> </td>
                                                    <td align="right" width="100%" class="buttonheading"></td>
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
                                                <td valign="top" class="createdate"></td>
                                              </tr>
                                            </table></td>
                                        </tr>
                                        <tr>
                                          <td valign="top"><table width="70%" border="0" cellspacing="0" cellpadding="10">
  <tr>
    <td>
      <table style="font-size:11px; margin-top:10px;" width="100%" border="0" cellpadding="5">
              <?php 
		 	if (!$g_db)
				db_connect();
			if (!$g_db)
				echo "<h3>No database connection available!<h3>";
			else {
				$res = select_query(array("tblpages"), array("*"), " pageTitle like '%".$_GET["searchword"]."%' OR SOUNDEX(pageTitle) = SOUNDEX('". $_GET["searchword"]. "')  OR pageContent like '%".$_GET["searchword"]."%'");
				
				if ($res == false)
					echo mess("A database error occured!");
				else if ($res == -1)
				;
				else{
				$i = 1; ?>
              <?php
				$ch = 1;
				while ($row = mysql_fetch_assoc($res))
				{
				
				$i++;
		   ?>
              <tr valign="middle">
                <td style="vertical-align:middle; text-transform:capitalize; padding-left:20px;"><a href="index.php?con=<? 
				if ( $row["pageID"] == 1) echo "hom";
				else if ( $row["pageID"] == 2) echo "about";
				else if ( $row["pageID"] == 3) echo "services";
				else if ( $row["pageID"] == 4) echo "solutions";
				else if ( $row["pageID"] == 5) echo "faq";				
				
				 ?>"><?php echo $row["pageTitle"]; ?></a></td>
              </tr>
              <tr valign="middle">
                <td ></td>
                <td >&nbsp;</td>
              </tr>
              <?php
		  		} }			
			

$res = select_query(array("tblsolutions"), array("*"), " solTitle like '%".$_GET["searchword"]."%' OR SOUNDEX(solTitle) = SOUNDEX('". $_GET["searchword"]. "')   OR solContent like '%".$_GET["searchword"]."%'");
				
				if ($res == false)
					echo mess("A database error occured!");
				else if ($res == -1)
				;
				else{
				$i = 1; ?>
              <?php
				$ch = 1;
				while ($row = mysql_fetch_assoc($res))
				{
				
				$i++;
		   ?>
              <tr valign="middle">
                <td style="vertical-align:middle; text-transform:capitalize; padding-left:20px;"><a href="index.php?con=soldis&id=<? echo $row["solID"]; ?>"><?php echo $row["solTitle"]; ?></a></td>
              </tr>
              <tr valign="middle">
                <td ></td>
                <td >&nbsp;</td>
              </tr>
              <?php
		  		} }
				
$res = select_query(array("tblsolutioncat"), array("*"), " solcatTitle like '%".$_GET["searchword"]."%' OR SOUNDEX(solcatTitle) = SOUNDEX('". $_GET["searchword"]. "')   OR solcatDesc like '%".$_GET["searchword"]."%'");
				
				if ($res == false)
					echo mess("A database error occured!");
				else if ($res == -1)
				;
				else{
				$i = 1; ?>
              <?php
				$ch = 1;
				while ($row = mysql_fetch_assoc($res))
				{
				
				$i++;
		   ?>
              <tr valign="middle">
                <td style="vertical-align:middle; text-transform:capitalize; padding-left:20px;"><a href="index.php?con=sol&cat=<? echo $row["solcatID"]; ?>"><?php echo $row["solcatTitle"]; ?></a></td>
              </tr>
              <tr valign="middle">
                <td ></td>
                <td >&nbsp;</td>
              </tr>
              <?php
		  		} }
$res = select_query(array("tblnews"), array("*"), " newsTitle like '%".$_GET["searchword"]."%' OR SOUNDEX(newsTitle) = SOUNDEX('". $_GET["searchword"]. "')   OR newsDesc like '%".$_GET["searchword"]."%'");
				
				if ($res == false)
					echo mess("A database error occured!");
				else if ($res == -1)
				;
				else{
				$i = 1; ?>
              <?php
				$ch = 1;
				while ($row = mysql_fetch_assoc($res))
				{
				
				$i++;
		   ?>
              <tr valign="middle">
                <td style="vertical-align:middle; text-transform:capitalize; padding-left:20px;"><a href="index.php?con=news&id=<? echo $row["newsID"]; ?>"><? echo $row["newsTitle"]; ?></a></td>
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