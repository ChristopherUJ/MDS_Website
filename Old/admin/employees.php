<? if (isset($_GET["id"]))
{
	if (isset($_GET["edt"]))
	{
		mess("Employee Successfully Updated!");
	}
	else
	{
		mess("Employee Added!");
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
				$res = delete_query("tblemps","empID = ".$_GET["del"]);
				mess("Employee Deleted!");
	echo "<p>&nbsp;</p>";
			}
}
?><table width="70%" border="0" cellspacing="0" cellpadding="10">
  <tr>
    <td><h2>Employee Administration:</h2>
      <p>&nbsp;</p><table style="font-size:11px;" width="100%" border="0" cellpadding="5">
              <?php 
		 	if (!$g_db)
				db_connect();
			if (!$g_db)
				echo "<h3>No database connection available!<h3>";
			else {
				$res = select_query(array("tblemps"), array("*"), "1 = 1");
				
				if ($res == false)
					echo mess("A database error occured!");
				else if ($res == -1)
					echo mess("No Employees Available");
				else{
				$i = 1; ?>
              <tr valign="middle">
                <td  style=" padding-bottom:10px; border-bottom:1px solid #999999;"><strong>Toolbar</strong></td>
                <td  style=" padding-bottom:10px; border-bottom:1px solid #999999;" width="76%"><strong>Employee</strong></td>
              </tr>
              <?php
				$ch = 1;
				while ($row = mysql_fetch_assoc($res))
				{
		   ?>
              <tr valign="middle" style="background-color: 
		  <?php 
		  
		  ?>;">
                <td width="24%" valign="middle"  style=" border-bottom:1px dashed #CCCCCC; vertical-align:middle;"><table width="180" border="0" cellspacing="5" cellpadding="0">
                    <tr>
                      <td width="117"><table style="display:inline; margin:0px;"  width="142" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="33%" align="center" valign="middle" style=" vertical-align:middle;"><input name="image" type="image" onclick="window.location ='index.php?con=empedt&id=<?php echo $row["empID"]; ?>';" src="images/edit.gif" title="Edit" width="22" height="20" /></td>
                            <td width="33%" align="center" valign="middle" style=" vertical-align:middle;"><input name="image" type="image" onclick="if (confirm('Are you sure you want to delete this Employee?')) { window.location ='index.php?con=employees&del=<?php echo $row["empID"]; ?>'; }" src="images/remove.gif" title="remove" width="15" height="16" /></td>
                          </tr>
                      </table></td>
                    </tr>
                </table></td>
                <td valign="middle" style=" border-bottom:1px dashed #CCCCCC; padding:5px;" width="76%"><img src="../<? echo $row["empAvatar"]; ?>" width="30" align="absmiddle" style="margin-right:30px;"/><?php echo $row["empName"]; ?> </td>
              </tr>
              <?php
		  		} }
		   } ?>
            </table>
	  <br />
      <input name="add" type="button" id="add" value="Add new" onclick="window.location = 'index.php?con=empedt'" /></td>
  </tr>
</table>