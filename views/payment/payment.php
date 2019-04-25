<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
?>
    <h1>Countries</h1>
    <ul>
        <?php foreach ($payments as $payment): ?>
            <li>
                <?= Html::encode("{$payment->code} ({$payment->name})") ?>:
                <?= $payment->population ?>
            </li>
        <?php endforeach; ?>
    </ul>

<?= LinkPager::widget(['pagination' => $pagination]) ?>