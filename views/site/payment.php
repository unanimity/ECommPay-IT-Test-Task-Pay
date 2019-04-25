<?php

/* @var $this yii\web\View */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;


$this->title = 'Payment';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1>Gifts to a birthday</h1>

    <div class="row">



            <?php $form = ActiveForm::begin(['id' => 'payment-form'], ['method' => 'post']); ?>
            <div class="col-lg-4">
                <h3>Order</h3>
                <?= $form->field($model, 'user_email')->textInput(['autofocus' => true]) ?>
                <?= $form->field($model, 'user_birthday') ?>
                <?= $form->field($model, 'amount') ?>
            </div>
            <div class="col-lg-4">
                <h3>Delivery</h3>
                <?= $form->field($model, 'billingFirstName') ?>
                <?= $form->field($model, 'billingLastName') ?>
                <?= $form->field($model, 'billingAddress1') ?>
                <?= $form->field($model, 'billingCity') ?>
                <?= $form->field($model, 'billingPostcode') ?>
                <?= $form->field($model, 'billingCountry') ?>
            </div>
            <div class="col-lg-4">
                <h3>Pay by credit card</h3>
                <?= $form->field($model, 'number') ?>
                <?= $form->field($model, 'cvv') ?>
                <?= $form->field($model, 'expiryMonth') ?>
                <?= $form->field($model, 'expiryYear') ?>
            <div class="form-group">
                <?= Html::submitButton('Donate', ['class' => 'btn btn-block btn-success btn-lg', 'name' => 'pay-button']) ?>
            </div>

            <?php ActiveForm::end();?>
            </div>

    </div>
</div>
