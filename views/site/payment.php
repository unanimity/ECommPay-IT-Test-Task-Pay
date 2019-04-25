<?php

/* @var $this yii\web\View */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;


$this->title = 'Payment';

?>
<div class="site-about">
    <h1>Gifts to a birthday</h1>

    <div class="row">



            <?php $form = ActiveForm::begin(['id' => 'payment-form'], ['method' => 'post']); ?>
            <div class="col-lg-4">
                <h3>Order</h3>
                <?= $form->field($model, 'email')->textInput(['autofocus' => true],['value' => 'ecommpay@mail.com']) ?>
                <?= $form->field($model, 'birthday')->textInput(['value' => '12.12.12'])  ?>
                <?= $form->field($model, 'amount')->textInput(['value' => '10']) ?>
            </div>
            <div class="col-lg-4">
                <h3>Delivery</h3>
                <?= $form->field($model, 'billingFirstName')->textInput(['value' => '4652 Rd str.']) ?>
                <?= $form->field($model, 'billingLastName')->textInput(['value' => 'b. 31']) ?>
                <?= $form->field($model, 'billingAddress1') ->textInput(['value' => 'El/ st'])?>
                <?= $form->field($model, 'billingCity')->textInput(['value' => 'Gotem']) ?>
                <?= $form->field($model, 'billingPostcode')->textInput(['value' => '436632']) ?>
                <?= $form->field($model, 'billingCountry')->textInput(['value' => 'Uganda']) ?>
            </div>
            <div class="col-lg-4">
                <h3>Pay by credit card</h3>
                <?= $form->field($model, 'number')->textInput(['value' => '0000000000000001']) ?>
                <?= $form->field($model, 'cvv')->textInput(['value' => '000']) ?>
                <?= $form->field($model, 'expiryMonth')->textInput(['value' => '12']) ?>
                <?= $form->field($model, 'expiryYear')->textInput(['value' => '20']) ?>
            <div class="form-group">
                <?= Html::submitButton('Donate', ['class' => 'btn btn-block btn-success btn-lg', 'name' => 'pay-button']) ?>
            </div>

            <?php ActiveForm::end();?>
            </div>

    </div>
</div>
