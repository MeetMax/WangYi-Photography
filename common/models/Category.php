<?php
namespace common\models;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;

/**
 * Login form
 */
class Category extends ActiveRecord
{

    public static function tableName()
    {
        return '{{%category}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['cat_name', 'parent_id'], 'required'],
        ];
    }
    static public function getTree($name='son',$pid=0)
    {
        $cat=Category::find()->asArray()->all();
        $arr = array();
        foreach ($cat as $v) {
            if ($v['parent_id'] == $pid) {
                $v[$name] = self::getTree( $name, $v['id']);
                $arr[] = $v;
            }
        }
        return $arr;
    }
    //获取所有子类
    public function getAllChild($parentID=0,$level=0)
    {
        static $ret=array();
        $cat=Category::find()->asArray()->all();
        foreach ($cat as $k=>$v)
        {
            if($v['parent_id']==$parentID)
            {
                $ret[]=$v;
                $this->getAllChild($v['id'],$level+1);
            }
        }
        return $ret;
    }
    //获取分类下所有子类
    public function getChild($id)
    {
        static $ret=array();
        $cat=Category::find()->all();
        foreach ($cat as $v)
        {
            if($id==$v->parent_id)
            {
                $ret[]=[$v->id=>$v->cat_name];
                $this->getChild($v->id);
            }
        }
        return $ret;
    }
    /**
     * 获取父级分类
     */
    public function getParent($id)
    {
        static $ret;
        $one=Category::find()->where(['id'=>$id])->one();
        $cat=Category::find()->all();
        foreach ($cat as $v)
        {
            if($one->parent_id==$v->id)
            {
               $ret=$v->id;
            }
        }
        return $ret;
    }
    /**
     * 根据id获取分类名称
     */
    public function getCatName($id)
    {
        return self::find()->where(['id'=>$id])->one();
    }
}
