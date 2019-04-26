<?php
namespace app\models;


use yii\base\Model;

class DataStorage extends Model
{
    function initPayments($request)
    {
        $result = \Yii::$app->db->createCommand("CALL storedProcedureName(:paramName1, :paramName2)")
            ->bindValue(':paramName1' , $param1 )
            ->bindValue(':paramName2', $param2)
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