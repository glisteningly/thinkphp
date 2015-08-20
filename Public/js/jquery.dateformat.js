(function($){
    //功能：把unix时间戳转成Y-m-d H:i:s格式的日期
    $.unix2human = function(unixTimeStamp){
        var now = new Date(unixTimeStamp * 1000);
        var year = now.getFullYear();
        var month = now.getMonth() + 1;
        month = month < 10 ? "0" + month : month;
        var day = now.getDate();
        day = day < 10 ? "0" + day : day;
        var hour = now.getHours();
        hour = hour < 10 ? "0" + hour : hour;
        var minute = now.getMinutes();
        minute = minute < 10 ? "0" + minute : minute;
        var second = now.getSeconds();
        second = second < 10 ? "0" + second : second;
        return year + "-" + month + "-" + day + " &nbsp " + hour + ":" + minute + ":" + second;
    }
})(jQuery);

