<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 11.10.2018
 * Time: 20:47
 */

namespace frontend\helpers;

use common\models\Gifts;
use common\models\Params;
use common\models\UserGifts;
use Yii;


class GiftHelper
{

    public static function getAvailableItems()
    {
        $gifts = [
            (object)[
                'id' => 'units',
                'name' => "Units",
                'image' => "/imgs/coins.png"
            ],
        ];
        if (Yii::$app->settings->get('available_money') > 0)
            $gifts[] = (object)[
                'id' => 'money',
                'name' => "Money",
                'image' => "/imgs/money.png"
            ];
        return array_merge($gifts, self::getList());
    }

    public static function chooseOne()
    {
        if (Yii::$app->user->identity->units > Yii::$app->settings->get('rotate_cost')) {
            Yii::$app->user->identity->units = Yii::$app->user->identity->units - Yii::$app->settings->get('rotate_cost');
            Yii::$app->user->identity->save();
            $r = ['money', 'units', 'gift'];
            $r = $r[rand(0, 2)];
            if ($r == 'money') {
                if (Yii::$app->settings->get("max_money") < Yii::$app->settings->get('available_money'))
                    $result = rand(Yii::$app->settings->get("min_money"), Yii::$app->settings->get("max_money"));
                else
                    $result = rand(Yii::$app->settings->get("min_money"), Yii::$app->settings->get('available_money'));
                $r = [
                    'id' => 'money',
                    'value' => $result,
                ];
            } elseif ($r == 'units') {
                $result = rand(Yii::$app->settings->get("min_units"), Yii::$app->settings->get("max_units"));
                Yii::$app->user->identity->units += $result;
                Yii::$app->user->identity->save();
                $r = [
                    'id' => 'units',
                    'value' => $result,
                ];
            } else {
                $r = Gifts::find()->orderBy('RAND()')->asArray(true)->one();
            }
            $r['units'] = Yii::$app->user->identity->units;
            $ss = Yii::$app->session;
            $ss->open();
            $ss['result_gift'] = $r;
            return $r;
        }
    }

    public static function saveResult($action){
        $ss = Yii::$app->session;
        $ss->open();
        if(!isset($ss['result_gift']))
            return;

        $result = $ss['result_gift'];

        if($action == 'save' && is_numeric($result['id'])){
            $gift = Gifts::findOne($result['id']);
            $gift->amount--;
            $gift->save();
            $ug = new UserGifts();
            $ug->user_id = Yii::$app->user->id;
            $ug->gift_id = $result['id'];
            $ug->status = 1;
            $ug->save();
        }
        if($action == 'send' && $result['id'] == 'money'){
            $ug = new UserGifts();
            $ug->user_id = Yii::$app->user->id;
            $ug->money = $result['value'];
            $ug->status = 1;
            if(!$ug->save()){
                var_dump($ug->errors);die();
            }

            $params = Params::findOne(['key'=>'available_money']);
            $params->value = (string)($params->value - $result['value']);
            if(!$params->save()){
                var_dump($params->errors);die();
            }
        }
        if($action == 'convert' && $result['id'] == 'money'){
            return self::convertMoney($result['value']);
        }
        unset($ss['result_gift']);
    }

    public static function convertMoney($val){
        Yii::$app->user->identity->units += (int)($val*Yii::$app->settings->get('conversion_ratio'));
        Yii::$app->user->identity->save();
        $params = Params::findOne(['key'=>'available_money']);
        $params->value -= $val;
        $params->save();
        return Yii::$app->user->identity->units;
    }

    private static function getList()
    {
        return Gifts::find()->where(['status' => 1])->andWhere(['>', 'amount', 0])->all();
    }


}