$('#J-go-attention').on('click',function () {
    var userID=$('input[name="userID"]').val();
    $.ajax({
        url: '/album/ajax-follow',
        type: 'GET',
        data: {id: userID},
    })
        .done(function(data) {
            if(data)
            {
                $('#J-go-attention').css('display','none');
                $('#J-go-unfollow').css('display','inline-block');
            }
        })
        .fail(function() {
            console.log("error");
        })
        .always(function() {
            console.log("complete");
        });
});
$('#J-go-unfollow').on('click',function () {
    var userID=$('input[name="userID"]').val();
    $.ajax({
        url: '/album/ajax-unfollow',
        type: 'GET',
        data: {id: userID},
    })
        .done(function(data) {
            //console.log(data);
            if(data)
            {
                $('#J-go-attention').css('display','inline-block');
                $('#J-go-unfollow').css('display','none');
            }
        })
        .fail(function() {
            console.log("error");
        })
        .always(function() {
            //console.log("complete");
        });
});
/**********AJAX取消展示***********/
$('.editarea .del').on('click',function () {
    var del=$(this);
    var id=$(this).attr('data-id');
    $.ajax({
        url: '/home/ajax-remove-album',
        type: 'GET',
        data: {id: id},
        dataType:'json',
    })
        .done(function() {
            del.parent().parent().remove();
        })
        .fail(function() {
            alert('删除失败！');
        })

});