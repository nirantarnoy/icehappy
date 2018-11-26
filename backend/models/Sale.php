<?php
namespace backend\models;
use Yii;
use yii\db\ActiveRecord;
date_default_timezone_set('Asia/Bangkok');
class Sale extends \common\models\Sale{
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
    public function getLastNo($cusid){
        $model = \backend\models\Sale::find()->where(['customer_id'=>$cusid])->MAX('sale_no');
//        $pre = \backend\models\Sequence::find()->where(['module_id'=>$trans_type])->one();
        $prefix = '';
        if($model){
            $list = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','U','V','W','X','Y','Z'];

            $cnum = substr((string)$model,0,2); //01
            $char = substr((string)$model,2,1); // A
            $nums = substr((string)$model,3,2); //99
            $new_num = (int)$nums + 1;
            $last_num = '';
            $char_index = array_search($char,$list);
            if($new_num == 100){
                $prefix = $cnum.$list[($char_index + 1)].'01';
            }else{
                $last_num = strlen((string)$new_num)==1?"0".$new_num:$new_num;
             //   $prefix = $cnum.$char.strlen($new_num)==1?"0".$new_num:$new_num;
                $prefix = $cnum.$char.$last_num;
            }

//            $loop = $len - $clen;
//            for($i=1;$i<=$loop;$i++){
//                $prefix.="0";
//            }
//            $prefix.=$cnum + 1;
            return $prefix;
        }else{
            $zone_code = \backend\models\Custumer::find()->where(['id'=>$cusid])->one();
            if($zone_code){
                $prefix = \backend\models\Salezone::findName($zone_code->zone_id)."A01";
            }
            return $prefix;
        }
    }
}
