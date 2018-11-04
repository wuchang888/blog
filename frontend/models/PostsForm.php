<?php
/**
 * Created by PhpStorm.
 * User: 95
 * Date: 2018/10/25
 * Time: 20:55
 */

namespace frontend\models;

use yii\base\Model;
use Yii;
use common\models\PostsModel;
use Exception;

class PostsForm extends Model

{



    public $id;
    public $title;
    public $content;
    public $label_img;
    public $cat_id;
    public $tags;


    public $_lastError ="";


    public function rules()
    {
        return [
            [['title','content','cat_id','label_img'],'required'],// 数据库里面需要的 这里必须些人 不然拿不到值
            [['id','cat_id'],'integer'],
            ['title','string','min'=>4,'max'=>50],
        ];
    }



    public function attributeLabels()
    {
        return [
            'id'=>'编号',
            'title'=>'标题',
            'content'=>'内容',
            'label_img'=>'标签图',
            'tags'=>'标签',
            'cat_id'=>'分类',
        ];
    }
    /**
     * 用常量定义场景
     * SCENARIOS_CREATE 创建    音标  [sɪ'nɑ:ri:əʊz]
     * SCENARIOS_UPDATE 更新
     * 场景的应用就是限制了所应用的字段 可以自行调整
     */
    const SCENARIOS_CREATE = 'create';
    const SCENARIOS_UPDATE = 'update';

    /**
     * 场景设置
     */
    public function scenarios()
    {
        $scenarios = [
            self::SCENARIOS_CREATE => ['title', 'content', 'label_img', 'cat_id', 'tags'],
            self::SCENARIOS_UPDATE => ['title', 'content', 'label_img', 'cat_id', 'tags'],
        ];
        return array_merge(parent::scenarios(), $scenarios);
        //继承了default的场景 将继承的场景覆盖合并到现在的场景中去。
    }

    /**
     *	文章创建
     *	主旨思想 ：运用数据库的事物、 数据处理放到PostsModel、业务逻辑放到PostsForm中
     *	transaction 英文翻译 ’交易‘
     *
     *
     *	事件 运用的是’观察者‘的模式
     */
    public function create()
    {
        $transaction = Yii::$app->db->beginTransaction();
        try {

            $model = new PostsModel();	# 引入 common\models\PostsModel
         //  var_dump($this->attributes);die;
         //  var_dump($this->label_img);die; 这里输出 null  需要在rule require label_img
            $model->setAttributes($this->attributes);#当前有的数据放到新的里面去，可能字段不够 所以下面要加数据字段值
            $model->summary = $this->_getSummary();	# 内容
            $model->user_id = Yii::$app->user->identity->id;	# 获取当前登录的用户id
            $model->user_name = Yii::$app->user->identity->username;# 获取当前登录的用户名称
            $model->is_valid = PostsModel::IS_VALID;	# 是否发布   备注 字段属性之类的东西最好就用常量去实现
            $model->created_at = time();	# 创建时间
            $model->updated_at = time();	# 更新时间

            if (!$model->save()) {
                throw new Exception("文章保存失败！");	# 可以用语言包
            }

            $this->id = $model->id;	# 如果成功 将数据所插入的id返回给控制层 渲染查看当前的页面

// 调用事件
            $this->_eventAfterCreate();	# 运用事件是因为 文章创建完后还有有其他的事件所要去完成   比如文章创建完成之后要添加一些积分 所以要后续在此事件中去完成
            $transaction->commit();

            return true;


        } catch (Exception $e) {
            $transaction->rollBack();
            $this->_lastError = $e->getMessage();
            return false;
        }
    }


    /**
     *	截取文章摘要
     *
     */
    private function _getSummary($s = 0,$e = 90,$char = 'utf-8'){
        if (empty($this->content)) {
            return null;
        }else{
            return (mb_substr(str_replace('&nbsp;','',strip_tags($this->content)),$s,$e,$char));
        }
    }


    /**
     *	创建完成之后调用事件方法
     *
     */


    public function _eventAfterCreate()
    {

    }


}