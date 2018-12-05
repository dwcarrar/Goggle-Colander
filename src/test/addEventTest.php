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

    



}



















?>
