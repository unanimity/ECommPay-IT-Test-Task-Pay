<?php
namespace app\models;


use yii\base\Model;

class DataStorage extends Model
{
    function initPayments($request)
    {
        \Yii::$app->db->createCommand()
            ->insert('payment', [
                'code' => 'tt',
                'name' => 'test6',
                'population' => 30,
            ])->execute();
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