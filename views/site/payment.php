<?php

/* @var $this yii\web\View */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;


$this->title = 'Payment';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        This is the About page. You may modify the following file to customize its content:
    </p>
    <div class="row">
        <div class="col-lg-5">

            <?php $form = ActiveForm::begin(['id' => 'payment-form'], ['method' => 'post']); ?>
            <?= $form->field($model, 'user_email')->textInput(['autofocus' => true]) ?>
            <?= $form->field($model, 'user_birthday') ?>
            <?= $form->field($model, 'amount') ?>
            <?= $form->field($model, 'currency') ?>
            <?= $form->field($model, 'returnUrl') ?>
            <?= $form->field($model, 'referenceNo') ?>
            <?= $form->field($model, 'timestamp') ?>
            <?= $form->field($model, 'language') ?>
            <?= $form->field($model, 'billingFirstName') ?>
            <?= $form->field($model, 'billingLastName') ?>
            <?= $form->field($model, 'billingAddress1') ?>
            <?= $form->field($model, 'billingCity') ?>
            <?= $form->field($model, 'billingPostcode') ?>
            <?= $form->field($model, 'billingCountry') ?>
            <?= $form->field($model, 'paymentMethod') ?>
            <?= $form->field($model, 'number') ?>
            <?= $form->field($model, 'cvv') ?>
            <?= $form->field($model, 'expiryMonth') ?>
            <?= $form->field($model, 'expiryYear') ?>
            <?= $form->field($model, 'callbackUrl') ?>


            <div class="form-group">
                <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'pay-button']) ?>
            </div>

            <?php ActiveForm::end(); \Yii::error('test-'); Yii::debug('start calculating average revenue');?>

        </div>
    </div>
</div>
