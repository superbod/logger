<?php

use frontend\models\LoanForm;
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

/** @var LoanForm $model */

$this->title = 'Loan list';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to request your loan:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php
            $form = ActiveForm::begin(['id' => 'form-loan']);
            echo $form->field($model, 'amount');
            echo $form->field($model, 'term');
            echo $form->field($model, 'purpose')->textarea();
            ?>

            <div class="form-group">
                <?= Html::submitButton('Request', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
