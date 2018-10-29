<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
       //  'css/site.css', 资源移动了位置
        'static/css/site.css',     #此处的目录结构就是在页面引入样式的路径
        'static/css/font-awesome-4.4.0/css/font-awesome.min.css' // 图片icon
    ];
    public $js = [
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
