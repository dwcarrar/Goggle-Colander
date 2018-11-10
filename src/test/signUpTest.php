<?php

include(__DIR__.'/../main/signUp.php');

class signUpTest extends \PHPUnit_Framework_TestCase
{
  public function testUniquePasses(){
    $signer = new signUp();
    $this->assertTrue($signer->UniqueName("qwertyasdfzxcv"));
  }

  public function testUniquefails(){
    $signer = new signUp();
    $this->assertFalse($signer->UniqueName("dwcarrar"));
  }

  public function testUserNotUnique() {
    $signer = new signUp();
    $this->assertEquals(0, $signer->TrySignUp("test","dwcarrar","password","password"));
  }

  public function testPasswordsNotMatching() {
    $signer = new signUp();
    $this->assertEquals(1, $signer->TrySignUp("test","test","not","matching"));
  }

  public function testUserCreated() {
    $signer = new signUp();

    $dbh = mysql_connect("classdb.it.mtu.edu:3307", "jpaquett", "squidward", true)              
        or die ("Couldn't connect to database.");                                               
    $db  = mysql_select_db("tspdatabase", $dbh)                                                 
        or die ("Couldn't select database.");

    $signer->TrySignUp("test","test","password","password");

    $sql = "select username from user where username = '$uname'";
    $name_occurs = mysql_num_rows(mysql_query($sql, $dbh));

    $this->assertEquals(1,$name_occurs);

    $sql = "delete from user where username = test";

    mysql_close($dbh);
  }


}

