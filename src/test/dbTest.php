<?php

class dbTest extends \PHPUnit_Framework_TestCase
{
  public function testTrueAssertsToTrue()
  {
    $this->assertTrue(true);
  }  

  public function testUniqueUsernames()
  {
    $dbh = mysql_connect("classdb.it.mtu.edu:3307", "jpaquett", "squidward")
        or die ("Couldn't connect to database.");
    $db  = mysql_select_db("tspdatabase", $dbh)
        or die ("Couldn't select database.");
    $sql1 = "SELECT * FROM user";
    $sql2 = "SELECT distinct username FROM user";
    
    $rows = mysql_num_rows(mysql_query($sql1,$dbh));
    $users =mysql_num_rows(mysql_query($sql2,$dbh));

    $this->assertEquals($users, $rows);
  }


}

