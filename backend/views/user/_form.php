<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use toxor88\switchery\Switchery;
use yii\helpers\ArrayHelper;
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
            <select name="select_group" class="form-control" id="">

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
            <div class="form-group group-role" style="background: #F0F0F0;padding-top: 20px;">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">สิทธิ์ใช้งาน
                </label>
                <div class="container">
                    <table>
                        <?php
                        $item = $model->getAllRoles();


                        foreach($item as $value):
                            //echo $item[0];return;
                            ?>
                            <?php if($model->isNewRecord):?>
                            <tr>
                                <td style="vertical-align: middle;">
                                    <input type="hidden" name="select_item" class="select_item" value="">
                                    <!--                                               <input type="hidden" name="select_item_qty" class="select_item_qty" value="">-->
                                    <input type="checkbox" value="<?=$value?>" id="item_checkbox_<?=$value?>" name="" class="filled-in chk-col-cyan" onchange="enableqty($(this));" />
                                    <label for="item_checkbox_<?=$value?>"><?=$value?></label>
                                </td>
                            </tr>
                        <?php else:?>
                            <?php
                            $checked = '';
                            $disabled = 'disabled';
                            $checked_qty = '';
                            $old_select = '';
                            $checked_item = '';
                            $l = 0;
                            ?>
                        <?php endif;?>
                        <?php endforeach;?>
                    </table>
                </div>

            </div>

            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>


</div>
<?php
$js=<<<JS
var item_list = [];
   $(function(){
    
   });
function enableqty(e){
    item_list.push(e.val());
    
      //alert(item_list);
    $(".select_item").val(item_list);

  }
JS;
$this->registerJs($js,static::POS_END);
?>
