<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
//use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use lavrentiev\widgets\toastr\Notification;
use yii\helpers\Url;

use common\models\Province;
use common\models\Amphur;
use common\models\District;
use backend\assets\AppAsset;
/* @var $this yii\web\View */
/* @var $model backend\models\Plant */
/* @var $form yii\widgets\ActiveForm */

$prov = Province::find()->all();
$amp = Amphur::find()->all();
$dist = District::find()->all();

AppAsset::register($this);

$url_to_findcity = Url::to(['plant/showcity'],true);
$url_to_finddistrict = Url::to(['plant/showdistrict'],true);
$url_to_findzipcode = Url::to(['plant/showzipcode'],true);
$js=<<<JS

   $(function(){
      
   });

  function findCity(e){
        $.post("$url_to_findcity" +"&id="+e.val(),function(data){
             $("select#city").html(data);
             $("select#city").prop("disabled","");

        });
                                          
  }
  function findDistrict(e){
        $.post("$url_to_finddistrict"+"&id="+e.val(),function(data){
             $("select#district").html(data);
             $("select#district").prop("disabled","");
        });
        $.post("$url_to_findzipcode"+"&id="+e.val(),function(data){
            $("#zipcode").val(data);
        });
                                          
  }
  
JS;
$this->registerJs($js,static::POS_END);

?>

<?php $session = Yii::$app->session;
if ($session->getFlash('msg')): ?>
    <!-- <div class="alert alert-success alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <?php //echo $session->getFlash('msg'); ?>
      </div> -->
    <?php echo Notification::widget([
        'type' => 'success',
        'title' => 'แจ้งผลการทำงาน',
        'message' => $session->getFlash('msg'),
        //  'message' => 'Hello',
        'options' => [
            "closeButton" => false,
            "debug" => false,
            "newestOnTop" => false,
            "progressBar" => false,
            "positionClass" => "toast-top-center",
            "preventDuplicates" => false,
            "onclick" => null,
            "showDuration" => "300",
            "hideDuration" => "1000",
            "timeOut" => "6000",
            "extendedTimeOut" => "1000",
            "showEasing" => "swing",
            "hideEasing" => "linear",
            "showMethod" => "fadeIn",
            "hideMethod" => "fadeOut"
        ]
    ]); ?>
<?php endif; ?>
<div class="plant-form">
   <div class="card">
       <div class="card-body">
           <?php $form = ActiveForm::begin(); ?>

           <div class="row">
               <div class="col-lg-6">
                   <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
               </div>
               <div class="col-lg-6">
                   <?= $form->field($model, 'short_name')->textInput(['maxlength' => true]) ?>
               </div>
           </div>
<div class="row">
    <div class="col-lg-6">
        <?= $form->field($model, 'eng_name')->textInput(['maxlength' => true]) ?>
    </div> <div class="col-lg-6">
        <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>
    </div>

</div>
           <div class="row">
               <div class="col-lg-6">
                   <?= $form->field($model, 'tax_id')->textInput(['maxlength' => true]) ?>
               </div> <div class="col-lg-6">
                   <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
               </div>

           </div>
           <div class="row">
               <div class="col-lg-6">
                   <?= $form->field($model, 'mobile')->textInput(['maxlength' => true]) ?>
               </div> <div class="col-lg-6">
                   <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
               </div>

           </div>
           <div class="row">
               <div class="col-lg-6">
                   <?= $form->field($model, 'website')->textInput(['maxlength' => true]) ?>
               </div> <div class="col-lg-6">
                   <?= $form->field($model, 'facebook')->textInput(['maxlength' => true]) ?>
               </div>

           </div>
           <div class="row">
               <div class="col-lg-6">
                   <?= $form->field($model, 'line')->textInput(['maxlength' => true]) ?>
               </div> <div class="col-lg-6">
                   <?= $form->field($model, 'logo')->fileInput(['maxlength' => true]) ?>
               </div>

           </div>



           <div class="row">
               <div class="col-lg-12">
                   <div class="form-group" style="margin-top: -10px">
                       <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"><?=Yii::t('app','ที่อยู่')?>
                       </label>
                       <div class="col-md-6 col-sm-6 col-xs-12">
                           <?= $form->field($model_address_plant?$model_address_plant:$model_address, 'address')->textarea(['maxlength' => true,'class'=>'form-control'])->label(false) ?>
                       </div>
                   </div>
                   <div class="form-group" style="margin-top: -10px">
                       <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"><?=Yii::t('app','ถนน')?>
                       </label>
                       <div class="col-md-6 col-sm-6 col-xs-12">
                           <?= $form->field($model_address_plant?$model_address_plant:$model_address, 'street')->textInput(['maxlength' => true,'class'=>'form-control'])->label(false) ?>
                       </div>
                   </div>
                   <div class="form-group" style="margin-top: -10px">
                       <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"><?=Yii::t('app','ตำบล')?>
                       </label>
                       <div class="col-md-6 col-sm-6 col-xs-12">
                           <select name="select_district" class="form-control" id="district" disabled>
                               <?php foreach ($dist as $value):?>
                                   <option value="<?=$value->DISTRICT_ID?>"><?=$value->DISTRICT_NAME?></option>
                               <?php endforeach;?>
                           </select>
                       </div>
                   </div>
                   <div class="form-group" style="margin-top: -10px">
                       <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"><?=Yii::t('app','อำเภอ')?>
                       </label>
                       <div class="col-md-6 col-sm-6 col-xs-12">
                           <select name="select_city" onchange="findDistrict($(this))" class="form-control" id="city" disabled>
                               <?php foreach ($amp as $value):?>
                                   <option value="<?=$value->AMPHUR_ID?>"><?=$value->AMPHUR_NAME?></option>
                               <?php endforeach;?>
                           </select>
                       </div>
                   </div>
                   <div class="form-group" style="margin-top: -10px">
                       <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"><?=Yii::t('app','จังหวัด')?>
                       </label>
                       <div class="col-md-6 col-sm-6 col-xs-12">

                           <select name="select_province" onchange="findCity($(this))" class="form-control" id="">
                               <?php foreach ($prov as $value):?>
                               <option value="<?=$value->PROVINCE_ID?>"><?=$value->PROVINCE_NAME?></option>
                               <?php endforeach;?>
                           </select>
                       </div>
                   </div>
                   <div class="form-group" style="margin-top: -10px">
                       <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"><?=Yii::t('app','รหัสไปรษณีย์')?>
                       </label>
                       <div class="col-md-6 col-sm-6 col-xs-12">
                           <?php if($model_address_plant):?>
                               <?= $form->field($model_address_plant, 'zipcode')->textInput(['class'=>'form-control','id'=>'zipcode','style'=>'width: 20%;','readonly'=>'readonly'])->label(false) ?>
                           <?php else:?>
                               <?= $form->field($model_address, 'zipcode')->textInput(['class'=>'form-control','id'=>'zipcode','style'=>'width: 20%;','readonly'=>'readonly'])->label(false) ?>
                           <?php endif;?>

                       </div>
                   </div>
               </div>
           </div>


           <div class="form-group">
               <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
           </div>


           <?php ActiveForm::end(); ?>
       </div>
   </div>


</div>

