<?php

// used to load all our packages/dependencies
require_once("./vendor/autoload.php");

// used to import a class (NOTE: the ‘use’ keyword is not the same as ‘include’)
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase {
    
    // this function is used to initalize the object which we want to use in every test-function
    public function setUp(): void {
        // first we create an object of the class which contains the methods we want to test
        $this->user = new User();        
    }
    
    // this is a 'clean-up' method - which can be used to delete the objects (this is done after the test-functions has been executed)
    public function tearDown(): void {
        unset($this->user);
    }
    
    // get the sum of the numbers in an array
    public function test_sum() {       
        
        $this->assertEquals(
                
                // the expected value
                15,
                
                // the method which we want to test (NOTE: the 'user' object is created in the setUp() method)
                $this->user->get_sum([1, 2, 3, 4, 5]),
                
                // a message saying what this test-function is doing
                "When summing the total, it should equal 15"                
        );
        
    }  
}

?>