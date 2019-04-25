<?php
namespace app\models;

use Yii;
use yii\base\Model;
use yii\httpclient\Client;

class DepkasaMock extends Model
{

    public $payment_id;
    public $user_email;
    public $user_birthday;
    public $amount;
    public $currency;
    public $returnUrl;
    public $referenceNo;
    public $timestamp;
    public $language;
    public $billingFirstName;
    public $billingLastName;
    public $billingAddress1;
    public $billingCity;
    public $billingPostcode;
    public $billingCountry;
    public $paymentMethod;
    public $number;
    public $cvv;
    public $expiryMonth;
    public $expiryYear;
    public $callbackUrl;







    public function generateToken($request)
    {
        $referenceNo = uniqid('reference_');
        $timestamp= time ();
        $apiKey = Yii::$app->params['apiKey'];
        $secretKey = Yii::$app->params['secretKey'];
        $rawHash = $secretKey . $apiKey .
            $request['amount'] . $request['currency'] . $referenceNo . $timestamp;
        return md5($rawHash);
    }

    function PayDepKasa($request,$repite=10){

        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('POST')
            ->setUrl('http://example.com/api/1.0/users')
            ->addHeaders(['content-type' => 'application/x-www-form-urlencoded'])
            ->setData(['name' => 'John Doe', 'email' => 'johndoe@example.com'])
            ->send();
        if ($response->isOk) {
            $newUserId = $response->data['id'];
        }

    }


}