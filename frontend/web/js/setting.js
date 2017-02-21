/*********设置页选项卡滚动**********/
var url=String(window.location);
var page=url.substr(-1);
$('.m-profileTaber .taber').eq(page-1).addClass('curTaber').siblings().removeClass('curTaber');
$('.m-pageCon>li').addClass('item'+(page));
$('.m-pageCon>li').addClass('item'+(page));
	$('.m-profileTaber .taber').click(function(event) {
		$(this).addClass('curTaber').siblings().removeClass('curTaber');
		page=$(this).index()+1;
		$('.m-pageCon>li').attr('class','con-item');
		$('.m-pageCon>li').addClass('item'+(page));
	})
	$('.cancel').click(function(event) {
		$(this).parent().parent().addClass('hide');
		$('.m-form-personal fieldset').removeClass('hide');
	});
	$('.w-btnDimGray').click(function(event) {
		$('.m-form-personal fieldset').addClass('hide');
		$('.profile-flash').removeClass('hide');
	});

/*********头像裁剪上传********/
//监听文件改变事件
var file='';
var x='';
var y='';
var width='';
var height='';
function uploadImage() {
	$('#imageFile')[0].addEventListener('change',function () {
		file=this.files[0];
		var reader=new FileReader();
		reader.onload=function () {
			var url=reader.result;
			setImageURL(url);
			$('.headImg').cropper({
				aspectRatio: 1 / 1,
				preview:$('.mid-img'),
				viewMode:1,
				autoCropArea:1,
				crop: function(e) {
					x=Math.abs(Math.ceil(e.x));
					y=Math.abs(Math.ceil(e.y));
					width=e.width;
					height=e.height;
				}

			});
		};
		reader.readAsDataURL(file);
		function setImageURL(url) {
			var html='<img src="'+url+'" style="width: 100%;max-height: 100%;margin: 0 auto" class="headImg">';
			$('.upload-wrap').append(html);
		}
	});
	$('.save').click(function () {
		var formData=new FormData();
		formData.append('imageFile',file);
		formData.append('width',width);
		formData.append('height',height);
		formData.append('x',x);
		formData.append('y',y);
		$.ajax({
			url: '/setting/setimage',
			type: 'POST',
			data:formData,
			processData: false,
			contentType: false,
			cache: false,
			dataType:'json',
		})
			.done(function(data) {
			})
			.fail(function() {
				console.log("error");
			})
			.always(function(data) {
				$('.profile-flash').addClass('hide');
				$('.m-form-personal fieldset').removeClass('hide');
				$('.cropper-container').remove();
				$('.o-box img').attr('src',data.url);
				var html='<div class="upload">上传图片<input type="file" name="imageFile" id="imageFile"></div>';
				$('.upload-wrap').html(html);
				$('.mid-img img').attr('src','');
				$('.host-ava').attr('src',data.url);
				uploadImage();
			});
	})
}
uploadImage();

/****AJAX设置个人信息*****/
$('#J-submit-profile')[0].addEventListener('click',function () {
	var year=$('#J-year').val();
	var month=$('#J-month').val();
	var day=$('#J-day').val();
	var birth_date=year+'-'+month+'-'+day;
	$('#birth_date').val(birth_date);
	$.ajax({
		url: '/setting/ajax-person-info',
		type: 'POST',
		dataType: 'json',
		data: $('#J-space-form').serialize(),
	})
		.done(function(data) {
			alert('保存成功！');
		})
		.fail(function(data) {
			console.log(data);
		})
		.always(function() {
			console.log("complete");
		});
});
/***********设置背景图片************/
$('.skin-item').on('click',function () {
	$(this).addClass('skin-item-current').siblings().removeClass('skin-item-current');
	$(this).parent().siblings().find('.skin-item').removeClass('skin-item-current');
	var i= $(this).parent().index();
	if(i==1)
	{
		var url=$(this).attr('data-value');
		$('.m-homeBgM .bg-img').attr('src',url);
	}
	else
	{
		var color=$(this).attr('data-value');
		var img=$('.m-homeBgM .bg-img').attr('data-default');
		$('.m-homeBgM .bg-img').attr('src',img);
		$('.m-homeBgM .bg-img').css({
			'width':'100%',
			'height':'100%',
			'background':color,
		})
	}
});
/**********设置字体颜色*********/
$('input[name="fontColor"]').on('click',function () {
	var color=$(this).val();
	if(color=='#000')
	{
		$('body').attr('class','g-wraper-fblack');
	}else {
		$('body').attr('class','g-wraper-fwhite');
	}
});
/***************AJAX设置背景和字体****************/
$('#J-skinSubmit').on('click',function () {
	var bg_id=$('.skin-item-current').attr('data-id');
	var fontColor=$('input[name="fontColor"]:checked').val();
	$.ajax({
		url: '/setting/ajax-bg-image',
		type: 'POST',
		dataType: 'json',
		data: {bg_id: bg_id,fontColor:fontColor},
	})
		.done(function(data) {
		})
		.fail(function() {
			console.log("error");
		})
		.always(function(data) {
			alert("保存成功！");
		});
});
/****************AJAX相机信息*****************/
//添加相机信息
function deleteCameraInfo() {
	$('.delete-camera').on('click',function () {
		if($('.camera-info .itm').length>1)
		{
			$(this).parent().remove();
		}
	});
}
$('.add-camera').on('click',function () {
	var html='';
	html+='  <div class="itm">';
	html+='<input type="text" value="" name="camera[]">';
	html+='<a class="z delete-camera" href="#" onclick="return false;" hidefocus="true" >删除</a>';
	html+='</div>';
	$('.camera-info').append(html);
	deleteCameraInfo();
});
deleteCameraInfo();
//添加镜头信息
function deleteLensInfo() {
	$('.delete-lens').on('click',function () {
		if($('.lens-info .itm').length>1)
		{
			$(this).parent().remove();
		}
	});
}
$('.add-lens').on('click',function () {
	var html='';
	html+='  <div class="itm">';
	html+='<input type="text" value=""  name="lens[]">'
	html+='<a class="z delete-lens" href="#" onclick="return false;" hidefocus="true">删除</a>'
	html+='</div>';
	$('.lens-info').append(html);
	deleteLensInfo();
});
deleteLensInfo();
//Ajax提交摄影资料
$('#save-Pgy').on('click',function () {
	$.ajax({
		url: '/setting/ajax-pgy-data',
		type: 'POST',
		data: $('#pgy-data').serialize(),
	})
		.done(function() {
			alert('修改成功!');
		})
		.fail(function() {
			alert('修改失败!');
		})
});