<?php

namespace app\module\admin\models;

use Yii;

/**
 * This is the model class for table "news".
 *
 * @property integer $id
 * @property string $data
 * @property string $name
 * @property string $shorttext
 * @property string $longertext
 */
class News extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'news';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['data', 'name', 'shorttext', 'longertext'], 'required'],
            [['data'], 'safe'],
            [['name', 'shorttext', 'longertext'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'data' => 'Data',
            'name' => 'Name',
            'shorttext' => 'Shorttext',
            'longertext' => 'Longertext',
        ];
    }
}
