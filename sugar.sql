-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2017-02-21 14:09:49
-- 服务器版本： 5.7.17
-- PHP Version: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sugar`
--

-- --------------------------------------------------------

--
-- 表的结构 `album`
--

CREATE TABLE IF NOT EXISTS `album` (
  `id` int(11) NOT NULL,
  `album_name` varchar(50) NOT NULL COMMENT '相册名称',
  `album_desc` longtext NOT NULL COMMENT '作品描述',
  `number` smallint(6) NOT NULL DEFAULT '0' COMMENT '照片总数量',
  `cat_id` int(11) NOT NULL COMMENT '相册所属分类',
  `release_time` int(11) NOT NULL COMMENT '发布时间',
  `recommend` smallint(6) NOT NULL DEFAULT '0' COMMENT '是否被推荐(1为被推荐，0为默认)',
  `like` int(11) NOT NULL DEFAULT '0' COMMENT '被喜欢次数',
  `user_id` int(11) NOT NULL COMMENT '用户id',
  `browse_num` int(11) NOT NULL DEFAULT '0' COMMENT '浏览次数',
  `camera` varchar(50) NOT NULL COMMENT '相机',
  `lens` varchar(50) NOT NULL COMMENT '镜头',
  `address` varchar(50) NOT NULL COMMENT '地点',
  `cover` varchar(255) NOT NULL COMMENT '封面路径',
  `visit_num` int(11) DEFAULT '0' COMMENT '访问量'
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `album`
--

INSERT INTO `album` (`id`, `album_name`, `album_desc`, `number`, `cat_id`, `release_time`, `recommend`, `like`, `user_id`, `browse_num`, `camera`, `lens`, `address`, `cover`, `visit_num`) VALUES
(1, '风景！~', '风景！~', 0, 2, 1482471727, 1, 0, 1, 0, '尼康-D800', '尼康-24 F2.8D', ' 天津', '/upload/2016-12-23/300Nv-T7vh1AKP6_lmb4CH8EJpBU1tdERrY.jpg', 5),
(2, '青海湖！~', '青海', 0, 2, 1482472359, 1, 0, 1, 0, '尼康-D5000', '三星-10-17 F3.5-4.5', ' 山西- 太原', '/upload/2016-12-23/300bOKYYO8v63F-zz2HhvOmIsbK7EnaMEGI.jpg', 0),
(3, '内蒙古大草原!~', '大草原', 0, 2, 1482472536, 1, 0, 1, 0, '佳能-EOS 1000D', '奥林巴斯-11-22 F2.8-3.5', ' 内蒙古- 赤峰', '/upload/2016-12-23/3004xTAce4LNxwebO06VI_IfpRId57-p4kk.jpg', 4),
(4, '欧洲！~', '欧洲', 0, 2, 1482472879, 1, 0, 1, 0, '佳能-EOS 2000D', '奥林巴斯-7-14 F4.0', ' 海外- 瑞士', '/upload/2016-12-23/300KRuwoLi_aMoXbpgSy_vZGVM1w7GEj2Hi.jpg', 3),
(5, '人像！~', '', 0, 20, 1482475883, 1, 0, 1, 0, '佳能-EOS 5D Mark II', '佳能-50 F1.8 ', ' 天津', '/upload/2016-12-23/300G3h7Evj4Rc0r18RWfZSVksZa_92FdbT7.jpg', 2),
(6, '人像！~', '', 0, 21, 1482475951, 1, 0, 1, 0, '佳能-EOS 5D Mark II', '佳能-50 F1.4 USM', ' 上海', '/upload/2016-12-23/3006BwuCaY2oL6hNHTRSdE4jAs3Is5SUzg8.jpg', 0),
(7, '瑞士！~', '', 0, 2, 1482476007, 1, 0, 1, 0, '尼康-D800', '三星-35 F2', ' 海外- 瑞士', '/upload/2016-12-23/300Ovutd7B3_Yb1wIrLVM1oVTcvOk7XprZo.jpg', 1),
(8, '雪乡!~', '', 0, 2, 1482476073, 1, 0, 1, 0, '佳能-EOS 5D Mark II', '佳能-16-35 F2.8L USM', ' 黑龙江- 哈尔滨', '/upload/2016-12-23/300_kya1KM8Y8HooTxIvy825MkIc3G8f_iH.jpg', 5),
(9, '泰国！~', '', 0, 5, 1482476177, 1, 0, 1, 0, '佳能-EOS 1000D', '佳能-18-55 F3.5-5.6 IS', ' 海外- 泰国', '/upload/2016-12-23/300f0k_ye5piXswvBsV42j4QiZ5t5U_ki7A.jpg', 0),
(10, '欧洲！~', '', 0, 6, 1482476236, 1, 0, 1, 0, '佳能-EOS 450D', '佳能-10-22 F3.5-4.5 USM', ' 海外- 德国', '/upload/2016-12-23/300RVP9AUyUlDuYChe8SMHmusRnNzugxtKQ.jpg', 1),
(11, '风景！~', '', 0, 6, 1482476311, 0, 0, 1, 0, '佳能-EOS 350D', '佳能-10-22 F3.5-4.5 USM', ' 西藏- 日喀则', '/upload/2016-12-23/300lHJnVkJKHcxa95bPYiedXxGOlcNze38H.jpg', 0),
(12, '拉萨！~', '', 0, 17, 1482476391, 1, 0, 1, 0, '佳能-EOS 2000D', '宾得-14 F2.8 ', ' 西藏- 拉萨', '/upload/2016-12-23/300XbKWwlyi-HapKy7sW1eJBR5TKzEw_K8v.jpg', 2),
(13, '雪乡！~', '', 0, 8, 1482476439, 0, 0, 1, 0, '佳能-EOS 5D Mark II', '三星-16-45 F4', ' 黑龙江- 哈尔滨', '/upload/2016-12-23/300lAGOnrlSTxFyResLkID13rkwa3GVkCm2.jpg', 0),
(14, '泰国旅拍！~', '', 0, 20, 1482476539, 0, 0, 1, 0, '佳能-EOS 5D Mark II', '佳能-50 F1.8 ', ' 海外- 泰国', '/upload/2016-12-23/3006_cxpNMCYI-xfMAKX4nsHcKcDun4rb20.jpg', 0),
(15, '瑞士', '', 0, 4, 1482476600, 0, 0, 1, 0, '奥林巴斯-E-330', '腾龙-14 F2.8', ' 海外- 瑞士', '/upload/2016-12-23/300RSfCzkVAjLe6f7hKgs9iMcouiyoEvztr.jpg', 0),
(16, '泰国寺庙！~', '', 0, 2, 1482476673, 0, 0, 1, 0, '尼康-D4000', '三星-10-17 F3.5-4.5', ' 海外- 泰国', '/upload/2016-12-23/300JelUV9hGK0Q6Lz7ZInEckO-jyscK-fgw.jpg', 0),
(17, '毕业旅行！~', '', 0, 12, 1482476742, 1, 0, 1, 0, '佳能-EOS 50D', '佳能-50 F1.8 ', ' 海外- 英国', '/upload/2016-12-23/3002VfRk320QnGiTNlGq0avAbyiuB5nIdgu.jpg', 0),
(18, '青海湖！~', '', 0, 14, 1482477009, 0, 0, 2, 0, '尼康-Coolpix P4', '奥林巴斯-9-18 F4-5.6', ' 青海- 海西', '/upload/2016-12-23/300T4m-cLehckrJATr2TygGDMQaTi8_i8QF.jpg', 0),
(19, '鹿！~', '', 0, 15, 1482477424, 1, 0, 2, 0, '佳能-EOS 350D', '三星-16-45 F4', ' 海外- 日本', '/upload/2016-12-23/300FY7e6Hz7IHTfaPI5aQcs9r6P_2vZ1Kzu.jpg', 0),
(20, '斗牛犬！~', '', 0, 14, 1482477475, 1, 0, 2, 0, '索尼-a100', '腾龙-14 F2.8', ' 北京', '/upload/2016-12-23/300OTzgcwOMe3paTniXLoPUcBm9xVIl73Gq.jpg', 0),
(21, '喵星人', '', 0, 14, 1482477521, 1, 0, 2, 0, '佳能-EOS 2000D', '奥林巴斯-7-14 F4.0', ' 上海', '/upload/2016-12-23/300ApJDkZ1rG_thf-7R0wMH4PnK9dZHNRAm.jpg', 0),
(22, '狮子！~~~~', '', 0, 15, 1482477599, 1, 0, 2, 0, '尼康-D4000', '奥林巴斯-7-14 F4.0', ' 北京', '/upload/2016-12-23/300-YMcLtJNQlB_7vT6tRsRa_Ou_xax7I4e.jpg', 0),
(23, '喵星人2~！', '', 0, 14, 1482477689, 1, 0, 2, 0, '佳能-EOS 50D', '佳能-20-35 F3.5-4.5 USM', ' 四川- 乐山', '/upload/2016-12-23/300G41zZaE_Y6TfNjd_kwFj5rpZ1owhDr6k.jpg', 0),
(24, '小胖子！~', '', 0, 10, 1482478328, 1, 0, 3, 0, '佳能-EOS 5D Mark II', '佳能-50 F1.4 USM', ' 北京', '/upload/2016-12-23/300bWpMGyPxli_r_LT2YcGjylQM5_JwRrhV.jpg', 0),
(25, '玩耍~~~', '', 0, 10, 1482478407, 1, 0, 3, 0, '佳能-EOS 5D Mark II', '佳能-50 F1.4 USM', ' 北京', '/upload/2016-12-23/300kk8ppFuELw-vkxOwKciAptaIs4xdjx3Y.jpg', 0),
(26, '泡澡！~~~~', '', 0, 10, 1482478492, 1, 0, 3, 0, '佳能-EOS 5D Mark II', '佳能-50 F1.4 USM', ' 台湾', '/upload/2016-12-23/300pCSFSWlwqgTDpnC-tWbaUAH_wzBHj38P.jpg', 0),
(27, '哼哼！~~~', '', 0, 10, 1482478572, 1, 0, 3, 0, '佳能-EOS 5D Mark II', '佳能-50 F1.4 USM', ' 上海', '/upload/2016-12-23/300DrwqQ4lgX89Pe0lKskcjciV-RvNW1ULa.jpg', 4),
(28, '瑞士街景~', '', 0, 6, 1482479183, 1, 0, 3, 0, '佳能-EOS 5D Mark II', '佳能-24-105 F4L IS USM', ' 海外- 瑞士', '/upload/2016-12-23/300_kvTt8iZgsqWkBtkvdQY_4IVbC8psBP4.jpg', 2),
(29, '自拍~~', '啊哈哈', 0, 20, 1487682186, 0, 0, 4, 0, '索尼-a230', '奥林巴斯-8 F3.5', ' 北京', '/upload/2017-02-21/300ezs-5szdENn6CtCQxtPzoCL9ydlUitJM.jpg', 1);

-- --------------------------------------------------------

--
-- 表的结构 `bg_image`
--

CREATE TABLE IF NOT EXISTS `bg_image` (
  `id` int(11) NOT NULL,
  `thumb` varchar(255) NOT NULL COMMENT '缩略图',
  `origin` varchar(255) NOT NULL COMMENT '原图',
  `type` enum('0','1') NOT NULL DEFAULT '0' COMMENT '背景类型(0=图片,1=纯色)'
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `bg_image`
--

INSERT INTO `bg_image` (`id`, `thumb`, `origin`, `type`) VALUES
(1, '/images/2016121301.png', '/images/bg/2016121301.jpg', '0'),
(2, '/images/2016121302.png', '/images/bg/2016121302.jpg', '0'),
(3, '/images/2016121303.png', '/images/bg/2016121303.jpg', '0'),
(4, '/images/2016121304.png', '/images/bg/2016121304.jpg', '0'),
(5, '/images/2016121305.png', '/images/bg/2016121305.jpg', '0'),
(6, '/images/2016121306.png', '/images/bg/2016121306.jpg', '0'),
(7, '#f3f3f3', '#f3f3f3', '1'),
(8, '#666', '#666', '1'),
(9, '#000', '#000', '1'),
(10, '#2A8FBD', '#2A8FBD', '1'),
(11, '#7FAD4C', '#7FAD4C', '1'),
(12, '#D16762', '#D16762', '1');

-- --------------------------------------------------------

--
-- 表的结构 `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL COMMENT '分类id',
  `cat_name` varchar(50) NOT NULL COMMENT '分类名称',
  `parent_id` int(11) NOT NULL COMMENT '父级分类'
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `category`
--

INSERT INTO `category` (`id`, `cat_name`, `parent_id`) VALUES
(1, '人像', 0),
(2, '风景', 0),
(3, '婚纱', 0),
(4, '海外', 0),
(5, '人文', 0),
(6, '街头', 0),
(7, '展会', 0),
(8, 'LOMO', 0),
(9, '胶片', 0),
(10, '儿童', 0),
(11, '达物', 0),
(12, '静物', 0),
(13, '美食', 0),
(14, '宠物', 0),
(15, '动物', 0),
(16, '昆虫', 0),
(17, '植物', 0),
(18, '概念', 0),
(19, '其它', 0),
(20, '糖水', 1),
(21, '妆面', 1),
(22, '黑白', 1),
(23, '日系', 1),
(24, '其它', 1),
(27, '135正片', 9),
(28, '135负片', 9),
(29, '135黑白', 9),
(30, '120正片', 9),
(31, '120负片', 9),
(32, '120黑白', 9);

-- --------------------------------------------------------

--
-- 表的结构 `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(11) NOT NULL,
  `content` varchar(255) DEFAULT NULL COMMENT '评论内容',
  `time` int(11) NOT NULL COMMENT '评论时间',
  `user_id` int(11) NOT NULL COMMENT '用户id',
  `album_id` int(11) NOT NULL COMMENT '相册id',
  `photo_id` int(11) NOT NULL DEFAULT '0' COMMENT '照片id'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `follow_byfollow`
--

CREATE TABLE IF NOT EXISTS `follow_byfollow` (
  `id` int(11) NOT NULL,
  `follow_id` int(11) NOT NULL COMMENT '关注者',
  `byfollow_id` int(11) NOT NULL COMMENT '被关注者'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `follow_byfollow`
--

INSERT INTO `follow_byfollow` (`id`, `follow_id`, `byfollow_id`) VALUES
(2, 4, 1);

-- --------------------------------------------------------

--
-- 表的结构 `haha`
--

CREATE TABLE IF NOT EXISTS `haha` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `like_bylike`
--

CREATE TABLE IF NOT EXISTS `like_bylike` (
  `id` int(11) NOT NULL,
  `like_user_id` int(11) NOT NULL COMMENT '赞的用户id',
  `bylike_user_id` int(11) NOT NULL COMMENT '被赞的用户id',
  `photo_id` int(11) NOT NULL DEFAULT '0' COMMENT '被赞的照片id'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `like_bylike`
--

INSERT INTO `like_bylike` (`id`, `like_user_id`, `bylike_user_id`, `photo_id`) VALUES
(1, 1, 1, 1),
(2, 1, 1, 18);

-- --------------------------------------------------------

--
-- 表的结构 `person_info`
--

CREATE TABLE IF NOT EXISTS `person_info` (
  `id` int(11) NOT NULL,
  `nickname` varchar(30) NOT NULL COMMENT '昵称',
  `head_img` varchar(255) DEFAULT '/upload/headImg/default.png' COMMENT '头像',
  `live_address` varchar(50) DEFAULT NULL COMMENT '居住地',
  `sex` enum('1','0') NOT NULL DEFAULT '0' COMMENT '性别(0=男,1=女)',
  `user_id` int(11) NOT NULL COMMENT '用户id',
  `birth_date` varchar(50) DEFAULT NULL COMMENT '出生日期',
  `bg_id` int(11) NOT NULL DEFAULT '1' COMMENT '背景id',
  `font_color` enum('#000','#fff') DEFAULT '#fff' COMMENT '字体颜色'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `person_info`
--

INSERT INTO `person_info` (`id`, `nickname`, `head_img`, `live_address`, `sex`, `user_id`, `birth_date`, `bg_id`, `font_color`) VALUES
(1, '小糖人', '/upload/headImg/66308566594693252631482469967.jpg', '上海', '0', 1, '1994-2-5', 1, '#fff'),
(2, 'Max小马', '/upload/headImg/66305916771660591081482476950.jpg', '浙江绍兴', '0', 2, '1994-2-5', 3, '#fff'),
(3, '呆呆', '/upload/headImg/66315031723067834311482479039.jpg', '北京', '1', 3, '1998-6-15', 4, '#fff'),
(4, 'meetmax', '/upload/headImg/IMG_03351487682225.jpg', '', '1', 4, '1971-4-5', 4, '#fff');

-- --------------------------------------------------------

--
-- 表的结构 `photo`
--

CREATE TABLE IF NOT EXISTS `photo` (
  `id` int(11) NOT NULL COMMENT '照片id',
  `big_path` varchar(255) NOT NULL COMMENT '大图路径',
  `status` smallint(6) NOT NULL DEFAULT '1' COMMENT '图片状态（1正常，0禁用）',
  `ogn_name` varchar(255) NOT NULL COMMENT '图片名称',
  `like_num` int(11) DEFAULT NULL COMMENT '被喜欢次数',
  `camera_brand` varchar(30) DEFAULT NULL COMMENT '品牌',
  `camera_model` varchar(50) DEFAULT NULL COMMENT '型号',
  `focus` varchar(30) DEFAULT NULL COMMENT '焦距',
  `aperture` varchar(50) DEFAULT NULL COMMENT '光圈',
  `shutter_speed` varchar(30) DEFAULT NULL COMMENT '快门速度',
  `iso` varchar(30) DEFAULT NULL COMMENT '感光度',
  `exposure_compensation` varchar(30) DEFAULT NULL COMMENT '曝光补偿 ',
  `shoot_time` varchar(50) DEFAULT NULL COMMENT '拍摄时间',
  `lens` varchar(50) DEFAULT NULL COMMENT '镜头',
  `sm_name` varchar(50) NOT NULL COMMENT '小图名字',
  `big_name` varchar(50) NOT NULL COMMENT '大图名字',
  `sm_path` varchar(255) NOT NULL COMMENT '小图路径',
  `album_id` int(11) NOT NULL COMMENT '作品id'
) ENGINE=InnoDB AUTO_INCREMENT=94 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `photo`
--

INSERT INTO `photo` (`id`, `big_path`, `status`, `ogn_name`, `like_num`, `camera_brand`, `camera_model`, `focus`, `aperture`, `shutter_speed`, `iso`, `exposure_compensation`, `shoot_time`, `lens`, `sm_name`, `big_name`, `sm_path`, `album_id`) VALUES
(1, '/upload/2016-12-23/9604j_JQA2JIqexw29OGrlFlhBcCKCqyifb.jpg', 1, '4j_JQA2JIqexw29OGrlFlhBcCKCqyifb', NULL, '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '3004j_JQA2JIqexw29OGrlFlhBcCKCqyifb.jpg', '9604j_JQA2JIqexw29OGrlFlhBcCKCqyifb.jpg', '/upload/2016-12-23/3004j_JQA2JIqexw29OGrlFlhBcCKCqyifb.jpg', 1),
(2, '/upload/2016-12-23/960M0nMwMR9ccCMkHp42Ov0i5JXuQPjPVat.jpg', 1, 'M0nMwMR9ccCMkHp42Ov0i5JXuQPjPVat', NULL, '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '300M0nMwMR9ccCMkHp42Ov0i5JXuQPjPVat.jpg', '960M0nMwMR9ccCMkHp42Ov0i5JXuQPjPVat.jpg', '/upload/2016-12-23/300M0nMwMR9ccCMkHp42Ov0i5JXuQPjPVat.jpg', 1),
(3, '/upload/2016-12-23/960oak4SHHrUJAeNoUZZIA0f4IvYL03-nYa.jpg', 1, 'oak4SHHrUJAeNoUZZIA0f4IvYL03-nYa', NULL, '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '300oak4SHHrUJAeNoUZZIA0f4IvYL03-nYa.jpg', '960oak4SHHrUJAeNoUZZIA0f4IvYL03-nYa.jpg', '/upload/2016-12-23/300oak4SHHrUJAeNoUZZIA0f4IvYL03-nYa.jpg', 1),
(4, '/upload/2016-12-23/960AMHIVhDvtju00Uxg2BDz-R_FlGk1VmVr.jpg', 1, 'AMHIVhDvtju00Uxg2BDz-R_FlGk1VmVr', NULL, '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '300AMHIVhDvtju00Uxg2BDz-R_FlGk1VmVr.jpg', '960AMHIVhDvtju00Uxg2BDz-R_FlGk1VmVr.jpg', '/upload/2016-12-23/300AMHIVhDvtju00Uxg2BDz-R_FlGk1VmVr.jpg', 1),
(5, '/upload/2016-12-23/9609Bg-p7V4XB0QbYe9E8RFvvTp6kDlBJgx.jpg', 1, '9Bg-p7V4XB0QbYe9E8RFvvTp6kDlBJgx', NULL, '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '3009Bg-p7V4XB0QbYe9E8RFvvTp6kDlBJgx.jpg', '9609Bg-p7V4XB0QbYe9E8RFvvTp6kDlBJgx.jpg', '/upload/2016-12-23/3009Bg-p7V4XB0QbYe9E8RFvvTp6kDlBJgx.jpg', 1),
(6, '/upload/2016-12-23/9606im8hbETHBxp1q_u6fZfyE1Sbx3w_AnO.jpg', 1, '6im8hbETHBxp1q_u6fZfyE1Sbx3w_AnO', NULL, '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '3006im8hbETHBxp1q_u6fZfyE1Sbx3w_AnO.jpg', '9606im8hbETHBxp1q_u6fZfyE1Sbx3w_AnO.jpg', '/upload/2016-12-23/3006im8hbETHBxp1q_u6fZfyE1Sbx3w_AnO.jpg', 1),
(7, '/upload/2016-12-23/960Nv-T7vh1AKP6_lmb4CH8EJpBU1tdERrY.jpg', 1, 'Nv-T7vh1AKP6_lmb4CH8EJpBU1tdERrY', NULL, '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '300Nv-T7vh1AKP6_lmb4CH8EJpBU1tdERrY.jpg', '960Nv-T7vh1AKP6_lmb4CH8EJpBU1tdERrY.jpg', '/upload/2016-12-23/300Nv-T7vh1AKP6_lmb4CH8EJpBU1tdERrY.jpg', 1),
(8, '/upload/2016-12-23/960cZsqvO8LNuR5bEW3EgQVk9zVIDE5pntS.jpg', 1, 'cZsqvO8LNuR5bEW3EgQVk9zVIDE5pntS', NULL, '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '300cZsqvO8LNuR5bEW3EgQVk9zVIDE5pntS.jpg', '960cZsqvO8LNuR5bEW3EgQVk9zVIDE5pntS.jpg', '/upload/2016-12-23/300cZsqvO8LNuR5bEW3EgQVk9zVIDE5pntS.jpg', 1),
(9, '/upload/2016-12-23/960aX2J03DTsyP3NSymwx1jUlL_IB9q1yex.jpg', 1, 'aX2J03DTsyP3NSymwx1jUlL_IB9q1yex', NULL, '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '300aX2J03DTsyP3NSymwx1jUlL_IB9q1yex.jpg', '960aX2J03DTsyP3NSymwx1jUlL_IB9q1yex.jpg', '/upload/2016-12-23/300aX2J03DTsyP3NSymwx1jUlL_IB9q1yex.jpg', 1),
(10, '/upload/2016-12-23/960v8ImySwwxnWqL3ZudrUFL1fS3cNZaOqr.jpg', 1, 'v8ImySwwxnWqL3ZudrUFL1fS3cNZaOqr', NULL, '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '300v8ImySwwxnWqL3ZudrUFL1fS3cNZaOqr.jpg', '960v8ImySwwxnWqL3ZudrUFL1fS3cNZaOqr.jpg', '/upload/2016-12-23/300v8ImySwwxnWqL3ZudrUFL1fS3cNZaOqr.jpg', 1),
(11, '/upload/2016-12-23/960g52VHo3PakSnEmVwlbEMfXVYZam6irwx.jpg', 1, 'g52VHo3PakSnEmVwlbEMfXVYZam6irwx', NULL, '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '300g52VHo3PakSnEmVwlbEMfXVYZam6irwx.jpg', '960g52VHo3PakSnEmVwlbEMfXVYZam6irwx.jpg', '/upload/2016-12-23/300g52VHo3PakSnEmVwlbEMfXVYZam6irwx.jpg', 2),
(12, '/upload/2016-12-23/960weVXAGAJ1XhyJz2XDTCbVyAyoKt0k4Qm.jpg', 1, 'weVXAGAJ1XhyJz2XDTCbVyAyoKt0k4Qm', NULL, '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '300weVXAGAJ1XhyJz2XDTCbVyAyoKt0k4Qm.jpg', '960weVXAGAJ1XhyJz2XDTCbVyAyoKt0k4Qm.jpg', '/upload/2016-12-23/300weVXAGAJ1XhyJz2XDTCbVyAyoKt0k4Qm.jpg', 2),
(13, '/upload/2016-12-23/960OPs8yYKgbrCiegQej_tdyzi23Cw0vNpq.jpg', 1, 'OPs8yYKgbrCiegQej_tdyzi23Cw0vNpq', NULL, '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '300OPs8yYKgbrCiegQej_tdyzi23Cw0vNpq.jpg', '960OPs8yYKgbrCiegQej_tdyzi23Cw0vNpq.jpg', '/upload/2016-12-23/300OPs8yYKgbrCiegQej_tdyzi23Cw0vNpq.jpg', 2),
(14, '/upload/2016-12-23/960XvYXId05O--qeLUwEOQRjVpLNudVigvt.jpg', 1, 'XvYXId05O--qeLUwEOQRjVpLNudVigvt', NULL, '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '300XvYXId05O--qeLUwEOQRjVpLNudVigvt.jpg', '960XvYXId05O--qeLUwEOQRjVpLNudVigvt.jpg', '/upload/2016-12-23/300XvYXId05O--qeLUwEOQRjVpLNudVigvt.jpg', 2),
(15, '/upload/2016-12-23/960bOKYYO8v63F-zz2HhvOmIsbK7EnaMEGI.jpg', 1, 'bOKYYO8v63F-zz2HhvOmIsbK7EnaMEGI', NULL, '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '300bOKYYO8v63F-zz2HhvOmIsbK7EnaMEGI.jpg', '960bOKYYO8v63F-zz2HhvOmIsbK7EnaMEGI.jpg', '/upload/2016-12-23/300bOKYYO8v63F-zz2HhvOmIsbK7EnaMEGI.jpg', 2),
(16, '/upload/2016-12-23/960CUlyXCZmSMKNROFKD6u-oe51ggEaRv86.jpg', 1, 'CUlyXCZmSMKNROFKD6u-oe51ggEaRv86', NULL, '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '300CUlyXCZmSMKNROFKD6u-oe51ggEaRv86.jpg', '960CUlyXCZmSMKNROFKD6u-oe51ggEaRv86.jpg', '/upload/2016-12-23/300CUlyXCZmSMKNROFKD6u-oe51ggEaRv86.jpg', 3),
(17, '/upload/2016-12-23/960FzJotR5oc8nk9iVXReXF2Clp_NJrnpIK.jpg', 1, 'FzJotR5oc8nk9iVXReXF2Clp_NJrnpIK', NULL, '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '300FzJotR5oc8nk9iVXReXF2Clp_NJrnpIK.jpg', '960FzJotR5oc8nk9iVXReXF2Clp_NJrnpIK.jpg', '/upload/2016-12-23/300FzJotR5oc8nk9iVXReXF2Clp_NJrnpIK.jpg', 3),
(18, '/upload/2016-12-23/9604xTAce4LNxwebO06VI_IfpRId57-p4kk.jpg', 1, '4xTAce4LNxwebO06VI_IfpRId57-p4kk', NULL, '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '3004xTAce4LNxwebO06VI_IfpRId57-p4kk.jpg', '9604xTAce4LNxwebO06VI_IfpRId57-p4kk.jpg', '/upload/2016-12-23/3004xTAce4LNxwebO06VI_IfpRId57-p4kk.jpg', 3),
(19, '/upload/2016-12-23/960XI7E81RDLaZVhGMMbBprjg_I4IrOGlMU.jpg', 1, 'XI7E81RDLaZVhGMMbBprjg_I4IrOGlMU', NULL, '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '300XI7E81RDLaZVhGMMbBprjg_I4IrOGlMU.jpg', '960XI7E81RDLaZVhGMMbBprjg_I4IrOGlMU.jpg', '/upload/2016-12-23/300XI7E81RDLaZVhGMMbBprjg_I4IrOGlMU.jpg', 3),
(20, '/upload/2016-12-23/960sgqs51Bdhxw0jfuGewnxr0FPjdkipt1x.jpg', 1, '6631333847514760007.jpg', NULL, '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '300sgqs51Bdhxw0jfuGewnxr0FPjdkipt1x.jpg', '960sgqs51Bdhxw0jfuGewnxr0FPjdkipt1x.jpg', '/upload/2016-12-23/300sgqs51Bdhxw0jfuGewnxr0FPjdkipt1x.jpg', 4),
(21, '/upload/2016-12-23/960RNM0KG56Pxjjnmki0TvdtfAus7XSxZaL.jpg', 1, '6631329449466865979.jpg', NULL, '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '300RNM0KG56Pxjjnmki0TvdtfAus7XSxZaL.jpg', '960RNM0KG56Pxjjnmki0TvdtfAus7XSxZaL.jpg', '/upload/2016-12-23/300RNM0KG56Pxjjnmki0TvdtfAus7XSxZaL.jpg', 4),
(22, '/upload/2016-12-23/960Ws3An_4VvepiwM40BhzbKBolquKBoV8D.jpg', 1, '6631325051420354863.jpg', NULL, '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '300Ws3An_4VvepiwM40BhzbKBolquKBoV8D.jpg', '960Ws3An_4VvepiwM40BhzbKBolquKBoV8D.jpg', '/upload/2016-12-23/300Ws3An_4VvepiwM40BhzbKBolquKBoV8D.jpg', 4),
(23, '/upload/2016-12-23/960KRuwoLi_aMoXbpgSy_vZGVM1w7GEj2Hi.jpg', 1, '6631292066072920328.jpg', NULL, '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '300KRuwoLi_aMoXbpgSy_vZGVM1w7GEj2Hi.jpg', '960KRuwoLi_aMoXbpgSy_vZGVM1w7GEj2Hi.jpg', '/upload/2016-12-23/300KRuwoLi_aMoXbpgSy_vZGVM1w7GEj2Hi.jpg', 4),
(24, '/upload/2016-12-23/960G3h7Evj4Rc0r18RWfZSVksZa_92FdbT7.jpg', 1, '2890748010836627026', NULL, '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '300G3h7Evj4Rc0r18RWfZSVksZa_92FdbT7.jpg', '960G3h7Evj4Rc0r18RWfZSVksZa_92FdbT7.jpg', '/upload/2016-12-23/300G3h7Evj4Rc0r18RWfZSVksZa_92FdbT7.jpg', 5),
(25, '/upload/2016-12-23/9606BwuCaY2oL6hNHTRSdE4jAs3Is5SUzg8.jpg', 1, '4822510776084072365', NULL, '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '3006BwuCaY2oL6hNHTRSdE4jAs3Is5SUzg8.jpg', '9606BwuCaY2oL6hNHTRSdE4jAs3Is5SUzg8.jpg', '/upload/2016-12-23/3006BwuCaY2oL6hNHTRSdE4jAs3Is5SUzg8.jpg', 6),
(26, '/upload/2016-12-23/9603fuH4nUXBww4rI-j9xVUllsDYDw_7F_x.jpg', 1, '6598150586588098212', NULL, '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '3003fuH4nUXBww4rI-j9xVUllsDYDw_7F_x.jpg', '9603fuH4nUXBww4rI-j9xVUllsDYDw_7F_x.jpg', '/upload/2016-12-23/3003fuH4nUXBww4rI-j9xVUllsDYDw_7F_x.jpg', 7),
(27, '/upload/2016-12-23/960FHwX6WX_ibQYe67smIwrIuChximeuMDk.jpg', 1, '6597843822844170664', NULL, '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '300FHwX6WX_ibQYe67smIwrIuChximeuMDk.jpg', '960FHwX6WX_ibQYe67smIwrIuChximeuMDk.jpg', '/upload/2016-12-23/300FHwX6WX_ibQYe67smIwrIuChximeuMDk.jpg', 7),
(28, '/upload/2016-12-23/960Ovutd7B3_Yb1wIrLVM1oVTcvOk7XprZo.jpg', 1, '6597354540170251784', NULL, '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '300Ovutd7B3_Yb1wIrLVM1oVTcvOk7XprZo.jpg', '960Ovutd7B3_Yb1wIrLVM1oVTcvOk7XprZo.jpg', '/upload/2016-12-23/300Ovutd7B3_Yb1wIrLVM1oVTcvOk7XprZo.jpg', 7),
(29, '/upload/2016-12-23/960ibCUFCPwuMaOBafVfMgbl5FfyPqGaBpm.jpg', 1, '155374187244535577', NULL, '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '300ibCUFCPwuMaOBafVfMgbl5FfyPqGaBpm.jpg', '960ibCUFCPwuMaOBafVfMgbl5FfyPqGaBpm.jpg', '/upload/2016-12-23/300ibCUFCPwuMaOBafVfMgbl5FfyPqGaBpm.jpg', 8),
(30, '/upload/2016-12-23/960_kya1KM8Y8HooTxIvy825MkIc3G8f_iH.jpg', 1, '147774362873796757', NULL, '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '300_kya1KM8Y8HooTxIvy825MkIc3G8f_iH.jpg', '960_kya1KM8Y8HooTxIvy825MkIc3G8f_iH.jpg', '/upload/2016-12-23/300_kya1KM8Y8HooTxIvy825MkIc3G8f_iH.jpg', 8),
(31, '/upload/2016-12-23/960iD9-Bapc5w5DNfo9cOZyHVfRUjDTU1xO.jpg', 1, '6619226025467687043', NULL, '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '300iD9-Bapc5w5DNfo9cOZyHVfRUjDTU1xO.jpg', '960iD9-Bapc5w5DNfo9cOZyHVfRUjDTU1xO.jpg', '/upload/2016-12-23/300iD9-Bapc5w5DNfo9cOZyHVfRUjDTU1xO.jpg', 9),
(32, '/upload/2016-12-23/960OsgOOKXG9-13U6sAptULhtir4AJ2EbeH.jpg', 1, '6619101780653749542', NULL, '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '300OsgOOKXG9-13U6sAptULhtir4AJ2EbeH.jpg', '960OsgOOKXG9-13U6sAptULhtir4AJ2EbeH.jpg', '/upload/2016-12-23/300OsgOOKXG9-13U6sAptULhtir4AJ2EbeH.jpg', 9),
(33, '/upload/2016-12-23/960f0k_ye5piXswvBsV42j4QiZ5t5U_ki7A.jpg', 1, '6608572857306525464', NULL, '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '300f0k_ye5piXswvBsV42j4QiZ5t5U_ki7A.jpg', '960f0k_ye5piXswvBsV42j4QiZ5t5U_ki7A.jpg', '/upload/2016-12-23/300f0k_ye5piXswvBsV42j4QiZ5t5U_ki7A.jpg', 9),
(34, '/upload/2016-12-23/960RVP9AUyUlDuYChe8SMHmusRnNzugxtKQ.jpg', 1, '6598169278285190439', NULL, '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '300RVP9AUyUlDuYChe8SMHmusRnNzugxtKQ.jpg', '960RVP9AUyUlDuYChe8SMHmusRnNzugxtKQ.jpg', '/upload/2016-12-23/300RVP9AUyUlDuYChe8SMHmusRnNzugxtKQ.jpg', 10),
(35, '/upload/2016-12-23/960lHJnVkJKHcxa95bPYiedXxGOlcNze38H.jpg', 1, '2051671105344101566', NULL, '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '300lHJnVkJKHcxa95bPYiedXxGOlcNze38H.jpg', '960lHJnVkJKHcxa95bPYiedXxGOlcNze38H.jpg', '/upload/2016-12-23/300lHJnVkJKHcxa95bPYiedXxGOlcNze38H.jpg', 11),
(36, '/upload/2016-12-23/960X8xz5a1iC90xzJAwIz2RKxLihaIzw9x0.jpg', 1, '1374442311378147047', NULL, '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '300X8xz5a1iC90xzJAwIz2RKxLihaIzw9x0.jpg', '960X8xz5a1iC90xzJAwIz2RKxLihaIzw9x0.jpg', '/upload/2016-12-23/300X8xz5a1iC90xzJAwIz2RKxLihaIzw9x0.jpg', 11),
(37, '/upload/2016-12-23/960E_0lvVWd14S8s_vD_2cuhjl5tUKt9ILG.jpg', 1, '6630552094746859696', NULL, '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '300E_0lvVWd14S8s_vD_2cuhjl5tUKt9ILG.jpg', '960E_0lvVWd14S8s_vD_2cuhjl5tUKt9ILG.jpg', '/upload/2016-12-23/300E_0lvVWd14S8s_vD_2cuhjl5tUKt9ILG.jpg', 12),
(38, '/upload/2016-12-23/960XbKWwlyi-HapKy7sW1eJBR5TKzEw_K8v.jpg', 1, '6630323396328285744', NULL, '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '300XbKWwlyi-HapKy7sW1eJBR5TKzEw_K8v.jpg', '960XbKWwlyi-HapKy7sW1eJBR5TKzEw_K8v.jpg', '/upload/2016-12-23/300XbKWwlyi-HapKy7sW1eJBR5TKzEw_K8v.jpg', 12),
(39, '/upload/2016-12-23/9604hBNxKyRWXv2I91hZFUBfOwqvlCaUovx.jpg', 1, '6630209047118997488', NULL, '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '3004hBNxKyRWXv2I91hZFUBfOwqvlCaUovx.jpg', '9604hBNxKyRWXv2I91hZFUBfOwqvlCaUovx.jpg', '/upload/2016-12-23/3004hBNxKyRWXv2I91hZFUBfOwqvlCaUovx.jpg', 12),
(40, '/upload/2016-12-23/960XCqgERx3VDL5fEtwC_75DG4U7G7ecKnR.jpg', 1, '1413567333141642460', NULL, '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '300XCqgERx3VDL5fEtwC_75DG4U7G7ecKnR.jpg', '960XCqgERx3VDL5fEtwC_75DG4U7G7ecKnR.jpg', '/upload/2016-12-23/300XCqgERx3VDL5fEtwC_75DG4U7G7ecKnR.jpg', 13),
(41, '/upload/2016-12-23/960lAGOnrlSTxFyResLkID13rkwa3GVkCm2.jpg', 1, '1403715708956626107', NULL, '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '300lAGOnrlSTxFyResLkID13rkwa3GVkCm2.jpg', '960lAGOnrlSTxFyResLkID13rkwa3GVkCm2.jpg', '/upload/2016-12-23/300lAGOnrlSTxFyResLkID13rkwa3GVkCm2.jpg', 13),
(42, '/upload/2016-12-23/9606_cxpNMCYI-xfMAKX4nsHcKcDun4rb20.jpg', 1, '6598131894950370203', NULL, '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '3006_cxpNMCYI-xfMAKX4nsHcKcDun4rb20.jpg', '9606_cxpNMCYI-xfMAKX4nsHcKcDun4rb20.jpg', '/upload/2016-12-23/3006_cxpNMCYI-xfMAKX4nsHcKcDun4rb20.jpg', 14),
(43, '/upload/2016-12-23/960dKHyzlRaNG943MhEg5XbXdbwbZZuMmwa.jpg', 1, '6597301763611171880', NULL, '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '300dKHyzlRaNG943MhEg5XbXdbwbZZuMmwa.jpg', '960dKHyzlRaNG943MhEg5XbXdbwbZZuMmwa.jpg', '/upload/2016-12-23/300dKHyzlRaNG943MhEg5XbXdbwbZZuMmwa.jpg', 15),
(44, '/upload/2016-12-23/960Kp0FQUabbmLzIvKZY-pNN2jo5HaDmg-P.jpg', 1, '3260043180363034398', NULL, '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '300Kp0FQUabbmLzIvKZY-pNN2jo5HaDmg-P.jpg', '960Kp0FQUabbmLzIvKZY-pNN2jo5HaDmg-P.jpg', '/upload/2016-12-23/300Kp0FQUabbmLzIvKZY-pNN2jo5HaDmg-P.jpg', 15),
(45, '/upload/2016-12-23/960RSfCzkVAjLe6f7hKgs9iMcouiyoEvztr.jpg', 1, '3148297614608772819', NULL, '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '300RSfCzkVAjLe6f7hKgs9iMcouiyoEvztr.jpg', '960RSfCzkVAjLe6f7hKgs9iMcouiyoEvztr.jpg', '/upload/2016-12-23/300RSfCzkVAjLe6f7hKgs9iMcouiyoEvztr.jpg', 15),
(46, '/upload/2016-12-23/960JelUV9hGK0Q6Lz7ZInEckO-jyscK-fgw.jpg', 1, '6598224253866189328', NULL, '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '300JelUV9hGK0Q6Lz7ZInEckO-jyscK-fgw.jpg', '960JelUV9hGK0Q6Lz7ZInEckO-jyscK-fgw.jpg', '/upload/2016-12-23/300JelUV9hGK0Q6Lz7ZInEckO-jyscK-fgw.jpg', 16),
(47, '/upload/2016-12-23/960kG6jPaQR0c57j31Zk33gHl8l_7_wmnCi.jpg', 1, '2998834401975650848', NULL, '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '300kG6jPaQR0c57j31Zk33gHl8l_7_wmnCi.jpg', '960kG6jPaQR0c57j31Zk33gHl8l_7_wmnCi.jpg', '/upload/2016-12-23/300kG6jPaQR0c57j31Zk33gHl8l_7_wmnCi.jpg', 17),
(48, '/upload/2016-12-23/9602VfRk320QnGiTNlGq0avAbyiuB5nIdgu.jpg', 1, '2285013860954227184', NULL, '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '3002VfRk320QnGiTNlGq0avAbyiuB5nIdgu.jpg', '9602VfRk320QnGiTNlGq0avAbyiuB5nIdgu.jpg', '/upload/2016-12-23/3002VfRk320QnGiTNlGq0avAbyiuB5nIdgu.jpg', 17),
(49, '/upload/2016-12-23/960TC9hCcSah0CETmvhoWJG3AysLEbql57R.jpg', 1, '6630782992189304326', NULL, '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '300TC9hCcSah0CETmvhoWJG3AysLEbql57R.jpg', '960TC9hCcSah0CETmvhoWJG3AysLEbql57R.jpg', '/upload/2016-12-23/300TC9hCcSah0CETmvhoWJG3AysLEbql57R.jpg', 18),
(50, '/upload/2016-12-23/9606mAeUjsOpDs-oZul5n6hD0f5EimfXRb6.jpg', 1, '6630718121000930859', NULL, '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '3006mAeUjsOpDs-oZul5n6hD0f5EimfXRb6.jpg', '9606mAeUjsOpDs-oZul5n6hD0f5EimfXRb6.jpg', '/upload/2016-12-23/3006mAeUjsOpDs-oZul5n6hD0f5EimfXRb6.jpg', 18),
(51, '/upload/2016-12-23/960T4m-cLehckrJATr2TygGDMQaTi8_i8QF.jpg', 1, '6630679638096289759', NULL, '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '300T4m-cLehckrJATr2TygGDMQaTi8_i8QF.jpg', '960T4m-cLehckrJATr2TygGDMQaTi8_i8QF.jpg', '/upload/2016-12-23/300T4m-cLehckrJATr2TygGDMQaTi8_i8QF.jpg', 18),
(52, '/upload/2016-12-23/960FY7e6Hz7IHTfaPI5aQcs9r6P_2vZ1Kzu.jpg', 1, '2061804204505593876', NULL, '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '300FY7e6Hz7IHTfaPI5aQcs9r6P_2vZ1Kzu.jpg', '960FY7e6Hz7IHTfaPI5aQcs9r6P_2vZ1Kzu.jpg', '/upload/2016-12-23/300FY7e6Hz7IHTfaPI5aQcs9r6P_2vZ1Kzu.jpg', 19),
(53, '/upload/2016-12-23/960HP-5otULHR65k93Ig5x2U9bzmqAIOy_G.jpg', 1, '1472677078250191130', NULL, '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '300HP-5otULHR65k93Ig5x2U9bzmqAIOy_G.jpg', '960HP-5otULHR65k93Ig5x2U9bzmqAIOy_G.jpg', '/upload/2016-12-23/300HP-5otULHR65k93Ig5x2U9bzmqAIOy_G.jpg', 19),
(54, '/upload/2016-12-23/960eXeoSRfvDa3qD-VazqHcq0rbIjR3ASzs.jpg', 1, '1271422469902167572', NULL, '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '300eXeoSRfvDa3qD-VazqHcq0rbIjR3ASzs.jpg', '960eXeoSRfvDa3qD-VazqHcq0rbIjR3ASzs.jpg', '/upload/2016-12-23/300eXeoSRfvDa3qD-VazqHcq0rbIjR3ASzs.jpg', 19),
(55, '/upload/2016-12-23/960OHb_5oqaD4pwMlLq24Kuf93dpTbDOTnw.jpg', 1, '6608761973306180321', NULL, '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '300OHb_5oqaD4pwMlLq24Kuf93dpTbDOTnw.jpg', '960OHb_5oqaD4pwMlLq24Kuf93dpTbDOTnw.jpg', '/upload/2016-12-23/300OHb_5oqaD4pwMlLq24Kuf93dpTbDOTnw.jpg', 20),
(56, '/upload/2016-12-23/960OTzgcwOMe3paTniXLoPUcBm9xVIl73Gq.jpg', 1, '6608479398817840665', NULL, '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '300OTzgcwOMe3paTniXLoPUcBm9xVIl73Gq.jpg', '960OTzgcwOMe3paTniXLoPUcBm9xVIl73Gq.jpg', '/upload/2016-12-23/300OTzgcwOMe3paTniXLoPUcBm9xVIl73Gq.jpg', 20),
(57, '/upload/2016-12-23/960DTsCuQYS91VIEgk12OqufbgXWPdSPNrR.jpg', 1, '3247939756364562783', NULL, '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '300DTsCuQYS91VIEgk12OqufbgXWPdSPNrR.jpg', '960DTsCuQYS91VIEgk12OqufbgXWPdSPNrR.jpg', '/upload/2016-12-23/300DTsCuQYS91VIEgk12OqufbgXWPdSPNrR.jpg', 21),
(58, '/upload/2016-12-23/960hB6K8B80-0fS8MgV0vc6V2dOKLkw2Vtc.jpg', 1, '3232740107622187334', NULL, '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '300hB6K8B80-0fS8MgV0vc6V2dOKLkw2Vtc.jpg', '960hB6K8B80-0fS8MgV0vc6V2dOKLkw2Vtc.jpg', '/upload/2016-12-23/300hB6K8B80-0fS8MgV0vc6V2dOKLkw2Vtc.jpg', 21),
(59, '/upload/2016-12-23/960ApJDkZ1rG_thf-7R0wMH4PnK9dZHNRAm.jpg', 1, '3187141161394846476', NULL, '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '300ApJDkZ1rG_thf-7R0wMH4PnK9dZHNRAm.jpg', '960ApJDkZ1rG_thf-7R0wMH4PnK9dZHNRAm.jpg', '/upload/2016-12-23/300ApJDkZ1rG_thf-7R0wMH4PnK9dZHNRAm.jpg', 21),
(60, '/upload/2016-12-23/960-YMcLtJNQlB_7vT6tRsRa_Ou_xax7I4e.jpg', 1, '6598286926028699965', NULL, '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '300-YMcLtJNQlB_7vT6tRsRa_Ou_xax7I4e.jpg', '960-YMcLtJNQlB_7vT6tRsRa_Ou_xax7I4e.jpg', '/upload/2016-12-23/300-YMcLtJNQlB_7vT6tRsRa_Ou_xax7I4e.jpg', 22),
(61, '/upload/2016-12-23/9607RqfrOPxInRJBXJCnqjG4BFPaT83F2Ev.jpg', 1, '2111906750360143465', NULL, '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '3007RqfrOPxInRJBXJCnqjG4BFPaT83F2Ev.jpg', '9607RqfrOPxInRJBXJCnqjG4BFPaT83F2Ev.jpg', '/upload/2016-12-23/3007RqfrOPxInRJBXJCnqjG4BFPaT83F2Ev.jpg', 23),
(62, '/upload/2016-12-23/960G41zZaE_Y6TfNjd_kwFj5rpZ1owhDr6k.jpg', 1, '290200701089078256', NULL, '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '300G41zZaE_Y6TfNjd_kwFj5rpZ1owhDr6k.jpg', '960G41zZaE_Y6TfNjd_kwFj5rpZ1owhDr6k.jpg', '/upload/2016-12-23/300G41zZaE_Y6TfNjd_kwFj5rpZ1owhDr6k.jpg', 23),
(63, '/upload/2016-12-23/960Kr6YvlPijxYYnnUszD40J_5VjDhtGFsr.jpg', 1, '6598104407159382329', NULL, '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '300Kr6YvlPijxYYnnUszD40J_5VjDhtGFsr.jpg', '960Kr6YvlPijxYYnnUszD40J_5VjDhtGFsr.jpg', '/upload/2016-12-23/300Kr6YvlPijxYYnnUszD40J_5VjDhtGFsr.jpg', 24),
(64, '/upload/2016-12-23/960j0D7sTJjxXHVYpRLszo8LfRtMIgDA8mj.jpg', 1, '4833206825199161968', NULL, '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '300j0D7sTJjxXHVYpRLszo8LfRtMIgDA8mj.jpg', '960j0D7sTJjxXHVYpRLszo8LfRtMIgDA8mj.jpg', '/upload/2016-12-23/300j0D7sTJjxXHVYpRLszo8LfRtMIgDA8mj.jpg', 24),
(65, '/upload/2016-12-23/960ntcKCxdyiBa5xjoeGxH3KInmVgBcRtvt.jpg', 1, '1998753809723282742', NULL, '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '300ntcKCxdyiBa5xjoeGxH3KInmVgBcRtvt.jpg', '960ntcKCxdyiBa5xjoeGxH3KInmVgBcRtvt.jpg', '/upload/2016-12-23/300ntcKCxdyiBa5xjoeGxH3KInmVgBcRtvt.jpg', 24),
(66, '/upload/2016-12-23/960bWpMGyPxli_r_LT2YcGjylQM5_JwRrhV.jpg', 1, '1626362415535134913', NULL, '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '300bWpMGyPxli_r_LT2YcGjylQM5_JwRrhV.jpg', '960bWpMGyPxli_r_LT2YcGjylQM5_JwRrhV.jpg', '/upload/2016-12-23/300bWpMGyPxli_r_LT2YcGjylQM5_JwRrhV.jpg', 24),
(67, '/upload/2016-12-23/960vnwPMcdQlo8dv4LTlaCJin5RqpV5Ppak.jpg', 1, '6631209602700886520', NULL, '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '300vnwPMcdQlo8dv4LTlaCJin5RqpV5Ppak.jpg', '960vnwPMcdQlo8dv4LTlaCJin5RqpV5Ppak.jpg', '/upload/2016-12-23/300vnwPMcdQlo8dv4LTlaCJin5RqpV5Ppak.jpg', 25),
(68, '/upload/2016-12-23/960kk8ppFuELw-vkxOwKciAptaIs4xdjx3Y.jpg', 1, '6630714822468753931', NULL, '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '300kk8ppFuELw-vkxOwKciAptaIs4xdjx3Y.jpg', '960kk8ppFuELw-vkxOwKciAptaIs4xdjx3Y.jpg', '/upload/2016-12-23/300kk8ppFuELw-vkxOwKciAptaIs4xdjx3Y.jpg', 25),
(69, '/upload/2016-12-23/9606FVyndbqlMArdKSQnZB4UH5J4zkK4Hkk.jpg', 1, '6619437131701218659', NULL, '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '3006FVyndbqlMArdKSQnZB4UH5J4zkK4Hkk.jpg', '9606FVyndbqlMArdKSQnZB4UH5J4zkK4Hkk.jpg', '/upload/2016-12-23/3006FVyndbqlMArdKSQnZB4UH5J4zkK4Hkk.jpg', 25),
(70, '/upload/2016-12-23/960kRIQq6Pdrw0N_JKvGCB3UDO1du_r8VLi.jpg', 1, '6632212357303429079', NULL, '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '300kRIQq6Pdrw0N_JKvGCB3UDO1du_r8VLi.jpg', '960kRIQq6Pdrw0N_JKvGCB3UDO1du_r8VLi.jpg', '/upload/2016-12-23/300kRIQq6Pdrw0N_JKvGCB3UDO1du_r8VLi.jpg', 26),
(71, '/upload/2016-12-23/96058I3AN_OI4VkMREqDGkZTVEYJ76-BVJD.jpg', 1, '6632206859745283100', NULL, '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '30058I3AN_OI4VkMREqDGkZTVEYJ76-BVJD.jpg', '96058I3AN_OI4VkMREqDGkZTVEYJ76-BVJD.jpg', '/upload/2016-12-23/30058I3AN_OI4VkMREqDGkZTVEYJ76-BVJD.jpg', 26),
(72, '/upload/2016-12-23/960DSmLADruIKUpSta1gKB_rZE5Je2gyHV7.jpg', 1, '6632194765117374143', NULL, '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '300DSmLADruIKUpSta1gKB_rZE5Je2gyHV7.jpg', '960DSmLADruIKUpSta1gKB_rZE5Je2gyHV7.jpg', '/upload/2016-12-23/300DSmLADruIKUpSta1gKB_rZE5Je2gyHV7.jpg', 26),
(73, '/upload/2016-12-23/960IMFauIduUOzOvYTo0Sc0SWgbtZa44_vi.jpg', 1, '6632178272442962189', NULL, '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '300IMFauIduUOzOvYTo0Sc0SWgbtZa44_vi.jpg', '960IMFauIduUOzOvYTo0Sc0SWgbtZa44_vi.jpg', '/upload/2016-12-23/300IMFauIduUOzOvYTo0Sc0SWgbtZa44_vi.jpg', 26),
(74, '/upload/2016-12-23/960pCSFSWlwqgTDpnC-tWbaUAH_wzBHj38P.jpg', 1, '6632151884163893516', NULL, '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '300pCSFSWlwqgTDpnC-tWbaUAH_wzBHj38P.jpg', '960pCSFSWlwqgTDpnC-tWbaUAH_wzBHj38P.jpg', '/upload/2016-12-23/300pCSFSWlwqgTDpnC-tWbaUAH_wzBHj38P.jpg', 26),
(75, '/upload/2016-12-23/960i3HJoQdgBJFzlBrTUrN64jecLqpPRJhC.jpg', 1, '6632138690024358895', NULL, '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '300i3HJoQdgBJFzlBrTUrN64jecLqpPRJhC.jpg', '960i3HJoQdgBJFzlBrTUrN64jecLqpPRJhC.jpg', '/upload/2016-12-23/300i3HJoQdgBJFzlBrTUrN64jecLqpPRJhC.jpg', 26),
(76, '/upload/2016-12-23/960hdnDAKbk_22BbZpGbaQaib0Hm6julgwr.jpg', 1, '6631471286469406889', NULL, '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '300hdnDAKbk_22BbZpGbaQaib0Hm6julgwr.jpg', '960hdnDAKbk_22BbZpGbaQaib0Hm6julgwr.jpg', '/upload/2016-12-23/300hdnDAKbk_22BbZpGbaQaib0Hm6julgwr.jpg', 26),
(77, '/upload/2016-12-23/960Z987JVDoOhqM49ZqJAXLK-uli0FXumg0.jpg', 1, '6632182670489642039', NULL, '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '300Z987JVDoOhqM49ZqJAXLK-uli0FXumg0.jpg', '960Z987JVDoOhqM49ZqJAXLK-uli0FXumg0.jpg', '/upload/2016-12-23/300Z987JVDoOhqM49ZqJAXLK-uli0FXumg0.jpg', 27),
(78, '/upload/2016-12-23/960rzD1_xsPcZYqBTCgixUoYitEJIVXj9F9.jpg', 1, '6632099107605930517', NULL, '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '300rzD1_xsPcZYqBTCgixUoYitEJIVXj9F9.jpg', '960rzD1_xsPcZYqBTCgixUoYitEJIVXj9F9.jpg', '/upload/2016-12-23/300rzD1_xsPcZYqBTCgixUoYitEJIVXj9F9.jpg', 27),
(79, '/upload/2016-12-23/960kWMyQh6eOI8Cm8A9ACLaNuJqV3wYituC.jpg', 1, '6631911091117578562', NULL, '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '300kWMyQh6eOI8Cm8A9ACLaNuJqV3wYituC.jpg', '960kWMyQh6eOI8Cm8A9ACLaNuJqV3wYituC.jpg', '/upload/2016-12-23/300kWMyQh6eOI8Cm8A9ACLaNuJqV3wYituC.jpg', 27),
(80, '/upload/2016-12-23/960md9DjaM5M9DeA_qqBRZyuJkRn7pps6f8.jpg', 1, '6631848418954795229', NULL, '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '300md9DjaM5M9DeA_qqBRZyuJkRn7pps6f8.jpg', '960md9DjaM5M9DeA_qqBRZyuJkRn7pps6f8.jpg', '/upload/2016-12-23/300md9DjaM5M9DeA_qqBRZyuJkRn7pps6f8.jpg', 27),
(81, '/upload/2016-12-23/960rBgrX9wuxIAuliLgKNPE8Azntjt8TTk_.jpg', 1, '6631503172306783431', NULL, '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '300rBgrX9wuxIAuliLgKNPE8Azntjt8TTk_.jpg', '960rBgrX9wuxIAuliLgKNPE8Azntjt8TTk_.jpg', '/upload/2016-12-23/300rBgrX9wuxIAuliLgKNPE8Azntjt8TTk_.jpg', 27),
(82, '/upload/2016-12-23/960DrwqQ4lgX89Pe0lKskcjciV-RvNW1ULa.jpg', 1, '6631498774260272338', NULL, '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '300DrwqQ4lgX89Pe0lKskcjciV-RvNW1ULa.jpg', '960DrwqQ4lgX89Pe0lKskcjciV-RvNW1ULa.jpg', '/upload/2016-12-23/300DrwqQ4lgX89Pe0lKskcjciV-RvNW1ULa.jpg', 27),
(83, '/upload/2016-12-23/960yOGsT_e4EOoEiERhBZJ2HkvJqLH228eR.jpg', 1, '6631436102097428966', NULL, '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '300yOGsT_e4EOoEiERhBZJ2HkvJqLH228eR.jpg', '960yOGsT_e4EOoEiERhBZJ2HkvJqLH228eR.jpg', '/upload/2016-12-23/300yOGsT_e4EOoEiERhBZJ2HkvJqLH228eR.jpg', 28),
(84, '/upload/2016-12-23/960iPTUm1e4duiUN3jkvJF_fxg8R7mPUVqA.jpg', 1, '6631410813329989577', NULL, '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '300iPTUm1e4duiUN3jkvJF_fxg8R7mPUVqA.jpg', '960iPTUm1e4duiUN3jkvJF_fxg8R7mPUVqA.jpg', '/upload/2016-12-23/300iPTUm1e4duiUN3jkvJF_fxg8R7mPUVqA.jpg', 28),
(85, '/upload/2016-12-23/960_kvTt8iZgsqWkBtkvdQY_4IVbC8psBP4.jpg', 1, '6631402017236957933', NULL, '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '300_kvTt8iZgsqWkBtkvdQY_4IVbC8psBP4.jpg', '960_kvTt8iZgsqWkBtkvdQY_4IVbC8psBP4.jpg', '/upload/2016-12-23/300_kvTt8iZgsqWkBtkvdQY_4IVbC8psBP4.jpg', 28),
(86, '/upload/2016-12-23/960FX_uANAIKpjy49BbslFxLJ9KPOcM8FOp.jpg', 1, '6631382226027674726', NULL, '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '300FX_uANAIKpjy49BbslFxLJ9KPOcM8FOp.jpg', '960FX_uANAIKpjy49BbslFxLJ9KPOcM8FOp.jpg', '/upload/2016-12-23/300FX_uANAIKpjy49BbslFxLJ9KPOcM8FOp.jpg', 28),
(87, '/upload/2016-12-23/960DezoGA7wUQOc94h0GjwTEQSTTybp5r6w.jpg', 1, '6631355837748597943', NULL, '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '300DezoGA7wUQOc94h0GjwTEQSTTybp5r6w.jpg', '960DezoGA7wUQOc94h0GjwTEQSTTybp5r6w.jpg', '/upload/2016-12-23/300DezoGA7wUQOc94h0GjwTEQSTTybp5r6w.jpg', 28),
(88, '/upload/2016-12-23/960_wK_a6oddj0-kXi6ImMFQwK_ZqWFxTyy.jpg', 1, '6631354738236969890', NULL, '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '300_wK_a6oddj0-kXi6ImMFQwK_ZqWFxTyy.jpg', '960_wK_a6oddj0-kXi6ImMFQwK_ZqWFxTyy.jpg', '/upload/2016-12-23/300_wK_a6oddj0-kXi6ImMFQwK_ZqWFxTyy.jpg', 28),
(89, '/upload/2016-12-23/960LOYqfbx0EbnDaMWCetJMo-CLyKutDmHO.jpg', 1, '6631331648492763598', NULL, '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '300LOYqfbx0EbnDaMWCetJMo-CLyKutDmHO.jpg', '960LOYqfbx0EbnDaMWCetJMo-CLyKutDmHO.jpg', '/upload/2016-12-23/300LOYqfbx0EbnDaMWCetJMo-CLyKutDmHO.jpg', 28),
(90, '/upload/2016-12-23/960ZCzwdING6_EnDFGk2ogqiEPQ-EdQ1226.jpg', 1, '6631264578283487631', NULL, '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '300ZCzwdING6_EnDFGk2ogqiEPQ-EdQ1226.jpg', '960ZCzwdING6_EnDFGk2ogqiEPQ-EdQ1226.jpg', '/upload/2016-12-23/300ZCzwdING6_EnDFGk2ogqiEPQ-EdQ1226.jpg', 28),
(91, '/upload/2016-12-23/960MhM6fCFqdu8Na4BaTEgYBcfSjQ0ZHdjZ.jpg', 1, '6631263478771859283', NULL, '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '300MhM6fCFqdu8Na4BaTEgYBcfSjQ0ZHdjZ.jpg', '960MhM6fCFqdu8Na4BaTEgYBcfSjQ0ZHdjZ.jpg', '/upload/2016-12-23/300MhM6fCFqdu8Na4BaTEgYBcfSjQ0ZHdjZ.jpg', 28),
(92, '/upload/2016-12-23/960NgEPua7-gWPYe6C8YSsKFiXqmvlaKp1f.jpg', 1, '6631200806609080934', NULL, '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '300NgEPua7-gWPYe6C8YSsKFiXqmvlaKp1f.jpg', '960NgEPua7-gWPYe6C8YSsKFiXqmvlaKp1f.jpg', '/upload/2016-12-23/300NgEPua7-gWPYe6C8YSsKFiXqmvlaKp1f.jpg', 28),
(93, '/upload/2017-02-21/960ezs-5szdENn6CtCQxtPzoCL9ydlUitJM.jpg', 1, 'IMG_0328', NULL, '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '无数据', '300ezs-5szdENn6CtCQxtPzoCL9ydlUitJM.jpg', '960ezs-5szdENn6CtCQxtPzoCL9ydlUitJM.jpg', '/upload/2017-02-21/300ezs-5szdENn6CtCQxtPzoCL9ydlUitJM.jpg', 29);

-- --------------------------------------------------------

--
-- 表的结构 `photography_info`
--

CREATE TABLE IF NOT EXISTS `photography_info` (
  `id` int(11) NOT NULL,
  `camera` varchar(255) DEFAULT NULL COMMENT '常用相机',
  `lens` varchar(255) DEFAULT NULL COMMENT '常用镜头',
  `preference` varchar(150) DEFAULT NULL COMMENT '主题偏好',
  `homepage` varchar(150) DEFAULT NULL COMMENT '个人主页',
  `sign` varchar(80) DEFAULT NULL COMMENT '摄影签名',
  `user_id` int(11) NOT NULL COMMENT '用户id'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='摄影资料';

--
-- 转存表中的数据 `photography_info`
--

INSERT INTO `photography_info` (`id`, `camera`, `lens`, `preference`, `homepage`, `sign`, `user_id`) VALUES
(1, '佳能5D Mark II', '佳能50mm F1.8', '1,2', 'http://www.meetmax.xyz', 'Think Different', 1),
(2, '尼康D90', '尼康 18-105mm f3.5-f4.5', '1,2,11', 'http://', '爱生活，爱艺术，爱科技。', 2),
(3, '5D Mark III', '佳能 50mm F1.4 USM', '1,11', 'http://', '', 3),
(4, NULL, NULL, NULL, NULL, NULL, 4);

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL COMMENT '用户名',
  `auth_key` varchar(32) NOT NULL,
  `token` varchar(64) DEFAULT NULL,
  `access_token` varchar(255) DEFAULT NULL,
  `password_hash` varchar(255) NOT NULL,
  `password_reset_token` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '1',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `token`, `access_token`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`) VALUES
(1, 'max1994', 'M_ejIp2X_2QGO1ytB2lzIzy31nHJR8cH', NULL, NULL, '$2y$13$6l.wmPVRZmesoE05RxpVv.0smM//mVj9p7jStPQ/LkKan1wH8P0aq', NULL, '499282083@qq.com', 10, 1482469751, 1482490455),
(2, 'max1995', 'zZ6S9AK09gfKqcCOJniN620JY-jToYls', NULL, NULL, '$2y$13$110c0CSMp3aX3XTrSx8eu.XEPITv4.bNDstJj6tLLrd2hXv2.QY.2', NULL, '4992820@qq.com', 10, 1482476807, 1482477777),
(3, 'max1996', '2ojvDeFICjKsbd-Zjnp9U2rotdBnqWtN', NULL, 'r3Khm2iajRDGdDcWQEKmZdcalv3Zk-I5_fe57d6f39e1e76651941f4a50502ad3b', '$2y$13$XeqXC.p9CCUpO.tiOisJDerjdlnv01cgu//bITqUSuM5GOfVsxEEq', NULL, '499220@qq.com', 10, 1482477798, 1482477798),
(4, 'meetmax', '0W9KlRCGxlnU1rx9XrLucvOtBX9V3y94', NULL, 'F_fE4-9TbPwMP4IHgzrv_3xTeO-0OXEa_d41d8cd98f00b204e9800998ecf8427e', '$2y$13$4gYKP/OoZz3MwDHmAadFPuhjPFthr.iDXBX6djZqRJ8nXSkIW/vT.', NULL, '49928208@qq.com', 10, 1487665301, 1487666523);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `album`
--
ALTER TABLE `album`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bg_image`
--
ALTER TABLE `bg_image`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `follow_byfollow`
--
ALTER TABLE `follow_byfollow`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `haha`
--
ALTER TABLE `haha`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `like_bylike`
--
ALTER TABLE `like_bylike`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `person_info`
--
ALTER TABLE `person_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `photo`
--
ALTER TABLE `photo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `photography_info`
--
ALTER TABLE `photography_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `album`
--
ALTER TABLE `album`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `bg_image`
--
ALTER TABLE `bg_image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '分类id',AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `follow_byfollow`
--
ALTER TABLE `follow_byfollow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `haha`
--
ALTER TABLE `haha`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `like_bylike`
--
ALTER TABLE `like_bylike`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `person_info`
--
ALTER TABLE `person_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `photo`
--
ALTER TABLE `photo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '照片id',AUTO_INCREMENT=94;
--
-- AUTO_INCREMENT for table `photography_info`
--
ALTER TABLE `photography_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
