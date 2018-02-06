
<div class="contentheading">		<?
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
						echo $rowc["solcatTitle"]; 
				}
		}
	 ?></div>
<table width="100%" border="0"><tr><td><? if ($rowc["solcatDesc"] != NULL && $rowc["solcatDesc"] != "") { echo str_replace("../","",$rowc["solcatDesc"]); } ?></td></tr></table>
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
					echo '';
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