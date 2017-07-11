<?php
session_start();
include("dbconnection.php");
if(isset($_REQUEST['id']))
{
    deleteGame($_REQUEST['id']);
    header("location:maverick-games.php?delete");  
}  else {
   header("location:maverick-games.php");    
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

