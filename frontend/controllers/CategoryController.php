<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2016/12/8
 * Time: 15:56
 */

namespace frontend\controllers;
use common\models\Category;
use common\models\User;
use frontend\models\PersonInfo;
use frontend\models\UploadForm;
use yii;

use common\models\Album;
use yii\base\Controller;
use yii\helpers\Json;

class CategoryController extends Controller
{
    /**
     * 照片列表
     */
    public function actionList(){
        //设置returnURL
        Yii::$app->user->setReturnUrl(Yii::$app->urlManager->createUrl(['category/list']));
        $ret=array();
        if (!Yii::$app->user->isGuest)
        {
            $uploadModel=new UploadForm();
            $uploadModel->clearPhoto();
            $user_id=Yii::$app->user->getId();
            $person=PersonInfo::find()->where(['user_id'=>$user_id])->one();
            $ret['person']=$person;
        }else
        {
            $ret['person']='';
        }
        $model=new Category();
        $cat=$model->getTree();
        $ret['cat']=$cat;
        return $this->render('list',$ret);
    }
    /**
     * AJAX照片分类
     */
    public function actionAjaxCat()
    {
        if(Yii::$app->request->isAjax)
        {
            if(Yii::$app->request->isGet)
            {
                $arr=array();
                $odby=array();
                $where=array();
                $page=1;
                //获取页码
                if(Yii::$app->request->get('page'))
                {
                    $page=Yii::$app->request->get('page');
                }
                if(Yii::$app->request->get('cat'))
                {
                    //获取分类id
                    $cat_id=Yii::$app->request->get('cat');
                    if($cat_id!=-1)
                    {
                        //查询子分类ID
                        $son=Category::find()
                            ->where(['parent_id'=>$cat_id])
                            ->select('id')
                            ->asArray()
                            ->all();
                        array_push($son,['id'=>$cat_id]);
                        //遍历合并父级分类和子分类id
                        foreach ($son as $v)
                        {
                            $arr[]=(int)$v['id'];
                        }
                        if(Yii::$app->request->get('m'))
                        {
                            $m = Yii::$app->request->get('m');
                            if ($m == 3)
                            {
                                $where = ['in', 'album.cat_id', $arr];
                                $odby = ['release_time' => SORT_DESC, 'recommend' => SORT_DESC];
                            }
                            elseif ($m == 2)
                            {
                                $where = ['and', 'recommend=1', ['in', 'album.cat_id', $arr]];
                                $odby = ['release_time' => SORT_DESC];
                            }
                            elseif ($m == 1)
                            {
                                $where = ['in', 'album.cat_id', $arr];
                                $odby = ['release_time' => SORT_DESC];
                            }
                            else
                            {
                                $where = ['in', 'album.cat_id', $arr];
                                $odby = ['release_time' => SORT_DESC, 'recommend' => SORT_DESC];
                            }
                        }
                    }else
                    {
                        if(Yii::$app->request->get('m'))
                        {
                            $m = Yii::$app->request->get('m');
                            if ($m == 3)
                            {
                                $where = [];
                                $odby = ['recommend' => SORT_DESC,'release_time' => SORT_DESC];
                            } elseif ($m == 2)
                            {
                                $where = ['recommend'=>'1'];
                                $odby = ['release_time' => SORT_DESC];
                            } elseif ($m == 1)
                            {
                                $where = [];
                                $odby = ['release_time' => SORT_DESC];
                            } else
                            {
                                $where = ['in', 'album.cat_id', $arr];
                                $odby = ['release_time' => SORT_DESC, 'recommend' => SORT_DESC];
                            }
                        }
                    }
                    //查询分类下所有结果
                    $album=Album::find()
                        ->with('user.person_info')
                        ->with('photo.like_bylike')
                        ->orderBy($odby)
                        ->where($where)
                        ->asArray()
                        ->offset(($page-1)*20)
                        ->limit(20)
                        ->all();
                    //查询分类下数据总条数
                    $count=Album::find()
                        ->with('user')
                        ->orderBy($odby)
                        ->where($where)
                        ->asArray()
                        ->count();
                    $ret=[
                        'album'=>$album,
                        'hostInfo'=>Yii::$app->request->hostInfo,
                        'count'=>$count,
                    ];
                    return Json::encode($ret);
                }else
                {
                    $arr=['message'=>'失败'];
                    return Json::encode($arr);
                }

            }
        }
    }
}