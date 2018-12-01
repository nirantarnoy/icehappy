<?php
/**
 * Created by PhpStorm.
 * User: niran.w
 * Date: 01/12/2018
 * Time: 16:39:38
 */
$this->title = "Create Saleorder";
$sale_zone = \backend\models\Salezone::find()->asAray()->all();

?>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-3">
                        <label for="">Payment Method</label>
                        <select name="sale_zone" class="form-control" id="">
                            <?php for($i=0;$i<=count($sale_zone)-1;$i++):?>
                                <?php
                                $select = '';
                                if($model->sale_zone == $sale_zone[$i]['id']){$select = "selected";}
                                ?>
                                <option value="<?=$sale_zone[$i]['id']?>" <?=$select?>><?=$sale_zone[$i]['name']?></option>
                            <?php endfor;?>

                        </select>
                    </div>
                    <div class="col-lg-3">
                        <input type="text" class="form-control" name="">
                    </div>
                    <div class="col-lg-3"></div>
                    <div class="col-lg-3"></div>
                    <div class="col-lg-3"></div>
                </div>
            </div>
        </div>
    </div>
</div>
