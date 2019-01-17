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
        $sdate = date('Y-m-d');
        $ndate = date('Y-m-d');
       // echo $date_filter_zone[0];return;
        if(count($date_filter_zone) && $date_filter_zone[0]!=''){
//            $xdate = explode("/",$date_filter_zone[0]);
//            $ydate = explode("/",$date_filter_zone[1]);
            $sdate = "".date('Y-m-d',strtotime($date_filter_zone[0]));
            $ndate = "".date('Y-m-d',strtotime($date_filter_zone[1]));
        }

       //echo $ndate;return;

        $total_by_zone = 0;

        $sql = "
            SELECT sale_zone,sale_zone.name,sale_zone.description,sum(qty * price)as sale_amount
            FROM saleorder_line
            INNER JOIN saleorder
            ON saleorder_line.sale_id = saleorder.id
            INNER JOIN sale_zone
            ON saleorder.sale_zone = sale_zone.id
            WHERE saleorder.sale_date >='".$sdate."'
                  AND saleorder.sale_date <='".$ndate."'
            GROUP BY sale_zone
        ";
      // echo $sql;return;
        $query_by_zone = Yii::$app->db->createCommand($sql)->queryAll();
        $ret = array_values($query_by_zone);




       $sql_by_product = "
            SELECT product.name as label,SUM(saleorder_line.qty * saleorder_line.price) as value
            FROM saleorder_line
            INNER JOIN saleorder on saleorder.id = saleorder_line.sale_id
            INNER JOIN product on product.id = saleorder_line.product_id
            WHERE saleorder.sale_date >='".$sdate."'
                  AND saleorder.sale_date <='".$ndate."'
            GROUP BY product_id
        ";
      // echo $sql;return;
        $query_by_product = Yii::$app->db->createCommand($sql_by_product)->queryAll();
        $ret_by_product = array_values($query_by_product);

        $sql_by_product_long = "
            SELECT saleorder_line.product_id,product.name,SUM(saleorder_line.qty * saleorder_line.price) as sale_amount
            FROM saleorder_line
            INNER JOIN saleorder on saleorder.id = saleorder_line.sale_id
            INNER JOIN product on product.id = saleorder_line.product_id
            WHERE saleorder.sale_date >='".$sdate."'
                  AND saleorder.sale_date <='".$ndate."'
            GROUP BY product_id
        ";
        // echo $sql;return;
        $query_by_product_long = Yii::$app->db->createCommand($sql_by_product_long)->queryAll();
        $ret_by_product_long = array_values($query_by_product_long);

        $sql_new_cust = "
            SELECT code,first_name,last_name,DATEDIFF(from_unixtime(created_at,'%Y-%m-%d %h:%i:%s'),now()) as diffcount
            FROM 
            customer
            WHERE
            DATEDIFF(from_unixtime(created_at,'%Y-%m-%d %h:%i:%s'),now())>=-7
        ";

        $query_new_cust = Yii::$app->db->createCommand($sql_new_cust)->queryAll();

        $sql_new_prospect = "
            SELECT name,first_name,last_name,DATEDIFF(from_unixtime(created_at,'%Y-%m-%d %h:%i:%s'),now()) as diffcount
            FROM 
            prospect
            WHERE
            status = 0
        ";

        $query_new_prospect = Yii::$app->db->createCommand($sql_new_prospect)->queryAll();

        //print_r($query_new_cust);return;


        for($i=0;$i<=count($query_by_zone)-1;$i++){
            $total_by_zone = $total_by_zone + $query_by_zone[$i]['sale_amount'];
        }

        return $this->render('index',[
            'sale_by_zone' => Json::encode($ret),
            'sale_by_product'=>Json::encode($ret_by_product),
            'sale_by_product_long'=>Json::encode($ret_by_product_long),
            'total_by_zone' => $total_by_zone,
            'sdate'=>$sdate,
            'ndate' => $ndate,
            'cust_new'=>$query_new_cust,
            'prospect_new'=> $query_new_prospect
        ]);
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
       // $uname = Yii::$app->request->post('username');
        // $pwd = Yii::$app->request->post('password');

       // echo $uname;return;
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        //$this->layout = false;
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
        //if ($model->load(Yii::$app->request->post())) {
           // print_r($model);return;
        //if($uname!='' && $pwd !=''){
          //  $user = \backend\models\User::find()->where(['user'])->one();
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
