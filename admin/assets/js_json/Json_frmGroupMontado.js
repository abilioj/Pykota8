var msg = 0;
var row = 0;
var idG = 0;
var idU = 0;
var isOK = false;
var table;
var targets = [0, 1, 2];
var URLSelect = "app/WS/JSON_ADMIN_VICULAR.php";
var URLAcao = "app/WS/JSON_ADMIN_VICULAR.php";

function jsonCampoSelect(json) {
    var html;
    var select = '';
    html = '';
    //Selecione o user
    html = '<option value=""></option>';
    $.each(json.user, function (key, value) {
        if (value.id === idU) {
            select = "selected";
        } else {
            select = "";
        }
        html += '<option value="' + value.id + '" ' + select + '>' + value.text + '</option>';
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
        beforeSend: function () {
            $("#msg").html('');
        },
        error: function () {
            msg = 1;
            $('#msg').html('');
        },
        success: function (json) {
            idU = $("#user").val();
            idG = $("#group").val();
            jsonCampoSelect(json);
        }
    });
};

var Main = function () {
//    Ajax_DaodoSelect();
    $(".sel").select2({
        placeholder: 'Selecione o item',
        allowClear: true
    });
};

$(document).ready(function () {
    Main();
});