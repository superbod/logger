<?php

namespace frontend\models;

use common\models\Loan;
use Throwable;
use yii\base\InvalidConfigException;
use yii\base\Model;
use yii\db\Exception;
use yii\db\StaleObjectException;
use yii\di\NotInstantiableException;
use yii\web\NotFoundHttpException;

class LoanForm extends Model
{
    public $userId;
    public $amount;
    public $term;
    public $purpose;
    public $status;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['amount', 'term', 'purpose',], 'required'],
            ['status', 'integer'],
            [['amount'], 'integer', 'min' => 1],
            ['term', 'integer', 'min' => 6, 'max' => 60],
        ];
    }

    /**
     * @throws Exception
     */
    public function save(int $userId): ?int
    {
        $loan = new Loan();

        $loan->userId = $userId;
        $loan->amount = $this->amount;
        $loan->term = $this->term;
        $loan->purpose = $this->purpose;
        $loan->status = Loan::PENDING;

        if ($loan->save()) {
            return $loan->id;
        }

        return null;
    }

    /**
     * @throws Throwable
     * @throws InvalidConfigException
     * @throws StaleObjectException
     * @throws NotInstantiableException
     * @throws NotFoundHttpException
     */
    public function update(Loan $loan)
    {
        $loan->amount = $this->amount;
        $loan->term = $this->term;
        $loan->purpose = $this->purpose;
        $loan->status = $this->status;

        return (bool) $loan->update();
    }
}