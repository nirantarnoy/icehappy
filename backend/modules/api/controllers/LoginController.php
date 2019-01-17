<?php

namespace backend\modules\api\controllers;

use yii\filters\ContentNegotiator;
use yii\rest\ActiveController;
use yii\web\Response;
use backend\models\User;

class LoginController extends ActiveController
{
    public $enableCsrfValidation = false;
    public function behaviors()
    {
        return [
            [
                'class' => ContentNegotiator::className(),
                'only' => ['index', 'view'],
                'formats' => [
                    'application/json' => Response::FORMAT_JSON,
                ],
            ],
        ];
    }
    public $modelClass = 'backend\models\User';
    public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => 'items',
    ];
    public function actionLogin()
    {
        $username = \Yii::$app->request->post('username');
        \Yii::$app->response->format = \yii\web\Response:: FORMAT_JSON;
        $model = User::find()->where(['username'=>$username])->one();
        if (count($model) > 0) {
            return array('status' => true, 'data' => $model);
        } else {
            return array('status' => false, 'data' => 'No User Found');
        }
    }
}
