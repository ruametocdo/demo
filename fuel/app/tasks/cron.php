<?php

/**
 * Fuel is a fast, lightweight, community driven PHP5 framework.
 *
 * @package    Fuel
 * @version    1.7
 * @author     Fuel Development Team
 * @license    MIT License
 * @copyright  2010 - 2013 Fuel Development Team
 * @link       http://fuelphp.com
 */

namespace Fuel\Tasks;

/**
 * Robot example task
 *
 * Ruthlessly stolen from the beareded Canadian sexy symbol:
 *
 * 		Derek Allard: http://derekallard.com/
 *
 * @package		Fuel
 * @version		1.0
 * @author		Phil Sturgeon
 */
class Cron
{

    /**
     * This method gets ran when a valid method name is not used in the command.
     *
     * Usage (from command line):
     *
     * php oil r robots
     *
     * or
     *
     * php oil r robots "Kill all Mice"
     *
     * @return string
     */
    public static function run()
    {
        $getUsers = \Model_User::find(array(
                    "select" => array('id', 'email', 'username'),
                    'where' => array(
                        'cronmail' => 1
                    ),
        ));
        $email = \Email\Email::forge(array('driver' => 'smtp'));
        foreach ($getUsers as $item) {
            $from = 'datht83@gmail.com';
            $to = $item->email;
            $subject = 'Hi ' . $item->username;
            $body = "hello i m fuel";
            $namefrom = 'dat huynh';
            $nameto = $item->username;
            $email->from($from, $namefrom);
            $email->to($to, $nameto);
            $email->subject($subject);
            $email->body($body);
            $email->send();  
        }
    }

}

/* End of file tasks/robots.php */
