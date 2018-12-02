<?php
namespace backend\models;
use Yii;
use yii\db\ActiveRecord;
date_default_timezone_set('Asia/Bangkok');
class Custumer extends \common\models\Customer{
    public function behaviors()
    {
        return [
            'timestampcdate'=>[
                'class'=> \yii\behaviors\AttributeBehavior::className(),
                'attributes'=>[
                    ActiveRecord::EVENT_BEFORE_INSERT=>'created_at',
                ],
                'value'=> time(),
            ],
            'timestampudate'=>[
                'class'=> \yii\behaviors\AttributeBehavior::className(),
                'attributes'=>[
                    ActiveRecord::EVENT_BEFORE_INSERT=>'updated_at',
                ],
                'value'=> time(),
            ],
            'timestampcby'=>[
                'class'=> \yii\behaviors\AttributeBehavior::className(),
                'attributes'=>[
                    ActiveRecord::EVENT_BEFORE_INSERT=>'created_by',
                ],
                'value'=> Yii::$app->user->identity->id,
            ],
            'timestamuby'=>[
                'class'=> \yii\behaviors\AttributeBehavior::className(),
                'attributes'=>[
                    ActiveRecord::EVENT_BEFORE_UPDATE=>'updated_by',
                ],
                'value'=> Yii::$app->user->identity->id,
            ],
            'timestampupdate'=>[
                'class'=> \yii\behaviors\AttributeBehavior::className(),
                'attributes'=>[
                    ActiveRecord::EVENT_BEFORE_UPDATE=>'updated_at',
                ],
                'value'=> time(),
            ],
        ];
    }
    public function getLastNo($zoneid){
        $model = \backend\models\Custumer::find()->where(['zone_id'=>$zoneid])->MAX('code');
        $prefix = '';
        if($model){
            $zone_num = substr((string)$model,0,2); //01
            $zone_run = substr((string)$model,2,2); // 99
            $new_num = (int)$zone_run + 1;

            $new_runno = strlen((string)$new_num)==1?"0".$new_num:$new_num;

            $prefix = $zone_num.$new_runno;

            return $prefix;
        }else{

                $prefix = \backend\models\Salezone::findName($zoneid)."01";
        }
        return $prefix;

    }
    public function findprice($cus,$product){
        $model = \backend\models\Customerdetail::find()->where(['customer_id'=>$cus,'line_type'=>1,'itemid'=>$product])->one();
        return count($model)>0?$model->line_price:0;
    }
}
