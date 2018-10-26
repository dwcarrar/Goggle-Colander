<?php

$dbh = mysql_connect("classdb.it.mtu:3307", "jpaquett", "squidward")
        or die ("Couldn't connect to database.");

$db  = mysql_select_db("tspdatabase", $dbh)
        or die ("Couldn't select database.");

$sql = "SELECT username FROM User";

$result = mysql_query($sql, $dbh)
        or die("SQL statement is wrong.");

while ($row = mysql_fetch_array($result)) {
    $username = $row['username'];
    $password = $row['password'];
    echo '<br> .$username. </br>'
    echo '<br> .$password. </br>'
}

mysql_close($dbh);
?>
