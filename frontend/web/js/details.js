/******EXIF信息交互************/
var exifInfo=function () {
    $('.data-lazyload-src').hover(function () {
        $(this).parent().find('.m-picexif').find('h5').css('visibility','visible');
    },function () {
        $(this).parent().find('.m-picexif').find('h5').css('visibility','hidden');
    })
    $('.picexif-title').hover(function () {
        $(this).parent().css('visibility','visible');
        $(this).css('visibility','visible');
    },function () {
    })
    $('.m-picexif').hover(function () {
    },function () {
        $(this).css('visibility','hidden');
        $('.picexif-title').css('visibility','hidden');
    })
};
exifInfo();
/**********首屏加载**********/
var ftop=$(window).scrollTop();
for (var i=0;i< $('.m-picsetitem').length;i++)
{
    var mtop=$('.m-picsetitem').eq(i).offset().top;
    if(mtop-ftop<500&&mtop-ftop>-500)
    {
        var src= $('.m-picsetitem').eq(i).find('.data-lazyload-src').attr('data-lazyload');
        $('.m-picsetitem').eq(i).find('.data-lazyload-src').attr('src',src);
        var img=$('.m-picsetitem ').eq(i).find('.data-lazyload-src');
        img.load(function () {
            $(this).css({
                'width':'auto',
                'height':'auto',
            });
        })
    }
}
/**********滚动加载***********/
$(window).on('scroll',function () {
    var stop=$(window).scrollTop();
    for (var i=0;i< $('.m-picsetitem').length;i++)
    {
        var src= $('.m-picsetitem').eq(i).find('.data-lazyload-src').attr('data-lazyload');
        var mtop=$('.m-picsetitem').eq(i).offset().top;
        if(mtop-stop<500&&mtop-stop>-500)
        {
            var value=$('.m-picsetitem').eq(i).find('.data-lazyload-src').attr('src');
            if(value!=src){
                $('.m-picsetitem').eq(i).find('.data-lazyload-src').attr('src',src);
                var img=$('.m-picsetitem ').eq(i).find('.data-lazyload-src');
                img.load(function () {
                   $(this).css({
                        'width':'auto',
                        'height':'auto',
                    });
                })
            }
        }

    }
});
/*********关注&&取消关注*********/
$('#J-go-attention').on('click',function () {
    var userID=$('input[name="userID"]').val();
    var needlogin=$(this).attr('data-needlogin');
    if(needlogin=='false')
    {
        $.ajax({
            url: '/album/ajax-follow',
            type: 'GET',
            data: {id: userID},
        })
            .done(function() {
                $('#J-go-attention').css('display','none');
                $('#J-go-unfollow').css('display','inline-block');
            })
            .fail(function() {
               alert('保存失败！');
            })

    }else
    {
        alert('请先登录！');
    }
});
$('#J-go-unfollow').on('click',function () {
    var userID=$('input[name="userID"]').val();
    var needlogin=$(this).attr('data-needlogin');
    if(needlogin=='false')
    {
        $.ajax({
            url: '/album/ajax-unfollow',
            type: 'GET',
            data: {id: userID},
        })
            .done(function() {
                $('#J-go-attention').css('display','inline-block');
                $('#J-go-unfollow').css('display','none');
            })
            .fail(function() {
               alert('保存失败!');
            })
    }else
    {
        alert('请先登录！');
    }
});
/********赞&&取消赞******/
$('#J-go-praise').on('click',function () {
    var userID=$('input[name="userID"]').val();
    var needlogin=$(this).attr('data-needlogin');
    if(needlogin=='false')
    {
        $.ajax({
            url: '/album/ajax-like',
            type: 'GET',
            data: {id: userID},
        })
            .done(function(data) {
                console.log(data);
                if(data)
                {
                    $('#J-go-praise').css('display','none');
                    $('#J-go-unpraise').css('display','inline-block');
                }
            })
            .fail(function() {
                console.log("error");
            })
    }else
    {
        alert('请先登录！');
    }
});
$('#J-go-unpraise').on('click',function () {
    var userID=$('input[name="userID"]').val();
    var needlogin=$(this).attr('data-needlogin');
    if(needlogin=='false')
    {
        $.ajax({
            url: '/album/ajax-unlike',
            type: 'GET',
            data: {id: userID},
        })
            .done(function(data) {
                console.log(data);
                if(data)
                {
                    $('#J-go-praise').css('display','inline-block');
                    $('#J-go-unpraise').css('display','none');
                }
            })
            .fail(function() {
                console.log("error");
            })
            .always(function() {
                //console.log("complete");
            });
    }else
    {
        alert('请先登录！');
    }
});
/**********赞照片&&取消赞**********/
$('.w-btnDimGray').on('click',function () {
    var obj=$(this);
    var userID=$('input[name="userID"]').val();
    var photo_id=$(this).attr('data-id');
    var needlogin=$(this).attr('data-needlogin');
    if(needlogin=='false')
    {
        $.ajax({
            url: '/album/ajax-like',
            type: 'GET',
            data: {id: userID,photo_id:photo_id},
        })
            .done(function(data) {
                obj.addClass('f-hide');
                obj.parent().find('.w-btn-cancelLike').removeClass('f-hide');
                var val=obj.parent().find('.w-btn-cancelLike').find('span').html();
                obj.parent().find('.w-btn-cancelLike').find('span').html(parseInt(val)+1);
            })
            .fail(function() {
                console.log("error");
            })

    }else
    {
        alert('请先登录！');
    }
});
$('.w-btn-cancelLike').on('click',function () {
    var obj=$(this);
    var userID=$('input[name="userID"]').val();
    var photo_id=$(this).attr('data-id');
    var needlogin=$(this).attr('data-needlogin');
    if(needlogin=='false')
    {
        $.ajax({
            url: '/album/ajax-unlike',
            type: 'GET',
            data: {id: userID,photo_id:photo_id},
        })
            .done(function(data) {
                obj.addClass('f-hide');
                obj.parent().find('.w-btnDimGray').removeClass('f-hide');
                var val=obj.parent().find('.w-btn-cancelLike').find('.cancel-out span').html();
                obj.parent().find('.w-btnDimGray').find('span').html(parseInt(val)-1);

            })
            .fail(function() {
                console.log("error");
            })
    }else
    {
        alert('请先登录！');
    }
});
/**
 * AJAX发评论
 */
$('input[name="submit"]').on('click',function () {
    var content=$('.zcnt textarea').val();
    var album_id=$('input[name="album_id"]').val();
    $('.zcnt textarea').val('');
    $.ajax({
        url: '/album/ajax-comment',
        type: 'POST',
        data: {content: content,album_id:album_id},
        dataType:'json'
    })
        .done(function(data) {
            console.log(data);
            var html='';
            html+='<div class="nbw-cmt bdwb bds2 bdc21 clearfix">';
            html+='<div class="nbw-fce nbw-f50 l bdwa bdc21 bds0">';
            html+='<a hidefocus="true" class="c-tag" href="'+data.hostInfo+'/home/index/'+data.user.id+'">';
            html+='<img class="cwd js-img c-tag" title="'+data.user.person_info.nickname+'" alt="'+data.user.person_info.nickname+'" src="'+data.hostInfo+data.user.person_info.head_img+'">';
            html+='</a>';
            html+='</div>';
            html+='<div class="thde">';
            html+='<span class="r fc1 js-time c-tag">'+data.date+'</span>';
            html+='<a class="tt js-title c-tag" href="'+data.hostInfo+'/home/index/'+data.user.id+'">'+data.user.person_info.nickname+'</a>';
            html+='<div class="cnt fc98 js-cnt pre c-tag"><div>'+data.content+'</div></div>';
            html+='</div>';
            html+='</div>';
            $('.js-cnt.b-tag').before(html);
            $('.js-title span').html(parseInt($('.js-title span').html())+1);
        })
        .fail(function() {
            console.log("error");
        })
        .always(function() {
            console.log("complete");
        });
});
/**********回到顶部*********/
$('.m-top-spacial').on('click',function () {
    $('body').animate({scrollTop: 0}, 300);
});

