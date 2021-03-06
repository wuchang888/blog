<?php
/**
 * Created by PhpStorm.
 * User: 95
 * Date: 2018/10/25
 * Time: 19:29
 */


/* @var $this yii\web\View */

$this->title = '创建';
$this->params['breadcrumbs'][] = ['label' =>'文章','url'=>['post/index']];	#面包屑 对于数据的封装
$this->params['breadcrumbs'][] = $this->title;
// use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
// use frontend\assets\AppAsset;
// AppAsset::register($this);
?>


<div class="row">
    <div class="col-lg-9">
        <div class="panel-title box-title">
            <span>创建文章</span>
        </div>
        <div class="panel-body">
            <?php $form = ActiveForm::begin() ?>


            <?= $form->field($model,'title')->textinput(['maxlength'=>true]) ?>
            <?= $form->field($model,'cat_id')->dropDownList($cats) ?>
            <!--   <?//= $form->field($model,'label_img')->textinput(['maxlength'=>true]) ?> -->
            <?= $form->field($model, 'label_img')->widget('common\widgets\file_upload\FileUpload',[
                'config'=>[
                    //图片上传的一些配置，不写调用默认配置
//                    'domain_url' => 'http://www.yii-china.com',
                ]
            ]) ?>
            <?= $form->field($model, 'content')->widget('common\widgets\ueditor\Ueditor',[
                'options'=>[
                    'initialFrameWidth' => 850,
                ]
            ]) ?>

            <?= $form->field($model,'tags')->widget('common\widgets\tags\TagWidget') ?>


            <div class="form-group">
                <?=Html::submitButton('发布',['class'=>'btn btn-success'])?>
            </div>
            <?php ActiveForm::end() ?>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="panel-title box-title">
            <span>注意事项</span>
        </div>
        <div class="panel-body">
            <p>1.2313213</p>
            <p>2.3213213</p>
        </div>
    </div>
</div>
