<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 11.10.2018
 * Time: 20:50
 */

namespace frontend\components;


use common\models\Params;
use yii\base\Component;
use yii\helpers\ArrayHelper;

class Settings extends Component
{

    private $settings = [];

    public function init()
    {
        $this->settings = ArrayHelper::map(Params::find()->all(),'key','value');
        parent::init();
    }

    public function get($key){
        return @$this->settings[$key];
    }

}