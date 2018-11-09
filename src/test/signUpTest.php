<?php
include "../main/signUp.php";
class signUpTest extends \PHPUnit_Framework_TestCase
{
  public function testUniquePasses()
  {
    $signer = new signUp();
    $this->assertTrue($signer->UniqueName("qwertyasdfzxcv"));
  }

  public function testUniquefails()
  {
    $signer = new signUp();
    $this->assertFalse($signer->UniqueName("dwcarrar"));
  }

}

