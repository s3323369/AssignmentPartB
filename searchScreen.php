<html>
<head>
<title>Search Wine Database</title>
</head>
<body>
<?php
   require_once('db.php');
   if(!($connection = mysql_connect(DB_HOST, DB_USER, DB_PW)))
   {
      echo 'Could not connect to mysql on '. DB_HOST."\n";
      exit;
   }
   if(!(mysql_select_db("winestore", $connection)))
   {
      echo 'Could not connect to database winestore\n';
      exit;
   }
   $result = mysql_query("SELECT * FROM region", $connection);
   if (!$result)
   {
      echo 'Could not run query: ' . mysql_error();
      exit;
   }
?>
<form action="" method="">
1. Wine Name:  <input type="text" name="wineName"><br>
2. Winery Name: <input type="text" name="wineryName"><br>
3. Region: <select value="tableName">
<?php
   while($row = mysql_fetch_row($result)) 
   {
      $region = "$row[0] ".$row[1];
      echo '<option value="$row[0]">'.$region.'</option>';
   }
?>
</select><br>
4. <br>
5. <br>
6. Minimum number of wines in stock(per wine): <input type="text" name="minStock"><br>
7. Minimum number of wines ordered(per wine): <input type="text" name="minOrdered"><br>
<input type="submit" name="submit" value="search"><br>
</form>

</body>
</html>
