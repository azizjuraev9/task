<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 07.10.2018
 * Time: 23:54
 */

class Units extends BaseClass
{

    public function rotate()
    {
        if (App::$user->username) {
            $result = rand(App::$params->get("min_units"), App::$params->get("max_units"));
            return [
                'id' => 'units',
                'value' => $result,
            ];
        }
        return false;
    }
}