<?php

namespace frontend\models;

use common\models\User;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property int $role
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property string $verification_token
 *
 * @property Goal[] $goals
 * @property TeamFootballer[] $teamFootballers
 */
class Footballer extends User implements IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'required'],
            ['username', 'unique'],
            ['password', 'required'],
            ['email', 'email'],
            ['email', 'required'],
            ['email', 'unique'],

            ['auth_key', 'default', 'value' => self::generateAuthKey()],
            ['status', 'default', 'value' => self::STATUS_INACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_INACTIVE, self::STATUS_DELETED]],
            ['role', 'default', 'value' => self::ROLE_FOOTBALLER],
            ['role', 'in', 'range' => [self::ROLE_FOOTBALLER]],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'email' => 'Email',
            'status' => 'Status',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'role' => self::ROLE_FOOTBALLER, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'role' => self::ROLE_FOOTBALLER, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'role' => self::ROLE_FOOTBALLER,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds user by verification email token
     *
     * @param string $token verify email token
     * @return static|null
     */
    public static function findByVerificationToken($token)
    {
        return static::findOne([
            'verification_token' => $token,
            'role' => self::ROLE_FOOTBALLER,
            'status' => self::STATUS_INACTIVE
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getPassword()
    {
        return $this->password_hash;
    }

    /**
     * Query builder. Returns footballer's goals.
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGoals()
    {
        return $this->hasMany(Goal::className(), ['footballer_id' => 'id']);
    }

    /**
     * Query builder. Returns footballer's teams.
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTeamFootballers()
    {
        return $this->hasMany(TeamFootballer::className(), ['footballer_id' => 'id']);
    }
}
