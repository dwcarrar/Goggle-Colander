<?php

//try {
    //$config = parse_ini_file("db.ini");
    //$dbh = new PDO("classdb.it.mtu.edu:3307", "jpaquett", "squidward");
    //$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $dbh = mysql_connect("classdb.it.mtu.edu:3307", "jpaquett", "squidward")                             
            or die ("Couldn't connect to database.");                                                    
                                                                                                  
    $db  = mysql_select_db("tspdatabase", $dbh)                                                          
            or die ("Couldn't select database.");                                                        
    $actPass = str_rot13($_POST['password']);
    $sql = "insert into user( name, username, password) values (".$_POST['name'].", ".$_POST['username'].", '$actPass')";

    $result = mysql_query( $sql, $dbh)
               or die("SQL statement is wrong.");


    //$statement = $dbh->prepare( "insert into user( name, username, password) values :name, :username, :password");
    //$actPass = str_rot13($_POST['password']);
    //$result = $statement->execute(array(':name'=>$_POST['name'], ':username'=>$_POST['username'], ':name'=>$actPass));
    header("LOCATION:logIn.php");
    mysql_close($dbh);
//}
//catch (PDOException $e) {
//    print " Failed to register for Goggle Colander " .$e->getMessage()." <br/>";
//    die();
//}
?>
