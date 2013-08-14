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

   $result2 = mysql_query("SELECT * FROM grape_variety", $connection);
   if (!$result2)
   {
      echo 'Could not run query: ' . mysql_error();
      exit;
   }
   $result3 = mysql_query("SELECT DISTINCT year FROM wine ORDER BY year ASC",
 $connection);
   if (!$result3)
   {
      echo 'Could not run query: ' . mysql_error();
      exit;
   }
   $result4 = mysql_query("SELECT DISTINCT year FROM wine ORDER BY year DESC",
 $connection);
   if (!$result3)
   {
      echo 'Could not run query: ' . mysql_error();
      exit;
   }
?>
<div>
<table>
<tr><td><strong>Winestore Database</strong></td></tr>
<form action="" method="">
<tr>
   <td>1. Wine Name: </td>
   <td> <input type="text" name="wineName"></td>
</tr>
<tr>
   <td>2. Winery Name:</td>
   <td> <input type="text" name="wineryName"></td>
<tr>
   <td>3. Region:</td>
   <td> <select value="regionTable">
<?php
   while($row1 = mysql_fetch_row($result))
   {
      $region = "$row1[0] ".$row1[1];
      echo '<option value="$row1[0]">'.$region.'</option>';
   }
?>
   </select></td>
</tr>

<tr>
   <td>4. Grape Variety: </td>
   <td> <select value="grapeTable">
<?php
   while($row2 = mysql_fetch_row($result2))
   {
      $grape_variety = "$row2[0] ".$row2[1];
      echo '<option value="$row2[0]">'.$grape_variety.'</option>';
   }
?>
   </td></select>
<tr>
   <td>5. Year from: <select value="minYear">
<?php
   while($row3 = mysql_fetch_row($result3))
   {
      $lowerYear = $row3[0];
      echo '<option value="lowerBound">'.$lowerYear.'</option>';
   }
?>
   </td>
   <td>to: <select value="maxYear">
<?php
   while($row4 = mysql_fetch_row($result4))
   {
      $upperYear = $row4[0];
      echo '<option value="upperBound">'.$upperYear.'</option>';
   }
?>
   </select></td>
</tr>
<tr>
   <td>6. Minimum number of wines in stock(per wine):</td>
   <td> <input type="text" name="minStock"></td>
<tr>
   <td>7. Minimum number of wines ordered(per wine):</td>
   <td> <input type="text" name="minOrdered"></td>
</tr>
<tr>
   <td><input type="submit" name="submit" value="search"></td>
</tr>
</form>
</table>
</div>
</body>
</html>
