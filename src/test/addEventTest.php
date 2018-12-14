<?php

include(__DIR__.'/../main/addEvent.php');

class addEventTest extends \PHPUnit_Framework_TestCase {

    public function testAddEventSuccess () {
	$event = new Event();

	$dbh = mysql_connect("classdb.it.mtu.edu:3307", "jpaquett", "squidward", true)
            or die ("Couldn't connect to database.");
        $db  = mysql_select_db("tspdatabase", $dbh)
            or die ("Couldn't select database.");

        $sql = "delete from events where username = 'test';";
        $delete = mysql_query($sql, $dbh);

        $this->assertEquals(1, $event->AddEvent("test","test","test","00:00:00","00:00:00","2000-01-01"));
    }

    public function testUpdateSuccess () {
        $event = new Event();

        $dbh = mysql_connect("classdb.it.mtu.edu:3307", "jpaquett", "squidward", true)
            or die ("Couldn't connect to database.");
        $db  = mysql_select_db("tspdatabase", $dbh)
            or die ("Couldn't select database.");

        $sql = "delete from events where username = 'test';";
        $delete = mysql_query($sql, $dbh);

        $event->AddEvent("test","test","test","00:00:00","00:00:00","2000-01-01");

        $sql = "select * from events where username = 'test';";
        $row = mysql_fetch_array(mysql_query($sql, $dbh));

	$event->updateEvent($row[0],$row[1],"updated",$row[3] ,$row[4] ,$row[5]);

        $sql = "select * from events where username = 'test';";
        $row = mysql_fetch_array(mysql_query($sql, $dbh));

        $this->assertEquals("updated", $row[2]);
    }

    public function testDeleteSuccess () {
        $event = new Event();

        $dbh = mysql_connect("classdb.it.mtu.edu:3307", "jpaquett", "squidward", true)
            or die ("Couldn't connect to database.");
        $db  = mysql_select_db("tspdatabase", $dbh)
            or die ("Couldn't select database.");

        $event->AddEvent("test","test","test","00:00:00","00:00:00","2000-01-01");

        $sql = "delete from events where username = 'test';";
        mysql_query($sql, $dbh);

        $sql = "select count(event_id) from events where username = 'test';";
        $row = mysql_fetch_array(mysql_query($sql, $dbh));

        $this->assertEquals(0, $row[0]);

    }
    

    public function testConvertTimePM () {
	$event = new Event();

	$time = '19:30:00';

	$this->assertEquals('7:30pm', $event->convertTime($time));
    }

}



















?>
