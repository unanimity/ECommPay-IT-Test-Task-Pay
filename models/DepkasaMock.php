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
    protected $returnUrl='http://www.sk-project.ru/api/callback';
    protected $referenceNo='';
    public $timestamp;
    protected $language='en';
    protected $paymentMethod='card';
    protected $currency='EUR';

    public function prepareTransaction($request)
    {   $request['returnUrl'] =$this->returnUrl;
        $request['language'] =$this->language;
        $request['paymentMethod'] =$this->paymentMethod;
        $request['referenceNo'] = uniqid('reference_');

        $request['timestamp'] = time ();
        $apiKey = Yii::$app->params['apiKey'];
        $secretKey = Yii::$app->params['secretKey'];
        $request['currency']=$this->currency ;
        $request['callbackUrl']=Yii::$app->params['callbackUrl'];
        $rawHash = $secretKey . $apiKey .
            $request['amount'] .$request['currency']. $request['referenceNo']. $request['timestamp'];
        $request['token']= md5($rawHash);
        return $request;
    }
    function PayDepKasa($request,$repeate=1){


        Yii::info('$request='.json_encode($request), 'my_sp_log');
        Yii::info('my token='.$request['token'], 'my_sp_log');
        \Yii::info('apiKey :'.json_encode(Yii::$app->params['apiKey']), 'my_sp_log');


        $client = new Client();
        $response = $client->createRequest()
             ->setMethod('POST')
             ->setUrl(Yii::$app->params['paymentURL'])
             ->addHeaders(['content-type' => 'application/x-www-form-urlencoded'])
             ->setData(
                 [
                     'token' => $request['token'],
                     'apiKey' => Yii::$app->params['apiKey'],
                     'email' => $request['email'],
                     'birthday' => (string)$request['birthday'],
                     'amount' => $request['amount'],
                     'currency' =>$request['currency'],
                     'returnUrl' =>$request['returnUrl'],
                     'referenceNo' =>$request['referenceNo'] ,
                     'timestamp' =>(string)$request['timestamp'] ,
                     'language' =>$request['language'],
                     'billingFirstName' => $request['billingFirstName'],
                     'billingLastName' => $request['billingLastName'],
                     'billingAddress1' => $request['billingAddress1'],
                     'billingCity' => $request['billingCity'],
                     'billingPostcode' => $request['billingPostcode'],
                     'billingCountry' => $request['billingCountry'],
                     'paymentMethod' => $request['paymentMethod'],
                     'number' =>(string)$request['number'],
                     'cvv' => (string)$request['cvv'],
                     'expiryMonth' => (string)$request['expiryMonth'],
                     'expiryYear' => (string)$request['expiryYear'],
                     'callbackUrl' =>$request['callbackUrl']
                 ])
            ;


        Yii::info('$response^ '.json_encode($response->data), 'my_sp_log');

        $response= $response->send();

        if ($response->isOk) {
            Yii::info('json_encode($response):'.json_encode($response->data), 'my_sp_log');
            return $response->data;
        } else {
            if ($repeate>0) {
                sleep(random_int(1, 3));
                return  $this->PayDepKasa($request,$repeate-1);
            } else
                return null;
        }



    }
    function getStatusPayDepKasa($referenceNo,$repeate=10){
        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('POST')
            ->setUrl(Yii::$app->params['paymentDetailURL'])
            ->addHeaders(['content-type' => 'application/x-www-form-urlencoded'])
            ->setData(
                [
                    'apiKey' => Yii::$app->params['apiKey'],
                    'referenceNo' => $referenceNo
                ])
            ->send();
        if ($response->isOk) {
            Yii::info('getStatusPayDepKasa:'.json_encode($response->data), 'my_sp_log');
            return $response->data;
        } else
        {
            Yii::info('getStatusPayDepKasa !rep', 'my_sp_log');
            if ($repeate>0) {
                sleep(random_int(1, 3));
               return $this->getStatusPayDepKasa($referenceNo,$repeate-1);
            } else
            return null;
        }

    }

}