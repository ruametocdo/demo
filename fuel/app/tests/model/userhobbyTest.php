<?php
/**
 * @group userHobbyApp
 */
class Test_Model_UserHobby extends \Fuel\Core\TestCase{
    public $model;

    public function setup()
    {
        $this->model = Model_UserHobby::forge();
    }

    public function tearDown()
    {
        $this->model = null;
    }

    public function test_dat()
    {
      $result = $this->model->check_hobby_for_user(25,2);    
      var_dump($result);
       $this->assertTrue($result);
    }
     public function test_dat2()
    {
      $result = $this->model->get_items_for_user(90);    
      var_dump($result);
       $this->assertTrue($result);
    }
}
