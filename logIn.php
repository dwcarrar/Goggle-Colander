<?php

$dbh = mysql_connect("classdb.it.mtu.edu:3307", "jpaquett", "squidward")
        or die ("Couldn't connect to database.");

$db  = mysql_select_db("tspdatabase", $dbh)
        or die ("Couldn't select database.");

$sql = "SELECT password , username FROM user where username = '".$_POST['username']."';";

$result = mysql_query($sql, $dbh)
        or die("SQL statement is wrong.");

//echo mysql_error($result);
$row = mysql_fetch_array($result);
//echo 'password'".$row['password']."'';
//echo ' username'".$row['username']."'';

if ( str_rot13($row[0] == $_POST['password']) && ($row[1] == $_POST['username']) ) {
    echo 'reached if';        
    header("LOCATION:conlander.php");
        
}
else {
    echo 'Wrong username or password';
}

mysql_close($dbh);

//echo"<h1>Calendar Sign In</h1>";                                                                                                       
//echo'<form method = "post" action = "conlander.php ">';                                           
//echo'Email: <input type = "username"  name = "username"><br/>';                                      
//echo'Password: <input type = "password" name = "password"><br/>';                                    
//echo'<input type = "submit" value = "Submit">';   
?>
