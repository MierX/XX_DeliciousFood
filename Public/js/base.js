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

function selfShow(title,url,w,h){
    if(w == 0) w = document.body.clientWidth*0.75;
    if(h == 0) h = document.body.clientHeight*0.75;
    layer_show(title,url,w,h);
}

function selfEdit(url) {
    var data = {};
    var form = $('form').serializeArray();
    for(let i = 0; i < form.length; i++) {
        if(form[i]['value']) data[form[i]['name']] = form[i]['value'];
    }
    if(JSON.stringify(data) != "{}") selfAjax(url,"post", data,true,function (data) {if(data){parent.location.reload();}else{selfMsg('操作失败！','提示',false,true,[])}});
}

function selfOperation(url) {
    if(url) selfAjax(url,"post", {},true,function (data) {if(data){location.reload();}else{selfMsg('操作失败！','提示',false,true,[])}});
}

function selfOperationV2(url) {
    if(url) selfAjax(url,"post", {},true,function (data) {if(data){selfMsg('修改成功！请重新登录！','提示',false,false,['确定'],function () {selfAjax("/Home/Index/out",'get',{},true,function (data) {if(data) location.reload();});})}else{selfMsg('操作失败！','提示',false,true,[])}});
}

function selfUserChange(id,nickname,username,url) {
    selfMsg('<p>昵&nbsp;&nbsp;&nbsp;称：'+nickname+'</p><p>手机号：'+username+'</p>','个人信息',false,true,['修改个人信息'],
        function() {
                selfMsg('请选择要修改的信息','修改个人信息',false,true,['昵称','密码'],
            function () {
                    layer.prompt({
                        title: '请输入昵称',
                    },
            function (value,index,elem) {
                        if(selfNickname(value)) selfOperationV2(url+id+'&save[nickname]='+value);
                    });
                },
            function () {
                    layer.prompt({
                        formType: 1,
                        title: '请输入密码',
                    },
            function (value,index,elem) {
                        if(selfPassword(value)) selfOperationV2(url+id+'&save[password]='+value);
                    });
                },
            );
        }
    );
}

function selfNickname(v) {
    if(v.length >= 2 || v.length <= 16) {
        var status = selfCheck("/Home/Index/check",'user','nickname','=',v);
        if(status) {
            selfMsg('您要修改的昵称已被使用！','温馨提示',false,true,[]);
            return false;
        } else {
            return true;
        }
    } else {
        return false;
    }
}

function selfPassword(v) {
    var regNumber = /\d+/;
    var regString = /[a-zA-Z]+/;
    var regSpecial= /[-~!@#$%^&*()/\|,.<>?"'();:_+=\[\]{}]/;
    var check_3 = 0;
    if(regNumber.test(v)){
        check_3 += 1;
    }
    if(regString.test(v)){
        check_3 += 1;
    }
    if(regSpecial.test(v)){
        check_3 += 1;
    }
    if(v.length < 6 || v.length > 20 || v.indexOf(" ") != -1 || check_3 < 2) {
        selfMsg('您的密码不符合要求！','温馨提示',false,true,[]);
        return false;
    } else {
        return true;
    }
}

function selfCollection(url,uid,mid) {
    if(uid && mid) {
        let data = {
            'uid' : uid,
            'mid' : mid,
        };
        selfAjax(url,"post", data,true,function (data) {if(data){location.reload();}else{selfMsg('操作失败！','提示',false,true,[])}});
    } else {
        selfMsg('登录后再来收藏菜谱吧','温馨提示',false,true,[]);
    }
}