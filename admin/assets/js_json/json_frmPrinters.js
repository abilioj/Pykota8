var url = "../../app/WS/JSON_ADMIN_PRINTERS.php";

var Ajax_Controle_Data = function (acao, id, ip) {
    $.ajax({
        type: "POST",
        url: url,
        data: {acao: acao, id: id, ip: ip},
        dataType: "json",
        beforeSend: function () {
            $(".msg").html('');
        },
        error: function () {
            msg = 1;
            $('.msg').html('');
        },
        success: function (json) {
            console.log(json);
        }
    });
};

var Main = function () {
};

$(document).ready(function () {
    Main();
    
    $("#btn-incluir").click(function () {
        var id = $("#id").val();
        var ip = $("#ip").val();
        Ajax_Controle_Data(Ajax_Controle_Data('s',id,ip));
    });
    
    Refet(1, 3000);
});