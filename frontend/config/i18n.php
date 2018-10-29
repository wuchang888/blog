<?php
/**
 * Created by PhpStorm.
 * User: 95
 * Date: 2018/10/23
 * Time: 19:59
 */
return [

    'translations' => [
        '*' => [
            'class' => 'yii\i18n\PhpMessageSource',
            'fileMap' => [
                'common' => 'common.php' //可以加多个，是yii::t里面的第一个参数名
            ],
         //   'basePath' => '/message', //配置语言文件路径，现在采用默认的，就可以不配置这个
        ],
    ],

];