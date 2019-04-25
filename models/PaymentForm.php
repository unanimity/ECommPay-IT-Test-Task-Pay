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

            [['user_email', 'user_birthday', 'amount'], 'required','message'=>'Enter gift info'],
            [['billingFirstName', 'billingLastName', 'billingAddress1', 'billingCity', 'billingPostcode', 'billingCountry'], 'required','message'=>'Enter delivery info'],
            [['number', 'cvv', 'expiryMonth', 'expiryYear'], 'required','message'=>'Enter Card info'],
            ['$user_email', 'email'],

        ];
    }

    public function Pay($args){
       return $this->PayDepKasa($args);
    }


}