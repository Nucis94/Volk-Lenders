<?php

namespace api\modules\v1\controllers;

use yii\rest\ActiveController;

/**
 * Footballer Controller API
 */
class FootballerController extends ActiveController
{
    public $modelClass = 'frontend\models\Footballer';
}