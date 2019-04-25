<?php
namespace app\controllers;

use yii\web\Controller;
use yii\data\Pagination;
use app\models\Payment;

class PaymentController extends Controller
{
    public function actionIndex()
    {
        $query = Payment::find();

        $pagination = new Pagination([
            'defaultPageSize' => 5,
            'totalCount' => $query->count(),
        ]);

        $payments = $query->orderBy('name')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('payment', [
            'payments' => $payments,
            'pagination' => $pagination,
        ]);
    }
}