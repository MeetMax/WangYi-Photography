var z=0;
var ppIndex=0;
var coverIndex=0;
    document.getElementById('file').addEventListener('change', function () {
        ppIndex=0;
        fileNum = document.getElementById('file').files.length;
        var html = '';
        var formData = new FormData();
        for (var i = 0; i < fileNum; i++) {
            var image = document.getElementById('file').files[i].name;
            var pos = image.indexOf('.');
            var fileName = image.substring(0, pos);
            html += '<div class="w-editPicItem">';
            html += '<p class="pic-area z-tag">';
            html += '<img src="" width="140" height="140" class="edit-pic z-tag">';
            html += '</p>';
            html += '<p class="statu-bg z-tag">';
            html += '<b class="statu-progress z-tag">';
            html += '</b>';
            html += '</p>';
            html += '<p class="edit-operation z-tag" style="display: none">';
            html += '<b style="display:inline-block;zoom:1;width:1px;overflow:hidden;height:32px;vertical-align:middle;">&amp;#nbsp;</b>';
            html += '<b class="w-prev z-tag" title="预览" style="">&amp;#nbsp;</b>';
            if (z == 0) {
                html += '<b class="w-setCover z-tag" style="display: none" title="设为封面"> &amp;#nbsp;</b>';
            } else {
                html += '<b class="w-setCover z-tag" title="设为封面"> &amp;#nbsp;</b>';
            }
            html += '<b class="w-remove z-tag" title="从本次作品发布中移除" evtag="removePic">&amp;#nbsp;</b>';
            html += '</p>';
            html += '<p class="edit-desc z-tag" title="点击编辑描述" style="cursor: pointer;">';
            html += fileName;
            html += '</p>';
            if (z != 0) {
                html += '<p class="set-cover" style="visibility: hidden" evtag="setCover">  </p>';
            } else {
                html += '<p class="set-cover"  evtag="setCover">  </p>';
            }

            html += '<p class="upload-error z-tag">';
            html += '</p>';
            html += '</div>';
            z++;
        }
        function photoUpload() {
            formData.append('imageFiles', document.getElementById('file').files[ppIndex]);
            $.ajax({
                xhr: function () {
                    var xhr = $.ajaxSettings.xhr();
                    xhr.upload.addEventListener("progress", onprogress, false);
                    return xhr;
                },
                url: '/share/ajax',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                dataType: 'json'
            })
                .done(function (data) {
                    console.log(data);
                    $('.w-editPicItem').eq(coverIndex).find('img').attr('src', data.path);
                    //默认封面
                    var defaultCover = $('.w-editPicItem').eq(0).find('img').attr('src');
                    //设置默认封面
                    $('#cover').val(defaultCover);
                    //重新选择封面
                    $('.w-editPicItem .w-setCover').click(function () {
                        //获取选择的封面路径
                        var src = $(this).parent().parent().find('img').attr('src');
                        //设置封面
                        $('#cover').val(src);
                    });
                    coverIndex++;
                    ppIndex++;
                    if (ppIndex < fileNum)
                    {
                        photoUpload();
                    }
                    if(ppIndex==fileNum)
                    {
                        removePhoto();
                    }
                })
                .fail(function (data) {
                    console.log(data);
                });
        }
        //调用上传照片方法
        photoUpload();
        //上传进度条事件
        function onprogress(evt) {
            var loaded = evt.loaded;     //已经上传大小情况
            var tot = evt.total;      //附件总大小
            var per = Math.floor(100 * loaded / tot);  //已经上传的百分比
            $('.w-editPicItem').eq(coverIndex).find(".statu-progress").css("width", per + "%");
            if(per>99)
            {
                $('.w-editPicItem').eq(coverIndex).find(".statu-bg").css('display','none');
            }
        }
        //拼好的HTML添加到DOM
        $('.go-Upload').before(html);
        //计算照片数量
        var num = ($('.w-editPicItem').length+1) / 6;
        if (num > 1) {
            $('#J-mainArea').css('height', 260 + 230 * parseInt(num) + 'px');
        }
        //绑定HOVER事件
        $('.w-editPicItem').hover(function () {
            $(this).find('.edit-operation').css('display', 'block');
        }, function () {
            $(this).find('.edit-operation').css('display', 'none');
        })
        //设定封面
        $('.w-editPicItem .w-setCover').click(function () {
            $(this).parent().parent().find('.set-cover').css('visibility', 'visible');
            $(this).parent().parent().siblings().find('.set-cover').css('visibility', 'hidden');
            $(this).css('display', 'none');
            $(this).parent().parent().siblings().find('.w-setCover').css('display', 'inline-block');
        })
    })
/**********移除照片***********/
function removePhoto() {
    $('.w-remove').unbind('click');
    $('.w-remove').on('click',function () {
        var path=$(this).parent().parent().find('.pic-area').find('img').attr('src');
        var remove=$(this);
        var i=$(this).parent().parent().index();
        $.ajax({
            url: '/share/remove-photo',
            type: 'POST',
            data: {'path': path,'i':i},
        })
            .done(function() {
                var attr=remove.parent().parent().find('.set-cover').css('visibility');
                remove.parent().parent().remove();
                if(attr=='visible')
                {
                    $('.w-editPicItem').eq(0).find('.set-cover').css('visibility','visible');
                }
                coverIndex--;
            })
            .fail(function() {
                console.log("error");
            })

    });
}
/****选择展区弹窗 start****/
$('.w-selectTouch').click(function () {
    //计算浏览器可见区域高度
    var clientH=document.body.offsetHeight ;
    //计算浏览器可见区域宽度
    var clientW=document.body.offsetWidth;
    //显示弹窗
    $('.point-wrap').css('display','block');
    //计算弹窗高度
    var pointH=$('.zwrp').height();
    //计算弹窗宽度
    var pointW=$('.zwrp').width();
    //计算网页被卷曲的高度
    var scrollTop=document.body.scrollTop;
    //计算弹窗位置
    $('.point-wrap').css({
        'left':(clientW-pointW)/2+'px',
        'top':(clientH-pointH)/2+scrollTop+'px',
    })
    //显示弹窗背景层
    $('.zcvr').css('display','block');
    //获取父级元素id
    var parentID=$(this).parent().attr('id');
    //判断是否为选择区域
    if(parentID=='J-address-con') {
        var getRegion=function(){
        if(!$('.point-wrap').hasClass('J-address-con'))
        {
            $('.point-wrap').addClass('J-address-con')
        }
        //定义局部变量
        var area = '';
        var sArea='';
        var areaDelete='';
        var regionUrl='../json/region.json';
        //获取json文件
        $.getJSON(regionUrl, function (data) {
            //遍历json对象
            $.each(data, function (index, obj) {
                area += '<li title="' + obj.nm + '">' + obj.nm + '</li>';
            });
            //隐藏返回分类
            $('.bdwb').css('display', 'none');
            //给列表赋值
            $('.point-wrap .data-list').html(area);
            //二级页面遍历
            $('.point-wrap .data-list li').click(function () {
                var title = $(this).attr('title');
                //遍历页面
                $.each(data, function (index, obj) {
                        if (obj.nm == title) {
                            //显示二级分类标题
                            $('.bdwb').css('display', 'block');
                            $('.bdwb .crumb').html(obj.nm);
                            //遍历二级页面
                                $.each(obj.son, function (index, x) {
                                    var i = x.nm.indexOf('-') + 1;
                                    //定义隐式全局变量
                                    s = x.nm.substring(i);
                                    //判断是否有二级分类
                                    if(x){
                                        sArea += '<li title="' + s + '">' + s + '</li>';
                                    }else {
                                        sArea='';
                                    }
                                });
                            //判断是否有二级分类
                            if(sArea){
                                //二级页面赋值
                                $('.point-wrap .data-list').html(sArea);
                                //选择二级分类
                                $('.point-wrap .data-list li').click(function () {
                                    $('.point-wrap').css('display', 'none');
                                    $('.zcvr').css('display', 'none');
                                    //获取点击选项的值
                                    var val = $(this).attr('title');
                                    var fArea=title.substring(title.lastIndexOf('-')+1);
                                    //拼出字符串
                                    areaDelete = '';
                                    areaDelete += '<span class="f-mr5">';
                                    areaDelete += '[<b class="select-value z-tag" title="'+fArea+'-'+val + '">'+fArea+'-'+val+'</b>';
                                    areaDelete += '<b class="w-removeS z-tag" title="删除'+fArea+'-'+val +'"></b>]';
                                    areaDelete += '</span>';
                                    //添加到元素前
                                    $('#J-address-con').append(areaDelete);
                                    //将值添加到隐藏域
                                    $('#address').val(fArea+'-'+val);
                                    //隐藏原来的元素
                                    $('#J-address-con .w-selectTouch').css('display', 'none');
                                    //移除类
                                    $('.point-wrap').removeClass('J-address-con');
                                    //移除数据
                                    $('.data-list li').remove();
                                    //隐藏返回分类
                                    $('.bdwb').css('display', 'none');
                                    //关闭已经选择的元素
                                    $('.w-removeS').bind('click', function () {
                                        //隐藏返回
                                        $('.bdwb').css('display', 'none');
                                        //移除该元素
                                        $(this).parent().remove();
                                        //显示原来的标签
                                        $('#J-address-con .w-selectTouch').css('display', 'inline-block');
                                    })
                                });
                                //返回上级分类
                                $('.J-address-con .r.t').click(function () {
                                    $('.bdwb').css('display', 'none');
                                    $('.point-wrap .data-list').html(area);
                                    getRegion();
                                });
                                //没有二级分类
                            }else{
                                $('.point-wrap').css('display', 'none');
                                $('.zcvr').css('display', 'none');
                                //计算地址
                                var fArea=title.substring(title.lastIndexOf('-')+1);
                                //拼出字符串
                                areaDelete = '';
                                areaDelete += '<span class="f-mr5">';
                                areaDelete += '[<b class="select-value z-tag" title="' + fArea + '">' + fArea + '</b>';
                                areaDelete += '<b class="w-removeS z-tag" title="删除' + fArea + '"></b>]';
                                areaDelete += '</span>';
                                //添加到元素前
                                $('#J-address-con').append(areaDelete);
                                //将值添加到隐藏域
                                $('#address').val(fArea);
                                //隐藏原来的元素
                                $('#J-address-con .w-selectTouch').css('display', 'none');
                                //移除类
                                $('.point-wrap').removeClass('J-address-con');
                                //移除数据
                                $('.data-list li').remove();
                                //关闭已经选择的元素
                                $('#J-address-con .w-removeS').bind('click', function () {
                                    //移除该元素
                                    $(this).parent().remove();
                                    //显示原来的标签
                                    $('#J-address-con .w-selectTouch').css('display', 'inline-block');
                                })
                            }
                        }


                });

            })
        })
    }
        getRegion();
    }
    //判断是否为选择相机镜头
    if(parentID=='J-camer-con')
    {
        //判断是否选择相机
        if($(this).index()==0)
        {
            var camera='';
            var sCamera='';
            var cameraDelete='';
            var cameraUrl='../json/camera.json';
            var getCamera=function(){
                //获取json文件
                $.getJSON(cameraUrl, function (data) {
                    if(!$('.point-wrap').hasClass('J-camera-con'))
                    {
                        $('.point-wrap').addClass('J-camera-con');
                    }
                    //遍历json对象
                    $.each(data, function (index, obj) {
                        camera += '<li title="' + obj.nm + '">' + obj.nm + '</li>';
                    });
                    //给列表赋值
                    $('.point-wrap .data-list').html(camera);
                    //二级页面遍历
                    $('.point-wrap .data-list li').click(function () {
                        sCamera = '';
                        var title = $(this).attr('title');
                        //遍历页面
                        $.each(data, function (index, obj) {
                            if (obj.nm == title) {
                                //显示二级分类标题
                                $('.bdwb').css('display', 'block');
                                $('.bdwb .crumb').html(obj.nm);
                                //遍历二级页面
                                $.each(obj.son, function (index, x) {
                                    sCamera += '<li title="' + x.nm + '">' + x.nm + '</li>';
                                })
                                //显示二级页滚动条
                                $('.point-wrap .data-list').css({
                                    'maxHeight':'200px',
                                    'overflow': 'auto'
                                });
                                //二级页面赋值
                                $('.point-wrap .data-list').html(sCamera);
                                //选择二级分类
                                $('.point-wrap .data-list li').click(function () {
                                    $('.point-wrap').css('display','none');
                                    $('.zcvr').css('display','none');
                                    //获取点击选项的值
                                    var val=$(this).attr('title');
                                    //拼出字符串
                                    cameraDelete+='<span class="f-mr5">';
                                    cameraDelete+='[<b class="select-value z-tag" title="'+obj.nm+'-'+val+'">'+obj.nm+'-'+val+'</b>';
                                    cameraDelete+='<b class="w-removeS z-tag" title="删除'+obj.nm+'-'+val+'"></b>]';
                                    cameraDelete+='</span>';
                                    //添加到元素前
                                    $('#J-camer-con').prepend(cameraDelete);
                                    //隐藏原来的元素
                                    $('#J-camer-con .w-selectTouch').eq(0).css('display','none');
                                    //将值添加到隐藏域
                                    $('#camera').val(obj.nm+'-'+val);
                                    //移除类
                                    $('.point-wrap').removeClass('J-camera-con');
                                    //移除数据
                                    $('.data-list li').remove();
                                    //隐藏返回分类
                                    $('.bdwb').css('display', 'none');
                                    //关闭已经选择的元素
                                    $('#J-camer-con .f-mr5').eq(0).find('.w-removeS').bind('click',function () {
                                        //移除该元素
                                        $(this).parent().remove();
                                        //显示原来的元素
                                        $('#J-camer-con .w-selectTouch').eq(0).css('display','inline-block');
                                    })
                                })
                                //返回上级分类
                                $('.J-camera-con .r.t').click(function () {
                                    //隐藏返回分类
                                    $('.bdwb').css('display', 'none');
                                    //返回一级页面赋值
                                    $('.point-wrap .data-list').html(camera);
                                    //取消滚动条
                                    $('.J-camera-con .data-list').css({
                                        'overflow': 'hidden'
                                    });
                                    getCamera();
                                })
                            }
                        });

                    })
                })
            }
            getCamera();
        }
        //判断是否为镜头
        if($(this).index()==1||$(this).index()==2)
        {
            var getLens=function(){
                if(!$('.point-wrap').hasClass('J-lens-con'))
                {
                    $('.point-wrap').addClass('J-lens-con')
                }
                var Lens='';
                var sLens='';
                var LensDelete='';
                var lensUrl='../json/lens.json';
                //获取json文件
                $.getJSON(lensUrl, function (data) {
                    //遍历json对象
                    $.each(data, function (index, obj) {
                        Lens += '<li title="' + obj.nms + '">' + obj.nms + '</li>';
                    });
                    //给列表赋值
                    $('.point-wrap .data-list').html(Lens);
                    //二级页面遍历
                    $('.point-wrap .data-list li').click(function () {
                        var title = $(this).attr('title');
                        //遍历页面
                        $.each(data, function (index, obj) {
                            if (obj.nm== title) {
                                //显示二级分类标题
                                $('.bdwb').css('display', 'block');
                                $('.bdwb .crumb').html(obj.nm);
                                //遍历二级页面
                                $.each(obj.son, function (index, x) {
                                    sLens += '<li title="' + x.nm + '">' + x.nm + '</li>';
                                })
                                //增加滚动条
                                $('.point-wrap .data-list').css({
                                    'maxHeight':'200px',
                                    'overflow': 'auto',
                                });
                                //二级页面赋值
                                $('.point-wrap .data-list').html(sLens);
                                //二级页面调整li宽度
                                $('.point-wrap .data-list li').css('width','160px');
                                //选择二级分类
                                $('.point-wrap .data-list li').click(function () {
                                    $('.point-wrap').css('display','none');
                                    $('.zcvr').css('display','none');
                                    //获取点击选项的值
                                    var val=$(this).attr('title');
                                    //拼出字符串
                                    LensDelete+='<span class="f-mr5">';
                                    LensDelete+='[<b class="select-value z-tag" title="'+obj.nm+'-'+val+'">'+obj.nm+'-'+val+'</b>';
                                    LensDelete+='<b class="w-removeS z-tag" title="删除'+obj.nm+'-'+val+'"></b>]';
                                    LensDelete+='</span>';
                                    //添加到元素后面
                                    $('#J-camer-con').append(LensDelete);
                                    //隐藏原来的元素
                                    $('#J-camer-con .w-selectTouch').eq(1).css('display','none');
                                    //将值添加到隐藏域
                                    $('#lens').val(obj.nm+'-'+val);
                                    //移除类
                                    $('.point-wrap').removeClass('J-lens-con');
                                    //移除数据
                                    $('.data-list li').remove();
                                    //隐藏返回分类
                                    $('.bdwb').css('display', 'none');
                                    //判断有几个关闭按钮
                                    var index=0;
                                    if($('#J-camer-con .f-mr5').size()>1)
                                    {
                                        index=1
                                    }else {
                                        index=0;
                                    }
                                    //关闭已经选择的元素
                                    $('#J-camer-con .f-mr5').eq(index).find('.w-removeS').bind('click',function () {
                                        //移除该元素
                                        $(this).parent().remove();
                                        //显示原来的标签
                                        $('#J-camer-con .w-selectTouch').eq(1).css('display','inline-block');
                                    })
                                })
                                //返回上级分类
                                $('.J-lens-con .r.t').click(function () {
                                    $('.point-wrap .data-list').css({
                                        'overflow': 'hidden'
                                    });
                                    $('.bdwb').css('display', 'none');
                                    $('.J-lens-con .data-list').html(Lens);
                                    getLens();
                                })
                            }
                        });

                    })
                })
            }
            getLens();
        }
    }
    //选择展区
    if(parentID=='J-dir-con')
    {
        var getDir=function(){
            if(!$('.point-wrap').hasClass('J-dir-con'))
            {
                $('.point-wrap').addClass('J-dir-con')
            }
            //定义局部变量
            var dirUrl='../json/share_dir.json';
            var dir='';
            var sDir='';
            var dirDelete='';
            //获取json文件
            $.getJSON(dirUrl, function (data) {
                //遍历json对象
                $.each(data, function (index, obj) {
                    dir += '<li data-id="'+obj.id+'" title="' + obj.nm + '">' + obj.nm + '</li>';
                });
                //情况元素
                $('.point-wrap .data-list').html('');
                // 清空二级分类标题
                $('.bdwb').css('display','none');
                //给列表赋值
                $('.point-wrap .data-list').html(dir);
                //二级页面遍历
                $('.point-wrap .data-list li').click(function () {
                    var title = $(this).attr('title');
                    var cat_id=$(this).attr('data-id');
                    //遍历页面
                    $.each(data, function (index, obj) {
                        if (obj.nm == title) {
                            //显示二级分类标题
                            $('.bdwb').css('display', 'block');
                            $('.bdwb .crumb').html(obj.nm);
                            $.each(obj.son, function (index, x) {

                                //判断是否有二级分类
                                if(x){
                                    sDir +='<li  data-id="'+x.id+'" title="' + x.nm + '">' + x.nm+ '</li>';
                                }else {
                                    sDir='';
                                }
                            });
                            //判断是否有二级分类
                            if(sDir){
                                //二级页面赋值
                                $('.point-wrap .data-list').html(sDir);
                                //选择二级分类
                                $('.point-wrap .data-list li').click(function () {
                                    $('.point-wrap').css('display', 'none');
                                    $('.zcvr').css('display', 'none');
                                    //获取点击选项的值
                                    var val = $(this).attr('title');
                                    //拼出字符串
                                    dirDelete += '<span class="f-mr5">';
                                    dirDelete += '[<b class="select-value z-tag" title="'+val + '">'+val + '</b>';
                                    dirDelete += '<b class="w-removeS z-tag" title="删除'+val + '"></b>]';
                                    dirDelete += '</span>';
                                    //添加到元素前
                                    $('#J-dir-con').append(dirDelete);
                                    //获取分类id
                                    cat_id=$(this).attr('data-id');
                                    //将值添加到隐藏域
                                    $('#cat_id').val(cat_id);
                                    //移除类
                                    if($('.point-wrap').hasClass('J-dir-con'))
                                    {
                                        $('.point-wrap').removeClass('J-dir-con');
                                    }
                                    //隐藏原来的元素
                                    $('#J-dir-con .w-selectTouch').css('display', 'none');
                                    //移除数据
                                    $('.data-list li').remove();
                                    //隐藏返回分类
                                    $('.bdwb').css('display', 'none');
                                    //关闭已经选择的元素
                                    $('.w-removeS').bind('click', function () {
                                        //清空隐藏域的值
                                        $('#cat_id').val('');
                                        //移除该元素
                                        $(this).parent().remove();
                                        //显示原来的标签
                                        $('#J-dir-con .w-selectTouch').css('display', 'inline-block');
                                    })
                                })
                                //返回上级分类
                                $('.J-dir-con .r.t').click(function () {
                                    $('.bdwb').css('display', 'none');
                                    $('.point-wrap .data-list').html(dir);
                                    getDir();
                                })
                                //没有二级分类
                            }else{
                                //隐藏弹框
                                $('.point-wrap').css('display', 'none');
                                //隐藏背景层
                                $('.zcvr').css('display', 'none');
                                //拼出字符串
                                dirDelete='';
                                dirDelete += '<span class="f-mr5">';
                                dirDelete += '[<b class="select-value z-tag" title="' + title + '">' + title + '</b>';
                                dirDelete += '<b class="w-removeS z-tag" title="删除' + title + '"></b>]';
                                dirDelete += '</span>';
                                //添加到元素前
                                $('#J-dir-con').append(dirDelete);
                                //移除类
                                $('.point-wrap').removeClass('J-dir-con');
                                //将值添加到隐藏域
                                $('#cat_id').val(cat_id);
                                //隐藏原来的元素
                                $('#J-dir-con .w-selectTouch').css('display', 'none');
                                //移除数据
                                $('.data-list li').remove();
                                $('.w-removeS').bind('click', function () {
                                    //清空隐藏域的值
                                    $('#cat_id').val('');
                                    //移除该元素
                                    $(this).parent().remove();
                                    //显示原来的标签
                                    $('#J-dir-con .w-selectTouch').css('display', 'inline-block');
                                })
                            }
                        }


                    });

                })
            })
        }
        getDir();
    }
})

    //关闭按钮关闭弹窗
$('.zcls').click(function () {
    //隐藏弹框
    $('.point-wrap').css('display','none');
    //隐藏背景层
    $('.zcvr').css('display','none');
    //移除数据
    $('.data-list li').remove();
    //隐藏返回分类
    $('.bdwb').css('display', 'none');
    //移除类
    if($('.point-wrap').hasClass('J-dir-con'))
    {
        $('.point-wrap').removeClass('J-dir-con');
    }
    if($('.point-wrap').hasClass('J-camera-con'))
    {
        $('.point-wrap').removeClass('J-camera-con');
    }
    if($('.point-wrap').hasClass('J-lens-con'))
    {
        $('.point-wrap').removeClass('J-lens-con');
    }
    if($('.point-wrap').hasClass('J-address-con'))
    {
        $('.point-wrap').removeClass('J-address-con');
    }
    //重置样式
    $('.point-wrap .data-list').css({
        'overflow': 'hidden'
    });
})
/*****选择展区弹窗 end***/
/*******提交表单 start*******/
$('#J-submit-shareset').bind('click',function () {
    $('#shareForm').submit();
});

/*******提交表单 end*******/
