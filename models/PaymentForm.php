<?php
namespace app\models;


class PaymentForm extends DepkasaMock
{

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [

            [['user_birthday', 'billingAddress1', 'billingPostcode', 'expiryMonth'], 'required'],

            ['$user_email', 'email'],

        ];
    }

    public function Pay($args){
       return $this->PayDepKasa($args);
    }


}