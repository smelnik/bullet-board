<?php

namespace common\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "user_info".
 *
 * @property int $id
 * @property int $user_id
 * @property string $first_name
 * @property string $middle_name
 * @property string $last_name
 * @property string $phone
 * @property string $birth_date
 * @property string $avatar_url
 * @property int $rating_avg
 *
 * @property User $user
 */
class UserInfo extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_info';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id'], 'integer'],
            [['user_id'], 'unique'],
            [['user_id'], 'exist', 'skipOnError' => true,
                'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
            [['birth_date'], 'safe'],
            [['first_name', 'middle_name', 'last_name', 'phone', 'avatar_url'], 'string', 'max' => 255],
            [['first_name', 'middle_name', 'last_name', 'phone', 'avatar_url'], 'filter', 'filter' => function ($value) {
                $value = trim($value);
                return !empty($value) ? $value : null;
            }],
            [['rating_avg'], 'in', 'range' => range(0, 5)],
            [['avatar_url'], 'file', 'extensions' => ['png', 'jpg', 'gif'], 'maxSize' => 1024 * 1024],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'first_name' => 'First Name',
            'middle_name' => 'Middle Name',
            'last_name' => 'Last Name',
            'phone' => 'Phone',
            'birth_date' => 'Birth Date',
            'avatar_url' => 'Avatar',
            'rating_avg' => 'Rating Avg',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
