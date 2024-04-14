<?php
if (!defined('IN_CRONLITE')) return;
?>
<ul class="suspend">
    <li class="back-top" onclick="backTop()">
        <i class="fa fa-chevron-up"></i>
        <span class="more">返回顶部</span>
    </li>
    <li>
        <a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $conf['qq']; ?>&site=qq&menu=yes">
            <i class="fa fa-qq"></i>
            <span class="more"><?php echo $conf['qq']; ?></span>
        </a>
    </li>
    <li>
        <a href="mailto:<?php echo $conf['email']; ?>">
            <i class="fa fa-envelope"></i>
            <span class="more"><?php echo $conf['email']; ?></span>
        </a>
    </li>
    <li>
        <i class="fa fa-weixin"></i>
        <span class="more weixin"><img src="assets/images/weixin.png" alt="微信二维码"></span>
    </li>
</ul>

<footer class="footer">
    <p>Copyright © 2024 <a href="<?php echo $site_http; ?>"><?php echo $conf['name']; ?></a> All Rights Reserved.</p>
    <p>如有疑问请在这里 <a href="https://support.qq.com/product/377144" target="_blank">交流反馈</a></p>
    <p><a href="https://beian.miit.gov.cn/"><?php echo $conf['icp']; ?></a></p>
    <p>本站仅收录网站，不对其网站内容或交易负责。若收录的站点侵害到您的利益，请联系我们删除收录。</p>
    <p><?php echo $conf['info']; ?></p>
</footer>

<div class="progressbar"></div>

<script type="text/javascript" src="assets/jquery/1.12.4/jquery.min.js"></script>
<script type="text/javascript" src="assets/layer/3.1.1/layer.js"></script>
<script type="text/javascript" src="templates/default/js/main.js"></script>

<?php echo $conf['script_footer']; ?>


