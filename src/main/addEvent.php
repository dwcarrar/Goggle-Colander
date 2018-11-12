<?php
class Event {

    function AddEvent ( $eventID, $name, $description, $start, $end ) {
    
        $dbh = mysql_connect("classdb.it.mtu.edu:3307", "jpaquett", "squidward", true) 
                or die ("Couldn't connect to database.");                                  
        $db  = mysql_select_db("tspdatabase", $dbh)                                    
                or die ("Couldn't select database.");                                      
        
        
    
    }
}
?>
