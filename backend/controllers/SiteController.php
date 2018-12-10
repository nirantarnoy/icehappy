<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use yii\helpers\Json;

/**
 * Site controller
 */
class SiteController extends Controller
{
    public $enableCsrfValidation = false;
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
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
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $date_filter_zone = explode('-',Yii::$app->request->post('date_filter_zone'));
        $sdate = date('d/m/Y');
        $ndate = date('d/m/Y');

        if(count($date_filter_zone) && $date_filter_zone[0]!=''){
            $sdate = $date_filter_zone[0];
            $ndate = $date_filter_zone[1];
        }

       //echo $sdate;return;

        $total_by_zone = 0;

        $sql = "
            SELECT sale_zone,sale_zone.name,sale_zone.description,sum(qty * price)as sale_amount
            FROM saleorder_line
            INNER JOIN saleorder
            ON saleorder_line.sale_id = saleorder.id
            INNER JOIN sale_zone
            ON saleorder.sale_zone = sale_zone.id
            WHERE saleorder.sale_date >=".$sdate."
                  AND saleorder.sale_date <=".$ndate."
            GROUP BY sale_zone
        ";

        $query_by_zone = Yii::$app->db->createCommand($sql)->queryAll();
        $ret = array_values($query_by_zone);


        $sql_new_cust = "
            SELECT code,first_name,last_name,DATEDIFF(from_unixtime(created_at,'%Y-%m-%d %h:%i:%s'),now()) as diffcount
            FROM 
            customer
            WHERE
            DATEDIFF(from_unixtime(created_at,'%Y-%m-%d %h:%i:%s'),now())>=-7
        ";

        $query_new_cust = Yii::$app->db->createCommand($sql_new_cust)->queryAll();

        //print_r($query_new_cust);return;


        for($i=0;$i<=count($query_by_zone)-1;$i++){
            $total_by_zone = $total_by_zone + $query_by_zone[$i]['sale_amount'];
        }

        return $this->render('index',[
            'sale_by_zone' => Json::encode($ret),
            'total_by_zone' => $total_by_zone,
            'sdate'=>$sdate,
            'ndate' => $ndate,
            'cust_new'=>$query_new_cust
        ]);
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
