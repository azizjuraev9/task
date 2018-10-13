<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user_gifts".
 *
 * @property int $id
 * @property int $user_id
 * @property int $gift_id
 * @property int $status
 * @property int $money
 * @property string $time
 *
 * @property Gifts $gift
 * @property User $user
 */
class UserGifts extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_gifts';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'status'], 'required'],
            [['user_id', 'gift_id', 'status', 'money'], 'integer'],
            [['time'], 'safe'],
            [['gift_id'], 'exist', 'skipOnError' => true, 'targetClass' => Gifts::className(), 'targetAttribute' => ['gift_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'gift_id' => 'Gift ID',
            'status' => 'Status',
            'money' => 'Money',
            'time' => 'Time',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGift()
    {
        return $this->hasOne(Gifts::className(), ['id' => 'gift_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
