<?php
/*****************************
*数据库连接
*****************************/

   // connect to mongodb
   $m = new Mongo();
   //echo "Connection to database successfully";
   // select a database
   $db = $m->mydb;
  // echo "Database mydb selected";
   $user = $db->user;
   //echo "Collection user created succsessfully";
?>
