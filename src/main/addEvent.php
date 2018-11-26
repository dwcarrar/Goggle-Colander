<?php
class Event {

    function AddEvent ( $name, $description, $start, $end ) {
    
        $dbh = mysql_connect("classdb.it.mtu.edu:3307", "jpaquett", "squidward", true) 
                or die ("Couldn't connect to database.");                                  
        $db  = mysql_select_db("tspdatabase", $dbh)                                    
                or die ("Couldn't select database.");                                      
        
        $sql = "INSERT into event(name, description, startTime, endTime) values('$name', '$description', '$start', '$end');";

        $result = mysql_query($sql, $dbh)
            or die ("SQL statement is wrong.");

        mysql_close($dbh);
    
    }
}
?>
