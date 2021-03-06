<?php

namespace common\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "gifts".
 *
 * @property int $id
 * @property string $name
 * @property string $image
 * @property int $amount
 * @property int $status
 *
 * @property UserGifts[] $userGifts
 */
class Gifts extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'gifts';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'amount', 'status'], 'required'],
            [['amount', 'status'], 'integer'],
            [['name', 'image'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'image' => 'Image',
            'amount' => 'Amount',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserGifts()
    {
        return $this->hasMany(UserGifts::className(), ['gift_id' => 'id']);
    }

    public function beforeDelete()
    {
        if(is_file(Yii::getAlias('@frontend/web'.$this->image)))
            unlink(Yii::getAlias('@frontend/web'.$this->image));
        return parent::beforeDelete(); // TODO: Change the autogenerated stub
    }

    public function beforeSave($insert)
    {
        if($file = UploadedFile::getInstance($this, 'image')){
            $filename = '/uploads/'.uniqid(time().'_').'.'.$file->extension;

            if(!is_dir(Yii::getAlias('@frontend/web/uploads')))
                mkdir(Yii::getAlias('@frontend/web/uploads'),0777,true);

            if(is_file(Yii::getAlias('@frontend/web'.$this->getOldAttribute('image'))))
                unlink(Yii::getAlias('@frontend/web'.$this->getOldAttribute('image')));

            $file->saveAs(Yii::getAlias('@frontend/web'.$filename));
            $this->image = $filename;
        }elseif($this->isNewRecord){
            $this->addError('image','Upload Image');
            return false;
        }else{
            $this->image = $this->getOldAttribute('image');
        }

        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
    }
}
