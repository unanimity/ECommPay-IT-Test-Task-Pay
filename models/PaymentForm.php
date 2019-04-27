<?php
namespace app\models;
use app\models\DataStorage;
use Yii;


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
            \Yii::info('Pay -PRE :'.json_encode($args), 'my_sp_log');
            $response=$this->PayDepKasa($args);
            if ($response!=null){
                \Yii::info('Pay -OK :'.json_encode($response), 'my_sp_log');

                //   $datastoregge->setStatus($response);
            };
        }
        return true;//
    }
    public function ProcessingCallback($args){
        $datastoregge=new DataStorage();
        \Yii::info('ProcessingCallback -PRE :'.json_encode($args), 'my_sp_log');
        $datastoregge->setStatus($args);
    }




}