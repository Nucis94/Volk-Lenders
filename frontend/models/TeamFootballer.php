<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "team_footballer".
 *
 * @property int $id
 * @property int $team_id
 * @property int $footballer_id
 * @property string $datetime
 *
 * @property Team $team
 * @property Footballer $footballer
 */
class TeamFootballer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'team_footballer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['team_id', 'footballer_id', 'datetime'], 'required'],
            [['team_id', 'footballer_id'], 'integer'],
            [['datetime'], 'safe'],
            [['team_id'], 'exist', 'skipOnError' => true, 'targetClass' => Team::className(), 'targetAttribute' => ['team_id' => 'id']],
            [['footballer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Footballer::className(), 'targetAttribute' => ['footballer_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'team_id' => 'Team ID',
            'footballer_id' => 'Footballer ID',
            'datetime' => 'Datetime',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeam()
    {
        return $this->hasOne(Team::className(), ['id' => 'team_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFootballer()
    {
        return $this->hasOne(Footballer::className(), ['id' => 'footballer_id']);
    }
}
