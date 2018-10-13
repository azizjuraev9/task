<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 07.10.2018
 * Time: 23:33
 * @var DB $db
 */

class Params
{
    private $params;

    /**
     * Params constructor.
     * @param DB $db
     */
    public function __construct($db)
    {
        if(($res = $db->query("SELECT * FROM params")) != false)
            while ($item = $res->fetch_assoc())
                $this->params[$item["key"]] = $item["value"];
    }

    public function get($key){
        return @$this->params[$key];
    }
}