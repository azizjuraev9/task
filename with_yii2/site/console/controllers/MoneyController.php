<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 12.10.2018
 * Time: 5:36
 */

namespace console\controllers;


use common\models\UserGifts;
use yii\console\Controller;

class MoneyController extends Controller
{



    private $amount = 5;

    public function actionSend(){
        $money = UserGifts::find()->where(['>','money',0])->andWhere(['status'=>1])->limit($this->amount)->all();
        foreach ($money as $item){
            $this->sendMoney($item);
        }
    }

    /**
     * @param UserGifts $item
     */
    private function sendMoney($item){

        // TODO: add some action here

        $item->status = 2;
        $item->save();
        echo $item->money."\tHas been sent to user: ".$item->user->username."\n";
    }

}