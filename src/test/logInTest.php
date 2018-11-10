<?php

include(__DIR__.'/../main/logIn.php');

class logInTest extends \PHPUnit_Framework_TestCase
{
  public function testNoUsername()
  {
    $logger = new logIn();
    $this->assertEquals(0,$logger->TryLogIn("",""));
  }

  public function testWrongUserorPassword() {
    $logger = new logIn();
    $this->assertEquals(2,$logger->TryLogIn("dwcarrar","notCorrect"));
  }
  
  public function testSuccessfulLogIn() {
    $logger = new logIn();
    $this->assertEquals(1,$logger->TryLogIn("dwcarrar","diePotato"));
  }

}

