<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 07.10.2018
 * Time: 18:39
 */

class Money extends BaseClass
{

    public function rotate()
    {

        if (App::$params->get("max_money") < App::$params->get('available_money'))
            $result = rand(App::$params->get("min_money"), App::$params->get("max_money"));
        else
            $result = rand(App::$params->get("min_money"), App::$params->get('available_money'));

        return [
            'id' => 'money',
            'value' => $result,
        ];

        return false;
    }

}