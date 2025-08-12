<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0,viewport-fit=cover">
    <title>安全链接</title>
    <style>
        #fullscreen-img {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background: url('https://img.scdn.io/image.php?file=6864c97bec96f_1751435643.webp') no-repeat center center;
            background-size: cover;
            pointer-events: none;
        }
    </style>
</head>
<body>
    <div id="fullscreen-img"></div>  <!-- 新增的全屏图片层 -->
    <div id="tips" style="font-size:25px;text-align: center;line-height: 50px; position: relative; z-index: 10000;"></div>
    <script>
    var url = document.location.toString();
    var urlParmStr = url.slice(url.indexOf('=')+1);
    var ua = navigator.userAgent.toLowerCase();
    var isQQ = ua.indexOf('qq') != -1;
    var isWeixin = ua.indexOf('micromessenger') != -1;
    var isAndroid = ua.indexOf('android') != -1;
    var isIos = (ua.indexOf('iphone') != -1) || (ua.indexOf('ipad') != -1);


    // 判断是不是在微信客户端打开
    if(isWeixin || isQQ) {
    // 判断是在Android的微信客户端还是Ios的微信客户端
    if (isAndroid) {
    document.getElementById("tips").innerHTML=notice_openBrowser;
    }else if (isIos) {
    document.getElementById("tips").innerHTML=notice_openBrowser;
    }else{
    document.getElementById("tips").innerHTML=notice_openBrowser;
    }
    } else {
    // 不是微信客户端，直接可以访问链接
    if (urlParmStr == url){
        urlParmStr = "https://www.baidu.com";
    }
    console.log(urlParmStr);
    location.href=urlParmStr;
    }
</script>
    <script charset="UTF-8" id="LA_COLLECT" src="//sdk.51.la/js-sdk-pro.min.js"></script><script>LA.init({id:"K8YSQIj3WDtj9gG6",ck:"K8YSQIj3WDtj9gG6"})</script>
</body>
</html>
