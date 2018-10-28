<?php

$dbh = mysql_connect("classdb.it.mtu.edu:3307", "jpaquett", "squidward")
        or die ("Couldn't connect to database.");

$db  = mysql_select_db("tspdatabase", $dbh)
        or die ("Couldn't select database.");

$sql = "SELECT username FROM user";

$result = mysql_query($sql, $dbh)
        or die("SQL statement is wrong.");

while ($row = mysql_fetch_array($result)) {
    $username = $row['username'];
    //$password = $row['password'];
    //echo '<br> .$username. </br>'
    //echo '<br> .$password. </br>'
}

mysql_close($dbh);

echo"<h1>Calendar Sign In</h1>";                                                                                                       
echo'<form method = "post" action = "conlander.php ">';                                           
echo'Email: <input type = "username"  name = "username"><br/>';                                      
echo'Password: <input type = "password" name = "password"><br/>';                                    
echo'<input type = "submit" value = "Submit">';   
?>
