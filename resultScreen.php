<html>
<head>
<title>Winestore search results</title>
</head>
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
   $wineName = $_GET['wineName'];
   if($wineName != "")
   {
	$query = "SELECT wine_name, variety, year, winery_name
                  FROM wine, winery, grape_variety, wine_variety
                  WHERE wine.winery_id = winery.winery_id
                  AND wine.wine_id = wine_variety.wine_id
                  AND wine_variety.variety_id = grape_variety.variety_id
		  AND wine_name='{$wineName}'";
   }
   else
   {
   	$query = "SELECT wine_name, variety, year, winery_name
	          FROM wine, winery, grape_variety, wine_variety
	          WHERE wine.winery_id = winery.winery_id
	          AND wine.wine_id = wine_variety.wine_id
	          AND wine_variety.variety_id = grape_variety.variety_id";
   }
   $result = mysql_query("$query", $connection);
   if(!$result)
   {
      echo 'Could not run query: ' . mysql_error();
      exit;
   }   
?>
<body>
<table>
<tr>
<td>Name </td>
<td>Grape Variety </td>
<td>Year </td>
<td>Winery </td>
<td>Region </td>
<td>Cost of the wine in the inventory </td>
<td>Total number of bottles available at any price </td>
<td>Total stock sold of the wine </td>
<td>Total sales revenue for the wine </td>
</tr>
<?php
while($row = @mysql_fetch_array($result))
{
   echo "\n<tr>\n<td>{$row["wine_name"]}</td>"
   ."\n<td>{$row["variety"]}</td>"
   ."\n<td>{$row["year"]}</td>"
   ."\n<td>{$row["winery_name"]}</td>\n</tr>";
}
?>
</table>
</body>
</html>
