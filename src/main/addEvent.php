<?php
class Event {

    function AddEvent ( $uname, $name, $description,$date,  $start, $end ) { 
        $dbh = mysql_connect("classdb.it.mtu.edu:3307", "jpaquett", "squidward", true) 
                or die ("Couldn't connect to database.");                                  
        $db  = mysql_select_db("tspdatabase", $dbh)                                    
                or die ("Couldn't select database.");                                      
        
        $sql = "INSERT into events(username, name, description, date, startTime, endTime) values('$uname', '$name', '$description', '$date', '$start', '$end');";

        $result = mysql_query($sql, $dbh)
		or die ("SQL statement is wrong.");
	echo mysql_error($dbh);
        mysql_close($dbh);
    
    }


    function updateName ( $name, $id ) {
 
        $dbh = mysql_connect("classdb.it.mtu.edu:3307", "jpaquett", "squidward", true) 
                or die ("Couldn't connect to database.");                                  
        $db  = mysql_select_db("tspdatabase", $dbh)                                    
                or die ("Couldn't select database.");                                      
        
        $sql = "UPDATE events SET name = '$name' where eventID = '$id';";

        $result = mysql_query($sql, $dbh) 
		or die ("SQL statement is wrong.");

        mysql_close($dbh);
    }


    function updateDescription ( $description, $id ) {
    
        $dbh = mysql_connect("classdb.it.mtu.edu:3307", "jpaquett", "squidward", true) 
                or die ("Couldn't connect to database.");                                  
        $db  = mysql_select_db("tspdatabase", $dbh)                                    
                or die ("Couldn't select database.");                                      
        
        $sql = "UPDATE events SET description = '$description' where eventID = '$id';";

        $result = mysql_query($sql, $dbh)
            or die ("SQL statement is wrong.");

        mysql_close($dbh);
    
    }


    function updateDate ( $date, $id ) {
    
        $dbh = mysql_connect("classdb.it.mtu.edu:3307", "jpaquett", "squidward", true) 
                or die ("Couldn't connect to database.");                                  
        $db  = mysql_select_db("tspdatabase", $dbh)                                    
                or die ("Couldn't select database.");                                      
        
        $sql = "UPDATE events SET date = '$date' where eventID = '$id';";

        $result = mysql_query($sql, $dbh)
            or die ("SQL statement is wrong.");

        mysql_close($dbh);
    
    }


    function updateStart ( $start, $id ) {
    
        $dbh = mysql_connect("classdb.it.mtu.edu:3307", "jpaquett", "squidward", true) 
                or die ("Couldn't connect to database.");                                  
        $db  = mysql_select_db("tspdatabase", $dbh)                                    
                or die ("Couldn't select database.");                                      
        
        $sql = "UPDATE events SET startTime = '$start' where eventID = '$id';";

        $result = mysql_query($sql, $dbh)
            or die ("SQL statement is wrong.");

        mysql_close($dbh);
    
    }


    function updateEnd ( $end, $id ) {
    
        $dbh = mysql_connect("classdb.it.mtu.edu:3307", "jpaquett", "squidward", true) 
                or die ("Couldn't connect to database.");                                  
        $db  = mysql_select_db("tspdatabase", $dbh)                                    
                or die ("Couldn't select database.");                                      
        
        $sql = "UPDATE events SET endTime = '$end' where eventID = '$id';";

        $result = mysql_query($sql, $dbh)
            or die ("SQL statement is wrong.");

        mysql_close($dbh);
    
    }

    function deleteEvent ( $id ) {
    
        $dbh = mysql_connect("classdb.it.mtu.edu:3307", "jpaquett", "squidward", true) 
                or die ("Couldn't connect to database.");                                  
        $db  = mysql_select_db("tspdatabase", $dbh)                                    
                or die ("Couldn't select database.");                                      
        
        $sql = "DELETE FROM events where event_id = '$id';";

        $result = mysql_query($sql, $dbh)
            or die ("SQL statement is wrong.");

        mysql_close($dbh);
    
    }

    function getDayEvents ( $uname, $date) {

        $dbh = mysql_connect("classdb.it.mtu.edu:3307", "jpaquett", "squidward", true)
                or die ("Couldn't connect to database.");
        $db  = mysql_select_db("tspdatabase", $dbh)
                or die ("Couldn't select database.");

        $sql = "SELECT event_id, name, description, startTime, endTime FROM events WHERE username = '$uname' AND date = '$date' ORDER BY startTime";

        $result = mysql_query($sql, $dbh)
            or die ("SQL statement is wrong.");

	return $result;
        mysql_close($dbh);

    }

    function convertTime($time) {
	$time = substr($time,0,5);
	if ($hour = (int)substr($time,0,2)>12) {
	    $time = ($hour-12).substr($time,2,5)."pm";
	} elseif ($hour == '00') {
	    $time = ($hour+12).substr($time,2,5)."am";
	} elseif ($hour == '12') {
	    $time = $time."pm";
	} else {
	    $time = $time."am";
	}
	
	if (substr($time,0,1) == '-') {
	    $time = substr($time,1);
	}
	if (substr($time,0,1) == '0') {
	    $time = substr($time,1);
	}	
	return $time;
    }

}
?>
