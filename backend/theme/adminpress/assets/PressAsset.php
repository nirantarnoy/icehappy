<?php
namespace app\assets;

use yii\web\AssetBundle;

class PressAsset extends AssetBundle{
    public $sourcePath = '@adminpress/dist';
    public $css = [
        'plugins/assets/plugins/bootstrap/css/bootstrap.min.css',
        'plugins/assets/plugins//morrisjs/morris.css',
        'css/style.css',
        'css/colors/blue.css'
    ];

    public $js = [
        'plugins/jquery/jquery.min.js',
        'plugins/bootstrap/js/popper.min.js',
        'plugins/bootstrap/js/bootstrap.min.js',
        'plugins/sparkline/jquery.sparkline.min.js',
        'plugins/raphael/raphael-min.js',
        'plugins/sticky-kit-master/dist/sticky-kit.min.js',
        'plugins/morrisjs/morris.min.js',
        'plugins/styleswitcher/jQuery.style.switcher.js',
        'plugins/jquery/jquery.min.js',
        'js/jquery.slimscroll.js',
        'js/waves.js',
        'js/sidebarmenu.js',
        'js/custom.min.js',
        'js/dashboard1.js',
        //  'js/jasny-bootstrap.js'
    ];

    public $depends = [
        'backend\assets\AppAsset',
        //'yii\web\YiiAsset',
        //'yii\bootstrap\BootstrapAsset',
        //'agency\assets\FontAwesomeAsset'
    ];
}
