<?php
session_start();
if (isset($_POST["username"])) {

$dbh = mysql_connect("classdb.it.mtu.edu:3307", "jpaquett", "squidward")
        or die ("Couldn't connect to database.");

$db  = mysql_select_db("tspdatabase", $dbh)
        or die ("Couldn't select database.");

$sql = "SELECT password , username FROM user where username = '".$_POST['username']."';";

$result = mysql_query($sql, $dbh)
        or die("SQL statement is wrong.");

$row = mysql_fetch_array($result);


if ( $_POST["username"] == ""  ) {

    echo 'Please enter a password';
    header("LOCATION:home.php");

}
else if ( ((str_rot13($row[0]) == $_POST['password']) && ($row[1]) == $_POST['username']) ) {
    echo 'reached if';        
    header("LOCATION:conlander.php");
        
}
else {
    echo 'Wrong username or password';
}
}
mysql_close($dbh);

?>
