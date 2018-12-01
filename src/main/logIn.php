<?php

class logIn {


  function TryLogIn($uname, $pass) {
    $exitpoint = 0;

    $dbh = mysql_connect("classdb.it.mtu.edu:3307", "jpaquett", "squidward")
            or die ("Couldn't connect to database.");

    $db  = mysql_select_db("tspdatabase", $dbh)
            or die ("Couldn't select database.");
 
    $sql = "SELECT password , username FROM user where username = '$uname';";

    $result = mysql_query($sql, $dbh)
            or die("SQL statement is wrong.");

    $row = mysql_fetch_array($result);


    if ( $uname == "" ) {
        echo 'Please enter a username';
    }
    else if ( ((str_rot13($row[0]) == $pass) && ($row[1]) == $uname) ) {
        echo 'reached if';
        $exitpoint = 1;
    }
    else {
        echo 'Wrong username or password';
        $exitpoint = 2;  
    }
    mysql_close($dbh);
    return $exitpoint;
  }
}
?>
