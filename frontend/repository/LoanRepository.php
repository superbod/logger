<?php

namespace frontend\repository;

use common\models\Loan;
use yii\db\ActiveRecord;
use yii\db\Exception;
use yii\web\NotFoundHttpException;

class LoanRepository
{
    /**
     * @throws NotFoundHttpException
     */
    public function getById(int $id): Loan
    {
        $model = Loan::findOne(['id' => $id]);

        if (!$model) {
            throw new NotFoundHttpException();
        }

        return $model;
    }

    /**
     * @throws Exception
     * @throws NotFoundHttpException
     */
    public function updateMonthlyPayment(int $modelId, int $monthlyIncome): bool
    {
        $model = $this->getById($modelId);
        $model->monthly_income = $monthlyIncome;

        if (!$model->save()) {
            throw new Exception('Error occured while updating Loan, id -> ' . $modelId);
        }

        return true;
    }

    /**
     * @return array|Loan[]|ActiveRecord[]
     * @throws NotFoundHttpException
     */
    public function getAllLoans()
    {
        $models = Loan::find()->all();

        if (!$models) {
            throw new NotFoundHttpException();
        }

        return $models;
    }
}