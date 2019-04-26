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
            [['number', 'cvv', 'expiryMonth', 'expiryYear'], 'number','message'=>'Enter Card info'],
            ['$email', 'email']
         /*   [['billingCountry'],'required','max' => 2],*/

        ];
    }

    public function Pay($args){

        $datastoregge=new DataStorage();
        $args=$this->prepareTransaction($args);
        if ($datastoregge->initPayments($args)){
            $response=$this->PayDepKasa($args);
            if ($response!=null){
                $datastoregge->setStatus($response);
            };
        }
        return true;//
    }




}