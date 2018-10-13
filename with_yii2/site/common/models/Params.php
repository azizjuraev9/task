<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "params".
 *
 * @property int $id
 * @property string $key
 * @property string $value
 * @property int $desc
 */
class Params extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'params';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['key', 'value', 'desc'], 'required'],
            [['key', 'value', 'desc'], 'string', 'max' => 255],
            [['key'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'key' => 'Key',
            'value' => 'Value',
            'desc' => 'Desc',
        ];
    }
}
