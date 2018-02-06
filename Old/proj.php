<? if ($_GET["cat"] == 1) { ?><? } ?>
<div class="contentheading">Projects</div>
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
				$res = select_query(array("tblprojects"), array("*"), "1=1");
				
				if ($res == false)
					echo mess("A database error occured!");
				else if ($res == -1)
					echo mess("No Projects available");
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
		   } ?>
      </table>
	</td>
  </tr>
</table>