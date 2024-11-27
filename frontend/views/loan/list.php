<?php

use yii\data\ActiveDataProvider;
use yii\grid\GridView;

/** @var ActiveDataProvider $dataProvider */

$this->title = 'Loan List';
$this->params['breadcrumbs'][] = $this->title;

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'id',
        'userId',
        'amount',
        'term',
        'purpose',
        'status',
        'monthly_income',
        [
            'class' => 'yii\grid\ActionColumn',
            'header' => 'edit',
            'template' => '{view}{update}{delete}',
        ]
    ]
]);
