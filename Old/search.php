
<div class="contentheading">Search Results for '<? echo $_GET["searchword"]; ?>'</div>
<table width="70%" border="0" cellspacing="0" cellpadding="10">
  <tr>
    <td>
      <table style="font-size:11px; margin-top:10px;" width="100%" border="0" cellpadding="5">
              <?php 
		 	if (!$g_db)
				db_connect();
			if (!$g_db)
				echo "<h3>No database connection available!<h3>";
			else {
				$res = select_query(array("tblprojects"), array("*"), " projTitle like '%".$_GET["searchword"]."%' OR SOUNDEX(projTitle) = SOUNDEX('". $_GET["searchword"]. "')  OR projContent like '%".$_GET["searchword"]."%'");
				
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
                <td style="vertical-align:middle; text-transform:capitalize; padding-left:20px;"><a href="index.php?con=projdis&id=<? echo $row["projID"]; ?>"><?php echo $row["projTitle"]; ?></a></td>
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