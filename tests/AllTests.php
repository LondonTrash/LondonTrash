<?php
require_once 'PHPUnit/Framework.php';
 
#require_once 'tests/PickupScheduleTest.php';
 
class AllTests
{
    public static function suite()
    {
        $suite = new PHPUnit_Framework_TestSuite('PHPUnit');
 
        #$suite->addTestSuite('PickupScheduleTest');
 
        return $suite;
    }
}
?>