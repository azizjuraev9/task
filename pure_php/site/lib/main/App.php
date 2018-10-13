<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 08.10.2018
 * Time: 15:40
 */

class App
{
    /**
     * @var DB $db
     */
    public static $db;
    /**
     * @var Params $params
     */
    public static $params;
    /**
     * @var User $user
     */
    public static $user;

    public static $view_params = [];

    public static $errors = [];

    public static $token;

    public static $defaultAction = 'index';

    // You must be logged in to use them
    protected static $userMethods = [
        '_post_getGift',
        '_post_result',
        '_viewGifts',
    ];

    /**
     * @param DB $db
     * @param Params $params
     * @param User $user
     */
    public static function run($db, $params, $user){
        self::$db = $db;
        self::$params = $params;
        self::$user = $user;
        self::setToken();
        self::handleRequest();
    }

    /**
     * @param array $data
     */
    public static function handleRequest(){
        $action = isset($_GET['action'])?$_GET['action']:static::$defaultAction;
        $action = str_replace('_','',$action);
        $method = '_'.$action;

        static::callMethod($method,$_GET);

        if(isset($_POST['action']) && self::checkToken($_POST)){
            $action = str_replace('_','',$_POST['action']);
            $postMethod = '_post_'.$action;
            static::callMethod($postMethod,$_POST);
        }

    }

    protected static function callMethod($method,$data){
        if(in_array($method,static::$userMethods) && !static::$user->username)
            return ;
        if(method_exists(new static,$method))
            static::$method($data);
    }

    // CSRF token generation
    public static function setToken(){
        if (!isset($_SESSION['token']) || $_SESSION['token_time'] < (time() - (20*60))) {
            self::$token = sha1(rand(0,99999));
            $_SESSION['token'] = self::$token;
            $_SESSION['token_time'] = time();
        }
        else
            self::$token = $_SESSION['token'];
    }

    // check CSRF token
    public static function checkToken($data){
        if(isset($data['token']) && $data['token'] == self::$token)
            return true;

        self::$errors[$data['action']] = ['Incorrect token'];
        return false;
    }

    private static function _index(){
        if(self::$user->username)
            self::$view_params['include'] = 'carousel';
        else
            self::$view_params['include'] = 'login';
    }

    private static function _viewGifts(){
        $user_id = self::$user->id;
        $sql = "SELECT  t.money, t.status, t.time, g.name, g.image FROM user_gift t LEFT JOIN gifts AS g ON t.gift_id = g.id WHERE t.user_id={$user_id}";
        $gifts = self::$db->query($sql);
        if(!$gifts){
            var_dump($sql,self::$db->error());die;
        }
        self::$view_params['include'] = 'viewGifts';
        self::$view_params['gifts'] = $gifts;
    }

    private static function _post_getGift(){
        die(json_encode(Gifts::giveGift()));
    }

    private static function _post_result($data){
        die(Gifts::saveResult($data));
    }

    private static function _post_login($data){
        $result = self::$user->login($data);
        if(is_array($result))
            self::$errors['login'] = $result;
        else
            header("Refresh:0");
    }

    private static function _post_register($data){
        $result = self::$user->register($data);
        if(is_array($result))
            self::$errors['register'] = $result;
        else
            header("Refresh:0");
    }

    private static function _logout(){
        self::$user->logout();
        header('Location: /');
    }
}