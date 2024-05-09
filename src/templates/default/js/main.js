const qqCheck = /^([1-9]\d{4,9}$)|^暂无$/; //验证QQ号
const urlCheck = /^(?=^.{3,255}$)(http(s)?:\/\/)?(www\.)?[a-zA-Z0-9][-a-zA-Z0-9]{0,62}(\.[a-zA-Z0-9][-a-zA-Z0-9]{0,62})+(:\d+)*(\/([-\w]+)*(\.[-\w]+)*)*([\#?&]\w+=\w*)*$/i; //验证url

window.onload = function () {
    //导航高亮
    highLight();

    //懒加载
    $('.banner').css('background-image', 'url("' + $('.banner').attr('data-src') + '")');
    lazyRender($('.lazy-load'));

    //分类激活
    if ($('.category').length > 0) {
        cateActive();
    }

    //顶部置顶
    if ($('.header').next('.banner').length > 0) {
        headerFixed();
    }

    let clock;
    if ($('.category').length > 0) {
        var initOffsetTop = $('.category').offset().top;
    }
    $(window).on('scroll', function () {
        if ($('.header').next('.banner').length > 0) {
            headerFixed();
        }
        if (clock) {
            clearTimeout(clock);
        }
        clock = setTimeout(function () {
            lazyRender($('.lazy-load'));
        }, 300);
        let scrollTop = $(window).scrollTop();
        if ($('.category').length > 0) {
            cateActive();
            if ($('.category').offset().top - scrollTop <= 73 && scrollTop >= initOffsetTop - 73) {
                $('.category').addClass('fixed');
            } else {
                $('.category').removeClass('fixed');
            }
        }
        if (scrollTop >= 100) {
            $('.back-top').addClass('show');
        } else {
            $('.back-top').removeClass('show');
        }
    });

    //移动端侧栏
    $('.nav-bar').click(function () {
        if ($(this).hasClass('active')) {
            $(this).removeClass('active');
            $('.nav').removeClass('show');
            $('.transparent-mark').remove();
        } else {
            $(this).addClass('active');
            $('.nav').addClass('show');
            $('.header').append('<div class="transparent-mark"></div>');
        }
    });
    $(document).on('click', '.transparent-mark', function () {
        $('.nav-bar').removeClass('active');
        $('.nav').removeClass('show');
        $('.transparent-mark').remove();
    });

    //切换搜索方式
    $('.search-input').focus();
    $('.search-type li').on('click', function () {
        $('.search-type li').removeClass('active');
        $(this).addClass('active');
        $('.search-input').focus();
        $('.search-main').attr('target', '_blank');
        switch ($(this).attr('data-type')) {
            case 'this':
                $('.search-main').attr('action', '../').attr('target', '_self');
                $('.search-input').attr('name', 'keyword');
                $('.search-btn').text('本站搜索');
                break;
            case 'baidu':
                $('.search-main').attr('action', 'https://www.baidu.com/s?tn=none');
                $('.search-input').attr('name', 'wd');
                $('.search-btn').text('百度一下');
                break;
            case 'sogou':
                $('.search-main').attr('action', 'https://www.sogou.com/sogou?pid=none');
                $('.search-input').attr('name', 'query');
                $('.search-btn').text('搜狗搜索');
                break;
            case '360':
                $('.search-main').attr('action', 'https://www.so.com/s?ls=none');
                $('.search-input').attr('name', 'q');
                $('.search-btn').text('360搜索');
                break;
            case 'bing':
                $('.search-main').attr('action', 'https://cn.bing.com/search?from=none');
                $('.search-input').attr('name', 'q');
                $('.search-btn').text('必应搜索');
                break;
        }
    });

    //定位移动
    if ($(window).width() <= 767) {
        var offset = 52;
    } else {
        var offset = 62;
    }
    $('.category .move').click(function (e) {
        e.preventDefault();
        let href = $(this).attr("href");
        let pos = $(document.getElementById(href.slice(1))).offset().top - offset;
        $("html,body").animate({
            scrollTop: pos
        }, 500);
    });
    // 点赞功能
    $(".like-btn").click(function() {
        var like = $(this);
        var id = like.attr("rel"); // 对应id
        like.fadeOut(300); // 渐隐效果
        $.ajax({
            type: "POST",
            url: "/api/like.php",
            data: "id=" + id,
            cache: false, // 不缓存此页面
            success: function(data) {
                if (data.code == 0) {
                    layer.msg('点赞成功', {
                        time: 500
                    });
                    like.html('<span class="like-active"><i class="fa fa-heart fa-fw" aria-hidden="true"></i> ' + data.data + '</span>');
                } else if (data.code == -1) {
                    layer.msg(data.msg, {
                        time: 500
                    });
                    like.html('<span class="like-active"><i class="fa fa-heart fa-fw" aria-hidden="true"></i> ' + data.msg + '</span>');
                } else {
                    layer.msg(data.msg || '出现异常，请稍后重试！', {
                        time: 500
                    });
                }
                like.fadeIn(300); // 渐显效果
            }
        });
        return false;
    });
}

// 导航高亮
function highLight() {
    var urlstr = location.href;
    $('.nav > li > a').each(function () {
        var href = $(this).attr('href');
        if (urlstr == href && href != '') {
            $(this).parent('li').addClass('active');
        } else {
            $(this).parent('li').removeClass('active');
        }
    });
}

//懒加载
function lazyRender(dom) {
    dom.each(function () {
        let scrollTop = $(window).scrollTop();
        let windowHeight = $(window).height();
        let offsetTop = $(this).offset().top;
        if (offsetTop < (scrollTop + windowHeight) && offsetTop > scrollTop && $(this).attr('data-src') !== $(this).attr('src')) {
            $(this).animate({opacity: 'toggle'}, 300, function () {
                    $(this).attr('src', $(this).attr('data-src'));
                    $(this).animate({opacity: 'toggle'}, 300);
                }
            );
        }
    })
}

//顶部置顶
function headerFixed() {
    let scrollTop = $(window).scrollTop();
    if (scrollTop > 20) {
        $('.header').addClass('fixed');
    } else {
        $('.header').removeClass('fixed');
    }
}

//分类激活
function cateActive() {
    $('.category .move').removeClass('active');
    $('.category .move').each(function () {
        let href = $(this).attr('href');
        let scrollTop = $(window).scrollTop();
        let windowHeight = $(window).height();
        let offsetTop = $(document.getElementById(href.slice(1))).offset().top;
        if (offsetTop < (scrollTop + windowHeight) && offsetTop > scrollTop) {
            $(this).addClass('active');
            return false;
        }
    });
}

//返回顶部
function backTop() {
    $('html,body').animate({
        scrollTop: '0'
    }, 500);
}

//申请收录
function addApply() {
    if ($('#name').val() == '') {
        layer.msg('请输入名称', {
            anim: 6,
            time: 500,
        });
        $("#name").focus();
    } else if ($('#cateid').val() == '') {
        layer.msg('请选择分类', {
            anim: 6,
            time: 500,
        });
        $("#cateid").focus();
    } else if ($("#qq").val() != '' && !qqCheck.test($("#qq").val())) {
        layer.msg('请输入正确的qq号', {
            anim: 6,
            time: 500,
        });
        $("#qq").focus();
    } else if (!urlCheck.test($("#domain").val())) {
        layer.msg('请输入正确的域名', {
            anim: 6,
            time: 500,
        });
        $("#domain").focus();
    } else if ($('#checkCode').val() == '') {
        layer.msg('请输入验证码', {
            anim: 6,
            time: 500,
        });
        $("#checkCode").focus();
    } else {
        var data = $('#add_apply').serialize();
        var result = ouzero_addApply(data);
        if (result.code == 1) {
            layer.msg(result.msg, {
                time: 1000
            }, function () {
                location.reload();
            });
        } else {
            layer.msg(result.msg, {
                anim: 6,
                time: 1000,
            });
        }
    }
}
