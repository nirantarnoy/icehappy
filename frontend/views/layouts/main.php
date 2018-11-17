<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body>
    <?php $this->beginBody() ?>

    <div class="wrap">

        <?php
        NavBar::begin([
            'brandLabel' => 'eOffice',
            'renderInnerContainer' => false,
            'options' => [
                'class' => 'navbar navbar-dark bg-primary navbar-expand-md'
            ]
        ]);
        $menuItems = [
            ['label' => 'หน้าหลัก', 'url' => ['/site/index']],
            ['label' => 'เกี่ยวกับ', 'url' => ['/site/about']],
            ['label' => 'ติดต่อ', 'url' => ['/site/contact']],
        ];
        if (Yii::$app->user->isGuest) {
            $menuItems[] = ['label' => 'สมัครสมาชิก', 'url' => ['/site/signup']];
            $menuItems[] = ['label' => 'เข้าสู่ระบบ', 'url' => ['/site/login']];
        } else {
            $menuItems[] = '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'ออกจากระบบ (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>';
        }
        echo Nav::widget([
            'items' => $menuItems,
        ]);
        NavBar::end();
        ?>

        <div class="container-fluid">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                'tag' => 'ol',
                'itemTemplate' => "<li class=\"breadcrumb-item\">{link}</li>\n",
                'activeItemTemplate' => "<li class=\"breadcrumb-item active\">{link}</li>\n"
            ]) ?>
            <?= Alert::widget() ?>
             <?= $content ?>
        </div>
    </div>

    <footer class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-6">
                    &copy; หน่วยงานของฉัน <?= date('Y') ?>
                </div>
                <div class="col-6 text-right">
                    <?=Html::a('HanumanIT Co., Ltd.', 'https://hanumanit.co.th', ['target' => '_blank', 'title' => 'พัฒนาโดย บริษัท หนุมานไอที จำกัด'])?>
                </div>
            </div>

        </div>
    </footer>

    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>
