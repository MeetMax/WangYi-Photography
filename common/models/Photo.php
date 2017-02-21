<?php
namespace common\models;

use frontend\models\Like;
use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;

/**
 * Login form
 */
class Photo extends ActiveRecord
{

    public static function tableName()
    {
        return '{{%photo}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['big_path'], 'required'],
        ];
    }
    public function saveInfo()
    {
        $user=(string)Yii::$app->user->getId();
        $cache=Yii::$app->cache->get($user);
        foreach ($cache  as $v)
        {
            //保存大图路径
            $this->big_path=$v['big_path'];
            //大图名字
            $this->big_name=$v['big_name'];
            //小图路径
            $this->sm_path=$v['sm_path'];
            //小图名字
            $this->sm_name=$v['sm_name'];
            //原图名字
            $this->ogn_name=$v['ogn_name'];
            //相机品牌
            $this->camera_brand= $v['camera_brand'];
            //相机型号
             $this->camera_model= $v['camera_model'];
            //焦距
             $this->focus= $v['focus'];
            //光圈
             $this->aperture=$v['aperture'];
            //快门速度
            $this->shutter_speed=$v['shutter_speed'];
            //感光度
             $this->iso=$v['iso'];
            //曝光补偿
             $this->exposure_compensation=$v['exposure_compensation'];
            //拍摄时间
             $this->shoot_time=$v['shoot_time'];
            //镜头
             $this->lens=$v['lens'];
            //所属作品id
            $this->album_id=Yii::$app->session->getFlash('album_id');
            //保存数据
            $this->save();
            $this->id=null;
            $this->setIsNewRecord(true);

        }
        return true;
    }
    /**
     * 关联like_bylike表
     */
    public function getLike_bylike()
    {
        return $this->hasMany(Like::className(),['photo_id'=>'id'] );
    }

}
