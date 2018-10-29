<?php
/**
 * Created by PhpStorm.
 * User: 95
 * Date: 2018/10/25
 * Time: 19:26
 */

namespace frontend\controllers;


use frontend\controllers\base\BaseController;
use frontend\models\PostsForm;

class PostController extends  BaseController
{

    public function actionIndex(){

        return $this ->render('index');
    }

    public function actionCreate(){

        $model = new PostsForm();

        return $this->render('create',['model'=> $model]);

    }
}