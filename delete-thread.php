<?php
if(isset($_REQUEST['id']))
{
  include("dbconnection.php");
  $thread_id=  mysql_real_escape_string($_REQUEST['id']);
  deletethread($thread_id);
  header("location:maverick-game-dicussion-forum");
}