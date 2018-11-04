<?php

namespace common\models;

use common\models\base\BaseModel;
use Yii;

/**
 * This is the model class for table "posts".
 *
 * @property int $id
 * @property string $title
 * @property string $summary ժҪ
 * @property string $content
 * @property string $label_img
 * @property int $cat_id
 * @property int $user_id
 * @property string $user_name
 * @property int $is_valid
 * @property int $created_at
 * @property int $updated_at
 */
class PostsModel extends BaseModel
{
    const  IS_VALID = "1" ;//文章发布
    const  NO_VALID = '0';//文章不发布
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'posts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content'], 'string'],
            [['cat_id', 'user_id', 'created_at', 'updated_at'], 'integer'],
            [['title', 'summary', 'label_img', 'user_name'], 'string', 'max' => 255],
            [['is_valid'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'summary' => Yii::t('app', 'Summary'),
            'content' => Yii::t('app', 'Content'),
            'label_img' => Yii::t('app', 'Label Img'),
            'cat_id' => Yii::t('app', 'Cat ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'user_name' => Yii::t('app', 'User Name'),
            'is_valid' => Yii::t('app', 'Is Valid'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }




}
