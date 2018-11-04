<?php
/**
 * Created by PhpStorm.
 * User: 95
 * Date: 2018/10/25
 * Time: 19:26
 */

namespace frontend\controllers;

use Yii;
use common\models\CatsModel;
use frontend\controllers\base\BaseController;
use frontend\models\PostsForm;





use yii\filters\AccessControl;

use yii\filters\VerbFilter;

use common\models\PostExtends;


class PostController extends BaseController
{



    public function actions()
    {
        return [
            'upload' => [
                'class' => 'common\widgets\file_upload\UploadAction',     //这里扩展地址别写错
                'config' => [
                    'imagePathFormat' => "/image/{yyyy}{mm}{dd}/{time}{rand:6}",
                ]
            ],
            'ueditor' => [
                'class' => 'common\widgets\ueditor\UeditorAction',
                'config' => [
                    //上传图片配置
                    'imageUrlPrefix' => "",/*图片访问路径前缀*/
                    'imagePathFormat' => "/image/{yyyy}{mm}{dd}/{time}{rand:6}",/*上传保存路径,可以自定义保存路径和文件名格式*/
                ]
            ]

        ];
    }

    public function actionIndex()
    {

        return $this->render('index');
    }

    public function actionCreate()
    {

        $model = new PostsForm();
        //定义场景
        $model->scenarios(PostsForm::SCENARIOS_CREATE);
      // var_dump(Yii::$app->request->post());die;
        if($model->load(Yii::$app->request->post()) && $model ->validate()){

            if(!$model->create()){
                Yii::$app->session->setFlash('warning', $model -> _lastError);
            }else{

            return $this->redirect(['post/view', 'id' => $model->id]);
            }
        }

        
        // 获取所有文章标签
        $cats = CatsModel::getAllCats();


        return $this->render('create', ['model' => $model, 'cats' => $cats]);

    }


}