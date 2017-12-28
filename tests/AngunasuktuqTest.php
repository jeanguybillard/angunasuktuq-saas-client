<?php

/**
*  Corresponding Class to test YourClass class
*
*  @author jean-guy billard
*/
class AngunasuktuqTest extends PHPUnit_Framework_TestCase{
	
  /**
  * Just check if the YourClass has no syntax error 
  *
  * This is just a simple check to make sure your library has no syntax error. This helps you troubleshoot
  * any typo before you even use this library in a real project.
  *
  */
  public function testIsThereAnySyntaxError(){
	$var = new JeanGuyBillard\Angunasuktuq;
	$this->assertTrue(is_object($var));
	unset($var);
  }
  
  /**
  * Just check if the YourClass has no syntax error 
  *
  * This is just a simple check to make sure your library has no syntax error. This helps you troubleshoot
  * any typo before you even use this library in a real project.
  *
  */
  public function testLoad(){
	$var = new JeanGuyBillard\Angunasuktuq;
	$this->assertTrue($var->load("hey") == 'Hello World');
	unset($var);
  }
  
}