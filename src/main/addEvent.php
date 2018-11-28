<?php
class Event {

    function AddEvent ( $name, $description,$date,  $start, $end ) {
        echo $name."</br>"; 
        echo $description."</br>"; 
        echo $date."</br>"; 
        echo $start."</br>"; 
        echo $end."</br>"; 
        $dbh = mysql_connect("classdb.it.mtu.edu:3307", "jpaquett", "squidward", true) 
                or die ("Couldn't connect to database.");                                  
        $db  = mysql_select_db("tspdatabase", $dbh)                                    
                or die ("Couldn't select database.");                                      
        
        $sql = "INSERT into event(name, description, date, startTime, endTime) values('$name', '$description', '$date', '$start', '$end');";

        $result = mysql_query($sql, $dbh)
            or die ("SQL statement is wrong.");

        mysql_close($dbh);
    
    }


    function updateName ( $name, $id ) {
    
        $dbh = mysql_connect("classdb.it.mtu.edu:3307", "jpaquett", "squidward", true) 
                or die ("Couldn't connect to database.");                                  
        $db  = mysql_select_db("tspdatabase", $dbh)                                    
                or die ("Couldn't select database.");                                      
        
        $sql = "UPDATE event SET name = '$name' where eventID = '$id';";

        $result = mysql_query($sql, $dbh)
            or die ("SQL statement is wrong.");

        mysql_close($dbh);
    
    }


    function updateDescription ( $description, $id ) {
    
        $dbh = mysql_connect("classdb.it.mtu.edu:3307", "jpaquett", "squidward", true) 
                or die ("Couldn't connect to database.");                                  
        $db  = mysql_select_db("tspdatabase", $dbh)                                    
                or die ("Couldn't select database.");                                      
        
        $sql = "UPDATE event SET description = '$description' where eventID = '$id';";

        $result = mysql_query($sql, $dbh)
            or die ("SQL statement is wrong.");

        mysql_close($dbh);
    
    }


    function updateDate ( $date, $id ) {
    
        $dbh = mysql_connect("classdb.it.mtu.edu:3307", "jpaquett", "squidward", true) 
                or die ("Couldn't connect to database.");                                  
        $db  = mysql_select_db("tspdatabase", $dbh)                                    
                or die ("Couldn't select database.");                                      
        
        $sql = "UPDATE event SET date = '$date' where eventID = '$id';";

        $result = mysql_query($sql, $dbh)
            or die ("SQL statement is wrong.");

        mysql_close($dbh);
    
    }


    function updateStart ( $start, $id ) {
    
        $dbh = mysql_connect("classdb.it.mtu.edu:3307", "jpaquett", "squidward", true) 
                or die ("Couldn't connect to database.");                                  
        $db  = mysql_select_db("tspdatabase", $dbh)                                    
                or die ("Couldn't select database.");                                      
        
        $sql = "UPDATE event SET startTime = '$start' where eventID = '$id';";

        $result = mysql_query($sql, $dbh)
            or die ("SQL statement is wrong.");

        mysql_close($dbh);
    
    }


    function updateEnd ( $end, $id ) {
    
        $dbh = mysql_connect("classdb.it.mtu.edu:3307", "jpaquett", "squidward", true) 
                or die ("Couldn't connect to database.");                                  
        $db  = mysql_select_db("tspdatabase", $dbh)                                    
                or die ("Couldn't select database.");                                      
        
        $sql = "UPDATE event SET endTime = '$end' where eventID = '$id';";

        $result = mysql_query($sql, $dbh)
            or die ("SQL statement is wrong.");

        mysql_close($dbh);
    
    }

    function deleteEvent ( $name, $description, $date, $start, $end ) {
    
        $dbh = mysql_connect("classdb.it.mtu.edu:3307", "jpaquett", "squidward", true) 
                or die ("Couldn't connect to database.");                                  
        $db  = mysql_select_db("tspdatabase", $dbh)                                    
                or die ("Couldn't select database.");                                      
        
        $sql = "DELETE FROM event where name = '$name' AND description = '$description' AND date = '$date' AND startTime = '$start' AND endTime = '$end';";

        $result = mysql_query($sql, $dbh)
            or die ("SQL statement is wrong.");

        mysql_close($dbh);
    
    }
}
?>
