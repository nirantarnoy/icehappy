<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use toxor88\switchery\Switchery;
/* @var $this yii\web\View */
/* @var $model backend\models\user */
/* @var $form yii\widgets\ActiveForm */
$usergroup = \backend\models\Usergroup::find()->all();
?>

<div class="user-form">
    <div class="card">
        <div class="card-body">
            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'username')->textInput()->label() ?>
            <p><?=Yii::t('app','กลุ่มผู้ใช้');?></p>
            <select name="customer_group" class="form-control" id="">

                <?php foreach ($usergroup as $value):?>
                    <?php
                    $select = '';
                    if($model->group_id == $value->id){$select = "selected";}
                    ?>
                    <option value="<?=$value->id?>" <?=$select?>><?=$value->name?></option>
                <?php endforeach;?>

            </select>
            <br>
            <br>
            <?php echo $form->field($model, 'status')->widget(Switchery::className(),['options'=>['label'=>'','class'=>'form-control']])->label() ?>


            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>


</div>
<?php
$js=<<<JS
   $(function(){
    
   });
JS;
$this->registerJs($js,static::POS_END);
?>
