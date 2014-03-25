<?php

class Controller_Test extends Controller_Myapp
{

	public function action_index()
	{
		$data["subnav"] = array('index'=> 'active' );
                $tmp = new MyWebpay\Webpay();
                $tmp->setup();
                $params = array(
                    'amount' => 400,
                    'number' => '4242-4242-4242-4242',
                    'exp_month' => 11,
                    'exp_year' => 2014,
                    'cvc' => 123,
                    'name' => 'KEI KUBO'
                    
                );
                $result = $tmp->charge($params);
                $user = $tmp->getCustomer('cus_3dxg6N6mafLo5O4');
                
                echo '<pre>';
                print_r($result);
                echo '</pre>';
                echo '<pre>';
                print_r($user);
                echo '</pre>';
               
		$this->template->title = 'Test &raquo; Index';
		$this->template->content = View::forge('test/index', $data);
	}

	public function action_view()
	{
		$data["subnav"] = array('view'=> 'active' );
		$this->template->title = 'Test &raquo; View';
		$this->template->content = View::forge('test/view', $data);
	}

}
