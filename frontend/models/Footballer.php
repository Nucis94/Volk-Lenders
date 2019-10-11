<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "footballer".
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property int $age
 *
 * @property Goal[] $goals
 * @property TeamFootballer[] $teamFootballers
 */
class Footballer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'footballer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['first_name', 'last_name', 'age'], 'required'],
            [['age'], 'integer'],
            [['first_name', 'last_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'age' => 'Age',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGoals()
    {
        return $this->hasMany(Goal::className(), ['footballer_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeamFootballers()
    {
        return $this->hasMany(TeamFootballer::className(), ['footballer_id' => 'id']);
    }
}
