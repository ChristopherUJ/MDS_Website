 <table class="blog" cellpadding="0" cellspacing="0">
                        <tr>
                          <td valign="top"><div>
                              <table class="contentpaneopen">
                                <tr>
                                  <td class="contentheading" width="100%">Contact Details</td>
                                </tr>
                              </table>
                              <table class="contentpaneopen">
                                <tr>
                                  <td valign="top" colspan="2" class="article_indent">
                                    <p>
                                    </p>
                                    <table align="center" cellpadding="3" cellspacing="0">
                                      <tr>
                                        <td colspan="3" valign="bottom"><strong>Marine Data Solutions (Pty) Ltd.</strong></td>
                                      </tr>
                                      <tr>
                                        <td colspan="2"><div align="left">
                                            <p>Cnr. Borcherds Quarry &amp; Michigan Str.<br>
                                              Unit 7, Airport Business Park<br>
                                              Airport Industria<br>
                                              Cape Town, South Africa</p>
                                        </div></td>
                                        <td><p>PO Box 51680<br>
                                          Waterfront 8002</p>
                                            <p>Cape Town, South Africa</p></td>
                                      </tr>
                                      <tr>
                                        <td colspan="2"></td>
                                        <td></td>
                                      </tr>
                                      <tr>
                                        <td valign="top">Tel <br>
                                          Fax<br>
                                          Support </td>
                                        <td valign="top" width="243">+27 21 386 8517<br>
                                          +27 21 386 8519<br>
                                          +27 (0)83 448 7004</td>
                                        <td valign="top"> General Enquiries: <a href="mailto:business@marinedata.co.za">business@marinedata.co.za</a><br>
                                            <br>
                                          Support: <u> <a href="mailto:support@marinedata.co.za">support@marinedata.co.za</a></u></td>
                                      </tr>
                                    </table>
                                     <p>&nbsp;</p>
									<hr size="0" style="border-top:1px dashed #999999">
									<p>&nbsp;</p>
                                    <h2 style="font-size:18px; color:#003366; font-family:'Trebuchet MS';">Submit a Query                                    </h2>
									<p>&nbsp;</p>									         
									<form action="index.php?con=scont" method="post" name="theform" target="_self" id="theform">
                                      <table class="qwe" width="100%" border="0" bordercolor="#333333" bgcolor="#FFFFFF">
                                        <tr>
                                          <td width="20%" height="20%" valign="top"  style="padding:5px;">Name:</td>
                                          <td width="80%"  style="padding:5px;"><input name="naam" type="text" value="<?php if (isset($_GET["tt"])) echo $tourtype." tour: ".$them[$_GET["tt"] - 1]; ?>" id="naam" size="45" /></td>
                                        </tr>
                                        <tr>
                                          <td width="20%" valign="top"  style="padding:5px;"><div align="left">Email:</div></td>
                                          <td width="80%"  style="padding:5px;" ><input name="email" type="text" id="email" size="35" maxlength="256" /></td>
                                        </tr>

                                        <tr>
                                          <td width="20%" height="106" valign="top"  style="padding:5px;"><div align="left">Query  :</div></td>
                                          <td width="80%" style="padding:5px;"><textarea name="vraag" cols="42" rows="5" id="vraag"></textarea></td>
                                        </tr>
                                      </table>
									  <br />
                                      <input type="submit" name="Submit" value="Send Query" onclick="javascript:document.theform.submit();" />
                                    </form><p>&nbsp;</p><hr size="0" style="border-top:1px dashed #999999"> 
									<p>&nbsp;</p>
									                         
                                    <h2 style="font-size:18px; color:#003366; font-family:'Trebuchet MS';">Management Staff                                    </h2>
									<p>&nbsp;</p>
                                    <table align="center" cellspacing="0">
									<tr>
									<!-- Start Employee -->
<? global $g_db;
								if (!$g_db)
									db_connect();
								if (!$g_db)
									echo "No database connection available!";
								else {
									$res = select_query(array("tblemps"),array("*"),"1=1 order by empID ASC");
									if ($res == false)
										echo "Database Error";
									else if ($res == -1)
										echo "<td>".mess("No Employees available")."</td>";
									else
									{
										$ccce = @mysql_num_rows($res);
										if ($ccce % 2 != 0 || $ccce == 1)
											$xr = true;
										$i = 0;
										while($row = mysql_fetch_assoc($res))
										{
										$i++;
										?>
                                      
                                        <td style="padding-top:5px; padding-bottom:5px;"><img src="<? echo $row["empAvatar"];?>" title="<? echo $row["empName"];?>" border="0" ></td>
                                        <td><strong><? echo $row["empName"];?><br>
                                          </strong><? echo $row["empPosition"];?>
                                          <p><? echo $row["empTel"];?></p>
                                          <p> <a href="mailto:<? echo $row["empEmail"];?>"><? echo $row["empEmail"];?></a></p></td>
                                        <td></td>
                                    
										<?
										if ($i == 2)
										{
											$i = 0;
											echo "</tr><tr>";
										}
										}
									}
								}
			 ?></tr>
									<!-- End Employee -->
                                    </table>
								  </td>
                                </tr>
                              </table>
                              <span class="article_separator">&nbsp;</span> </div></td>
                        </tr>
                        
                      </table>