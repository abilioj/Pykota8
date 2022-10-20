var msg = 0;
var row = 0;
var isOK = false;
var data = [];
var URLSelect = "app/WS/JSON_ADMIN_SELECT.php";

function jsonCampoSelect(json) {
    var html;
    html = '';
    //Selecione o user
    html = '<option value=""></option>';
    $.each(json.user, function (key, value) {
        html += '<option value="' + value.id + '">' + value.text + '</option>';
    });
    $("#user").html(html);
    //Selecione o useracess
    html = '<option value=""></option>';
    $.each(json.useracess, function (key, value) {
        html += '<option value="' + value.id + '">' + value.text + '</option>';
    });
    $("#useracess").html(html);
    html = '';
    //Selecione o printers
    html = '<option value=""></option>';
    $.each(json.printers, function (key, value) {
        html += '<option value="' + value.id + '">' + value.text + '</option>';
    });
    $("#printers").html(html);
    html = '';
    //Selecione o group
    html = '<option value=""></option>';
    $.each(json.group, function (key, value) {
        html += '<option value="' + value.id + '">' + value.text + '</option>';
    });
    $("#group").html(html);
    html = '';
}

var Ajax_DaodoSelect = function () {
    $.ajax({
        type: "POST",
        url: URLSelect,
        dataType: "json",
        contentType: 'application/json; charset=utf-8',
//        beforeSend: function () {
//            $("#msg").html('');
//        },
        error: function () {
            msg = 1;
            $('#msg').html('');
        },
        success: function (json) {
            jsonCampoSelect(json);
        }
    });
};

var Main = function () {
    Ajax_DaodoSelect();
};

$(document).ready(function (){    
    caminho = $('#caminho').val();
    URLSelect = caminho + URLSelect;
    Main();  
    
    $(".sel").select2({
        placeholder: 'Selecione o item',
        allowClear: true
    });

});