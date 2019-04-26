<?php
namespace app\models;


use yii\base\Model;

class DataStorage extends Model
{
    function initPayments($request)
    {
        $result = \Yii::$app->db->createCommand("
        CALL `web`.`initPayment`
        (:i_user_email,
        :i_user_birthday,
        :i_amount,
        :i_currency,
        :i_returnUrl,
        :i_referenceNo,
        :i_timestamp,
        :i_language,
        :i_billingFirstName,
        :i_billingLastName,
        :i_billingAddress1,
        :i_billingCity,
        :i_billingPostcode,
        :i_billingCountry,
        :i_paymentMethod,
        :i_number,
        :i_callbackUrl);
")          ->bindValue(':i_user_email' , $request['email'])
            ->bindValue(':i_user_birthday', $request['birthday'])
            ->bindValue(':i_amount', $request['amount'])
            ->bindValue(':i_currency', $request['currency'])
            ->bindValue(':i_returnUrl', $request['returnUrl'])
            ->bindValue(':i_referenceNo', $request['referenceNo'])
            ->bindValue(':i_timestamp', $request['timestamp'])
            ->bindValue(':i_language', $request['language'])
            ->bindValue(':i_billingFirstName', $request['billingFirstName'])
            ->bindValue(':i_billingLastName', $request['billingLastName'])
            ->bindValue(':i_billingAddress1', $request['billingAddress1'])
            ->bindValue(':i_billingCity', $request['billingCity'])
            ->bindValue(':i_billingPostcode', $request['billingPostcode'])
            ->bindValue(':i_billingCountry', $request['billingCountry'])
            ->bindValue(':i_paymentMethod', $request['paymentMethod'])
            ->bindValue(':i_number', $request['number'])
            ->bindValue(':i_callbackUrl', $request['callbackUrl'])
            ->execute();
        return true;
    }

    function setStatus(){

        return true;
    }
    function getHistory()
    {

        return null;
    }


    /**
     * @return array the validation rules.

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
        return $this->PayDepKasa($args);
    }
*/

}