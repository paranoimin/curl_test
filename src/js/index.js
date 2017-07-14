(function() {
    var option = {};
    option.url = "http://arribista.co.kr/product/detail.html?product_no=3353&cate_no=1&display_group=7";
    // option.beforeSend = function(xhr) {
    //     xhr.setRequestHeader("Authorization", "Basic " + btoa("paranoimin@gmail.com:WoalsdlRjek!1983"));
    // };
    option.type = "post";
    option.dataType = "json";
    option.contentType = "application/json";
    option.processData = false;
    option.data = {"foo":"bar"};
    option.success = function (data) {
        console.log(data);
        alert(JSON.stringify(data));
    };
    option.error = function(){
        alert("Cannot get data");
    };

    $.ajax(option);
})();
