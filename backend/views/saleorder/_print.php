<?php
?>
<table>
    <tr>
        <td><h2>เขตขาย <?=$query_sale[0]['zone_code']." ".$query_sale[0]['description']?></h2></td>
        <td><h2>วันที่ <?=$query_sale[0]['sale_date']?></h2></td>
    </tr>
</table>
<table class="table table_bordered table-list">
    <thead>
    <tr>
        <td colspan="2"></td>
        <td colspan="3" style="text-align: center">น้ำแข็งหลอดใหญ่</td>
        <td colspan="3" style="text-align: center">น้ำแข็งหลอดเล็ก</td>
        <td colspan="3" style="text-align: center">น้ำแข็งบด</td>
        <td colspan="3" style="text-align: center">น้ำแข็งแพ็ค</td>
        <td colspan="3"></td>
    </tr>
    <tr>
        <td rowspan="2" style="vertical-align: middle;text-align: center;">รหัส</td>
        <td rowspan="2" style="vertical-align: middle;text-align: center;">ชื่อร้านค้า</td>
        <td rowspan="2" style="vertical-align: middle;text-align: center;">จำนวน</td>
        <td rowspan="2" style="vertical-align: middle;text-align: center;">ราคา</td>
        <td rowspan="2" style="vertical-align: middle;text-align: center;">รวมเงิน</td>
        <td rowspan="2" style="vertical-align: middle;text-align: center;">จำนวน</td>
        <td rowspan="2" style="vertical-align: middle;text-align: center;">ราคา</td>
        <td rowspan="2" style="vertical-align: middle;text-align: center;">รวมเงิน</td>
        <td rowspan="2" style="vertical-align: middle;text-align: center;">จำนวน</td>
        <td rowspan="2" style="vertical-align: middle;text-align: center;">ราคา</td>
        <td rowspan="2" style="vertical-align: middle;text-align: center;">รวมเงิน</td>
        <td rowspan="2" style="vertical-align: middle;text-align: center;">จำนวน</td>
        <td rowspan="2" style="vertical-align: middle;text-align: center;">ราคา</td>
        <td rowspan="2" style="vertical-align: middle;text-align: center;">รวมเงิน</td>
        <td colspan="2" style="text-align: center;">แถม</td>
        <td></td>
    </tr>
    <tr>

        <td style="text-align: center;">ญ</td>
        <td style="text-align: center;">ล</td>
        <td></td>
    </tr>
    </thead>
    <tbody>
    <?php for ($i=0;$i<=count($query)-1;$i++):?>
        <?php //$i+=1;?>
        <?php //$i+=1;
        $qty_big = '';
        $qty_small = '';

        if(count($modelfree)){
            $qty_big = $modelfree[$i]['customer_id']==$query[$i]['customer_id']?$modelfree[$i]['qty_big']:'';
            $qty_small = $modelfree[$i]['customer_id']==$query[$i]['customer_id']?$modelfree[$i]['qty_small']:'';
        }
        ?>
        <tr>
            <td>
                <?=$query[$i]['code']?>

            </td>
            <td style="width: 15%"><?=$query[$i]['first_name']." ".$query[$i]['last_name']?></td>
            <td style="text-align: right">
                <?=$query[$i]['qty1']?>
            </td>
            <td style="text-align: right">
                <?=number_format($query[$i]['price1'],1)?>
            </td>
            <td style="text-align: right">
                <?=number_format($query[$i]['total1'],1)?>
            </td>
            <td style="text-align: right">
                <?=$query[$i]['qty2']?>
            </td >
            <td style="text-align: right">
                <?=number_format($query[$i]['price2'],1)?>
            </td>
            <td style="text-align: right">
                <?=number_format($query[$i]['total2'],1)?>
            </td>
            <td style="text-align: right">
                <?=$query[$i]['qty3']?>
            </td>
            <td style="text-align: right">
                <?=number_format($query[$i]['price3'],1)?>
            </td>
            <td style="text-align: right">
                <?=number_format($query[$i]['total3'],1)?>
            </td>
            <td style="text-align: right">
                <?=$query[$i]['qty4']?>
            </td>
            <td style="text-align: right">
                <?=number_format($query[$i]['price4'],1)?>
            </td>
            <td style="text-align: right">
                <?=number_format($query[$i]['total4'],1)?>
            </td>
            <td>
                <?=$qty_big?>
            </td>
            <td>
                <?=$qty_small?>
            </td>
        </tr>
    <?php endfor;?>

    </tbody>
    <tfoot>
    <tr style="font-weight: bold">
        <td colspan="2" style="text-align: right">รวมทั้งหมด</td>
        <td style="text-align: center;background-color: #9cc2cb;text-align: right">
            <?=$query2[0]['qty1']?>
        </td>
        <td style="text-align: center"></td>
        <td style="text-align: center;background-color: #9cc2cb;text-align: right">
            <?=number_format($query2[0]['total1'],1)?>
        </td>
        <td style="text-align: center;background-color: #9cc2cb;text-align: right">
            <?=$query2[0]['qty2']?>
        </td>
        <td style="text-align: center"></td>
        <td style="text-align: center;background-color: #9cc2cb;text-align: right">
            <?=number_format($query2[0]['total2'],1)?>
        </td>
        <td style="text-align: center;background-color: #9cc2cb;text-align: right">
            <?=$query2[0]['qty3']?>
        </td>
        <td style="text-align: center"></td>
        <td style="text-align: center;background-color: #9cc2cb;text-align: right">
            <?=number_format($query2[0]['total3'],1)?>
        </td>
        <td style="text-align: center;background-color: #9cc2cb;text-align: right">
            <?=$query2[0]['qty4']?>
        </td>
        <td style="text-align: center"></td>
        <td style="text-align: center;background-color: #9cc2cb;text-align: right">
            <?=number_format($query2[0]['total4'],1)?>
        </td>
        <td style="text-align: center;background-color: #9cc2cb;text-align: right">
            <?php if(count($query3)){
                echo $query3[0]['total_big'];
                }
                ?>
        </td>
        <td style="text-align: center;background-color: #9cc2cb;text-align: right">
            <?php if(count($query3)){
                echo $query3[0]['total_small'];
            }
            ?>
        </td>
        <td style="text-align: center"></td>
    </tr>
    </tfoot>
</table>

<table class="table_footer">
    <tr>
        <td>
            .................................... <br />
            ผู้ส่งเงิน
        </td>
        <td>
            .................................... <br />
            ผู้ตรวจและรับเงิน
        </td>

    </tr>
</table>
