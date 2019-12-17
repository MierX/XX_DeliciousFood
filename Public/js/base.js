function checkValue(table,field,condition,value) {
    let status = '';
    $.ajax({
        url:"/Home/index?check=1",
        type:"post",
        async:false,
        data:{
            'table':table,
            'field':field,
            'condition':condition,
            "value":value,
        },
        success:function (data) {
            status = data;
        },
        error:function () {
            layer.msg("未知错误！");
        }
    });
    return status;
}

function selfMsg(content,title = false,closeBtn = true,shadeClose= false,button = []) {
    layer.confirm(content, {
        title:title,
        closeBtn:closeBtn,
        shadeClose:shadeClose,
        btn: button,
    });
}