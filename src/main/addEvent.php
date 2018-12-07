<?php
class Event {

    function AddEvent ( $uname, $name, $description,$date,  $start, $end ) { 
        $dbh = mysql_connect("classdb.it.mtu.edu:3307", "jpaquett", "squidward", true) 
                or die ("Couldn't connect to database.");                                  
        $db  = mysql_select_db("tspdatabase", $dbh)                                    
                or die ("Couldn't select database.");                                      
        
        $sql = "INSERT into events(username, name, description, date, startTime, endTime) values('$uname', '$name', '$description', '$date', '$start', '$end');";

        if (mysql_query($sql, $dbh)) {
	     echo 'event created';
	     return 1;
	} else {
	    echo "SQL statement is wrong.";
	    echo mysql_error($dbh);
	    return 0;
	}
        mysql_close($dbh);
    
    }


    function updateEvent ( $id, $name, $desc, $start, $end, $date ) {
 
        $dbh = mysql_connect("classdb.it.mtu.edu:3307", "jpaquett", "squidward", true) 
                or die ("Couldn't connect to database.");                                  
        $db  = mysql_select_db("tspdatabase", $dbh)                                    
                or die ("Couldn't select database.");                                      
        
        $sql = "UPDATE events SET name = '$name', description='$desc', startTime='$start', endTime='$end', date='$date' where event_id = '$id';";

        $result = mysql_query($sql, $dbh) 
		or die ("SQL statement is wrong.");
        echo mysql_error($dbh);

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

        $sql = "SELECT event_id, name, description, startTime, endTime, date FROM events WHERE username = '$uname' AND date = '$date' ORDER BY startTime";

        $result = mysql_query($sql, $dbh)
            or die ("SQL statement is wrong.");

	return $result;
        mysql_close($dbh);

    }

    function convertTime($time) {
	$time = substr($time,0,5);
	$hour = substr($time,0,2);
	if ($hour>12) {
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
