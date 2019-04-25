<?php
namespace app\models;


use Yii;
use yii\base\Model;
use yii\httpclient\Client;

class DepkasaMock extends Model
{

    public $payment_id;

    //From user
    public $user_email;
    public $user_birthday;
    public $amount;

    public $billingFirstName;
    public $billingLastName;
    public $billingAddress1;
    public $billingCity;
    public $billingPostcode;
    public $billingCountry;

    public $number;
    public $cvv;
    public $expiryMonth;
    public $expiryYear;

    //Back processed
    public $currency='EUR';
    public $returnUrl='';
    public $referenceNo='';
    public $timestamp;
    public $language='';
    public $paymentMethod='';
    public $callbackUrl='';

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

    function PayDepKasa($request,$repeate=10){

        $time = new \DateTime('now', new \DateTimeZone('UTC'));
        $timestamp= $time->getTimestamp();
        $client = new Client();
        /* $response = $client->createRequest()
             ->setMethod('POST')
             ->setUrl(Yii::$app->params['paymentURL'])
             ->addHeaders(['content-type' => 'application/x-www-form-urlencoded'])
             ->setData(['name' => 'John Doe', 'email' => 'johndoe@example.com'])
             ->send();
         if ($response->isOk) {
             $newUserId = $response->data['id'];
         }*/
        \Yii::info('StatusPayDepKasa have data', 'my_sp_log');
        if ($repeate>0) {$this->StatusPayDepKasa($request,$repeate-1);}

    }
    function StatusPayDepKasa($request,$repeate=10){

        $client = new Client();
       /* $response = $client->createRequest()
            ->setMethod('POST')
            ->setUrl(Yii::$app->params['paymentURL'])
            ->addHeaders(['content-type' => 'application/x-www-form-urlencoded'])
            ->setData(['name' => 'John Doe', 'email' => 'johndoe@example.com'])
            ->send();
        if ($response->isOk) {
            $newUserId = $response->data['id'];
        }*/
        \Yii::info('StatusPayDepKasa have data', 'my_sp_log');
        if ($repeate>0) {$this->StatusPayDepKasa($request,$repeate-1);}
    }

}