<?php
class signUp {
    
    //Verifies a valid username and matching passwords and creates new account
    function TrySignUp ($name, $uname, $pass1, $pass2) {                                                    
        $dbh = mysql_connect("classdb.it.mtu.edu:3307", "jpaquett", "squidward")                          
            or die ("Couldn't connect to database.");                                                 
        $db  = mysql_select_db("tspdatabase", $dbh)                                                       
            or die ("Couldn't select database.");

        $unique = $this->UniqueName($uname);
        if (!($unique)) {
            echo "This username is already in use.";             
            header("LOCATION:home.php");
        }
        else if ($pass1 != $pass2) {
            echo "The passwords entered do not match!";
            header("LOCATION:home.php");
        }
        else {
            $actPass = str_rot13($pass1);
            $sql = "insert into user(name, username, password) 
		       values ('$name', '$uname', '$actPass');";
    
            $result = mysql_query( $sql, $dbh)
                   or die("SQL statement is wrong.");

            echo mysql_error($dbh); 
            header("LOCATION:conlander.php");
        }
        mysql_close($dbh);
    }

    //verifies that the username is not already in the database
    function UniqueName ($uname) {
        $dbh = mysql_connect("classdb.it.mtu.edu:3307", "jpaquett", "squidward", true)                          
            or die ("Couldn't connect to database.");                                                 
        $db  = mysql_select_db("tspdatabase", $dbh)                                                       
            or die ("Couldn't select database.");

        $sql = "select username from user where username = '$uname'";
        $name_occurs = mysql_num_rows(mysql_query($sql, $dbh));
        mysql_close($dbh);

        if ($name_occurs == 0) {
            return true;
        }
        else {
            return false;
        }
    }

}
?>
