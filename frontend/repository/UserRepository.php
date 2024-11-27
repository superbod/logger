<?php

namespace frontend\repository;

use common\models\User;
use yii\web\NotFoundHttpException;

class UserRepository
{
    /**
     * @throws NotFoundHttpException
     */
    public function getById(int $id): User
    {
        $model = User::findOne(['id' => $id]);

        if (!$model) {
            throw new NotFoundHttpException();
        }

        return $model;
    }
}