CREATE TABLE IF NOT EXISTS `pre_apply` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL COMMENT '网站名称',
  `img` varchar(500) NOT NULL COMMENT '网站图标',
  `catename` varchar(255) NOT NULL COMMENT '网站分类',
  `url` varchar(500) NOT NULL COMMENT '网站URL',
  `keywords` varchar(255) NOT NULL COMMENT '网站关键词',
  `introduce` text NOT NULL COMMENT '网站介绍',
  `reject` int(2) NOT NULL DEFAULT '0' COMMENT '拒绝收录：0待审核1拒绝',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `update_time` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;</explode>

INSERT INTO `pre_apply` (`id`, `name`, `img`, `catename`, `url`, `keywords`, `introduce`, `reject`) VALUES
(1, 'hao123导航', 'https://www.hao123.com/favicon.ico', '目录导航', 'https://www.hao123.com', '上网导航,网址大全,网址导航,hao123上网导航,hao123网址,hao123导航,hao123网址大全,hao123活动,抽奖活动', 'hao123是汇集全网优质网址及资源的中文上网导航。及时收录影视、音乐、小说、游戏等分类的网址和内容，让您的网络生活更简单精彩。上网，从hao123开始。', 1),
(2, '好看视频', 'https://hk.bdstatic.com/app/favicon.ico', '影音娱乐', 'https://haokan.baidu.com', '好看视频APP,短视频,小视频,高清视频,vlog,vlog拍摄器,影视视频,音乐视频,搞笑视频,直播,娱乐视频,动漫视频,明星视频,明星视频,亲子视频,宠物视频', '好看视频是百度短视频旗舰品牌，拥有超百万的短视频创作者。全面覆盖知识、美食、生活、健康、文化、游戏、影视等海量视频，致力于为用户提供优质的视频内容与观看体验，让用户轻松有收获。', 0);</explode>

CREATE TABLE IF NOT EXISTS `pre_config` (
  `k` varchar(255) NOT NULL,
  `v` text,
  PRIMARY KEY (`k`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;</explode>

INSERT INTO `pre_config` (`k`, `v`) VALUES
('admin_user', 'admin'),
('admin_pwd', '123456'),
('qq', '350430869'),
('email', 'jksdou@qq.com'),
('name', '程江网址导航系统'),
('title', '程江网址导航系统_分类目录_收录精选的导航网站'),
('keywords', '导航系统,网站导航,程江网址导航系统,分类目录'),
('description', '程江网址导航系统为您提供网站分类目录索引及网址大全库的建立，旨在为用户提供高效便捷的网址存储和查询服务，同时提供最全的优秀名站导航。'),
('icp', '沪ICP备20016252号'),
('script_header', '<!-- script_header -->'),
('script_footer', '<!-- script_footer -->'),
('info', '免责声明：程江网址导航系统所列站点收集于全球互联网，内容与本站无关'),
('shots_api', '//s0.wp.com/mshots/v1/'),
('ico_api', '//icon.hhpp.net/get.php?url='),
('tdk_api', '//yuanxiapi.cn/api/info/?url=');</explode>

CREATE TABLE IF NOT EXISTS `pre_link` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL COMMENT '站点名称',
  `url` varchar(500) NOT NULL COMMENT '站点URL',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `update_time` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;</explode>

INSERT INTO `pre_link` (`id`, `name`, `url`) VALUES
(1, '程江科技', 'https://crogram.com'),
(2, '程江开源', 'https://crogram.org'),
(3, '百度', 'https://www.baidu.com'),
(4, '前端笔记', 'https://uinote.com'),
(5, '唐钰豆豆', 'https://doudoudzj.com');</explode>

CREATE TABLE IF NOT EXISTS `pre_site` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lid` int(11) NOT NULL DEFAULT '1' COMMENT '数字越小排名越前',
  `name` varchar(255) NOT NULL COMMENT '站点名称',
  `img` varchar(500) NOT NULL COMMENT '站点图标',
  `catename` varchar(255) NOT NULL COMMENT '站点分类',
  `url` varchar(500) NOT NULL COMMENT '站点链接',
  `alias` varchar(255) DEFAULT NULL COMMENT '站点链接别名[a-zA-Z]+',
  `keywords` varchar(255) NOT NULL COMMENT '关键词',
  `introduce` text NOT NULL COMMENT '站点描述',
  `time` varchar(50) NOT NULL COMMENT '收录日期',
  `hits_total` int(20) NOT NULL DEFAULT '0' COMMENT '总浏览数',
  `hits_month` int(20) NOT NULL DEFAULT '0' COMMENT '月浏览数',
  `hits_day` int(20) NOT NULL DEFAULT '0' COMMENT '日浏览数',
  `date` varchar(50) NOT NULL COMMENT '年-月-日',
  `datem` varchar(50) NOT NULL COMMENT '年-月',
  `like` int(20) NOT NULL DEFAULT '0' COMMENT '点赞数',
  `tui` int(2) NOT NULL DEFAULT '0' COMMENT '是否推荐：1是0否',
  `star` int(2) NOT NULL DEFAULT '2' COMMENT '站点星级：12345个等级',
  `drtime` timestamp NULL DEFAULT NULL COMMENT '站点回访时间',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `update_time` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;</explode>

INSERT INTO `pre_site` (`id`, `lid`, `name`, `img`, `catename`, `url`, `alias`, `keywords`, `introduce`, `time`, `drtime`, `hits_total`, `hits_month`, `hits_day`, `date`, `datem`, `like`, `tui`, `star`, `create_time`, `update_time`) VALUES
(1,1,'网易','/img/favicon/www.163.com.png','社会生活','https://www.163.com','','','网易是中国领先的互联网技术公司，为用户提供免费邮箱、游戏、搜索引擎服务，开设新闻、娱乐、体育等30多个内容频道，及博客、视频、论坛等互动交流，网聚人的力量。','2020-10-23',155,2,2,'2024-03-23','2024-03',0,1,5,NULL,'2022-01-20 17:07:04','2024-03-23 19:16:13'),
(2,2,'豆瓣网','https://www.douban.com/favicon.ico','博客社区','https://www.douban.com','','豆瓣,小组,电影,同城,豆品,广播,登录豆瓣','豆瓣网提供图书、电影、音乐唱片的推荐、评论和价格比较，以及城市独特的文化生活。','2022-01-20',146,2,1,'2024-03-26','2024-03',3,1,5,NULL,'2022-01-20 17:07:04','2024-03-26 09:54:20'),
(3,3,'搜狐','https://statics.itc.cn/web/static/images/pic/sohu-logo/favicon.ico','社会生活','https://www.sohu.com','','搜狐,门户网站,新媒体,网络媒体,新闻,财经,体育,娱乐,时尚,汽车,房产,科技,图片,论坛,微博,博客,视频,电影,电视剧','搜狐网为用户提供24小时不间断的最新资讯，及搜索、邮件等网络服务。内容包括全球热点事件、突发新闻、时事评论、热播影视剧、体育赛事、行业动态、生活服务信息，以及论坛、博客、微博、我的搜狐等互动空间。','2020-10-23',68,1,1,'2024-03-23','2024-03',1,1,5,NULL,'2022-01-20 17:07:04','2024-03-23 10:52:57'),
(4,4,'新浪','https://www.sina.com.cn/favicon.ico','社会生活','https://www.sina.com.cn','','新浪,新浪网,SINA,sina,sina.com.cn,新浪首页,门户,资讯','新浪网为全球用户24小时提供全面及时的中文资讯，内容覆盖国内外突发新闻事件、体坛赛事、娱乐时尚、产业资讯、实用信息等，设有新闻、体育、娱乐、财经、科技、房产、汽车等30多个内容频道，同时开设博客、视频、论坛等自由互动交流空间。','2022-01-20',62,1,1,'2024-03-23','2024-03',0,1,5,NULL,'2022-01-20 17:07:04','2024-03-23 10:52:58'),
(5,5,'hao123导航网','/img/favicon/www.hao123.com.png','目录导航','https://www.hao123.com','','上网导航,网址大全,网址导航,hao123上网导航,hao123网址,hao123导航,hao123网址大全,hao123活动, 抽奖活动','hao123是汇集全网优质网址及资源的中文上网导航。及时收录影视、音乐、小说、游戏等分类的网址和内容，让您的网络生活更简单精彩。上网，从hao123开始。','2021-10-25',79,1,1,'2024-03-23','2024-03',0,1,5,NULL,'2022-01-20 17:07:04','2024-03-23 10:53:00'),
(6,6,'百度','/img/favicon/www.baidu.com.png','社会生活','https://www.baidu.com','','百度','全球最大的中文搜索引擎、致力于让网民更便捷地获取信息，找到所求。百度超过千亿的中文网页数据库，可以瞬间找到相关的搜索结果。','2021-10-25',58,2,1,'2024-03-23','2024-03',1,1,5,'2024-03-19 00:27:26','2022-01-20 17:07:04','2024-03-23 10:53:04'),
(7,7,'腾讯','https://mat1.gtimg.com/qqcdn/qqindex2021/favicon.ico','社会生活','https://www.qq.com','','资讯,新闻,财经,房产,视频,NBA,科技,腾讯网,腾讯,QQ,Tencent','腾讯网从2003年创立至今，已经成为集新闻信息，区域垂直生活服务、社会化媒体资讯和产品为一体的互联网媒体平台。腾讯网下设新闻、科技、财经、娱乐、体育、汽车、时尚等多个频道，充分满足用户对不同类型资讯的需求。同时专注不同领域内容，打造精品栏目，并顺应技术发展趋势，推出网络直播等创新形式，改变了用户获取资讯的方式和习惯。','2020-10-23',54,1,1,'2024-03-23','2024-03',0,1,5,NULL,'2022-01-20 17:07:04','2024-03-23 10:53:06'),
(8,8,'百万站','/img/favicon/www.baiwanzhan.com.png','目录导航','http://www.baiwanzhan.com','','百万站','百万站-百万优秀网站的大本营,深受百万站长喜爱与支持的网站收录与提交入口！百万站官网汇聚百万精品网站，与您分享百万精彩网站知识。我们深信：每一个优秀网站的背后都有一个值得我们解读的故事。','2022-01-22',52,2,1,'2024-03-23','2024-03',0,0,5,NULL,'2022-01-20 17:07:04','2024-03-23 10:53:09'),
(9,9,'淘宝网','https://www.taobao.com/favicon.ico','社会生活','https://www.taobao.com','','','淘宝网 - 亚洲较大的网上交易平台，提供各类服饰、美容、家居、数码、话费/点卡充值… 数亿优质商品，同时提供担保交易(先收货后付款)等安全交易保障服务，并由商家提供退货承诺、破损补寄等消费者保障服务，让你安心享受网上购物乐趣！','2020-10-23',48,1,1,'2024-03-23','2024-03',0,1,5,NULL,'2022-01-20 17:07:04','2024-03-23 10:53:12'),
(10,10,'京东','https://www.jd.com/favicon.ico','社会生活','https://www.jd.com','','网上购物,网上商城,家电,手机,电脑,服装,居家,母婴,美妆,个护,食品,生鲜,京东','京东JD.COM-专业的综合网上购物商城，为您提供正品低价的购物选择、优质便捷的服务体验。商品来自全球数十万品牌商家，囊括家电、手机、电脑、服装、居家、母婴、美妆、个护、食品、生鲜等丰富品类，满足各种购物需求。','2020-10-25',48,1,1,'2024-03-23','2024-03',0,1,5,NULL,'2022-01-20 17:07:04','2024-03-23 10:51:57'),
(11,11,'前端笔记','/img/favicon/www.uinote.com.png','博客社区','https://uinote.com','','UINOTE,CSS,HTML,JavaScript,Mac,Linux,源码,网页开发,源码下载,小程序源码','UINOTE旨在记录实用有价值的内容，我们主张通过简单明了的文字，清晰的逻辑，直接呈现出要表达的内容。','2020-10-24',49,3,2,'2024-03-26','2024-03',1,1,5,NULL,'2022-01-20 17:07:04','2024-03-26 09:56:50'),
(12,12,'中国建设银行','/img/favicon/www.ccb.com.png','投资理财','http://www.ccb.com','','建设银行','中国建设银行，在全球范围内为台湾、香港、美国、澳大利亚等国家或地区提供全面金融服务，主要经营公司银行业务、个人银行业务和资金业务，包括居民储蓄存款、信贷资金贷款、住房类贷款、外汇、信用卡，以及投资理财等多种业务。','2022-01-22',51,1,1,'2024-03-23','2024-03',0,0,5,NULL,'2022-01-20 17:07:04','2024-03-23 10:52:20'),
(13,13,'中国银行','/img/favicon/www.boc.cn.png','投资理财','https://www.boc.cn','','中国银行,中行,银行,金融,金融市场,外汇,理财,证券,基金,保险,投资,电子银行,网上银行,网银,手机银行,公司金融,跨境撮合,个人金融,出国金融,私人银行,银行卡,信用卡,飞机租赁,村镇银行,普惠金融,绿色金融,双奥银行','中国银行是中国国际化和多元化程度最高的银行，在中国内地及五十多个国家和地区为客户提供全面的金融服务。主要经营商业银行业务：公司金融、个人金融和金融市场业务，并通过附属机构开展投资银行、保险、直接投资、投资管理、基金管理和飞机租赁业务。','2024-03-12',47,1,1,'2024-03-23','2024-03',0,0,5,NULL,'2022-01-20 17:07:04','2024-03-23 10:52:21'),
(14,14,'腾讯视频','https://v.qq.com/favicon.ico','影音娱乐','https://v.qq.com','','腾讯视频,电影,电视剧,综艺,新闻,财经,音乐,MV,高清,视频,在线观看,全网搜,搜全网','腾讯视频致力于打造中国领先的在线视频媒体平台，以丰富的内容、极致的观看体验、便捷的登录方式、24小时多平台无缝应用体验以及快捷分享的产品特性，主要满足用户在线观看视频的需求。','2022-01-20',65,1,1,'2024-03-23','2024-03',0,1,5,NULL,'2022-01-20 17:07:04','2024-03-23 10:52:23'),
(15,15,'重庆分类目录网','/assets/images/default_ico.png','目录导航','https://www.023dir.com','','','重庆分类目录网站是免费收录各行业优秀的网站！提供网站分类信息检索、整理分类排序、按行业分类或关键词搜索查询；同时也是网站推广、网站排名、发布外链及提高网站权重等的分类目录平台。','2020-10-25',59,2,1,'2024-03-23','2024-03',0,0,5,NULL,'2022-01-20 17:07:04','2024-03-23 10:52:24'),
(16,1,'腾讯云','/img/favicon/cloud.tencent.com.png','IDC网站','https://cloud.tencent.com','','腾讯云,云服务器,云主机,CDN,对象存储,域名注册备案,云存储,云数据库,互联网+解决方案,QQ云','腾讯云为数百万的企业和开发者提供安全稳定的云计算服务，涵盖云服务器、云数据库、云存储、视频与CDN、域名注册等全方位云服务和各行业解决方案。','2024-03-13',78,6,1,'2024-03-23','2024-03',4,1,5,NULL,'2022-01-20 17:07:04','2024-03-23 10:52:26'),
(17,3,'阿里云','/img/favicon/www.aliyun.com.png','IDC网站','https://www.aliyun.com','','阿里云,云服务器,云计算,云数据库,注册公司,域名注册备案,行业解决方案,企业网盘','阿里云——阿里巴巴集团旗下公司，是全球领先的云计算及人工智能科技公司。提供免费试用、云服务器、云数据库、云安全、云企业应用等云计算服务，以及大数据、人工智能服务、精准定制基于场景的行业解决方案。免费备案，7x24小时售后支持，助企业无忧上云。','2022-01-20',44,1,1,'2024-03-23','2024-03',0,1,5,NULL,'2022-01-20 17:07:04','2024-03-23 10:52:27'),
(18,1,'爱站网','https://www.aizhan.com/favicon.ico','辅助工具','https://www.aizhan.com','','站长工具,百度权重查询,百度排名','爱站网站长工具提供网站收录查询和站长查询以及百度权重值查询等多个站长工具，免费查询各种工具，包括有关键词排名查询，百度收录查询等。','2021-10-25',97,1,1,'2024-03-23','2024-03',0,1,4,NULL,'2022-01-20 17:07:04','2024-03-23 10:52:28'),
(19,1,'北京大学','https://www.pku.edu.cn/favicon.ico','教育学习','https://www.pku.edu.cn','','北京大学','北京大学（Peking University），简称“北大”，是中华人民共和国教育部直属的全国重点大学，位列“双一流”、“211工程”、“985工程”，入选“学位授权自主审核单位”、“基础学科拔尖学生培养试验计划”、“基础学科招生改革试点”、“高等学校创新能力提升计划”、“高等学校学科创新引智计划”，为九校联盟、松联盟、中国大学校长联谊会、京港大学联盟、亚洲大学联盟、东亚研究型大学协会、国际研究型大学联盟、环太平洋大学联盟、21世纪学术联盟、东亚四大学论坛、国际公立大学论坛、中俄综合性大学联盟成员。','2021-10-25',36,1,1,'2024-03-23','2024-03',0,0,5,NULL,'2022-01-20 17:07:04','2024-03-23 10:52:30'),
(20,1,'程江开源','/img/favicon/www.crogram.org.png','软件IT','https://www.crogram.org','','程江®,程江开源,程江开源项目中心,程江科技,程江科技开源项目,CROGRAM,上海程江科技中心,上海程江科技有限公司','欢迎访问程江开源项目中心官方网站。程江科技提供技术服务、技术开发、技术咨询、技术交流、技术转让、技术推广以及软件开发等服务。','2024-03-14 16:17:39',33,1,1,'2024-03-23','2024-03',0,0,0,NULL,'2022-01-20 17:07:04','2024-03-23 10:52:34'),
(21,2,'0430网站库','/assets/images/default_ico.png','目录导航','http://www.0430.com','','0430网站库','0430网站库(0430.com)免费收录与分享各类正规网站。网站内容覆盖全球多个国家与地区，包含站长、设计、美食、旅游、文化、音乐、移动互联网等类别的优秀网站资源。','2022-01-21',61,2,1,'2024-03-23','2024-03',0,0,5,NULL,'2022-01-20 17:07:04','2024-03-23 10:52:36'),
(23,1,'聚名网','https://imgchaicp.oss-accelerate.aliyuncs.com/img/juming_ico.ico','IDC网站','https://www.juming.com','','老域名,域名,域名查询,域名抢注,域名买卖,域名交易,域名管理,聚名网,juming.com','聚名网-到期域名查询抢注-域名注册-老域名买卖交易平台。\r\n聚名网(juming.com)国内互联网域名综合服务平台，涵盖了域名注册查询、到期域名抢注、域名买卖交易、域名续费管理等多项业务。聚名致力于打造最好的域名交易平台，聚名，让域名创造更多价值！','2022-01-20',61,5,2,'2024-03-23','2024-03',0,1,5,NULL,'2022-01-20 17:07:04','2024-03-23 19:16:16'),
(24,1,'抖音短视频','/img/favicon/www.douyin.com.png','影音娱乐','https://www.douyin.com','','抖音,抖音音乐,抖音短视频,抖音官网,amemv,抖音app,抖音app下载','抖音短视频-记录美好生活的视频平台。','2021-09-06',78,2,2,'2024-03-23','2024-03',0,1,5,NULL,'2022-01-20 17:07:04','2024-03-23 19:16:17'),
(25,1,'景安网络','/img/favicon/www.zzidc.com.png','IDC网站','https://www.zzidc.com','','服务器托管,云服务器,VPS,云数据库,云存储,虚拟主机,域名注册,SSL证书,CDN,景安网络','景安网络（股票代码 832757）是专业的数据中心服务商，主营互联网数据中心、云计算、CDN、互联网安全等业务。目前运营2万余台服务器，服务网站数量达30万个。景安网络为企业和开发者提供安全、稳定的服务器托管、云服务器、VPS、CDN、域名注册、云存储、云数据库、SSL证书等服务。','2022-01-20',68,3,1,'2024-03-23','2024-03',1,1,5,NULL,'2022-01-20 17:07:04','2024-03-23 10:52:48'),
(26,1,'唐钰豆豆博客','/img/favicon/www.doudoudzj.com.png','博客社区','https://doudoudzj.com','','唐钰豆豆的博客,doudoudzj,唐钰豆豆,Jackson Dou','其实,我并不是木讷,而是单纯;并不是无情,而是痴情.真正深厚的感情,是只可意会不可言传的.如果说感情是水,那么我的感情,就如一潭深水,平静而深沉.','2022-01-20',74,4,1,'2024-03-26','2024-03',6,1,5,'2022-11-26 13:10:59','2022-01-20 17:07:04','2024-03-26 09:54:02'),
(1000,1,'九州网址','/img/favicon/www.9zwz.com.png','目录导航','http://www.9zwz.com','','九州,分类目录,网站收录,站长目录,网站目录,中文网站目录,网站分类,网站分类目录,网站大全,百科,问答,九州网','九州网址,实用的中文网站导航与百科问答知识分享。为您提供好用的网站导航、实用的网站收录、详细的网站介绍及网站点评参考，九州网址关怀您的网络生活,让您上网更方便!','2022-01-20',34,2,1,'2024-03-23','2024-03',0,0,2,NULL,'2022-01-20 17:07:04','2024-03-23 10:51:59'),
(1001,1,'懒人导航网','/img/favicon/www.biquge000.com.png','目录导航','https://www.biquge000.com','','懒人导航网,目录,网站分类目录,分类目录网站,分类目录','懒人导航网为您提供网站分类目录索引及网址大全库的建立，旨在为用户提供高效便捷的网址存储和查询服务，同时提供最全的优秀名站导航。','2022-01-20',38,2,1,'2024-03-23','2024-03',0,1,1,NULL,'2022-01-20 17:54:52','2024-03-23 10:52:00'),
(1002,1,'又拍云','https://www.upyun.com/static/favicon-64x64.png','IDC网站','https://www.upyun.com/?invite=HkG-mERtK','','CDN,云分发,云存储,SSL证书服务,HTTPS,短视频SDK,直播SDK,云服务','国内知名企业级云服务商,在全球拥有1100多个自建CDN节点,10TB保有带宽,为25万用户提供CDN,云存储,HTTPS／SSL证书,WebP,云处理,短视频开发SDK,直播开发SDK,DDos高防等一站式加速解决方案!','2022-01-20',38,1,1,'2024-03-23','2024-03',0,1,4,NULL,'2022-01-20 18:08:20','2024-03-23 10:52:01'),
(1003,1,'刀客源码','/img/favicon/www.dkewl.com.png','资源下载','https://www.dkewl.com/','','刀客资源网,PHP源码,PHP,网站源码,网站模板,软件源码,游戏源码,资源分享,资源,网站插件,工具软件,源码分享,商业源码,源码教程,免费源码','刀客源码是一个专业的网络资源分享平台,提供各种PHP源码、网站源码、游戏源码、模板插件、软件工具、网络教程、活动线报等,为中国站长提供一站式资源下载。','2024-03-12',43,1,1,'2024-03-23','2024-03',1,0,3,NULL,'2022-01-22 03:49:07','2024-03-23 10:52:04'),
(1004,1,'闪客云盘','/img/favicon/www.skpan.cn.png','资源下载','https://www.skpan.cn','','闪客网盘,闪客云盘,网络云盘,网盘联盟,网赚网盘,云盘,云存储,免费网盘,网盘下载,网盘存储,赚钱网盘,分成网盘,收益网盘','闪客云盘是一款速度快、不打扰、够安全、易于分享的网络云盘，提供了分享下载分成功能，分享赚钱，让资源变的有收益有价值！','2024-03-12',27,1,1,'2024-03-23','2024-03',1,0,3,NULL,'2022-01-22 16:57:23','2024-03-23 10:52:05'),
(1005,1,'有啦资源网','https://www.ylcom.net/wp-content/uploads/2020/06/1592807232-d02a42d9cb3dec9.ico','资源下载','https://www.ylcom.net/','','源码下载网站源码,小程序源码,模板插件,发卡源码,商城源码,热门软件,有啦资源网','有啦资源网长期为广大站长,程序员,企业老板提供一个源码下载,网站建设,系统搭建部署,交流探讨,学习研究的网站。','2022-01-26',40,1,1,'2024-03-23','2024-03',0,0,4,NULL,'2022-01-26 00:31:02','2024-03-23 10:52:07'),
(1006,1,'程江科技','/img/favicon/www.crogram.com.png','软件IT','https://www.crogram.com','','程江®,程江科技,CROGRAM,上海程江科技中心,上海程江科技有限公司','欢迎访问上海程江科技中心（程江®）官方网站。程江科技提供技术服务、技术开发、技术咨询、技术交流、技术转让、技术推广以及软件开发等服务。','2024-03-14 16:15:18',30,2,1,'2024-03-25','2024-03',0,1,5,NULL,'2022-01-27 03:10:00','2024-03-25 19:54:57'),
(1007,1,'免费素材pexels','https://www.pexels.com/favicon.ico','资源下载','https://www.pexels.com/zh-cn','','免费素材图片, pexels, 免费, 图片','免费素材图片和视频，可以在任何地方使用。✓ 高质量 ✓ 100% 免费✓ 无需注明归属','2024-03-13',27,1,1,'2024-03-23','2024-03',1,0,5,NULL,'2022-01-27 03:13:32','2024-03-23 10:52:09'),
(1008,1,'YaoCDN','/img/favicon/www.yaocdn.com.png','IDC网站','http://www.yaocdn.com/','','yaocdn,CDN,cache,云存储,免费云存储,免费CDN','YaoCDN CDN加速 免费CDN 免费云存储 云存储','2022-05-04',27,2,1,'2024-03-23','2024-03',0,0,4,NULL,'2022-05-04 19:07:59','2024-03-23 10:52:10'),
(1009,1,'面试简历','/img/favicon/www.mianshijianli.com.png','教育学习','http://www.mianshijianli.com/','','面试简历','面试简历','2024-03-13',48,48,2,'2024-03-26','2024-03',2,0,4,NULL,'2024-03-13 13:00:40','2024-03-26 09:45:09'),
(1010,1,'万网','/img/favicon/wanwang.aliyun.com.png','IDC网站','https://wanwang.aliyun.com','','万网,企航,域名注册,商标注册,资质备案','阿里云企航是基于云计算领先的互联网应用服务提供商，阿里云旗下品牌，是中国最大的域名注册服务提供商，中国虚拟主机服务的开创者，中国企业邮箱服务的领先者和中国网站建设服务的创新者。','2024-03-14',1,1,1,'2024-03-23','2024-03',0,0,4,NULL,'2024-03-14 16:04:44','2024-03-23 10:52:13'),
(1011,1,'UCloud','/img/favicon/www.ucloud.cn.png','IDC网站','https://www.ucloud.cn/','','云主机、云数据库、混合云、CDN、云计算、UCloud、优刻得、云服务器、互联网+解决方案、人工智能、全球服解决方案、科','UCloud(优刻得)是中国知名的中立云计算服务商，科创板上市(股票代码：688158)，中国云计算第一股，专注于提供可靠的企业级云服务，包括云服务器、云主机、云数据库、混合云、CDN、人工智能等服务。','2024-03-14',1,1,1,'2024-03-23','2024-03',0,0,4,NULL,'2024-03-14 16:05:53','2024-03-23 10:52:15'),
(1012,1,'萝卜工坊','/img/favicon/www.beautifulcarrot.com.png','辅助工具','https://www.beautifulcarrot.com/','','萝卜工坊,手写模拟器,模仿手写软件,手写字体在线转换,手写模拟器APP下载,手写字体制作,模拟抄写软件,手写字体生成器,字体下载,个人笔迹字体制作','萝卜工坊是一款手写模拟器，可一键生成手写文稿，模仿手写软件，在线手写字体转换器，手写模拟器APP下载，AI生成专属手写字体，制作自己笔迹的字体，打印出以假乱真的模拟手写文档，让打印出的字看上去像手写的软件，模拟抄写软件，代替抄写，抄写神器软件\n\n\n在线生成模拟手写文稿，让打印的字看起来和手写的一样\nAI专属字体制作，智能模仿文字书写风格\n一键快速搞定文字抄写任务','2024-03-19',3,3,1,'2024-03-23','2024-03',0,0,3,NULL,'2024-03-19 15:56:18','2024-03-23 10:52:16'),
(1013,1,'FRP','/img/favicon/gofrp.org.png','软件IT','https://gofrp.org/zh-cn/','','frp,内网穿透,P2P','简单、高效的内网穿透工具。frp 采用 C/S 模式，将服务端部署在具有公网 IP 的机器上，客户端部署在内网或防火墙内的机器上，通过访问暴露在服务器上的端口，反向代理到处于内网的服务。 在此基础上，frp 支持 TCP, UDP, HTTP, HTTPS 等多种协议，提供了加密、压缩，身份认证，代理限速，负载均衡等众多能力。此外，还可以通过 xtcp 实现 P2P 通信。','2024-03-21',4,4,1,'2024-03-25','2024-03',1,1,4,NULL,'2024-03-21 15:38:29','2024-03-25 19:54:41');</explode>

CREATE TABLE IF NOT EXISTS `pre_nav` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nid` int(11) NOT NULL COMMENT '排序号:数字越小排名越前',
  `icon` varchar(255) NOT NULL COMMENT '图标',
  `name` varchar(255) NOT NULL COMMENT '名称',
  `url` varchar(500) NOT NULL COMMENT 'URL',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `update_time` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;</explode>

INSERT INTO `pre_nav` (`id`, `nid`, `icon`, `name`, `url`) VALUES
(1, 1, 'fa-home', '导航首页', './'),
(2, 2, 'fa-flag', '排行榜单', 'ranking.html'),
(3, 3, 'fa-plus-square', '申请收录', 'apply.html'),
(4, 4, 'fa-book', '文章信息', 'article.html'),
(5, 5, 'fa-info-circle', '关于本站', 'about.html');</explode>

CREATE TABLE IF NOT EXISTS `pre_notice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL COMMENT '通知内容',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `update_time` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;</explode>

INSERT INTO `pre_notice` (`id`, `content`) VALUES
(1, '本站为大家收录精选的导航网站，指引大家愉快上网，希望大家喜欢！如有疑问请在这里：<a href="https://support.qq.com/product/377144" target="_blank">交流反馈</a>');</explode>

CREATE TABLE IF NOT EXISTS `pre_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sid` int(11) NOT NULL COMMENT '排序号:数字越小排名越前',
  `icon` varchar(255) NOT NULL COMMENT '分类图标:Font Awesome图标',
  `catename` varchar(255) NOT NULL COMMENT '分类名称',
  `alias` varchar(255) DEFAULT NULL COMMENT '分类别名:[a-zA-Z]+',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `update_time` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;</explode>

INSERT INTO `pre_category` (`id`, `sid`, `icon`, `catename`) VALUES
(1,1,'fa-paper-plane','目录导航'),
(2,2,'fa-file-text','博客社区'),
(3,3,'fa-cubes','社会生活'),
(4,4,'fa-youtube-play','影音娱乐'),
(5,5,'fa-cloud','IDC网站'),
(6,6,'fa-line-chart ','行业机构'),
(7,7,'fa-graduation-cap','教育学习'),
(8,8,'fa-jpy','投资理财'),
(9,9,'fa-wrench','辅助工具'),
(11,10,'fa fa-keyboard-o','软件IT'),
(12,11,'fa-shopping-cart','购物商城'),
(13,12,'fa fa-download','资源下载');</explode>

CREATE TABLE IF NOT EXISTS `pre_article_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sid` int(11) NOT NULL COMMENT '排序号:数字越小排名越前',
  `icon` varchar(255) NOT NULL COMMENT '分类图标:Font Awesome图标',
  `catename` varchar(255) NOT NULL COMMENT '分类名称',
  `alias` varchar(255) DEFAULT NULL COMMENT '分类别名:[a-zA-Z]+',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `update_time` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;</explode>

INSERT INTO `pre_article_category` (`id`, `sid`, `icon`, `catename`) VALUES
(1, 1, 'fa fa-folder-open', '资源分享'),
(2, 2, 'fa fa-gift', '羊毛线报'),
(3, 3, 'fa fa-floppy-o', '网站优化'),
(4, 4, 'fa-fast-forward', '其他资讯');</explode>

CREATE TABLE IF NOT EXISTS `pre_article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL COMMENT '文章标题',
  `catename` varchar(255) NOT NULL COMMENT '文章分类',
  `introduce` text NOT NULL COMMENT '文章内容',
  `hits_total` int(20) NOT NULL DEFAULT '0' COMMENT '总浏览量',
  `tui` int(2) NOT NULL DEFAULT '0' COMMENT '是否推荐',
  `time` varchar(50) NOT NULL COMMENT '创建时间',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `update_time` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;</explode>

INSERT INTO `pre_article` (`id`, `name`, `catename`, `introduce`, `hits_total`, `tui`, `time`) VALUES
(1, '文章标题', '资源分享', '<p>文章详情信息</p>', 66, 1, '2021-10-25');</explode>

CREATE TABLE IF NOT EXISTS `pre_like` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `site_id` int(11) NOT NULL COMMENT '站点ID',
  `like_ip` varchar(255) NOT NULL COMMENT '点赞者IP',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `update_time` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;</explode>
