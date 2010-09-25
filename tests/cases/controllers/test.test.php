<?php

class TestCakeTestCase extends CakeTestCase {
    public function testHello() {
        $var = "Hello";
        $this->assertEqual("Hello", $var);
    }
}