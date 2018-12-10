<?php
//namespace backend\theme\adminpress\assets;
namespace backend\assets;

use yii\web\AssetBundle;

class PressAsset extends AssetBundle
{
    public $sourcePath = '@adminpress/dist';
    public $css = [
        'plugins/bootstrap/css/bootstrap.min.css',
        'plugins/morrisjs/morris.css',
        'plugins/dropify/dist/css/dropify.min.css',
        'css/style.css',
        'css/colors/blue.css',
        'plugins/sweetalert/sweetalert.css',
        'plugins/toast-master/css/jquery.toast.css',
        'plugins/bootstrap-daterangepicker/daterangepicker.css'

    ];

    public $js = [
        //'plugins/jquery/jquery.min.js',
        'plugins/bootstrap/js/popper.min.js',
        'plugins/bootstrap/js/bootstrap.min.js',
        'plugins/sparkline/jquery.sparkline.min.js',
        'plugins/raphael/raphael-min.js',
        'plugins/sticky-kit-master/dist/sticky-kit.min.js',
        'plugins/moment/moment.js',
        'plugins/styleswitcher/jQuery.style.switcher.js',
        'plugins/dropify/dist/js/dropify.min.js',
        'plugins/sweetalert/jquery.sweet-alert.custom.js',
        'plugins/sweetalert/sweetalert.min.js',
        'plugins/toast-master/js/jquery.toast.js',
        'plugins/bootstrap-daterangepicker/daterangepicker.js',
        'plugins/bootstrap-datepicker/bootstrap-datepicker.min.js',
        'plugins/bootstrap/js/popper.min.js',
        'plugins/sparkline/jquery.sparkline.min.js',
        'plugins/raphael/raphael-min.js',
        'plugins/morrisjs/morris.min.js',
       // 'plugins/jquery/jquery.min.js',
        'js/jquery.slimscroll.js',
        'js/waves.js',
        'js/sidebarmenu.js',
        'js/custom.min.js',
        'js/dashboard1.js',
        'js/dashboard4.js',
        'js/jasny-bootstrap.js',
        'js/toastr.js',
        'js/jquery.PrintArea.js'

    ];

    public $depends = [
        'backend\assets\AppAsset',
        //'yii\web\YiiAsset',
        //'yii\bootstrap\BootstrapAsset',
        //'agency\assets\FontAwesomeAsset'
    ];
}
