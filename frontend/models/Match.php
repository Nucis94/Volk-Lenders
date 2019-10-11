<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "match".
 *
 * @property int $id
 * @property int $local_team_id
 * @property int $foreign_team_id
 * @property string $datetime
 *
 * @property Goal[] $goals
 * @property Team $localTeam
 * @property Team $foreignTeam
 */
class Match extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'match';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['local_team_id', 'foreign_team_id', 'datetime'], 'required'],
            [['local_team_id', 'foreign_team_id'], 'integer'],
            [['datetime'], 'safe'],
            [['local_team_id'], 'exist', 'skipOnError' => true, 'targetClass' => Team::className(), 'targetAttribute' => ['local_team_id' => 'id']],
            [['foreign_team_id'], 'exist', 'skipOnError' => true, 'targetClass' => Team::className(), 'targetAttribute' => ['foreign_team_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'local_team_id' => 'Local Team ID',
            'foreign_team_id' => 'Foreign Team ID',
            'datetime' => 'Datetime',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGoals()
    {
        return $this->hasMany(Goal::className(), ['match_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLocalTeam()
    {
        return $this->hasOne(Team::className(), ['id' => 'local_team_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getForeignTeam()
    {
        return $this->hasOne(Team::className(), ['id' => 'foreign_team_id']);
    }
}
