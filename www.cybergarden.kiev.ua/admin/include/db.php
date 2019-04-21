<?php

$connection = mysql_connect ("db21.freehost.com.ua", "cybergard_admin", "ekikman242");
$db= mysql_select_db("cybergard_default");
mysql_query ("SET NAMES 'utf-8' ");

if (!$connection || !$db)
{
  exit (mysql_error());
}

$result = mysql_query("SELECT * FROM news ORDER BY id DESC");


?>
