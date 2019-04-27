<?php

/* @var $this yii\web\View */

use yii\grid\GridView;
use yii\helpers\Html;
use yii\web\View;
use app\components\HistoryWidget;
use yii\widgets\Pjax;

?>
<div class="site-about">
    <h1>Processing</h1>
    <?php Pjax::begin(['id' => 'some_pjax_id']); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'user_email',
            'user_birthday',
            'amount',
            'status',
            'message',
            'last_date_time',
            //~ ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
<button class="btn-lg btn-info" onclick=" $.pjax.reload({container: '#some_pjax_id', async: false});">
    Refresh
</button>

</div>
