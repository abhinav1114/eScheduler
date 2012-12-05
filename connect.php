<?php

mysql_connect('pluto.cse.msstate.edu','dcspg31','ab1234') or die('Could not connect to DB');
mysql_select_db('dcspg31') or die('Could not connect to table');

$result = mysql_query("Show tables");
echo mysql_num_rows($result);
while($row = mysql_fetch_assoc($result)){
print_r($row);
echo '<br/>';
}
?>