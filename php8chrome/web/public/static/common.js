

let ajax = function(url,data,success,error,type = 'GET',contentType = 'application/json',autoClose = true,processData=true) {

    var sendData = data;

    if (type == 'GET') {
        contentType = 'application/x-www-form-urlencoded';
        if (url.indexOf('?') == -1) {
            url = url + '?_=' + Math.random();
        } else {
            url = url + '&_=' + Math.random();
        }
    } else if (contentType == 'application/json') {
        sendData = JSON.stringify(data);
    }
    let config = {
        url:url,
        data:sendData,
        type:type,
        processData:processData,
        contentType:contentType,
        success:response => {
            let msg = ''
            if (response.hasOwnProperty('message')) {
                msg = response.message;
            } else if (response.hasOwnProperty('msg')) {
                msg = response.msg;
            }
            if (response.code === 1 || response.code === 200) {
                if ($.isFunction(success)) {
                    success(response,msg);
                }else{
                    console.log('成功',mes);
                }
                
            } else {
                if ($.isFunction(error)) {
                    error(response,msg);
                }else{
                    console.log('失败',mes);
                }
            }
        },
        error:(e) => {
            var msg = '请求错误, status:' + e.status;
            if ($.isFunction(error)) {
                error({'message':msg},msg);
            }else{
                    console.log('失败',+ e.status);
            }
        }
    };
    return $.ajax(config);
};
let postAjax = function(url,data,success,error) {
    return ajax(url,data,success,error,'POST','application/json')
};
let getAjax = function(url,data,success,error,autoClose = true) {
    return ajax(url,data,success,error,'GET','application/json',autoClose)
};
let postJsonAjax = function(url,data,success,error) {
    return ajax(url,data,success,error,'POST','application/json');
};
let postFormAjax = function(url,data,success,error) {
    return ajax(url,data,success,error,'POST','application/x-www-form-urlencoded');
};
let postUploadAjax = function(url,data,success,error) {
    return ajax(url,data,success,error,'POST',false,true,false);
};

let varPath = function(origData,path,defaultValue,isNumber) {
    isNumber = isNumber || false;
    defaultValue = typeof (defaultValue) == 'undefined' ? null : defaultValue;
    var data = $.extend({},origData);
    if(data.hasOwnProperty(path)){
        render = data[path];
    }else{
        var paths = path.split('.');

        var topPath = paths.shift();
        var render = defaultValue;
        if (data.hasOwnProperty(topPath)) {
            var val = data[topPath];
            if (paths.length > 0) {
                render = varPath(val,paths.join('.'),defaultValue);
            } else {
                render = val;
            }
        }
    }
    if (isNumber) {
        render = parseFloat(render);
    }
    return render
}