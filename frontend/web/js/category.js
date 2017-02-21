var html='';
var count='';
var page=1;
var cat=-1;
var m=3;
/******首屏加载******/
function ajaxLoad() {
    //初始化数据
    if(getM())
    {
        m=getM();
    }
    if(getCat())
    {
        cat=getCat();
    }
    if(getPage()){
        page=getPage();
    }
    //AJAX加载
    $.ajax({
        url: '/category/ajax-cat',
        type: 'GET',
        dataType: 'json',
        data: {cat:cat,'m':m,page:page},
    })
        .done(function(data) {
            //遍历JSON数据
            eachJson(data);
            for (var i=0;i<$('.m-setnav li').length;i++)
            {
                if ($('.m-setnav li').eq(i).find('a').attr('sid')==cat)
                {
                    $('.m-setnav li').eq(i).find('a').addClass('js-cur');
                }
            }
            for (var i=0;i<$('.etab li').length;i++)
            {
                if ($('.etab li').eq(i).find('a').attr('data-m')==m)
                {

                    $('.etab li').eq(i).addClass('js-cur');
                }
            }
        })
        .fail(function() {
            console.log("error");
        })
        .always(function(data) {
            //AJAX分页方法
            ajaxPage(data);
            //关闭加载动画
            $('.js-loading').css('display', 'none');
            //HTML赋值
            $('.js-alist').html(html);
            //选择分类
            $('.m-setnav li').click(function () {
                //选中动画
                $(this).find('a').addClass('js-cur');
                $(this).siblings().find('a').removeClass('js-cur');
                //清空原分类下的HTML
                $('.js-alist').html('');
                //显示加载动画
                $('.js-loading').css('display', 'block');
                //初始化cat
                cat = $(this).find('a').attr('sid');
                //初始化page
                page=1;
                var str='';
                var href='';
                var cc='';
                var hrefArr='';
                //修改分区href
                for (var i=0;i<$('.etab li').length;i++)
                {
                    str=$('.etab li').eq(i).find('a').attr('href');
                    hrefArr=str.split('&');
                    cc='#cat='+String(cat);
                    href=cc+'&'+hrefArr[1]+'&'+hrefArr[2];
                    $('.etab li').eq(i).find('a').attr('href',href);
                }
                $.ajax({
                    url: '/category/ajax-cat',
                    type: 'GET',
                    dataType: 'json',
                    data: {cat:cat,m:m,page:page},
                })
                    .done(function (data) {
                        eachJson(data);
                    })
                    .fail(function () {
                        console.log("error");
                    })
                    .always(function (data) {
                        ajaxPage(data);
                        $('.js-loading').css('display', 'none');
                        //列表赋值
                        $('.js-alist').html(html);
                    });
            })
        })
}
//调用函数
ajaxLoad();

/*************分区加载*************/
$('.etab li').click(function () {
    $(this).addClass('js-cur').siblings().removeClass('js-cur');
    var oHref=$(this).find('a').attr('href');
    //清空原分类下的HTML
    $('.js-alist').html('');
    //显示加载动画
    $('.js-loading').css('display', 'block');
    //初始化m
    m=$(this).find('a').attr('data-m');
    //初始化page
    page=1
    var str='';
    var href='';
    var arrHref='';
    var mm='';
    //设置分类标签m的值
    for (var i=0;i<$('.m-setnav li').length;i++)
    {
        str=$('.m-setnav li').eq(i).find('a').attr('href');
        arrHref=str.split('&');
        mm='m='+m;
        href=arrHref[0]+'&'+mm+'&'+arrHref[2];
        $('.m-setnav li').eq(i).find('a').attr('href',href);
    }
    $.ajax({
        url: '/category/ajax-cat',
        type: 'GET',
        dataType: 'json',
        data: {cat:cat,m:m,page:page},
    })
        .done(function(data) {
            eachJson(data);
        })
        .fail(function() {
            console.log("error");
        })
        .always(function(data) {
            ajaxPage(data);
            //关闭加载动画
            $('.js-loading').css('display', 'none');
            //HTML赋值
            $('.js-alist').html(html);
        });
})
/*****分页加载*******/
function ajaxPage(data) {
    //初始化分页
    $('#page').pagination({
        items: data.count,
        itemsOnPage: 20,
        cssStyle: 'light-theme',
        prevText: '上一页',
        nextText: '下一页',
        hrefTextPrefix:'#cat='+cat+'&m='+m+'&page=',
        currentPage:page,
        onPageClick:function (pageNumber,event) {
            page=pageNumber;
            //清空原分类下的HTML
            $('.js-alist').html('');
            //显示加载动画
            $('.js-loading').css('display', 'block');
            $.ajax({
                url: '/category/ajax-cat',
                type: 'GET',
                dataType: 'json',
                data: {cat:cat,m:m,page:page},
            })
                .done(function(data) {
                    //遍历JSON数据
                    eachJson(data);
                })
                .fail(function() {
                    console.log("error");
                })
                .always(function() {
                    //关闭加载动画
                    $('.js-loading').css('display', 'none');
                    //HTML赋值
                    $('.js-alist').html(html);
                });
        }
    });

}
//遍历JSON数据
function eachJson(data) {
    //计算总共多少页
    count=data.count;
    //清空HTML
    html='';
    //显示加载动画
    $('.js-loading').css('display','block');
    var album_name='';
    //遍历JSON对象

    $.each(data.album,function (index,obj) {
        var likeNum=0;
        if(obj.album_name.length>8)
        {
            album_name=obj.album_name.substr(0,8)+'...';
        }else
        {
            album_name=obj.album_name;
        }
        html+='<li class="w-ps thide">';
        html+='<div class="pic">';
        html+='<a class="img js-anchor etag noul" hidefocus="true" target="_blank" href="'+data.hostInfo+'/album/'+obj.id+'" title="">';
        html+='<img class="etag js-img bdc4 bds0 bdwa" alt="" style="visibility: visible;" src="'+obj.cover+'" title="">';
        html+='</a>';
        html+='<div class="detail f-trans">';
        html+='<p class="clearfix">';
        html+='<a class="name js-name etag" title="" href="'+data.hostInfo+'/album/'+obj.id+'" hidefocus="true" target="_blank">';
        html+=album_name;
        html+='</a>';
        html+='&nbsp;';
        html+='<span class="js-pic etag">';
        html+='</span>';
        html+='</p>';
        html+='<p class="clearfix">';
        html+='<a href="'+data.hostInfo+'/home/'+obj.user.id+'" class="js-uname uname etag" target="_blank">'+obj.user.person_info.nickname+'</a>';
        $.each(obj.photo,function (index,like) {
            likeNum+=like.like_bylike.length
        });
        html+='<span class="js-like likeicn etag" title="喜欢数">'+likeNum+'</span>';
        html+='</p>';
        html+='</div>';
        html+='<div class="cover f-trans"></div>';
        html+='</div>';
        html+='</li>';
    })
}
//赋值，关闭加载动画
function closeLoad(html) {
    //关闭加载动画
    $('.js-loading').css('display', 'none');
    //HTML赋值
    $('.js-alist').html(html);
}
/*****计算字符串第n次出现的位置*****/
function getIndex(str,n,z)
{
    for (var x=0;x<n;x++)
    {
        var m='';
        var index=str.indexOf(z);
        if(n>1)
        {
            m+=str.indexOf(z,index+1);
        }else
        {
            m=index;
        }

    }
    return parseInt(m);
}
//获取分类
function getCat() {
    //'='第一次出现的位置
    var aa=location.hash.indexOf('=');
    //'&'第一次出现的位置
    var bb=location.hash.indexOf('&');
   return location.hash.substring(aa+1,bb);
}
function getM() {
    //'='第二次出现的位置
    var cc=getIndex(location.hash,2,'=');
    //'&'第二次出现的位置
    var dd=getIndex(location.hash,2,'&');
    //m的值
    return location.hash.substring(cc+1,dd);
}
function getPage() {
    //'='最后出现的位置
    var ee=location.hash.lastIndexOf('=');
    return location.hash.substring(ee+1);
}





