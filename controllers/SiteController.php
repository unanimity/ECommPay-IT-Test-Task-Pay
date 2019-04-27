<?php

namespace app\controllers;

use app\models\DepkasaMock;
use app\models\PaymentForm;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                    'callback' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
            'cors' => [
                'class' => \yii\filters\Cors::className(),
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {$this->enableCsrfValidation = false;
        return $this->render('index');
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }


    public function actionPayment()
    {
        $model = new PaymentForm();

        if($model->load(Yii::$app->request->post())) {
         $request=Yii::$app->request->post('PaymentForm');
         $model->Pay($request);

            return $this->render('process',[
                'model' => $model,
            ]);

        } else

        return $this->render('payment',[
        'model' => $model,
        ]);

    }


    public function actionCallback()
    {
        $model = new PaymentForm();
        $model->ProcessingCallback(Yii::$app->request->post());
        return $this->render('about');
    }
}
