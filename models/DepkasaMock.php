<?php
namespace app\models;


use Yii;
use yii\base\Model;
use yii\httpclient\Client;
/*class RquestData {


}
class RequestData {


}*/
class DepkasaMock extends Model
{

    public $payment_id;

    //From user
    public $email;
    public $birthday;
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
    protected $returnUrl='';
    protected $referenceNo='';
    public $timestamp;
    protected $language='';
    protected $paymentMethod='';
    protected $currency='EUR';

    protected function generateToken($request)
    {

    }

    function PayDepKasa($request,$repeate=1){

        $referenceNo = uniqid('reference_');
        $timestamp= time ();
        $apiKey = Yii::$app->params['apiKey'];
        $secretKey = Yii::$app->params['secretKey'];
        $rawHash = $secretKey . $apiKey .
            $request['amount'] .$this->currency . $referenceNo . $timestamp;
        $token= md5($rawHash);


       // $token=$this->generateToken($request);
        $callbackUrl=Yii::$app->params['callbackUrl'];
        Yii::info('$request='.json_encode($request), 'my_sp_log');
        Yii::info('my token='.$token, 'my_sp_log');




        $client = new Client();
        $response = $client->createRequest()
             ->setMethod('POST')
             ->setUrl(Yii::$app->params['paymentURL'])
             ->addHeaders(['content-type' => 'application/x-www-form-urlencoded'])
             ->setData(
                 [
                     'token' => $token,
                     'apiKey' => Yii::$app->params['apiKey'],
                     'email' => $request['email'],
                     'birthday' => $request['birthday'],
                     'amount' => $request['amount'],
                     'currency' =>$this->currency ,
                     'returnUrl' => $this->returnUrl,
                     'referenceNo' => $this->referenceNo,
                     'timestamp' => $this->timestamp,
                     'language' => $this->language,
                     'billingFirstName' => $request['billingFirstName'],
                     'billingLastName' => $request['billingLastName'],
                     'billingAddress1' => $request['billingAddress1'],
                     'billingCity' => $request['billingCity'],
                     'billingPostcode' => $request['billingPostcode'],
                     'billingCountry' => $request['billingCountry'],
                     'paymentMethod' => $this->paymentMethod,
                     'number' =>$request['number'],
                     'cvv' => $request['cvv'],
                     'expiryMonth' => $request['expiryMonth'],
                     'expiryYear' => $request['expiryYear'],
                     'callbackUrl' =>$callbackUrl
                 ])
             ->send();

        Yii::info('json_encode($response):'.json_encode($response->data), 'my_sp_log');

        if ($response->isOk) {
            Yii::info('   ($response->isOk)', 'my_sp_log');

        }

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