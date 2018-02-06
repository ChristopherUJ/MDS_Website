<?php

function db_connect()
{
  global $g_mysql_con;
  global $g_db;
  global $g_dbinfo;
  $g_mysql_con = mysql_connect($g_dbinfo["host"], $g_dbinfo["username"], $g_dbinfo["password"]);
  if (!$g_mysql_con)
  {
    $g_mysql_con = NULL;
    return false;
  }
  $g_db = mysql_select_db($g_dbinfo["dbname"]);
  if (!$g_db)
  {
    $g_db = NULL;
  //  myql_close($g_mysql_con);
    $g_mysql_con = NULL;
    return false;
  }
  return true;
}

function db_disconnect()
{
  global $g_mysql_con;
  if ($g_mysql_con != NULL)
    mysql_close($g_mysql_con);
    $g_mysql_con = NULL;
}

?>