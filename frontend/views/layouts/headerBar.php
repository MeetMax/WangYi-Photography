<!-- 导航 start -->
<?php
    $user_id=Yii::$app->user->getId();
    $urlManager=Yii::$app->urlManager;
if(!Yii::$app->user->isGuest)
{
    $person=$this->params['breadcrumbs']['person'];
}
?>
<?php if(Yii::$app->user->isGuest){?>
<div class="ui-topbar">
    <div class="mask">
    </div>
    <div class="wrap">
        <h1 class="logo">
            <a href="<?=$urlManager->createUrl(['site/index'])?>" title="网易摄影广场" tabindex="1">
                <b class="logo-txt">
                    网易摄影
                </b>
                <b class="tip-square" title="返回摄影广场">
                </b>
            </a>
        </h1>
        <ul class="nav" id="ui-nav-list">
            <li class="nav-item nav-item-drop">
                <a href="<?=$urlManager->createUrl('category/list')?>" tabindex="2">
                    作品
                </a>
                <b class="arr">
                </b>
                <ul class="droplist">
                    <li>
                        <a href="<?=$urlManager->createUrl('category/list')?>#cat=-1&m=3&page=1">组图展区</a>
                    </li>
                    <li>
                        <a href="<?=$urlManager->createUrl('category/list')?>#cat=-1&m=3&page=1">单张展区</a>
                    </li>
                    <li>
                        <a href="<?=$urlManager->createUrl('category/list')?>#cat=-1&m=2&page=1">最受喜欢</a>
                    </li>
                    <li>
                        <a href="<?=$urlManager->createUrl('category/list')?>#cat=-1&m=2&page=1">社区精品</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="" tabindex="3">小镇</a>
            </li>
            <li class="nav-item">
                <a href="" tabindex="4">活动</a>
            </li>
            <li class="nav-item">
                <a href="" tabindex="5">拍客</a>
            </li>
            <li class="nav-item">
                <a href="" tabindex="6">器材</a>
            </li>
        </ul>
        <form action="http://pp.163.com/pp/searchpic/" class="search searchtip"
              method="get" id="np_top_search_form" onsubmit="return false">
            <div class="ui-4935164026 searchTopInput">
                <input class="zcom ztxt" type="text" tabindex="10" maxlength="20">
            </div>
            <input type="hidden" name="q" value="" id="top_searchInput">
            <button type="submit" tabindex="8">搜索</button>
        </form>
        <div class="user-logout">
            <a href="<?=$urlManager->createUrl(['site/login'])?>"
               tabindex="9" id="ui-nav-login">登录网易摄影
            </a>
            |
            <a href="<?=$urlManager->createUrl(['site/signup'])?>"
               target="_blank" tabindex="10">注册通行证
            </a>
        </div>
    </div>
</div>
<?php }else{?>

<div class="ui-topbar">
    <div class="mask">
    </div>
    <div class="wrap">
        <h1 class="logo">
            <a href="<?=$urlManager->createUrl('/')?>" title="网易摄影广场" tabindex="1">
                <b class="logo-txt">网易摄影</b>
                <b class="tip-square" title="返回摄影广场"></b>
            </a>
        </h1>
        <ul class="nav" id="ui-nav-list">
            <li class="nav-item nav-item-drop">
                <a href="<?=$urlManager->createUrl('category/list')?>#cat=-1&page=1" tabindex="2">作品</a>
                <b class="arr"></b>
                <ul class="droplist">
                    <li>
                        <a href="<?=$urlManager->createUrl('category/list')?>#cat=-1&m=3&page=1">组图展区</a>
                    </li>
                    <li>
                        <a href="<?=$urlManager->createUrl('category/list')?>#cat=-1&m=3&page=1">单张展区</a>
                    </li>
                    <li>
                        <a href="<?=$urlManager->createUrl('category/list')?>#cat=-1&m=2&page=1">最受喜欢</a>
                    </li>
                    <li>
                        <a href="<?=$urlManager->createUrl('category/list')?>#cat=-1&m=2&page=1">社区精品</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item"><a href="" tabindex="3">小镇</a></li>
            <li class="nav-item"><a href="" tabindex="4">活动</a></li>
            <li class="nav-item"><a href="" tabindex="5">拍客</a></li>
            <li class="nav-item"><a href="" tabindex="6">器材</a></li>
        </ul>
        <span class="m-createSethead m-createSethead-1" id="J-createSethead">
            <span class="createSet" title="发布作品">
                <b class="w-createSetico f-mr5"></b>
                <span class="fabu">发布</span>
            </span>
            <span class="w-createSetwin f-clear">
                <span class="createSetcontent f-clear">
                    <a href="<?=$urlManager->createUrl('share/index')?>" class="ui-ppbtn ui-ppbtn-grey">发单张</a>
                    <a href="<?=$urlManager->createUrl('share/index')?>" class="ui-ppbtn ui-ppbtn-grey f-ml10"
                       style="margin-left:10px;">发组图</a>
                </span>
                <div class="arrow">
                    <span class="arrow-out">
                        <span class="arrow-in">
                        </span>
                    </span>
                </div>
            </span>
        </span>
        <form action="" class="search searchtip"
              method="get" id="np_top_search_form" onsubmit="return false">
            <div class="ui-3198977361 searchTopInput">
                <input class="zcom ztxt" type="text" tabindex="10" maxlength="20">
                <div class="zcom zcse">
                </div>
            </div>
            <input type="hidden" name="q" value="" id="top_searchInput">
            <button type="submit" tabindex="8">搜索</button>
        </form>
        <div class="user-login">
            <div class="face nav-item" id="ui-nav-face">
                <a href="<?=$urlManager->createUrl(['home/index','id'=>$user_id])?>" title="看看我的最近动态和新鲜事" class="face-imglink">
                    <img src="<?=$person->head_img?>" alt="<?=$person->nickname?>">
                </a>
                <b class="arr">
                </b>
                <ul class="droplist">
                    <li><a href="<?=$urlManager->createUrl(['home/index','id'=>$user_id])?>">我的小屋</a></li>
                    <li><a href="">我的相册</a></li>
                    <li><a href="<?=$urlManager->createUrl(['setting/index','id'=>$user_id])?>">个人设置</a></li>
                    <li><a href="" target="_blank">反馈</a></li>
                    <li><a href="<?=$urlManager->createUrl(['site/logout'])?>" id="ui-nav-logout">退出</a></li>
                </ul>
            </div>
            <div class="user-msg">
                <a href="" title="信箱"
                   class="msg" id="ui-nav-msg">
                    0
                </a>
                <div class="tips" id="ui-nav-msgbox" style="display:none;">
                    <a href="javascript:;" class="z-tag close">
                    </a>
                    <span class="arrow">
                    </span>
                    <div class="z-tag cnt">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php }?>
<!-- 导航 end -->
<!-- 导航 end -->