<?php
namespace app\models;
use app\models\DataStorage;

class PaymentForm extends DepkasaMock
{

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [

            [['email', 'birthday', 'amount'], 'required','message'=>'Enter gift info'],
            [['billingFirstName', 'billingLastName', 'billingAddress1', 'billingCity', 'billingPostcode', 'billingCountry'], 'required','message'=>'Enter delivery info'],
            [['number', 'cvv', 'expiryMonth', 'expiryYear'], 'required','message'=>'Enter Card info'],
            ['$email', 'email'],

        ];
    }

    public function Pay($args){

        $datastoregge=new DataStorage();
        return [$datastoregge->initPayments('k'),$this->PayDepKasa($args)];
    }




}