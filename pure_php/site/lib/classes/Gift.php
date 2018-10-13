<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 07.10.2018
 * Time: 18:39
 */

class Gift extends BaseClass
{

    public function rotate()
    {
        $items = self::getList();
        if (count($items) > 0) {
            $result = $items[rand(0, (count($items) - 1))];
            return $result;
        }
        return false;
    }

    public static function getList()
    {
        $items = [];
        $res = App::$db->query("SELECT * FROM gifts WHERE status = 1 AND amount > 0");
        while ($item = $res->fetch_assoc()) {
            $items[] = $item;
        }
        return $items;
    }
}