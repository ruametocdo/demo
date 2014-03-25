<?php
namespace MyWebpay;
class Webpay
{

//    public $__defaultSettings = array();
//    public $settings = array();
//    public $Model;

    public static function _init()
    {
        \Fuel\Core\Config::load('webpay', true);
      
    }

    public function setup($config = array())
    {
//        $this->settings[$Model->alias] = array_merge($this->__defaultSettings, $config);
//        $this->Model = & $Model;

//        \Stripe::setApiKey($this->settings[$Model->alias]['appKey']);
//        \Stripe::$apiBase = $this->settings[$Model->alias]['endPoint'];
        $app = \Fuel\Core\Config::get('webpay');
        $appKey = $app['appKey'];
        $endPoint = $app['endPoint'];
        
        \Stripe::setApiKey($appKey);
        \Stripe::$apiBase = $endPoint;
    }

    public function charge($params)
    {
        if (!is_array($params))
            return false;
        if (isset($params['number'])) {
            $charge = array(
                'amount' => $params['amount'],
                'currency' => 'jpy',
                'card' => array(
                    'number' => $params['number'],
                    'exp_month' => $params['exp_month'],
                    'exp_year' => $params['exp_year'],
                    'cvc' => $params['cvc'],
                    'name' => $params['name']
                ),
                'description' => null,
                'capture' => false
            );
        }else{
             $charge = array(
            'amount' => $params['amount'],
            'currency' => 'jpy',
            'customer' => $params['customer_wid'],
            'description' => null,
            'capture' => false
        );
        }
       
        $result = \Stripe_Charge::create($charge);
        if (is_array($result)) {
            throw new Exception('not_charge');
            return false;
        }
        return json_decode($result, true);
    }

    protected function _findByChargeId($chargeId)
    {
        if (!is_string($chargeId))
            return false;
        return \Stripe_Charge::retrieve($chargeId);
    }

    public function retrieve($chargeId)
    {
        $charge = $this->_findByChargeId($chargeId);
        return ($charge) ? json_decode($charge, true) : false;
    }

    public function refund($chargeId)
    {
        $charge = $this->_findByChargeId($chargeId);
        if (!$charge)
            return false;
        return $charge->refund();
    }

    public function capture($chargeId)
    {
        $charge = $this->_findByChargeId($chargeId);
        if (!$charge)
            return false;
        return $charge->capture();
    }

    public function chargeList()
    {
        $result = \Stripe_Charge::all(array('count' => 100));
        return json_decode($result);
    }

    public function createCustomer($params)
    {
        $result = \Stripe_Customer::create($params);
        return json_decode($result);
    }

    public function getCustomer($costomerId)
    {
        $result = \Stripe_Customer::retrieve($costomerId);
        return json_decode($result);
    }

}
