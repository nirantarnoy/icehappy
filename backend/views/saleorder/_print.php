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
        <tr>
            <td>
                <?=$query[$i]['code']?>

            </td>
            <td style="width: 15%"><?=$query[$i]['first_name']." ".$query[$i]['last_name']?></td>
            <td style="text-align: right">
                <?=$query[$i]['qty1']?>
            </td>
            <td style="text-align: right">
                <?=$query[$i]['price1']?>
            </td>
            <td style="text-align: right">
                <?=$query[$i]['total1']?>
            </td>
            <td style="text-align: right">
                <?=$query[$i]['qty2']?>
            </td >
            <td style="text-align: right">
                <?=$query[$i]['price2']?>
            </td>
            <td style="text-align: right">
                <?=$query[$i]['total2']?>
            </td>
            <td style="text-align: right">
                <?=$query[$i]['qty3']?>
            </td>
            <td style="text-align: right">
                <?=$query[$i]['price3']?>
            </td>
            <td style="text-align: right">
                <?=$query[$i]['total3']?>
            </td style="text-align: right">
            <td>

            </td>
            <td></td>
            <td></td>
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
            <?=$query2[0]['total1']?>
        </td>
        <td style="text-align: center;background-color: #9cc2cb;text-align: right">
            <?=$query2[0]['qty2']?>
        </td>
        <td style="text-align: center"></td>
        <td style="text-align: center;background-color: #9cc2cb;text-align: right">
            <?=$query2[0]['total2']?>
        </td>
        <td style="text-align: center;background-color: #9cc2cb;text-align: right">
            <?=$query2[0]['qty3']?>
        </td>
        <td style="text-align: center"></td>
        <td style="text-align: center;background-color: #9cc2cb;text-align: right">
            <?=$query2[0]['total3']?>
        </td>
        <td style="text-align: center;background-color: #9cc2cb;text-align: right"></td>
        <td style="text-align: center;background-color: #9cc2cb;text-align: right"></td>
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
