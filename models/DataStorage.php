<?php
namespace app\models;


use yii\base\Model;
use yii\data\ArrayDataProvider;

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

    function setStatus($request){

        \Yii::info('setStatus - DB :'.json_encode($request), 'my_sp_log');

        // I know what I can use referenceNo as PK to table

        if (isset($request['payment_id']))
        {
            $payments[0]['payment_id']=$request['payment_id'];

        } else {

            $payments = (new \yii\db\Query())
                ->select(['payment_id'])
                ->from('payments')
                ->where(['referenceNo' =>(string)(isset($request['referenceNo']))?$request['referenceNo']:''])
                ->limit(1)
                ->all();
        }

         \Yii::$app->db->createCommand("
               INSERT INTO `web`.`payments_status`
                (`payment_id`,`status`,`message`)
                VALUES
                ( 
                :payment_id,
                :status,
                :message);
        
        ")
            ->bindValue(':payment_id' , (isset($payments[0]))?$payments[0]['payment_id']:'')
            ->bindValue(':status', (string)(isset($request['status']))?$request['status']:'')
            ->bindValue(':message',(string)(isset($request['message']))?$request['message']:'')
            ->execute();

         \Yii::$app->db->createCommand("
                        UPDATE `web`.`payments`
                        SET
                        `returnForm` = :returnForm,
                        `transactionId` = :transactionId
                        WHERE `payment_id` = :payment_id;
            
            ")
            ->bindValue(':payment_id' , (isset($payments[0]))?$payments[0]['payment_id']:'')
            ->bindValue(':transactionId',(string)(isset($request['transactionId']))?$request['transactionId']:'')
            ->bindValue(':returnForm',(string)(isset($request['returnForm']))?$request['returnForm']:'')
            ->execute();

        return true;
    }
    function getHistory()
    {

        $query = \Yii::$app->db->createCommand("SELECT * FROM web.getPaymentList;")->queryAll();;

        $dataProvider = new ArrayDataProvider([
                'allModels' => $query,
                'pagination' => [
                    'pageSize' => 10,
                ],
                'sort' => [
                    'attributes' => ['last_date_time'],
                ],
            ]);

        return $dataProvider;
    }


}