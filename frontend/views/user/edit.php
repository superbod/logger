<?php

use frontend\models\UserForm;
use yii\bootstrap5\Html;
use yii\jui\DatePicker;
use yii\widgets\ActiveForm;

/** @var UserForm $model */

$this->title = 'User Info';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to signup:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php
            $form = ActiveForm::begin(['id' => 'form-signup']);
            echo $form->field($model, 'first_name');
            echo $form->field($model, 'last_name');

            echo $form->field($model, 'date_of_birth')->widget(DatePicker::class, [
                'options' => ['class' => 'form-control']
            ]);
            echo $form->field($model, 'pasport_expiry_date')->widget(DatePicker::class, [
                'options' => ['class' => 'form-control']
            ]);
            echo $form->field($model, 'imageFiles[]')->fileInput(['multiple' => true]);
            ?>

            <div class="form-group">
                <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>