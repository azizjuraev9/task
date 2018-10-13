<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 07.10.2018
 * Time: 18:01
 */

class Gifts
{

    public static function getAvailableGifts(){
        $gifts = [
            [
                'id' => 'units',
                'name' => "Units",
                'image' => "/assets/imgs/coins.png"
            ],
        ];
        if(App::$params->get('available_money') > 0)
            $gifts[] = [
                'id' => 'money',
                'name' => "Money",
                'image' => "/assets/imgs/money.png"
            ];
        return array_merge($gifts,Gift::getList());
    }

    public static function giveGift(){
        if(App::$user->units > App::$params->get("rotate_cost")){
            $units = App::$user->units - App::$params->get("rotate_cost");
            App::$user->units = $units;
            $id = App::$user->id;
            App::$db->query("UPDATE users SET units = {$units} WHERE id={$id}");
            $result = self::getType()->rotate();
            $result['units'] = App::$user->units;
            if($result['id'] == 'units'){
                $units += $result['value'];
                App::$db->query("UPDATE users SET units = {$units} WHERE id={$id}");
                App::$user->update();
                $result['units'] = App::$user->units;
                return $result;
            }
            $_SESSION['result_gift'] = $result;
            return $_SESSION['result_gift'];
        }
    }

    public static function saveResult($data){
        $result = $_SESSION['result_gift'];
        if(!isset($_SESSION['result_gift']))
            return;
        $user_id = App::$user->id;
        if($result['id'] == 'money')
            $res_money = App::$params->get('available_money') - $result['value'];
        if($data['giftAction'] == 'save' && is_numeric($result['id'])){
            App::$db->query("INSERT INTO user_gift(user_id,gift_id,status) VALUES({$user_id},{$result['id']},1)");
            App::$db->query("UPDATE gifts SET amount = (amount - 1) WHERE id = {$result['id']}");
        }
        if($data['giftAction'] == 'send' && $result['id'] == 'money'){
            $value = $result['value'];
            App::$db->query("INSERT INTO user_gift(user_id,money,status) VALUES({$user_id},{$value},2)");
            App::$db->query("UPDATE params SET value = {$res_money} WHERE `key`='available_money'");

            self::sendMoney($data);

        }
        if($data['giftAction'] == 'convert' && $result['id'] == 'money'){
            $umits = App::$user->units+(int)($result['value']*App::$params->get('conversion_ratio'));
            App::$db->query("UPDATE users SET units = {$umits} WHERE id={$user_id}");
            App::$db->query("UPDATE params SET value = {$res_money} WHERE `key`='available_money'");
            App::$user->update();
            return App::$user->units;
        }
        unset($_SESSION['result_gift']);
    }

    private static function sendMoney($data){
        // TODO: use some API to send money
    }

    private static function getType(){
        $gifts = [
            new Gift(),
            new Units(),
        ];
        if(App::$params->get('available_money') > 0)
            $gifts[] = new Money();

        return $gifts[rand(0, (count($gifts) - 1) )];
    }

}