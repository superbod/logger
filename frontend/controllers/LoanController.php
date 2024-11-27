<?php

namespace frontend\controllers;

use common\models\Loan;
use frontend\repository\LoanRepository;
use frontend\services\LoanService;
use Yii;
use yii\base\InvalidConfigException;
use yii\data\ActiveDataProvider;
use yii\db\Exception;
use yii\di\NotInstantiableException;
use yii\web\Controller;
use frontend\models\LoanForm;
use yii\web\NotFoundHttpException;

class LoanController extends Controller
{
    private LoanRepository $loanRepository;

    public function __construct($id, $module, $config = [])
    {
        $this->loanRepository = Yii::$container->get(LoanRepository::class);

        parent::__construct($id, $module, $config);
    }

    /**
     * @throws Exception
     * @throws InvalidConfigException
     * @throws NotInstantiableException
     * @throws NotFoundHttpException
     */

    public function actionRequestLoan(): string
    {
        $loanForm = new LoanForm();
        $userId = Yii::$app->user->getId();
        if ($loanForm->load(Yii::$app->request->post()) && $loanForm->validate()) {
            $modelId = $loanForm->save($userId);
            if ($modelId) {
                $loanService = Yii::$container->get(LoanService::class);
                $monthlyIncome = $loanService->getMontlyPayment($modelId);
                $this->loanRepository->updateMonthlyPayment($modelId, $monthlyIncome);
            }
        }

        return $this->render('requestLoan', [
            'model' => $loanForm,
        ]);
    }

    public function actionList()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Loan::find(),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        return $this->render('list', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionUpdate()
    {
        $modelId = Yii::$app->request->get('id');
        $model = $this->loanRepository->getById($modelId);
        $loanForm = New LoanForm();

        if ($loanForm->load(Yii::$app->request->post()) && $loanForm->validate()) {
            $loanForm->update($model);
        } else {
            $loanForm->setAttributes($model->getAttributes());
        }

        return $this->render('update', [
            'model' => $loanForm,
        ]);
    }
}