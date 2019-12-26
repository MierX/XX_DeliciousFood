setInterval(selfStatus,10000);

function selfCheck(url,table,field,condition,value) {
    let status = '';
    let data = {
        'table':table,
        'field':field,
        'condition':condition,
        "value":value,
    };
    selfAjax(url,"post", data,false,function (data) {status = data;});
    return status;
}

function selfStatus() {
    selfAjax("/Home/Index/status","get", {},true,function (data) {if(!data){clearInterval();selfMsg('您的账号目前被关闭，请致电客服','封号提示',false,false,['确定'],function () {location.href = "/Home/Index/index"});}});
}

function selfAjax(url, type = 'get', data = {}, async = true, success = function () {return true}, error = function () {layer.msg('出错了~')}) {
    $.ajax({
        url:url,
        type:type,
        data:data,
        async:async,
        success:success,
        error:error,
    });
}

function selfSearch() {
    let where = '';
    $('.searchValue').each(function () {
        if($(this).val()) {
            where += "&where["+$(this).attr('name')+"]="+$(this).val();
        }
    });
    return where;
}

function selfMsg(content, title = false, closeBtn = true, shadeClose= false, button = [], fun1 = function () {return true}, fun2 = function () {return true}, fun3 = function () {return true}, fun4 = function () {return true}, fun5 = function () {return true}, fun6 = function () {return true}, fun7 = function () {return true}, fun8 = function () {return true}, fun9 = function () {return true}) {
    layer.confirm(content, {
        title:title,
        closeBtn:closeBtn,
        shadeClose:shadeClose,
        btn: button,
    },fun1,fun2, fun3, fun4, fun5, fun6, fun7, fun8, fun9,);
}

function selfNextPage(page,lastPage,url) {
    page = parseInt(page) + 1 <= lastPage ? parseInt(page) + 1 : lastPage;
    location.href = url+page;
}

function selfLastPage(page,url) {
    page = parseInt(page) - 1 >= 1 ? parseInt(page) - 1 : 1;
    location.href = url+page;
}

function selfDeleteObj(obj) {
    $(obj).parent().remove()
}

function selfDownObj(obj,parentclass) {
    var allNsetp = $("."+parentclass);
    if ($(obj).parent()[0] === allNsetp[allNsetp.length - 1]) {
        return false;
    } else {
        var newEle = $(obj).parent().clone(true);
        selfDeleteObj(obj);
        allNsetp.each(function (index, item) {
            if ($(obj).parent()[0] == item) {
                $($(allNsetp[index + 1])).after(newEle[0]);
            }
        })
    }
}

function selfUpObj(obj,parentclass) {
    var allNsetp = $("."+parentclass);
    if ($(obj).parent()[0] === allNsetp[0]) {
        return false;
    } else {
        var newEle = $(obj).parent().clone(true);
        selfDeleteObj(obj);
        allNsetp.each(function (index, item) {
            if ($(obj).parent()[0] == item) {
                $($(allNsetp[index - 1])).before(newEle[0]);
            }
        })
    }
}

function selfAddObj(obj) {
    var mct = document.createElement("div");
    mct.setAttribute("class", "mct clearfix");
    mct.innerHTML = '<input type="text" class="liaoext zhuliao fcbm" name="zhuliao[]" value=""/>' +
                    '<input type="text" class="liangext fcbm" name="zhuliaoValue[]" value=""/>' +
                    '<a href="javascript:void(0);" class="add" onclick="selfAddObj($(this).parent())"></a>' +
                    '<a href="javascript:void(0);" class="up" onclick="selfUpObj(this,\'mct\')"></a>' +
                    '<a href="javascript:void(0);" class="down" onclick="selfDownObj(this,\'mct\')"></a>' +
                    '<a href="javascript:void(0);" class="wrng" onclick="selfDeleteObj(this)"></a>';
    if(obj){
        obj.after(mct);
    }else{
        $(".zl-list").append(mct);
    }
}