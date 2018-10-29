<?php
/**
 * Created by PhpStorm.
 * User: 95
 * Date: 2018/10/25
 * Time: 19:22
 */
namespace frontend\controllers\base;

/**
 * 基础控制器
 */
use \yii\web\Controller;

class BaseController extends Controller
{

        public function beforeAction($action)
        {
            if (!parent::beforeAction($action)) {
                return false;
            }
            return true;
        }



}