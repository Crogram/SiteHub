欢迎使用 - 程江网址导航系统 V1.0（正式版）！
本系统采用 PHP + MySQL 技术开发
拥有独立的安装和后台系统
后台采用 Bootstrip 框架
前台使用响应式界面，自适应各种屏幕

后台功能：
1.支持修改所有网站信息
2.支持修改管理员信息
3.支持上传网站logo/favicon图标/微信二维码 等图片
4.支持添加/修改/删除导航 
5.支持添加/修改/删除分类
6.支持添加/修改/删除站点
7.支持审核/删除站点申请
8.支持发布/修改/删除公告

前台特色：
1.所有分类下的站点
2.单个分类下的站点
3.各站点详情页
4.分类滚动定位
5.记录各站点浏览数
6.点赞功能（单个ip单个站点只能点赞一次）
7.站点详情页显示站点缩略图
8.站点炫酷跳转页
9.右下角悬浮按扭（去顶部/qq/邮箱/微信二维码）
10.搜索功能（支持搜索站点名称/站点链接/站点简介）
11.访客申请站点收录功能
12.关于我们页面
13.站点图片懒加载
14.分类/站点链接别名

注意事项：
1.本系统采用伪静态，若您的主机不支持伪静态请勿使用
2.若是Apache服务器端软件，您只需要开启伪静态功能，本系统已经为您配置好了，详见源码程序中的.htaccess
3.若是Nginx服务器端软件，您只需要按照以下伪静态规则配置伪静态
rewrite ^/index.html$ /index.php;
rewrite ^/about.html$ /about.php;
rewrite ^/search.html$ /search.php;
rewrite ^/apply.html$ /apply.php;
rewrite ^/404.html$ /404.php;
rewrite ^/category-([1-9]+[0-9]*).html$ /category.php?id=$1;
rewrite ^/category-([a-zA-Z]+).html$ /category.php?alias=$1;
rewrite ^/site-([1-9]+[0-9]*).html$ /site.php?id=$1;
rewrite ^/([a-zA-Z]+).html$ /site.php?alias=$1;