<?php

namespace frontend\services;

use frontend\repository\LoanRepository;
use Throwable;
use Yii;
use yii\db\StaleObjectException;
use yii\web\NotFoundHttpException;

class LoanService
{
    private const LOAN_PERCENT = 0.06;

    private LoanRepository $loanRepository;

    public function __construct()
    {
        $this->loanRepository = Yii::$container->get(LoanRepository::class);
    }

    /**
     * @throws NotFoundHttpException
     * @throws Throwable
     * @throws StaleObjectException
     */
    public function calculateMonthlyIncome(int $loanId): ?int
    {
        $loanData = $this->loanRepository->getById($loanId);

        $montlyIncome = ($loanData->amount / 100) * self::LOAN_PERCENT;
        $totalIncome = $montlyIncome * $loanData->term;

        $loanData->monthly_income = $montlyIncome;
        if ($loanData->update()) {
            return $montlyIncome;
        }

        return null;
    }

    /**
     * @throws NotFoundHttpException
     */
    public function getMontlyPayment(int $loanId): int
    {
        $loanData = $this->loanRepository->getById($loanId);

        $montlyIncome = $loanData->monthly_income ?? ($loanData->amount / 100) * self::LOAN_PERCENT;

        return floor(($loanData->amount / $loanData->term) + $montlyIncome);
    }
}