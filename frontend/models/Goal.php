<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "goal".
 *
 * @property int $id
 * @property int $match_id
 * @property int $team_id
 * @property int $footballer_id
 * @property string $datetime
 *
 * @property Match $match
 * @property Team $team
 * @property Footballer $footballer
 */
class Goal extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'goal';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['match_id', 'team_id', 'footballer_id', 'datetime'], 'required'],
            [['match_id', 'team_id', 'footballer_id'], 'integer'],
            [['datetime'], 'safe'],
            [['match_id'], 'exist', 'skipOnError' => true, 'targetClass' => Match::className(), 'targetAttribute' => ['match_id' => 'id']],
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
            'match_id' => 'Match ID',
            'team_id' => 'Team ID',
            'footballer_id' => 'Footballer ID',
            'datetime' => 'Datetime',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMatch()
    {
        return $this->hasOne(Match::className(), ['id' => 'match_id']);
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
