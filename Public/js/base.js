function checkValue(table,field,where,value) {
    let status = '';
    $.ajax({
        url:"/Home/index?check=1",
        type:"post",
        async:false,
        data:{
            'table':table,
            'field':field,
            'where':where,
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