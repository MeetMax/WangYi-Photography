网易摄影
========
网易摄影是一个基于``YII2.0``的照片分享网站。使用YII+MySQL+Apache 的组合搭建后台，前端使用传统方式开发，用PHP通过服务端渲染的方式生成页面，考虑到灵活性，在这里没有使用smart 之类的模板引擎。在开发之前也曾考虑过用``Vue ``作为前端框架采用客户端渲染的方式，作为一个SPA应用来开发，但是考虑到业务的复杂性和成熟型，SPA模式并不适合很多场景，最终采用了传统的方式。
## 说明
本网站页面样式使用了[网易摄影](http://pp.163.com/square?projectnameforlofter=pp)的页面，本项目为个人学习的作品，仅供学习用途，不参与任何商业用途。
## 项目搭建
### 使用composer 方式安装：
1、首先你要下载[Composer](http://www.yiiframework.com/doc-2.0/guide-start-installation.html#installing-via-composer) ,然后手动创建一个sugar数据库的数据库，将项目目录下的sql 文件导入数据库，建议使用``utf-8``的编码格式。

```
//全局安装插件
composer global require "fxp/composer-asset-plugin:~1.1.1"

//克隆项目到本地
git clone https://github.com/MeetMax/WangYi-Photography.git

//进入项目目录
cd WangYi-Photography

//通过composer 安装项目依赖
composer install 
```
2、安装完成后使用phpMyAdmin 新建名为XXX（任意） 的数据库，然后把项目目录下的sugar.sql 文件导入到新创建的数据库，然后需要修改数据库配置，本项目默认配置在``/common/config/main-local.php ``文件下，将数据库名字改成你创建的名字。
### 归档文件下载
1、如果暂时没法用 ``Composer``，也可以选择打包好的完整项目，[https://pan.baidu.com/s/1qYhNByO](https://pan.baidu.com/s/1qYhNByO) 密码：2cmu

2、下载完成后，接着走上面的第2步。

## 项目截图

![image](http://i1.piimg.com/586187/9725909cd579938e.png)
## 文档和手册
1. [Yii 权威指南](http://www.yii-china.com/doc/guide.html)
2. [Yii 高级版开发指南](http://www.yii-china.com/doc/detail/1.html)

## 感谢
- 感谢 [getYii] (https://github.com/iiYii/getyii)的开源代码
- 感谢 [funshop](https://github.com/funson86/funshop)的开源代码




