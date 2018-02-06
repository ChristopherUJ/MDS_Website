<? if (isset($_GET["id"]))
{
	if (isset($_GET["edt"]))
	{
		mess("Link Entry Successfully Updated!");
	}
	else
	{
		mess("Link Entry Added!");
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
				$res = delete_query("tbllinks","linkID = ".$_GET["del"]);
				mess("Link Deleted!");
	echo "<p>&nbsp;</p>";
			}
}
?><table width="70%" border="0" cellspacing="0" cellpadding="10">
  <tr>
    <td><h2>Link Administration:</h2>
      <p>&nbsp;</p><table style="font-size:11px;" width="100%" border="0" cellpadding="5">
              <?php 
		 	if (!$g_db)
				db_connect();
			if (!$g_db)
				echo "<h3>No database connection available!<h3>";
			else {
				$res = select_query(array("tbllinks"), array("*"), "1 = 1");
				
				if ($res == false)
					echo mess("A database error occured!");
				else if ($res == -1)
					echo mess("No Links available");
				else{
				$i = 1; ?>
              <tr valign="middle">
                <td  style=" padding-bottom:10px; border-bottom:1px solid #999999;"><strong>Toolbar</strong></td>
                <td  style=" padding-bottom:10px; border-bottom:1px solid #999999;" width="76%"><strong>Link </strong></td>
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
                      <td width="117" style=" vertical-align:middle;"><table style="display:inline; margin:0px;"  width="142" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="33%" align="center" style=" vertical-align:middle;"><input name="image" type="image" onclick="window.location ='index.php?con=linkedt&id=<?php echo $row["linkID"]; ?>';" src="images/edit.gif" title="Edit" width="22" height="20" /></td>
                            <td width="33%" align="center" style=" vertical-align:middle;"><input name="image" type="image" onclick="if (confirm('Are you sure you want to delete this link?')) { window.location ='index.php?con=links&del=<?php echo $row["linkID"]; ?>'; }" src="images/remove.gif" title="remove" width="15" height="16" /></td>
                          </tr>
                      </table></td>
                    </tr>
                </table></td>
                <td   style=" border-bottom:1px dashed #CCCCCC; padding:5px;" width="76%"><a href="<? echo $row["linkUrl"]; ?>"><?php echo $row["linkTitle"]; ?> </td>
              </tr>
              <?php
		  		} }
		   } ?>
            </table>
	  <br />
      <input name="add" type="button" id="add" value="Add new" onclick="window.location = 'index.php?con=linkedt'" /></td>
  </tr>
</table>