<? if (isset($_GET["id"]))
{
	if (isset($_GET["edt"]))
	{
		mess("Solution Successfully Updated!");
	}
	else
	{
		mess("Solution Added!");
	}
	echo "<p>&nbsp;</p>";
}

if (isset($_GET["cid"]))
{
	if (isset($_GET["edt"]))
	{
		mess("Solution Category Successfully Updated!");
	}
	else
	{
		mess("Solution Category Added!");
	}
	echo "<p>&nbsp;</p>";
}
global $g_db;
if (isset($_GET["del"]))
{
			if (!$g_db)
				db_connect();
			if (!$g_db)
				echo "<h3>No database connection available!<h3>";
			else {
				$res = delete_query("tblsolutions","solID = ".$_GET["del"]);
				mess("Solution Deleted!");
	echo "<p>&nbsp;</p>";
			}
}

if (isset($_GET["delc"]))
{
			if (!$g_db)
				db_connect();
			if (!$g_db)
				echo "<h3>No database connection available!<h3>";
			else {
				$res = delete_query("tblsolutioncat","solcatID = ".$_GET["delc"]);
				mess("Solution Category Deleted!");
	echo "<p>&nbsp;</p>";
			}
}
?><table width="100%" border="0" cellspacing="0" cellpadding="10">
  <tr>
    <td><h2>Solution Administration:</h2>
      <p>&nbsp;</p>
      <div style="font-size:14px; font-weight:bold; color:#666666; margin-bottom:10px;">Solution Categories </div>
      <table style="font-size:11px; border:1px solid #999999;" width="100%" border="0" cellpadding="5" >
              <?php 
		 	if (!$g_db)
				db_connect();
			if (!$g_db)
				echo "<h3>No database connection available!<h3>";
			else {
				$res = select_query(array("tblsolutioncat"), array("*"), "1 = 1");
				
				if ($res == false)
					echo mess("A database error occured!");
				else if ($res == -1)
					echo mess("No Categories available");
				else{
				$i = 1; ?>
              <tr valign="middle">
                <td  style=" padding-bottom:10px; border-bottom:1px solid #999999;"><strong>Toolbar</strong></td>
                <td  style=" padding-bottom:10px; border-bottom:1px solid #999999;" width="76%"><strong>Solution Category</strong></td>
              </tr>
              <?php
				$ch = 1;
				while ($row = mysql_fetch_assoc($res))
				{
		   ?>
              <tr valign="middle" style="background-color: 
		  <?php 
		  
		  ?>;">
                <td width="24%"  style=" border-bottom:1px dashed #CCCCCC; vertical-align:middle;"><table width="180" border="0" cellspacing="5" cellpadding="0">
                    <tr>
                      <td width="117"><table style="display:inline; margin:0px;"  width="142" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="33%" align="center" valign="middle" style=" vertical-align:middle;"><input name="image" type="image" onclick="window.location ='index.php?con=solcatedt&id=<?php echo $row["solcatID"]; ?>';" src="images/edit.gif" title="Edit" width="22" height="20" /></td>
                            <td width="33%" align="center" valign="middle" style=" vertical-align:middle;"><input name="image" type="image" onclick="if (confirm('Are you sure you want to delete this solution category?')) { window.location ='index.php?con=sol&delc=<?php echo $row["solcatID"]; ?>'; }" src="images/remove.gif" title="remove" width="15" height="16" /></td>
                          </tr>
                      </table></td>
                    </tr>
                </table></td>
                <td   style=" border-bottom:1px dashed #CCCCCC; padding:5px;" width="76%"><?php echo $row["solcatTitle"]; ?> </td>
              </tr>
              <?php
		  		} }
		   } ?>
      </table>
	  <br />
        <input name="add" type="button" id="add" value="Add new Category" onclick="window.location = 'index.php?con=solcatedt'" />
	  <p>&nbsp; </p>
	  <div style="font-size:14px; font-weight:bold; color:#666666; margin-bottom:10px;">Solutions</div>
	  <table style="font-size:11px; border:1px solid #999999;" width="100%" border="0" cellpadding="5" >
        <?php 
		 	if (!$g_db)
				db_connect();
			if (!$g_db)
				echo "<h3>No database connection available!<h3>";
			else {
				$res = select_query(array("tblsolutions"), array("*"), "1 = 1");
				
				if ($res == false)
					echo mess("A database error occured!");
				else if ($res == -1)
					echo mess("No Solutions available");
				else{
				$i = 1; ?>
        <tr valign="middle">
          <td  style=" padding-bottom:10px; border-bottom:1px solid #999999;"><strong>Toolbar</strong></td>
          <td  style=" padding-bottom:10px; border-bottom:1px solid #999999;" width="76%"><strong>Solution</strong></td>
        </tr>
        <?php
				$ch = 1;
				while ($row = mysql_fetch_assoc($res))
				{
		   ?>
        <tr valign="middle" style="background-color: 
		  <?php 
		  
		  ?>;">
          <td width="24%"  style=" border-bottom:1px dashed #CCCCCC; vertical-align:middle;"><table width="180" border="0" cellspacing="5" cellpadding="0">
              <tr>
                <td width="117"><table style="display:inline; margin:0px;"  width="142" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="33%" align="center" valign="middle" style=" vertical-align:middle;"><input name="image2" type="image" onclick="window.location ='index.php?con=soledt&amp;id=<?php echo $row["solID"]; ?>';" src="images/edit.gif" title="Edit" width="22" height="20" /></td>
                      <td width="33%" align="center" valign="middle" style=" vertical-align:middle;"><input name="image2" type="image" onclick="if (confirm('Are you sure you want to delete this solution?')) { window.location ='index.php?con=sol&amp;del=<?php echo $row["solID"]; ?>'; }" src="images/remove.gif" title="remove" width="15" height="16" /></td>
                    </tr>
                </table></td>
              </tr>
          </table></td>
          <td   style=" border-bottom:1px dashed #CCCCCC; padding:5px;" width="76%"><?php echo $row["solTitle"]; ?> </td>
        </tr>
        <?php
		  		} }
		   } ?>
      </table>
	  <br />
      <input name="add2" type="button" id="add2" value="Add new Solution" onclick="window.location = 'index.php?con=soledt'" /></td>
  </tr>
</table>