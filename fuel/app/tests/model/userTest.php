<?php

/**
 * @group App
 */
class Test_Model_User extends Fuel\Core\TestCase
{

    public $model;

    public function setup()
    {
        $this->model = Model_User::forge();
    }

    public function tearDown()
    {
        $this->model = null;
    }

    public function test_dat()
    {
        
        $this->assertFalse(false);
    }
   
}
