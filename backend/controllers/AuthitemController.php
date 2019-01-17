<?php

namespace backend\controllers;

use Yii;
use backend\models\Authitem;
use backend\models\AuthitemSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AuthitemController implements the CRUD actions for Authitem model.
 */
class AuthitemController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Authitem models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AuthitemSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Authitem model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Authitem model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Authitem();

        if ($model->load(Yii::$app->request->post())) {
            $model->type = Yii::$app->request->post('auth_type');
            if( $model->save()){
                return $this->redirect(['index']);
            }

        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Authitem model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $modelchild = \backend\models\Auhtitemchild::find()->where(['parent'=>$model->name])->all();

        if ($model->load(Yii::$app->request->post())) {
            $model->type = Yii::$app->request->post('auth_type');
            if( $model->save()){
                return $this->redirect(['index']);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'modelchild'=>$modelchild,
        ]);
    }

    /**
     * Deletes an existing Authitem model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Authitem model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Authitem the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Authitem::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    public function actionManagerule(){

        $auth = Yii::$app->authManager;
        $auth->removeAll();

        // $rule = new \common\rbac\DeleteRecordRule(); // rule ที่สร้างไว้
        //  $auth->add($rule);

        // site module

      //  $site_changepwd = $auth->createPermission('site/changepassword');
     //   $auth->add($site_changepwd);
//        $site_logout = $auth->createPermission('site/logout');
//        $auth->add($site_logout);
//        $site_login = $auth->createPermission('site/login');
//        $auth->add($site_login);
//
//        $site_permission = $auth->createPermission('sitemodule');
//        $site_permission->description = "หน้าหลัก";
//        $auth->add($site_permission);
//        $auth->addChild($site_permission,$site_index);
//        $auth->addChild($site_permission,$site_logout);

//        $suplier = $auth->createRole('Suplier');
//        $suplier->description = "Suplier";
//        $auth->add($suplier);
//        $auth->addChild($suplier,$site_permission);

        // plan_module
        $plant_index = $auth->createPermission('plant/index');
        $auth->add($plant_index);
        $plant_update = $auth->createPermission('plant/update');
        $auth->add($plant_update);
        $plant_delete = $auth->createPermission('plant/delete');
        $auth->add($plant_delete);
        $plant_view = $auth->createPermission('plant/view');
        $auth->add($plant_view);
        $plant_create = $auth->createPermission('plant/create');
        $auth->add($plant_create);
        $plant_showcity = $auth->createPermission('plant/showcity');
        $auth->add($plant_showcity);
        $plant_showdistrict = $auth->createPermission('plant/showdistrict');
        $auth->add($plant_showdistrict);
        $plant_showzipcode = $auth->createPermission('plant/showzipcode');
        $auth->add($plant_showzipcode);

        $plant_permission = $auth->createPermission('plantmodule');
        $plant_permission->description = "สิทธิ์ใช้งานโมดูล Plant";
        $auth->add($plant_permission);

        $auth->addChild($plant_permission,$plant_index);
        $auth->addChild($plant_permission,$plant_view);
        $auth->addChild($plant_permission,$plant_update);
        $auth->addChild($plant_permission,$plant_delete);
        $auth->addChild($plant_permission,$plant_create);
        $auth->addChild($plant_permission,$plant_showcity);
        $auth->addChild($plant_permission,$plant_showdistrict);
        $auth->addChild($plant_permission,$plant_showzipcode);

        $manage_plant = $auth->createRole('จัดการข้อมูลบริษัท');
        $manage_plant->description = "เพิ่ม/แก้ไข ข้อมูลต่างๆของบริษัท";
        $auth->add($manage_plant);
        $auth->addChild($manage_plant,$plant_permission);

        // user_module
        $user_index = $auth->createPermission('user/index');
        $auth->add($user_index);
        $user_update = $auth->createPermission('user/update');
        $auth->add($user_update);
        $user_delete = $auth->createPermission('user/delete');
        $auth->add($user_delete);
        $user_view = $auth->createPermission('user/view');
        $auth->add($user_view);
        $user_create = $auth->createPermission('user/create');
        $auth->add($user_create);

        $user_permission = $auth->createPermission('จัดการข้อมูลผู้ใช้งาน');
        $user_permission->description = "สิทธิ์ใช้งานโมดูล user";
        $auth->add($user_permission);

        $auth->addChild($user_permission,$user_index);
        $auth->addChild($user_permission,$user_view);
        $auth->addChild($user_permission,$user_update);
        $auth->addChild($user_permission,$user_delete);
        $auth->addChild($user_permission,$user_create);

        $manage_user = $auth->createRole('ผู้จัดการข้อมูลผู้ใช้');
        $manage_user->description = "สร้าง/แก้ไข ข้อมูลของผู้ใช้งานระบบ";
        $auth->add($manage_user);
        $auth->addChild($manage_user,$user_permission);

        // user_group_module
        $usergroup_index = $auth->createPermission('usergroup/index');
        $auth->add($usergroup_index);
        $usergroup_update = $auth->createPermission('usergroup/update');
        $auth->add($usergroup_update);
        $usergroup_delete = $auth->createPermission('usergroup/delete');
        $auth->add($usergroup_delete);
        $usergroup_view = $auth->createPermission('usergroup/view');
        $auth->add($usergroup_view);
        $usergroup_create = $auth->createPermission('usergroup/create');
        $auth->add($usergroup_create);

        $usergroup_permission = $auth->createPermission('จัดการข้อมูลกลุ่มผู้ใช้');
        $usergroup_permission->description = "สิทธิ์ใช้งานโมดูลกลุ่มผู้ใช้งานระบบ";
        $auth->add($usergroup_permission);

        $auth->addChild($usergroup_permission,$usergroup_index);
        $auth->addChild($usergroup_permission,$usergroup_view);
        $auth->addChild($usergroup_permission,$usergroup_update);
        $auth->addChild($usergroup_permission,$usergroup_delete);
        $auth->addChild($usergroup_permission,$usergroup_create);

        $manage_usergroup = $auth->createRole('ผู้จัดการกลุ่มผู้ใช้งานระบบ');
        $manage_usergroup->description = "บริหารจัดการกลุ่มผู้ใช้งาน";
        $auth->add($manage_usergroup);
        $auth->addChild($manage_usergroup,$usergroup_permission);

        // product module
        $product_index = $auth->createPermission('product/index');
        $auth->add($product_index);
        $product_update = $auth->createPermission('product/update');
        $auth->add($product_update);
        $product_delete = $auth->createPermission('product/delete');
        $auth->add($product_delete);
        $product_view = $auth->createPermission('product/view');
        $auth->add($product_view);
        $product_create = $auth->createPermission('product/create');
        $auth->add($product_create);


        $product_permission = $auth->createPermission('จัดการข้อมูลสินค้า');
        $product_permission->description = "สิทธิ์ใช้งานโมดูลสินค้า";
        $auth->add($product_permission);

        $auth->addChild($product_permission,$product_index);
        $auth->addChild($product_permission,$product_view);
        $auth->addChild($product_permission,$product_update);
        $auth->addChild($product_permission,$product_delete);
        $auth->addChild($product_permission,$product_create);


        $manage_product = $auth->createRole('ผู้จัดการข้อมูลสินค้า');
        $manage_product->description = "บริหารจัดการข้อมูลสินค้า";
        $auth->add($manage_product);
        $auth->addChild($manage_product,$product_permission);



        //sale module
        $sale_index = $auth->createPermission('sale/index');
        $auth->add($sale_index);
        $sale_update = $auth->createPermission('sale/update');
        $auth->add($sale_update);
        $sale_delete = $auth->createPermission('sale/delete');
        $auth->add($sale_delete);
        $sale_view = $auth->createPermission('sale/view');
        $auth->add($sale_view);
        $sale_create = $auth->createPermission('sale/create');
        $auth->add($sale_create);
        $sale_finditem = $auth->createPermission('sale/finditem');
        $auth->add($sale_finditem);
        $sale_printbill = $auth->createPermission('sale/printbill');
        $auth->add($sale_printbill);


        $sale_permission = $auth->createPermission('จัดการข้อมูลขาย');
        $sale_permission->description = "สิทธิ์ใช้งานโมดูล sale";
        $auth->add($sale_permission);


        $auth->addChild($sale_permission,$sale_index);
        $auth->addChild($sale_permission,$sale_view);
        $auth->addChild($sale_permission,$sale_update);
        $auth->addChild($sale_permission,$sale_delete);
        $auth->addChild($sale_permission,$sale_create);
        $auth->addChild($sale_permission,$sale_finditem);
        $auth->addChild($sale_permission,$sale_printbill);


        $manage_sale = $auth->createRole('ผู้จัดการเมนูขาย');
        $manage_sale->description = "บริหารจัดการรายการขาย";
        $auth->add($manage_sale);
        $auth->addChild($manage_sale,$sale_permission);


        //warehouse module
        $warehouse_index = $auth->createPermission('warehouse/index');
        $auth->add($warehouse_index);
        $warehouse_update = $auth->createPermission('warehouse/update');
        $auth->add($warehouse_update);
        $warehouse_delete = $auth->createPermission('warehouse/delete');
        $auth->add($warehouse_delete);
        $warehouse_view = $auth->createPermission('warehouse/view');
        $auth->add($warehouse_view);
        $warehouse_create = $auth->createPermission('warehouse/create');
        $auth->add($warehouse_create);

        $warehouse_permission = $auth->createPermission('จัดการข้อมูลคลังสินค้า');
        $warehouse_permission->description = "สิทธิ์ใช้งานโมดูล warehouse";
        $auth->add($warehouse_permission);

        $auth->addChild($warehouse_permission,$warehouse_index);
        $auth->addChild($warehouse_permission,$warehouse_view);
        $auth->addChild($warehouse_permission,$warehouse_update);
        $auth->addChild($warehouse_permission,$warehouse_delete);
        $auth->addChild($warehouse_permission,$warehouse_create);

        $manage_warehouse = $auth->createRole('ผู้จัดการคลังสินค้า');
        $manage_warehouse->description = "Manage message";
        $auth->add($manage_warehouse);
        $auth->addChild($manage_warehouse,$warehouse_permission);

        //report module
        $report_index = $auth->createPermission('report/index');
        $auth->add($report_index);
//        $warehouse_update = $auth->createPermission('warehouse/update');
//        $auth->add($warehouse_update);
//        $warehouse_delete = $auth->createPermission('warehouse/delete');
//        $auth->add($warehouse_delete);
//        $warehouse_view = $auth->createPermission('warehouse/view');
//        $auth->add($warehouse_view);
//        $warehouse_create = $auth->createPermission('warehouse/create');
//        $auth->add($warehouse_create);

//        $report_permission = $auth->createPermission('report module');
//        $report_permission->description = "สิทธิ์ใช้งานโมดูล warehouse";
//        $auth->add($report_permission);
//
//        $auth->addChild($warehouse_permission,$report_index);
//
//
//        $manage_report = $auth->createRole('Manage report');
//        $manage_report->description = "Manage report";
//        $auth->add($manage_report);
//        $auth->addChild($manage_report,$report_permission);





        $admin_role = $auth->createRole('System Administrator');
        $admin_role->description = "ผู้ดูแลระบบ";
        $auth->add($admin_role);

        $auth->addChild($admin_role,$manage_plant);
        $auth->addChild($admin_role,$manage_user);
        $auth->addChild($admin_role,$manage_usergroup);
        $auth->addChild($admin_role,$manage_product);
        $auth->addChild($admin_role,$manage_sale);
        //$auth->addChild($admin_role,$manage_employee);
        $auth->addChild($admin_role,$manage_warehouse);



        $user_role = $auth->createRole('System User');
        $user_role->description = "ผู้ใช้งานทั่วไป";
        $auth->add($user_role);


        $auth->addChild($user_role,$manage_product);




        $auth->assign($admin_role,1);
      //  $auth->assign($user_role,2);






    }
}
