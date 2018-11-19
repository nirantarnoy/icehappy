<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class TemplateAsset extends AssetBundle
{
    public $basePath = '@template/dist';
    public $baseUrl = '@web';
    public $css = [
        'css/bootstrap.min.css',
        'css/vendor.css',
        'css/style.css',
        'css/custom.css',
    ];
    public $js = [
        'js/vendor/html5shiv.min.js',
        'js/vendor/jquery-1.11.3.min.js',
        'js/vendor/bootstrap.min.js',
        'js/vendor/plugin.js',
        'js/variable.js',
       // 'js/map.js',
        'js/main.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapAsset',
    ];
}
