<? 
global $g_db;
			if (!$g_db)
				db_connect();
			if (!$g_db)
				mess("<h3>Could not connect!</h3>");
			else {
				$res3 = select_query(array("tblpages"),array("*"),"pageID = 3");
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
?>
<div class="contentheading"><? echo $row["pageTitle"]; ?></div>
<style>
								  .biga a {
								  	font-size:15px;
								  }
								  
								  .biga img {
								  	border:none;
								  }
								  </style>
<? echo $row["pageContent"]; ?>		
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
